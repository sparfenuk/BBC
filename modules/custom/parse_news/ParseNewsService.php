<?php


namespace Drupal\parse_news;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;
use Symfony\Component\DomCrawler\Crawler;

class ParseNewsService
{

  private $entityTypeManager;

  public function __construct(EntityTypeManager $entityTypeManager)
  {
    $this->entityTypeManager = $entityTypeManager;
  }

  public function ParseNews()
  {
    $parseNews = $this->entityTypeManager
      ->getStorage('parse_news')
      ->loadMultiple();



    foreach ($parseNews as $article) {
      try {
        $doc = new Crawler(file_get_contents($article->getSiteUrl()));
        $links = $doc->filterXPath($article->getXPathToHref());
        for ($i = 0; $i < $links->count(); $i++) {

          try {

            $link = $links->getNode($i)->nodeValue;

            self::validateLink($link, $article->getSiteUrl());

            $post = new Crawler(file_get_contents($link));

            $content = $post->filterXPath($article->getXpathToContent())
              ->html();
            $title = $post->filterXPath($article->getXpathToTitle())
              ->getNode(0)->nodeValue;
            $image = $post->filterXPath($article->getXpathToImage())
              ->getNode(0)->nodeValue;

            $data = file_get_contents($image);
            $imageName = basename($image);
            $image = file_save_data($data, 'public://' . $imageName . pathinfo($image), FILE_EXISTS_REPLACE);

            /** @var Node $parsedMaterial */
            $parsedMaterial = $this->entityTypeManager
              ->getStorage('node')
              ->loadByProperties(['title' => $title]);

            if (!$parsedMaterial) {
              $parsedMaterial = Node::create([
                'type' => 'article',
                'title' => $title,
                'field_image' => [
                  'target_id' => $image->id(),
                  'alt' => $title,
                  'title' => $imageName,
                ],
                'body' => [
                  'value' => $content,
                  'format' => 'full_html',
                ],
              ]);
              $parsedMaterial->enforceIsNew();
            }
            else {
              if (is_array($parsedMaterial)) {
                $parsedMaterial = array_shift($parsedMaterial);
              }

              if ($parsedMaterial instanceof NodeInterface) {
                $parsedMaterial->set('title', $title);
                $parsedMaterial->set('field_image', [
                  'target_id' => $image->id(),
                  'alt' => $title,
                  'title' => $imageName,
                ]);
                $parsedMaterial->set('body', [
                  'value' => $content,
                  'format' => 'full_html',
                ]);
              }
            }

            $parsedMaterial->save();
          }
          catch (\Exception $e) {
            print_r('article exception, line:' . $e->getLine());
            print_r($e->getMessage());

          }
        }

      } catch (\Exception $e) {
        print_r('parse exception, line:' . $e->getLine());
        print_r($e->getMessage());

      }
    }
    print_r('News successfully parsed');
  }

  private function validateLink(string &$link, string $baseSiteUrl){
    if (strpos($link, 'http') === false) {
      $site = parse_url($baseSiteUrl);
      $link = $site['scheme'].'://' . $site['host'] . $link;
    }
  }
}

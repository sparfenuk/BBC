<?php

namespace Drupal\parse_news\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\parse_news\ParseNewsInterface;

/**
 * Defines the parse news entity type.
 *
 * @ConfigEntityType(
 *   id = "parse_news",
 *   base_table = "parse_news",
 *   label = @Translation("Parse news"),
 *   label_collection = @Translation("Parse news"),
 *   label_singular = @Translation("parse news"),
 *   label_plural = @Translation("parse news"),
 *   label_count = @PluralTranslation(
 *     singular = "@count parse news",
 *     plural = "@count parse newses",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\parse_news\ParseNewsListBuilder",
 *     "form" = {
 *       "add" = "Drupal\parse_news\Form\ParseNewsForm",
 *       "edit" = "Drupal\parse_news\Form\ParseNewsForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "parse_news",
 *   admin_permission = "administer parse_news",
 *   links = {
 *     "add-form" = "/admin/content/parse-news/add",
 *     "edit-form" = "/admin/content/parse-news/{parse-news}/edit",
 *     "delete-form" = "/admin/content/parse-news/{parse-news}/delete",
 *     "collection" = "/admin/content/parse-news"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *   },
 *   config_export = {
 *     "id",
 *     "siteUrl",
 *     "xpathToHref",
 *     "xpathToTitle",
 *     "xpathToContent",
 *     "xpathToImage",
 *   }
 * )
 */
class ParseNews extends ConfigEntityBase  implements ParseNewsInterface {
  /**
   * @var string
   */
  protected $id;
  /**
   * @var string
   */
  protected $siteUrl;
  /**
   * @var string
   */
  protected $xpathToHref;
  /**
   * @var string
   */
  protected $xpathToTitle;
  /**
   * @var string
   */
  protected $xpathToContent;
  /**
   * @var string
   */
  protected $xpathToImage;
  /**
   * @var DrupalDateTime
   */
  protected $createdAt;
  public function __construct(array $values, $entity_type) {
    parent::__construct($values, $entity_type);
    $this->createdAt = new DrupalDateTime();
  }
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage); // TODO: Change the autogenerated stub
  }
  /**
   * @return string
   */
  public function getSiteUrl(): ?string
  {
    return $this->siteUrl;
  }
  /**
   * @return string
   */
  public function getXPathToHref(): ?string
  {
    return $this->xpathToHref;
  }
  /**
   * @param string $XPathToHref
   */
  public function setXPathToHref(string $XPathToHref): void
  {
    $this->xpathToHref = $XPathToHref;
  }
  /**
   * @return string
   */
  public function getXpathToTitle(): ?string
  {
    return $this->xpathToTitle;
  }
  /**
   * @param string $xpathToTitle
   */
  public function setXpathToTitle(string $xpathToTitle): void
  {
    $this->xpathToTitle = $xpathToTitle;
  }
  /**
   * @return string
   */
  public function getXpathToContent(): ?string
  {
    return $this->xpathToContent;
  }
  /**
   * @param string $xpathToContent
   */
  public function setXpathToContent(string $xpathToContent): void
  {
    $this->xpathToContent = $xpathToContent;
  }
  /**
   * @return string
   */
  public function getXpathToImage(): ?string
  {
    return $this->xpathToImage;
  }
  /**
   * @param string $xpathToImage
   */
  public function setXpathToImage(string $xpathToImage): void
  {
    $this->xpathToImage = $xpathToImage;
  }
  /**
   * @return DrupalDateTime
   */
  public function getCreatedAt(): ?DrupalDateTime
  {
    return $this->createdAt;
  }
  /**
   * @param DrupalDateTime $createdAt
   */
  public function setCreatedAt(DrupalDateTime $createdAt): void
  {
    $this->createdAt = $createdAt;
  }


  public function getAllAsArray()
  {
    return [
      'id'               => $this->id,
      'url'              => $this->siteUrl,
      'xpath_to_href'    => $this->xpathToHref,
      'xpath_to_title'   => $this->xpathToTitle,
      'xpath_to_image'   => $this->xpathToImage,
      'xpath_to_content' => $this->xpathToContent,
      'created_at'       => $this->createdAt,
    ];
  }
}

<?php

namespace Drupal\parse_news;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of parse newses.
 */
class ParseNewsListBuilder extends ConfigEntityListBuilder  {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {

    $header['id'] = $this->t('Machine name');
    $header['url'] = $this->t('Url to page with list of articles');
    $header['xpathToHref'] = $this->t('xpath to links on article at page with list of articles');
    $header['xpathToTitle'] = $this->t('xpath to title of article on one article page');
    $header['xpathToContent'] = $this->t('xpath to content of article on one article page');
    $header['xpathToImage'] = $this->t('xpath to image src on one article page');
    $header['createdAt'] = $this->t('Timestamp when the record was created.');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['id'] = $entity->id();
    $row['url'] = $entity->getSiteUrl();
    $row['xpathToHref'] = $entity->getXPathToHref();
    $row['xpathToTitle'] = $entity->getXpathToTitle();
    $row['xpathToContent'] = $entity->getXpathToContent();
    $row['xpathToImage'] = $entity->getXpathToImage();
    $row['createdAt'] = $entity->getCreatedAt();
    return $row + parent::buildRow($entity);
  }

}

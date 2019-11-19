<?php


namespace Drupal\parse_news\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Class ParseNewsBlock
 * @package Drupal\parse_news\Plugin\Block
 * provides ParseNewsBlock on node page
 *
 * @Block{
 *  id="parse_news_block",
 *  admin_label="Parsed news",
 *  category="parse_news",
 * }
 */
class ParseNewsBlock extends BlockBase
{

  /**
   * {@inheritDoc}
   */
  public function build()
  {
    return [
      '#type' => 'markup',
      '#markup' => 'This article was parsed!',
    ];
  }
}

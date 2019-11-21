<?php

namespace Drupal\pb_curs\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an PrivatBank curs API block on site header.
 *
 * @Block(
 *   id = "pb_curs",
 *   admin_label = @Translation("pb_curs"),
 *   category = @Translation("pb_curs")
 * )
 */
class PBCursBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $currencies = \Drupal::service('pb_curs')->getCurrencies();
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $currencies,
    ];

    return $build;
  }

}

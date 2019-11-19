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
    $query = \Drupal::database()->select('pb_curs');
    $query->fields('pb_curs', ['sale', 'purchase']);
    $query->condition('currency', 'EUR');
    $query->orderBy('pb_curs.id', "DESC");
    $EUR = $query->execute()->fetchObject();$query = \Drupal::database()->select('pb_curs');

    $query->fields('pb_curs', ['sale', 'purchase']);
    $query->condition('currency', 'USD');
    $query->orderBy('pb_curs.id', "DESC");
    $USD = $query->execute()->fetchObject();

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t("USD: {$USD->purchase} / {$USD->sale}  EUR: {$EUR->purchase} / {$EUR->sale}"),
    ];

    return $build;
  }

}

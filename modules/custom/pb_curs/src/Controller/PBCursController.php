<?php

namespace Drupal\pb_curs\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for PBCurs routes.
 */
class PBCursController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

  public function cursRefresh()
  {
    self::cronUpdate();
  }

  public static function cronUpdate()
  {
    $date = date('d.m.Y');
    $json = file_get_contents('https://api.privatbank.ua/p24api/exchange_rates?json&date=' . $date);
    $data = json_decode($json, true);
    $db = \Drupal::database();
    $db->truncate('pb_curs')->execute();

    foreach ($data['exchangeRate'] as $er) {
      if (array_key_exists('saleRate', $er)) {
        try {
          $db->insert('pb_curs')
            ->fields([
              'base_currency' => $er['baseCurrency'],
              'currency' => $er['currency'],
              'sale' => $er['saleRate'],
              'purchase' => $er['purchaseRate'],
              'date' => $date,
            ])->execute();

        } catch (\Exception $e) {
          echo 'database error occurred';
          echo $e->getMessage();
          exit();
        }
      }
    }
    echo 'Currencies successfully updated!';
  }

}

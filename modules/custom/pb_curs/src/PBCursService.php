<?php

namespace Drupal\pb_curs;


class PBCursService
{

  public function cursRefresh(): void
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


  public function getCurrencies(): ?string
  {
    $query = \Drupal::database()->select('pb_curs');
    $query->fields('pb_curs', ['sale', 'purchase']);
    $query->condition('currency', 'EUR');
    $query->orderBy('pb_curs.id', "DESC");
    $EUR = $query->execute()->fetchObject();$query = \Drupal::database()->select('pb_curs');

    $query->fields('pb_curs', ['sale', 'purchase']);
    $query->condition('currency', 'USD');
    $query->orderBy('pb_curs.id', "DESC");
    $USD = $query->execute()->fetchObject();

    return "USD: {$USD->purchase} / {$USD->sale}  EUR: {$EUR->purchase} / {$EUR->sale}";
  }
}

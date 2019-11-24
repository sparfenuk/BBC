<?php


namespace Drupal\pb_curs\Entity;

use Drupal\Component\Plugin\Exception\PluginNotFoundException;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\TypedData\Type\DateTimeInterface;

/**
 * Defines the Privat bank curs entity.
 *
 * @ingroup advertiser
 *
 * @ContentEntityType(
 *   id = "pb_curs",
 *   label = @Translation("Curs"),
 *   base_table = "pb_curs",
 *   entity_keys = {
 *     "id" = "id",
 *     "currency" = "currency",
 *     "base_currency" = "base_currency",
 *     "sale" = "sale",
 *     "purchase" = "purchase",
 *     "date" = "date",
 *   },
 * )
 */
class PBCurs extends ContentEntityBase
{
  public function getId(): int
  {
    return $this->get('id');
  }

  public function getCurrency(): string
  {
    return $this->get('currency');
  }

  public function setCurrency(string $currency)
  {
    return $this->set('currency', $currency);
  }

  public function getBaseCurrency(): string
  {
    return $this->get('base_currency');
  }

  public function setBaseCurrency(string $BaseCurrency)
  {
    return $this->set('base_currency', $BaseCurrency);
  }

  public function getSale(): float
  {
    return $this->get('sale');
  }

  public function setSale(float $sale)
  {
    return $this->set('sale', $sale);
  }

  public function getPurchase(): float
  {
    return $this->get('purchase');
  }

  public function setPurchase(float $purchase)
  {
    return $this->set('purchase', $purchase);
  }

  public function getDate(): ? DateTimeInterface
  {
    return $this->get('date');
  }

  public function setDate(DateTimeInterface $date)
  {
    $this->set('date', $date);
  }

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
  {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Curs ID'))
      ->setDescription(t('TCurs ID.'))
      ->setReadOnly(TRUE);

    $fields['currency'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Currency code'))
      ->setDescription('Three letters which defines currency')
      ->setRequired(true)
      ->setSetting('max_length', 4);

    $fields['base_currency'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Base currency code'))
      ->setDescription('Three letters which defines currency to compare')
      ->setRequired(true)
      ->setSetting('max_length', 4);

    $fields['sale'] = BaseFieldDefinition::create('float')
      ->setLabel(t('Sale rate'))
      ->setDescription('Currency sale rate')
      ->setRequired(true);

    $fields['purchase'] = BaseFieldDefinition::create('float')
      ->setLabel('Purchase rate')
      ->setDescription('Currency purchase rate')
      ->setRequired(true);

    $fields['date'] = BaseFieldDefinition::create('datetime')
      ->setLabel('Date')
      ->setDescription('Date')
      ->setRequired(false);

    return $fields;
  }

  function curs_update()
  {
    //check if the table exists first.  If not, then create the entity.
    if (!db_table_exists('pb_curs')) {
      \Drupal::entityTypeManager()->clearCachedDefinitions();
      try {
        \Drupal::entityDefinitionUpdateManager()
          ->installEntityType(\Drupal::entityTypeManager()->getDefinition('pb_curs'));
      } catch (PluginNotFoundException $e) {
        return 'Process Status entity already exists';
      }
    } else {
      return 'Process Status entity already exists';
    }
    return true;
  }
}

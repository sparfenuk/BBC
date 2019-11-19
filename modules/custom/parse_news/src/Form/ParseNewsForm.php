<?php

namespace Drupal\parse_news\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
/**
 * Parse news form.
 *
 * @property \Drupal\parse_news\ParseNewsInterface $entity
 */
class ParseNewsForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\parse_news\Entity\ParseNews::load',
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['siteUrl'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Url to page with list of articles'),
      '#maxlength' => 512,
      '#default_value' => $this->entity->get('siteUrl') ?? null,
      '#description' => $this->t('Url to page with list of articles'),
      '#required' => TRUE,
    ];

    $form['xpathToHref'] = [
      '#type' => 'textfield',
      '#title' => $this->t('xpath to links on article at page with list of article'),
      '#maxlength' => 512,
      '#default_value' => $this->entity->get('xpathToHref') ?? null,
      '#description' => $this->t('xpath to links on article at page with list of article'),
      '#required' => TRUE,
    ];

    $form['xpathToTitle'] = [
      '#type' => 'textfield',
      '#title' => $this->t('xpath to title of article on one article page'),
      '#maxlength' => 512,
      '#default_value' => $this->entity->get('xpathToTitle') ?? null,
      '#description' => $this->t('xpath to title of article on one article page'),
      '#required' => TRUE,
    ];

    $form['xpathToContent'] = [
      '#type' => 'textfield',
      '#title' => $this->t('xpath to content of article on one article page'),
      '#maxlength' => 512,
      '#default_value' => $this->entity->get('xpathToContent') ??  null,
      '#description' => $this->t('xpath to content of article on one article page'),
      '#required' => TRUE,
    ];

    $form['xpathToImage'] = [
      '#type' => 'textfield',
      '#title' => $this->t('xpath to image src on one article page'),
      '#maxlength' => 512,
      '#default_value' => $this->entity->get('xpathToImage') ?? null,
      '#description' => $this->t('xpath to image src on one article page'),
      '#required' => TRUE,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $result = parent::save($form, $form_state);
    $message_args = ['%label' => $this->entity->label()];
    $message = $result == SAVED_NEW
      ? $this->t('Created new Parse News entity %label.', $message_args)
      : $this->t('Updated Parse news entity %label.', $message_args);
    $this->messenger()->addStatus($message);
    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
    return $result;
  }
}

<?php

namespace Drupal\pb_curs\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for PBCurs routes.
 */
class PBCursController extends ControllerBase {

  public function cursRefresh()
  {
    \Drupal::service('pb_curs')->cursRefresh();
  }
}

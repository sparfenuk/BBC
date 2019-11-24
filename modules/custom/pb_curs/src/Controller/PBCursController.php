<?php

namespace Drupal\pb_curs\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Returns responses for PBCurs routes.
 */
class PBCursController extends ControllerBase {

  public function cursRefresh()
  {
    $message = \Drupal::service('pb_curs')->cursRefresh();
    return new Response($message,Response::HTTP_OK);
  }
}

<?php

namespace Drupal\parse_news\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ParseNewsController extends ControllerBase {

  public function startParse()
  {
    $parse = \Drupal::service('parse_news');
    $parse->parseNews();
    $url = Url::fromRoute('<front>');
    $response = new RedirectResponse($url->toString());
    $response->send();
  }


}

<?php

namespace Drupal\parse_news\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ParseNewsController extends ControllerBase {

  public function startParse()
  {
    $parse = \Drupal::service('parse_news');
    $message = $parse->parseNews();
    return new Response($message, 200);
   /* $url = Url::fromRoute('<front>');
    $response = new RedirectResponse($url->toString());
    $response->send();*/
  }


}

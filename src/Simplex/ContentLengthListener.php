<?php
/**
 * Created by PhpStorm.
 * User: m1n0
 * Date: 23/08/2016
 * Time: 16:40
 */

namespace Simplex;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContentLengthListener implements EventSubscriberInterface {
  public function onResponse(ResponseEvent $event) {
    $response = $event->getResponse();
    $headers = $response->headers;

    if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
      $headers->set('Content-Length', strlen($response->getContent()));
    }
  }

  public static function getSubscribedEvents() {
    return [
      'response' => ['onResponse', -255],
    ];
  }


}

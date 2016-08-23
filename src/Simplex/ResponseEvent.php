<?php
/**
 * Created by PhpStorm.
 * User: m1n0
 * Date: 23/08/2016
 * Time: 13:08
 */

namespace Simplex;


use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponseEvent extends Event {
  private $request;
  private $response;

  public function __construct(Response $response, Request $request) {
    $this->response = $response;
    $this->request = $request;
  }

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function getResponse() {
    return $this->response;
  }

  /**
   * @return \Symfony\Component\HttpFoundation\Request
   */
  public function getRequest() {
    return $this->request;
  }
}

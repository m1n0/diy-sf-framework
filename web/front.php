<?php

// framework/front.php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new \Simplex\GoogleListener());
$dispatcher->addSubscriber(new \Simplex\ContentLengthListener());

$framework = new Simplex\Framework($dispatcher, $matcher, $resolver, $argumentResolver);
$framework = new HttpKernel\HttpCache\HttpCache(
  $framework,
  new HttpKernel\HttpCache\Store(__DIR__ . '/../cache')
);
$response = $framework->handle($request);

$response->send();

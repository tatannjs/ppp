<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$routes = require __DIR__ . '\..\src\routes.php';

$loader = new FilesystemLoader(__DIR__ . '\..\templates');
$twig = new Environment($loader);

$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());
    echo $twig->render($parameters['template'], []);
} catch (Exception $e) {
    http_response_code(404);
    echo $twig->render('404.html.twig');
}

<?php

// On récupère le chemin absolu du dossier courant
$currentDir = __DIR__;

// Détection prod/dev selon la présence de public_html
if (is_dir(dirname($currentDir) . '/public_html')) {
    // On est en dev, projet à ../
    $projectDir = dirname($currentDir).'/..';
} else {
    // En prod, projet à ../ppp
    $projectDir = dirname($currentDir);
}

require_once $projectDir . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Bridge\Twig\Extension\RoutingExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// Importation des routes définies dans src/Router/routes.php
$routes = require $projectDir . '/src/Router/routes.php';

// Configuration de Twig avec le dossier des templates
$loader = new FilesystemLoader($projectDir . '/templates');
$twig = new Environment($loader, [
    'cache' => $projectDir . '/var/cache/twig',
    'auto_reload' => true,
]);

// Configuration du générateur d'URL pour permettre l'utilisation de path() dans Twig
$urlGenerator = new UrlGenerator($routes, new RequestContext());
$twig->addExtension(new RoutingExtension($urlGenerator));

// Initialisation du contexte de requête HTTP
$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);

// Création du routeur (UrlMatcher) pour faire correspondre l'URL à une route
$matcher = new UrlMatcher($routes, $context);

try {
    /* START DEBUG ZONE */
    // $parameters = $matcher->match($request->getPathInfo());
    // var_dump($parameters);
    // die();
    /* END DEBUG ZONE*/

    // Match de la requête avec les routes
    $parameters = $matcher->match($request->getPathInfo());

    // On injecte les paramètres trouvés dans les attributs de la requête
    $request->attributes->add($parameters);

    // Si la route utilise un contrôleur (type _controller => NomController::méthode)
    if (isset($parameters['_controller'])) {
        [$controllerClass, $method] = explode('::', $parameters['_controller']);

        // Instanciation dynamique du contrôleur
        $controller = new $controllerClass();

        // Exécution de la méthode du contrôleur avec la requête et Twig
        $response = $controller->$method($request, $twig);
    } else {
        // Sinon on rend un simple template (routes statiques)
        $response = new Response($twig->render($parameters['template']));
    }

} catch (Exception $e) {
    // Si aucune route ne correspond → page 404
    $response = new Response($twig->render('404.html.twig'), 404);
}

// Envoi de la réponse HTTP au client
$response->send();

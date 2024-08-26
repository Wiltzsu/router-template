<?php

/**
 * This file contains routes for the application.
 */
use Phroute\Phroute\RouteCollector;

return function (RouteCollector $router, $container) {
    $router->get(
        '/', function () use ($container) {
            return $container->get('Twig\Environment')->render('front_page.twig');
        }
    );
};
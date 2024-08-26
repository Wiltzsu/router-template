<?php

/**
 * This file is responsible for setting up and configuring the
 * Dependency Injection (DI) container using PHP-DI, a dependency
 * injection library for PHP. The DI container is used to manage
 * and inject dependencies throughout the application.
 */

 /**
  * Imports the 'ContainerBuilder' from the PHP-DI library.

  * The 'ContainerBuilder' is used to configure and build
  * the DI container.
  */
use DI\ContainerBuilder;

/**
 * Creates an instance of the 'ContainerBuilder' class.
 *
 * The instance is responsible for setting up the definitions
 * and configurations needed to build the DI container.
 */
$containerBuilder = new ContainerBuilder();

/**
 * Includes the 'settings.php' file.
 *
 * Contains an array of configuration settings for the application.
 */
$settings = include __DIR__ . '/settings.php';

/**
 * Adds the definitions from 'dependecies.php' to the container builder.
 */
$containerBuilder->addDefinitions(__DIR__ . '/dependencies.php');

/**
 * Adds inline definitions directly to the container builder.
 *
 * Specifically, adds the 'settings' array to the DI container
 * under the key 'settings'.
 */
$containerBuilder->addDefinitions(
    [
    'settings' => $settings,
    ]
);

/**
 * Builds the DI container by calling the 'build' method on the
 * 'ContainerBuilder' instance.
 *
 * The 'build' method processes all the added definitions and
 * returns a fully configured DI container instance.
 */
return $containerBuilder->build();

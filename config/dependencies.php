<?php

/**
 * Dependency Injection Container Configuration
 *
 * This file configures a Dependency Injection (DI) container using PHP-DI.
 * It defines how various classes and services should be instantiated and
 * injected throughout the application.
 */

use Psr\Container\ContainerInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Returns an array that defines how different classes and services should
 * be instantiated an injected.
 *
 * @return Array Returns an array of settings for the DI container.
 */
return [
    /**
     * Defines how the 'PDO' class (for database connections) should be
     * instantiated.
     *
     * The anonymous function receives a 'ContainerInterface' instance to
     * access other configurations or settings.
     *
     * @return PDO Returns a PDO instance configured with database settings.
     */
    PDO::class => function (ContainerInterface $c) {
        // Retrieves the database settings from the container.
        $settings = $c->get('settings')['database'];
        // Creates and returns a new 'PDO' instance using the retrieved settings.
        return new PDO(
            $settings['dsn'],
            $settings['username'],
            $settings['password'],
            $settings['options']
        );
    },
    /**
     * Defines how the 'Environment' class from Twig should be instantiated.
     * This function is responsible for creating and configuring an instance
     * of the Twig Environment.
     * It uses the Twig loader for templates and sets cachnig and debug
     * options.
     *
     * @return Instance Returns a Twig Environment instance configured with
     * paths and settings.
     */
    Environment::class => function (ContainerInterface $c) {
        // Retrieve Twig settings from the settings array in the DI container.
        $twigSettings = $c->get('settings')['twig'];

        // Create a new Twig Loader to manage how Twig templates are loaded.
        // The loader is configured with a base path for views.
        // 'views_path' is defined in 'settings.php'.
        $loader = new FilesystemLoader($twigSettings['views_path']);
        // Here the same base view path is added with a namespace 'Header',
        // which can be used to organize templates.
        $loader->addPath($twigSettings['views_path'], 'Header');
        $loader->addPath($twigSettings['views_path'], 'HeaderViewItems');
        $loader->addPath($twigSettings['views_path'], 'HeaderAddItems');
        $loader->addPath($twigSettings['views_path'], 'Footer');

        // Return a new Twig Environment object, constructed with the loader
        // and an array of options.
        // Options include the path to the cache directory and whether to
        // enable debugging.
        return new Environment(
            $loader, [
            'cache' => $twigSettings['cache_path'],
            'debug' => $twigSettings['debug'],
            ]
        );
    },

    /**
     * Defines how the 'TrainingClass' model should be instantiated.
     *
     * Tells the DI container to create a new 'TrainingClass' instance,
     * injecting the PDO instance to its constructor.
     */
    TrainingClass::class => DI\create()->constructor(DI\get(PDO::class)),

    /**
     * Defines how the 'TrainingClassController' should be instantiated.
     *
     * Tells the DI container to create a new 'TrainingClassController instance,
     * injecting 'TrainingClass' instance into its constructor.
     */
    TrainingClassController::class => DI\create()->constructor(
        DI\get(TrainingClass::class),
        DI\get(Environment::class)
    ),

    /**
     * Defines how the 'User' model should be instantiated.
     *
     * Tells the DI container to create a new 'User' instance, injecting the PDO
     * instance to its constructor.
     */
    User::class => DI\create()->constructor(
        DI\get(PDO::class)
    ),

    /**
     * Defines how the 'UserController' should be instantiated.
     *
     * Tells the DI container to create a new 'UserController' instance,
     * injecting both the 'User' instance and the Twig 'Environment' instance
     * to its constructor.
     */
    UserController::class => DI\create()->constructor(
        DI\get(User::class),
        DI\get(Environment::class)
    ),

    /**
     * Defines how the 'Position' model should be instantiated.
     *
     * Tells the DI container to create a new 'Position' instance, injecting
     * the PDO instance to its constructor.
     */
    Position::class => DI\create()->constructor(
        DI\get(PDO::class)
    ),

    /**
     * Defines how the 'PositionController' should be instantiated.
     *
     * Tells the DI container to create a new 'PositionController' instance,
     * injecting both the 'Position' instance and the Twig 'Environment'
     * instance to its constructor.
     */
    PositionController::class => DI\create()->constructor(
        DI\get(Position::class),
        DI\get(Environment::class)
    ),

    /**
     * Defines how the 'Category' model should be instantiated.
     *
     * Tells the DI container to create a new 'Category' instance,
     * injecting the PDO instance to its constructor.
     */
    Category::class => DI\create()->constructor(
        DI\get(PDO::class)
    ),

    /**
     * Defines how the 'CategoryController' should be instantiated.
     *
     * Tells the DI container to create a new 'CategoryController'
     * instance, injecting both the 'Category' instance and the Twig
     * 'Environment' instance to its constructor.
     */
    CategoryController::class => DI\create()->constructor(
        DI\get(Category::class),
        DI\get(Environment::class)
    ),

    /**
     * Defines how the 'Technique' model should be instantiated.
     *
     * Tells the DI container to create a new 'Technique' instance,
     * injecting the PDO instance to its constructor.
     */
    Technique::class => DI\create()->constructor(
        DI\get(PDO::class)
    ),

    /**
     * Tells the DI container to create a new 'TechniqueController',
     * instance, injecting the
     * 'Technique' instance,
     * Twig 'Environment' instance,
     * 'Category' instance and
     * 'Position' instance to its constructor.
     */
    TechniqueController::class => DI\create()->constructor(
        DI\get(Technique::class),
        DI\get(Category::class),
        DI\get(Position::class),
        DI\get(TrainingClass::class),
        DI\get(Environment::class)
    ),

    /**
     * Tells the DI container to create a new 'MainViewController'
     * instance, injecting the
     * 'Technique' instance,
     * 'TrainingClass' instance,
     * Twig 'Environment' instance,
     * to its constructor.
     */
    MainViewController::class => DI\create()->constructor(
        DI\get(Technique::class),
        DI\get(TrainingClass::class),
        DI\get(Note::class),
        DI\get(Environment::class)
    ),

    /**
     * Defines how the 'Profile' model should be instantiated.
     * 
     * Tells the DI container to create a new 'Profile' instance,
     * injecting the PDO instance to its constructor.
     */
    Profile::class => DI\create()->constructor(
        DI\get(PDO::class)
    ),

    /** Tells the DI container to create a new 'ProfileController'
     * instance, injecting the
     * 'Profile' instance,
     * 'Technique' instance,
     * 'TrainingClass' instance,
     * Twig 'Environment' instance,
     * to its constructor.
     */
    ProfileController::class => DI\create()->constructor(
        DI\get(Profile::class),
        DI\get(Technique::class),
        DI\get(TrainingClass::class),
        DI\get(Environment::class)
    ),

    /**
     * Defines how the 'Note' model should be instantiated.
     * 
     * Tells the DI container to create a new 'Note' instance,
     * injecting the PDO instance to its constructor.
     */
    Note::class => DI\create()->constructor(
        DI\get(PDO::class)
    ),
];

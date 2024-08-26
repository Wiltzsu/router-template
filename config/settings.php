<?php

/**
 * This file is a configuration file that returns an array of
 * settings that are used to configure the application.
 *
 * @return Array
 */

return [
    'database' => [
        'dsn' => 'mysql:host=localhost;dbname=db',
        'username' => 'root',
        'password' => '',
        'options' => [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            /**
             * Disable emulated prepared statements, which means that
             * prepared statements are handled by the MySQL server
             * itself, which can provide better security and performance. 
             */
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
    'twig' => [
        'views_path' => __DIR__ . '/../resources/views',
        'cache_path' => __DIR__ . '/../cache',
        'debug' => true,
    ]
];

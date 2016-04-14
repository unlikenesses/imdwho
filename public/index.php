<?php
require __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($classname) {
    require ("../src/classes/" . $classname . ".php");
});

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();

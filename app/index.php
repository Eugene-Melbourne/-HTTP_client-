<?php

namespace App;

define('APP', 0);

// autoloader
spl_autoload_register(function (string $class_name) {
    $class_name = str_replace('App\\', '', $class_name);
    $file       = __DIR__ . '/' . str_replace('\\', '/', $class_name) . '.php';
    include $file;
});

use App\Exceptions\Handler\ExceptionHandler;
use App\Response;
use App\Router;

(new ExceptionHandler());

$result = (new Router)->execute();

(new Response)->returnSuccess($result);

<?php
session_start();

use \App\Controllers\Error;
use \App\Errors\RouterException;
use App\Core\Config;

//error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$config = new Config();

$route = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = 'Profile';
$methodName = 'index';

if (!empty($route[1])) {
    $controllerName = ucfirst($route[1]);
}

if (!empty($route[2])) {
    $methodName = $route[2];
}

$questionPos = strpos($controllerName, '?');
if ($questionPos) {
    $controllerName = substr($controllerName, 0, $questionPos);
}

$questionPos = strpos($methodName, '?');
if ($questionPos) {
    $methodName = substr($methodName, 0, $questionPos);
}

$classname = 'App\Controllers\\' . $controllerName;

try {
    if (class_exists($classname)) {
        $controller = new $classname();
    } else {
        throw new RouterException('Не найден класс ' . $classname, 404);
    }

    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        throw new RouterException('Не найден метод ' . $classname . '->' . $methodName . '()', 404);
    }
} catch (RouterException $e) {
    if ($controllerName != 'Favicon.ico') {
            $error = new Error($e->getMessage(), $e);
            header("HTTP/1.0 404 Not Found");
            $error->toErrorPage('Запрашиваемая Вами страница не найдена');
    }
}



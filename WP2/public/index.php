<?php
session_start();

define('APP_ROUTE', getcwd() . '/../app/');

require_once '../vendor/autoload.php';

$route = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = 'Profile';
$methodName = 'index';

if (!empty($route[1])) {
    $controllerName = ucfirst($route[1]);
}

if (!empty($route[2])) {
    $methodName = $route[2];
}
$classname = 'App\\Controllers\\' . $controllerName;
try {
    if (class_exists($classname)) {
        $controller = new $classname();
    } else {
        throw new Exception('Не найден класс ' . $controllerName);
    }

    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        throw new Exception('Не найден метод ' . $methodName);
    }
} catch (Exception $e) {
    echo $e->getLine() . '<br>';
    echo $e->getMessage();
}



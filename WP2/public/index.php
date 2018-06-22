<?php
session_start();

use \App\Core\Config;
use \App\Errors\Error;

error_reporting(E_ALL);

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
        throw new Exception('Не найден класс ' . $classname, 404);
    }

    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        throw new Exception('Не найден метод ' . $methodName, 404);
    }
} catch (Exception $e) {
    if ($controllerName != 'Favicon.ico') {
        switch ($e->getCode()) {
            case 404:
                $error = new Error($e->getMessage(), $e);
                $error->toErrorPage('Запрашиваемая Вами страница не найдена');
                break;
            default:
                $error = new Error('Ошибка. Обратитесь к администратору', $e);
                $error->toLog();
                $error->toJson();
        }
    }


}



<?php
session_start();


define('APP_ROUTE', getcwd() . '/../app/');

$route = explode('/', $_SERVER['REQUEST_URI']);

$controllerName = 'profile';
$methodName = 'index()';

echo '<pre>';
print_r($route);

if (!empty($route[1])) {
    $controllerName = $route[1];
}

if (!empty($route[2])) {
    $methodName = $route[2];
}
$classname = 'app\\Controllers\\' . $controllerName;
$filename = APP_ROUTE . 'Controllers/' . $controllerName . '.php';
try {
    if (file_exists($filename)) {
        require_once $filename;
    } else {
        throw new Exception('Файл контроллера ' . $controllerName . ' не найден');
    }

    if (class_exists($classname)) {
        $controller = new $classname();
    } else {
        throw new Exception('В файле ' . $filename . ' не найден класс ' . $controllerName);
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



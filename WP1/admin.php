<?php
require 'vendor/autoload.php';
require('db_login.php'); //переменные окружения
try { //готовим запросы на поиск покупателей и заказов
    $db = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $custSelect = $db->prepare('SELECT id, email, name, tel FROM customers');
    $custSelect->setFetchMode(PDO::FETCH_ASSOC);
    $orderSelect = $db->prepare('SELECT id, customer_id, street, house, corp, appt, floor, payment, callback, comment FROM orders');
    $orderSelect->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Ошибка на стадии подключения к БД и подготовки запросов. ' . $e->getMessage();
    die();
}

try {
    $custSelect->execute();
    $orderSelect->execute();
    $customers = $custSelect->fetchAll();
    $orders = $orderSelect->fetchAll();
} catch (PDOException $e) {
    echo 'Ошибка на стадии выполнения запросов. ' . $e->getMessage();
    die();
}

$loader = new Twig_Loader_Filesystem(getcwd());
$twig = new Twig_Environment($loader);


$data['customers'] = $customers;
$data['orders'] = $orders;

echo $twig->render('admin.twig', $data);

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная страница
    </title>
    <link rel="stylesheet" href="css/vendors.min.css">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <?php
    try {
        $db = new PDO('mysql:host=localhost;dbname=burger', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $custSelect = $db->prepare('SELECT id, email, name, tel FROM customers');
        $custSelect->setFetchMode(PDO::FETCH_ASSOC);
        $orderSelect = $db->prepare('SELECT id, customer_id, street, house, corp, appt, floor, payment, callback, comment FROM orders');
        $orderSelect->setFetchMode(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $response['success'] = 0;
        $response['message'] = 'Ошибка на стадии подключения к БД и подготовки запросов. ' . $e->getMessage();
    }

    try {
        $custSelect->execute();
        $orderSelect->execute();
        $customers = $custSelect->fetchAll();
        $orders = $orderSelect->fetchAll();
    } catch (PDOException $e) {
        $response['success'] = 0;
        $response['message'] = 'Ошибка на стадии выполнения запросов. ' . $e->getMessage();
    }
    ?>
</head>
<body>
<div class="wrapper">
    <div class="container">
        <div class="admin__header">
            <h1 class="admin__title">Административная панель сайта</h1>
        </div>
        <main class="admin__content">
            <div class="admin__customers">
                <h2 class="admin__section-title">Зарегистрированные покупатели</h2>
                <table class="admin__table">
                    <thead class="admin__table-header">
                        <tr class="admin__table-row">
                            <td class="admin__table-column admin__table-column--header">Номер</td>
                            <td class="admin__table-column admin__table-column--header">Email</td>
                            <td class="admin__table-column admin__table-column--header">Имя</td>
                            <td class="admin__table-column admin__table-column--header">Телефон</td>
                        </tr>
                    </thead>
                    <tbody class="admin__table-body">
                    <?php
                    foreach ($customers as $custRow) {
                        echo '<tr class="admin__table-row">';
                        echo ' <td class="admin__table-column">' . $custRow['id'] . '</td>';
                        echo ' <td class="admin__table-column">' . $custRow['email'] . '</td>';
                        echo ' <td class="admin__table-column">' . $custRow['name'] . '</td>';
                        echo ' <td class="admin__table-column">' . $custRow['tel'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="admin__orders">
                <h2 class="admin__section-title">Зарегистрированные заказы</h2>
                <table class="admin__table">
                    <thead class="admin__table-header">
                    <tr class="admin__table-row">
                        <td class="admin__table-column admin__table-column--header">Номер заказа</td>
                        <td class="admin__table-column admin__table-column--header">Номер покупателя</td>
                        <td class="admin__table-column admin__table-column--header">Улица</td>
                        <td class="admin__table-column admin__table-column--header">Дом</td>
                        <td class="admin__table-column admin__table-column--header">Корпус</td>
                        <td class="admin__table-column admin__table-column--header">Квартира</td>
                        <td class="admin__table-column admin__table-column--header">Этаж</td>
                        <td class="admin__table-column admin__table-column--header">Платеж</td>
                        <td class="admin__table-column admin__table-column--header">Обратный звонок</td>
                        <td class="admin__table-column admin__table-column--header">Комментарий</td>
                    </tr>
                    </thead>
                    <tbody class="admin__table-body">
                    <?php
                    foreach ($orders as $ordRow) {
                        echo '<tr class="admin__table-row">';
                        echo ' <td class="admin__table-column">' . $ordRow['id'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['customer_id'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['street'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['house'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['corp'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['appt'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['floor'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['payment'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['callback'] . '</td>';
                        echo ' <td class="admin__table-column">' . $ordRow['comment'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
</body>
</html>



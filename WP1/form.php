<?php
//Скрипт обработки формы заказа

//Считываем значения из элементов формы в переменные
$email = $_POST['email'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$street = $_POST['street'];
$house = $_POST['house'];
$corp = $_POST['corp'];
$appt = $_POST['appt'];
$floor = $_POST['floor'];
$payment = $_POST['payment'];
$comment = $_POST['comment'];

if ($_POST['callback']) {
    $callback = 0;
} else {
    $callback = 1;
}

//проверка наличия Email
if (empty($email)) {
    $response['success'] = 0;
    $response['message'] = 'Ошибка - не заполнен email';
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

//устанавливаем соединение с БД и подготавливаем запросы

try {
    $db = new PDO('mysql:host=localhost;dbname=burger', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $custSelect = $db->prepare('SELECT * FROM customers WHERE email = :email;');
    $custSelect->setFetchMode(PDO::FETCH_ASSOC);
    $custCreate =  $db->prepare('INSERT INTO customers (email, name, tel) VALUES (:email, :name, :tel)');
    $custUpdate = $db->prepare('UPDATE customers SET name = :name, tel = :tel WHERE id = :customer_id');
    $orderCreate = $db->prepare('INSERT INTO orders (customer_id, street, house, corp, appt, floor, payment, callback, comment) VALUES (:customer_id, :street, :house, :corp, :appt, :floor, :payment, :callback, :comment)');
    $orderSelect = $db->prepare('SELECT MAX(id) as maxid, COUNT(id) as total FROM orders WHERE customer_id = :customer_id');
    $orderSelect->setFetchMode(PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
    $response['success'] = 0;
    $response['message'] = 'Ошибка на стадии подключения к БД и подготовки запросов. ' . $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

//Ищем, есть ли в БД покупатель с указанным email
try {
    $custSelect->execute([':email' => $email]);
} catch (PDOException $e) {
    $response['success'] = 0;
    $response['message'] = 'Ошибка на стадии первого поиска покупателя с данным email ' . $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

$custData = $custSelect->fetchAll();

switch ($custSelect->rowCount()) {
    case 0: //если покупателя нет, создаем его, зачем получаем id вновь созданного покупателя
        try {
            $custCreate->execute([':email' => $email, ':name' => $name, ':tel' => $tel]);
            $custSelect->execute([':email' => $email]);
        } catch (PDOException $e) {
            $response['success'] = 0;
            $response['message'] = 'Ошибка на стадии создания нового пользователя и чтения его id. ' . $e->getMessage();
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }
        $custData = $custSelect->fetchAll();
        $id = $custData[0]['id'];
        break;
    case 1: //если покупатель найден, считываем его id и обновляем на всякий случай имя и телефон
        $id = $custData[0]['id'];
        try {
            $custUpdate->execute([':customer_id' => $id, ':name' => $name, ':tel' => $tel]);
        } catch (PDOException $e) {
            $response['success'] = 0;
            $response['message'] = 'Ошибка на стадии обновления данных существуюшего пользователя. ' .  $e->getMessage();
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            die();
        }
        break;
    default: //если найдено более 1 покупателя, то это ошибка:
        $response['success'] = 0;
        $response['message'] =  'Ошибка - найдено более 1 покупателя с данным email';
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
}

//Создаем новый заказ, получаем номер созданного заказа и сколько всего заказов сделал пользователь
try {
    $orderCreate->execute([':customer_id' => $id, ':street' => $street, ':house' => $house, ':corp' => $corp, ':appt' => $appt, ':floor' => $floor, ':payment' => $payment, ':callback' => $callback, ':comment' => $comment]);
    $orderSelect->execute([':customer_id' => $id]);
} catch (PDOException $e) {
    $response['success'] = 0;
    $response['message'] = 'Ошибка на стадии создания нового заказа. ' . $e->getMessage();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    die();
}

//Готовим письмо и сохраняем его в файл
$orders = $orderSelect->fetchAll();

$mailTitle = 'Заказ №' . $orders[0]['maxid'] . ' от ' . date('d.m.Y H-i-s');
$mailText = 'Заказ №' . $orders[0]['maxid'] . ': DarkBeefBurger 1шт 500р.' . PHP_EOL . 'Ваш заказ будет доставлен по адресу: ул. ' . $street . ', дом ' . $house . ', кв. ' . $appt . '.' . PHP_EOL . 'Спасибо, ' . $name . ', это Ваш ' . $orders[0]['total'] . ' заказ.';

$filename = 'letters/' . $mailTitle . '.txt';
file_put_contents($filename, $mailText);

//Пробуем отправить письмо
$isSent = mail($email, $mailTitle, $mailText);

//Готовим ответ скрипта
$response['success'] = 1;
if ($isSent){
    $response['message'] = 'Заказ успешно создан, письмо отправлено';
} else {
    $response['message'] = 'Заказ успешно создан, письмо не отправлено';
}
$response['orderNo'] = $orders[0]['maxid'];
$response['total'] = $orders[0]['total'];

echo json_encode($response, JSON_UNESCAPED_UNICODE);

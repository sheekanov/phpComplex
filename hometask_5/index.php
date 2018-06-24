<?php
require_once 'vendor/autoload.php';
require_once 'src/functions.php';

echo '<b>Задание1 </b>';
$sendTo = ['sheekanov@gmail.com' => 'Evgeny Shikanov'];
$result = task1($sendTo);
echo '<br>';
echo 'Выбранные адресаты:';
foreach ($sendTo as $key => $value) {
    echo $key . '; ';
}

if ($result) {
    $message = 'Сообщение отправлено';
}

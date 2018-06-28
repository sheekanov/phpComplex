<?php
require_once 'vendor/autoload.php';
require_once 'src/functions.php';

echo '<b>Задание 1</b>';
$sendTo = ['sheekanov@gmail.com' => 'Evgeny Shikanov'];
$result = task1($sendTo);
echo '<br>';
echo 'Выбранные адресаты:';
foreach ($sendTo as $key => $value) {
    echo $key . '; ';
}
echo '<br>';
if ($result) {
    echo 'Сообщение отправлено';
}
echo '<br>';
echo '<br>';

echo '<b>Задание 3</b>';
echo '<br>';
task3(getcwd() . '/originalPic.jpg', getcwd() . '/resultPic.jpg');
echo 'Картинка originalPic.jpg сохранена как resultPic.jpg:';
echo '<br>';
echo '<img src="resultPic.jpg">';

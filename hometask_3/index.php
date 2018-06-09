<?php

require ('src/functions.php');

echo '<i>Задание 1</i>' . '<br>';
echo 'Выводим информацию из файла data.xml в понятном курьеру виде' . '<br><br>';
task1('data.xml');
echo '<br><br>';

echo '<i>Задание 2</i>' . '<br>';
echo 'Создаем массив, записываем его в output.json. Считываем данные из файла, случайно выбираем, изменить ли их, и записываем в output2.json. Сравниваем output.json и output2.json' . '<br><br>';
task2();
echo '<br><br>';

echo '<i>Задание 3</i>' . '<br>';
echo 'Создаем массив из 50 случайных чисел от 1 до 100, сохраняем его в numbers.csv. Затем считываем данные из этого файла и суммируем только четные числа. Результат: ' . '<br><br>';
echo task3();
echo '<br><br>';

echo '<i>Задание 4</i>' . '<br>';
echo 'Запрашиваем json данные из url, выводим поля pageid и title: ' . '<br><br>';
$res =  task4();
echo 'pageid: ' . $res['pageid'] . '<br>';
echo 'title: ' . $res['title'] . '<br>';
echo '<br><br>';
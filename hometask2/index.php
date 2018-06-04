<?php
require('src/functions.php');

echo 'Задание 1' . '<br>';
echo '1.1 Выводим массив строк "раз", "два", "три" в трех параграфах';
task1(['раз', 'два', 'три']);
echo '1.2 Возвращаем результат в виде одной строки: <br>';
echo task1(['раз', 'два', 'три'], 1);

echo '<br><br>';

echo 'Задание 2' . '<br>';
echo 'вызываем task2(\'+\',1,2,3,4):'. '<br>';
echo task2('+',1,2,3,4);

echo '<br><br>';

echo 'Задание 3' . '<br>';
echo 'Cтроим таблицу умножения 3 *5:'. '<br>';
task3(3,5);

echo '<br><br>';

echo 'Задание 4' . '<br>';
task4();

echo '<br><br>';

echo 'Задание 5' . '<br>';
task5();

echo '<br><br>';

echo 'Задание 6' . '<br>';
echo '6.1 Создаем файл test.txt и пишем в него "Hello again!"'. '<br>';
task6Create('test.txt');
echo '6.2 Выводим содержимаое test.txt на экран: ' . '<br>';
task6Read('test.txt');


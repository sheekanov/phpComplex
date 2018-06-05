<?php
// Домашнее задание №1

//Задание #1

echo '<b>' . 'Задание #1' . '</b><br><br>';
$name = 'Евгений';
$age = '29';
echo "Меня зовут: $name" . '<br>';
echo "Мне $age лет" . '<br>';
echo '"!|\\/\'"\\' . '<br><br>';

//Задание №2

echo '<b>' . 'Задание #2' . '</b><br><br>';
const PICS_TOTAL = 80;
const PICS_FELTPEN = 23;
const PICS_PENCIL = 40;
const PICS_COLORS = PICS_TOTAL - PICS_FELTPEN - PICS_PENCIL;
echo 'Рисунков всего: ' . PICS_TOTAL . '<br>';
echo 'Рисунков фломастерамм: ' . PICS_FELTPEN . '<br>';
echo 'Рисунков карандашами: ' . PICS_PENCIL . '<br>';
echo 'Рисунков красками: ' . PICS_COLORS . '<br><br>';

//Задание №3

echo '<b>' . 'Задание #3' . '</b><br><br>';
$age = rand(-10, 100);
echo "Ваш возраст - $age" . '<br>';
if ($age >= 18 && $age <= 65) {
    echo 'Вам еще работать и работать';
} elseif ($age > 65) {
    echo 'Вам пора на пенсию';
} elseif ($age >= 1 && $age <= 17) {
    echo 'Вам еще рано работать';
} else {
    echo 'Неизвестный возраст';
}

echo '<br><br>';

//Задание №4

echo '<b>' . 'Задание #4' . '</b><br><br>';
$day = rand(-2, 8);
echo 'День номер - ' . $day . '<br>';
switch ($day) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo 'Это рабочий день';
        break;
    case 6:
    case 7:
        echo 'Это выходной день';
        break;
    default:
        echo 'Неизвестный день';
}

echo '<br><br>';

//Задание №5

echo '<b>' . 'Задание #5' . '</b><br><br>';
$bmw['x5'] = array('model' => 'X5', 'speed' => 120, 'doors' => 5, 'year' => 2015);
$toyota['tlc'] = array('model' => 'Land Cruiser', 'speed' => 150, 'doors' => '5', 'year' => 2010);
$opel['astra'] = array('model' => 'Astra', 'speed' => 100, 'doors' => 5, 'year' => 2018);

$cars['bmw'] = $bmw;
$cars['toyota'] = $toyota;
$cars['opel'] = $opel;

foreach ($cars as $markKey => $marks) {
    echo 'CAR ' . $markKey . '<br>';
    foreach ($marks AS $carKey => $carData){
        echo $carData['name'] . ' ' . $carData['model'] . ' ' . $carData['speed'] . ' ' . $carData['doors'] . ' ' . $carData['year'] . '<br><br>';
    }
}

//Задание №6

echo '<b>' . 'Задание #6' . '</b><br><br>';

$rows = 10;
$cols = 10;

echo '<table>';

//заголовок таблицы - "номера колонок"
echo '<thead>';
echo '<tr>';
echo  '<td style = "font-weight: bold;">N</td>';
for ($j = 1; $j <= $cols; $j++) {
    echo '<td style = "font-weight: bold;">' . $j . '</td>';
}
echo '</tr>';
echo '</thead>';

//тело таблицы - "номера строк" и в ячейках - результат перемножений номеров строк и колонок.
echo '<tbody>';
for ($i = 1; $i <= $rows; $i++) {
    echo '<tr><td style="font-weight: bold;">' . $i . '</td>';
    for ($j = 1; $j <= $cols; $j++) {
        if ($i % 2 == 0 && $j % 2 ==0) {
            echo '<td>(' . $i*$j . ')</td>';
        } elseif ($i % 2 != 0 && $j % 2 != 0) {
            echo '<td>[' . $i*$j . ']</td>';
        } else {
            echo '<td>' . $i*$j . '</td>';
        }
    }
    echo '</tr>';
}
echo'</tbody>';

echo '</table>';

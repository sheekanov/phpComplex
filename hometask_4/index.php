<?php
require 'src/tariffStudent.class.php';
require 'src/tariffBase.class.php';
require 'src/tariffHourly.class.php';
require 'src/tariffDaily.class.php';

use carsharing\TariffBase;
use carsharing\TariffHourly;
use carsharing\TariffDaily;
use carsharing\TariffStudent;

echo '<b>Общая информация</b>';
echo '<br>';
echo 'Классы тарифов: TariffBase, TariffHourly, TariffDaily, TariffStudent';
echo '<br>';
echo 'Конструктор класса: new TariffName(float $distance, float $hours, int $age, int ... $services)';
echo '<br>';
echo 'Время задается в часах. Допуслуги подаются в конструктор в виде ключей 1,2.';
echo '<br>';
echo 'Список доступных в тарифе услуг и их ключей можно получить (в виде массива) статическим методом TariffName::getAllowedServices()';
echo '<br>';
echo 'Расчет стоимости поездки производится методом TariffName->calcCost()';
echo '<br>';
echo 'Информацию о других методах работы с тарифами можно посмотреть в интерфейсе ITariff (src/ITariff.interface.php)';
echo '<br>';
echo '<br>';

echo '<b>Базовый тариф</b>';
echo '<br>';
echo 'Расчет стоимости поездки для водителя 20лет, 10км, 10ч, с услугой "GPS в салон".';
echo '<br>';
echo 'TariffBase(10, 10, 20, 1)->calcCost() = ';
$base = new TariffBase(10, 10, 20, 1);
echo $base->calcCost();
echo '<br>';
echo '<br>';

echo '<b>Почасовой тариф</b>';
echo '<br>';
echo 'Расчет стоимости поездки для водителя 20лет, 10км, 9.5ч, с услугами "GPS в салон" и "Дополнительный водитель".';
echo '<br>';
echo 'TariffHourly(10, 9.5, 20, 1, 2)->calcCost() = ';
$hourly = new TariffHourly(10, 9.5, 20, 1, 2);
echo $hourly->calcCost();
echo '<br>';
echo '<br>';

echo '<b>Суточный тариф</b>';
echo '<br>';
echo 'Расчет стоимости поездки для водителя 20лет, 10км, 48.4ч, с услугами "GPS в салон" и "Дополнительный водитель".';
echo '<br>';
echo 'TariffDaily(10, 48.4, 20, 1, 2)->calcCost() = ';
$dayly = new TariffDaily(10, 48.4, 20, 1, 2);
echo $dayly->calcCost();
echo '<br>';
echo '<br>';

echo '<b>Студенческий тариф</b>';
echo '<br>';
echo 'Расчет стоимости поездки для водителя 20лет, 10км, 10ч, с услугой "GPS в салон".';
echo '<br>';
echo 'TariffStudent(10, 10, 20, 1)->calcCost() = ';
$student = new TariffStudent(10, 10, 20, 1);
echo $student->calcCost();
echo '<br>';
echo '<br>';
<?php
namespace carsharing;

interface ITariff
{
    /**
     * Создает экземпляр тарифа
     * Параметры:
     * float $distance - расстояние в км
     * float $hours - время поездки в часах
     * int $age - возраст в годах
     * int ... $services - ключи активируемых допусгул (1,2)
     */
    public function __construct(float $distance, float $hours, int $age, int ... $services);

    /**
     * Расчитывает стоимость поездки, возвращает число
     */
    public function calcCost();

    /**
     * Устанавливает возраст в годах
     */
    public function setAge(int $age);

    /**
     * Получает возраст в годах
     */
    public function getAge();

    /**
     * Устанавливает время поездки в часах
     */
    public function setTime(float $hours);

    /**
     * Возвращает оплачиваемое время в часах согласно тарифу (т.е. с учетом свойственных тарифу округлений)
     */
    public function getTime();

    /**
     * Устанавливает расстояние поездки в км
     */
    public function setDistance(float $distance);

    /**
     * Получает расстояние поездки в км
     */
    public function getDistance();

    /**
     * Получает массив с ключами и названиями разрешенных для тарифа доп. услуг.
     */
    public static function getAllowedServices();

    /**
     * Подключает услуги, принимает на вход массив с ключами услуг
     */
    public function enableServices(array $services);

    /**
     * Отключает услуги, принимает на вход массив с ключами услуг
     */
    public function disableServices(array $services);

    /**
     * Получает массив с ключами и названиями подключенных услуг
     */
    public function getEnabledServices();
}

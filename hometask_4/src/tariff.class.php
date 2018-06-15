<?php
namespace carsharing;

require_once 'ITariff.interface.php';
require_once 'additionalServices.trait.php';

abstract class Tariff implements ITariff
{
    use AdditionalServices;

    public const MIN_AGE = 18;
    public const MAX_AGE = 65;
    public const PRICE_KM = 1;
    public const PRICE_HOUR = 1;

    protected static $servicesAllowed = [1,2];

    protected $distance;
    protected $time;
    private $age;

    public function __construct(float $distance, float $hours, int $age, int ...$services)
    {
        $this->setTime($hours);
        $this->distance = $distance;
        $this->setAge($age);
        $this->enableServices($services);
    }

    public function setAge(int $age)
    {
        if ($age < $this::MIN_AGE || $age > $this::MAX_AGE) {
            throw new \Exception('По правилам тарифа возраст должен быть от ' . $this::MIN_AGE . ' до ' . $this::MAX_AGE . ' лет');
        } else {
            $this->age = $age;
        }
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setTime(float $hours)
    {
        $this->time = $hours;
    }


    public function getTime()
    {
        return $this->time;
    }


    public function getDistance()
    {
        return $this->distance;
    }


    public function setDistance(float $distance)
    {
        $this->distance = $distance;
    }

    protected function calcAgeMultiplier()
    {
        if ($this->age >= 18 && $this->age < 21) {
            return 1.1;
        } else {
            return 1;
        }
    }

    public function calcCost()
    {
        $distance = $this->distance;
        $time = $this->time;
        $ageMultiplier = $this->calcAgeMultiplier();

        $cost = ($distance * $this::PRICE_KM + $time * $this::PRICE_HOUR) * $ageMultiplier;

        return $cost;
    }
}

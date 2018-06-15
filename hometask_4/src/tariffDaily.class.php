<?php
namespace carsharing;

require_once 'tariff.class.php';
require_once 'gpsService.trait.php';
require_once 'additionalDriverService.trait.php';

class TariffDaily extends Tariff
{
    use GpsService, AdditionalDriverService;

    public const PRICE_KM = 1;
    public const PRICE_HOUR = 1000/24;

    public function setTime($hours)
    {
        $fullDays = (int)($hours/24);
        $overHours = $hours - 24 * $fullDays;
        if ($fullDays == 0) {
            $hours = 24;
        } elseif ($overHours < 0.5) {
            $hours = $fullDays * 24;
        } else {
            $hours = ($fullDays + 1) * 24;
        }
        parent::setTime($hours);
    }

    public function calcCost()
    {
        $cost =  parent::calcCost();

        if (!is_null($cost)) {
            foreach ($this->getEnabledServices() as $serviceKey => $serviceName) {
                switch ($serviceKey) {
                    case 1:
                        $cost += $this->addGps($this->getTime(), $this->gpsHourPrice);
                        break;
                    case 2:
                        $cost += $this->addDriver($this->addDriverPrice);
                        break;
                }
            }
        }

        return $cost;
    }
}

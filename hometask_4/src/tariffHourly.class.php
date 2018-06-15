<?php
namespace carsharing;

require_once 'tariff.class.php';
require_once 'gpsService.trait.php';
require_once 'additionalDriverService.trait.php';

class TariffHourly extends Tariff
{
    use GpsService, AdditionalDriverService;

    public const PRICE_KM = 0;
    public const PRICE_HOUR = 200;

    public function setTime($hours)
    {
        $hours = ceil($hours);
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

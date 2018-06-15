<?php
namespace carsharing;

require_once 'tariff.class.php';
require_once 'gpsService.trait.php';

class TariffStudent extends Tariff
{
    use GpsService;

    protected static $servicesAllowed = [1];
    public const MAX_AGE = 25;
    public const PRICE_KM = 4;
    public const PRICE_HOUR = 60;

    protected function calcAgeMultiplier()
    {
        return 1;
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
                }
            }
        }

        return $cost;
    }
}

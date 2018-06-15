<?php
namespace carsharing;

require_once 'tariff.class.php';
require_once 'gpsService.trait.php';

class TariffBase extends Tariff
{
    use GpsService;

    public const PRICE_KM = 10;
    public const PRICE_HOUR = 180;
    protected static $servicesAllowed = [1];

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

<?php
namespace carsharing;

trait AdditionalServices
{
    private $servicesEnabled = [];
    private static $AllServicesList = array('1' => 'GPS в салон', '2' => 'Дополнительный водитель');

    public function enableServices(array $services)
    {
        foreach ($services as $service) {
            if (!in_array($service, $this->servicesEnabled)) {
                if (in_array($service, static::$servicesAllowed)) {
                    $this->servicesEnabled[] = $service;
                } else {
                    throw new \Exception(' Услуга ' . $service  . ' недоступна на данном тарифе');
                }
            }
        }
    }

    public function disableServices(array $services)
    {
        $this->servicesEnabled = array_diff($this->servicesEnabled, $services);
    }

    public function getEnabledServices()
    {
        foreach ($this->servicesEnabled as $service) {
            $response[$service] = self::$AllServicesList[$service] ;
        }
        return $response;
    }

    static public function getAllowedServices()
    {
        foreach (static::$servicesAllowed as $service) {
            $response[$service] = self::$AllServicesList[$service];
        }
        return $response;
    }
}

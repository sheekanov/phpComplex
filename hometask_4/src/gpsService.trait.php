<?php
namespace carsharing;

trait GpsService
{
    protected $gpsHourPrice = 15;
    protected function addGps($hours, $gpsHourPrice)
    {
        $time = ceil($hours);
        $cost = $time * $gpsHourPrice;
        return $cost;
    }
}

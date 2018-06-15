<?php
namespace carsharing;

trait AdditionalDriverService
{
    protected $addDriverPrice = 100;
    public function addDriver($addDriverPrice)
    {
        $cost = $addDriverPrice;
        return $cost;
    }
}

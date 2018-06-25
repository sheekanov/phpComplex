<?php
namespace App\Core;

class Viewer
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}

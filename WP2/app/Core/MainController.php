<?php
namespace app\Core;

require_once 'View.php';

class MainController
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}

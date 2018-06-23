<?php
namespace App\Core;

use App\Models\User;

class Viewer
{

    protected $view;
    protected $user;

    public function __construct()
    {
        $this->view = new View();
    }
}

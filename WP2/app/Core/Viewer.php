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

    protected function checkUserSession()
    {
        if (isset($_SESSION['userid'])) {
            if (User::isIdExist($_SESSION['userid'])) {
                return true;
            } else {
                return false;
            }
        }
    }
}

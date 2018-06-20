<?php
namespace App\Core;

use App\Models\User;

class MainController
{

    protected $view;
    protected $user;

    public function __construct()
    {
        $this->view = new View();
        $this->user = new User();
    }

    protected function checkUserSession()
    {
        if (isset($_SESSION['userid'])) {
            if ($this->user->setUserId($_SESSION['userid'])) {
                return true;
            } else {
                return false;
            }
        }
    }
}

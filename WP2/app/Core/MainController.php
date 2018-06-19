<?php
namespace app\Core;

use app\Models\User;

require_once __DIR__ . '/../Models/User.php';
require_once 'View.php';

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
            if ($this->user->isExist($_SESSION['userid'])) {
                $this->user->setUserId($_SESSION['userid']);
                return true;
            } else {
                return false;
            }
        }
    }
}

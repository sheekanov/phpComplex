<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;

class Users extends MainController
{
    public $user;

    public function __construct()
    {
        parent::__construct();

        $sessionCheck = $this->checkUserSession();

        if ($sessionCheck) {
            $this->user = User::getUserById($_SESSION['userid']);
        } else {
            header("Location: /login");
        }
    }

    public function index()
    {
        $sort = $_GET['sort'];

        $data = User::getAllUsers($sort);

        $this->view->render('users', $data);
    }

    public function showProfile()
    {
        $fileId = $_GET['id'];
        $user = User::getUserById($fileId);
        $data=['user' => $user];
        $this->view->render('showProfile', $data);
    }

}
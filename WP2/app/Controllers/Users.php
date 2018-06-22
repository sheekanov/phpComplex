<?php
namespace App\Controllers;

use App\Core\Viewer;
use App\Models\User;

class Users extends Viewer
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
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $data = User::getAllUsers($sort);
        } else {
            $data = User::getAllUsers();
        }


        $this->view->render('users', $data);
    }

    public function showProfile()
    {
        $userId = $_GET['id'];
        $user = User::getUserById($userId);

        if (!is_null($user)) {
            $data=['user' => $user];

        } else {
            $data = ['user' => new User('Профиль не найден','0','Пользователь с Id=' .$userId . ' не существует' )];
        }
        $this->view->render('showProfile', $data);
    }

}
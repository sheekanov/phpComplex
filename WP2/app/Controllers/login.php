<?php
namespace app\Controllers;

require_once __DIR__ .  '/../Core/MainController.php';
require_once __DIR__ . '/../Models/User.php';

use app\Core\MainController;
use app\Models\User;

class login extends MainController
{
    protected $user;
    protected $loginSuccess;
    protected $message;

    public function __construct()
    {
        parent::__construct();

        $loginName = $_POST['loginName'];
        $registerName = $_POST['registerName'];
        $registerAge = (int)$_POST['registerAge'];
        $user = new User();

        if (!empty($loginName)) {
            $userid = $user->getIdByName($loginName);
            if (!empty($userid)) {
                $_SESSION['userid'] = $userid;
                header("Location: /profile");
            } else {
                $this->message = 'Пользователь c таким именем не существует. Попробуйте снова или зарегестрируйте нового пользователя';
                $this->view->render('login', ['message' => $this->message]);
            }
        } elseif (!empty($registerName)) {
            $userid = $user->createUser($registerName, $registerAge);
            $_SESSION['userid'] = $userid;
            mkdir('uploads/user' . $userid . '/userpic/',0777,true);
            mkdir('uploads/user' . $userid . '/files/',0777,true);
            header("Location: /profile");
        } else {
            $this->view->render('login', []);
        }
    }

    public function index()
    {
        echo 'lol';
    }

}

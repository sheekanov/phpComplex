<?php
namespace App\Controllers;

use App\Core\MainController;

class Login extends MainController
{
    public function index()
    {
        $this->view->render('login', []);
    }

    public function send()
    {
        $name = $_POST['loginName'];
        $userid = $this->user->getIdByName($name);

        if (!empty($userid)) {
            $_SESSION['userid'] = $userid;
            header("Location: /profile");
        } else {
            $message  = 'Пользователь c таким именем не существует. Попробуйте снова или зарегестрируйте нового пользователя';
            $this->view->render('login', ['message' => $message]);
        }
    }

    public function create()
    {
        $name = $_POST['registerName'];
        $age = $_POST['registerAge'];
        $response['success'] = 1;

        if (empty($name)) {
            $response['success'] = 0;
            $response['message'] = 'Не указано имя пользователя';
        }

        if ($this->user->isNameExist($name)) {
            $response['success'] = 0;
            $response['message'] = 'Пользователь с именем ' .$name . '  существует';
        }

        if ($response['success']) {
            $userid = $this->user->createUser($name, $age);
            $_SESSION['userid'] = $userid;
            mkdir('uploads/user' . $userid . '/userpic/', 0777, true);
            mkdir('uploads/user' . $userid . '/files/', 0777, true);
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function logOut()
    {
        unset($_SESSION['userid']);
        header("Location: /login");
    }
}

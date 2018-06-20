<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;

class Login extends MainController
{
    public function index()
    {
        $this->view->render('login', []);
    }

    public function send()
    {
        $name = $_POST['loginName'];
        $userid = User::getUserByName($name)->getId();

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

        if (User::isNameExist($name)) {
            $response['success'] = 0;
            $response['message'] = 'Пользователь с именем ' .$name . '  существует';
        }

        if ($response['success']) {
            $user = new User($name, $age);
            $user->save();
            $_SESSION['userid'] = $user->getId();
            mkdir('uploads/user' . $user->getId() . '/userpic/', 0777, true);
            mkdir('uploads/user' . $user->getId() . '/files/', 0777, true);
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function logOut()
    {
        unset($_SESSION['userid']);
        header("Location: /login");
    }
}

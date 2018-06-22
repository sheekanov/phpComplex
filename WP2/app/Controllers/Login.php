<?php
namespace App\Controllers;

use App\Core\Config;
use App\Core\Viewer;
use App\Models\User;

class Login extends Viewer
{
    public function index()
    {
        $this->view->render('login', ['message' => '']);
    }

    public function send()
    {
        $name = $_POST['loginName'];
        $user = User::getUserByName($name);

        if (!is_null($user)) {
            $_SESSION['userid'] = $user->getId();
            header("Location: /profile");
        } else {
            $message  = 'Пользователь c таким именем не существует. Попробуйте снова или зарегестрируйте нового пользователя';
            $this->view->render('login', ['message' => $message]);
        }
    }

    public function create()
    {
        $name = $_POST['registerName'];
        $age = (int)$_POST['registerAge'];

        $name = strip_tags($name);
        $name = htmlspecialchars($name, ENT_QUOTES);

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
            mkdir(getcwd() . Config::UPLOAD_DIR . '\user' . $user->getId() . '\userpic\\', 0777, true);
            mkdir(getcwd() . Config::UPLOAD_DIR . '\user' . $user->getId() . '\files\\', 0777, true);
        }

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function logOut()
    {
        unset($_SESSION['userid']);
        header("Location: /login");
    }
}

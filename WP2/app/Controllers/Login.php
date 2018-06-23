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
        $pass = $_POST['loginPass'];
        $user = null;

        try {
            $user = User::getUserByName($name);

            if (!is_null($user)) {
                if ($user->password == crypt($pass, 'loft')) {
                    $_SESSION['userid'] = $user->getId();
                    header("Location: /profile");
                } else {
                    $message  = 'Введен неправильный пароль. Попробуйте снова или зарегестрируйте нового пользователя';
                    $this->view->render('login', ['message' => $message]);
                }
            } else {
                $message  = 'Пользователь не существует. Попробуйте снова или зарегестрируйте нового пользователя';
                $this->view->render('login', ['message' => $message]);
            }
        } catch (\PDOException $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $this->view->render('login', ['message' => $error->userMessage]);
        }
    }

    public function create()
    {
        $name = $_POST['registerName'];
        $pass = $_POST['registerPass'];
        $age = (int)$_POST['registerAge'];

        $response['success'] = 1;

        if (!ctype_alnum($pass)) {
            $response['success'] = 0;
            $response['message'] = 'Пароль должен содержать только английские буквы и цифры';
        }

        if (!ctype_alnum($name)) {
            $response['success'] = 0;
            $response['message'] = 'Имя должно содержать только английские буквы и цифры';
        }

        $name = strip_tags($name);
        $name = htmlspecialchars($name, ENT_QUOTES);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass, ENT_QUOTES);

        if (strlen($pass) < 5) {
            $response['success'] = 0;
            $response['message'] = 'Пароль должен содержать не менее 5 символов';
        }

        if (empty($name)) {
            $response['success'] = 0;
            $response['message'] = 'Не указано имя пользователя';
        }

        try {
            if (User::isNameExist($name)) {
                $response['success'] = 0;
                $response['message'] = 'Пользователь с именем ' .$name . '  существует';
            }

            if ($response['success']) {
                $user = new User($name, $age, crypt($pass, 'loft'));
                $user->save();
                $_SESSION['userid'] = $user->getId();
                mkdir(getcwd() . Config::UPLOAD_DIR . '\user' . $user->getId() . '\userpic\\', 0777, true);
                mkdir(getcwd() . Config::UPLOAD_DIR . '\user' . $user->getId() . '\files\\', 0777, true);
            }

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        } catch (\PDOException $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toJson();
        }
    }

    public function logOut()
    {
        unset($_SESSION['userid']);
        header("Location: /login");
    }
}

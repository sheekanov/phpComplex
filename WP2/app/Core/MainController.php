<?php
namespace App\Core;

use App\Errors\Error;
use App\Models\User;

//класс для наследования - при инициализации проверяет авторизацию пользователя
class MainController extends Viewer
{
    public $user;

    public function __construct()
    {
        parent::__construct();

        try {
            $sessionCheck = $this->checkUserSession();

            if ($sessionCheck) {
                $this->user = User::getUserById($_SESSION['userid']);
            } else {
                header("Location: /login");
            }
        } catch (\Exception $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору', $e);
            $error->toLog();
            $error ->toErrorPage('Ой');
        }
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
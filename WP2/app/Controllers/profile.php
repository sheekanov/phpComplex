<?php
namespace app\Controllers;

require_once __DIR__ .  '/../Core/MainController.php';
require_once __DIR__ . '/../Models/User.php';

use app\Core\MainController;
use app\Models\User;

class profile extends MainController
{
    public function __construct()
    {
        parent::__construct();

        $sessionCheck = $this->checkUserSession();

        if (!$sessionCheck) {
            header("Location: /login");
        }
    }

    public function index()
    {
        $data = $this->user->getUserData();
        $this->view->render('profile', $data);
    }

    public function update()
    {
        $message = '';
        $referRoute = explode('/', $_SERVER['HTTP_REFERER']);

        if (array_pop($referRoute) == 'update') {
            $params['name'] = $_POST['changeName'];
            $params['age'] = (int)$_POST['changeAge'];
            $params['about'] = $_POST['changeAbout'];
            $file = $_FILES['changeUserpic'];
            $currentUserData = $this->user->getUserData();
            $success = 1;

            if (empty($params['name'])) {
                $success = 0;
                $message = 'Имя пользователя должно быть указано';
            }

            if ($this->user->isNameExist($params['name']) && $params['name'] != $currentUserData['name']) {
                $success = 0;
                $message = 'Пользователь с таким именем уже существует';
            }

            if (!empty($file['name']) && $success) {
                $params['photo'] = '\uploads\user' . $this->user->getUserId() . '\userpic\\' . $file['name'];
                move_uploaded_file($file['tmp_name'], getcwd() . $params['photo']);
            }

            if ($success) {
                $this->user->updateUserData($params);
                $message = 'Данные сохранены';
            }
        }

        $data = $this->user->getUserData();
        $data['message'] =$message;
        $this->view->render('profilechange', $data);
    }
}

<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;

class Profile extends MainController
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
        $data = array('name' => $this->user->name, 'age' => $this->user->age, 'about' => $this->user->about, 'photo' => $this->user->photo);
        $this->view->render('profile', $data);
    }

    public function update()
    {
        $message = '';
        $referRoute = explode('/', $_SERVER['HTTP_REFERER']);

        if (array_pop($referRoute) == 'update') {
            $newName = $_POST['changeName'];
            $newAge = (int)$_POST['changeAge'];
            $newAbout = $_POST['changeAbout'];
            $file = $_FILES['changeUserpic'];
            $success = 1;

            if (empty($newName)) {
                $success = 0;
                $message = 'Имя пользователя должно быть указано';
            }

            if (User::isNameExist($newName) && $newName != $this->user->name) {
                $success = 0;
                $message = 'Пользователь с таким именем уже существует';
            }

            if (!empty($file['name']) && $success) {
                $newPhoto = '\uploads\user' . $this->user->getId() . '\userpic\\' . $file['name'];
                move_uploaded_file($file['tmp_name'], getcwd() . $newPhoto);
            } else {
                $newPhoto = $this->user->photo;
            }

            if ($success) {
                $this->user->name = $newName;
                $this->user->age = $newAge;
                $this->user->about = $newAbout;
                $this->user->photo = $newPhoto;
                $this->user->save();
                $message = 'Данные сохранены';
            }
        }

        $data = array('name' => $this->user->name, 'age' => $this->user->age, 'about' => $this->user->about, 'photo' => $this->user->photo);
        $data['message'] =$message;
        $this->view->render('profilechange', $data);
    }
}

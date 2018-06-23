<?php
namespace App\Controllers;

use App\Core\Config;
use App\Core\MainController;
use App\Models\User;

class Profile extends MainController
{
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
            $success = 1;

            $newName = $_POST['changeName'];
            $newName = strip_tags($newName);
            $newName = htmlspecialchars($newName, ENT_QUOTES);

            $newAge = (int)$_POST['changeAge'];

            $newAbout = $_POST['changeAbout'];
            $newAbout = strip_tags($newAbout);
            $newAbout = htmlspecialchars($newAbout, ENT_QUOTES);

            $file = $_FILES['changeUserpic'];
            $filename = $file['name'];
            $filename = htmlspecialchars($filename, ENT_QUOTES);
            $fileExtension = explode('.', $filename);
            $fileType = explode('/', $file['type']);

            $allowed = ['jpg', 'jpeg', 'png', 'gif'];

            if (!empty($file['name'])) {
                $newPhoto = Config::UPLOAD_DIR . '\user' . $this->user->getId() . '\userpic\\' . $filename;

                if (!in_array(end($fileType), $allowed)) {
                    $success = 0;
                    $message = 'Недопустимый тип фото: ' . end($fileType);
                }

                if (!in_array(end($fileExtension), $allowed)) {
                    $success = 0;
                    $message = 'Недопустимый формат фото: ' . end($fileExtension);
                }
            } else {
                $newPhoto = $this->user->photo;
            }

            if (empty($newName)) {
                $success = 0;
                $message = 'Имя пользователя должно быть указано';
            }

            try {
                if (User::isNameExist($newName) && $newName != $this->user->name) {
                    $success = 0;
                    $message = 'Пользователь с таким именем уже существует';
                }

                if ($success) {
                    $this->user->name = $newName;
                    $this->user->age = $newAge;
                    $this->user->about = $newAbout;
                    $this->user->photo = $newPhoto;
                    $this->user->save();
                    move_uploaded_file($file['tmp_name'], getcwd() . $newPhoto);
                    $message = 'Данные сохранены';
                }
            } catch (\PDOException $e) {
                $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
                $error->toLog();
                $message = $error->userMessage;
            }
        }

        $data = array('name' => $this->user->name, 'age' => $this->user->age, 'about' => $this->user->about, 'photo' => $this->user->photo);
        $data['message'] =$message;
        $this->view->render('profilechange', $data);
    }
}

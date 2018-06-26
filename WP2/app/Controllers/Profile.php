<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

class Profile extends MainController
{
    public function index()
    {
        $data = array('name' => $this->user->name, 'age' => $this->user->age, 'about' => $this->user->about, 'photo' => $this->user->photo);
        //$this->view->render('profile', $data);
        $this->view->renderTwig('profile.twig', $data);
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

            if (!empty($filename)) {
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
                    if (!empty($filename)) {
                        $newPhoto = '/uploads/user' . $this->user->getId() . '/userpic/userpic' . rand(0, 100) . '.' . end($fileExtension);
                        $userpics = scandir(getcwd() . '/uploads/user' . $this->user->getId() . '/userpic');
                        if (isset($userpics[2])) {
                            unlink(getcwd() . '/uploads/user' . $this->user->getId() . '/userpic/' . $userpics[2]);
                        }

                        //ужимаем произвольную картинку до 200х200: сначаоа ресайзим меньшую сторону до 200 с сохранением пропорции, затем из результате вырезаем серединку 200х200.
                        $image = Image::make($file['tmp_name']);
                        if ($image->width() >= $image->height()) {
                            $image->resize(null, 200, function ($image) {
                                $image->aspectRatio();
                            });
                            $image->crop(200, 200, round(($image->width()-200)/2), 0);
                        } else {
                            $image->resize(200, 0, function ($image) {
                                $image->aspectRatio();
                            });
                            $image->crop(200, 200, 0, round(($image->height()-200)/2));
                        }
                        $image->save(getcwd() . $newPhoto);
                    }

                    $this->user->name = $newName;
                    $this->user->age = $newAge;
                    $this->user->about = $newAbout;
                    $this->user->photo = $newPhoto;
                    $this->user->save();
                    $message = 'Данные сохранены';
                }
            } catch (\Exception $e) {
                $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
                $error->toLog();
                $message = $error->userMessage;
            }
        }

        $data = array('name' => $this->user->name, 'age' => $this->user->age, 'about' => $this->user->about, 'photo' => $this->user->photo);
        $data['message'] =$message;
        $this->view->renderTwig('profileUpdate.twig', $data);
    }
}

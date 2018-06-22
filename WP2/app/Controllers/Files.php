<?php
namespace App\Controllers;

use App\Core\Viewer;
use App\Models\User;
use App\Models\File;

class Files extends Viewer
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
        $files = File::getAllUserFiles($this->user);
        $data['files'] = $files;
        $data['message'] = '';
        $this->view->render('files', $data);
    }

    public function upload()
    {
        $receivedFile = $_FILES['uploadFile'];
        $filename = $receivedFile['name'];
        $filename = htmlspecialchars($filename, ENT_QUOTES);
        $fileExtension = explode('.', $filename);
        $fileType = explode('/', $receivedFile['type']);
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $success = 1;

        if (!in_array(end($fileType), $allowed)) {
            $success = 0;
            $message = 'Недопустимый тип файла: ' . end($fileType);
        }

        if (!in_array(end($fileExtension), $allowed)) {
            $success = 0;
            $message = 'Недопустимый формат файла: ' . end($fileExtension);
        }

        if (empty($filename)) {
            $success = 0;
            $message = 'Файл не выбран';
        }

        if ($success) {
            $description = $_POST['fileDescription'];
            $description = strip_tags($description);
            $description = htmlspecialchars($description, ENT_QUOTES);

            $file = new File($this->user, $filename, $description);
            $fileSource = $receivedFile['tmp_name'];
            $file->upload($fileSource);

            header("Location: /files");
        } else {
            $files = File::getAllUserFiles($this->user);
            $data['files'] = $files;
            $data['message'] = $message;
            $this->view->render('files', $data);
        }
    }

    public function delete()
    {
        $file = File::getFileById($_GET['id']);

        if ($this->user->getId() == $file->getOwner()->getId()) {
            $file->delete();
        }

        header("Location: /files");
    }
}

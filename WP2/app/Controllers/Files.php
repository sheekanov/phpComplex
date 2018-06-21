<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;
use App\Models\File;

class Files extends MainController
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
        $this->view->render('files', $data);
    }

    public function upload()
    {
        $receivedFile = $_FILES['uploadFile'];
        $filename = $receivedFile['name'];

        if (empty($filename)) {
            $message = 'Файл не выбран';
            $files = File::getAllUserFiles($this->user);
            $data['files'] = $files;
            $data['message'] = $message;
            $this->view->render('files', $data);
        } else {
            $description = $_POST['fileDescription'];

            $file = new File($this->user, $filename, $description);
            $fileSource = $receivedFile['tmp_name'];
            $file->upload($fileSource);

            header("Location: /files");
        }


    }

    public function delete()
    {
        $file = File::getFileById($_GET['id']);
        $file->delete();
        header("Location: /files");
    }
}

<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\File;

class Files extends MainController
{
    private $userFiles;
    public function __construct()
    {
        parent::__construct();
        try {
            $this->userFiles = File::getAllUserFiles($this->user);
        } catch (\PDOException $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }
    }

    public function index()
    {
            $data['files'] = $this->userFiles;
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
        $message='';

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
            try {
                $description = $_POST['fileDescription'];
                $description = strip_tags($description);
                $description = htmlspecialchars($description, ENT_QUOTES);

                $file = new File($this->user, $filename, $description);
                $fileSource = $receivedFile['tmp_name'];
                $file->upload($fileSource);

                header("Location: /files");
            } catch (\PDOException $e) {
                $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
                $error->toLog();
                $data['files'] = $this->userFiles;
                $data['message'] = $error->userMessage;
                $this->view->render('files', $data);
            }
        } else {
            $data['files'] = $this->userFiles;
            $data['message'] = $message;
            $this->view->render('files', $data);
        }
    }

    public function delete()
    {
        try {
            $file = File::getFileById($_GET['id']);

            if ($this->user->getId() == $file->getOwner()->getId()) {
                $file->delete();
            }
        } catch (\PDOException $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }


        header("Location: /files");
    }
}

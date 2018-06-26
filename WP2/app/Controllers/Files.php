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
        } catch (\Exception $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }
    }

    public function index()
    {
            $data['files'] = $this->userFiles;
            $data['message'] = '';
            $this->view->renderTwig('files.twig', $data);
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
                $file->upload();

                $destination = getcwd() .  $file->getUrl();
                move_uploaded_file($fileSource, $destination);

                header("Location: /files");
            } catch (\Exception $e) {
                $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
                $error->toLog();
                $data['files'] = $this->userFiles;
                $data['message'] = $error->userMessage;
                $this->view->renderTwig('files.twig', $data);
            }
        } else {
            $data['files'] = $this->userFiles;
            $data['message'] = $message;
            $this->view->renderTwig('files.twig', $data);
        }
    }

    public function delete()
    {
        try {
            $file = File::getFileById($_GET['id']);

            if ($this->user->getId() == $file->getOwner()->getId()) {
                $file->delete();
                unlink(getcwd(). $file->getUrl());
            }
        } catch (\Exception $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }


        header("Location: /files");
    }
}

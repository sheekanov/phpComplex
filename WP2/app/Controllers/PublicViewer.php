<?php
namespace App\Controllers;

use App\Core\Viewer;
use App\Models\File;

class PublicViewer extends Viewer
{
    public function showImage()
    {
        $fileId = $_GET['id'];

        try {
            $file = File::getFileById($fileId);

            if (!is_null($file)) {
                $data = array('url' => $file->getUrl(), 'filename' => $file->filename);
            } else {
                $data = array('url' => '\assets\pic\decor\\picNotFound.jpg', 'filename' => 'Изображение не найдено');
            }

            $this->view->render('showImage', $data);
        } catch (\PDOException $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }

    }
}

<?php
namespace App\Controllers;

use App\Core\Viewer;
use App\Models\File;

//Класс для публичного показа файлов пользователей. Особенность его в том, что он не провряет авторизацию.
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

            $this->view->renderTwig('showImage.twig', $data);
        } catch (\Exception $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }

    }
}

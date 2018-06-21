<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\File;

class PublicViewer extends MainController
{
    public function showImage()
    {
        $fileId = $_GET['id'];
        $file = File::getFileById($fileId);
        $data=['file' => $file];
        $this->view->render('showImage', $data);
    }
}

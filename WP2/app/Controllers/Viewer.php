<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\File;

class Viewer extends MainController
{
    public function show()
    {
        $fileId = $_GET['id'];
        $file = File::getFileById($fileId);
        $data=['file' => $file];
        $this->view->render('viewer', $data);
    }
}

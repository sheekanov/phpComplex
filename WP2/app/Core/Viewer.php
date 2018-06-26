<?php
namespace App\Core;


//класс для наследования - содержит в свойствах инициализированный объект View для рендеринга Twig
class Viewer
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}

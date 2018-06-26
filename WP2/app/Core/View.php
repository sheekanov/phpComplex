<?php
namespace App\Core;

//класс, кооторый рендерит Twig
class View
{
    protected $loader;
    protected $twig;

    public function __construct()
    {
        $this->loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
        $this->twig = new \Twig_Environment($this->loader);
    }

    public function renderTwig($filename, $data)
    {

        echo $this->twig->render($filename, $data);
    }
}
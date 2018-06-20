<?php
namespace App\Core;

class View
{
    public $data;

    public function __construct()
    {
       //
    }

    public function render(string $filename, array $data)
    {
        require_once __DIR__."/../views/".$filename.".php";
    }

    public function renderError(string $filename, array $data)
    {
        require_once __DIR__ . "/../errors/" .$filename.".php";
    }
}
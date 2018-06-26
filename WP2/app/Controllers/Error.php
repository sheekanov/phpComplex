<?php
namespace App\Controllers;

use \App\Core\Viewer;

//Класс для управления ошибками
class Error extends Viewer
{
    public $exception;
    public $errorCode;
    public $userMessage;


    public function __construct(string $userMessage, \Exception $exception = null)
    {
        parent::__construct();
        $this->exception = $exception;
        $this->userMessage = $userMessage;
    }

    //пишет информацию в лог
    public function toLog()
    {
        $e=$this->exception;

        $errorLog = date('d:m:Y H:i:s') . ' ---- Exception occured in file ' . $e->getFile()
            .' at Line ' . $e->getLine()
            . ': ' . $e->getMessage() . PHP_EOL
            . 'Trace: ' . PHP_EOL;

        foreach ($e->getTrace() as $num => $trace) {
            $errorLog .= $num . ': in File ' . $trace['file']
                . ' on Line ' . $trace['line']
                . ' at ' . $trace['class'] . $trace['type'] . $trace['function'] . PHP_EOL;
        }

        $errorLog .= '-----------------------------------------------------------------------------------' . PHP_EOL . PHP_EOL;

        file_put_contents(getcwd() . '/../app/resources/ErrorLog.txt', $errorLog, FILE_APPEND);
    }
    //возвращает информацию браузеру в виде Json
    public function toJson()
    {
        $response =[];
        $response['success'] = 0;
        $response['message'] = $this->userMessage;
        $json = json_encode($response, JSON_UNESCAPED_UNICODE);
        $data=[];
        $data['json'] = $json;
        $this->view->renderTwig('errorJson.twig', $data);
    }
    //возвращает информацию браузеру в виде странички ошибки
    public function toErrorPage($description)
    {
        $data = array('errorCode' => $this->exception->getCode(), 'errorDesc' => $description, 'userMessage' => $this->userMessage);
        $this->view->renderTwig('errorPage.twig', $data);
    }
}
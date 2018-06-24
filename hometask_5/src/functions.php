<?php

function task1(array $sendTo)
{
    /*
    $transport = new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');
    $transport->setUsername('hometask5.sheekanov@gmail.com')
        ->setPassword('hometask5')
        ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));
    */
    $transport = new Swift_SmtpTransport('smtp.timeweb.ru', 465, 'ssl');
    $transport->setUsername('mrburger@sheekanov.ru')
        ->setPassword('burger123')
        ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));


    $mailer = new Swift_Mailer($transport);

    $message = new Swift_Message('Order', 'Message sent via Swift Mailer');
    $message->setFrom(['mrburger@sheekanov.ru' => 'Mr Burger Shikanov'])
        ->setTo($sendTo);

    $result = $mailer->send($message);
    return $result;
}
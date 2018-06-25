<?php
use Intervention\Image\ImageManagerStatic as Image;

function task1(array $sendTo)
{

    $transport = new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');
    $transport->setUsername('hometask5.sheekanov@gmail.com')
        ->setPassword('hometask5')
        ->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));

    $mailer = new Swift_Mailer($transport);

    $message = new Swift_Message('Order', 'Message sent via Swift Mailer');
    $message->setFrom(['mrburger@sheekanov.ru' => 'Mr Burger Shikanov'])
        ->setTo($sendTo);

    $result = $mailer->send($message);
    return $result;
}

function task3($originPath, $resultPath)
{
    $image = Image::make($originPath);

    $image->text('гора Демерджи', 200, $image->height(), function ($font) {
            $font->file(realpath(__DIR__ . '/../arial.ttf'));
            $font->size(200);
            $font->angle(45);
    });
    $image->resize(256, null, function ($image) {
        $image->aspectRatio();
    });
    $image->save($resultPath);
}

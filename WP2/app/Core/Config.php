<?php
namespace App\Core;

class Config
{
    const DB_NAME = 'mvc'; //имя БД
    const DB_USER = 'root'; //имя пользователя
    const DB_PASSWD = ''; //пароль БД
    const UPLOAD_DIR = 'D:\OSPanel\domains\phpcomplex\WP2\public\uploads\\'; //полная путь к директории uploads
    const ERROR_LOG = '\..\app\resources\ErrorLog.txt'; //относительный от корня сайта путь к Error Log файлу
}

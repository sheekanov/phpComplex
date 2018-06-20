<?php
namespace App\Models;

use PDO;
use App\Core\Config;

abstract class DBModel
{
    protected $database;

    public function __construct()
    {
        $this->database = new PDO('mysql:host=localhost;dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASSWD);
        $this->database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected static function executeSelectQuery($query, $params)
    {
        $db = new PDO('mysql:host=localhost;dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASSWD);
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $db->prepare($query);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($params);
        $result = $query->fetchAll();
        return $result;
    }
}
<?php
namespace App\Models;

use PDO;
use App\Core\Config;

class DBModel
{
    public $database;

    public function __construct()
    {
        $this->database = new PDO('mysql:host=localhost;dbname=' . Config::DB_NAME, Config::DB_USER, Config::DB_PASSWD);
        $this->database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeSelectQuery($query, $params = [])
    {
        $query = $this->database->prepare($query);
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute($params);
        $result = $query->fetchAll();

        return $result;
    }
}
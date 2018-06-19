<?php
namespace app\Models;

use PDO;

class User
{
    protected $userId;

    protected $database;

    public function __construct()
    {
        $this->database = new PDO("mysql:host=localhost;dbname=mvc", 'root', '');
        $this->database -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function setUserId($id)
    {
        if (!empty($this->isExist($id))) {
            $this->userId = $id;
            return true;
        } else {
            return false;
        }
    }


    public function getUserId()
    {
        return $this->userId;
    }

    public function isExist($id)
    {
        $userSelect = $this->database->prepare('SELECT COUNT(*) as count FROM users WHERE id = :id;');
        $userSelect->setFetchMode(PDO::FETCH_ASSOC);
        $userSelect->execute([':id' => $id]);
        $count = $userSelect->fetchAll();
        return $count[0]['count'];
    }

    public function isNameExist($name)
    {
        $userSelect = $this->database->prepare('SELECT COUNT(*) as count FROM users WHERE name = :name;');
        $userSelect->setFetchMode(PDO::FETCH_ASSOC);
        $userSelect->execute([':name' => $name]);
        $count = $userSelect->fetchAll();
        return $count[0]['count'];
    }

    public function getUserData()
    {
        $userSelect = $this->database->prepare('SELECT * FROM users WHERE id = :id;');
        $userSelect->setFetchMode(PDO::FETCH_ASSOC);
        $userSelect->execute([':id' => $this->userId]);
        $userData = $userSelect->fetchAll();
        return $userData[0];
    }

    public function getIdByName($name)
    {
        $userSelect = $this->database->prepare('SELECT id FROM users WHERE name = :name;');
        $userSelect->setFetchMode(PDO::FETCH_ASSOC);
        $userSelect->execute([':name' => $name]);
        $userData = $userSelect->fetchAll();
        return $userData[0]['id'];
    }

    public function createUser($name, $age)
    {
        $userInsert = $this->database->prepare('INSERT INTO users (name, age) VALUES (:name, :age)');
        $userInsert->execute([':name' => $name, ':age' => $age]);

        return $this->getIdByName($name);
    }

    public function updateUserData($params)
    {
        if (isset($params['photo'])) {
            $userUpdate = $this->database->prepare('UPDATE users SET name = :name, age = :age, about = :about, photo = :photo WHERE id = :id');
            $userUpdate->execute([':name' => $params['name'], ':age' => $params['age'], ':id' => $this->userId, ':about' => $params['about'], ':photo' => $params['photo']]);
        } else {
            $userUpdate = $this->database->prepare('UPDATE users SET name = :name, age = :age, about = :about WHERE id = :id');
            $userUpdate->execute([':name' => $params['name'], ':age' => $params['age'], ':id' => $this->userId, ':about' =>  $params['about']]);
        }

        return true; //TODO сделать возврат в зависимости от успеха
    }
}

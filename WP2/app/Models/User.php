<?php
namespace App\Models;

use PDO;
use App\Models\DBModel;

class User extends DBModel
{

    protected $database;

    private $id;
    public $name;
    public $age;
    public $about;
    public $photo;

    public function __construct($name, $age, $about = null, $photo = null)
    {
        parent::__construct();

        $this->name = $name;
        $this->age = $age;
        $this->about = $about;
        $this->photo = $photo;
    }

    public function getId()
    {
        return $this->id;
    }

    //статический метод - инициализация нового объекта User по Id
    public static function getUserById($id)
    {
        $userData = DBModel::executeSelectQuery('SELECT * FROM users WHERE id = :id;', [':id' => $id]);

        $user = new User($userData[0]['name'], $userData[0]['age'], $userData[0]['about'], $userData[0]['photo']);
        $user->id = $userData[0]['id'];

        return $user;
    }
    //статический метод - инициализация нового объекта User по Name
    public static function getUserByName($name)
    {
        $userData = DBModel::executeSelectQuery('SELECT * FROM users WHERE name = :name;', [':name' => $name]);

        $user = new User($userData[0]['name'], $userData[0]['age'], $userData[0]['about'], $userData[0]['photo']);
        $user->id = $userData[0]['id'];

        return $user;
    }
    //статический метод - проверка существует ли пользователь с заданным именем
    public static function isNameExist($name)
    {
        $userData = DBModel::executeSelectQuery('SELECT COUNT(*) as count FROM users WHERE name = :name;', [':name' => $name]);
        $count = $userData[0]['count'];

        return $count;
    }
    //статический метод - проверка существует ли пользователь с заданным id
    public static function isIdExist($id)
    {
        $userData = DBModel::executeSelectQuery('SELECT COUNT(*) as count FROM users WHERE id = :id;', [':id' => $id]);
        $count = $userData[0]['count'];

        return $count;
    }
    //сохранение пользователя в БД. Если у пользователя задан id (т.е. он получен через статический метод класса, а значит пользователь существует в БД), то данные в БД просто обновляются.
    //Иначе (если пользователь создан через new) - новый пользователь добавляется в БД, а вызывающему объекту присваивается id.
    public function save()
    {
        if ($this->id) {
            $userUpdate = $this->database->prepare('UPDATE users SET name = :name, age = :age, about = :about, photo = :photo WHERE id = :id');
            $userUpdate->execute([':name' => $this->name, ':age' => $this->age, ':id' => $this->id, ':about' => $this->about, ':photo' => $this->photo]);

        } else {
            $userInsert = $this->database->prepare('INSERT INTO users (name, age) VALUES (:name, :age)');
            $userInsert->execute([':name' => $this->name, ':age' => $this->age]);
            $this->id = $this->database->lastInsertId('users');
        }

        return true; //TODO сделать возврат в зависимости от успеха
    }
}

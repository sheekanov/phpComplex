<?php
namespace App\Models;

class User
{
    private $id;
    public $name;
    public $age;
    public $about;
    public $photo;
    public $password;

    public function __construct($name, $age, $password = null, $about = null, $photo = null)
    {
        $this->name = $name;
        $this->age = $age;
        $this->about = $about;
        $this->photo = $photo;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    //возвращает массив со всеми пользователями
    public static function getAllUsers($sort = 'DESC')
    {
        $db = new DBModel();

        switch ($sort) {
            case 'DESC':
                $userList= $db->executeSelectQuery('SELECT * FROM users ORDER BY age DESC;');
                break;
            case 'ASC':
                $userList= $db->executeSelectQuery('SELECT * FROM users ORDER BY age ASC;');
                break;
            default:
                $userList= $db->executeSelectQuery('SELECT * FROM users ORDER BY age DESC;');
        }

        $db = null;
        $users = [];

        foreach ($userList as $userItem) {
            $user = new User($userItem['name'], $userItem['age'], $userItem['password'], $userItem['about'], $userItem['photo']);
            $user->id = $userItem['id'];

            $users[]=$user;
        }

        return $users;
    }


    //возвращает пользователя по его Id
    public static function getUserById($id)
    {
        $db = new DBModel();
        $userData = $db->executeSelectQuery('SELECT * FROM users WHERE id = :id;', [':id' => $id]);
        $db = null;

        if (empty($userData)) {
            return null;
        } else {
            $user = new User($userData[0]['name'], $userData[0]['age'], $userData[0]['password'], $userData[0]['about'], $userData[0]['photo']);
            $user->id = $userData[0]['id'];

            return $user;
        }
    }
    //возвращает пользователя по его имени
    public static function getUserByName($name)
    {
        $db = new DBModel();
        $userData = $db->executeSelectQuery('SELECT * FROM users WHERE name = :name;', [':name' => $name]);
        $db = null;

        if (empty($userData)) {
            return null;
        } else {
            $user = new User($userData[0]['name'], $userData[0]['age'], $userData[0]['password'], $userData[0]['about'], $userData[0]['photo']);
            $user->id = $userData[0]['id'];

            return $user;
        }
    }
    //проверка существования пользователя по имени
    public static function isNameExist($name)
    {
        $db = new DBModel();
        $userData = $db->executeSelectQuery('SELECT COUNT(*) as count FROM users WHERE name = :name;', [':name' => $name]);
        $db = null;
        $count = $userData[0]['count'];

        return $count;
    }
    //проверка существования пользователя по Id
    public static function isIdExist($id)
    {
        $db = new DBModel();
        $userData = $db->executeSelectQuery('SELECT COUNT(*) as count FROM users WHERE id = :id;', [':id' => $id]);
        $count = $userData[0]['count'];
        $db = null;

        return $count;
    }
    //сохранение пользователя в БД. Если у пользователя задан id (т.е. он получен через статический метод класса, а значит пользователь существует в БД), то данные в БД просто обновляются.
    //Иначе (если пользователь создан через new) - новый пользователь добавляется в БД, а вызывающему объекту присваивается id.
    public function save()
    {
        $db = new DBModel();
        if ($this->id) {
            $userUpdate =$db->database->prepare('UPDATE users SET name = :name, age = :age, about = :about, photo = :photo, password = :password WHERE id = :id');
            $userUpdate->execute([':name' => $this->name, ':age' => $this->age, ':id' => $this->id, ':about' => $this->about, ':photo' => $this->photo, ':password' => $this->password]);
        } else {
            $userInsert = $db->database->prepare('INSERT INTO users (name, age, password, about, photo) VALUES (:name, :age, :password, :about, :photo)');
            $userInsert->execute([':name' => $this->name, ':age' => $this->age, ':password' => $this->password, ':about' => $this->about, ':photo' => $this->photo]);
            $this->id = $db->database->lastInsertId('users');
        }

        $db = null;
    }
}
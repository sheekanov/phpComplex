<?php
namespace App\Models;

use PDO;
use App\Models\DBModel;

class File
{
    private $id;
    protected $owner;
    public $filename;
    public $description;
    private $url;

    public function __construct(User $owner, $filename, $description)
    {
        $this->owner = $owner;
        $this->filename = $filename;
        $this->description = $description;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    //сохраняет запись о файле в БД и присвает файлу url
    public function upload()
    {
        $db = new DBModel();

        $userid = $this->owner->getId();
        $url = '\uploads\user' . $userid . '\files\\' . $this->filename;
        $fileInsert = $db->database->prepare('INSERT INTO files (user_id, filename, description, url) VALUES (:userid, :filename, :description, :url)');
        $fileInsert->execute([':userid' => $userid, ':filename' => $this->filename, ':description' => $this->description, ':url' => $url]);
        $this->id = $db->database->lastInsertId('files');
        $this->url = $url;

        $db = null;
    }

    //удаляет запись о файле из БД
    public function delete()
    {
        $db = new DBModel();

        $fileDelete = $db->database->prepare('DELETE from files WHERE id = :id');
        $fileDelete->execute([':id' => $this->id]);

        $db = null;
    }

    //возвращает массив файлов, которыми владеет данный User
    public static function getAllUserFiles(User $user)
    {
        $db = new DBModel();
        $results = $db->executeSelectQuery('SELECT * FROM files WHERE user_id = :userid ;', [':userid' => $user->getId()]);
        $db=null;

        $files =[];

        foreach ($results as $result) {
            $owner = User::getUserById($result['user_id']);
            $file = new File($owner, $result['filename'], $result['description']);
            $file->id = $result['id'];
            $file->url = $result['url'];

            $files[] = $file;
        }

        return $files;
    }

    //возвращает файл по его Id
    public static function getFileById($id)
    {
        $db = new DBModel();
        $results = $db->executeSelectQuery('SELECT * FROM files WHERE id = :id ;', [':id' => $id]);
        $db = null;

        if (empty($results)) {
            return null;
        } else {
            $owner = User::getUserById($results[0]['user_id']);
            $file = new File($owner, $results[0]['filename'], $results[0]['description']);
            $file->id = $results[0]['id'];
            $file->url = $results[0]['url'];

            return $file;
        }
    }
}
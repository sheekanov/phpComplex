<?php
namespace App\Models;

use PDO;
use App\Core\Config;
use App\Models\DBModel;

class File extends DBModel
{
    private $id;
    protected $owner;
    public $filename;
    public $description;
    private $url;

    protected $database;

    public function __construct(User $owner, $filename, $description)
    {
        parent::__construct();

        $this->owner = $owner;
        $this->filename = $filename;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function upload($source)
    {
        $userid = $this->owner->getId();
        $destination = Config::UPLOAD_DIR . '\user' . $userid . '\files\\' . $this->filename;
        $url = '\uploads\user' . $userid . '\files\\' . $this->filename;
        move_uploaded_file($source, $destination);
        $fileInsert = $this->database->prepare('INSERT INTO files (user_id, filename, description, url) VALUES (:userid, :filename, :description, :url)');
        $fileInsert->execute([':userid' => $userid, ':filename' => $this->filename, ':description' => $this->description, ':url' => $url]);
        $this->id = $this->database->lastInsertId('files');
        $this->url = $destination;
    }

    public function delete()
    {
        unlink(__DIR__ . '\..\..\public' . $this->url);
        $fileDelete = $this->database->prepare('DELETE from files WHERE id = :id');
        $fileDelete->execute([':id' => $this->id]);
    }

    public static function getAllUserFiles(User $user)
    {
        $results = DBModel::executeSelectQuery('SELECT * FROM files WHERE user_id = :userid ;', [':userid' => $user->getId()]);

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

    public static function getFileById($id)
    {
        $results = DBModel::executeSelectQuery('SELECT * FROM files WHERE id = :id ;', [':id' => $id]);

        $owner = User::getUserById($results[0]['user_id']);
        $file = new File($owner, $results[0]['filename'], $results[0]['description']);
        $file->id = $results[0]['id'];
        $file->url = $results[0]['url'];

        return $file;
    }
}
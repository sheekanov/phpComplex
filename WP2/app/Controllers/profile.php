<?php
namespace app\Controllers;

require_once __DIR__ .  '/../Core/MainController.php';
require_once __DIR__ . '/../Models/User.php';

use app\Core\MainController;
use app\Models\User;

class profile extends MainController
{
    protected $user;

    public function __construct()
    {
        parent::__construct();

        $this->user = new User();

        if (isset($_SESSION['userid'])) {
            $res = $this->user->setUserId($_SESSION['userid']);
            if ($res) {
                if (empty($_POST)) {
                    $userData = $this->user->getUserData();
                    $this->view->render('profile', $userData[0]);
                }
            } else {
                header("Location: login");
            }
        } else {
            header("Location: login");
        }
    }

    public function updateProfile()
    {
        $name = $_POST['changeName'];
        $age = $_POST['changeAge'];
        $about = $_POST['changeAbout'];
        $file = $_FILES['changeUserpic'];
        $photo = 'uploads\user' . $this->user->getUserId() . '\userpic\\' . $file['name'];
        move_uploaded_file($file['tmp_name'], getcwd() .'\\'. $photo);
        $this->user->updateUserData($name, $age, $about, $photo);
        header("Location: /profile");
    }
}

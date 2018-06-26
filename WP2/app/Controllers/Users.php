<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\User;

class Users extends MainController
{

    public function index()
    {
        try {
            if (isset($_GET['sort'])) {
                $sort = $_GET['sort'];
                $users = User::getAllUsers($sort);
            } else {
                $users = User::getAllUsers();
            }

            $userInfo=[];

            foreach ($users as $key => $user) {
                $userInfo[$key]['user'] = $user;
                if ($user->age > 18) {
                    $userInfo[$key]['adult'] = 'Совершеннолетний';
                } else {
                    $userInfo[$key]['adult'] = 'Несовершеннолетний';
                }
            }

            $data['users'] = $userInfo;

            $this->view->renderTwig('users.twig', $data);
        } catch (\Exception $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }

    }

    public function showProfile()
    {
        $userId = $_GET['id'];
        try {
            $user = User::getUserById($userId);

            if (!is_null($user)) {
                $data=['user' => $user];

            } else {
                $data = ['user' => new User('Профиль не найден', '0', 'Пользователь с Id=' .$userId . ' не существует')];
            }
            $this->view->renderTwig('showProfile.twig', $data);
        } catch (\Exception $e) {
            $error = new Error('Произошла ошибка. Обратитесь к администратору.', $e);
            $error->toLog();
            $error->toErrorPage('Ой');
        }
    }
}
<?php
require '../../vendor/autoload.php';
use App\Models\User;

$config = new \App\Core\Config();

$faker = Faker\Factory::create();

//populate users
$passValidator = function ($word) {
    return strlen($word) >= 5;
};

for ($i = 0; $i < 10; $i++) {
    $name = $faker->userName;
    $age = $faker->numberBetween(10, 99);
    $passwd = $faker->valid($passValidator)->word;
    $about = $faker->text;
    $user = new User($name, $age, crypt($passwd, 'loft'), $about);
    $user->save();
    mkdir(getcwd() . '\..\..\public\uploads\user' . $user->getId() . '\userpic\\', 0777, true);
    mkdir(getcwd() . '\..\..\public\uploads\user' . $user->getId() . '\files\\', 0777, true);
}

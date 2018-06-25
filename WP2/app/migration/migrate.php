<?php
require '../../vendor/autoload.php';
use App\Core\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

$config = new Config();

$capsule = new Capsule();
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASSWD'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

//удаление таблиц
Capsule::schema()->dropIfExists('files');
Capsule::schema()->dropIfExists('users');

//создание таблицы users
Capsule::schema()->create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name', 50)->unique();
    $table->integer('age', false, true)->nullable();
    $table->text('about')->nullable();
    $table->string('photo')->nullable();
    $table->string('password', 30);
});

//создание таблицы files
Capsule::schema()->create('files', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('user_id')->unsigned();
    $table->string('filename', 50);
    $table->text('description')->nullable();
    $table->string('url')->nullable();

    $table->foreign('user_id')
        ->references('id')->on('users');
});

# phpComplex
Loftschool php complex course 2018

---------------------------------------------
Выпускной проект 4 - https://github.com/sheekanov/phpComplex/tree/master/WP4/gamemagaz

ВП 4 на хостинге - http://games.sheekanov.ru/

Ссылка на админку - http://games.sheekanov.ru/admin/

Для входа в админку необходимо при регистрации пользователя выбрать опцию "Grant Admin privileges"

Порядок установки приложения:
1. Создание и заполнение БД из dump.sql файла. Либо создание и заполнение БД с использованием команд php artisan migrate и затем php adrisan db:seed. 
ВНИМАНИЕ! Наполнение базы db:seed после выполнения миграции - обязательно, т.к. в БД содержаться предустановленные настройки сайта.
2. Установка сторонних комнонентов php composer install
3. Создание символической ссылки на public/storage командой php artisan storage:link
4. Создание .env файла из .env.example со своими настройками
4. Генерация ключа приложения  php artisan key:generate
5. Запуск демона очереди - php artisan queue:work

-----------------------------------------------

Выпускной проект 2 - phpComplex/WP2

ВП 2 на хостинге: http://mvc.sheekanov.ru

------------------------------------------------

Выпускной проект 1 - phpComplex/WP1

Админка ВП 1 - phpComplex/WP1/admin.php

ВП 1 на хостинге: http://burger.sheekanov.ru/

Админка ВП 1 на хостинге: http://burger.sheekanov.ru/admin.php 

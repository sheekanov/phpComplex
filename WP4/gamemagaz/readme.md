Порядок установки:
1. Создание и заполнение БД из dump.sql файла. Либо создание и заполнение БД с использованием команд php artisan migrate и затем php adrisan db:seed. 
ВНИМАНИЕ! Наполнение базы db:seed после выполнения миграции - обязательно, т.к. в БД содержаться предустановленные настройки сайта.
2. Установка сторонних комнонентов php composer install
3. Создание символической ссылки на public/storage командой php artisan storage:link
4. Создание .env файла из .env.example со своими настройками
4. Генерация ключа приложения  php artisan key:generate
5. Запуск демона очереди - php artisan queue:work

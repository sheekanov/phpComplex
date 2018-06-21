<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1140px">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Все пользователи</title>
    <link rel="stylesheet" href="/css/vendor.min.css">

    <link rel="stylesheet" href="/css/styles.min.css">
</head>
<body>
<div class="wrapper">
    <div class="maincontent">
        <header class="header">
            <div class="container">
                <div class="header__left">
                    <h1 class="header__title">Filemanager MVC</h1>
                </div>
                <div class="header__right">
                    <a href="login/logout" class="header__logout">Выйти</a>
                </div>
            </div>
        </header>
        <div class="container">
            <aside class="aside">
                <nav class="navigation">
                    <ul class="navigation__list">
                        <li class="navigation__item">
                            <a href="/profile" class="navigation__link">МОЙ ПРОФИЛЬ</a>
                        </li>
                        <li class="navigation__item">
                            <a href="/files" class="navigation__link">МОИ ФАЙЛЫ</a>
                        </li>
                        <li class="navigation__item  navigation__item--active">
                            <a href="/users" class="navigation__link">ВСЕ ПОЛЬЗОВАТЕЛИ</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <main class="main">
                <h1 class="users-title">Все пользователи</h1>
                <table class="table">
                    <thead class="table__table-head">
                    <tr class="table__row">
                        <td class="table_head-col table__head-col--userName">Имя</td>
                        <td class="table_head-col table__head-col--userAge">
                            <span class="table__age-text">Возраст</span>
                            <a href="/users?sort=ASC" class="table__sort-link">&#11014;</a>
                            <a href="/users?sort=DESC" class="table__sort-link">&#11015;</a>
                        </td>
                        <td class="table_head-col table__head-col--userAbout">О себе</td>
                    </tr>
                    </thead>
                    <tbody class="table__table-body">
                    <?php foreach ($data as $user) : ?>
                    <tr class="table__row">
                        <td class="table__col">
                            <a href="/Users/showProfile?id=<?php echo $user->getId();?>" class="table__user-name-link"><?php echo $user->name;?></a>
                        </td>
                        <td class="table__col"><?php echo $user->age;?></td>
                        <td class="table__col">
                            <div class="table__about-block">
                            <?php echo $user->about;?></td>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="footer__text">Разработано во время Комплексного курса по PHP в Loftschool, 2018</div>
    </div>
</footer>

<script src="/JS/vendor.min.js"></script>


<script src="/JS/script.min.js"></script>
</body>
</html>
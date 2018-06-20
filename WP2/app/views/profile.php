<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1140px">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добро пожаловать в MVC!</title>
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
                    <a href="/login/logout" class="header__logout">Выйти</a>
                </div>
            </div>
        </header>
        <div class="container">
            <aside class="aside">
                <nav class="navigation">
                    <ul class="navigation__list">
                        <li class="navigation__item navigation__item--active">
                            <a href="/profile" class="navigation__link">МОЙ ПРОФИЛЬ</a>
                        </li>
                        <li class="navigation__item">
                            <a href="/files" class="navigation__link">МОИ ФАЙЛЫ</a>
                        </li>
                        <li class="navigation__item">
                            <a href="" class="navigation__link">ВСЕ ПОЛЬЗОВАТЕЛИ</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <main class="main">
                <div class="info">
                    <div class="info__left">
                        <div class="info__pic-wrapper">
                            <div class="info__pic-block">
                                <img src="<?php echo $data['photo']; ?>" alt="" class="info__userpic">
                            </div>
                        </div>
                        <div class="info__change">
                            <a href="/profile/update" class="info__change-link">Изменить личные данные</a>
                        </div>
                    </div>
                    <div class="info__right">
                        <table class="info__table">
                            <tr class="info__tablerow">
                                <td class="info__titlecol">Имя:</td>
                                <td class="info__valuecol"><?php echo $data['name']; ?></td>
                            </tr>
                            <tr class="info__tablerow">
                                <td class="info__titlecol">Возраст:</td>
                                <td class="info__valuecol"><?php echo $data['age']; ?></td>
                            </tr>
                            <tr class="info__tablerow">
                                <td class="info__titlecol">Обо мне:</td>
                                <td class="info__valuecol">
                                    <pre><?php echo $data['about']; ?></pre>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
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
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1140px">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Мой профиль</title>
    <link rel="stylesheet" href="/css/vendor.min.css">

    <link rel="stylesheet" href="/css/styles.min.css">
</head>
<body>
<div class="wrapper">
    <div class="maincontent">
        <header class="header">
            <div class="container">
                <div class="header__left">
                    <h1 class="header__title"><a href="/" class="header__title-link">Filemanager MVC</a></h1>
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
                            <a href="/users" class="navigation__link">ВСЕ ПОЛЬЗОВАТЕЛИ</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <main class="main">
                <form class="info" method="POST" action="/profile/update" enctype="multipart/form-data">
                    <div class="info__left">
                        <div class="info__pic-wrapper">
                            <div class="info__pic-block">
                                <img src="<?php echo $data['photo']; ?>" alt="" class="info__userpic">
                            </div>
                        </div>
                        <div class="info__change">
                            <label for="changeUserpic" class="info__change-userpic-label">Загрузить фото</label>
                            <input type="file" class="info__change-userpic" id="changeUserpic" name="changeUserpic">
                        </div>
                    </div>
                    <div class="info__right">
                        <table class="info__table">
                            <tr class="info__tablerow">
                                <td class="info__titlecol">Имя:</td>
                                <td class="info__valuecol">
                                    <input type="text" class="info__change-name" id="changeName" name="changeName" value="<?php echo $data['name']; ?>">
                                    <span class="info__change-name-error"><?php echo $data['message']; ?></span>
                                </td>
                            </tr>
                            <tr class="info__tablerow">
                                <td class="info__titlecol">Возраст:</td>
                                <td class="info__valuecol">
                                    <input type="text" class="info__change-age" id="changeAge" name="changeAge" value="<?php echo $data['age']; ?>">
                                </td>
                            </tr>
                            <tr class="info__tablerow">
                                <td class="info__titlecol">Обо мне:</td>
                                <td class="info__valuecol">
                                    <textarea name="changeAbout" id="changeAbout" class="info__change-about"><?php echo $data['about']; ?></textarea>
                                </td>
                            </tr>
                        </table>
                        <div class="info__change-buttons">
                            <input type="submit" class="info__change-submit" id="changeSubmit">
                            <label for="changeSubmit" class="info__change-submit-label">Сохранить</label>
                            <a href="/profile" class="info__change-reset">Не сохранять</a>
                        </div>
                    </div>
                </form>
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
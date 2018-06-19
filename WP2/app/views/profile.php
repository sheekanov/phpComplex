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
                    <a href="login/logout" class="header__logout">Выйти</a>
                </div>
            </div>
        </header>
        <div class="container">
            <aside class="aside">
                <nav class="navigation">
                    <ul class="navigation__list">
                        <li class="navigation__item navigation__item--active">
                            <a href="" class="navigation__link">МОЙ ПРОФИЛЬ</a>
                        </li>
                        <li class="navigation__item">
                            <a href="" class="navigation__link">МОИ ФАЙЛЫ</a>
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
                            <a href="" class="info__change-link darkness__activator">Изменить личные данные</a>
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
<div class="darkness"></div>
<div class="infochange darknesspopup">
    <div class="infochange__title">Редактирование личных данных</div>
    <form action="/profile/updateProfile" method="POST" class="infochange__form" id="infochangeForm"  enctype="multipart/form-data">
        <div class="infochange__row">
            <table class="infochange__table">
                <tr class="infochange__tablerow">
                    <td class="infochange__titlecolumn">
                        <label for="changeName" class="infochange__name-label">Имя:</label>
                    </td>
                    <td class="infochange__inputcolumn">
                        <input type="text" class="infochange__name infochange__input" name="changeName" id="changeName" value="<?php echo $data['name']; ?>">
                    </td>
                </tr>
                <tr class="infochange__tablerow">
                    <td class="infochange__titlecolumn">
                        <label for="changeAge" class="infochange__age-label">Возраст:</label>
                    </td>
                    <td class="infochange__inputcolumn">
                        <input type="text" class="infochange__age infochange__input" name="changeAge" id="changeAge" value="<?php echo $data['age']; ?>">
                    </td>
                </tr>
                <tr class="infochange__tablerow">
                    <td class="infochange__titlecolumn">
                        <label for="changeUserpic" class="infochange__userpic-label">Фото:</label>
                    </td>
                    <td class="infochange__inputcolumn">
                        <input type="file" class="infochange__userpic infochange__input" name="changeUserpic" id="changeUserpic">
                    </td>
                </tr>
            </table>
        </div>
        <div class="infochange__row">
            <label for="changeAbout" class="infochange__about-label">Обо мне:</label>
            <textarea class="infochange__about" name="changeAbout" id="changeAbout"><?php echo $data['about']; ?></textarea>
        </div>
        <div class="infochange__row">
            <input type="submit" class="infochange__submit" id="infochangeSubmit">
            <button class="infochange__close darknesspopup__close">Закрыть</button>
        </div>

    </form>
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
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1140px">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Мои файлы</title>
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
                        <li class="navigation__item navigation__item--active">
                            <a href="" class="navigation__link">МОИ ФАЙЛЫ</a>
                        </li>
                        <li class="navigation__item">
                            <a href="" class="navigation__link">ВСЕ ПОЛЬЗОВАТЕЛИ</a>
                        </li>
                    </ul>
                </nav>
            </aside>
            <main class="main">
                <div class="files__upload-block">
                    <div class="files__title">Загрузить файл</div>
                    <div class="files__text">Допустимые форматы: jpg, png</div>
                    <div class="files__error-message"><?php echo  $data['message']; ?></div>
                    <form action="/files/upload" class="files__upload-form" enctype="multipart/form-data" method="POST">
                        <div class="files__form-row">
                            <input type="file" class="files__file-input" name="uploadFile">
                        </div>
                        <div class="files__form-row">
                            <textarea name="fileDescription" id="" cols="30" rows="10" class="files__textarea" placeholder="Описание файла"></textarea>
                        </div>
                        <div class="files__form-row">
                            <input type="submit" class="files__submit">
                            <input type="reset" class="files__reset">
                        </div>

                    </form>
                </div>
                <table class="files__table">
                    <thead class="files__table-head">
                    <tr class="files__row">
                        <td class="files_head-col files__head-col--delete">Удалить</td>
                        <td class="files_head-col files__head-col--preview">Превью</td>
                        <td class="files_head-col files__head-col--name">Название</td>
                        <td class="files_head-col files__head-col--desc">Описание</td>
                    </tr>
                    </thead>
                    <tbody class="files__table-body">

                    <?php foreach ($data['files'] as $file) : ?>
                    <tr class="files__row" id="<?php echo $file->getId(); ?>">
                        <td class="files__delete-col">
                            <a href="/Files/delete?id=<?php echo $file->getId()?>" class="files__delete-link">X</a>
                        </td>
                        <td class="files__preview-col">
                            <div class="files__preview-block">
                                <a href="" class="files__preview-link">
                                    <img src="<?php echo $file->getUrl(); ?>" alt="" class="files__preview-img">
                                </a>
                            </div>
                        </td>
                        <td class="files__name-col"><a href="/Viewer/show?id=<?php echo $file->getId()?>" class="files__show-link">(Открыть) <?php echo $file->filename; ?></a></td>
                        <td class="files__desc-col"><?php echo $file->description; ?></td>
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
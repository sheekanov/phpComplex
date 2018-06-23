<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1140px">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $data['filename']; ?></title>
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
                    <a href="/files" class="header__logout">Назад</a>
                </div>
            </div>
        </header>
        <main class="main-viewer">
            <img src="<?php echo $data['url']; ?>" alt="" class="viewer">
        </main>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="footer__text">Разработано во время Комплексного курса по PHP в Loftschool, 2018</div>
    </div>
</footer>

</body>
</html>
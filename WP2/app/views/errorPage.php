<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1140px">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ошибка</title>
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
                    <a href="" class="header__logout" style="display: none;">Выйти</a>
                </div>
            </div>
        </header>
        <main class="main-errors">
            <div class="container">
                <div class="errors">
                    <h1 class="error__title">Ошибка <?php echo $data['errorCode']; ?></h1>
                    <h2 class="error__subtitle"><?php  echo $data['errorDesc']; ?></h2>
                    <div class="error__text"><?php  echo $data['userMessage']; ?></div>
                </div>
            </div>
        </main>
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
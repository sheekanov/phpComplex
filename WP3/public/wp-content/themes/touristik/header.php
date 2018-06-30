<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?php echo wp_get_document_title(); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/wp-content/themes/touristik/css/libs.min.css">
    <link rel="stylesheet" href="/wp-content/themes/touristik/css/main.css">
    <link rel="stylesheet" href="/wp-content/themes/touristik/css/media.css">
</head>
<body>
<div class="wrapper">
    <header class="main-header">
        <div class="top-header">
            <div class="top-header__wrap">
                <div class="logotype-block">
                    <div class="logo-wrap"><a href="/"><img src="/wp-content/themes/touristik/img/logo.svg" alt="Логотип" class="logo-wrap__logo-img"></a></div>
                </div>
                <nav class="main-navigation">
                    <?php wp_nav_menu(); ?>
                </nav>
            </div>
        </div>
        <div class="bottom-header">
            <div class="search-form-wrap">
                <form class="search-form" action="/" method="POST">
                    <input type="text" placeholder="Поиск..." class="search-form__input" name="s">
                    <button class="search-form__btn-search"><i class="icon icon-search"></i></button>
                </form>
            </div>
        </div>
    </header>
    <!-- header_end-->
    <div class="main-content">
        <div class="content-wrapper">
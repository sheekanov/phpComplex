<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'touristik');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0HN9HgD+r#mcAf[0}r`P I$AW0NdC=N$[;@xE.7o|MVE>(:]*@b4J<**y`@WN2,w');
define('SECURE_AUTH_KEY',  '7Lv]km/,X@cDiV}Grrq[PLfaY;J61!s`={d,2pn=`BB{+sG,PjJAWs_yrc>#On%f');
define('LOGGED_IN_KEY',    '6s!pUHV{1GI.$o&)B* StL(`t9Sv{~Xz#.S<`6Ugzbe7Ocno0H1n;E?7A400UNbC');
define('NONCE_KEY',        'iQ*c:)CYf=SYeUh%oGvg$ybfO!xq_J6Wz0$p2Oc[Qd|<z^w|@:JD| %q;h `Il/0');
define('AUTH_SALT',        '7$9:rG(rti*-A8U;GYiV-&&{ES-3/% J@eWIc{w!K]g>Kk(fJ4(ZizSg5Qr>ad7)');
define('SECURE_AUTH_SALT', 'SW,pX(&k7AfWiM1n(BO%M.`y$DqW{&Y{A$;c.^P}N-N5,bFxB=/&]M[:# ed/Q =');
define('LOGGED_IN_SALT',   ' -ASY8<Kqua;dEt:r*&An-5u+9n#$_RJv<e|M~`648!]bwad{ 2Sn5|S]vl+J+*J');
define('NONCE_SALT',       '<#]M7~-Q:g6QsCRu&7/3Y+Fbw[P**Xj[^%x*cCk.Dv(Wx=aNf[J :1 Xty_>~us_');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');

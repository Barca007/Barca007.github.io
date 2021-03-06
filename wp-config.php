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
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'u1314345_default' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'u1314345_default' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'e32vW_oT' );

/** Имя сервера MySQL */
define( 'DB_HOST', '127.0.0.1' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+%Gz-1IlX()} O1HdP]xgZ9H2!+2k~{~BivaBtC8&^Sf21D<S[?,30L/R|qc~~8&' );
define( 'SECURE_AUTH_KEY',  'U_8LhUSnKe@AojU?}.{,4CX,e^6h2}Ri$e#l)-r06^tXQ=ufi3ailb48D4?Tvduc' );
define( 'LOGGED_IN_KEY',    '!7m3E;GQ|6eyhBX .!ZB*zH0jC)(@+,iAr_oi}Oq~eY8;,u^n+.nT[_K,}WB=6vU' );
define( 'NONCE_KEY',        'R9_YDeC5oyZM3`#r.0sk%>,~*AaIRYQ2E?[TF-.;[N`[-uxl@dK|BeOUo}4_UQA!' );
define( 'AUTH_SALT',        '=J.>cMNuK)~DUsP_ZKP2{HDwHM2wIMviP]4F*~kxL);!pMS]j^/oaVi,a<#7f$<2' );
define( 'SECURE_AUTH_SALT', '*bO28CDV*Ehdlyo9n X~v3pt##ht0IXwh0Sf06H{ExLOEI!SHS^%b#c%gpO,kvZj' );
define( 'LOGGED_IN_SALT',   'RcB)_YN1-2}aDJ<R:Pvt:UGS%JlLLF1*a>=bUKi~4WjX/nRu1NgPxJlbI#Sg1J1F' );
define( 'NONCE_SALT',       '*l(w7ggr=YMVHag>g1:AW!1[V!|%(R<O09Ia/ser5WdEY+)xbnzXMb_uk(k*dU_z' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Разрешаем админу загружать файлы с любым расширением. */
define( 'ALLOW_UNFILTERED_UPLOADS', true );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';

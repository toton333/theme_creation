<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'theme_creation');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'ladygaga123');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$nt9,etB]~2ajVvZ&I5e6[NwhXvq9_{o%f!&{ $zRh)Ami#u3>:}zRKA|96!|x*>');
define('SECURE_AUTH_KEY',  '<:u^x+#Iq`NkuYyi-4_3s|8Dgc6Oq_5GwWG3=n;&EAGt.I2#Q4*oDn5@?r$ <#8c');
define('LOGGED_IN_KEY',    '<],KD`JGUL`BA6^}m>)jvJQ.O_nv7G`w.ox#Eg#cr`0Ytg4t@dl)fJ}0%,cj_pq?');
define('NONCE_KEY',        '.i%={<ZcDJ;Q^D@.x ;m>w~g_?8AQ*HE(w[MMv-w~Gin{/&[G|{u?Ox/5[:% OJr');
define('AUTH_SALT',        '?P ]K6,0JDv<LlRxdh%J9Ybv/% kx-hv<7$0fIJ5U+GEaU:12aVMsC*[.*.#ivZF');
define('SECURE_AUTH_SALT', 'v/xA(KNq:)gly]#/OsqaOFKo0HK6N&Otm6Lh9fe J$Dy)X2SR9P2/PP>hmd;j&Mh');
define('LOGGED_IN_SALT',   '.`>)pg(9 lA0@Z<m:r&w7K;Wel7|@$)+(5,-]f6|i:}0bFnOW,xo5hzv^ydC]uT[');
define('NONCE_SALT',       'T,7}^. s0_f2R>Z<ZWU0q4{_K(J0!0.1Isbw3JdY&;gy,bsfG@ES4x`rh+go4*@%');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* Multisite */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/theme_creation/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

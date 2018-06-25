<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sosvolun_sosv');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'u7V^28G<,n-~z1g.@V%=] FZ8a+4Z+m|V0q~n,c=PV|b|W&h~</fny?fA&QNh,)#');
define('SECURE_AUTH_KEY',  'tPpjo#mY`go?FaR_!5-nk [8iNY7MW&{Gx(:5?}K)&A|{;LT!7/w9j3j?Mj8A;Ek');
define('LOGGED_IN_KEY',    '-xfQ0aD^XV%]1oIx8wNzJe7FvrZ|d<|&U3EW4_Q?J]Bv~aFZE:rOM^e^z3-Ed!OU');
define('NONCE_KEY',        'KOVj5+KHWJw*DXX#Te~V5IaSX(bOXUX6K-uNcEbxESXt*NNm!.0~^w^}R%|42JJw');
define('AUTH_SALT',        '[kXHWSOM`i|omSQ3=UN77gle-S{[,GA:g_{?fFKoe{JMGM!pQuy?lPQ3n`:e>WI+');
define('SECURE_AUTH_SALT', 't KWZ8YaR;zJC01]{lOs`eKWxl(|*CEmMf}TU-qFw0&!:X!Xu@|`G{2Ug5++}-Io');
define('LOGGED_IN_SALT',   'D`t9d4Yr~Q$<VR$SoO)8~(rkGj|+nd^]{vog-|f6(M{WDZ-2m4= .+pLt+d#$k+?');
define('NONCE_SALT',       '?#0!>B`o#`_c[@YhT[|mpq6p>dm9R8oA|ka$vr=p.gV;Yd+1d={|?R=|jGOmt$@Z');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

define( 'WP_MEMORY_LIMIT', '64M' );

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors',0);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

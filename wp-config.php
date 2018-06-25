<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
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
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '}Y;EzF mfYM@h40e6SZ!3j 6Asv-n/zRg[GHZ_U]$Bwi/=_6Oa66d{]i^7.6<-hD');
define('SECURE_AUTH_KEY',  '8c0czC.pd=IA#mrXT2<.*Q/~cPQG,L{#){0pF8p8_ E]sg~|bGOV9g;gOY.MoAoq');
define('LOGGED_IN_KEY',    '#OgI#l`Q!{-x[~m[5$5N{6n+*F1A?|cw>u4fQw|X7v!vUn>~GF!:*gvR^yE1JjFW');
define('NONCE_KEY',        'd,|T,{`YQUV]|(|(IDWZDV+@jIxGU^32n+j>A.<?+jZa8X(+i?F])KW2k!mub,K8');
define('AUTH_SALT',        'Ab<IHfxk&e%Dq7%)Lff;sH^Kmms1K=Fn7@hV*|X_Mj/&au!Df/?vgb;*#,#$11uS');
define('SECURE_AUTH_SALT', '*Sfyx1r%Jax%Q| |#l`~K}O[[eWKHWpht a$:eB7I` %%G <ILpXvaaOKF[<flZ`');
define('LOGGED_IN_SALT',   '~D+7xDg]!w]Bc+_&1<.MQ~87Nes@enA<S JJ&`]OHFld..%Wi(q=-OZAD%p/~V.6');
define('NONCE_SALT',       'KM+#X<~HGS/2:#=Pr[56<9NY ,l#6rA}G3S:?Dr-]B@Q(el>R.W9M~TrF6j^$&Jc');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define( 'WPCACHEHOME', 'C:\wamp\www\conkrit\wp\wp-content\plugins\wp-super-cache/' ); //Added by WP-Cache Manager
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'zhszmflxm');

/** MySQL database username */
define('DB_USER', 'conkrit');

/** MySQL database password */
define('DB_PASSWORD', 'zhszmflxm1234');

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
define('AUTH_KEY',         '3L<1CEna7Zf+W.S/t#ps9uc={b?B)Y#[<$q8-Ep`PV|}P]uI JZ2;jCN.9#3DvL{');
define('SECURE_AUTH_KEY',  'P2XBdF-]O`L!.^-r-KdM!1kDahz7DjIGvE`z7=0W*lscd.cdAPYl%(vt]FT$|YFf');
define('LOGGED_IN_KEY',    '-ovenBF1^BI4M{2[[~Lm(q-|E/M[] <a*awrNUitVSE7q%0gBV}L6**O-CqK6O^o');
define('NONCE_KEY',        '-.xjEeR|;|& UduHuK5K)!j-G)=Hk6~Z^;]~B(nT-h}Rr7~^u^1yLS/tTQ;HqfHA');
define('AUTH_SALT',        ' cAEZKEgnFti]JyDu|V<,b^7sLD4D93u((W Ai%2C&7kh&U[X{.t~+%xC(0C`8Uw');
define('SECURE_AUTH_SALT', '#&I;+iMo,o=;7O+8cL)np,-Bf)|>v3m.|+l7Jad1Y[>=BI!LS`PS}73v6B(bdC7t');
define('LOGGED_IN_SALT',   'LE$DBYL > zYw+-(G@AJJ.PV`/bw5+x-`@D N&E{/Whwc~q5.w;XW=J9u*z3QDg}');
define('NONCE_SALT',       '%3tTZK%>+|UNnPjTvP,}iVS!a?;}PJ 9K$oF,CXnH7gl9OqI%k!]6b8t,6uqMPE^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'con_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

// 휴지통 7일 보관
define ('EMPTY_TRASH_DAYS', 7);

// 리비전 3개 제한
define( 'WP_POST_REVISIONS', 3 );
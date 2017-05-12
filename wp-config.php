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
define('DB_NAME', 'makeup_tuts');

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
define('AUTH_KEY',         'zy`zfb|SQi-u},#pV4a{X,&cM+<j5U~C5~C5tbTz1|;,&4q,+lyM8;n3;U:XF,[<');
define('SECURE_AUTH_KEY',  '-D(xB*H%=Zq+,w mdiG]7|x;y:)~([=+~d=r+J!7NSMnSs}zpWJ_0`p|hyUX?9Ok');
define('LOGGED_IN_KEY',    'F(RGZ9b1c]+n%e0|X!1R#NwO1b~Z<rNm{qKM[ Nk|@xc3T6}8sIAh^C&?s2~6*Y5');
define('NONCE_KEY',        'iD{oC}<tla^K1mDkUP~W9RB9.z8`1kDq7dnsG9AjX[q>*2I^#Ch&PN&.mm-Fiyo.');
define('AUTH_SALT',        'oG+)/2R{R3F+&^:wT`l#FCz-^nE7Uqy0IwW7l51hYw2m?I/r2Jix#geB.A0I#GBr');
define('SECURE_AUTH_SALT', 'G9e@H%;:jn`&SKpZu72Z(@m#ah*RUoQ.;ogL2-cK1)GT.QKU*`KO#8~Sa]%o4K+S');
define('LOGGED_IN_SALT',   'wX M#.CPaK)03+oSi4xxH~+xb8,9aZ/x|;Rb+ma>g}AKM$^H;?n mH>LEB >AhdD');
define('NONCE_SALT',       '?x7Y[kLRkQQKbzy!!VWjrkw8dfyb=[@6<ZyN F3Sr0$(u~i!|1_ifMFzdgyg]hqV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mt_';

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

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

switch( $_SERVER['HTTP_HOST'] )
{
	case 'wsodaily.co':
	case 'www.wsodaily.co':
	{
		// Localhost
		/** The name of the database for WordPress */
		define('DB_NAME', 'pgtraine_limohire');

		/** MySQL database username */
		define('DB_USER', 'pgtraine_mike');

		/** MySQL database password */
		define('DB_PASSWORD', '+g:#A\4$QC');

		/** MySQL hostname */
		define('DB_HOST', 'localhost');

		define( 'WP_HOME', 'http://example.com/wordpress' );
	}
	break;

	case 'localhost':
	{
		// Localhost
		// /** The name of the database for WordPress */
		define('DB_NAME', 'limohire');

		/** MySQL database username */
		define('DB_USER', 'root');

		/** MySQL database password */
		define('DB_PASSWORD', '');

		/** MySQL hostname */
		define('DB_HOST', 'localhost');
	}
	break;
}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'WP_AUTO_UPDATE_CORE', false );

define('DISALLOW_FILE_EDIT', true);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3f?QK(z[,t6C1pD4?~VvDK.j/N6<BO=0DpbgP)O$OAIq`<C i4f?6,}gUn4~+nwm');
define('SECURE_AUTH_KEY',  ', H1 MwDX.LVeZ5>uWi7O<HXJO#6b3wmmO0Iwkt696}$}Uy!Za|68L^GIK>_%_-n');
define('LOGGED_IN_KEY',    'Wl74e0h= OGDK`S5HhVub*`kLnv>a60qYfH8ER,+qu&zAvtcG1uS51{>?SUyd`f]');
define('NONCE_KEY',        '=!/L o[Xw;FW(Ls$J;cF69u&7SHEi(@DKWT%b3fN*%ZS9ipo=%,FSnTm~`{PI#i*');
define('AUTH_SALT',        'I#vs!Zn%yu=&5ph4&gw[O+;P/f??xu^)8(=zTJ_h2;/LD((FvniIcA9?t^ZO FLO');
define('SECURE_AUTH_SALT', 'Ox <Cr*I,9.uaZi$uA0K#K*L|8q3N &t1#nD*@zL8^kG3..r _<CS2zNu*XWL+(Y');
define('LOGGED_IN_SALT',   'xf<uNu#F|_$%oAalF{~OS94?Ob3r!3F-].2(#/2Rbu7)%falgvE]H.&%G.m10:_U');
define('NONCE_SALT',       'h0%4)VMoS?qQknEpy<j&9i31x{7%|&Y][srJ}&mlC%Ks.ER8]]Q_c_7(huV:{>|8');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'lh_';

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

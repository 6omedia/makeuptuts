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
	case 'makeuptutorials.co':
	case 'www.makeuptutorials.co':
	{
		// Localhost
		/** The name of the database for WordPress */
		define('DB_NAME', 'pgtraine_mut_140916');

		/** MySQL database username */
		define('DB_USER', 'pgtraine_mike');

		/** MySQL database password */
		define('DB_PASSWORD', 'RhFB%f_im+mH');

		/** MySQL hostname */
		define('DB_HOST', 'localhost');

		define('WP_HOME','http://makeuptutorials.co');
		define('WP_SITEURL','http://makeuptutorials.co');
	}
	break;

	case 'localhost':
	{
		// Localhost
		// /** The name of the database for WordPress */
		define('DB_NAME', 'makeup_tuts');

		/** MySQL database username */
		define('DB_USER', 'root');

		/** MySQL database password */
		define('DB_PASSWORD', '');

		/** MySQL hostname */
		define('DB_HOST', 'localhost');

		define('WP_HOME','http://localhost/makeuptuts');
		define('WP_SITEURL','http://localhost/makeuptuts');

	}
	break;
}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'WP_MEMORY_LIMIT', '128M' );

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
define('AUTH_KEY',         'j?W1&^I%=.69q0*yyGsQHX4-i8oF6gk^MOe>CwJ$O{drQKwI%Py={Sgb*e (@7:G');
define('SECURE_AUTH_KEY',  'sA4j|R>_Q 3tUJRG2R!hdUUF7o%]Wx?0ck0b.%TQVMR9,0PDa_xpdlVAVSnU9H+D');
define('LOGGED_IN_KEY',    '~vzpo6zO1bFLCA|}#]0_ t[,)JMWa,uwH]vaRm%SRM),WapnPHvAlm(NWyX~%#L}');
define('NONCE_KEY',        '0e&yvSePjY1mHF9q?Tbal/t~5s~P1iNx[&h=}RZ]7Fp/(C]:9w{}k/m>^TNzGeW>');
define('AUTH_SALT',        'k:K?4.!]|haLkzZ.}X<Ew7{FHED31c;E:e2fSSH7%_Z!h{#M?F!?`QqYWjHQk#* ');
define('SECURE_AUTH_SALT', 'Yc&zr?q!Evlb.($g^zu!wlpe`tLju`{D;.|4s.0s{LNwyw@.0xaVF$$UysN^Yy2x');
define('LOGGED_IN_SALT',   '--K89lpmF6bh&2oocLxh`eG{QF19z&::Rq?u(`nIk-`x-#9^byW#^c4?$,F[~1!.');
define('NONCE_SALT',       'A#qve55T:a=%1gqauwpuX/s@teHe;<t.Oc-S[{q`>Pr23aOaib1`.B0F{QDp4o[x');

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

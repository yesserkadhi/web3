<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'web1' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'samiha123' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'xr%W^`XUML3K_WAy$B:B91*903E;uw1WJB*IHJhP]Aw6V:mskBuXx#R{}hkZ`~6_' );
define( 'SECURE_AUTH_KEY',  'cO|RJ{{$9QE_Xuym`OyQz^T7O17Od+9Af&hh+[n%9m,T`qRd3Lx-0r*L)~%J7,pM' );
define( 'LOGGED_IN_KEY',    's;?kO%1#IjH* 4lVN^[DJ_!#?:#O397O[ ods]Qa9].Y0!:{PE4K6^)#2jWOHEjJ' );
define( 'NONCE_KEY',        'x 0I|K&gld^}v9~Ly_JR<d_`yUDUBPG}x!yxx>sY$JH56[?]_;td/&C$4!5{QP&q' );
define( 'AUTH_SALT',        'xh2:8K/>eFS9*lhJj;pN|bP;DN{O17?8NfA(6BC_~WQaxpQ+^KY:|,LKY.[^x<h4' );
define( 'SECURE_AUTH_SALT', '>Y>[6(7p$39*l]Qy5|WAQ&<>YvXqe,lY#189uV^T/Wf7[wC3gzcB*CgS>BF$~%V4' );
define( 'LOGGED_IN_SALT',   '%wN8(wHsyAp?|05S=<h%X !c`%nR04q[bl/s,<b%E!*nlOBIvX@a>hh?(+`%!d^]' );
define( 'NONCE_SALT',       'Kj>jzv6F(Al %*ix^51=.zw{S5g(4j/W}G9_76u*kAI@R-Lg6P sOsBm$$[f+BT]' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pr1nt_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct');
/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

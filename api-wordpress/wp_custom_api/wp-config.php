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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_codehafeez' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '}+q[>R&1l;Fdeda],R;A;MYz.{#~`oo`6<Am![:D=;n>T/6?V>E|JAZca0B5Ot_L' );
define( 'SECURE_AUTH_KEY',  'X2.pW@zVq^QY0wpMMUay@d2W((n,kJn$>d}r51 zf=2eE<9U}5wn<`E^=*Vxd2v<' );
define( 'LOGGED_IN_KEY',    'tCEJ!TpZbd|0%]X7p GFI`uQp=`Mx>$|RA3!:4Yr;6qSzF>QHV@kD#siT{dVVnZD' );
define( 'NONCE_KEY',        '//990=71;<LiyU]Aq1be?93`?m_l77.QP>gewkI+`^SFiS;GAhGZIR=>4ABBrwU9' );
define( 'AUTH_SALT',        'l}N2[?*`Ywsjl#pa)S20fiQOOYC`QSFBd=2WRNa=p8VIDOxO|7f)8g@<S^U1E%:Y' );
define( 'SECURE_AUTH_SALT', 'hBTmnz=uJsxAGU`/n! /_W7{jzgCn]qF2Lg8#y#!(J%@6<Q>j)X(Y,]|xLaFbhV8' );
define( 'LOGGED_IN_SALT',   'yu`w{ {<DX9Q_a)$(F+cNIl7#e10ydnY5+{qgzO2d9G]@5@)Zg`+tCnVZ=cz<U`}' );
define( 'NONCE_SALT',       'M0R=Y3r)qOL17a/P6B>hp)LKj}8sktv0;Y6`qJJ@}3ZB}}Au fMO%!L=L,(lJ;UB' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

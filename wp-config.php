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
define( 'DB_NAME', 'wp_creiden_task' );

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
define( 'AUTH_KEY',         'gqBnSpU8FDhM^rWVl7|:9S:q8,gBLytRb5tVy!Df3Ij1th$`yk+0hiy7$53*vh]<' );
define( 'SECURE_AUTH_KEY',  '-u(QhsWE3nC`~k_Qr1bt;J9s:(x$g(SndMfOHrjFPzp;-7@[1c[1C1{Y*ybQ0v<s' );
define( 'LOGGED_IN_KEY',    'dkQ~3G8,^xUD)FmdM`F7hIHa1[9^y|+YH~NRVV_mA:/%[G>O8ip!h!H`dJ *ex:Q' );
define( 'NONCE_KEY',        'C%?UJ{,yh5B-zO]Cju@|-7fFH[f:gbvK*K<dg_1N,KUduGOb~~0~W@9X$7~oU %%' );
define( 'AUTH_SALT',        'N`.(|*<^Qj_da&NyvS@SkgNnya:E_6eGGgQz=*Xdr[@!OeaXi>`!>YHha18RZxp`' );
define( 'SECURE_AUTH_SALT', '$nZ!i97R//602mbz[GO~6M-;xm9$w}:ibEeJY4L:l(6ND3K2Z&lmD`p9;v(%w!_#' );
define( 'LOGGED_IN_SALT',   '*j:UY~QoYM{m(`0tlkukls}pakL5`;45g05;#$kN,Dq{,{F%#mZf1<:/cW^$|i-h' );
define( 'NONCE_SALT',       '(@uJU;-$B(px+T;S>xAjpM(0ty`YHcs4r&Gif]<S9+3CvZ)LaVgdvM#e?o{:IH*2' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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

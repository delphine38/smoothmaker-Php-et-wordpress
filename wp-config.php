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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'smoothmaker' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'ybEvDZm7N|9l* 0+Q/Qb6C25^4yX1t`b?JD*,K}/|d,Ok>PsFVQ8rR#sGQh,~LsF' );
define( 'SECURE_AUTH_KEY',  'pbQKIDoj]g8P?QfX>.A]?D0HZ?TmQ1R99Pkik4BRhRw8)nVND9UP;#NgOWsnQ>J8' );
define( 'LOGGED_IN_KEY',    'c|<6azLF[+xG<TGsgFL (@ikz2~8iw9#H= /=h,Ms:xzN!zu=SYATk/gK8:JwEN+' );
define( 'NONCE_KEY',        '6Gz&jh;vfAW<DF{H_Q){n~6pR4j?Itbi$qP%5~AZRQ%]FO3-LO}RDw>>>tk35]7P' );
define( 'AUTH_SALT',        '-H%M~muvDIdKxC]/! GgmOoM}2*G2m?uQHX6;G1WM!kBEK;B]FEXz{SB(QNv^Lt%' );
define( 'SECURE_AUTH_SALT', 'hRH^K-I<WfK;>5<!/^5EenJ0i)aXW{ODk0H9Jdf8:7.lw{|K6L<zEe_J%#Q6B)m-' );
define( 'LOGGED_IN_SALT',   'C `vMqCWss>pi`s;t8wHod&-ZpMol1$[D-jm79~j-b2MY%h]{j~$uYZmI~e_mwiO' );
define( 'NONCE_SALT',       'TK])(o|0=geoB+u~U46wIr_6_60Gz%|z3fT9q2$?M}s3?2|@2aO !)jFkqN{@oMH' );

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

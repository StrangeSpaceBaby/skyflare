<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'skyflare_www' );

/** Database username */
define( 'DB_USER', 'skyflare_www' );

/** Database password */
define( 'DB_PASSWORD', 'fortymendown' );

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
define( 'AUTH_KEY',         ']&7b@X1h}$Lq#4oe8Nl`DD&ocC;tA !qd!DM<Fi;P4P<wy`U?G@!x4&Kg=<d6-7#' );
define( 'SECURE_AUTH_KEY',  'XcgS](tSY~^2`jEvN2;xTFz-t*!FFOI$ad?qm <34Pq?LL(FPOoBBx0xToXzT@wd' );
define( 'LOGGED_IN_KEY',    'Tn25%GNg&tAu2o1t%3G>B]Wq$*Ktmi/)7gsbTuPbv{%1}nkE<rYjd4Sy_GcJJvBc' );
define( 'NONCE_KEY',        'Tc:SK(b5W_]w?,[s1@Kr.}K<mwD{gt/y>gO3vRDU#Fabl/oZizW4^rS.67B[FbSh' );
define( 'AUTH_SALT',        '+1#p-&R_D$`fymz/Q)R*j]ft]tFJFD$;?>RE,=y+*#^!g|3l G;L46RN.4vTUk[O' );
define( 'SECURE_AUTH_SALT', '$~m$X^K96<jt6:Cyh>o6=wC~4LpeD m%h|{Go(9YR1)r7$_=hsYEuX?c<eQH9}Z6' );
define( 'LOGGED_IN_SALT',   'o|mEvK{S0TLi{U77LQ,<=_m(fLz>Ny k[IS3Yvf_CSzxl9,h8^+det%m4yGF-;,j' );
define( 'NONCE_SALT',       'P.=,|P}lJ>2M=Y<6AP?g+[QDN(PO833Ygl=5*+M9h,bjb$qT}Q1|!#H,{casy]wv' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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


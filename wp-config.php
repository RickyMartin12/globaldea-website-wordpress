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
define( 'DB_NAME', 'wordpress_teste' );

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
define( 'AUTH_KEY',         'S;PoUDzIr+s+zSH5Z2=B9HQ^*<]U?eFBE5,g&a1Fxaa_k[ueezO6AAAC6rG^1!%?' );
define( 'SECURE_AUTH_KEY',  'KJ{:?lQH0c^JZa9$Xoh/:v{O~i :qS3pz,IG=WofW?xz}&~]wsfYfR0Mo_P}K!+?' );
define( 'LOGGED_IN_KEY',    '=oZbc?(CvJLo1~>&j:>woN]ekN}W0b9q2_AMeOpcq(~Fo=3zAGlWUd[!Bl)H4ot[' );
define( 'NONCE_KEY',        '5+trZ!1^fmX>{Nd:.bcMFSge%aGK=0j|x}CJ3_Y@t%vspX*keh<yx1=xeB:3 DjZ' );
define( 'AUTH_SALT',        '_Cc8j!taDm lxu_v%#Ivcw~PTzDv=V5fX7RtymNzP]u)9Yfc1~2[UT$XsVHF.bX>' );
define( 'SECURE_AUTH_SALT', 'vth*$s)x*dS*P<Cr@uoX5LB>1Z$&k94VTp,;4[IWL2k~JT(|GNjm{L{H>g1#&g[#' );
define( 'LOGGED_IN_SALT',   ']Y,bR+, Y%>l@bEpqS*4_)sOrBxP.;,~;S7@E&zwz78T=MH e04D^gMM%2@X9yr@' );
define( 'NONCE_SALT',       '^2Lz>/(?__[5KNN.Xy&Vn]|[I3e6. .X|)HX%l9,Q)S9t>`6(RBEm, P][H0~fvG' );

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
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

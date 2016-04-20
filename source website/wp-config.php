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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '6QB)fbP2f*?p]U6G38.SN6Fn,/NLIw{.]TbssE.J#*%t&A[h<0ra6E_9e*_3H{vF');
define('SECURE_AUTH_KEY',  'TH`Q.2%jTM@X!l4IhG#>xb/D 45B9 LZFpp,b*mo#xFWqE>eQhyc##Om%?OdUcy$');
define('LOGGED_IN_KEY',    '}6.~u~ocBe]dCC3?R6tf$&r8VQuHb,FXQBe.| Vzi%A<DTd~Ail^^7 (& kwg(>W');
define('NONCE_KEY',        '&?IOWi>244{<so9vYZY8F.#CAp-5)}zyjsGk5*aZT{zI;w)S=*6]U<@?v];#).`I');
define('AUTH_SALT',        'N<@|!jQV$~xyao>%V7-.>/XCHLU,QgRy:7i)nq4>fEnSg+o%)M])7bPJ,<0/p>s*');
define('SECURE_AUTH_SALT', '|yVJA2|b<n=3<v]0CQx886>lN6s~x*!^]@x[|;-VHJDY+1nJlz}0T0.^f[_m@YU~');
define('LOGGED_IN_SALT',   '|`e?Q*91fM>)3rL-0l5@&h|{AuaSyEAh&$DCO!NK+g|pfVB6U-utIRX((G(TZ.>7');
define('NONCE_SALT',       'sPT-D95g4!5ALsYPjOKvYqmK,|KJ<-V-eaA;;.88$5;|6WIaD]{W^I.`s6g!&N!R');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

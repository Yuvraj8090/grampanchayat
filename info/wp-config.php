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
define('DB_NAME', 'grampanc_wp390');

/** MySQL database username */
define('DB_USER', 'grampanc_wp390');

/** MySQL database password */
define('DB_PASSWORD', 'p2Sn5G0.]0');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'z4yuwrlacegx7apuwr0xcqdjbqmpybr9q8joywl10jo2omeytg8qaewbiqi2icfp');
define('SECURE_AUTH_KEY',  'eoz4ldsr194zcabxpbyx7dttlpulxbnxat6mcrj9kvt19hx3bog5xtyz2sn1alhs');
define('LOGGED_IN_KEY',    '7swjwsbmhzgqxc4fibzlwffvsbrutoejwa2peuvtqpbh1qtkssmrplgwqhvplp4p');
define('NONCE_KEY',        'k2jknow5ghwubvkag9zhyyr2bmx2i3yq93uji5ccrbddljv2aurjvwfva4sgkjpi');
define('AUTH_SALT',        'qgaux0sb8lripemdhvhs17p24ekadvloizono4dosfepzalpo7fid9q5hygd91r4');
define('SECURE_AUTH_SALT', 'l9yi2hlak4qcchg5ukklaoabdlobvystsifv9tk5jdlvawkcwqbgrrtxr8xco6fe');
define('LOGGED_IN_SALT',   'jar35gneaalkzjc5uk0wdfw1m7gt0mnw5nwbhfvpgn8cxgcsevzcyavr2vahpwdd');
define('NONCE_SALT',       'xyklsnkkglrxaanz593gcizuqsw6rcdd0tm4ipt1murhqiwala7uldlrgqjjybyu');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpbq_';

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

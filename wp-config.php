<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mutilato_bitcoinsband');

/** MySQL database username */
define('DB_USER', 'mutilato_user1');

/** MySQL database password */
define('DB_PASSWORD', 'xFD^Z&gcfg%B');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://bitcoinsband.com');
define('WP_SITEURL','http://bitcoinsband.com');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '041a07514c5cf012f007335eacd83a3fca3cfb3fc7411567275a7e6dfdf8c1af');
define('SECURE_AUTH_KEY',  '58437434d3ba2079825db041115d6fda5902b4eedeab4837e165199fba2264ac');
define('LOGGED_IN_KEY',    '12a153d60de7a8868834ee3bd28dbf1a2bc101ed92721e1df3082da2e9f15153');
define('NONCE_KEY',        'd18b5f5fae8deae8e1acbff73475b2a7e98803b0027b23f130d3fc5b6baa47c9');
define('AUTH_SALT',        '48b600399027ac4e541b62fc7c080ab1697daace79b813ffead911151b609c2b');
define('SECURE_AUTH_SALT', 'fb65760eb33bb2dd380cb8358018c7204e38ad4fef27c6b2220184b152674d21');
define('LOGGED_IN_SALT',   '8006d5a7314643e32442115dc3d000c04d64d0f33b262ffbe333819f7bcb9b88');
define('NONCE_SALT',       'dde2dd6a751ddf9c6abb7d4222dba1c9aced67b3a081b09966cca011fac1f06c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordpress');


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', 'D:/xampp/apps/wordpress/tmp');


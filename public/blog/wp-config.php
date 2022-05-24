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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bestlocalchef_wp94' );

/** MySQL database username */
define( 'DB_USER', 'bestlocalchef_wp94' );

/** MySQL database password */
define( 'DB_PASSWORD', '@S1Q647p3]' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'maoajl9ze5x2dddbehmkyefatymnk0neqgcyjpnyetzhvqixw4ezuh5qskyqsuph' );
define( 'SECURE_AUTH_KEY',  'egrjl8sduu2zvobsbz4ygx11cks0rzquiezxlscm0ofvb3cwp35r2xl9pxcsgwkb' );
define( 'LOGGED_IN_KEY',    'tvgddrdasrwklg9znb5biue744kbkifbwwhr8cmfvdpzhhfgvzboz0cyd2n7cwun' );
define( 'NONCE_KEY',        'nugcdpurijjoh1xvx2tfgw0ejspthcixk5zm8stztzzxbcsqtim6ougn4fsdxjpm' );
define( 'AUTH_SALT',        'o9ta8bp4v8xs37agrlyinxvylnlvl2dwkwwkpu87e7fo7ndcbkaitgpdp7iksso9' );
define( 'SECURE_AUTH_SALT', 'gasdxgnjrdvdp24ybpcc5apki0sehphhy0bcpq0i2iu06hxrixrunpjwitiwbs3g' );
define( 'LOGGED_IN_SALT',   'sljt80fvsthbta5pugbv4povghrsjpnjevtopksmpywqzf7nsq0rppybbvee6elv' );
define( 'NONCE_SALT',       'ivfs7vytraf10dc25orpc0rsds7jg020epfdh4nq90d715ogqnklwzuxpvyirzaf' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpu7_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

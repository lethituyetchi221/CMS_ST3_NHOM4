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
define( 'DB_NAME', 'cms_st3_v1' );

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
define( 'AUTH_KEY',         'g?[mKsyS]Al/}jTWSDYR<.,l5@PQ^T6_V@BR+K15Zdrsh&aaYI!&}L}!]MFGE2CM' );
define( 'SECURE_AUTH_KEY',  'y$!}9q=hg2|,py2tT*4]+@Z`lU9>SvM9|G9fL;8}t2IXcso,9mp`,mu:iL):68w|' );
define( 'LOGGED_IN_KEY',    'NH, $A`!|BWQrYu8aj59EdvYG,*mMnv=mhR9~*]z==KBG]P1q%Y!skyLQ*As=5j(' );
define( 'NONCE_KEY',        'ejD](D3nnm!eTHY5/ZI<Ks%8B)vO7|YLxeb$~In5A9H9(qdS3wv?^,3i>rY.tcDu' );
define( 'AUTH_SALT',        'vLFcXN{2A32kb3Q1`Xb5l;k-$a!U}H|-L`R(8&aidL{<YV4e+(>MNevc#fCFh n[' );
define( 'SECURE_AUTH_SALT', ',ch&3_m`,do:Pd3ckFl]9Y;GF:x8u^dVNIDkuXw;WF[bV_r]j4w.Y)7LP2xLY7f9' );
define( 'LOGGED_IN_SALT',   '942&O>^-kU;:RWqO)wu.#JIr2ucUX4F|56YH3L.j=KjR;1e=VT3rM&uV]XgV@4f{' );
define( 'NONCE_SALT',       '21^5?NByuuAo#s&mBu|Q?4/(hd]=K|=EZ(zqa_7yv>xk|fgJT}ePX=,/ 5s@axq~' );

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

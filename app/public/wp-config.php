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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '==cRX=q(QQ5`(a`3{SD-wfPejln5^1?3H)-7/(+#qG}eN7J1H;Z+z],],1hzTLv=' );
define( 'SECURE_AUTH_KEY',   'a*f!]!n8Z0^LEWTkB^G7r:3~.WfSs^x {=Tg/>L3I&A7jjKnl%o?06nsFXMT7{%0' );
define( 'LOGGED_IN_KEY',     '7aP:$xYLd/4ipo~2tx3(5p7UuSrROyzE<-$r?<71U,6;Tf<!U*tKUT(oU33pJHu*' );
define( 'NONCE_KEY',         '~G^)M6W)yV(Z*e!n2TamHtI4hbwF@]@[vmamF^kh&YEe:Jq7|={T!J-+8VR?f{Zr' );
define( 'AUTH_SALT',         '3[@n` u%Mvq}D-v7b_;.&ER?c7[I<;/%6hb{$Gs<lrz~@_I%kPyZhGX-]7~U>f*+' );
define( 'SECURE_AUTH_SALT',  't$u&+.ed[&mr~s@41#Bc}^g:JYs@Sj5EJ9!nw7f.>jE>l.8R`FC<Cpo/SQBV$BsY' );
define( 'LOGGED_IN_SALT',    'LP(dx~DoIF=>DJ3nddi}X&Vl:!ow5J~R|otbG=YP2&<2;H{6n0y3M[]74.&FO9;d' );
define( 'NONCE_SALT',        'u5hOrgi<<gVZfxqd6k-M~v<>Ul4w/1{1:ZZw#+sHFFp0`yW2}/=(k>y9ep 5~.|J' );
define( 'WP_CACHE_KEY_SALT', 'Q z_?L5dA0I3&Tfw5uf:2TIe[q-0H*AJ Mn_mc*[sVJa?h??Mvf{0M(o!]%8Fm D' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
// if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
	define( 'WP_DEBUG_LOG', true );
// }



define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', 'customplugin.local' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

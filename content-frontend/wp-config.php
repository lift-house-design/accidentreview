<?php

session_start();
define('IS_PRODUCTION',true);

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //

define('DB_HOST', 'localhost');

if(IS_PRODUCTION){
	define('DB_NAME', 'accidentreviewdb');
	define('DB_USER', 'accidentreview');
	define('DB_PASSWORD', 'D4gGH#2$nMV');
}else{
	define('DB_NAME', 'accidentreview');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'root');
}

// Dev
/*define('DB_NAME', 'thomas_accidentreview');
define('DB_USER', 'thomas');
define('DB_PASSWORD', 'iotaalpha08');*/

// Production
define('WP_HOME','http://accidentreview.com');
define('WP_SITEURL','http://accidentreview.com');

// Dev
//define('WP_HOME','http://accidentreview.lifthousedesign.com');
//define('WP_SITEURL','http://accidentreview.lifthousedesign.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'FS_METHOD', 'direct' );
define( 'FS_CHMOD_DIR', 0755 );
define( 'FS_CHMOD_FILE', 0644 );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '.}OIWim9G*%;w-/7H&Q`WR+?Rb$L!Ka-#Wj <m|Mh ##fyu ,l)i?Xm6 6XI>);b');
define('SECURE_AUTH_KEY',  'zk`+DLPSlfcxl&!1=!?kh+M07S*5&1|!~OxZc>sLR5Rm>Uz$fh{:g?xEF?s/L+0C');
define('LOGGED_IN_KEY',    'zU@#2lFR wCvWYr4!P/D<Atv#8~m}mrWL:^r`c|.{R1~rDP<o?HKj[t&sA6wi@yo');
define('NONCE_KEY',        'p]&ibf=d}!oFO9IanO&J+AnFY|)3{lBLQ*<f[*<V[&a||C2d$[z84Q4|M/)JX5TX');
define('AUTH_SALT',        't~rXlU^NTq.gi:C!.{yh~So4aXeIV:5s V8f,[oZh~B9P+ fiJc7~7S+iHAl1|}d');
define('SECURE_AUTH_SALT', 'k4<*iqO<YNr^B!+1A0/M^$rJcG.263-A;Rh{aj7>5-,w)09--[L7tXf`R?||`67z');
define('LOGGED_IN_SALT',   'Te[XD^3&b[9^I?BMpCChE|]E,A+,@2k]bPjZ_g*>hf`,=LI5?QcykvwL/uUeYp6c');
define('NONCE_SALT',       'K9 _T2riF_v^6h#f&d;Kla@m/B(A&30b_&BA0.+H-SZTrRiaV).7en9@ygx=LQ14');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

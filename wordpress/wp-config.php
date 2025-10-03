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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

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
define('AUTH_KEY', '9h9(^~l{Cd4Q}sv8a[JFNDfP;IV}})=[0r7hR]H6lAq!lo+o9==~e}k3QO/u5Gxy');
define('SECURE_AUTH_KEY', 's9,PT=~,)5(=Zfb5OS*HR$+nRp IH!,4GWKnrH`)Z`Ml<#k*Z![Z4.<ZpLT@{:m;');
define('LOGGED_IN_KEY', 'skm~QkhIi&lqyG?FB`nK#f/=bw.q?fqWf_/1Q.tk]rQT9;f&pxmIJzj2W*fsVI4P');
define('NONCE_KEY', 'wn*^wH)o57WInaO&LGi,B^8i(d<9ffH.8Qf+:%TBJc,RF:=t|bT~Oy6N.}ZVP{*V');
define('AUTH_SALT', 'CJcv7k./`{]6BZSGdhmHdkytAzo2}aFCSrcE6so)l4Y[OpqDO!70xu~op~h+}7(?');
define('SECURE_AUTH_SALT', 'VlO|Zy}n/*=Y/5XG%.<zc]<!:B~$k_MI:0j&GHw:T8+d@5rO.4Wm~bo@~LglB9jf');
define('LOGGED_IN_SALT', 'QK}+j&4}Q{]c!H3+hJvSt%HuHu<;&A5?@h!V7 lW!$l|F|OYi}-0c<j6KinlzRIw');
define('NONCE_SALT', 'EgM>CD~MVf]@{`V^@umLbLY_TI=F0`z}Iz,)&)W4xrYC%1MGYHo(> O#xDd{]-0e');

/**#@-*/

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
define('WP_DEBUG', true);

/* Add any custom values between this line and the "stop editing" line. */

/** Require settings for local */
require_once __DIR__ . '/wp-config-inc.php';

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

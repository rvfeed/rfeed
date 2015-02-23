<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
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
define('DB_NAME', 'ravenword');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '7N#d~{m3OM,OYp!/_~}b$:AjeD;Ym3&F_RYFUS/^<,+%n.h0BGyPNPn}F:7=|Ie ');
define('SECURE_AUTH_KEY',  'lp0JGE]PTk2slGeOL!?J|7=WS91<lnMzdn6`Zh&n83S_N[&B:Yr>9>>Wyidv-hI4');
define('LOGGED_IN_KEY',    ',$Q]!v(}lV9>S0}RI{TSI^JjZ+AO@u|u,)GYDQ1,VQ.HUeU1ia0>h$: =)w#LY^O');
define('NONCE_KEY',        'VHMy_ghxb{.[&8462ooI?%}M(#**2J2[/3{Rv*^T6]>7s7Z3V3?N-%)_Kn=C]rIS');
define('AUTH_SALT',        '7S7C/i*}9t2NqnBOBu_JH_~<B[}23Hb^:,b6:{J$]o&cELLz5hTDwS?ha9[C#YPV');
define('SECURE_AUTH_SALT', '*4$q ycLRN#b,=g{[rX(CJ_|+d4[c8tu5%r1:WeK6@s[X<o*}}@z+5@$:aR,L*uC');
define('LOGGED_IN_SALT',   '[>v<@`Gy.Z,ie*XZBoNYjN4bA[?}(q^*ne,@^IUs<jdYb>r*O|wq*!6xd?|?e42?');
define('NONCE_SALT',       'WThk ~5;^q-dRU{ek_sg$~<MI FX;ROnCv $KEtaNEd,YA&^!4oAQFn)0X92?xnY');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rvn_';

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

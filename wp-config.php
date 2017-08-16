<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'c2db');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'c2dbadmin');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'Hidalgo2017');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'j,Nu<!L@80]wYa eDiANS/)AmuCl`ziyt$a[+Uxhgx%,BNSAK+5>0 q(1e(k*Mh=');
define('SECURE_AUTH_KEY', 'ud|]W@jl.}0#[pU^FD|e.wkbFhQ_~#-hZ@gwq%*a+monBr^W0T9=Xp+9miaL?@k1');
define('LOGGED_IN_KEY', '`o|BG!6M)3.gTv(A2}M<ejcJ%uzc^=j_;x!)u-Wd33ARTRM_wESyn#Q2>J;q{*#n');
define('NONCE_KEY', 'qIGH&U3:5Qi&UN,+=m4Wimv2E$~?9DyuQ}f^zHZ(Xsiev=hK*G]hWmkJTNCnb3a`');
define('AUTH_SALT', '3U^iQap5&d/I*eQ:xc<i>TL$i/_@;a-zVeNWo uiMjdLV005$~oJVB<a}UT0 <1%');
define('SECURE_AUTH_SALT', '%=3sc0M._1NA~-^Rc^PfDSOCnO{m-piVkk?sB[56gj@Ts_U`?&_*dt&OROx[V.NA');
define('LOGGED_IN_SALT', '9m;@/m5+@wEh>)/6]Lv(e=e1;VEJU?$GPOnfQk/h4ajq$41Qhf]R/bamG{ITA(YV');
define('NONCE_SALT', '_Ih>>T~D;!#SNH_T_6vu h#f,ORk3->c6n:lx{gl^Nij OS)K}B%nw*s`H,J83X ');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


define('FS_METHOD','direct');

define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );
ini_set( 'memory_limit', '256M' );

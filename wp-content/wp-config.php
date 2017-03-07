<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'paulinef');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'paulinef');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'd7igGygzAc');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^5?LGRYtI!hyA)@RGASjSZ01 3.=59UL9Z-vIwGg8Od3<4)BT2M%4fTUB!AI;x%#');
define('SECURE_AUTH_KEY',  '5oGP;xHYE~}$?-;3AkyaW4&rGN;xpqIK-k{zI.zpRDvmN0i_3#K Zey>E4L@ZK{Q');
define('LOGGED_IN_KEY',    'IDw@0<2L.x<R0^F/A%A5_$UwQoJxA!AX(e+~_G-b_qPh`X(zB!bI}y!Q+_v~ITn9');
define('NONCE_KEY',        'Kc)w(mK4cO)7|Jh+if<oag:Xl<`_`Zj]/R4/l&n?99CUt6J%mC9~HYf?Sj65rzK2');
define('AUTH_SALT',        'Uef|RJF1m{+{Z+rR)Ay>Zw;sZ$41]OW}I=P~&px*nX_hO{WOEvH^x1r%4MB]Gcy*');
define('SECURE_AUTH_SALT', '`ZRvWOD2=xf:9C_fB|lMl[uydMnjDU$;mz)u-IPjZso[+rz2/C}dc=:i`9Wh9e^R');
define('LOGGED_IN_SALT',   'r^z>#hyC@*HuAl~G4:{ YU#P,.:It+FXU?[3CT6k0z/U x>ej$25H2L8_Z,^8_fD');
define('NONCE_SALT',       'F8+WMZrB smN{H{wy*GBk@O;wm% A|4F$5GNMZN3$>ldq`[w0!H0qiEj5sz,fe$l');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wpclient_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');

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
define('DB_NAME', 'projet_maisonquartier');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'boussads');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'JqsWM87PwX');

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
define('AUTH_KEY',         'Pt2awd?J|VyN7,p<Ir<s,+A9j4i$f&.$}YquTZ3@I<Ff!<HjO]9H_/}5BH/;$Ws@');
define('SECURE_AUTH_KEY',  ' qA/(0X|)J;cx!*i:}Ss!RiUhUC#R ;gLwFJ3-xi)!wLS]B3U4Z%~/]I! ]dIGd&');
define('LOGGED_IN_KEY',    'l=6I/?djKA`~$!1$bD=5SP=_x&r<QRFuXB~eq5<VP>OS+XBvnI[Ajm@Pi3xX`bSI');
define('NONCE_KEY',        '&@N0E~s4vWZ(xNZjC;=KaZ(oI^dZjO#lUid^:F<ts}71nl_Duw+vJ^yJQ`sRm[iF');
define('AUTH_SALT',        '+D#?Z^|nJC__@bUp4w&L#5}#6-[$Ca[mZ,u r}r</uTj0GHbukyfUmLc:9TM3jM!');
define('SECURE_AUTH_SALT', 'JI_Y;eZKvy3fof)8_eQ@t^GwB v`29XW^CBcvFu,{uD}y:lE|K`.=CsJonDe?7Bt');
define('LOGGED_IN_SALT',   'mhUF3A<Aw./&VU|%/]<CUD)W{BFn09|kloxeIhh4<35)uUsmIri]RJ]`C|(*~Amj');
define('NONCE_SALT',       '/-o4W~Ta.A1b:xmfX1x2sUHaak*qPhfX%sdetK/f%]LV|L*c1s|]h7DsCk3>7F)f');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

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

<?php
/*
Plugin Name: fiche association
Plugin URI:  https://houdab.student.codeur.online/wordpre²ss/wp-content/plugins/fiche-association/
Description: annuaire association
Version:     0.1
Author:      Houda B. - Boussad S.
*/

add_action('init', 'ficheassocation_init');									// Initialisation de Wordpress
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_plugin_styles');

add_action('add_meta_boxes', 'ficheassocation_metaboxes');					// Ajout des meta_box
add_action('save_post', 'ficheassocation_savepost',10, 2);					// Capture l'édition d'article avec 2 arguments

add_action('manage_edit-fiche_columns', 'ficheassocation_columnfilter');		// Capture la liste des colonnes pour les slides
add_action('manage_posts_custom_column', 'ficheassocation_column');			// Permet d'afficher du contenu en plus pour chaque column

/**
* Permet d'initialiser les fonctionalités liées à la fiche association
**/
function ficheassocation_init(){

	$labels = array(
	  'name' => 'Fiche',
	  'singular_name' => 'Fiche',
	  'add_new' => 'Ajouter une Fiche',
	  'add_new_item' => 'Ajouter une nouvelle Fiche',
	  'edit_item' => 'Editer une Fiche',
	  'new_item' => 'Nouvelle Fiche',
	  'view_item' => 'Voir la Fiche',
	  'search_items' => 'Rechercher une Fiche',
	  'not_found' =>  'Aucune Fiche',
	  'not_found_in_trash' => 'Aucune Fiche dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'Fiche association'
	);

	register_post_type('fiche', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'menu_position' => 9,
		'menu_icon' => 'dashicons-id',
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail', 'editor'),
    'taxonomies' => array( 'theme_mdq', 'age_mdq', 'status_members_mdq'),
		 'map_meta_cap' => true,
	));

 // add_image_size('ficheassociation',300,150,true);

}



/**
 * Register and enqueue style sheet.
 */
function register_plugin_styles() {
	wp_register_style( 'fiche-association', plugins_url( 'fiche-association/css/css_fiche-association.css' ) );
	wp_enqueue_style( 'fiche-association' );
}




/**
* Gestion des colonnes pour les slides
* @param array $columns tableau associatif contenant les column $id => $name
**/
function ficheassocation_columnfilter($columns){
	$thumb = array('thumbnail' => 'Image');

	$columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns,1,null);

	return $columns;
}

/**
* Gestion du contenu d'une colonne
* @param String $column Id de la colonne traitée
**/
function ficheassocation_column($column){
	global $post;
	if($column == 'thumbnail'){
	 echo edit_post_link(get_the_post_thumbnail($post->ID, 'fiche-association'),null,null,$post->ID);

	}
}

// Déclaration de la prise des miniatures
add_theme_support( 'post-thumbnails' );

// déclaration de la function pour redimentioner les miniatures
if ( function_exists( 'add_image_size' ) ) {

	add_image_size( 'fiche-association', 220, 180, true ); //(Image recadrée)

}

/**
* Ajoute des meta box pour les contenus
**/
function ficheassocation_metaboxes(){
	if(function_exists('add_meta_box')){
		// add_meta_box('ficheassocation','Profil association','ficheassocation_metabox','fiche','normal','high');
		add_meta_box('ficheassocation_coordonnees','Profil','ficheassociation_coordonnees_metabox','fiche','normal','high');
		add_meta_box('ficheassocation_horaires','Horaires d\'ouvertures','ficheassocation_horaires_metabox','fiche','normal','high');
		add_meta_box('ficheassocation_show','Choix d\'affichage des différentes box','ficheassociation_showbox_metabox','fiche','normal','high');
	}
}



/**
* Metabox pour gérer les coordonnées
* @param Object $object article/contenu édité
**/
function ficheassociation_coordonnees_metabox($object){
	// On génère un token (SECURITE)
	wp_nonce_field('ficheassocation','ficheassocation_nonce');
	?>
		<div class="meta-box-item-title">
			<label for="ficheassocation_name">Nom association</label>
		</div>
		<div class="meta-box-item-content">
			<input type="text" name="ficheassocation_name" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_name', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_email">Email</label>
		</div>
		<div class="meta-box-item-content">
			<input type="email" name="ficheassocation_email" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_email', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_address">Adresse</label>
		</div>
		<div class="meta-box-item-content">
			<input type="text" name="ficheassocation_address" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_address', true)); ?>">
		</div>
		<div class="meta-box-item-title">
			<label for="ficheassocation_pc">Code postal</label>
		</div>
		<div class="meta-box-item-content">
			<input type="text" name="ficheassocation_pc" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_pc', true)); ?>">
		</div>
		<div class="meta-box-item-title">
			<label for="ficheassocation_city">Ville</label>
		</div>
		<div class="meta-box-item-content">
			<input type="text" name="ficheassocation_city" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_city', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_tel">Téléphone</label>
		</div>
		<div class="meta-box-item-content">
			<input type="tel" name="ficheassocation_tel" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_tel', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_link">Lien siteweb</label>
		</div>
		<div class="meta-box-item-content">
			<input type="url" name="ficheassocation_link" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_link', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_fb">Lien facebook</label>
		</div>
		<div class="meta-box-item-content">
			<input type="url" name="ficheassocation_fb" style="width:100%;" value="<?= esc_attr(get_post_meta($object->ID, '_fb', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_tw">Lien twitter</label>
		</div>
		<div class="meta-box-item-content">
			<input type="url" name="ficheassocation_tw" style="width:100%;" value="<?= esc_attr(get_post_meta($object->ID, '_twitter', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_partner">Partenaires</label>
		</div>
		<div class="meta-box-item-content">
			<textarea name="ficheassocation_partner" rows="5" cols="50" style="width:100%; resize:none;"><?= esc_attr(get_post_meta($object->ID, '_partner', true)); ?></textarea>
		</div>

		<div class="meta-box-item-title">
			<label for="ficheassocation_membership">Adhésion (préciser la périodicité)</label>
		</div>
		<div class="meta-box-item-content">
			<input type="text" name="ficheassocation_membership" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_membership', true)); ?>">
		</div>

<?php
}


/**
* Metabox pour gérer les horaires de l'association
* @param Object $object article/contenu édité
**/
function ficheassocation_horaires_metabox($object){
	// On génère un token (SECURITE)
	wp_nonce_field('ficheassocation','ficheassocation_nonce');

	?>
	<div class="meta-box-item-title">
		<label for="ficheassocation_school">Ouverture - période scolaire</label>
	</div>
	<div class="meta-box-item-content">
		<textarea name="ficheassocation_school" rows="4" cols="50" style="width:100%; resize:none;"><?= esc_attr(get_post_meta($object->ID, '_school', true)); ?></textarea>
	</div>

	<div class="meta-box-item-title">
		<label for="ficheassocation_smallHolidays">Ouverture - petites vacances</label>
	</div>
	<div class="meta-box-item-content">
		<textarea name="ficheassocation_smallHolidays" rows="4" cols="50" style="width:100%; resize:none;"><?= esc_attr(get_post_meta($object->ID, '_smallHolidays', true)); ?></textarea>
	</div>

	<div class="meta-box-item-title">
		<label for="ficheassocation_bigHolidays">Ouverture - grandes vacances</label>
	</div>
	<div class="meta-box-item-content">
		<textarea name="ficheassocation_bigHolidays" rows="4" cols="50" style="width:100%; resize:none;"><?= esc_attr(get_post_meta($object->ID, '_bigHolidays', true)); ?></textarea>
	</div>

	<?php
}


/**
* Metabox pour gérer l'affichage des différents blocks
* @param Object $object article/contenu édité
**/
function ficheassociation_showbox_metabox($object){
	// On génère un token (SECURITE)
	wp_nonce_field('ficheassocation','ficheassocation_nonce');

	?>
	<div class="meta-box-item-title">
		<input type="checkbox" name="showDescription" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showDescription', true)), 1 ); ?> />
		<label for="showDescription">Affichage du titre et de la description</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showCaroussel" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showCaroussel', true)), 1 ); ?> />
		<label for="showCaroussel">Affichage du caroussel</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showAgenda" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showAgenda', true)), 1 ); ?> />
		<label for="showAgenda">Affichage de l'agenda</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showMembers" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showMembers', true)), 1 ); ?> />
		<label for="showMembers">Affichage de les membres</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showCoordonnees" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showCoordonnees', true)), 1 ); ?> />
		<label for="showCoordonnees">Affichage des cordonnées</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showFormulaire" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showFormulaire', true)), 1 ); ?> />
		<label for="showFormulaire">Affichage du formulaire de contact</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showPartner" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showPartner', true)), 1 ); ?> />
		<label for="showPartner">Affichage des partenaires</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showbigHolidays" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showbigHolidays', true)), 1 ); ?> />
		<label for="showbigHolidays">Affichage des ouvertues pendant les grandes vacances</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showsmallHolidays" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showsmallHolidays', true)), 1 ); ?> />
		<label for="showsmallHolidays">Affichage des ouvertues pendant les petites vacances</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showfacebook" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showfacebook', true)), 1 ); ?> />
		<label for="showfacebook">Affichage du lien facebook</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showtwitter" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showtwitter', true)), 1 ); ?> />
		<label for="showtwitter">Affichage du lien twitter</label>
	</div>

	<div class="meta-box-item-title">
		<input type="checkbox" name="showMembership" value="1" <?php checked( esc_attr(get_post_meta($object->ID, 'showMembership', true)), 1 ); ?> />
		<label for="showMembership">Affichage du montant de l'adhésion</label>
	</div>
	<?php
}

/**
* Gestion de la sauvegarde d'un article (pour la metabox)
* @param int $post_id Id du contenu édité
* @param object $post contenu édité
**/
function ficheassocation_savepost($post_id, $post){

	$nameAsso = !isset($_POST['ficheassocation_name']) ;
	$email = !isset($_POST['ficheassocation_email']);
	$phone = !isset($_POST['ficheassocation_tel']);
	$address = !isset($_POST['ficheassocation_address']);
	$postalcode = !isset($_POST['ficheassocation_pc']);
	$city = !isset($_POST['ficheassocation_city']);
	$siteweb = !isset($_POST['ficheassocation_link']);
	$facebook = !isset($_POST['ficheassocation_fb']);
	$twitter = !isset($_POST['ficheassocation_tw']);
	$partner = !isset($_POST['ficheassocation_partner']);
	$membership = !isset($_POST['ficheassocation_membership']);
	$school = !isset($_POST['ficheassocation_school']);
	$smallHolidays = !isset($_POST['ficheassocation_smallHolidays']);
	$bigHolidays = !isset($_POST['ficheassocation_bigHolidays']);


	// Le champ est défini et le token est bon ?
	if(!wp_verify_nonce($_POST['ficheassocation_nonce'] , 'ficheassocation') || $nameAsso || $logo || $email || $phone || $address || $postalcode || $city || $siteweb || $partner || $school || $smallHolidays || $bigHolidays || $facebook || $twitter || $membership){
		return $post_id;
	}

	// L'utilisateur a le droit ?
	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}

	// On met à jour la meta !
	update_post_meta($post_id,'_name',$_POST['ficheassocation_name']);
	update_post_meta($post_id,'_email',$_POST['ficheassocation_email']);
	update_post_meta($post_id,'_tel',$_POST['ficheassocation_tel']);
	update_post_meta($post_id,'_address',$_POST['ficheassocation_address']);
	update_post_meta($post_id,'_pc',$_POST['ficheassocation_pc']);
	update_post_meta($post_id,'_city',$_POST['ficheassocation_city']);
	update_post_meta($post_id,'_fb',$_POST['ficheassocation_fb']);
	update_post_meta($post_id,'_twitter',$_POST['ficheassocation_tw']);
	update_post_meta($post_id,'_link',$_POST['ficheassocation_link']);
	update_post_meta($post_id,'_partner',$_POST['ficheassocation_partner']);
	update_post_meta($post_id,'_membership',$_POST['ficheassocation_membership']);
	update_post_meta($post_id,'_school',$_POST['ficheassocation_school']);
	update_post_meta($post_id,'_smallHolidays',$_POST['ficheassocation_smallHolidays']);
	update_post_meta($post_id,'_bigHolidays',$_POST['ficheassocation_bigHolidays']);

	update_post_meta($post_id,'showDescription',$_POST['showDescription']);
	update_post_meta($post_id,'showCaroussel',$_POST['showCaroussel']);
	update_post_meta($post_id,'showAgenda',$_POST['showAgenda']);
	update_post_meta($post_id,'showMembers',$_POST['showMembers']);
	update_post_meta($post_id,'showCoordonnees',$_POST['showCoordonnees']);
	update_post_meta($post_id,'showFormulaire',$_POST['showFormulaire']);
	update_post_meta($post_id,'showPartner',$_POST['showPartner']);
	update_post_meta($post_id,'showsmallHolidays',$_POST['showsmallHolidays']);
	update_post_meta($post_id,'showbigHolidays',$_POST['showbigHolidays']);
	update_post_meta($post_id,'showfacebook',$_POST['showfacebook']);
	update_post_meta($post_id,'showtwitter',$_POST['showtwitter']);
	update_post_meta($post_id,'showMembership',$_POST['showMembership']);

}

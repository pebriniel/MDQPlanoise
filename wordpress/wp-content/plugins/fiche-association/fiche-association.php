<?php
/*
Plugin Name: fiche association
Plugin URI:  https://houdab.student.codeur.online/wordpress/wp-content/plugins/fiche-association/
Description: annuaire association
Version:     0.1
Author:      Boussad S. & Houda B.
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
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
		'taxonomies' => array('category'),
		 'map_meta_cap' => true
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
	// $thumb = array('thumbnail' => 'Image');
	$desc = array('thumbnail' => 'Description');

	$columns = array_slice($columns, 0, 3) + $desc + array_slice($columns,1,null);

	return $columns;
}

/**
* Gestion du contenu d'une colonne
* @param String $column Id de la colonne traitée
**/
function ficheassocation_column($column){
	global $post;
	if($column == 'thumbnail'){
		// echo edit_post_link(get_the_post_thumbnail($post->ID),null,null,$post->ID);
		echo $post->_desc;
	}
}

/**
* Ajoute des meta box pour les contenus
**/
function ficheassocation_metaboxes(){
	if(function_exists('add_meta_box')){
		add_meta_box('ficheassocation','Profil','ficheassocation_metabox','fiche','normal','high');
	}
}

/**
* Metabox pour gérer le Profil
* @param Object $object article/contenu édité
**/
function ficheassocation_metabox($object){
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
		<label for="ficheassocation_logo">Logo</label>
	</div>
	<div class="meta-box-item-content">
		<input type="file" name="ficheassocation_logo"  value="<?= esc_attr(get_post_meta($object->ID, '_logo', true)); ?>">
	</div>

	<div class="meta-box-item-title">
		<label for="ficheassocation_link">Lien siteweb</label>
	</div>
	<div class="meta-box-item-content">
		<input type="url" name="ficheassocation_link" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_link', true)); ?>">
	</div>

	<div class="meta-box-item-title">
		<label for="ficheassocation_timeopen">Horaires d'ouverture</label>
	</div>
	<div class="meta-box-item-content">
		<input type="time" name="ficheassocation_timeopen" style="width:30%;" value="<?= esc_attr(get_post_meta($object->ID, '_timeopen', true)); ?>">
	</div>
	<div class="meta-box-item-title">
		<label for="ficheassocation_timeclose">Horaires de fermeture</label>
	</div>
	<div class="meta-box-item-content">
		<input type="time" name="ficheassocation_timeclose" style="width:30%;" value="<?= esc_attr(get_post_meta($object->ID, '_timeclose', true)); ?>">
	</div>

	<div>
		<h2>Jours d'ouverture :</h2>
		<div class="checkbox meta-box-item-title">
	    <label for="ficheassocation_dayopen">Du</label>
		</div>
		<div class="meta-box-item-content">
			<input type="date" name="ficheassocation_dayopen" value="<?= esc_attr(get_post_meta($object->ID, '_dayopen', true)); ?>">
	  </div>

		<div class="checkbox meta-box-item-title">
			<label for="ficheassocation_dayclose">Jusqu'au</label>
		</div>
		<div class="meta-box-item-content">
			<input type="date" name="ficheassocation_dayclose" value="<?= esc_attr(get_post_meta($object->ID, '_dayclose', true)); ?>">
		</div>
	</div>


	<div class="meta-box-item-title">
		<label for="ficheassocation_desc">Description</label>
	</div>
	<div class="meta-box-item-content">
		<textarea name="ficheassocation_desc" rows="4" cols="50" style="width:100%; resize:none;"><?= esc_attr(get_post_meta($object->ID, '_desc', true)); ?></textarea>
	</div>

	<?php
}

/**
* Gestion de la sauvegarde d'un article (pour la metabox)
* @param int $post_id Id du contenu édité
* @param object $post contenu édité
**/
function ficheassocation_savepost($post_id, $post){

	// On ne fait rien en cas de save Ajax
	// if (
	// 		(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
	// 		(defined('DOING_AJAX') && DOING_AJAX)
	// ) {
	// 		return false;
	// }

	$nameAsso = !isset($_POST['ficheassocation_name']) ;
	$email = !isset($_POST['ficheassocation_email']);
	$phone = !isset($_POST['ficheassocation_tel']);
	$address = !isset($_POST['ficheassocation_address']);
	$postalcode = !isset($_POST['ficheassocation_pc']);
	$city = !isset($_POST['ficheassocation_city']);
	$siteweb = !isset($_POST['ficheassocation_link']);
	$description = !isset($_POST['ficheassocation_desc']);
	$timeopen = !isset($_POST['ficheassocation_timeopen']);
	$timeclose = !isset($_POST['ficheassocation_timeclose']);
	$dayopen = !isset($_POST['ficheassocation_dayopen']);
	$dayclose = !isset($_POST['ficheassocation_dayclose']);
	$logo = !isset($_POST['ficheassocation_logo']);

	// Le champ est défini et le token est bon ?
	if(!wp_verify_nonce($_POST['ficheassocation_nonce'] , 'ficheassocation') || $nameAsso || $email || $phone || $address || $postalcode || $city || $siteweb || $description || $timeopen || $timeclose || $dayopen || $dayclose || $logo){
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
	update_post_meta($post_id,'_link',$_POST['ficheassocation_link']);
	update_post_meta($post_id,'_desc',$_POST['ficheassocation_desc']);
	update_post_meta($post_id,'_timeopen',$_POST['ficheassocation_timeopen']);
	update_post_meta($post_id,'_timeclose',$_POST['ficheassocation_timeclose']);
	update_post_meta($post_id,'_dayopen',$_POST['ficheassocation_dayopen']);
	update_post_meta($post_id,'_dayclose',$_POST['ficheassocation_dayclose']);
	update_post_meta($post_id,'_logo',$_POST['ficheassocation_logo']);

}

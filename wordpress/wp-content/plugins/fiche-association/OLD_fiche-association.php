<?php
/*
Plugin Name: fiche association
Plugin URI:  https://houdab.student.codeur.online/wordpress/wp-content/plugins/fiche-association/
Description: annuaire association
Version:     0.1
Author:      Boussad S. & Houda B.
*/

add_action('init', 'ficheassocation_init');									// Initialisation de Wordpress
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
	  'menu_name' => 'Fiches Asso.'
	);

	register_post_type('fiche', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'menu_position' => 9,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
	));

	add_image_size('fichesAsso',800,300,true);

}

/**
* Gestion des colonnes pour les slides
* @param array $columns tableau associatif contenant les column $id => $name
**/
function ficheassocation_columnfilter($columns){
	$thumb = array('thumbnail' => 'Image');

	$columns = array_slice($columns, 0, 1) + $desc + array_slice($columns,1,null);
	return $columns;
}

/**
* Gestion du contenu d'une colonne
* @param String $column Id de la colonne traitée
**/
function ficheassocation_column($column){
	global $post;
	if($column == 'thumbnail'){
		echo edit_post_link(get_the_post_thumbnail($post->ID),null,null,$post->ID);
	}
}

/**
* Ajoute des meta box pour les contenus
**/
function ficheassocation_metaboxes(){
	add_meta_box('ficheassocation','Profil','ficheassocation_metabox','fiche','normal','high');
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
		<h4>Nom association</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="ficheassocation_name" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_name', true)); ?>">
	</div>

	<div class="meta-box-item-title">
		<h4>Email</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="email" name="ficheassocation_email" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_email', true)); ?>">
	</div>

	<div class="meta-box-item-title">
		<h4>Adresse</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="ficheassocation_address" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_address', true)); ?>">
	</div>
	<div class="meta-box-item-title">
		<h4>Code postal</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="ficheassocation_pc" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_pc', true)); ?>">
	</div>
	<div class="meta-box-item-title">
		<h4>Ville</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="ficheassocation_city" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_city', true)); ?>">
	</div>

	<div class="meta-box-item-title">
		<h4>Téléphone</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="tel" name="ficheassocation_tel" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_tel', true)); ?>">
	</div>

	<div class="meta-box-item-title">
		<h4>Lien siteweb</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="url" name="ficheassocation_link" style="width:50%;" value="<?= esc_attr(get_post_meta($object->ID, '_link', true)); ?>">
	</div>

	<div class="meta-box-item-title">
		<h4>Description</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="ficheassocation_desc" style="width:100%;" value="<?= esc_attr(get_post_meta($object->ID, '_desc', true)); ?>">
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
	$siteweb = !isset($_POST['ficheassocation_link']) ;
	$description = !isset($_POST['ficheassocation_desc']) ;

	// Le champ est défini et le token est bon ?
	if(!wp_verify_nonce($_POST['ficheassocation_nonce'] , 'ficheassocation') || $nameAsso || $email || $phone || $address || $postalcode || $city || $siteweb || $description){
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
}


/**
* Permet d'afficher le carrousel
* @param int $limit
**/
function ficheassocation_show($limit = 10){

	// On importe le javascript (proprement)
	// wp_deregister_script('jquery');
	// wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',null,'1.7.2',true);
	// wp_enqueue_script('caroufredsel',plugins_url().'/fiche-association/js/jquery.carouFredSel-5.6.4-packed.js',array('jquery'),'5.6.4',true);
	// add_action('wp_footer', 'ficheassocation_script', 30);

	// On écrit le code HTML
	$fiches = new WP_query("post_type=fiche&posts_per_page=$limit");
	echo '<div id="ficheassocation">';
	while($fiches->have_posts()){
		$fiches->the_post();
		global $post;

		// ICI METTRE AFFICHAGE DE LA PAGE
		echo '<a style="display:block; float:left; height:300px;" href="'.esc_attr(get_post_meta($post->ID, '_link', true)).'">';
		the_post_thumbnail('ficheassocation', array('style' => 'width:1000px!important;'));
		echo '</a>';
	}
	echo '</div>';
}

/**
* Affiche le code Javascript pour lancer caroufredsel
**/
function ficheassocation_script(){
	?>
	<script type="text/javascript">
		(function($){
			$('#ficheassocation').caroufredsel();
		})(jQuery);
	</script>
	<?php
}

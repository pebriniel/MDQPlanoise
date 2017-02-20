<?php
/*
Plugin Name: Carrousel
Description: Permet de gérer un slider en homepage
Version: 0.1
Author: Boussad S. - Houda B.
*/


add_action('init', 'carrousel_init');									// Initialisation de Wordpress
add_action('add_meta_boxes', 'carrousel_metaboxes');					// Ajout des meta_box
add_action('save_post', 'carrousel_savepost',10, 2);					// Capture l'édition d'article avec 2 arguments
add_action('manage_edit-slide_columns', 'carrousel_columnfilter');		// Capture la liste des colonnes pour les slides
add_action('manage_posts_custom_column', 'carrousel_column');			// Permet d'afficher du contenu en plus pour chaque column

/**
* Permet d'initialiser les fonctionalités liées au carrousel
**/
function carrousel_init(){

	$labels = array(
	  'name' => 'Slide',
	  'singular_name' => 'Slide',
	  'add_new' => 'Ajouter un Slide',
	  'add_new_item' => 'Ajouter un nouveau Slide',
	  'edit_item' => 'Editer un Slide',
	  'new_item' => 'Nouvelle Slide',
	  'view_item' => 'Voir le Slide',
	  'search_items' => 'Rechercher un Slide',
	  'not_found' =>  'Aucun Slide',
	  'not_found_in_trash' => 'Aucun Slide dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'Carrousel'
	);

	register_post_type('carrousel', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'menu_position' => 9,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
	));

	add_image_size('slider',1000,300,true);

}

/**
* Gestion des colonnes pour les slides
* @param array $columns tableau associatif contenant les column $id => $name
**/
function carrousel_columnfilter($columns){
	$thumb = array('thumbnail' => 'Image');
	$columns = array_slice($columns, 0, 1) + $thumb + array_slice($columns,1,null);
	return $columns;
}

/**
* Gestion du contenu d'une colonne
* @param String $column Id de la colonne traitée
**/
function carrousel_column($column){
	global $post;
	if($column == 'thumbnail'){
		echo edit_post_link(get_the_post_thumbnail($post->ID),null,null,$post->ID);
	}
}

/**
* Ajoute des meta box pour les contenus
**/
function carrousel_metaboxes(){
	add_meta_box('carrousel','Lien','carrousel_metabox','carrousel','normal','high');
}

/**
* Metabox pour gérer le lien
* @param Object $object article/contenu édité
**/
function carrousel_metabox($object){
	// On génère un token (SECURITE)
	wp_nonce_field('carrousel','carrousel_nonce');
	?>
	<div class="meta-box-item-title">
		<h4>Lien de ce slide</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="carrousel_link" style="width:100%;" value="<?= esc_attr(get_post_meta($object->ID, '_link', true)); ?>">
	</div>

  <div class="meta-box-item-title">
    <h4>Nom événement</h4>
  </div>
  <div class="meta-box-item-content">
    <input type="text" name="carrousel_name" style="width:100%;" value="<?= esc_attr(get_post_meta($object->ID, '_name', true)); ?>">
  </div>

  <div class="meta-box-item-title">
    <h4>Date</h4>
  </div>
  <div class="meta-box-item-content">
    <input type="date" name="carrousel_date" style="width:100%;" value="<?= esc_attr(get_post_meta($object->ID, '_date', true)); ?>">
  </div>
	<?php
}

/**
* Gestion de la sauvegarde d'un article (pour la metabox)
* @param int $post_id Id du contenu édité
* @param object $post contenu édité
**/
function carrousel_savepost($post_id, $post){

	// Le champ est défini et le token est bon ?
	if(!isset($_POST['carrousel_link']) || !wp_verify_nonce($_POST['carrousel_nonce'], 'carrousel')){
		return $post_id;
	}

	// L'utilisateur a le droit ?
	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}

	// On met à jour la meta !
	update_post_meta($post_id,'_link',$_POST['carrousel_link']);
	update_post_meta($post_id,'_name',$_POST['carrousel_name']);
	update_post_meta($post_id,'_date',$_POST['carrousel_date']);
}

/**
* Permet d'afficher le carrousel
* @param int $limit
**/

function carrousel_show($limit = 10){

	// On importe le javascript (proprement)
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery','https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js',null,'1.7.2',true);
	wp_enqueue_script('caroufredsel',plugins_url().'/mon-super-slider/js/jquery.carouFredSel-5.6.4-packed.js',array('jquery'),'5.6.4',true);
	add_action('wp_footer', 'carrousel_script', 30);

	// On écrit le code HTML
	$slides = new WP_query("post_type=slide&posts_per_page=$limit");
	echo '<div id="carrousel">';
	while($slides->have_posts()){
		$slides->the_post();
		global $post;
		echo '<a style="display:block; float:left; height:300px;" href="'.esc_attr(get_post_meta($post->ID, '_link', true)).'">';
		the_post_thumbnail('slider', array('style' => 'width:1000px!important;'));
		echo '</a>';
	}
	echo '</div>';
}

/**
* Affiche le code Javascript pour lancer caroufredsel
**/
function carrousel_script(){
	?>
	<script type="text/javascript">
		(function($){
			$('#carrousel').caroufredsel();
		})(jQuery);
	</script>
	<?php
}

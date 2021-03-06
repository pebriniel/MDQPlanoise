<?php
/*
Plugin Name: Formulaire de contact des associations
Description: formulaire de contact pour chaque association
Version:     0.1
Author:      Houda B. - Boussad S.
*/

@ini_set('display_errors', 1);

add_action('init', 'contactformasso_init');									// Initialisation de Wordpress
add_action('add_meta_boxes', 'contactformasso_metaboxes');					// Ajout des meta_box
add_action('save_post', 'contactformasso_savepost',10, 2);					// Capture l'édition d'article avec 2 arguments
/**
* Permet d'initialiser les fonctionalités liées à la Formulaire association
**/
function contactformasso_init(){
	$labels = array(
	  'name' => 'Formulaires associations',
	  'singular_name' => 'Formulaire',
	  'add_new' => 'Ajouter un Formulaire',
	  'add_new_item' => 'Ajouter un nouveau Formulaire',
	  'edit_item' => 'Editer une Formulaire',
	  'new_item' => 'Nouveau Formulaire',
	  'view_item' => 'Voir le Formulaire',
	  'search_items' => 'Rechercher un Formulaire',
	  'not_found' =>  'Aucun Formulaire',
	  'not_found_in_trash' => 'Aucun Formulaire dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'Formulaire association'
	);
	register_post_type('formulaire', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'menu_position' => 14,
		'menu_icon' => 'dashicons-format-aside',
		'capability_type'=>'post',
		'supports' => array('title')
	));
}
/**
* Ajoute des meta box pour les contenus
**/
function contactformasso_metaboxes(){
	if(function_exists('add_meta_box')){
		add_meta_box('contactformasso_contact','Informations','contactformasso_contact_metabox','formulaire','normal','high');
		add_meta_box('monsuperslide_association','Association lié à l\'activité','mdq_event_meta_liste_assoc','formulaire','normal','high');
	}
}
/**
* Metabox pour gérer les coordonnées
* @param Object $object article/contenu édité
**/
function contactformasso_contact_metabox($object){

	?>
	<form method="post">
	
		<input type="hidden" name="__nonce" value="<?php echo wp_create_nonce('contactformasso'); ?>" />
		
		<div class="meta-box-item-title">
			<label for="contactformasso_name">Prénom et nom du récepteur</label>
		</div>
		<div class="meta-box-item-content">
			<input type="text" name="contactformasso_name" style="width:70%;" value="<?= esc_attr(get_post_meta($object->ID, '_namecontact', true)); ?>">
		</div>

		<div class="meta-box-item-title">
			<label for="contactformasso_email">Email du récepteur</label>
		</div>
		<div class="meta-box-item-content">
			<input type="email" name="contactformasso_email" style="width:70%;" value="<?= esc_attr(get_post_meta($object->ID, '_emailcontact', true)); ?>">
		</div>
	</form>

	
<?php
}
function contactformasso_savepost($post_id, $post){
	$nameContact = !isset($_POST['contactformasso_name']);
	$emailContact = !isset($_POST['contactformasso_email']);

 
	if(!wp_verify_nonce($_POST['__nonce'], 'contactformasso') || $nameContact || $emailContact){
	
		return $post_id;
	} 

	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}
	// MAJ meta
	update_post_meta($post_id,'_namecontact',$_POST['contactformasso_name']);
	update_post_meta($post_id,'_emailcontact',$_POST['contactformasso_email']);
	update_post_meta($post_id,'mdq_association_id',$_POST['event_assoc_list']);
}
<?php

/**
 * Plugin Name: Gestion des membres pour les associations
 * Description: Gestion des membres pour les associations de Planoise
 * Version:     0.1
 * Author:      Boussad Sadadou, Houda Bouthalil
 */

require_once("inc/metabox.php");

add_action('init', 'mdq_membre_assoc_init');                                    // Initialisation de Wordpress
add_action( 'wp_enqueue_scripts', 'register_membre_style_activite');            // Register style sheet.
add_action('add_meta_boxes', 'mdq_membre_assoc_metaboxes');                     // Ajout des meta_box
add_action('save_post', 'mdq_membre_assoc_savepost', 10, 2);					// Capture l'édition d'article avec 2 arguments

/**
 *  Initiation d'un formulaire pour la page
 */


function mdq_membre_assoc_init(){

    $labels = array(
	  'name' => 'Membres',
	  'singular_name' => 'membre',
	  'add_new' => 'Ajouter un membre',
	  'add_new_item' => 'Ajouter un nouveau membre',
	  'edit_item' => 'Editer un membre',
	  'new_item' => 'Nouveau membre',
	  'view_item' => 'Voir le membre',
	  'search_items' => 'Rechercher un membre',
	  'not_found' =>  'Aucun membre',
	  'not_found_in_trash' => 'Aucun membre dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'Membres'
	);

	register_post_type('members', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'menu_position' => 9,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
        'taxonomies' => array( 'status_members_mdq' ),
	));
}

/**
 * Register and enqueue style sheet.
 */
function register_membre_style_activite() {
	wp_register_style( 'mdq-membre', plugins_url( 'mdq-assoc-members/css/css_mdq-membre.css' ) );
	wp_enqueue_style( 'mdq-membre' );
}


/**
* Ajoute des meta box pour les contenus
**/
function mdq_membre_assoc_metaboxes(){
	add_meta_box('monsuperslide','Description','mdq_member_meta_description','members','normal','high');
    add_meta_box('monsuperslide_association','Association lié à l\'activité','mdq_member_meta_liste_assoc','members','normal');
}


/**
* Gestion de la sauvegarde d'un article (pour la metabox)
* @param int $post_id Id du contenu édité
* @param object $post contenu édité
**/
function mdq_membre_assoc_savepost($post_id, $post){

	// Le champ est défini et le token est bon ?
	if(!isset($_POST['event_description']) || !wp_verify_nonce($_POST['monsuperslider_nonce'], 'monsuperslider')){
		return $post_id;
	}

	// L'utilisateur a le droit ?
	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}

	// On met à jour la meta !
	update_post_meta($post_id,'mdq_event_description',$_POST['event_description']);
	update_post_meta($post_id,'mdq_event_start',$_POST['event_datedebut']);
	update_post_meta($post_id,'mdq_event_end',$_POST['event_datefin']);
	update_post_meta($post_id,'mdq_association_id',$_POST['event_assoc_list']);
	update_post_meta($post_id,'mdq_event_adresse',$_POST['event_adresse']);
}

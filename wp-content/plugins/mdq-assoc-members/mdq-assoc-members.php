<?php

/**
 * Plugin Name: Gestion des membres
 * Description: Gestion des membres pour la Maison de Quartier
 * Version:     0.1
 * Author:      Boussad Sadadou, Houda Boutalil
 */

require_once("inc/metabox.php");

add_action('init', 'mdq_members_init');                                   // Initialisation de Wordpress
add_action('add_meta_boxes', 'mdq_members_metaboxes');                    // Ajout des meta_box
add_action('save_post', 'mdq_members_savepost', 10, 2);					// Capture l'édition d'article avec 2 arguments

/**
 *  Initiation d'un formulaire pour la page
 */


function mdq_members_init(){

    $labels = array(
	  'name' => 'Membres',
	  'singular_name' => 'members',
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
		'menu_position' => 11,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
        'taxonomies' => array( 'status_members_mdq' ),
	));
}

/**
* Ajoute des meta box pour les contenus
**/
function mdq_members_metaboxes(){
	add_meta_box('monsuperslide','Description','mdq_members_description','members','normal','high');
	add_meta_box('monsuperslideassociation','liste_membre_assoc','mdq_members_liste_assoc','members','normal','high');
}


/**
* Gestion de la sauvegarde d'un article (pour la metabox)
* @param int $post_id Id du contenu édité
* @param object $post contenu édité
**/
function mdq_members_savepost($post_id, $post){

	// Le champ est défini et le token est bon ?
	if(!isset($_POST['members_description']) || !wp_verify_nonce($_POST['monsuperslider_nonce'], 'monsuperslider') || !wp_verify_nonce($_POST['monsuperslideassociation_nonce'], 'monsuperslideassociation')){
		return $post_id;
	}

	// L'utilisateur a le droit ?
	$type = get_post_type_object($post->post_type);
	if(!current_user_can($type->cap->edit_post)){
		return $post_id;
	}

	// On met à jour la meta !
	update_post_meta($post_id,'mdq_members_description',$_POST['members_description']);
	update_post_meta($post_id,'mdq_members_associations',$_POST['membres_assoc_list']);

}

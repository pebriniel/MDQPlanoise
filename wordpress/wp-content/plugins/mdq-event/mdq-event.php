<?php

/**
 * Plugin Name: Gestion des évènements
 * Description: Gestion des évènements pour la Maison de Quartier
 * Version:     0.1
 * Author:      Boussad Sadadou, Houda Boutalil
 */

require_once("inc/metabox.php");

add_action('init', 'mdq_assoc_init');                                   // Initialisation de Wordpress
// Register style sheet.
add_action( 'wp_enqueue_scripts', 'register_plugin_style_activite');
add_action('add_meta_boxes', 'mdq_event_metaboxes');                    // Ajout des meta_box
add_action('save_post', 'mdq_event_savepost',10, 2);					// Capture l'édition d'article avec 2 arguments

/**
 *  Initiation d'un formulaire pour la page
 */


function mdq_assoc_init(){

    $labels = array(
	  'name' => 'Activité',
	  'singular_name' => 'activite',
	  'add_new' => 'Ajouter une activité',
	  'add_new_item' => 'Ajouter un nouvelle activité',
	  'edit_item' => 'Editer une activité',
	  'new_item' => 'Nouvelle activité',
	  'view_item' => 'Voir l\'activité',
	  'search_items' => 'Rechercher une activité',
	  'not_found' =>  'Aucune activité',
	  'not_found_in_trash' => 'Aucune activité dans la corbeille',
	  'parent_item_colon' => '',
	  'menu_name' => 'Activité'
	);

	register_post_type('activite', array(
		'public' => true,
		'publicly_queryable' => false,
		'labels' => $labels,
		'menu_position' => 9,
		'capability_type'=>'post',
		'supports' => array('title', 'thumbnail'),
        'taxonomies' => array( 'category', 'theme_mdq', 'age_mdq' ),
	));
}

/**
 * Register and enqueue style sheet.
 */
function register_plugin_style_activite() {
	wp_register_style( 'mdq-event', plugins_url( 'mdq-event/css/css_mdq-event.css' ) );
	wp_enqueue_style( 'mdq-event' );
}


/**
* Ajoute des meta box pour les contenus
**/
function mdq_event_metaboxes(){
	add_meta_box('monsuperslide','Description','mdq_event_meta_description','activite','normal','high');
    add_meta_box('monsuperslide_association','Association lié à l\'activité','mdq_event_meta_liste_assoc','activite','normal');
	add_meta_box('monsuperslide_time','Date de début','mdq_event_meta_date','activite','normal');
}


/**
* Gestion de la sauvegarde d'un article (pour la metabox)
* @param int $post_id Id du contenu édité
* @param object $post contenu édité
**/
function mdq_event_savepost($post_id, $post){

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

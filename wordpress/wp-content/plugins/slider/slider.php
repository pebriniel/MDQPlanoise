<?php
/*
Plugin Name: Événements de chaque association
Author: Houda B. - Boussad S.

*/

// Custom Post Type Setup
add_action( 'init', 'slider_post_type' );
add_action('save_post', 'slider_save_details');

function slider_post_type() {

	$labels = array(
		'name' => 'Événements',
		'singular_name' => 'Événement',
		'add_new' => 'Ajouter un événement',
		'add_new_item' => 'Ajouter un nouveau slide',
		'edit_item' => 'Editer un slide',
		'new_item' => 'New slider Image',
		'view_item' => 'Voir le slide',
		'search_items' => 'Rechercher un slide',
		'not_found' => 'Aucun slide trouvé',
		'not_found_in_trash' => 'Aucun slide dans la corbeille',
		'parent_item_colon' => '',
		'menu_name' => 'Événements'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 10,
		'menu_icon' => 'dashicons-images-alt',
		'supports' => array('title','excerpt','thumbnail')
	);
	register_post_type('slider', $args);
}

// Add theme support for featured images if not already present
function slider_addFeaturedImageSupport() {

	get_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-thumbnails');
	add_image_size('featured_preview', 220, 180, true);
	}
add_action( 'after_setup_theme', 'slider_addFeaturedImageSupport');


function slider_addFeaturedImageSupport_slider() {


	get_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-thumbnails');
	add_image_size('size-carousel-display-home', 1000, 500, true);

	}
add_action( 'before_setup_theme', 'slider_addFeaturedImageSupport_slider');

// Load admin
require_once('slider-admin.php');

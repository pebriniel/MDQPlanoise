<?php
/*
Plugin Name: Slider des événements de chaque association

Author:

*/



////////////////////////////
// Custom Post Type Setup
////////////////////////////
add_action( 'init', 'slider_post_type' );
function slider_post_type() {
	$labels = array(
		'name' => 'Evénements',
		'singular_name' => 'Evénement',
		'add_new' => __('Add New', 'cpt-bootstrap-carousel'),
		'add_new_item' => __('Add New slider Image', 'cpt-bootstrap-carousel'),
		'edit_item' => __('Edit slider Image', 'cpt-bootstrap-carousel'),
		'new_item' => __('New slider Image', 'cpt-bootstrap-carousel'),
		'view_item' => __('View slider Image', 'cpt-bootstrap-carousel'),
		'search_items' => __('Search slider Images', 'cpt-bootstrap-carousel'),
		'not_found' => __('No slider Image', 'cpt-bootstrap-carousel'),
		'not_found_in_trash' => __('No slider Images found in Trash', 'cpt-bootstrap-carousel'),
		'parent_item_colon' => '',
		'menu_name' => __('slider', 'cpt-bootstrap-carousel')
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
		'supports' => array('title','excerpt','thumbnail', 'page-attributes')
	);
	register_post_type('slider', $args);
}

// Add theme support for featured images if not already present
function slider_addFeaturedImageSupport() {
	$supportedTypes = get_theme_support( 'post-thumbnails' );
	if( $supportedTypes === false ) {
		add_theme_support( 'post-thumbnails', array( 'slider' ) );
		add_image_size('featured_preview', 100, 55, true);
	} elseif( is_array( $supportedTypes ) ) {
		$supportedTypes[0][] = 'slider';
		add_theme_support( 'post-thumbnails', $supportedTypes[0] );
		add_image_size('featured_preview', 100, 55, true);
	}
}
add_action( 'after_setup_theme', 'slider_addFeaturedImageSupport');

// Load in the pages doing everything else!
require_once('slider-admin.php');
require_once('slider-settings.php');
// require_once('slider-frontend.php');

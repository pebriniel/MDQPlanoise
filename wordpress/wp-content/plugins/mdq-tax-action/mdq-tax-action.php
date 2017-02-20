
<?php
/*
Plugin Name: Add "Theme" custom taxonomy
Description: Add the new custom taxonomy "Theme", don't forget to flush your permalinks!
Author: Boussad Sadadou
*/

add_action( 'init', 'register_Theme_taxonomy', 0 );
function register_Theme_taxonomy() {

	// !Load i18n
	load_plugin_textdomain( 'tax_mdq_theme', false, basename( dirname( __FILE__ ) ) . '/languages/' );

	// !Theme Taxonomy
	$labels = array(
		'name'							=> _x( 'themes', 'taxonomy general name', 'tax_mdq_theme' ),
		'singular_name'					=> _x( 'theme', 'taxonomy singular name', 'tax_mdq_theme' ),
		'menu_name'						=> _x( 'Themes', 'taxonomy general name', 'tax_mdq_theme' ),
		'search_items'					=> __( 'Search Themes', 'tax_mdq_theme' ),
		'popular_items'					=> __( 'Popular Themes', 'tax_mdq_theme' ),
		'all_items'						=> __( 'All Themes', 'tax_mdq_theme' ),
		'parent_item'					=> __( 'Parent Theme', 'tax_mdq_theme' ),
		'parent_item_colon'				=> __( 'Parent Theme:', 'tax_mdq_theme' ),
		'edit_item'						=> __( 'Edit Theme', 'tax_mdq_theme' ),
		'view_item'						=> __( 'View Theme', 'tax_mdq_theme' ),
		'update_item'					=> __( 'Update Theme', 'tax_mdq_theme' ),
		'add_new_item'					=> __( 'Add New Theme', 'tax_mdq_theme' ),
		'new_item_name'					=> __( 'New Theme Name', 'tax_mdq_theme' ),
		'separate_items_with_commas' 	=> __( 'Separate Themes with commas', 'tax_mdq_theme' ),
		'add_or_remove_items'			=> __( 'Add or remove Themes', 'tax_mdq_theme' ),
		'choose_from_most_used'			=> __( 'Choose from the most used Themes', 'tax_mdq_theme' ),
		'not_found'						=> __( 'No Themes found.', 'tax_mdq_theme' ),
	);

	$rewrite = array(
		'slug'                       => 'slug_mdq_theme',
		'with_front'                 => true,
		'hierarchical'               => true,
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'theme_mdq', array( 'post' ), $args );

}

add_filter( 'term_updated_messages', 'theme_taxonomy_messages' );
function theme_taxonomy_messages( $messages ) {

	$messages['Theme'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Theme added.', 'tax_mdq_theme' ),
		2 => __( 'Theme deleted.', 'tax_mdq_theme' ),
		3 => __( 'Theme updated.', 'tax_mdq_theme' ),
		4 => __( 'Theme not added.', 'tax_mdq_theme' ),
		5 => __( 'Theme not updated.', 'tax_mdq_theme' ),
		6 => __( 'Themes deleted.', 'tax_mdq_theme' ),
	);

	return $messages;
}

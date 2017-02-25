
<?php
/*
Plugin Name: Add "age" custom taxonomy
Description: Add the new custom taxonomy "age", don't forget to flush your permalinks!
Author: Boussad Sadadou
*/

add_action( 'init', 'register_Age_taxonomy', 0 );
function register_Age_taxonomy() {

	// !Load i18n
	load_plugin_textdomain( 'tax_mdq_age', false, basename( dirname( __FILE__ ) ) . '/languages/' );

	// !age Taxonomy
	$labels = array(
		'name'							=> _x( 'ages', 'taxonomy general name', 'tax_mdq_age' ),
		'singular_name'					=> _x( 'age', 'taxonomy singular name', 'tax_mdq_age' ),
		'menu_name'						=> _x( 'ages', 'taxonomy general name', 'tax_mdq_age' ),
		'search_items'					=> __( 'Search ages', 'tax_mdq_age' ),
		'popular_items'					=> __( 'Popular ages', 'tax_mdq_age' ),
		'all_items'						=> __( 'All ages', 'tax_mdq_age' ),
		'parent_item'					=> __( 'Parent age', 'tax_mdq_age' ),
		'parent_item_colon'				=> __( 'Parent age:', 'tax_mdq_age' ),
		'edit_item'						=> __( 'Edit age', 'tax_mdq_age' ),
		'view_item'						=> __( 'View age', 'tax_mdq_age' ),
		'update_item'					=> __( 'Update age', 'tax_mdq_age' ),
		'add_new_item'					=> __( 'Add New age', 'tax_mdq_age' ),
		'new_item_name'					=> __( 'New age Name', 'tax_mdq_age' ),
		'separate_items_with_commas' 	=> __( 'Separate ages with commas', 'tax_mdq_age' ),
		'add_or_remove_items'			=> __( 'Add or remove ages', 'tax_mdq_age' ),
		'choose_from_most_used'			=> __( 'Choose from the most used ages', 'tax_mdq_age' ),
		'not_found'						=> __( 'No ages found.', 'tax_mdq_age' ),
	);

	$rewrite = array(
		'slug'                       => 'slug_mdq_age',
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
	register_taxonomy( 'age_mdq', array( 'post' ), $args );

}

add_filter( 'term_updated_messages', 'age_taxonomy_messages' );
function age_taxonomy_messages( $messages ) {

	$messages['age'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'age added.', 'tax_mdq_age' ),
		2 => __( 'age deleted.', 'tax_mdq_age' ),
		3 => __( 'age updated.', 'tax_mdq_age' ),
		4 => __( 'age not added.', 'tax_mdq_age' ),
		5 => __( 'age not updated.', 'tax_mdq_age' ),
		6 => __( 'ages deleted.', 'tax_mdq_age' ),
	);

	return $messages;
}

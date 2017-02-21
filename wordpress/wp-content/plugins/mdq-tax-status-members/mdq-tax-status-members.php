<?php
/*
Plugin Name: Status membres associations
Description: Gestions des status pour les membres de l'association
Author: Boussad Sadadou
*/

add_action( 'init', 'register_Status_members_taxonomy', 0 );
function register_Status_members_taxonomy() {

	// !Load i18n
	load_plugin_textdomain( 'tax_mdq_status_members' , false, basename( dirname( __FILE__ ) ) . '/languages/' );

	// !Status_members Taxonomy
	$labels = array(
		'name'							=> _x( 'Status members', 'taxonomy general name', 'tax_mdq_status_members' ),
		'singular_name'					=> _x( 'Status members', 'taxonomy singular name', 'tax_mdq_status_members' ),
		'menu_name'						=> _x( 'Status members', 'taxonomy general name', 'tax_mdq_status_members' ),
		'search_items'					=> __( 'Search Status_members', 'tax_mdq_status_members' ),
		'popular_items'					=> __( 'Popular Status_members', 'tax_mdq_status_members' ),
		'all_items'						=> __( 'All Status_members', 'tax_mdq_status_members' ),
		'parent_item'					=> __( 'Parent Status_members', 'tax_mdq_status_members' ),
		'parent_item_colon'				=> __( 'Parent Status_members:', 'tax_mdq_status_members' ),
		'edit_item'						=> __( 'Edit Status_members', 'tax_mdq_status_members' ),
		'view_item'						=> __( 'View Status_members', 'tax_mdq_status_members' ),
		'update_item'					=> __( 'Update Status_members', 'tax_mdq_status_members' ),
		'add_new_item'					=> __( 'Add New Status_members', 'tax_mdq_status_members' ),
		'new_item_name'					=> __( 'New Status_members Name', 'tax_mdq_status_members' ),
		'separate_items_with_commas' 	=> __( 'Separate Status_members with commas', 'tax_mdq_status_members' ),
		'add_or_remove_items'			=> __( 'Add or remove Status_members', 'tax_mdq_status_members' ),
		'choose_from_most_used'			=> __( 'Choose from the most used Status_members', 'tax_mdq_status_members' ),
		'not_found'						=> __( 'No Status_members found.', 'tax_mdq_status_members' ),
	);

	$rewrite = array(
		'slug'                       => 'slug_mdq_status_members',
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
	register_taxonomy( 'status_members_mdq', array( 'post' ), $args );

} 

add_filter( 'term_updated_messages', 'status_members_taxonomy_messages' );
function status_members_taxonomy_messages( $messages ) {

	$messages['Status_members'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Status_members added.', 'tax_mdq_status_members' ),
		2 => __( 'Status_members deleted.', 'tax_mdq_status_members' ),
		3 => __( 'Status_members updated.', 'tax_mdq_status_members' ),
		4 => __( 'Status_members not added.', 'tax_mdq_status_members' ),
		5 => __( 'Status_members not updated.', 'tax_mdq_status_members' ),
		6 => __( 'Status_members deleted.', 'tax_mdq_status_members' ),
	);

	return $messages;
}

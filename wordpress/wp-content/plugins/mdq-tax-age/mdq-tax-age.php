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



/* -- boussad update -- */
/* -- permet de changer l'ordre d'affichage des filtres... nous indiquer une valeur de 0 à X (valeur numérique) et nous l'utilisons comme ordre d'affichage --*/
// Add term page
function ordershow_taxonomy_add_new_meta_field() {
	// this will add the custom meta field to the add new term page
	?>
	<div class="form-field">
		<label for="term_meta[custom_term_meta_ordershow]"><?php _e( 'Example meta field', 'pippin' ); ?></label>
		<input type="numeric" name="term_meta[custom_term_meta_ordershow]" id="term_meta[custom_term_meta_ordershow]" value="" placeholder="0-100">
		<p class="description"><?php _e( 'Enter a value for this field','pippin' ); ?></p>
	</div>
<?php
}
add_action( 'age_mdq_add_form_fields', 'ordershow_taxonomy_add_new_meta_field', 10, 2 );

// Edit term page
function ordershow_taxonomy_edit_meta_field($term) {

	// put the term ID into a variable
	$t_id = $term->term_id;

	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>

	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta_ordershow]"><?php _e( 'Ordre d\'affichage', 'ordershow' ); ?></label></th>
		<td>
			<input type="numeric" name="term_meta[custom_term_meta_ordershow]" id="term_meta[custom_term_meta_ordershow]" value="<?php echo esc_attr( $term_meta['custom_term_meta_ordershow'] ) ? esc_attr( $term_meta['custom_term_meta_ordershow'] ) : ''; ?>" placeholder="0-100">
			<p class="description"><?php _e( 'Enter a value for this field','ordershow' ); ?></p>
		</td>
	</tr>
<?php
}
add_action( 'age_mdq_edit_form_fields', 'ordershow_taxonomy_edit_meta_field', 10, 2 );

// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		// Save the option array.
		update_option( "taxonomy_$t_id", $term_meta );
	}
}
add_action( 'edited_age_mdq', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_age_mdq', 'save_taxonomy_custom_meta', 10, 2 );

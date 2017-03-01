<?php

// Add column in admin list view to show featured image
function slider_get_featured_image($post_ID) {
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);
	if ($post_thumbnail_id) {
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
		return $post_thumbnail_img[0];
	}
}
function slider_columns_head($defaults) {
	$defaults['featured_image'] = 'Image événement';
	$defaults['featured_date_start'] = 'Date de début';
	// $defaults['Association_org'] = 'Association organisatrice';
	return $defaults;
}
function slider_columns_content($column_name, $post_ID) {
	if ($column_name == 'featured_image') {
		$post_featured_image = slider_get_featured_image($post_ID);
		if ($post_featured_image) {
			echo '<a href="'.get_edit_post_link($post_ID).'"><img src="' . $post_featured_image . '" alt="" style="max-width:50%;" /></a>';
		}
	}

	if ($column_name == 'featured_date_start') {
		$x = esc_attr(get_post_meta($post_ID, 'event_asso_start', true));
		echo $x;
	}


	// if ($column_name == 'Association_org') {
	// 	$post_assoc_orga = get_the_terms($post_ID, 'asso_organisatrice');
	// 	if ($post_categories) {
	// 		$output = '';
	// 		foreach($post_categories as $cat){
	// 			$output .= $cat->name.', ';
	// 		}
	// 		echo trim($output, ', ');
	// 	} else {
	// 		echo 'Aucune categorie';
	// 	}
	// }
}
add_filter('manage_slider_posts_columns', 'slider_columns_head');
add_action('manage_slider_posts_custom_column', 'slider_columns_content', 10, 2);


// Extra admin field for image URL
function slider_image_url(){
	global $post;
	$custom = get_post_custom($post->ID);
	$slider_image_url = isset($custom['slider_image_url']) ?  $custom['slider_image_url'][0] : '';
	$slider_image_url_openblank = isset($custom['slider_image_url_openblank']) ?  $custom['slider_image_url_openblank'][0] : '0';
	$slider_image_link_text = isset($custom['slider_image_link_text']) ?  $custom['slider_image_link_text'][0] : '';
	?>
	<p>
		<label>URL de l'image:</label>
		<input type="url" name="slider_image_url" value="<?php echo $slider_image_url; ?>" style="width: 100%"/> <br />
	</p>

	<p>
		<label>
			<input type="checkbox" name="slider_image_url_openblank" <?php if($slider_image_url_openblank == 1){ echo ' checked="checked"'; } ?> value="1" />
			Ouvrir le lien dans un nouvel onglet ?
		</label>
	</p>

	<p>
		<label>Lien du texte :</label>
		<input type="text" name="slider_image_link_text" value="<?php echo $slider_image_link_text; ?>" style="width: 100%"/> <br />
	</p>

	<?php
}

function event_asso_meta($object){
	// On génère un token (SECURITE)
	wp_nonce_field('slider_asso','sliderasso_nonce');
	?>
	<div class="meta-box-item-title">
		<h4>Date de début événement</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="date" name="event_asso_start" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_start', true)); ?>" placeholder="jj/mm/aaaa" />
		<input type="time" name="event_asso_start_hour" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_hour_start', true)); ?>" placeholder="00h00" />
	</div>
	<div class="meta-box-item-title">
		<h4>Date de fin événement</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="date" name="event_asso_end" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_end', true)); ?>" placeholder="jj/mm/aaaa" />
		<input type="time" name="event_asso_hour_end" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_hour_end', true)); ?>" placeholder="00h00" />
	</div>
	<div class="meta-box-item-title">
		<h4>Adresse de l'évènement</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="event_asso_address" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_address', true)); ?>" placeholder="adresse" />
	</div>
	<?php
}

function mdq_listing_assoc($object){
	wp_nonce_field('slider_asso','sliderasso_nonce');
	?>
	<div class="meta-box-item-content">
		<select name="event_listing_asso">
			<?php
			query_posts(array('post_type' => 'fiche'));

			if ( have_posts() ){
				while ( have_posts() ){
					the_post();
					global $post;
					$selected= "";
					if($post->ID == get_post_meta($object->ID, 'mdq_listing_assoc', true)){
						$selected = "selected";

					}
					?>
						<option value="<?= $post->ID; ?>" <?= $selected; ?>><?= $post->_name; ?></option>
					<?php
				}
			}
		?>
		</select>
	</div>
	<?php
}

function slider_admin_init_custpost(){
	add_meta_box("slider_image_url", "Slide Options", "slider_image_url", "slider", "side", "high");
	add_meta_box('event_by_asso','Informations sur l\'événement','event_asso_meta','slider','normal','high');
	add_meta_box('event_list_asso','Association organisatrice de  l\'événement','mdq_listing_assoc','slider','normal', 'high');
}
add_action("add_meta_boxes", "slider_admin_init_custpost");

function slider_save_details(){
	global $post;

	$start_date = isset($_POST['event_asso_start']);
	$end_date = isset($_POST['event_asso_end']);
	$end_hour_date = isset($_POST['event_asso_hour_start']);
	$start_hour_date = isset($_POST['event_asso_hour_end']);
	$address_event = isset($_POST['event_asso_address']);

	$list_event_asso = isset($_POST['event_listing_asso']);

	if (isset($_POST["slider_image_url"]) || !wp_verify_nonce($_POST['sliderasso_nonce'], 'slider_asso') || $start_date || $end_date || $address_event || $list_event_asso) {
		$openblank = 0;
		if(isset($_POST["slider_image_url_openblank"]) && $_POST["slider_image_url_openblank"] == '1'){
			$openblank = 1;
		}
		update_post_meta($post->ID, "slider_image_url", esc_url($_POST["slider_image_url"]));
		update_post_meta($post->ID, "slider_image_url_openblank", $openblank);
		update_post_meta($post->ID, "slider_image_link_text", sanitize_text_field($_POST["slider_image_link_text"]));
		update_post_meta($post->ID,'event_asso_start',$_POST['event_asso_start']);
		update_post_meta($post->ID,'event_asso_end',$_POST['event_asso_end']);
		update_post_meta($post->ID,'event_asso_hour_start',$_POST['event_asso_hour_start']);
		update_post_meta($post->ID,'event_asso_hour_end',$_POST['event_asso_hour_end']);
		update_post_meta($post->ID,'event_asso_address',$_POST['event_asso_address']);
		update_post_meta($post->ID,'mdq_listing_assoc',$_POST['event_listing_asso']);
	}
}
add_action('save_post', 'slider_save_details');

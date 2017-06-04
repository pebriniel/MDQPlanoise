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

	return $defaults;
}

function slider_columns_content($column_name, $post_ID) {
	if ($column_name == 'featured_image') {
		$post_featured_image = slider_get_featured_image($post_ID);
		if ($post_featured_image) {
			echo '<a href="'.get_edit_post_link($post_ID).'"><img src="' . $post_featured_image . '" alt="" style="{max-width:100%; height: auto;}" /></a>';
		}
	}

	if ($column_name == 'featured_date_start') {
		$x = esc_attr(get_post_meta($post_ID, 'event_asso_start', true));
		echo $x;
	}

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
	<form method="post">
		<input type="hidden" id="sliderasso" name="sliderasso" value="<?php wp_create_nonce('sliderasso'); ?>" />

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
	</form>

	<?php
}

function event_asso_meta($object){
	// On génère un token (SECURITE)
	// wp_nonce_field('slider_asso','sliderasso_nonce');
	?>
	<form method="post">
		<input type="hidden" id="sliderasso" name="sliderasso" value="<?php echo wp_create_nonce('sliderasso'); ?>" />

		<div class="meta-box-item-title">
			<h4>Date de début événement</h4>
		</div>
		<div class="meta-box-item-content">
			<input type="datetime-local" name="event_asso_start" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_start', true)); ?>" placeholder="jj/mm/aaaa" />
		</div>
		<div class="meta-box-item-title">
			<h4>Date de fin événement</h4>
		</div>
		<div class="meta-box-item-content">
			<input type="datetime-local" name="event_asso_end" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_end', true)); ?>" placeholder="jj/mm/aaaa" />
		</div>
		<div class="meta-box-item-title">
			<h4>Adresse de l'évènement</h4>
		</div>
		<div class="meta-box-item-content">
			<input type="text" name="event_asso_address" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'event_asso_address', true)); ?>" placeholder="adresse" />
		</div>

		<div class="meta-box-item-title">
			<h4>Description l'évènement</h4>
		</div>
		<div class="meta-box-item-content">
			<textarea name="event_asso_description" rows="10" cols="50" style="width:100%; resize:none;"><?= esc_attr(get_post_meta($object->ID, 'event_asso_description', true)); ?></textarea>
		</div>
	</form>
	<?php
}

function mdq_listing_assoc($object){
	// wp_nonce_field('slider_asso','sliderasso_nonce');
	?>

		<input type="hidden" id="sliderasso" name="__nonce" value="<?php echo wp_create_nonce('sliderasso'); ?>" />

		<div class="meta-box-item-content">
			<select name="event_listing_asso">
				<?php
				query_posts(array(
						'post_type' => 'fiche',
						'posts_per_page'=> -1
				));

				if ( have_posts() ){
					while ( have_posts() ){
						the_post();
						global $post;
						$selected= "";
						if($post->ID == get_post_meta($object->ID, 'mdq_listing_assoc', true)){
							$selected = "selected";

						}
						?>
							<option value="<?= $post->ID; ?>" <?= $selected; ?>><?= the_title(); ?></option>
						<?php
					}
				}
			?>
			</select>
		</div>
	<?php
}

function slider_admin_init_custpost(){
	// add_meta_box("slider_image_url", "Slide Options", "slider_image_url", "slider", "side", "high");
	add_meta_box('event_by_asso','Informations sur l\'événement','event_asso_meta','slider','normal','high');
	add_meta_box('event_list_asso','Association organisatrice de  l\'événement','mdq_listing_assoc','slider','normal', 'high');
}
add_action("add_meta_boxes", "slider_admin_init_custpost");

function slider_save_details(){
	global $post;

	 if( is_object($post) ) {

		$start_date = !isset($_POST['event_asso_start']);
		$end_date = !isset($_POST['event_asso_end']);
		$end_hour_date = !isset($_POST['event_asso_start_hour']);
		$start_hour_date = !isset($_POST['event_asso_hour_end']);
		$address_event = !isset($_POST['event_asso_address']);
		$list_event_asso = !isset($_POST['event_listing_asso']);
		$desc_event_asso = !isset($_POST['event_asso_description']);
		$img_url = !isset($_POST["slider_image_url"]);
		$img_url_openblank = !isset($_POST["slider_image_url_openblank"]);

		if (!wp_verify_nonce($_POST['__nonce'], 'sliderasso') || $img_url || $start_date || $end_date || $address_event || $list_event_asso || $start_hour_date || $end_hour_date || $desc_event_asso) {

			$openblank = 0;

			if($img_url_openblank == '1') {

				$openblank = 1;
			}
			update_post_meta($post->ID, "slider_image_url", esc_url($_POST["slider_image_url"]));
			update_post_meta($post->ID, "slider_image_url_openblank", $_POST["slider_image_url_openblank"]);
			update_post_meta($post->ID, "slider_image_link_text", sanitize_text_field($_POST["slider_image_link_text"]));
			update_post_meta($post->ID,'event_asso_start',$_POST['event_asso_start']);
			update_post_meta($post->ID,'event_asso_end',$_POST['event_asso_end']);
			update_post_meta($post->ID,'event_asso_start_hour',$_POST['event_asso_start_hour']);
			update_post_meta($post->ID,'event_asso_hour_end',$_POST['event_asso_hour_end']);
			update_post_meta($post->ID,'event_asso_address',$_POST['event_asso_address']);
			update_post_meta($post->ID,'mdq_listing_assoc',$_POST['event_listing_asso']);
			update_post_meta($post->ID,'event_asso_description',$_POST['event_asso_description']);
		}
	}
}

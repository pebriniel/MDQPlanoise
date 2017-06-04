<?php

/**
* Metabox pour gérer le lien
* @param Object $object article/contenu édité
**/
function mdq_event_meta_description($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslider','monsuperslider_nonce');
	?>
	<div class="meta-box-item-title">
		<h4>Description de l'activité</h4>
	</div>
	<div class="meta-box-item-content">
		<textarea name="event_description" rows="5" style="width:100%;"><?= esc_attr(get_post_meta($object->ID, 'mdq_event_description', true)); ?></textarea>
	</div>

	<div class="meta-box-item-title">
		<h4>Payement de l'activité</h4>
	</div>
	<div class="meta-box-item-content">
		<textarea name="event_payement" rows="5" style="width:100%;"><?= esc_attr(get_post_meta($object->ID, 'mdq_event_payement', true)); ?></textarea>
	</div>

	<?php
}
function mdq_event_meta_date($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslider','monsuperslider_nonce');
	?>
	<div class="meta-box-item-title">
		<h4>Adresse de l'activité</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="text" name="event_adresse" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'mdq_event_adresse', true)); ?>" placeholder="adresse" />
	</div>
	<div class="meta-box-item-title">
		<h4>Date</h4>
	</div>
	<div class="meta-box-item-content">
		<textarea name="event_date" cols="100" rows="4"><?= esc_attr(get_post_meta($object->ID, 'mdq_event_date', true)); ?></textarea>
	</div>
	<?php
}
function mdq_event_meta_liste_assoc($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslider','monsuperslider_nonce');
	?>
	<div class="meta-box-item-content">
		<select name="event_assoc_list">
			<?php
			query_posts(array(
				"post_type" => "fiche",
				'posts_per_page'=> -1
			));

			if ( have_posts() ){
				while ( have_posts() ){
					the_post();
					global $post;

					$selected = "";
					if($post->ID == get_post_meta($object->ID, 'mdq_association_id', true)){
						$selected = "selected";
					}
					?>
						<option value="<?php echo $post->ID; ?>" selected="<?php echo $selected; ?>"><?php echo the_title(); ?></option>
					<?php
				}
			}
		?>
		</select>
	</div>
	<?php
}

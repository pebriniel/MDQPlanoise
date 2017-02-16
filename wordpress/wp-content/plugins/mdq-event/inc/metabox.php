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
		<h4>Lien de ce slide</h4>
	</div>
	<div class="meta-box-item-content">
		<textarea name="event_description" style="width:100%;"><?= esc_attr(get_post_meta($object->ID, 'mdq_event_description', true)); ?></textarea>
	</div>
	<?php
}
function mdq_event_meta_date($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslider','monsuperslider_nonce');
	?>
	<div class="meta-box-item-title">
		<h4>Lien de ce slide</h4>
	</div>
	<div class="meta-box-item-content">
		<input type="date" name="event_datedebut" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'mdq_event_start', true)); ?>" placeholder="jj/mm/aaaa" />
		<input type="date" name="event_datefin" style="width:49%;" value="<?= esc_attr(get_post_meta($object->ID, 'mdq_event_end', true)); ?>" placeholder="jj/mm/aaaa" />
	</div>
	<?php
}

<?php
/**
* Metabox pour gérer le lien
* @param Object $object article/contenu édité
**/
function mdq_member_meta_description($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslider','monsuperslider_nonce');
	?>
	<div class="meta-box-item-content">
		<textarea name="event_description" style="width:100%;"><?= esc_attr(get_post_meta($object->ID, 'mdq_event_description', true)); ?></textarea>
	</div>
	<?php
}
function mdq_member_meta_liste_assoc($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslider','monsuperslider_nonce');
	?>
	<div class="meta-box-item-content">
		<select name="event_assoc_list">
			<?php
			query_posts(array(
				"post_type" => "fiche"
			));
			if ( have_posts() ){
				while ( have_posts() ){
					the_post();
					global $post;
					?>
						<option value="<?= $post->ID; ?>"><?= $post->_name; ?></option>
					<?php
				}
			}
		?>
		</select>
	</div>
	<?php
}

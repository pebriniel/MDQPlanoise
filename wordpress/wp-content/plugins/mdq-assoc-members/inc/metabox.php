<?php

/**
* Metabox pour gérer le lien
* @param Object $object article/contenu édité
**/
function mdq_members_description($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslider','monsuperslider_nonce');
	?>
	<div class="meta-box-item-content">
		<textarea name="members_description" style="width:100%;"><?= esc_attr(get_post_meta($object->ID, 'mdq_members_description', true)); ?></textarea>
	</div>
	<?php
}

/**
* Metabox pour gérer les associations
* @param Object $object article/contenu édité
**/
function mdq_members_liste_assoc($object){
	// On génère un token (SECURITE)
	wp_nonce_field('monsuperslideassociation','monsuperslideassociation_nonce');
	?>
	<div class="meta-box-item-content">
		<select name="membres_assoc_list">
			<?php
			query_posts(array(
				"post_type" => "fiche"
			));

			if ( have_posts() ){
				while ( have_posts() ){
					the_post();
					global $post;

					$selected = "";
					if($post->ID == get_post_meta($object->ID, 'mdq_members_associations', true)){
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

<?php
/**
* The main template file
*
* @package bootstrap-basic
*/

get_header();

$search_tax_field = null;
$search_tax_field_id = null;

if(!empty($_POST)){
	get_post_activite('select-field', 'theme_mdq', $search_tax_field, $search_tax_field_id);
}

if(!wp_verify_nonce($_POST['rechercheannuaire_nonce'], 'rechercheannuaire')){
	$search_input = "";
}
else{
	$search_input = $_POST['search-annuaire'];
}

function mdq_list_field($name_taxo, $value=null){
	$themes = get_categories( array(
		'hide_empty' => 0,
		'orderby' => 'name',
		'order'   => 'ASC',
		'taxonomy' => $name_taxo,
	) );


	$list_theme = "";
	foreach( $themes as $theme ) {
		$select_field = "";
		if($value == $theme->term_id){
			$select_field = "selected";
		}


		$theme_link = sprintf(
			'<option value="%1$s" '.$select_field.'>%2$s</option>',
			esc_html( $theme->term_id ),
			esc_html( $theme->name )
		);

		$list_theme .= $theme_link;
	}

	return $list_theme;
}


?>

<main id="annuaire" class="site-main" role="main">
	<div class="container">
		<div id="transition" class="row trans-annuaire">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="search-box">
					<form class="search-form" action="#" method="post">
						<?php
						wp_nonce_field('rechercheannuaire','rechercheannuaire_nonce');
						?>
						<input class="form-control" name="search-annuaire" type="text">
						<button class="btn btn-link search-btn">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</form>
				</div>
			</div>
			<form action="#" method="post">
				<div class="col-md-2 col-md-push-2 col-sm-3 col-xs-5 select-container">
					<select class="select-menu" name="select-field">
						<option value="null">--</option>
						<?= mdq_list_field("theme_mdq"); ?>
					</select>
				</div>
				<div class="col-md-2 col-md-push-2 col-sm-3 col-xs-5">
					<input id="btn-valid-acti" class="btn-valid-acti" type="submit" name="" value="Envoyer" />
				</div>
			</form>
		</div>
	</div>

	<div id="content" class="container">
		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		query_posts(array(
			"posts_per_page" => 50,
			"paged" => $paged,
			'post_type'=>'fiche',
			's' => $search_input,
			'tax_query' => array(
				$search_tax_field
			),
		));
		if ( have_posts() ){

			while ( have_posts() ){
				the_post();
				global $post;
				$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
				?>

				<div class="col-md-6">
					<div class="content-annuaire">
						<div class="content-ta">
							<div class="thumbnail-annuaire col-md-12 col-sm-12">
								<div class="logo col-md-2 col-sm-2" style="overflow: hidden; height: 125px;">
									<img src="<?= $url ?>" alt="<?= $url; ?>">
								</div>
								<div class="caption  col-md-8 col-sm-8">
									<h3 class="col-md-12 col-sm-12"><?= $post->_name; ?></h3>

									<p class="col-md-12 col-sm-12"><?= max_caracter_length($post->_desc, 100);?></p>
									<p class="col-md-12 col-sm-12">
										<a href="<?= get_site_url()."/association/?fiche=".$post->ID; ?>" class="btn btn-association" role="button">voir la fiche</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}

			$args = array();
			$page = paginate_links( $args );
			?>
			<div class="col-md-12 col-xs-12" id="page">
				<?= $page ; ?>
			</div>
			<?php
		}
		?>
	</div>

</main>
<?php get_footer(); ?>

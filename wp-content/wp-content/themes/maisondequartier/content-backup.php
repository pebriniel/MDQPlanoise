<main class="container" id="home">

<?php
function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}

function callEvent($limit = 10, $offset = 3){
	$queryAgenda = new WP_Query( array( 'post_type'=>'slider', // ICI
												'posts_per_page' => $limit, // ICI
												'orderby' => 'event_asso_start',
												'order' => 'ASC',
												'offset' => $offset
											)); // ICI

	$images = array();
	if($queryAgenda->have_posts()){ // ICI
		while ($queryAgenda->have_posts() ) { // ICI
				$queryAgenda->the_post();// ICI

				// global $post;
				if ( '' != get_the_post_thumbnail(get_the_ID(), 'size-carousel-display-home') ) {

					$post_id = get_the_ID();
					$title = get_the_title();
					$content = get_the_excerpt();
				// $size = image_resize($post->ID, 100, 50);
					$image = get_the_post_thumbnail(get_the_ID(), 'size-carousel-display-home');
					$image_src = wp_get_attachment_image_src(get_post_thumbnail_id());
					$image_src = $image_src[0];
					$url = get_post_meta(get_the_ID(), 'slider_image_url', true);
					$url_openblank = get_post_meta(get_the_ID(), 'slider_image_url_openblank', true);
					$link_text = get_post_meta(get_the_ID(), 'slider_image_link_text', true);
					// $asso_orga = $infosAsso->_name;
					$asso_orga = get_post_meta(get_the_ID(), 'mdq_listing_assoc', true);
					$dateStart = get_post_meta(get_the_ID(), 'event_asso_start', true);
					$dateEnd = get_post_meta(get_the_ID(), 'event_asso_end', true);
					$location_event = get_post_meta(get_the_ID(), 'event_asso_address', true);
					$date_i = date_i18n("d/m/Y", strtotime($dateStart));

					$images[] = array('post_id' => $post_id,
														'title' => $title,
														'dateStart' => $dateStart,
														'dateEnd' => date_i18n($format_date, strtotime($dateEnd)),
                                                        'dateIdent' => date_i18n("d/m/Y", strtotime($dateStart)),
														'location' => $location_event,
														'content' => $content,
														'image' => $image,
														'img_src' => $image_src,
														'url' => esc_url($url),
														'url_openblank' => $url_openblank == "1" ? true : false,
														'link_text' => $link_text,
														'association' => $asso_orga);
			}
		}
	}
	return $images;
}


$images = callEvent(3, 0);
?>
	<!-- carousel bootstrap -->
	<div class="col-md-12" id="carousel">
		<div id="carousel-home" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				 <ol class="carousel-indicators">
					 <?php
					 	 $active = 'class="active"';
					 		 foreach ($images as $key => $image)
					 		 {
					 		 static $i = 0;
					 	?>
					 			<li data-target="#carousel-home" data-slide-to="<?= $i; ?>" <?= $active; ?>></li>
					 	<?php
					 		$i ++;
					 		$active = "";
					 	}
						?>
				 </ol>

				 <?php
				 $active = "active";
				 foreach ($images as $key => $image)
				 {
				 	?>
				 <div class="item <?= $active; ?>  modal-click">
					<?= $image['image']; ?>
					 <div class="carousel-caption">
						 <h3 class="img-modal img-responsive" title="<?= $image['title']; ?>"><?= $image['title'];?></h3>

						 <!-- <a href="<?=  get_site_url()."/association/?fiche=".$image['url_openblank']; ?>"  class="btn-association" role="button">voir l'événement</a> -->
						 <p> Du <?= $image['dateStart']; ?> au <?= $image['dateEnd']; ?> </p>
						 <p><?= $image['association'];?></p>
						 <a class="btn-association img-modal img-moda-click" id="image-<?= $images['post_id']; ?>" data-title="<?= $image['title']; ?>" data-content="<?= $image['content']; ?>" data-img="<?= $image['img_src'] ?>" data-date="<?= $image['dateStart']; ?>" data-location="<?= $image['location']; ?>" data-url="<?=  get_site_url()."/association/?fiche=".$image['association']; ?>" role="button">voir l'événement</a>
						 <!-- <p><?= $image['location'];?></p> -->

						 <!-- <a data-url="<?= get_site_url()."/association/?fiche=".$images['post_id']; ?>" class="btn btn-association" role="button">voir la fiche</a> -->

					 </div>
				 </div>
				 <?php
				 $active = "";
				 }
				 ?>
				 <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: #ff6633;"></span>
					<span class="sr-only">Précèdent</span>
				</a>
				<a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: #ff6633;"></span>
					<span class="sr-only">Suivant</span>
				</a>
			 </div>
		</div>
	</div>

	<!-- agenda -->

	<?php
		$empty = array();
    $tableau = array();
		$tab = callEvent(20, 3);
		$tab = array_msort($tab, array('dateStart' => SORT_ASC));

		?>

		<section class="cd-horizontal-timeline col-md-12">
			<div class="timeline">
				<div class="events-wrapper">
					<div class="events">
						<ol>
						<?php
						 	$select = 'class="selected"';
							foreach($tab AS $key => $val)
							{
								$date = date_i18n("d/m/Y", strtotime($val['dateStart']));
								$date_show = date_i18n("d/m", strtotime($val['dateStart']));

								if(!in_array($date, $empty)){
								?>
									<li><a href="#0" data-date="<?= $date; ?>" <?= $select; ?>><?= $date_show; ?></a></li>
								<?php

									$empty[] = $date;
									$select = "";
								}
							}
						?>
						</ol>

						<span class="filling-line" aria-hidden="true"></span>
					</div> <!-- .events -->
				</div> <!-- .events-wrapper -->

				<ul class="cd-timeline-navigation">
					<li><a href="#0" class="prev inactive">Prev</a></li>
					<li><a href="#0" class="next">Next</a></li>
				</ul> <!-- .cd-timeline-navigation -->
			</div> <!-- .timeline -->

			<div class="events-content">
				<ol>
					<?php
					$selected = 'class="selected"';
					$value = null;

					for($i = 0; $i < sizeof($tab); $i ++){
						$test[$tab[$i]['dateIdent']][] = $tab[$i];
					}

					foreach($empty as $key => $v_date){
						echo '<li data-date="'.$v_date.'" '.$selected.'>';

						for($i = 0; $i < sizeof($test[$v_date]); $i ++){
							$tab = $test[$v_date];
							$date = date_i18n("d/m/Y", strtotime($tab[$i]['dateStart']));
							$date_show = date_i18n("d/m", strtotime($tab[$i]['dateStart']));
						?>
								<h3><?= $tab[$i]['title']." ".$i;?> </h3>
								<p id="content"><?= $tab[$i]['content'];?></p>
								<p id="location"><?= $tab[$i]['location'];?></p>
								<pre> Du <?= $tab[$i]['dateStart']; ?>  au <?= $tab[$i]['dateEnd']; ?> </pre>
						<?php
						}

						echo "</li>";

						$selected = "";
					}


					?>
				</li>
					<?php
				// }
				?>
				</ol>
			</div> <!-- .events-content -->
		</section>


		<!-- la modal -->
		<div class="modal container" id="modal-gallery" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
						<button class="close" type="button" data-dismiss="modal">×</button>
						<h3 class="modal-title"></h3>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal">Fermer</button>
				</div>
			</div>
		</div>
		</div>

		<script>
		$(document).ready(function() {
		 /* change modal title when slide changes */
		 $("#modal-carousel").on("slid.bs.carousel", function () {
					$(".modal-title")
					.html($(this)
					.find(".active img")
					.attr("title"));
		 });

		 /* when clicking a thumbnail */
		 $(".img-moda-click").click(function(){
			var title = $(this).data('title');
			var description = $(this).data('content');
			var date = $(this).data('date');
			var image = $(this).data('img');
			var location = $(this).data('location');
			var url = $(this).data('url');
			var content = $(".modal-body");
			var footer = $(".modal-footer");

			var modal_title = $(".modal-title");

			//content.empty();
			modal_title.empty();

			// var id = this.id;
			//  var repo = $("#img-repo .item");
			//  var repoCopy = repo.filter("#" + id).clone();
			//  var active = repoCopy.first();

			// active.addClass("active");
			modal_title.html(title);
			content.html("<img src='"+image+"' /> <p id='modal-date'>Date de l'événement : "+  date + " </p><p id='modal-location'>Lieu : " + location + "</p> <p id='modal-description'>"  + description + "</p>");
			footer.html("<a href='"+url+"' class='btn btn-default btn-association'> voir la fiche de l'association</a><button class='btn btn-default' data-dismiss='modal'>Fermer</button>");
			// show the modal
			$("#modal-gallery").modal("show");
		});

		});
		</script>


<?php


/* --
--
-- affichage des articles
--
-- */

/* affichage de l'article mis-en-avant */
	$sticky = get_option('sticky_posts');
	query_posts(array('showposts' => 1, 'orderby' => 'post_modified',  'post__in' => $sticky , 'order' => 'DESC'));
	if ( have_posts() ){
		while ( have_posts() ){
			the_post();
			if(is_sticky()){
				?>
				<section id="articleUne" class="col-md-12" <?php post_class(); ?>>
					<article class=" contenu blockArticle">
						<div class="globalArticle col-md-12">
							<header class="entry-header">
								<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
								<div class="entry-meta">
									<?php bootstrapBasicPostOn(); ?>
								</div>
							</header>
							<div class="entry-content">
								<?= the_content(bootstrapBasicMoreLinkText()); ?>
							</div>

							<footer class="entry-meta">
								<?php if ('post' == get_post_type()) { // Hide category and tag text for pages on Search ?>
								<div class="entry-meta-category-tag">
									<?php
										/* translators: used between list items, there is a space after the comma */
										$tags_list = get_the_tag_list('', __(', ', 'bootstrap-basic'));
										if ($tags_list) {
									?>
									<span class="tags-links">
										<?php echo bootstrapBasicTagsList($tags_list); ?>
									</span>
									<?php } ?>
								</div>
								<?php } ?>
							</footer>
									<?php
								}
							}
						}
					?>
						</div>
					</article>
				</section>





	<!-- affichage des articles sauf l'article à la une  -->
	<section id="articlesAutres"  class="col-md-12" <?php post_class(); ?>>
		<?php

			$args = array(
				'post_type'=>'post',
				'posts_per_page' => 10,
				'post__not_in'  => $sticky,
				'ignore_sticky_posts' => 1
			);
		$query = new WP_Query( $args );

		// $query = new WP_query(array('post_type'=>'post','posts_per_page' => 10));
		if($query != $sticky[1]) {
		while($query->have_posts()) {
			$query->the_post();
			global $post;
			?>
			<article class="col-md-4 contenu blockArticle">
				<div class="globalArticle col-md-12">
					<header class="entry-header">
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

						<?php if ('post' == get_post_type()) {  ?>
						<div class="entry-meta">
							<?php bootstrapBasicPostOn(); ?>
						</div><!-- .entry-meta -->
						<?php } //endif; ?>
					</header><!-- .entry-header -->


				<?php if (is_search()) { // Only display Excerpts for Search ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
					<div class="clearfix"></div>
				</div><!-- .entry-summary -->
				<?php } else { ?>
				<div class="entry-content">
					<?php the_content(bootstrapBasicMoreLinkText()); ?>
				</div><!-- .entry-content -->
				<?php } //endif; ?>


				<footer class="entry-meta">
					<?php if ('post' == get_post_type()) { // Hide category and tag text for pages on Search ?>
					<div class="entry-meta-category-tag">
						<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list(__(', ', 'bootstrap-basic'));
							if (!empty($categories_list)) {
						?>
						<span class="cat-links">
							<?php echo bootstrapBasicCategoriesList($categories_list); ?>
						</span>
						<?php } // End if categories ?>

						<?php
							/* translators: used between list items, there is a space after the comma */
							$tags_list = get_the_tag_list('', __(', ', 'bootstrap-basic'));
							if ($tags_list) {
						?>
						<span class="tags-links">
							<?php echo bootstrapBasicTagsList($tags_list); ?>
						</span>
						<?php } // End if $tags_list ?>
					</div><!--.entry-meta-category-tag-->
					<?php }  // End if 'post' == get_post_type() ?>


				</footer><!-- .entry-meta -->
			</div>
		</article><!-- #post-## -->
			<?php  } } // End loop ?>
	</section>



</main>

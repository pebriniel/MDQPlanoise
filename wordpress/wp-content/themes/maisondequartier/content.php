<main class="container" id="home">
	<!-- carousel bootstrap -->
	<div class="col-md-12" id="carousel">

<?php
 query_posts(array('post_type'=>'slider',
										'posts_per_page' => 3 ));
					// 'meta_key'  => 'mdq_listing_assoc',
					// 'meta_value' => $infosAsso->ID));

 $images = array();
 ?>

 <div id="carousel-home" class="carousel slide" data-ride="carousel">
	 <!-- Wrapper for slides -->

 <?php

 if(have_posts()){
	while ( have_posts() ) {
			the_post();
			global $post;

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
				$images[] = array('post_id' => $post_id,
													'title' => $title,
													'dateStart' => $dateStart,
													'dateEnd' => $dateEnd,
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

	?>
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
				 <div class="item <?= $active; ?>  modal-click ">
					<?= $image['image']; ?>
					 <div class="carousel-caption">
						 <h3 class="img-modal img-responsive" title="<?= $image['title']; ?>"><?= $image['title'];?></h3>
						 <p><?= $image['content'];?></p>
						 <!-- <a href="<?=  get_site_url()."/association/?fiche=".$image['url_openblank']; ?>"  class="btn-association" role="button">voir l'événement</a> -->
						 <a class="btn-association img-modal" id="image-<?= $images['post_id']; ?>" data-title="<?= $image['title']; ?>" data-content="<?= $image['content']; ?>" data-img='<?= $image['img_src'] ?>' data-date="<?= $image['dateStart']; ?>" role="button">voir l'événement</a>
						 <p><?= $image['association'];?></p>
						 <p><?= $image['location'];?></p>
						 <p> Du <?= $image['dateStart'];?> au <?= $image['dateEnd']; ?> </p>
					 </div>
				 </div>

				<?php

				$active = "";
			}
			?>

		 <?php  	}  ?>
	 </div>

		 <!-- Left and right controls -->
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
	<!-- fin de carousel -->

<!-- la modal -->
<div class="modal" id="modal-gallery" role="dialog">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">×</button>
				<h3 class="modal-title"></h3>
		</div>
		<div class="modal-body">
		</div>
		<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
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
 $(".modal-click .img-modal").click(function(){
		let title = $(this).data('title');
		let description = $(this).data('content');
		let date = $(this).data('date');
		let image = $(this).data('img');
	var content = $(".modal-body");
	var modal_title = $(".modal-title");

	//content.empty();
	modal_title.empty();

	// var id = this.id;
	//  var repo = $("#img-repo .item");
	//  var repoCopy = repo.filter("#" + id).clone();
	//  var active = repoCopy.first();

	// active.addClass("active");
	modal_title.html(title);
	content.html("<img src='"+image+"' /><br/>"+description+" "+date);

	// show the modal
	$("#modal-gallery").modal("show");
});

});
</script>

<!-- fin modal carrousel -->

<!-- agenda -->
<!-- <div class="contentAgenda col-md-12">
	<div class="col-md-2 pictoAgenda">
		<span class="col-md-2 push-col-md-1 glyphicon glyphicon-calendar" aria-hidden="true" style="color: #ffffff;"></span>
		<h2 class="col-md-8 push-col-md-1">Agenda</h2>
	</div>
	<div class="col-md-10 prezEvent"> -->

	<section class="cd-horizontal-timeline col-md-12">
		<div class="timeline col-md-12">
			<div class="events-wrapper col-md-12">
				<div class="events col-md-12">

					<!-- <ol class="navigation-timeline"> -->
					<ol>


<?php

$current_page_ids = array(get_the_ID());
query_posts(array('post_type'=>'slider',
									'posts_per_page' => 8,
									'post__not_in'  => $current_page_ids ));

if(have_posts()){
	while ( have_posts() ) {
			the_post();
			global $post;

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
				$images[] = array('post_id' => $post_id,
													'title' => $title,
													'dateStart' => $dateStart,
													'dateEnd' => $dateEnd,
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

				$selected = 'class="selected"';
				foreach ($images as $key => $image)
					{


 ?>
				 <li class="col-md-2 display-date "><a <?= $selected; ?> href="<?= $images['post_id']; ?>" data-date="<?= $image['dateStart']; ?> "><?= $image['dateStart']; ?></a></li>

<?php

						$selected = "";
				}

		?>
	</ol>

	<span class="filling-line" aria-hidden="true"></span>
			</div>
		</div>

	</div>

			<div class="events-content">
				<ol>
<?php

	$selected = "selected";
	foreach ($images as $key => $image)
		{
?>
					<li <?= $selected; ?> data-date="<?= $image['dateStart']; ?> " class="col-md-6">
						<h3><?= $image['title'];?></h3>
						<p><?= $image['content'];?></p>
						<p><?= $image['location'];?></p>
						<pre> Du <?= $image['dateStart']; ?>  au <?= $image['dateEnd']; ?> </pre>
					</li>

<?php
		$selected = "";
	}

}
?>
</ol>
</div>
</section>

<!--
</div>
</div> -->
<!-- fin agenda -->


<!-- affichage des articles -->
<?php
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


<?php get_footer(); ?>

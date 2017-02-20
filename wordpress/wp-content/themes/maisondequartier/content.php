<?php

query_posts(array( 'post_type'=>'carrousel'));
if ( have_posts() ){
		while ( have_posts() ){
				the_post();
				global $post;
	?>
<div class="container">
	<!-- carousel bootstrap -->
	<div class="row carousel">
		<div id="carousel" class="carousel slide" data-interval="3000" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#carousel" data-slide-to="0" class="active"></li>
				<li data-target="#carousel" data-slide-to="1"></li>
				<li data-target="#carousel" data-slide-to="2"></li>
				<li data-target="#carousel" data-slide-to="3"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="<?= $post->_link;?>" alt="<?= $post->_link;?>">
						<div class="carousel-caption">
							<h3><?= $post->_name;?></h3>
							<p><?= $post->_date;?></p>
						</div>
				</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>
<?php
		}

	}
 ?>
<!-- fin de carousel -->

<section class="row" <?php post_class(); ?>>
	<?php
	$query = new WP_query(array('post_type'=>'post','posts_per_page' => 10));
	while($query->have_posts()) {
		$query->the_post();
		global $post;
		?>
		<article class="col-md-4 masonry grid-item">
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
			<div class="clearfix"></div>
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
	</article><!-- #post-## -->
		<?php  } // End loop ?>
</section>
</div>

<?php get_footer(); ?>

<?php
/**
 * The main template file
 *
 * @package bootstrap-basic
 */

get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?>
<?php get_sidebar('left'); ?>
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
					<main id="home" class="site-main" role="main">
						<?php
							/* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
							get_template_part('content', get_post_format());


						bootstrapBasicPagination();
						?>

					</main>
				</div>

<?php get_footer(); ?>

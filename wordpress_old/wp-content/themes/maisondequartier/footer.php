<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
?>

<footer id="footer">
		<div class="container">
				<div class="row">
						<div class="col-md-3 col-xs-12" id="logo">
								<img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/logo-footer.png" alt="...">
						</div>
						<div class="col-md-6 col-xs-12">
								<div id="middle-box">
										<span class="association">Associations :</span>
										<ul id="association-ul">
										<?php
											$categories = get_categories( array(
										        'hide_empty' => 0,
										        'orderby' => 'ID',
										        'order'   => 'ASC',
										        'taxonomy' => "theme_mdq"
										    ) );


										    $list_cat = "";
										    foreach( $categories as $category ) {
										        $category_link = sprintf(
										            '<li><a href="">%1$s</a></li>',
										            esc_html( $category->name )
										        );

												echo $category_link;
										    }


										?>

<!--
												<li><a href="">Sport et Loisirs</a></li>
												<li><a href="">Culturelles</a></li>
												<li><a href="">Éducation</a></li> -->
										</ul>
								</div>
						</div>
						<div class="col-md-3 col-xs-12">
								<?php
									echo wp_nav_menu(
								      array(
								        'menu' => 'menu_footer',
								        'container' => false,
								        'menu_id' => 'menu-ul',
								        'menu_class' => ''
								      )
								    );
								?>
						</div>
						<div class="col-md-12 col-xs-12" id="mentions">
							©2017 Maison de Quartier Planoise - <a href="#">Mentions légales</a>
						</div>
				</div>
		</div>
</footer>
		<!--wordpress footer-->
		<?php wp_footer(); ?>
	</body>
</html>
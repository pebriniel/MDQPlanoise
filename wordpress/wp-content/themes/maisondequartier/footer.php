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
				<div class="col-md-3 col-sm-12 col-xs-12" id="logo">
					<img src="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/img/logo-planoisactive_Vfooter.svg" alt="logo-planoisactive">
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
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
									foreach( $categories as $category ){
										$category_link = sprintf(
											'<li><a href="'.get_site_url().'/annuaire/?action='.$category->term_id.'">%1$s</a></li>',
											esc_html( $category->name )
										);

										echo $category_link;
									}  ?>
								</ul>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-12">
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
							©2017 Maison de Quartier Planoise - <a href="<?php echo get_site_url().'/mentionlegale'; ?>">Mentions légales</a>
						</div>
				</div>
		</div>
</footer>
<script src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/js/jquery-2.1.4.js" type="text/javascript"></script>
<script src="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/main.js" type="text/javascript"></script>
<script src="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/fullcalendar-3.4.0/lib/moment.min.js" type="text/javascript"></script>
<script src="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/fullcalendar-3.4.0/fullcalendar.js" type="text/javascript"></script>
<script src="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/fullcalendar-3.4.0/locale/fr.js" type="text/javascript"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.js"></script>


	<?php wp_footer(); ?>
	</body>
</html>

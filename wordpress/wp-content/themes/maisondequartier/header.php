<?php
/**
 * The theme header
 *
 * @package mdq
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>  <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>     <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>     <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width">

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <meta name="description" content="Maison de Quartier">
    <meta name="author" content="Anthony Boussad Houda et Pauline">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/js/readmore.js" type="text/javascript"></script>
		<script src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/js/readmoreHome.js" type="text/javascript"></script>

		<!--wordpress head-->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<!--[if lt IE 8]>
			<p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
		<![endif]-->
		<div class="container page-container">
			<?php do_action('before'); ?>

			<header class="container-fluid">
			  <nav class=" navbar-fixed-top">
					<div class="container">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img class="col-md-2 logoPS" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/logo.svg" alt="Logo <?php echo esc_attr(get_bloginfo('name', 'display')); ?>"/>
					</a>
					<?php
						echo wp_nav_menu(
							array(
								'menu' => 'Project Nav',
								'container' => false,
								'menu_id' => 'nav',
								'menu_class' => 'col-md-7 col-md-push-1 list-inline'
							)
						);
					?>
					<a class="col-md-1" href="#">Connexion</a>
				</div>
			</nav>
			</header>
		</div>

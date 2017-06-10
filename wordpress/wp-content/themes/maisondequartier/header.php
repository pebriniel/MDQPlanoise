<?php
/**
 * The theme header
 *
 * @package mdq
 */

 // (is_admin_bar_showing()) ? 'id="adminbarfix"' : "";

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
		<meta name="description" content="Maison de Quartier">
		<meta name="author" content="Anthony Boussad Houda et Pauline">

		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
		<link rel="stylesheet" href="<?php echo get_site_url(); ?>/wp-content/themes/maisondequartier/css/hover.css" />
		<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/fullcalendar-3.4.0/lib/cupertino/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/fullcalendar-3.4.0/fullcalendar.css">
		<link rel="stylesheet" type="text/css" href="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/fullcalendar-3.4.0/fullcalendar.print.css"  media="print">

		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

		<script src="<?php echo  get_site_url(); ?>/wp-content/themes/maisondequartier/js/masonry.pkgd.js" type="text/javascript"></script>

		<!--wordpress head-->
		<?php wp_head(); ?>

		<script>
			$(document).ready(function(){
				$('.menu-burger').click(function() {
					$(".menu-content").toggleClass("hide-menu");
			   });
		   });
		</script>

	</head>
	<body class="<?php echo margBody(); ?>">
		<!--[if lt IE 8]>
			<p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
		<![endif]-->
			<?php do_action('before'); ?>

	<header class="page-header">
	  <div class="row">
	  <nav class="navbar-fixed-top">
	    <div class="col-md-2 col-sm-2 col-xs-10 logoPS">
	      <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
	        <img src="<?php echo get_site_url(); ?>/wp-content/themes/maisondequartier/img/logo.svg" alt="Logo <?php echo esc_attr(get_bloginfo('name', 'display')); ?>"/>
	      </a>
	    </div>
		<a class="menu-burger"><span class="glyphicon glyphicon-th-list"></span></a>
	    <div class="col-md-10 col-sm-10 col-xs-12 menu-content">
			  <?php
			    echo wp_nav_menu(
			      array(
			        'menu' => 'menu_header',
			        'container' => false,
			        'menu_id' => 'nav',
			        'menu_class' => 'list-inline text-right'
			      )
			    );
			  ?>
			</div>
	  </nav>
	</div>
	<script type="text/javascript">
		$(document).ready(function()
    {

			$('.page-header #nav li:hover a').on( "click", function() {
				// $('.page-header #nav li a').css({"color": "#ffffff"; "text-decoration": "none"; });

				// $('.page-header #nav li').css("background-color", "#ff6633");

				$( ".page-header #nav li a" ).removeClass( "class_css_hover" );
					$( this ).addClass( "class_css_hover" );
					$( '.page-header #nav li:hover' ).addClass( "class_css_hover" );

			});

			$( "menu .onglet:hover" ).bind( 'click' , function(){
$( "menu .onglet:hover" ).removeClass( "class_css_hover" );
$( this ).addClass( "class_css_hover" );
} )


	});
	</script>
	</header>


			<!-- <div id="content" class="row row-with-vspace site-content"> -->

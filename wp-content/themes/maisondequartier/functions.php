<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


add_filter( 'query_vars', 'add_query_vars_filter_fiche' );
function add_query_vars_filter_fiche( $vars ){
  $vars[] = "fiche";
  return $vars;
}

function special_nav_class ($classes, $item) {
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function get_post_activite($input, $tax, &$search_array, &$search_id){
    if(isset($_POST[$input])){
        $search_id = intval($_POST[$input]);
        if($search_id != "null"){
            $search_array = array(
                'taxonomy' => $tax, //or tag or custom taxonomy
                'field' => 'id',
                'terms' => array(intval($search_id))
            );
        }
    }
}


function max_caracter_length($content, $max = 20){
    $point = " &hellip;";
    if(strlen($content) <= $max){
        $point = "";
    }
    return substr( $content, 0, $max ).$point;
}


// désactiver MAJ du plugin slider
function stop_plugin_update( $value ) {

    unset( $value->response['slider/slider.php'] );

    return $value;
}
add_filter( 'site_transient_update_plugins', 'stop_plugin_update' );


// function pour affichage du contenu des articles
if (!function_exists('bootstrapBasicPostOn')) {
	/**
	 * display post date/time and author
	 *
	 * @return string
	 */
	function bootstrapBasicPostOn()
	{

    if (get_the_date('U') !== get_the_modified_time('U')) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
  }
  // if (get_the_time('U') !== get_the_modified_time('U')) {
		else {
			$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf($time_string,
			esc_attr(get_the_date('c')),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date('c')),
			esc_html(get_the_modified_date())
		);

    if (is_sticky() == null){
      $author = 'par <span class="author vcard">%1$s</span>';

    } else {
      $author = '';
    }

    $author = sprintf($author,
      esc_html(get_the_author())
    );


		printf(__('<span class="posted-on">Publié le %1$s</span><span class="byline"> %2$s</span>', 'bootstrap-basic'),
			sprintf('%1$s',
				$time_string
			),
			sprintf($author,
				esc_url(get_author_posts_url(get_the_author_meta('ID'))),
				esc_attr(sprintf(__('View all posts by %s', 'bootstrap-basic'), get_the_author())),
				esc_html(get_the_author())
			)
		);
	}// bootstrapBasicPostOn for children theme
}

// function pour "lire plus" des articles
if (!function_exists('bootstrapBasicMoreLinkText')) {
	/**
	 * Custom more link (continue reading) text
	 * @return string
	 */
	function bootstrapBasicMoreLinkText($post)
	{
//		return __('Lire plus <span class="meta-nav"><a href="'. get_permalink( ) . '"></a></span>', 'bootstrap-basic');
    $url = "";
    if (!is_null($post)){

      $url = '?article=' .$post->ID;
    }

    return __('<span class="meta-nav"><a href="'. $url . '#article-'.$post->ID.'">(suite...)</a></span>', 'bootstrap-basic');
  }// bootstrapBasicMoreLinkText
}

// stopper le téléchargement automatique de jquery v.1.2.1
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function remove_jquery_migrate( &$scripts){
    if(!is_admin()){
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.2.1' );
    }
}

function margBody(){
    $v = "";
    if(is_admin_bar_showing())
    {
        $v = "adminbarfix";
    }

    return $v;
}

// Déclaration de la prise des miniatures
add_theme_support( 'post-thumbnails' );
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'resizing-img', 300, 200, true ); //pour affichage du logo dans la fiche association
  add_image_size( 'resizing-img-article', 500, 250, true ); //pour affichage du logo dans la fiche association
}

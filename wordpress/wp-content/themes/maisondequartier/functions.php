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



// désactiver MAJ du plugin slider
function stop_plugin_update( $value ) {

    unset( $value->response['slider/slider.php'] );

    return $value;
}
add_filter( 'site_transient_update_plugins', 'stop_plugin_update' );

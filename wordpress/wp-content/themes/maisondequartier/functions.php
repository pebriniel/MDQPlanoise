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

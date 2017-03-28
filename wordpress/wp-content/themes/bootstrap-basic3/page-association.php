<?php
/**
 * Displaying archive page (category, tag, archives post, author's post)
 *
 * @package bootstrap-basic
 */

get_header();

if (get_query_var('activite')){
    echo "$activite";
    if($article = get_post( $assoc )){
        if($article->post_type == 'activite'){
            print_r($article);
        }
        else{
            echo "coucou dev";
        }
    }
}
else{
    query_posts(array( 'post_type'=>'activite'));
    if ( have_posts() ){
        while ( have_posts() ){
            echo "boucle";
            the_post();
            global $post;
            print_r($post);
        }
    }
}
get_footer();

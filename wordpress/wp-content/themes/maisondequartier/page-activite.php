<?php
/**
 * Displaying archive page (category, tag, archives post, author's post)
 *
 * @package bootstrap-basic
 */

get_header();

function mdq_showActiviteHtml($post){
    ?>
    <article class="col-md-6 card-container">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <img src="css/camera-icon-hi.png" class="img-responsive img" alt="">
                        <p class="date "><?= $post->mdq_event_start; ?></p>
                    </div>
                    <div class="col-md-8">
                        <h2 class="title"><?= $post->post_title; ?></h2>
                        <p class="descri"><?= $post->mdq_event_description; ?></p>
                        <div class="text-center">
                            <button type="button" name="button" class="btn btn-primary btn-savoir">En savoir plus</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"><a href="#" class="voir-fichasso">Voir la fiche asso</a></div>
        </div>
    </article>
    <?php
}

function mdq_list_cat($id_cat){
    $categories = get_categories( array(
        'hide_empty' => 0,
        'orderby' => 'name',
        'order'   => 'ASC',
        'parent' => $id_cat
    ) );


    $list_cat = "";
    foreach( $categories as $category ) {
        $category_link = sprintf(
            '<a href="%1$s" alt="%2$s">%3$s</a>',
            esc_url( get_category_link( $category->term_id ) ),
            esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
            esc_html( $category->name )
        );

        $list_cat .= $category_link;
    }

    return $list_cat;
}

?>

<main>
    <div class="container-fluid">
        <div class="row" id="transition">
            <div class="col-md-6">
                <div class="search-box">
                    <form class="search-form">
                        <input class="form-control" type="text">
                        <button class="btn btn-link search-btn">
            <i class="glyphicon glyphicon-search"></i>
          </button>
                    </form>
                </div>
            </div>

            <!-- DROPDOWN -->
            <?php


                /* affichage des thèmes */

            ?>
            <div class="col-md-2 col-md-push-2">
                <div class="dropdown" id="dropdown-theme">
                    <button class="dropbtn">Thèmes <i class="glyphicon glyphicon-chevron-down" id="chevron-theme"></i></button>
                    <div class="dropdown-content">
                        <?= mdq_list_cat(1); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-md-push-2">
                <div class="dropdown">
                    <button id="btnAge" class="dropbtn">Âges <i class="glyphicon glyphicon-chevron-down" id="chevron-age"></i></button>
                    <div class="dropdown-content">
                        <?= mdq_list_cat(8); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            if (get_query_var('activite')){
                if($article = get_post( $activite )){
                    if($article->post_type == 'activite'){
                        print_r($article);

                    }
                    else{
                        echo "coucou";
                    }
                }
            }
            else{
                query_posts(array( 'post_type'=>'activite'));
                if ( have_posts() ){
                    while ( have_posts() ){
                        the_post();
                        global $post;
                        //print_r($post);
                        echo mdq_showActiviteHtml($post);
                        //$post->mdq_event_description;
                    }
                }
            }
            ?>
        </div>
    </div>
</main>

<?php

get_footer();

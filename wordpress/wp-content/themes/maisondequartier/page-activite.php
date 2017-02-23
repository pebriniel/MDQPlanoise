<?php
/**
 * Displaying archive page (category, tag, archives post, author's post)
 *
 * @package bootstrap-basic
 */

get_header();

$search_tax_cat = null;
$search_tax_age = null;
$search_tax_cat_id = null;
$search_tax_age_id = null;
if(!empty( $_POST)){
    get_post_activite('select-cat', 'theme_mdq', $search_tax_cat, $search_tax_cat_id);
    get_post_activite('select-age', 'age_mdq', $search_tax_age, $search_tax_age_id);
}

function mdq_showActiviteHtml($post){
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
    ?>
    <article class="col-md-6 card-container">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="img-activite">
                            <img src="<?php echo $url ?>" class="img-responsive img" alt="" />
                        </div>
                        <p class="date "><?= $post->mdq_event_start; ?></p>
                    </div>
                    <div class="col-md-8">
                        <h2 class="title"><?= $post->post_title; ?></h2>
                        <p class="descri-activite"><?= $post->mdq_event_description; ?></p>
                        <div class="text-center">
                            <button type="button" name="button" class="hvr-rectangle-out btn-savoir">En savoir plus</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer"><a href="<?= get_site_url()."/association/".$post->mdq_association_id; ?>" class="voir-fichasso">Voir la fiche asso</a></div>
        </div>
    </article>
    <?php
}

function mdq_list_cat($name_tax, $val = null){
    $categories = get_categories( array(
        'hide_empty' => 0,
        'orderby' => 'name',
        'order'   => 'ASC',
        'taxonomy' => $name_tax
    ) );


    $list_cat = "";
    foreach( $categories as $category ) {
        $select = "";
        if($val == $category->term_id){
            $select = "selected";
        }
        $category_link = sprintf(
            '<option value="%1$s" '.$select.'>%2$s</option>',
            esc_html( $category->term_id ),
            esc_html( $category->name )
        );

        $list_cat .= $category_link;
    }

    return $list_cat;
}

?>
<main id="activite">
  <div class="container">
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
        <form action="#" method="post">
            <div class="col-md-2 col-xs-4 select-container">
                <select class="select-menu" name="select-cat">
                    <option value="null">--</option>
                    <?= mdq_list_cat("theme_mdq", $search_tax_cat_id); ?>
                </select>
            </div>
            <div class="col-md-2 col-xs-4 select-container">
                <select class="select-menu" name="select-age">
                    <option value="null">--</option>
                    <?= mdq_list_cat("age_mdq", $search_tax_age_id); ?>
                </select>
            </div>
            <div class="col-md-2 col-xs-4">
                <input id="btn-valid" class="hvr-shadow" type="submit" name="" value="Envoyer" />
            </div>
        </form>
    </div>
  </div>
    <div class="container">
        <div class="row">
            <?php
            /* affichage individuel d'une activté */
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
            /* affichage de la liste des activités */
            else{
                if (have_posts()){
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    query_posts(array(
                        "posts_per_page" => 1,
                        "paged" => $paged,
                        "post_type" => "activite",
                        "orderby" => "mdq_event_start",
                        'tax_query' => array(
                            $search_tax_cat,
                            $search_tax_age
                        )
                    ));

                    if ( have_posts() ){
                        while ( have_posts() ){
                            the_post();
                            global $post;
                            //print_r($post);
                            echo mdq_showActiviteHtml($post);
                            //$post->mdq_event_description;
                        }
                    }

                    $args = array();
                    $page = paginate_links( $args );
                    ?>
                    <div class="col-md-12 col-xs-12" id="page">
                        <?= $page ; ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</main>

<?php

get_footer();

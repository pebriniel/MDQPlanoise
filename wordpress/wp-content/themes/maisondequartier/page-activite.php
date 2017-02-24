<?php
/**
* Displaying archive page (category, tag, archives post, author's post)
*
* @package bootstrap-basic
*/

get_header();

?>

<style>
.savoir-plus:after{
    content: 'En savoir plus'
}
.savoir-plus-close:after{
    content: 'Fermer'
}
.map{
    width: 100%;
    height: 350px;
}
.map-hide{
    display: none;

}
</style>

<?php

$search_tax_cat = null;
$search_tax_age = null;
$search_tax_cat_id = null;
$search_tax_age_id = null;
if(!empty( $_POST)){
    get_post_activite('select-cat', 'theme_mdq', $search_tax_cat, $search_tax_cat_id);
    get_post_activite('select-age', 'age_mdq', $search_tax_age, $search_tax_age_id);
}
if(!wp_verify_nonce($_POST['rechercheannuaire_nonce'], 'rechercheannuaire')){
    $search_input = "";
}
else{
    $search_input = $_POST['search-activite'];
}

function mdq_showActiviteHtml($post){
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
    ?>
    <article id="article-<?= $post->ID; ?>" class="col-md-6 card-container">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-4 block-1-<?= $post->ID; ?>">
                        <div class="img-activite">
                            <img src="<?= $url ?>" class="img-responsive img" alt="" />
                        </div>
                        <p class="date "><?= $post->mdq_event_start; ?></p>
                    </div>
                    <div class="col-md-8 block-2-<?= $post->ID; ?>">
                        <h2 class="title"><?= $post->post_title; ?></h2>
                        <p class="descri-activite"><?= $post->mdq_event_description; ?></p>
                        <div class="text-center">
                            <button type="button" name="button" class="hvr-rectangle-out btn-savoir btn-plus-<?= $post->ID; ?> savoir-plus" data-id="<?= $post->ID; ?>" data-toggle="modal" data-target="#ModalActivity"></button>
                        </div>
                    </div>
                    <div class="col-md-4 map-hide map-<?= $post->ID; ?>">
                        <div id="mapid-<?= $post->ID; ?>" class="map">
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer"><a href="<?= get_site_url()."/association/?fiche=".$post->mdq_association_id; ?>" data-id="$post->ID" class="voir-fichasso">Voir la fiche asso</a></div>
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
                    <form class="search-form" method="POST" action="#">
                        <?php
                        wp_nonce_field('rechercheannuaire','rechercheannuaire_nonce');
                        ?>
                        <input class="form-control" name="search-activite" type="text">
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
                        "posts_per_page" => 50,
                        "paged" => $paged,
                        "post_type" => "activite",
                        "orderby" => "mdq_event_start",
                        "s" => $search_input,
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

    <script>
    $(document).ready(function(){
        var modal = false;
        $('.btn-savoir').click(function(){
            let id = $(this).data('id');
            let article = $("#article-"+id);

            if(modal){
                article.removeClass("col-md-12").addClass("col-md-6").show();
                $(".btn-plus-"+id).removeClass("savoir-plus-close").addClass("savoir-plus");
                $(".block-2-"+id).removeClass("col-md-4").addClass("col-md-8").show();
                $(".card-container").show();
                $(".map-"+id).addClass("map-hide");
                modal = false;
            }
            else{
                modal = true;
                $(".card-container").hide();
                article.removeClass("col-md-6").addClass("col-md-12").show();
                $(".btn-plus-"+id).removeClass("savoir-plus").addClass("savoir-plus-close");
                $(".block-2-"+id).removeClass("col-md-8").addClass("col-md-4").show();
                $(".map-"+id).removeClass("map-hide");
                if ($('#mapid-'+id).is(':visible')){
                    console.log('coucou');
                    var mymap = L.map('mapid-'+id).setView([47.221094, 5.967786], 16);
                    var marker = L.marker([47.221094, 5.967786]).addTo(mymap);
                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYm91c3NhZCIsImEiOiJjaXlhMmxnMW0wMDRzMndxcngwNXNyZ2syIn0.aEfKXXy196Ds4KIdWnu-dw', {
                        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox.streets'
                    }).addTo(mymap);
                }
            }
        });
    });
    </script>


</main>

<?php

get_footer();

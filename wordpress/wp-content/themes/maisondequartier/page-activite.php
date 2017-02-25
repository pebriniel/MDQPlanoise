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
.activite-block-hide{
    display: none;
}
.date-hour{
    text-align: center;
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
    <div class="col-md-6 block-activite-6">
        <div class="block-activite">
        <div class="col-md-3 col-sm-3 col-xs-3 logo">
            <img src="<?= $url ?>" />
        </div>
        <div class="col-md-7 col-sm-7 col-xs-9 description">
            <h3><?= $post->post_title; ?></h3>
            <div class="desc">
                <?= $post->mdq_event_description; ?>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12 menu">
            <ul>
                <li class="li-horaire li-horaire-<?= $post->ID; ?>" data-menu="horaire" data-id="<?= $post->ID; ?>">
                    <span class="glyphicon glyphicon-calendar"></span><br/>
                    Date
                </li>
                <li class="li-map li-map-<?= $post->ID; ?>" data-menu="map" data-id="<?= $post->ID; ?>">
                    <span class="glyphicon glyphicon-road"></span><br />
                    Carte
                </li>
                <li data-id="1">
                    <a href="<?= get_site_url()."/association/?fiche=".$post->mdq_association_id; ?>" data-id="$post->ID">
                        <span class="glyphicon glyphicon-exclamation-sign"></span><br />
                            Association
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="macti-<?= $post->ID; ?> col-md-10 col-sm-10 col-xs-12 block-absolute menu-horaire menu-horaire-<?= $post->ID; ?>" data-menu="horaire">
            <?= $post->mdq_event_date; ?>
        </div>
        <div class="macti-<?= $post->ID; ?> col-md-10 col-sm-10 col-xs-12 block-absolute menu-map menu-map-<?= $post->ID; ?>" data-menu="map">
            map
        </div>
    </div>
    </div>
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
            <div class="col-md-5 col-xs-10 ">
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



            <form action="#" method="post">
                <div class="col-md-2 col-xs-3 col-xs-push-1 select-container">
                    <select class="select-menu" name="select-cat">
                        <option value="null">--</option>
                        <?= mdq_list_cat("theme_mdq", $search_tax_cat_id); ?>
                    </select>
                </div>
                <div class="col-md-2 col-xs-3 col-xs-push-1 select-container">
                    <select class="select-menu" name="select-age">
                        <option value="null">--</option>
                        <?= mdq_list_cat("age_mdq", $search_tax_age_id); ?>
                    </select>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-push-1">
                    <input id="btn-valid-acti" class="hvr-shadow" type="submit" name="" value="Envoyer" />
                </div>
            </form>
        </div>
    </div>
    <div class="container content-activite">
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
        $(".menu li").click(function(){
            let menu = $(this).data('menu');
            let id = $(this).data('id');
            var li = this;
            // $('.block-absolute').hide();

            $(".macti-"+id+"").each(function( index ){
                console.log(index);
                var __menu = $(li).data("menu");

                if($(this).hasClass("menu-"+menu+"-"+id)){
                    if ($('.menu-'+menu+"-"+id).css('display') == 'none'){
                        $(this).show();
                        $(li).addClass("active");
                    }
                    else{
                        $(this).hide();
                        $(li).removeClass("active");
                        //$("menu-"+$(this).data("menu")).removeClass("active");
                    }
                    // $(this).removeClass("block-active-show");
                }
                else{
                    $(this).hide();
                    var _menu = $(this).data('menu');
                    console.log('_menu '+_menu);
                    $(".li-"+_menu+"-"+id).removeClass("active");
                }
            });
        })
    });
    </script>


</main>

<?php

get_footer();

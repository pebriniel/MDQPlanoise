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
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
    ?>
    <div class="col-md-6 block-activite-6">
        <div class="block-activite">
        <div class="col-md-3 col-sm-3 col-xs-3 logo">
            <img src="<?= $url ?>" />
            <div>
                <?php
                    $v = get_term_by('name', $post->ID, 'tax_mdq_age');
                    print_r($v);
                    get_term($post->title);
                ?>
            </div>
        </div>
        <div class="col-md-7 col-sm-7 col-xs-9">
            <h3><?= $post->post_title; ?></h3>
            <div class="desc">
                <div style="position: relative">
                    <div id="acti-<?= $post->ID; ?>"  class="content overflow content-activite acti-<?= $post->ID; ?>">
                        <?= $post->mdq_event_description ?>
                        <div class="div-hover" data-id="<?= $post->ID; ?>">
                            <span class="gly-<?= $post->ID; ?> glyphicon glyphicon-chevron-down down-chevron" aria-hidden="true"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-12 menu">
            <ul>
                <li class="li-horaire li-horaire-<?= $post->ID; ?>" data-menu="horaire" data-id="<?= $post->ID; ?>">
                    <span class="glyphicon glyphicon-calendar"></span><br/>
                    Date
                </li>
                <li class="li-map li-map-<?= $post->ID; ?>" data-adress="<?= $post->mdq_event_adresse; ?>" data-menu="map" data-id="<?= $post->ID; ?>">
                    <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/map.svg" width="40%;" class="map-icon" alt=""><br/>
                    Carte
                </li>
                <li data-id="1">
                    <a href="<?= get_site_url()."/association/?fiche=".$post->mdq_association_id; ?>" data-id="$post->ID">
                        <span class="glyphicon glyphicon-info-sign"></span><br />
                            Association
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="macti-<?= $post->ID; ?> col-md-10 col-sm-10 col-xs-12 block-absolute menu-horaire menu-horaire-<?= $post->ID; ?>" data-menu="horaire">
            <?= $post->mdq_event_date; ?>
        </div>
        <div id="map-<?= $post->ID; ?>" class="macti-<?= $post->ID; ?> col-md-10 col-sm-10 col-xs-12 block-absolute menu-map menu-map-<?= $post->ID; ?>" data-menu="map">

        </div>
    </div>
    </div>
    <?php
}

function mdq_list_cat($name_tax, $val = null){
    $categories = get_categories( array(
        'orderby' => 'name',
        'order'   => 'ASC',

        'taxonomy' => $name_tax
    ) );


    $list_cat = "";
    foreach( $categories as $category ) {
        if($category->parent == 0){
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
    }

    return $list_cat;
}

?>
<main id="activite">
    <div class="container">
        <!-- <div class="row" id="transition"> -->
          <div class="row" id="transition-acti">
            <!-- <div class="col-md-5 col-xs-10 "> -->
                <!-- <div class="search-box"> -->
                <div class="col-md-4 col-xs-10 col-xs-offset-1">
                    <div class="search-box-acti">
                    <form class="search-form" method="POST" action="#">
                        <?php
                        wp_nonce_field('rechercheannuaire','rechercheannuaire_nonce');
                        ?>
                        <input class="form-control" name="search-activite" type="text">
                        <!-- <button class="btn btn-link search-btn"> -->
                          <button class="btn btn-link search-btn-acti">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </form>
                </div>
            </div>



            <form action="#" method="post">
                <div class="col-md-2 col-xs-3 col-xs-push-1 select-container">
                    <!-- <select class="select-menu" name="select-cat"> -->
                    <select class="select-menu-acti" name="select-cat">
                        <option value="null"> Champs d'actions</option>
                        <?= mdq_list_cat("theme_mdq", $search_tax_cat_id); ?>
                    </select>
                </div>
                <div class="col-md-2 col-xs-3 col-xs-push-1 select-container">

                    <select class="select-menu-acti" name="select-age">
                        <option value="null"> Tranches d'âge</option>
                        <?= mdq_list_cat("age_mdq", $search_tax_age_id); ?>
                    </select>
                </div>
                <div class="col-md-2 col-xs-4 col-xs-push-1">
                    <input id="btn-valid-acti" class="btn-valid-acti" type="submit" name="" value="Envoyer" />
                </div>
            </form>
        </div>
    </div>
    <div class="container content-activite">
        <div class="row">
            <?php
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
            ?>
        </div>
    </div>

    <script>

    $(document).ready(function(){
        var last_id = null;
        $("html").click(function(){
            $(".content-activite").each(function( index ){
                var i = $(this).data('id');
                $("#acti-"+i).addClass("overflow");
                $("#acti-"+i).removeClass("active");
                $(".gly-"+i).addClass("glyphicon-chevron-down");
                $(".gly-"+i).removeClass("glyphicon-chevron-up");
            });
        });

        $(".div-hover").click(function(e){
            e.stopPropagation();
            var id = $(this).data('id');
            var button = $(this);
            $(".content-activite").each(function( index ){
                console.log(this);
                if($(this).hasClass("acti-"+id)){
                console.log('ok');
                    if(!$(this).hasClass("active")){
                        //on cache
                        console.log('lol');
                        $("#acti-"+id).removeClass("overflow");
                        $("#acti-"+id).addClass("active");
                        $(".gly-"+id).removeClass("glyphicon-chevron-down");
                        $(".gly-"+id).addClass("glyphicon-chevron-up");
                        $(button).addClass("che-down");
                    }
                    else{
                        console.log('dev');
                        $("#acti-"+id).addClass("overflow");
                        $("#acti-"+id).removeClass("active");
                        $(".gly-"+id).addClass("glyphicon-chevron-down");
                        $(".gly-"+id).removeClass("glyphicon-chevron-up");
                        $(button).removeClass("che-down");
                        //on affiche
                    }
                }
                else{
                    console.log('wtf');
                    var i = $(this).data('id');
                    $("#acti-"+i).addClass("overflow");
                    $("#acti-"+i).removeClass("active");
                    $(".gly-"+i).addClass("glyphicon-chevron-down");
                    $(".gly-"+i).removeClass("glyphicon-chevron-up");
                    //on cache
                }

            });

            last_id = id;
        });
    });
    </script>

    <script>
    $(document).ready(function(){


        function callMap(adress, id){
                $.get('http://maps.googleapis.com/maps/api/geocode/json?address='+adress+'&sensor=true', function(reponse){
                    var pos = reponse['results'][0]['geometry']['location'];
                    if ($('#map-'+id).is(':visible')){
                        var mymap = L.map('map-'+id).setView([pos['lat'], pos['lng']], 16);
                        var marker = L.marker([pos['lat'], pos['lng']]).addTo(mymap);
                        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYm91c3NhZCIsImEiOiJjaXlhMmxnMW0wMDRzMndxcngwNXNyZ2syIn0.aEfKXXy196Ds4KIdWnu-dw', {
                            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
                            maxZoom: 18,
                            id: 'mapbox.streets'
                        }).addTo(mymap);
                    }
                });
        }

        $(".menu li").click(function(){
            var menu = $(this).data('menu');
            var id = $(this).data('id');
            var li = this;
            // $('.block-absolute').hide();

            $(".macti-"+id+"").each(function( index ){
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
                    $(".li-"+_menu+"-"+id).removeClass("active");
                }
            });

            if($(li).data('menu') == 'map'){
                console.log(id+" "+menu);
                callMap($(li).data('adress'), id);
            }
        })
    });
    </script>


</main>

<?php

get_footer();
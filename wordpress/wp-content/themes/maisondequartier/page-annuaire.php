<?php
/**
 * The main template file
 *
 * @package bootstrap-basic
 */

get_header();

$search_tax_field = null;
$search_tax_field_id = null;

if(!empty($_POST)){
	get_post_activite('select-field', 'theme_mdq', $search_tax_field, $search_tax_field_id);
}

function mdq_list_field($name_taxo, $value=null){
    $themes = get_categories( array(
        'hide_empty' => 0,
        'orderby' => 'name',
        'order'   => 'ASC',
        'taxonomy' => $name_taxo
    ) );


    $list_theme = "";
    foreach( $themes as $theme ) {
			$select_field = "";
			if($value == $theme->term_id){
				$select_field = "selected";
			}


        $theme_link = sprintf(
            '<option value="%1$s" '.$select_field.'>%2$s</option>',
            esc_html( $theme->term_id ),
            esc_html( $theme->name )
        );

        $list_theme .= $theme_link;
    }

    return $list_theme;
}


?>

<main id="annuaire" class="site-main" role="main">
  <div class="container">
    <div class="row">
				  <div  id="search" class="row">
              <div class="col-md-6 col-xs-12">
				          <div class="input-group has-feedback">
                    <form action="#" method="post">
                      <input type="text" placeholder="Rechercher" />
				              <span class="glyphicon glyphicon-search form-control-feedback custom-input-padding"></span>
                    </form>
				          </div>
				      </div>
						<form action="#" method="post">
				      <div class="col-md-2 col-xs-12">
								<select class="select-menu" name="select-field">
										<option value="null">Champ d'action</option>
										  <?= mdq_list_field("theme_mdq"); ?>
								</select>
				      </div>
  				  </div>
  					<div class="col-md-2 col-xs-3">
  							<input  class="btn-valid" type="submit" name="" value="Envoyer" />
  					</div>
  				</form>
			</div>
    </div>
<div id="content" class="container">
    <?php

    query_posts(array(
  		'post_type'=>'fiche',
  		'tax_query' => array(
  			$search_tax_field)
  ));
    if ( have_posts() ){
        while ( have_posts() ){
            the_post();
            global $post;
      ?>

            <div class="col-md-6">
                <div class="content-annuaire">
                    <div class="content-ta">
                        <div class="thumbnail-annuaire col-md-12">
                            <div class="logo col-md-2">
                                <img src="<?= $post->_logo;?>" alt="<?= $post->_logo;?>">
                            </div>
                            <div class="caption  col-md-8">
                                <h3 class="col-md-12"><?= $post->_name;?></h3>

                                <p class="col-md-12 description"><?= $post->_desc;?></p>
                                <p class="col-md-12">
                                    <a href="#" class="btn btn-association" role="button">voir la fiche</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="background"></div>
                </div>
            </div>
            <?php
          }
      }
?>
          </div>

</main>
<?php get_footer(); ?>

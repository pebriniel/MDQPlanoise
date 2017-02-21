<?php
/**
 * The main template file
 *
 * @package bootstrap-basic
 */

get_header();


/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();


?>

<?php get_sidebar('left'); ?>
					<main id="annuaire" class="site-main" role="main">
            <div id="search" class="container">
                <div class="row">

                    <div class="col-md-7 col-xs-12">
                        <div class="input-group has-feedback">
                            <input type="text" placeholder="Rechercher" />
                            <span class="glyphicon glyphicon-search form-control-feedback custom-input-padding"></span>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <select>
                            <option>test</option>
                        </select>
                    </div>

                </div>
            </div>

            <?php

            query_posts(array( 'post_type'=>'fiche'));
            if ( have_posts() ){
                while ( have_posts() ){
                    the_post();
                    global $post;
              ?>

            <div id="content" class="container">
                <div class="row">
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

    					bootstrapBasicPagination();
                     ?>


                </div>

                <div class="container">
                    <ul id="page" class="pagination">
                        <li><a href=""><</a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">></a></li>
                    </ul>
                </div>
            </div>
        </main>
<?php get_footer(); ?>

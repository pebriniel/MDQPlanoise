<?php get_header(); ?>

<main id="mentionlegale">

    <div class="container">
        <div class="row">
            <h2>Mention légale</h2>
             <div class="col-md-12 col-xs-12">
                 <?php
                     while ( have_posts() ) : the_post();
                         the_content();
                     endwhile; //resetting the post loop
                 ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>

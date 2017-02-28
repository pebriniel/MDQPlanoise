<?php get_header(); ?>

<main id="contact">

    <div class="container">
        <div class="row">
             <div class="col-md-4 col-md-push-3 col-xs-12 col-sm-push-1">
                <img id="mdq-logo" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_contact/mdq-contact.jpg">
            </div>

            <div class="col-md-3 col-md-push-2 col-xs-12">
                <p id="contacter">Contactez nous</p>
            </div>
        </div>

        <div class="row">
            <?php
                // TO SHOW THE PAGE CONTENTS
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile; //resetting the post loop
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

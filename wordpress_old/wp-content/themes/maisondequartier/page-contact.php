<?php get_header(); ?>

<main id="contact">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-push-3 col-xs-6">
                <img id="mdq-logo" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_contact/mdq-contact.jpg">
            </div>

            <div class="col-md-3 col-md-push-2 col-xs-6">
                <p id="contacter">Contacter la</p>
                <p id="mdq">Maison de quartier</p>
                <p id="planoise">de Planoise</p>
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

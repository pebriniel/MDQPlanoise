<?php get_header(); ?>

    <main id="contact">

        <div class="container">

            <div class="row">

                <div class="text-center">

                    <img id="mdq-logo" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_contact/mdq-contact.jpg">

                </div>

            </div>

            <p id="mdq">Maison de quartier de Planoise</p>

            <div class="row">

                <p id="nous-contacter">Nous contacter</p>

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

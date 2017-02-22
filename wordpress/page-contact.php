<?php get_header(); ?>



    <main id="contact">

        <div class="container">

            <div class="row">

                <div class="text-center">

                    <img id="mdq-logo" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img-contact/mdq-contact.jpg">

                </div>

            </div>

            <p id="mdq">Maison de quartier de Planoise <?= get_template_directory_uri(); ?></p>

            <div class="row">

                <p id="nous-contacter">Nous contacter</p>

                <form class="cf">

                    <div class="half left cf">

                        <input class="form-input" type="text" id="input-name" placeholder="Nom Prénom">

                        <input class="form-input" type="email" id="input-email" placeholder="Adresse mail">

                        <input class="form-input" type="text" id="input-subject" placeholder="Objet">

                    </div>

                    <div class="half right cf">

                        <textarea name="message" type="text" id="input-message" placeholder="Message"></textarea>

                    </div>

                    <input type="submit" value="Submit" id="input-submit">

                </form>

            </div>

        </div>

    </main>

    <?php get_footer(); ?>

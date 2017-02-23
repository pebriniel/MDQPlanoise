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

<main id="apropos">
  <!-- carte visite -->
  <div class="container">
    <div class="col-md-12">
    <div class="row carteVisite">
      <div class="col-md-3 logo">
        <div class="thumbnail">
          <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/logo_mdq.png" alt="logo mdq">
            <!-- <div class="caption">
              <h3>"Lorem ispum dolor sit"</h3>
            </div> -->
        </div>
      </div>
          <div class="col-md-9 description">
            <p>
              La Maison de quartier est un espace d’accueil et de loisirs ouvert à tous et au service de tous.
            </p>
            <p>
              Elle propose des activités propices au développement et à l’épanouissement personnel à tout âge.
            </p>
            <p>
            Lieu de vie, d’animation, de rassemblement, d’échanges, d’émergence de projets, force motrice pour le quartier,
            elle se veut facilitatrice des initiatives locales porteuses de renouveau et joue un rôle fédérateur entre les acteurs
             du quartier.
            </p>

          <button type="button" name="button" class="btn center-block">Nous contacter</button>
          </div>
       </div>
     </div>
    </div>
   <!-- fin carte visite -->

   <!-- missions -->
    <div class="container missionsAsso">
      <h2>Nos Missions</h2>
        <p class="missionsPrez">En tant que structure agréée Centre social par la Caisse d’allocations
           familiales du Doubs, des missions lui sont par ailleurs assignées, telles que :
        </p>


      <div class="row missions">
        <div class="col-md-4">
          <div class="thumbnail">
            <img class="localisation" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/localisation.svg" alt="mission 1">
          <div class="caption">
             <!-- <h3>Titre</h3> -->
              <p>
               Prendre en compte les spécificités du territoire en
               général et des personnes en particulier pour un accompagnement
               et un soutien adaptés.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail">
            <img class="settings" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/settingsIcon.svg" alt="mission 2">
            <div class="caption">
             <!-- <h3>Titre</h3> -->
              <p>
               S’appuyer sur les compétences, les savoir-faire
               et la créativité des habitants, associations et partenaires,
               les mettre en synergie et les valoriser..
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="thumbnail">
            <img class="solidarity" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/solidarity.svg" alt="mission 3">
            <div class="caption">
             <!-- <h3>Titre</h3> -->
              <p>
               Encourager la participation etl’engagement des habitants dans la
               vie de la structure, du quartier et de la ville pour un
               quotidien solidaire et citoyen.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- fin missions -->

    <!-- coordonnées -->
  <div class="container loc">
    <div class="row">
      <h2>Mes Coordonnées</h2>
      <div class="adresseAsso col-md-7">
        <div class="row">
          <div class="scolaire col-md-5">
            <h3>Période scolaire</h3>
            <div class="jours col-md-4">
              <ul>
                <li>Lundi</li>
                <li>Mardi</li>
                <li>Mercredi</li>
                <li>Jeudi</li>
                <li>Vendredi</li>
                <li>Samedi</li>
              </ul>
            </div>
            <div class="heureM col-md-4">
              <ul>
                <li>   .    </li>
                <li>9h à 12h</li>
                <li>9h à 12h</li>
                <li>9h à 12h</li>
                <li>9h à 12h</li>
                <li>9h à 12h</li>
              </ul>
            </div>
            <div class="heureA col-md-4">
              <ul>
                <li>14h à 19h</li>
                <li>14h à 19h</li>
                <li>14h à 19h</li>
                <li>14h à 19h</li>
                <li>14h à 19h</li>
                <li>14h à 18h</li>
              </ul>
            </div>
          </div>
          <div class="vacances col-md-7">
            <h3>Petites vacances</h3>
            <p>Du lundi au vendredi de 9h à 12h et de 14h à 19h</p>
            <h3 class="gdeVacances">Vacances d'été</h3>
            <p>Du lundi au vendredi de 9h à 12h et de 14h à 18h</p>
          </div>
        </div>
        <div class="row coordonnées">
          <div class="adresseMdq col-md-5">
            <h4>
              Maison de quartier Planoise
              Centre Nelson Mandela
              13 avenue de l'Ile-de-France
              25000 BESANCON
            </h4>
          </div>
          <div class="telephone col-md-7">
            <h4>Tél.: 03 81 87 81 20</h4>
            <h4>Fax: 03 81 51 65 80</h4>
            <h4>planoise.mdq@besancon.fr</h4>
          </div>
        </div>
      </div>
      <div class="col-md-5 map">
        <div id="mapid">
      </div>
      <script>
      $(document).ready(function(){
        if ($('#mapid').is(':visible')){
          console.log('visible');
          var mymap = L.map('mapid').setView([47.221094, 5.967786], 16);
          var marker = L.marker([47.221094, 5.967786]).addTo(mymap);
          L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYm91c3NhZCIsImEiOiJjaXlhMmxnMW0wMDRzMndxcngwNXNyZ2syIn0.aEfKXXy196Ds4KIdWnu-dw', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets'
          }).addTo(mymap);
        }
      });
      </script>
      </div>
    </div>
  </div>
  <!-- fin coordonnées -->

</main>

<?php get_footer(); ?>

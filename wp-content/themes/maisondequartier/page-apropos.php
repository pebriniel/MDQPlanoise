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
        <div class="col-md-12  col-xs-12 desc">
            <div class="row carteVisite">
                <div class="col-md-3 logo col-xs-12">
                    <div class="thumbnail">
                        <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/logo_mdq.png" alt="logo mdq">
                         <div class="caption">
                        <button type="button" name="button" class="btn center-block">Télécharger la plaquette</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-xs-12 description">
                <p>
                    La Maison de quartier est un espace d’accueil et de loisirs ouvert à tous et au service de tous.
                    <br/>
                    Elle propose des activités propices au développement et à l’épanouissement personnel à tout âge.
                    <br/>
                    Lieu de vie, d’animation, de rassemblement, d’échanges, d’émergence de projets, force motrice pour le quartier,
                    elle se veut facilitatrice des initiatives locales porteuses de renouveau et joue un rôle fédérateur entre les acteurs
                    du quartier.
                </p>

            </div>
        </div>
    </div>
</div>
<!-- fin carte visite -->

<!-- missions -->
<div class="container missionsAsso">
    <h2>Nos Missions</h2>
    <!-- <div class="missionsPrez">
    <p>En tant que structure agréée Centre social par la Caisse d’allocations
        familiales du Doubs, des missions lui sont par ailleurs assignées, telles que :
    </p>
  </div> -->


    <div class="row missions">
      <div class="row missions">
        <div class="col-md-12">
          <div class="col-xs-12 col-md-4 col-lg-4">
              <!-- <div class="thumbnail"> -->
              <div class="thumbnail loca">
                  <!-- <img class="localisation" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/localisation.svg" alt="mission 1"> -->
                  <div class="caption">
                      <h3>Proximité</h3>
                      <p>
                        <B>Être un lieu de proximité à vocation globale</B> (sport, loisir, culture, éducation, social ...), <B>familiale et intergénérationnelle</B>,
                           qui accueille toute la population en veillant à la mixité sociale ; offrant <B>accueil, animations, activités et services</B> à finalité sociale ;
                            un lieu de <B>rencontre et d'échange</B> entre les générations, il favorise le développement des liens familiaux et sociaux.
                      </p>
                  </div>
              </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-4">
              <!-- <div class="thumbnail"> -->
              <div class="thumbnail set">
                  <!-- <img class="settings" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/settingsIcon.svg" alt="mission 2"> -->
                  <div class="caption">
                      <h3>Animation</h3>
                      <p>
                        <B>Être un lieu d’animation de la vie sociale</B> permettant aux habitants <B>d’exprimer, de concevoir et de réaliser leurs projets</B>,
                         de favoriser le développement de <B>la vie associative</B> et de contribuer au développement du <B>partenariat</B> pour améliorer
                          la qualité de vie au quotidien de tous les habitants.
                      </p>
                  </div>
              </div>
          </div>
          <div class="col-xs-12 col-md-4 col-lg-4">
              <!-- <div class="thumbnail"> -->
                <div class="thumbnail sol">
                  <!-- <img class="solidarity" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/solidarity.svg" alt="mission 3"> -->
                  <div class="caption">
                      <h3>Rencontre</h3>
                      <p>
                        Héberger des permanences menées par des partenaires associatifs ou institutionnels <B>favorisant l’accès aux droits</B>.
                      </p>
                  </div>
              </div>
          </div>
      </div>
      <div class="accroche">
        <p>N’hésitez pas à venir pousser les portes de la Maison de quartierpour découvrir toutes nos activités ! Notre équipe de professionnels vous y réservera le meilleur accueil.</p>
      </div>
    </div>
  </div>
<!-- fin missions -->

<!-- vie Associative -->
<div class="container compteur">
  <div class="row">
    <h2>La Maison de Quartier, c'est aussi:</h2>
    <div class="ad col-md-4">
      <div class="adherents col-md-12 col-xs-12">
        <h3>1564</h3>
        <p>Adhérents</p>
      </div>
    </div>
    <div class="ben col-md-4">
      <div class="benevoles col-md-12 col-xs-12">
        <h3>25</h3>
        <p>Bénévoles</p>
      </div>
    </div>
    <div class="sal col-md-4">
      <div class="salaries col-md-12 col-xs-12">
        <h3>18</h3>
        <p>Salariés</p>
      </div>
    </div>
  </div>
</div>
<!-- fin vie Associative -->

<!-- gallerie photos -->
<div class="container gallery">
  <div class="row center-block">
    <div class="act1 col-md-4">
      <div class="activite1 col-md-12 col-xs-12">
      <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/mdqActivite1.JPG" alt="activite 1">
      </div>
    </div>
    <div class="act2 col-md-4">
      <div class="activite2 col-md-12 col-xs-12">
      <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/mdqActivite2.JPG" alt="activite 2">
      </div>
    </div>
    <div class="act3 col-md-4">
      <div class="activite3 col-md-12 col-xs-12">
      <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/mdqActivite3.jpg" alt="activite 3">
      </div>
    </div>
  </div>
</div>
<!-- fin gallerie photos -->


<!-- coordonnées -->
<div class="container loc">
    <div class="row">
        <h2>Nos Coordonnées</h2>
        <div class="col-md-12">
        <div class="adresseAsso col-md-7">
            <div class="row">
                <div class="scolaire col-md-5">
                    <h3>Période scolaire</h3>
                    <div class="jours col-md-4 col-xs-4">
                        <ul>
                            <li>Lundi</li>
                            <li>Mardi</li>
                            <li>Mercredi</li>
                            <li>Jeudi</li>
                            <li>Vendredi</li>
                            <li>Samedi</li>
                        </ul>
                    </div>
                    <div class="heureM col-md-4 col-xs-4">
                        <ul>
                            <li>   .    </li>
                            <li>9h à 12h</li>
                            <li>9h à 12h</li>
                            <li>9h à 12h</li>
                            <li>9h à 12h</li>
                            <li>9h à 12h</li>
                        </ul>
                    </div>
                    <div class="heureA col-md-4 col-xs-4">
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
                    <h4>Tél.: <a href="tel:0381878120"> 03 81 87 81 20</a></h4>
                    <h4>Email: <a href="mailto:planoise.mdq@besancon.fr">planoise.mdq@besancon.fr</a></h4>
                    <h4>Fax: 03 81 51 65 80</h4>
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
</div>
<!-- fin coordonnées -->

</main>

<?php get_footer(); ?>

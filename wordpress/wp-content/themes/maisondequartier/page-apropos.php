<?php get_header(); ?>

<style media="screen">
    #apropos{
        margin-top: 8px;
    }
    #apropos #transition{
        height: 38px;
        padding: 0;
    }
    #apropos #transition::before, #apropos #transition::after{
        height: 39px;
    }
    #transition ul .active{
        height: 38px;
    }
    #apropos .btn-mdq, #apropos .btn-mdq:hover{
        text-decoration: none;
        padding-top: 0.5em;
    }
</style>

<main id="apropos" class="container">
    <!-- 2eme barre de nav -->
    <div id="transition" class="row transition-assoc">
      <div class="col-md-12 col-xs-12" id="menu-assoc">
        <ul>
          <li>
            <a class="link" data-id="cartevisite" href="#cartevisite">
              <span class="glyphicon glyphicon-info-sign"></span>
              <span class="text">Description</span>
            </a>
          </li>
          <li>
            <a class="link" data-id="missionsAsso" href="#missionsAsso">
              <span class="glyphicon glyphicon-screenshot"></span>
              <span class="text">Missions</span>
            </a>
          </li>
          <li>
            <a class="link" data-id="gallery" href="#gallery">
              <span class="glyphicon glyphicon-picture"></span>
              <span class="text">Galerie photos</span>
            </a>
          </li>
          <li>
            <a class="link" data-id="loc" href="#loc">
              <span class="glyphicon glyphicon-envelope"></span>
              <span class="text">Coordonnées</span>
            </a>
          </li>
        </ul>
      </div>
        </div>
    <!-- fin de 2eme barre de nav -->

    <!-- carte visite -->
    <div class="row" id="cartevisite">

        <div class="col-md-12 col-xs-12 desc">

          <div class="col-md-3 logo col-xs-12 text-center">
              <img id="imgmdq" src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/logo_mdq.jpg" alt="logo-maison-de-quartie-planoise">
              <a href="http://houdab.public.codeur.online/wordpress/wp-content/uploads/2017/06/plaquette-mdq-planoise.pdf" class="btn-mdq center-block" download>Télécharger la plaquette</a>
          </div>
          <div class="col-md-9 col-xs-12 description">
              <p>
                  La Maison de quartier  de Planoise est une structure municipale,  agréee centre social par la Caisse d’Allocations Familiales du Doubs.
                  <br/><br/>
                  Elle est animée par une équipe de professionnels qui intervient aux côtés de bénévoles et de partenaires, au service du « vivre ensemble ».
              </p>
              <br/>
              <p>N’hésitez pas à venir pousser les portes de la Maison de quartier pour découvrir toutes nos activités ! Notre équipe de professionnels vous y réservera le meilleur accueil.</p>
          </div>

      </div>
    </div>
  <!-- fin carte visite -->

  <!-- missions -->
  <div class="row missionsAsso" id="missionsAsso">
    <h2>nos missions</h2>
    <div class="row missions">
      <div class="col-md-12 center-block">
        <div class="proximite col-md-4">
          <div class="prox col-md-12">
            <h3>Proximité</h3>
            <p>
              <B>Être un lieu de proximité à vocation globale</B> (sport, loisir, culture, éducation, social ...), <B>familiale et intergénérationnelle</B>,
              qui accueille toute la population en veillant à la mixité sociale ; offrant <B>accueil, animations, activités et services</B> à finalité sociale ;
              un lieu de <B>rencontre et d'échange</B> entre les générations, il favorise le développement des liens familiaux et sociaux.
            </p>
          </div>
        </div>
        <div class="animation col-md-4">
          <div class="anim col-md-12">
            <h3>Animation</h3>
            <p>
              <B>Être un lieu d’animation de la vie sociale</B> permettant aux habitants <B>d’exprimer, de concevoir et de réaliser leurs projets</B>,
              de favoriser le développement de <B>la vie associative</B> et de contribuer au développement du <B>partenariat</B> pour améliorer
              la qualité de vie au quotidien de tous les habitants.
            </p>
          </div>
        </div>
        <div class="rencontre col-md-4">
          <div class="renc col-md-12">
            <h3>Rencontre</h3>
            <p>
              Héberger des permanences menées par des partenaires associatifs ou institutionnels <B>favorisant l’accès aux droits</B>.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- fin missions -->

  <!-- vie Associative -->
  <div class="row compteur">
    <div class="row">
      <div class="col-md-12">
      <h2>La Maison de Quartier, c'est aussi:</h2>
    </div>
      <div class="col-md-4 col-xs-4">
        <div class="cpte col-md-12 col-xs-12">
          <h3>1564</h3>
          <p>Adhérents</p>
        </div>
      </div>
      <div class="col-md-4 col-xs-4">
        <div class="cpte col-md-12 col-xs-12">
          <h3>25</h3>
          <p>Bénévoles</p>
        </div>
      </div>
      <div class="col-md-4 col-xs-4">
        <div class="cpte col-md-12 col-xs-12">
          <h3>18</h3>
          <p>Salariés</p>
        </div>
      </div>
    </div>
  </div>
  <!-- fin vie Associative -->

  <!-- gallerie photos -->
  <div class="row gallery" id="gallery">
    <div class="row center-block">
      <div class="act1 col-md-4">
        <div class="activite col-md-12 col-xs-12">
        <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/mdqActivite1.JPG" alt="activite 1">
        </div>
      </div>
      <div class="act2 col-md-4">
        <div class="activite col-md-12 col-xs-12">
        <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/mdqActivite2.JPG" alt="activite 2">
        </div>
      </div>
      <div class="act3 col-md-4">
        <div class="activite col-md-12 col-xs-12">
        <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/mdqActivite3.jpg" alt="activite 3">
        </div>
      </div>
    </div>
  </div>
  <!-- fin gallerie photos -->

  <!-- coordonnées -->
  <div class="row loc" id="loc">
      <div class="row">
          <h2>nos coordonnées</h2>
          <section class="adresseAsso col-md-12">
              <article class="adresseMdq col-md-6">
                <div class="adressePostale col-md-12">
                  <h4>Maison de quartier Planoise</h4>
                  <p>Centre Nelson Mandela
                      <br/>
                      13 avenue de l'Ile-de-France - 25000 BESAN&Ccedil;ON
                  </p>

                  <p>Téléphone : <a href="tel:0381878120"> 03 81 87 81 20</a></p>
                  <p>Courriel : <a href="mailto:planoise.mdq@besancon.fr">planoise.mdq@besancon.fr</a></p>
                  <p>Fax : 03 81 51 65 80</p>
                <img src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/img/img_apropos/villeBesancon.jpg" alt="Ville de Besançon">
              </article>
              <article class="scolaire col-md-6">
                  <h3>Période scolaire</h3>
                  <p>Lundi au Vendredi : de 9h à 12h  et de 14h à 19h</p>
                  <p>Samedi : de 9h à 12h et de 14h à 18h</p>
                  <h3>Petites vacances</h3>
                  <p>Du lundi au vendredi de 9h à 12h et de 14h à 19h</p>
                  <h3>Vacances d'été</h3>
                  <p>Du lundi au vendredi de 9h à 12h et de 14h à 18h</p>
              </article>
          </section>
          <section class="col-md-12 map">
            <div id="mapid"></div>
            <script>
              $(document).ready(function(){
                  if ($('#mapid').is(':visible')){
                      var mymap = L.map('mapid').setView([47.221094, 5.967786], 16);
                      var marker = L.marker([47.221094, 5.967786]).addTo(mymap).bindPopup('Centre Nelson Mandela - 13 avenue de l\'Ile-de-France - 25000 Besançon');
                      L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYm91c3NhZCIsImEiOiJjaXlhMmxnMW0wMDRzMndxcngwNXNyZ2syIn0.aEfKXXy196Ds4KIdWnu-dw', {
                          attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
                          maxZoom: 18,
                          id: 'mapbox.streets'
                      }).addTo(mymap);
                  }
              });
            </script>
          </section>
      </div>
    </div>
<!-- fin coordonnées -->

<script type="text/javascript">
    $(".link").click(function() {
        var aTag = $("div[id='"+ aid +"']");
        $('html,body').animate({scrollTop: aTag.offset().top - 200},'slow');
    });

    // Cache selectors
    var topMenu = $("#menu-assoc"),
        topMenuHeight = topMenu.outerHeight()+150,

        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
          var item = $($(this).attr("href"));
          if (item.length) { return item; }
        });

    // Bind to scroll
    $(window).scroll(function(){
       // Get container scroll position
       var fromTop = $(this).scrollTop()+topMenuHeight;

       // Get id of current scroll item
       var cur = scrollItems.map(function(){
            if ($(this).offset().top < fromTop){
                return this;
            }
       });

       // Get the id of the current element
       cur = cur[cur.length-1];

       var id = cur && cur.length ? cur[0].id : "";
       // Set/remove active class
       menuItems
         .parent().removeClass("active")
         .end().filter("[href='#"+id+"']").parent().addClass("active");
    });
</script>

</main>

<?php get_footer(); ?>

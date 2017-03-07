<?php
/**
* The main template file
*
* @package bootstrap-basic
*/

get_header();

?>


<main id="onepageasso" class="site-main" role="main">
	<script>
		function callMap(adress, id){
				$.get('http://maps.googleapis.com/maps/api/geocode/json?address='+adress+'&sensor=true', function(reponse){
					let pos = reponse['results'][0]['geometry']['location'];
					if ($('#mapid-'+id).is(':visible')){
						var mymap = L.map('mapid-'+id).setView([pos['lat'], pos['lng']], 16);
						var marker = L.marker([pos['lat'], pos['lng']]).addTo(mymap);
						L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYm91c3NhZCIsImEiOiJjaXlhMmxnMW0wMDRzMndxcngwNXNyZ2syIn0.aEfKXXy196Ds4KIdWnu-dw', {
							attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
							maxZoom: 18,
							id: 'mapbox.streets'
						}).addTo(mymap);
					}
				});
		}
	</script>


	<?php


	query_posts(array('post_type' => 'fiche'));

	if($infosAsso = get_post($fiche)){
		while(have_posts()){
						the_post();


		if($infosAsso->post_type == 'fiche'){
			?>

			<div id="transition" class="row transition-assoc">
				<div class="col-md-12 col-xs-12" id="menu-assoc">
					<ul>
						<?php
						if($infosAsso->showDescription){
						?>
						<li>
							<a href="#cartevisite">
								<span class="glyphicon glyphicon-info-sign"></span>
								<span class="text">Description</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showCaroussel){
						?>
						<li>
							<a href="#evenements">
								<span class="glyphicon glyphicon-calendar"></span>
	              <span class="text">Évènements</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showMembers){
						?>
						<li>
							<a href="#membres">
								<span class="glyphicon glyphicon-user"></span>
	                       		<span class="text">Membres</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showCoordonnees){
						?>
						<li>
							<a href="#coordonnees">
								<span class="glyphicon glyphicon-home"></span>
	                       		<span class="text">Coordonnées & Horaires</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showFormulaire){
						?>
						<li>
							<a href="#join">
								<span class="glyphicon glyphicon-envelope"></span>
	                       		<span class="text">Contact</span>
							</a>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>

		<div class="content-onepage">
			<?php

			if($infosAsso->showDescription){
				?>
				<!-- carte visite -->
				<div id="cartevisite" class="container">
					<div class="col-md-12 carteVisite">
						<div class="col-md-4 logo">

							<div class="thumbnail">
								<span><?= get_the_post_thumbnail($infosAsso->ID, 'fiche-association'); ?></span>
								<div class="caption">
									<h3><?= $infosAsso->_name; ?></h3>
								</div>
							</div>
							<div>Tarif d'adhésion : <?= $infosAsso->_membership; ?></div>
							<button type="button" name="button" class="btn btn-link-leaflet center-block">Télécharger la plaquette</button>

						</div>
						<div class="col-md-8 descrip text-justify">
							<p><?= the_content(); // $infosAsso->_desc;?></p>
						</div>
					</div>
				</div>
				<!-- fin carte visite -->
			<?php

			}

			if($infosAsso->showCaroussel){

			?>

			<!-- carousel bootstrap -->
		  <div id="evenements" class="container carousel">

		 <?php
		 query_posts(array('post_type'=>'slider',
		 					'meta_key'  => 'mdq_listing_assoc',
		 					'meta_value' => $infosAsso->ID));

		 $images = array();
		 ?>

		 <div id="myCarousel" class="carousel slide" data-ride="carousel">
		 	 <!-- Wrapper for slides -->

		 <?php

		  if(have_posts()){
		 	while ( have_posts() ) {
		 			the_post();
		 			global $post;

		 		 if ( '' != get_the_post_thumbnail(get_the_ID(), 'size-carousel-display-home') ) {
		 				$post_id = get_the_ID();

		 				$title = get_the_title();
		 				$content = get_the_excerpt();
		 			// $size = image_resize($post->ID, 100, 50);
		 				$image = get_the_post_thumbnail(get_the_ID(), 'size-carousel-display-home');
		 				$image_src = wp_get_attachment_image_src(get_post_thumbnail_id());
		 				$image_src = $image_src[0];
		 				$url = get_post_meta(get_the_ID(), 'slider_image_url', true);
		 				$url_openblank = get_post_meta(get_the_ID(), 'slider_image_url_openblank', true);
		 				$link_text = get_post_meta(get_the_ID(), 'slider_image_link_text', true);
		 			 	$asso_orga = $infosAsso->_name;

		 			// 	$asso_orga = get_post_meta(get_the_ID(), 'mdq_listing_assoc', true);
		 				$dateStart = get_post_meta(get_the_ID(), 'event_asso_start', true);
						$dateDisplayStart = date_i18n("d/m/Y", strtotime($dateStart));
						$dateEnd = get_post_meta(get_the_ID(), 'event_asso_end', true);
						$dateDisplayEnd = date_i18n("d/m/Y", strtotime($dateEnd));
						$hour = get_post_meta(get_the_ID(), 'event_asso_hour_start', true);
						$eventHourStart = date_i18n("G:i", strtotime($hour));
						$location_event = get_post_meta(get_the_ID(), 'event_asso_address', true);
		 				$images[] = array('post_id' => $post_id,
		 													'title' => $title,
		 													'dateStart' => $dateDisplayStart,
		 													'dateEnd' => $dateDisplayEnd,
															'heure' => $eventHourStart,
		 													'location' => $location_event,
		 													'content' => $content,
		 													'image' => $image,
		 													'img_src' => $image_src,
		 													'url' => esc_url($url),
		 													'url_openblank' => $url_openblank == "1" ? true : false,
		 													'link_text' => $link_text,
		 													'association' => $asso_orga);

		 		}
		  }

		 	?>
		 	<div class="carousel-inner" role="listbox">
		 		 <ol class="carousel-indicators">
		 		<?php
		 			 $active = 'class="active"';
		     		 foreach ($images as $key => $image)
		     		 {
		 				 static $i = 0;
		 			?>
		 		   		<li data-target="#myCarousel" data-slide-to="<?= $i; ?>" <?= $active; ?>></li>
		 			<?php
		 				$i ++;
		 				$active = "";
		 			}
		 			?>
		 		 </ol>
		 	 <?php
		 		 $active = "active";
		 		 foreach ($images as $key => $image)
		 		 {
		 			 ?>
					 <div class="item <?= $active; ?>  modal-click">
						<?= $image['image']; ?>
						 <div class="carousel-caption">
							 <h3 class="img-modal img-responsive" title="<?= $image['title']; ?>"><?= $image['title'];?></h3>

							 <p> Le <?= $image['dateStart'];?> à <?= $image['heure'];?></p>
							 <p><?= $image['association'];?></p>
							 <a class="btn-link img-modal" id="image-<?= $images['post_id']; ?>" data-title="<?= $image['title']; ?>" data-content="<?= $image['content']; ?>" data-img="<?= $image['img_src'] ?>" data-date="<?= $image['dateStart']; ?>" data-location="<?= $image['location']; ?>" data-url="<?=  get_site_url()."/association/?fiche=".$image['association']; ?>" role="button">voir l'événement</a>

						 </div>
					 </div>

					<?php

					$active = "";
				}
				?>

			 <?php  	}  ?>
		 </div>

			 <!-- Left and right controls -->
			 <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				 <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: #ff6633;"></span>
				 <span class="sr-only">Précèdent</span>
			 </a>
			 <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				 <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: #ff6633;"></span>
				 <span class="sr-only">Suivant</span>
			 </a>
		 </div>
		</div>
		<!-- fin de carousel -->

	<!-- la modal -->
	<div class="modal container" id="modal-gallery" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">×</button>
					<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
	</div>

	<script>
	$(document).ready(function() {
	 /* change modal title when slide changes */
	 $("#modal-carousel").on("slid.bs.carousel", function () {
				$(".modal-title")
				.html($(this)
				.find(".active img")
				.attr("title"));
	 });

	 /* when clicking a thumbnail */
	 $(".modal-click .img-modal").click(function(){
			var title = $(this).data('title');
			var description = $(this).data('content');
			var date = $(this).data('date');
			var image = $(this).data('img');
			var location = $(this).data('location');
			var url = $(this).data('url');
	 		var content = $(".modal-body");
			var modal_title = $(".modal-title");

		//content.empty();
		modal_title.empty();

		modal_title.html(title);
		content.html("<img src='"+image+"' /> <p id='modal-date'>Date de l'événement : "+  date + " </p><p id='modal-location'>Lieu : " + location + "</p> <p id='modal-description'>"  + description + "</p><a href='"+url+"'> voir la fiche de l'association</a>");

		// show the modal
		$("#modal-gallery").modal("show");
	});

	});
	</script>

		  <?php
	  }

	 if($infosAsso->showAgenda){
	  ?>
	  	<div class="container" id="as-activite">
			<?php
			query_posts(array(
				'post_type'=>'activite',
				'meta_key'  => 'mdq_association_id',
				'meta_value' => $infosAsso->ID));

				if ( have_posts() ){
					while (have_posts()){
						the_post();
						// add_image_size($post->ID, 1000, 200, false);
						global $post;
						?>
					  <div class="col-md-4 thumbnail thumbnail-activite">
						<div id="acti-<?= $post->ID; ?>" data-id="<?= $post->ID; ?>" class="block-activite acti-<?= $post->ID; ?> content-hidden overflow background-white">
							<div class="image">
								<img src="http://boussads.student.codeur.online/wclient/wp-content/uploads/2017/02/P_20170108_184437.jpg" />
							</div>
							<div class="title">
								<h3><?= $post->post_title; ?></h3>
							</div>
							<div class="description mtop">
								<?= $post->mdq_event_description; ?>
							</div>
							<div class="horaire mtop"></div>
								<h4>Horaires</h4>
								<?= $post->mdq_event_date; ?>

							<div id="mapid-<?= $post->ID; ?>" class="map mtop mbot">

							</div>
							<script>
							$(document).ready(function(){
								callMap('<?= $post->mdq_event_adresse; ?>', '<?= $post->ID; ?>');
							});
							</script>

							<div class="div-hover" data-id="<?= $post->ID; ?>">
								<span class="gly-<?= $post->ID; ?> glyphicon glyphicon-chevron-down down-chevron" aria-hidden="true"></span>
							</div>

						</div>
					</div>
				<?php

		}

			}
			?>
		</div>

		<script>
					$(document).ready(function(){
						var last_id = null;
						$("html").click(function(){
							$(".block-activite").each(function( index ){
								let i = $(this).data('id');
								$("#acti-"+i).addClass("overflow");
								$("#acti-"+i).removeClass("active");
								$(".gly-"+i).addClass("glyphicon-chevron-down");
								$(".gly-"+i).removeClass("glyphicon-chevron-up");
							});
						});

						$(".div-hover").click(function(e){
							e.stopPropagation();
							var id = $(this).data('id');
							var button = $(this);
							console.log(id);
							$(".block-activite").each(function( index ){
								console.log(this);
								if($(this).hasClass("acti-"+id)){
								console.log('ok');
									if(!$(this).hasClass("active")){
										//on cache
										console.log('lol');
										$("#acti-"+id).removeClass("overflow");
										$("#acti-"+id).addClass("active");
										$(".gly-"+id).removeClass("glyphicon-chevron-down");
										$(".gly-"+id).addClass("glyphicon-chevron-up");
										$(button).addClass("che-down");
									}
									else{
										console.log('dev');
										$("#acti-"+id).addClass("overflow");
										$("#acti-"+id).removeClass("active");
										$(".gly-"+id).addClass("glyphicon-chevron-down");
										$(".gly-"+id).removeClass("glyphicon-chevron-up");
										$(button).removeClass("che-down");
										//on affiche
									}
								}
								else{
									console.log('wtf');
									let i = $(this).data('id');
										$("#acti-"+i).addClass("overflow");
										$("#acti-"+i).removeClass("active");
										$(".gly-"+i).addClass("glyphicon-chevron-down");
										$(".gly-"+i).removeClass("glyphicon-chevron-up");
									//on cache
								}

							});

							last_id = id;
						});
					});
				</script>
	<?php



		}
		 if($infosAsso->showMembers){
		?>

						<!-- membres asso -->
						<div id="membres" class="container prezmembres">
							<h2>Les Membres</h2>
							<div class="row">
								<?php

								query_posts(array(
									'post_type'=>'members',
									'meta_key'  => 'mdq_members_associations',
									'meta_value' => $infosAsso->ID));

									if ( have_posts() ){
										while ( have_posts() ){
											the_post();
											global $post;
											?>
											<div class="col-md-3 membres">
												<div class="thumbnail">
													<!-- <img src="wp-content/themes/maisonquartier/img/img_onepageasso/user.jpg" alt="..."> -->
													<?= edit_post_link(get_the_post_thumbnail($post->ID)); ?>
													<div class="caption">
														<h3><?= $post->event_title;?></h3>
														<p><?= $post->mdq_event_description; ?></p>
													</div>
												</div>
											</div>
											<?php
										}
									}
									?>
								</div>
								<div class="members-plus">
									<svg class="more" enable-background="new 0 0 48 48" height="60px" id="Layer_1" version="1.1" viewBox="0 0 48 48" width="60px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
										<path d="M24,0C10.745,0,0,10.745,0,24c0,13.254,10.745,24,24,24s24-10.746,24-24C48,10.745,37.255,0,24,0z   M34.031,24.766c0,1.109-0.9,1.305-1.354,1.332h-6.581l-0.008,6.607c-0.002,1.221-0.933,1.322-1.18,1.326L23.1,34.029  c-0.27-0.006-1.211-0.109-1.209-1.33l0.008-6.602h-6.602c-1.221,0-1.322-0.93-1.328-1.178v-1.809  c0.005-0.27,0.108-1.211,1.328-1.211h6.607l0.008-6.463c0.006-0.306,0.107-1.472,1.288-1.47l1.578,0.002  c1.11,0.001,1.305,0.902,1.331,1.356L26.102,21.9h6.458c0.306,0.006,1.472,0.105,1.472,1.287V24.766z" fill="#ff6633"/>
									</svg>
								</div>
							</div>

							<script>
								$(document).ready(function(){
									var membres = $(".members-plus");
									membres.hide();

									var members = $('.membres');
									if(members.length >= 4){
										$("#membres").addClass("overflow-content");
										membres.show();
									}

									membres.click(function(){
										$("#membres").toggleClass("overflow-content");
									});
								});
							</script>
							<!-- fin membres asso -->
			<?php

		}

		if($infosAsso->showCoordonnees){
		?>
							<!-- adresse asso -->
							<div class="container loc" id="coordonnees">
								<div class="row">
									<div class="col-md-12">
										<div id="infos_asso" class="adresseAsso col-md-7">
											<h2><?= $infosAsso->_name; ?></h2>
											<h4><?= $infosAsso->_address; ?></h4>
											<h4><?= $infosAsso->_pc; ?> - <?= $infosAsso->_city; ?></h4>
											<h4>Téléphone : <a href="tel:<?= $infosAsso->_tel; ?>"><?= $infosAsso->_tel; ?></a></h4>

											<h4><a href="<?=  $infosAsso->_link;  ?>"><?= $infosAsso->_link; ?></a></h4>
											<h3>Ouverture - période scolaire :</h3>
											<p><?= $infosAsso->_school;?></p>
	<?php if($infosAsso->showsmallHolidays){  ?>
											<h3>Ouverture - petites vacances :</h3>
											<p><?= $infosAsso->_smallHolidays; }?></p>
	<?php if($infosAsso->showbigHolidays){  ?>
											<h3>Ouverture - grandes vacances : </h3>
											<p><?= $infosAsso->_bigHolidays; }?></p>
										</div>

										<div class="map col-md-5">
											<div id="mapid-association">
											</div>
											<script>
											callMap('<?= $infosAsso->_address; ?> <?= $infosAsso->_city; ?> <?= $infosAsso->_pc; ?>', "association");
											</script>
										</div>
									</div>
								</div>
							</div>
							<!-- fin adresse asso -->
				<?php

			}

			if($infosAsso->showPartner){

				?>


				<div>ici les partenaires ?? voici l'affiche depuis le back : <?= $infosAsso->_partner; ?></div>
				<?php
			}

			if($infosAsso->showFormulaire){
			?>



							<!-- formulaire -->
							<div class="container contact" id="join">
								<form method="post" action="#" id="contact_form"  class="well form-horizontal" onsubmit=" return verification();">
									<h1>Formulaire de contact</h1>
									<fieldset>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input class="form-control" type="text" name="nom" id="nom" placeholder="votre nom et prénom*"/>
										</div>
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
											<input class="form-control" type="email" name="email" id="email" placeholder="votre email *" />
										</div>
									</fieldset>



									<fieldset>
										<textarea class="form-control message center-block" rows="12" placeholder="Ecrivez votre message ici..."></textarea>
									</fieldset>

									<div class="form-group">
										<label class="col-md-4 control-label"></label>
										<div class="col-md-4">
											<button type="submit" class="btn center-block">Envoyer <span class="glyphicon glyphicon-send"></span></button>
										</div>
									</div>
								</form>


							</div>

			<?php

		}
		?>
	</div>
						</main>

						<?php 	} 	} } get_footer(); ?>

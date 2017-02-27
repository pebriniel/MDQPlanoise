<?php
/**
* The main template file
*
* @package bootstrap-basic
*/

get_header();

?>


<main id="onepageasso" class="site-main" role="main">



	<?php
	query_posts(array('post_type' => 'fiche'));

	if($infosAsso = get_post($fiche)){

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
					<div class="row carteVisite">
						<div class="col-md-4 logo">

							<div class="thumbnail">
								<span><?= get_the_post_thumbnail($infosAsso->ID, 'fiche-association'); ?></span>
								<div class="caption">
									<h3><?= $infosAsso->_name; ?></h3>
								</div>
							</div>

						</div>
						<div class="col-md-8 descrip text-justify">
							<p><?= $infosAsso->_desc;?></p>
							<button type="button" name="button" class="btn btn-link center-block">Nous contacter</button>
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

		 if ( '' != get_the_post_thumbnail(get_the_ID()) ) {

		 			$post_id = get_the_ID();
		  			$title = get_the_title();
		  			$content = get_the_excerpt();
		 			// $size = image_resize($post->ID, 100, 50);
		  			$image = get_the_post_thumbnail( get_the_ID());
		  			$image_src = wp_get_attachment_image_src(get_post_thumbnail_id());
		 			$image_src = $image_src[0];
		  			$url = get_post_meta(get_the_ID(), 'slider_image_url', true);
		  			$url_openblank = get_post_meta(get_the_ID(), 'slider_image_url_openblank', true);
		  			$link_text = get_post_meta(get_the_ID(), 'slider_image_link_text', true);
		 			$asso_orga = $infosAsso->_name; //get_post_meta(get_the_ID(), 'mdq_listing_assoc', true);
		  			$images[] = array('post_id' => $post_id, 'title' => $title, 'content' => $content, 'image' => $image, 'img_src' => $image_src, 'url' => esc_url($url), 'url_openblank' => $url_openblank == "1" ? true : false, 'link_text' => $link_text, 'association' => $asso_orga);
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
		 			 <div class="item <?= $active; ?>">
		 				<?= $image['image']; ?>
		 				 <div class="carousel-caption">
		 					 <h3><?= $image['title'];?></h3>
		 					 <p><?= $image['content'];?></p>
		 					 <a href="<?=  get_site_url()."/association/?fiche=".$image['url_openblank']; ?>"  class="btn btn-association" role="button">voir l'événement</a>
		 					 <p><?= $image['association'];?></p>
		 				 </div>
		 			 </div>
		 			<?php

		 			$active = "";
		 		}
		 		?>

		 	 <?php
		 }  ?>
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
		  <!-- fin de carousel -->

		  <?php
	  }

	 if($infosAsso->showAgenda){
	  ?>

					<!-- activités des associations -->
					<div class="container">
						<div class="row screenshot">

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
										<!-- screenshot -->
										<div class="col-md-4 activ">
											<div class="thumbnail">
												<!-- <img src="wp-content/themes/maisonquartier/img/img_onepageasso/photo.jpg" alt="screenshot activité"> -->
												<span><?= edit_post_link(get_the_post_thumbnail($post->ID));  ?></span>

												<div class="caption">
													<h3><?= $post->post_title;?></h3>
													<p><?= $post->mdq_event_description;?> </p>
													<p><?= $post->mdq_event_adresse;?> </p>
													<p><?= $post->mdq_event_start;?> </p>
													<p><?= $post->mdq_event_end;?> </p>

												</div>
											</div>
										</div>

										<?php

									}
								}
								?>

							</div>
						</div>
						<!-- fin sreenshot -->

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
										<path d="M24,0C10.745,0,0,10.745,0,24c0,13.254,10.745,24,24,24s24-10.746,24-24C48,10.745,37.255,0,24,0z   M34.031,24.766c0,1.109-0.9,1.305-1.354,1.332h-6.581l-0.008,6.607c-0.002,1.221-0.933,1.322-1.18,1.326L23.1,34.029  c-0.27-0.006-1.211-0.109-1.209-1.33l0.008-6.602h-6.602c-1.221,0-1.322-0.93-1.328-1.178v-1.809  c0.005-0.27,0.108-1.211,1.328-1.211h6.607l0.008-6.463c0.006-0.306,0.107-1.472,1.288-1.47l1.578,0.002  c1.11,0.001,1.305,0.902,1.331,1.356L26.102,21.9h6.458c0.306,0.006,1.472,0.105,1.472,1.287V24.766z" fill="#eb661b"/>
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
											<h3>Ouverture - petites vacances :</h3>
											<p><?= $infosAsso->_smallHolidays;?></p>
											<h3>Ouverture - grandes vacances : </h3>
											<p><?= $infosAsso->_bigHolidays;?></p>
										</div>

										<div class="map col-md-5">
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
							<!-- fin adresse asso -->
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

						<?php 	} 	} get_footer(); ?>

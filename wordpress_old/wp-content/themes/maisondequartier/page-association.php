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
			<!-- carte visite -->
			<div class="container">
				<div class="row carteVisite">
					<div class="col-md-4 logo">

						<div class="thumbnail">
							<span><?= get_the_post_thumbnail($infosAsso->ID); ?></span>
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

			<!-- carousel bootstrap -->
			<div class="container carousel">

				<?php
				query_posts(array('post_type'=>'slider'));
				// if ( have_posts() ){
				// 			 while (have_posts()){
				// 			 the_post();
				// 			//  add_image_size($post->ID, 1000, 200, false);
				// 			 global $post;
				// 			 echo "<pre>";
				// 			 print_r($post);
				// 			 echo get_the_excerpt($post->ID) . " <br/>";
				// 			 echo get_post_thumbnail_id($post->ID). " <br/>";
				// 			 echo get_the_post_thumbnail($post->ID);
				// 			 echo "</pre>";
				// 		 }
				// 	 }

				///////////////////
				// FRONT END
				///////////////////

				// Shortcode
				function slider_shortcode($atts, $content = null) {
					// Set default shortcode attributes
					$options = get_option( 'slider_settings' );
					if(!$options){
						slider_set_options ();
						$options = get_option( 'slider_settings' );
					}
					$options['id'] = '';

					// Parse incomming $atts into an array and merge it with $defaults
					$atts = shortcode_atts($options, $atts);

					return slider_frontend($atts);
				}
				add_shortcode('image-carousel', 'slider_shortcode');

				// Display carousel

				$id = rand(0, 999);
				$images = array();


				/* affichage du début du carrousel */
				?>

				<!-- id="myCarousel" -->
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Wrapper for slides -->

					<?php
					if(have_posts()){
						//ici tu récupère le contenu de ton plugin slider
						while ( have_posts() ) {
							the_post();

							if ( '' != get_the_post_thumbnail(get_the_ID()) ) {
								// echo "<pre>";
								$post_id = get_the_ID();
								// echo $post_id . '<br/>';
								$title = get_the_title();
								//		echo $title . '<br/>';
								$content = get_the_excerpt();
								//	echo $content . '<br/>';
								// $size = image_resize($post->ID, 100, 50);

								$image = get_the_post_thumbnail( get_the_ID());
								//	echo $image . '<br/>';
								$image_src = wp_get_attachment_image_src(get_post_thumbnail_id());
								//	echo $image_src . '<br/>';
								$image_src = $image_src[0];
								$url = get_post_meta(get_the_ID(), 'slider_image_url', true);
								//	echo $url . '<br/>';
								$url_openblank = get_post_meta(get_the_ID(), 'slider_image_url_openblank', true);
								//	echo $url_openblank . '<br/>';
								$link_text = get_post_meta(get_the_ID(), 'slider_image_link_text', true);
								// echo $link_text . '<br/>';
								$images[] = array('post_id' => $post_id, 'title' => $title, 'content' => $content, 'image' => $image, 'img_src' => $image_src, 'url' => esc_url($url), 'url_openblank' => $url_openblank == "1" ? true : false, 'link_text' => $link_text);
								// echo "</pre>";
							}
						}

						//tu as mis dans la variable $imaages toues les données de tes slides dans un tableau ($images[])

						?>
						<div class="carousel-inner" role="listbox">
							<?php

							// Carousel Content

							//il faut maintenant boucle chaque valeur du tableau pour afficher ton slider

							//dans un premier temps pour faire afficher les petits boutons qui permettent de choisir un slide
							?>
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
									<!-- <img src="wp-content/themes/maisonquartier/img/img_onepageasso/photo.jpg" alt="évènement2"> -->
									<?= $image['image']; ?>
									<div class="carousel-caption">
										<h3><?= $image['title'];?></h3>
										<p><?= $image['content'];?></p>
										<a href="<?= $image['url_openblank']; ?>" role="button">Voir événement</a>
									</div>
								</div>

								<?php
								$active = "";
							}
							?>

							<?php  	}
							// 		}
							// }
							?>
						</div>

						<!-- Left and right controls -->
						<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Précèdent</span>
						</a>
						<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Suivant</span>
						</a>
					</div>
					<!-- fin de carousel -->

					<!-- activités des associations -->
					<script src="<?= get_site_url(); ?>/wp-content/themes/maisondequartier/js/readmoreFiche.js" type="text/javascript"></script> -->


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

						<!-- membres asso -->
						<div class="container prezmembres">
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
								<svg class="more" enable-background="new 0 0 48 48" height="60px" id="Layer_1" version="1.1" viewBox="0 0 48 48" width="60px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<path d="M24,0C10.745,0,0,10.745,0,24c0,13.254,10.745,24,24,24s24-10.746,24-24C48,10.745,37.255,0,24,0z   M34.031,24.766c0,1.109-0.9,1.305-1.354,1.332h-6.581l-0.008,6.607c-0.002,1.221-0.933,1.322-1.18,1.326L23.1,34.029  c-0.27-0.006-1.211-0.109-1.209-1.33l0.008-6.602h-6.602c-1.221,0-1.322-0.93-1.328-1.178v-1.809  c0.005-0.27,0.108-1.211,1.328-1.211h6.607l0.008-6.463c0.006-0.306,0.107-1.472,1.288-1.47l1.578,0.002  c1.11,0.001,1.305,0.902,1.331,1.356L26.102,21.9h6.458c0.306,0.006,1.472,0.105,1.472,1.287V24.766z" fill="#eb661b"/>
								</svg>
							</div>
							<!-- fin membres asso -->


							<!-- adresse asso -->
							<div class="container loc">
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


							<!-- formulaire -->
							<div class="container contact">
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
						</main>

						<?php 	} 	} get_footer(); ?>

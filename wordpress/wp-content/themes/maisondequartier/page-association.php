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
		// while(have_posts()){
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
							<a class="link" data-id="cartevisite">
								<span class="glyphicon glyphicon-info-sign"></span>
								<span class="text">Description</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showCaroussel){
						?>
						<li>
							<a class="link actualite-link" data-id="evenements">
								<span class="glyphicon glyphicon-calendar"></span>
	              				<span class="text">Actualités</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showMembers){
						?>
						<li>
							<a class="link" data-id="membres">
								<span class="glyphicon glyphicon-user"></span>
	                       		<span class="text">Vos interlocuteurs</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showCoordonnees){
						?>
						<li>
							<a class="link" data-id="coordonnees">
								<span class="glyphicon glyphicon-home"></span>
	                       		<span class="text">Coordonnées & Horaires</span>
							</a>
						</li>
						<?php
						}
						if($infosAsso->showFormulaire){
						?>
						<li>
							<a class="link" data-id="contact">
								<span class="glyphicon glyphicon-envelope"></span>
	                       		<span class="text">Contact</span>
							</a>
						</li>
						<?php
						}
						?>
						<?php
							if('' !== $infosAsso->_fb){
						?>
						<li><a href="<?php echo  $infosAsso->_fb; ?>" target="__blank"><span class="fa fa-facebook"></span></a></li>
						<?php
							}
							if('' !== $infosAsso->_twitter){
						?>
						<li><a href="<?php echo  $infosAsso->_twitter; ?>" target="__blank"><span class="fa fa-twitter"></span></a></li>
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
								<span><?php echo  get_the_post_thumbnail($infosAsso->ID, 'resizing-img'); ?></span>
								<div class="caption">
									<h3><?php echo  $infosAsso->_name; ?></h3>
								</div>
							</div>
								<?php
							if($infosAsso->showMembership){
								?>
								<div class="tarifAdhesion">Tarif d'adhésion : <?php echo  $infosAsso->_membership; ?></div>
								<?php
							}

							if($infosAsso->showBooklet) {
							?>
							<button type="button" name="button" class="btn btn-link-leaflet center-block"><a download href="<?php echo $infosAsso->ficheassociation_pres; ?>" >Télécharger la plaquette</a></button>
							<?php
							}
							?>
						</div>
						<div class="col-md-8 descrip text-justify">
							<p><?php echo  $infosAsso->post_content;?></p>
						</div>
					</div>
				</div>
				<!-- fin carte visite -->
			<?php

		}
	}

			if($infosAsso->showCaroussel){

		 query_posts(array('post_type'=>'slider',
		 					'meta_key'  => 'mdq_listing_assoc',
		 					'meta_value' => $infosAsso->ID));

		 $images = array();

		  if(have_posts()){

			  ?>
			  	<!-- carousel bootstrap -->
  		  		<div id="evenements" class="container block carousel">

			  		<div id="carousel" class="carousel slide" data-ride="carousel">
				  	<!-- Wrapper for slides -->
			  <?php

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
						$dateEnd = get_post_meta(get_the_ID(), 'event_asso_end', true);
						$dateHourStart = get_post_meta(get_the_ID(), 'event_asso_hour_start', true);
						$dateHourEnd = get_post_meta(get_the_ID(), 'event_asso_hour_end', true);
						$location_event = get_post_meta(get_the_ID(), 'event_asso_address', true);

						 $images[] = array('post_id' => $post_id,
		 													'title' => $title,
		 													'dateStart' => date_i18n("d/m/Y", strtotime($dateStart)),
		 													'dateEnd' => date_i18n("d/m/Y", strtotime($dateEnd)),
															'hstart' => date_i18n("H:m", strtotime($dateStart)),
															'hend' => date_i18n("H:i", strtotime($dateEnd)),
		 													'location' => $location_event,
		 													'content' => $content,
		 													'image' => $image,
		 													'img_src' => $image_src,
		 													'url' => esc_url($url),
		 													'url_openblank' => $url_openblank == "1" ? true : false,
		 													'link_text' => $link_text,
		 													'association' => $asso_orga
															 );
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
		 		   		<li data-target="#carousel" data-slide-to="<?php echo  $i; ?>" <?php echo  $active; ?>></li>
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
					 <div class="item <?php echo  $active; ?>  modal-click">
						<?php echo  $image['image']; ?>
						 <div class="carousel-caption">
							 <h3 class="img-modal img-responsive" title="<?php echo  $image['title']; ?>"></h3>
							 <p> Le <?php echo  $image['dateStart'];?> à <?php echo  $image['hstart'];?></p>
							 <p><?php echo  $image['association'];?></p>
							 <a class="btn-association img-modal img-moda-click" id="image-<?php echo  $images['post_id']; ?>" data-title="<?php echo  $image['title']; ?>" data-content="<?php echo  $image['content']; ?>" data-img="<?php echo  $image['img_src'] ?>" data-date="<?php echo  $image['dateStart']; ?>" data-hstart="<?php echo $image['hstart']; ?>" data-dateend="<?php echo  $image['dateEnd']; ?>" data-hend="<?php echo $image['hend']; ?>" data-location="<?php echo  $image['location']; ?>" data-url="<?php echo   get_site_url()."/association/?fiche=".$image['association']; ?>" role="button">voir l'actualité</a>

						 </div>
					 </div>

					<?php

					$active = "";
				}
				?>

			 <?php  	}  ?>
		 </div>

			 <!-- Left and right controls -->
			 <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
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
		 var date_end = $(this).data('dateend');
		 var date_hour = $(this).data('hstart');
		 var date_hour_end = $(this).data('hend');
		 var image = $(this).data('img');
		 var location = $(this).data('location');
		 var url = $(this).data('url');
		 var content = $(".modal-body");
		 var footer = $(".modal-footer");

		 var modal_title = $(".modal-title");

		//content.empty();
		modal_title.empty();

		modal_title.html(title);
		content.html("<img src='"+image+"' /> <p id='modal-date'>Date de l'événement : "+  date + " à "+date_hour+" au "+ date_end+" à "+date_hour_end+"</p><p id='modal-location'>Lieu : " + location + "</p> <p id='modal-description'>"  + description + "</p>");
		footer.html("<a href='"+url+"' class='btn btn-association-asso'> voir la fiche de l'association</a><button class='btn btn-association' data-dismiss='modal'>Fermer</button>");
		// show the modal
		$("#modal-gallery").modal("show");
	});

	});
	</script>

		  	<?php
			  }
			  else{
				  ?>
				  <script type="text/javascript">
						$(".actualite-link").hide();
				  </script>
				  <?php
				  //aucune activité ?
				  //On met un message ou pas ?
			  }
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
						<div id="acti-<?php echo  $post->ID; ?>" data-id="<?php echo  $post->ID; ?>" class="block-activite acti-<?php echo  $post->ID; ?> content-hidden overflow background-white">
							<div class="image">
								<?php echo  get_the_post_thumbnail($post->ID); ?>
							</div>
							<div class="title">
								<h3><?php echo  $post->post_title; ?></h3>
							</div>
							<div class="description mtop">
								<?php echo  $post->mdq_event_description; ?>
							</div>
							<div class="horaire mtop"></div>
								<h4>Horaires</h4>
								<?php echo  $post->mdq_event_date; ?>

							<div id="mapid-<?php echo  $post->ID; ?>" class="map mtop mbot">

							</div>
							<script>
							$(document).ready(function(){
								callMap('<?php echo  $post->mdq_event_adresse; ?>', '<?php echo  $post->ID; ?>');
							});
							</script>

							<div class="div-hover" data-id="<?php echo  $post->ID; ?>">
								<span class="gly-<?php echo  $post->ID; ?> glyphicon glyphicon-chevron-down down-chevron" aria-hidden="true"></span>
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
						$(document).on('click', 'html, .thumbnail-activite', function(){

							$(".block-activite").each(function( index ){
								let i = $(this).data('id');
								$("#acti-"+i).addClass("overflow");
								$("#acti-"+i).removeClass("active");
								$("#acti-"+i).addClass("content-hidden");
								$(".gly-"+i).addClass("glyphicon-chevron-down");
								$(".gly-"+i).removeClass("glyphicon-chevron-up");
								console.log('ololo');
							}).children('.map').click(function(e) {
							  return false;
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
										$("#acti-"+id).removeClass("content-hidden");
										$("#acti-"+id).addClass("active");
										$(".gly-"+id).removeClass("glyphicon-chevron-down");
										$(".gly-"+id).addClass("glyphicon-chevron-up");
										$(button).addClass("che-down");
									}
									else{
										console.log('dev');
										$("#acti-"+id).addClass("overflow");
										$("#acti-"+id).removeClass("active");
										$("#acti-"+id).addClass("content-hidden");
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
							<h2>Vos interlocuteurs</h2>
							<div class="row">
							<!-- <div class="col-md-12"> -->
								<?php

								query_posts(array(
									'post_type'=>'members',
									'meta_key'  => 'mdq_members_associations',
									'meta_value' => $infosAsso->ID));

									if ( have_posts() ){
										while ( have_posts() ){
											the_post();
											global $post;

											/* -- boussad update -- */
											$term_list = wp_get_post_terms( get_the_ID(), 'status_members_mdq' );
									?>
											<div class="col-md-3 membres">
												<div class="col-md-12 nomMembres triangle-obtuse">
														<h3><?php echo  get_the_title();?></h3>
														<!-- <p><?php echo  $post->mdq_; ?></p> -->
														<p><?php echo  $post->mdq_members_description; ?></p>
														<p>
														<?php
															$count = 0;
															/* -- boussad update -- */
															foreach($term_list as $term_single) {
																if($count > 0){
																	echo ", ";
																}
																echo $term_single->name;
																$count ++;
															}
														?>
														</p>
													</div>
												</div>
											<!-- </div> -->

											<?php
										}
									}
									?></div>
								</div>
							</div>
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
											<h2><?php echo  $infosAsso->_name; ?></h2>
											<h4><?php echo  $infosAsso->_address; ?></h4>
											<h4><?php echo  $infosAsso->_pc; ?> - <?php echo  $infosAsso->_city; ?></h4>
											<h4>Téléphone : <a href="tel:<?php echo  $infosAsso->_tel; ?>"><?php echo  $infosAsso->_tel; ?></a></h4>

											<h4>site web : <a href="<?php echo   $infosAsso->_link;  ?>"><?php echo  $infosAsso->_link; ?></a></h4>
											<h3>Ouverture - période scolaire :</h3>
											<p><?php echo  $infosAsso->_school;?></p>
	<?php if($infosAsso->showsmallHolidays){  ?>
											<h3>Ouverture - petites vacances :</h3>
											<p><?php echo  $infosAsso->_smallHolidays; }?></p>
	<?php if($infosAsso->showbigHolidays){  ?>
											<h3>Ouverture - grandes vacances : </h3>
											<p><?php echo  $infosAsso->_bigHolidays; }?></p>
										</div>

										<div class="map col-md-5">
											<div id="mapid-association">
											</div>
											<script>
											callMap('<?php echo  $infosAsso->_address; ?> <?php echo  $infosAsso->_city; ?> <?php echo  $infosAsso->_pc; ?>', "association");
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

				<!-- partenaires association -->
				<div class="container loc partner">
					<div class="row">
						<div class="col-md-12 text-center">
							<h2>Les partenaires</h2>
							<img src="<?php echo  $infosAsso->file1; ?>" alt="<?php echo  $infosAsso->file1; ?>" width="15%" />
							<img src="<?php echo  $infosAsso->file2; ?>" alt="<?php echo  $infosAsso->file2; ?>" width="15%" />
							<img src="<?php echo  $infosAsso->file3; ?>" alt="<?php echo  $infosAsso->file3; ?>" width="15%" />
							<img src="<?php echo  $infosAsso->file4; ?>" alt="<?php echo  $infosAsso->file4; ?>" width="15%" />
						</div>
					</div>
				</div>

				<?php
			}



			if($infosAsso->showFormulaire){

				//If the form is submitted
				 if(isset($_POST['submitted'])) {

						//Check to make sure that the name field is not empty
						if(trim($_POST['contactName']) === '') {
							$hasError = true;
						} else {
							$name = trim($_POST['contactName']);
						}


						//Check to make sure sure that a valid email address is submitted
						if(trim($_POST['email']) === '')  {
							$emailError = 'Indiquez une adresse e-mail valide.';
							$hasError = true;
						}
						else if (!filter_var(trim($_POST['email'], FILTER_VALIDATE_EMAIL))) {
							$hasError = true;
						}
						 else {
							$email = trim($_POST['email']);
						}

						//Check to make sure comments were entered
						if(trim($_POST['comments']) === '') {
							$hasError = true;
						} else {
							if(function_exists('stripslashes')) {
								$comments = stripslashes(trim($_POST['comments']));
							} else {
								$comments = trim($_POST['comments']);
							}
						}

						//If there is no error, send the email
						if(!isset($hasError)) {

							// récupération des infos de contact de l'association
							query_posts(array('post_type'=>'formulaire'));
							if ( have_posts() ){
									the_post();
									global $post;

							$emailTo = "houda.b@codeur.online";
							// $emailTo = $post->_emailcontact;
							$admin_email = get_option( 'admin_email' );
							$subject = 'Formulaire de contact de '.$name;
							$sendCopy = trim($_POST['sendCopy']);
							$body = 'Formulaire de contact depuis le site Planoisactive.fr';
							$body .= "\n\rNom: $name \n\nEmail: $email \n\nMessage : $comments";
							$headers = 'From: '.$emailTo . "\r\n" .
												'Reply-To: '.$email . "\r\n" .
												'Bcc: '.$admin_email . "\r\n" .
												'X-Mailer: PHP/' . phpversion();

							mail($emailTo, $subject, $body, $headers);

							if($sendCopy == true) {
								$subject = 'Formulaire de contact';

								$headers = 'From: '.$emailTo . "\r\n" .
	     										'Reply-To: '.$email . "\r\n" .
	     										'X-Mailer: PHP/' . phpversion();

								mail($email, $subject, $body, $headers);
							}

							$emailSent = true;

						}  } } // FIN IF POST SUBMITTED
						?>

						<!-- formulaire -->
						<div class="container contact" id="contact">

						<?php
							if(isset($emailSent) && wp_verify_nonce($_POST['__nonce'], 'form_asso')) { ?>


							<div id="form">
								<h1>Merci, <?php echo $name;?></h1>
								<p>Votre e-mail a &eacute;t&eacute; envoy&eacute; avec succ&egrave;s. Vous recevrez une r&eacute;ponse dans les meilleurs délais.</p>
							</div>


						<?php } else { ?>



				 		<?php if(isset($hasError)) { ?>
				 			<p class="error">Une erreur est survenue lors de l'envoi du formulaire.</p>
				 		<?php } ?>

						<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="contact_form"  class="well form-horizontal" onsubmit=" return verification();">

							<input type="hidden" id="form_asso" name="__nonce" value="<?php echo wp_create_nonce('form_asso'); ?>" />

							<h2>Formulaire de contact</h2>
							<fieldset>
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input class="form-control" required type="text" name="contactName" id="nom" placeholder="votre nom et prénom*" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>"/>
								</div>

								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input class="form-control" required type="email" name="email" id="email" placeholder="votre email *" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>"/>
								</div>
							</fieldset>

							<fieldset>
								<textarea  name="comments" required class="form-control message center-block" rows="12" placeholder="Ecrivez votre message ici..."><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							</fieldset>
							<div class="form-group">
								<label class="col-md-4 control-label"></label>
								<div class="col-md-4">
									<button type="submit" class="btn center-block">Envoyer <span class="glyphicon glyphicon-send"><input type="hidden" name="submitted" id="submitted" value="true" /></span></button>
								</div>
							</div>
						</form>
					</div>

				 <?php  }
		}
		?>
	</div>

	<script type="text/javascript">
	    function scrollToAnchor(aid){
	        var aTag = $("div[id='"+ aid +"']");
	        $('html,body').animate({scrollTop: aTag.offset().top - 200},'slow');
	    }

	    $(".link").click(function() {
	       $(".link").removeClass("active");
	       $(this).addClass("active");
	       scrollToAnchor($(this).data('id'));
	    });
	</script>
</main>

						<?php
					 } get_footer(); ?>

<main class="container" id="home">

<?php

function callEvent($limit, $offset){

	$queryAgenda = new WP_Query( array( 'post_type'=>'slider',
												'posts_per_page' => $limit,
												'orderby' => 'event_asso_start',
												'order' => 'DESC',
												'offset' => $offset
											));

	if($queryAgenda->have_posts()){

		while ($queryAgenda->have_posts() ) {

				$queryAgenda->the_post();

				if ( '' != get_the_post_thumbnail(get_the_ID(), 'size-carousel-display-home') ) {

					$post_id = get_the_ID();
					$title = get_the_title();
					$content = get_post_meta(get_the_ID(), 'event_asso_description', true);
					$image = get_the_post_thumbnail(get_the_ID(), 'size-carousel-display-home');
					$image_src = wp_get_attachment_image_src(get_post_thumbnail_id());
					$image_src = $image_src[0];
					$url = get_post_meta(get_the_ID(), 'slider_image_url', true);
					$url_openblank = get_post_meta(get_the_ID(), 'slider_image_url_openblank', true);
					$link_text = get_post_meta(get_the_ID(), 'slider_image_link_text', true);
					$asso_orga = get_post_meta(get_the_ID(), 'mdq_listing_assoc', true);
					$dateStart = get_post_meta(get_the_ID(), 'event_asso_start', true);
					$dateEnd = get_post_meta(get_the_ID(), 'event_asso_end', true);
					$dateHourStart = get_post_meta(get_the_ID(), 'event_asso_hour_start', true);
					$dateHourEnd = get_post_meta(get_the_ID(), 'event_asso_hour_end', true);

					$location_event = get_post_meta(get_the_ID(), 'event_asso_address', true);

                    global $wpdb;

                	$query = "SELECT event.*, $wpdb->postmeta.*
                        FROM $wpdb->posts as event, $wpdb->postmeta
                        WHERE event.post_type IN ('fiche', 'slider')
                        AND event.ID = $asso_orga
                        LIMIT 0,1
                        ";

					$t = $wpdb->get_results($query, OBJECT);

					$asso = array();

					foreach ($t as $key => $v ) {

						$asso[] = $v->post_title;
					}

					$images[] = array(
						'post_id' => $post_id,
						'title' => htmlspecialchars($title),
						'dateStart' => date_i18n("c", strtotime($dateStart)),
						'dateEnd' => date_i18n("c", strtotime($dateEnd)),
						'start' => date_i18n("d/m/Y", strtotime($dateStart)),
						'end' => date_i18n("d/m/Y", strtotime($dateEnd)),
						'hstart' => date_i18n("H:m", strtotime($dateStart)),
						'hend' => date_i18n("H:i", strtotime($dateEnd)),
						'location' => $location_event,
						'content' => $content,
						'image' => $image,
						'img_src' => $image_src,
						'url' => esc_url($url),
						'url_openblank' => $url_openblank == "1" ? true : false,
						'link_text' => $link_text,
						'association' => $asso_orga,
						'association_name' => $asso[0]
					);

			}
		}
	}
	return $images;
}

$images = callEvent(5, 0);

?>
	<!-- carousel bootstrap -->
	<div class="col-md-12" id="carousel">
		<div id="carousel-home" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				 <ol class="carousel-indicators">
					 <?php
					 	 $active = 'class="active"';
					 		 foreach ($images as $key => $image)
					 		 {
					 		 static $i = 0;
					 	?>
					 			<li data-target="#carousel-home" data-slide-to="<?php echo  $i; ?>" <?php echo  $active; ?>></li>
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
				 <div class="item <?php echo $active; ?>  modal-click">
					<?php echo  $image['image']; ?>
          			<div class="carousel-caption">
						 <h3 class="img-modal img-responsive" title="<?php echo $image['title']; ?>"><?php echo $image['title'];?></h3>
						 <p> Le <?php echo $image['start']; ?> </p>
						 <p><?php echo $image['association_name'];?></p>
						 <a class="btn-association img-modal img-moda-click" id="image-<?php echo $image['post_id']; ?>" data-title="<?php echo $image['title']; ?>" data-content="<?php echo $image['content']; ?>" data-img="<?php echo $image['img_src'] ?>" data-datestart="<?php echo $image['start']; ?>" data-hstart="<?php echo $image['hstart']; ?>" data-dateend="<?php echo $image['end']; ?>" data-hend="<?php echo $image['hend']; ?>" data-location="<?php echo $image['location']; ?>" data-url="<?php if($image['association'] === '554' || $image['association_name'] === 'Maison de quartier Planoise') {  echo get_site_url()."/apropos"; } else { echo get_site_url()."/annuaire/association?fiche=".$image['association'];  } ?>" role="button">Voir l'événement</a>
					 </div>
				 </div>
				 <?php
				 $active = "";
				 }

				 ?>
				 <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: #ff6633;"></span>
					<span class="sr-only">Précédent</span>
				</a>
				<a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: #ff6633;"></span>
					<span class="sr-only">Suivant</span>
				</a>
			 </div>
		</div>
	</div>

	<!-- start the modal -->
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

		$(".img-moda-click").click(function(){
			var title = $(this).data('title');
			var description = $(this).data('content');
			var date_start = $(this).data('datestart');
			var date_end = $(this).data('dateend');
			var hstart =  $(this).data('hstart');
			var hend =  $(this).data('hend');
			var image = $(this).data('img');
			var location = $(this).data('location');
			var url = $(this).data('url');
			var content = $(".modal-body");
			var footer = $(".modal-footer");
			var modal_title = $(".modal-title");
			// console.log(url);

			modal_title.empty();
			modal_title.html(title);
			content.html("<img src='"+image+"' /> <p id='modal-date'>Date de l'événement : " +  date_start + " à " + hstart + " au " + date_end + " à " + hend + "</p><p id='modal-location'>Lieu : " + location + "</p> <p id='modal-description'>"  + description + "</p>");
			footer.html("<a href='"+url+"' class='btn btn-association-asso'> Fiche de l'association</a><button class='btn btn-association' data-dismiss='modal'>Fermer</button>");

			$("#modal-gallery").modal("show");
		});

	});
	</script>

	<?php

	$eventagenda = callEvent(1000, 0);

	$event= array();
	$event_next= array();


	foreach ($eventagenda as $e)
	{
		$start= array();
		$end =  array();

		$start[] = substr($e['dateStart'], 0, -6);
		$end[] = substr($e['dateEnd'], 0, -6);

		$event[] = array(
			'id' => $e['association'],
			'title' => $e['title'],
			'start' => $start[0],
			'end' => $end[0],
			'imageurl' => $e['img_src'],
			'location' => $e['location']
		);


		$dhstart['dhstart'] = $e['start'] . " à " . $e['hstart'];
		$dhend['dhend'] = $e['end'] . " à " . $e['hend'];

		$event_next[] = array(
			'id' => $e['association'],
			'description' => $e['content'],
			'dstart' => $dhstart['dhstart'],
			'dend' => $dhend['dhend']
		);
	}


	$data = json_encode($event);
	$dnext = json_encode($event_next);

	echo "<script>";
	echo "var d = eval($dnext);";
	// echo "console.log(d);";
	echo "</script>";

?>
	<script>

		$(document).ready(function() {

			var currentTime = new Date();
			var allevent = '<?php echo $data; ?>';
			data = JSON.parse(allevent);

			$('#agenda').fullCalendar({
				locale: 'fr',
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,listMonth'
				},
				defaultDate: currentTime,
				navLinks: true,
				editable: true,
				eventLimit: true,
				allDay: false,
				events: data,
				eventColor: '#ff6633',
				eventTextColor: '#fff',
				height: 315,
				contentHeight: 315,
				aspectRatio: 1,
				fixedWeekCount: false,
				timeFormat: 'H:mm',
				refetchResourcesOnNavigate: true,
				eventClick: function(calEvent) {
					for(json in d){
						if (calEvent.id === d[json].id){
							calEvent.id = d[json].id;
							calEvent.description = d[json].description;
							calEvent.start = d[json].dstart;
							calEvent.end = d[json].dend;
						}
					}

					var content = $(".modal-body");
					var footer = $(".modal-footer");
					var modal_title = $(".modal-title");

					modal_title.html(calEvent.title);
					content.html("<img src='" + calEvent.imageurl + "'><p id='agenda-date'>Date de l'événement : du " +  calEvent.start + " au " + calEvent.end + "</p><p id='agenda-location'>Lieu : " + calEvent.location + "</p> <p id='modal-description'>"  + calEvent.description + "</p>");

					if(calEvent.id === '554'){

						footer.html("<a href='"+window.location.href+"/apropos' class='btn btn-association-asso'>Fiche de l'association</a><button class='btn btn-association' data-dismiss='modal'>Fermer</button>");


					} else {
						footer.html("<a href='"+window.location.href+"/annuaire/association?fiche=" + calEvent.id +"' class='btn btn-association-asso'>Fiche de l'association</a><button class='btn btn-association' data-dismiss='modal'>Fermer</button>");

					}

					$("#modal-agenda").modal("show");

					$('#agenda').fullCalendar('updateEvent', calEvent);

					}
			});

			$("#agenda").fullCalendar('removeEvents');
    		$("#agenda").fullCalendar('addEventSource', data);

		});

	</script>

	<section id="agenda" class='col-md-5'></section>
	<div class="modal container" id="modal-agenda" role="dialog">
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
<?php
/* --
--
-- affichage des articles
--
-- */

/* affichage de l'article mis-en-avant */
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$sticky = get_option('sticky_posts');
	$posts_per_page = 1;
	$num_sticky_pages = (count($sticky) / $posts_per_page);
	query_posts(array(
		'showposts' => 1,
		'post_type'=>'post',
		'orderby' => 'post_modified',
		'post__in' => $sticky,
		'paged'=> $paged,
		'order' => 'DESC'));
	if ( have_posts() ){
		while ( have_posts() ){
			the_post();
			if(is_sticky()){
				?>
				<section id="articleUne" class="col-md-7" <?php post_class(); ?>>
					<article class=" contenu blockArticle">
						<div class="globalArticle col-md-12">
              				<div class="text-center img-article-une col-md-7">
                			<?php echo  get_the_post_thumbnail($post->ID); ?>
			  				</div>

							<header class="entry-header col-md-5">
								<h1 class="entry-title col-md-12"><?php the_title(); ?></h1>
								<div class="entry-meta col-md-12">
									<?php bootstrapBasicPostOn(); ?>
                  					<div class="text-center col-md-12">
                  					</div>
								</div>
							</header>
							<div class="entry-content  col-md-12">
                			<?php
                 			if(isset($_GET['article']) && intval($_GET['article']) == $post->ID) {
                    			echo $post->post_content;

                 			} else {
                   				the_content(bootstrapBasicMoreLinkText($post));
                 			} 		 ?>
							</div>
									<?php
								}
							}
						}
					?>
						</div>
					</article>
				</section>
				<!-- affichage des articles sauf l'article à la une  -->
				<section id="articlesAutres"  class="col-md-12" <?php post_class(); ?>>
				<?php
					$args = array(
							'post_type'=>'post',
							'paged' => $paged,
							'post__not_in'  => $sticky,
							'ignore_sticky_posts' => 1
							);

					$query = new WP_Query( $args );

					if($query != $sticky) {

						while($query->have_posts()) {

							$query->the_post();

							global $post;
						?>
						<article class="col-md-4 contenu blockArticle">
							<div class="globalArticle col-md-12" id="article-<?php echo $post->ID;?>">
								<div class="text-center img-article">
									<?php echo get_the_post_thumbnail($post->ID, 'resizing-img-article'); ?>
								</div>
								<header class="entry-header">
									<h1 class="entry-title"><?php the_title(); ?></h1>
									<?php if ('post' == get_post_type()) {  ?>
									<div class="entry-meta">
										<?php bootstrapBasicPostOn(); ?>
									</div>
									<?php }  ?>
								</header>
								<?php if (is_search()) {  ?>
								<div class="entry-summary">
									<?php the_excerpt(); ?>
									<div class="clearfix"></div>
								</div>
								<?php } else { ?>
								<div class="entry-content">
									<?php
										if(isset($_GET['article']) && intval($_GET['article']) == $post->ID) {
											echo $post->post_content;

										} else {
											the_content(bootstrapBasicMoreLinkText($post));
										} 		 ?>
								</div>
								<?php } ?>
						</div>
					</article>
					<?php  }  }  ?>
	</section>
	<script>
	$('#articlesAutres').masonry({

		itemSelector: '.blockArticle'
	});
	</script>

</main>

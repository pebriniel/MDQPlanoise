<main class="container" id="home">

<?php
function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}

function callEvent($limit = 10, $offset = 3){
	$queryAgenda = new WP_Query( array( 'post_type'=>'slider', // ICI
												'posts_per_page' => $limit, // ICI
												'orderby' => 'event_asso_start',
												'order' => 'DESC',
												'offset' => $offset
											)); // ICI

	$images = array();
	if($queryAgenda->have_posts()){ // ICI
		while ($queryAgenda->have_posts() ) { // ICI
				$queryAgenda->the_post();// ICI

				// global $post;
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
					// $asso_orga = $infosAsso->_name;
					$asso_orga = get_post_meta(get_the_ID(), 'mdq_listing_assoc', true);
					$dateStart = get_post_meta(get_the_ID(), 'event_asso_start', true);
					$dateEnd = get_post_meta(get_the_ID(), 'event_asso_end', true);
					$location_event = get_post_meta(get_the_ID(), 'event_asso_address', true);
					$images[] = array('post_id' => $post_id,
														'title' => $title,
														'dateStart' => $dateStart,
														'dateEnd' => date_i18n($format_date, strtotime($dateEnd)),
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
	}
	return $images;
}


$images = callEvent(3, 0);
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
					 			<li data-target="#carousel-home" data-slide-to="<?= $i; ?>" <?= $active; ?>></li>
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

						 <!-- <a href="<?=  get_site_url()."/association/?fiche=".$image['url_openblank']; ?>"  class="btn-association" role="button">voir l'événement</a> -->
						 <p> Du <?= $image['dateStart']; ?> au <?= $image['dateEnd']; ?> </p>
						 <p><?= $image['association'];?></p>
						 <a class="btn-association img-modal img-moda-click" id="image-<?= $images['post_id']; ?>" data-title="<?= $image['title']; ?>" data-content="<?= $image['content']; ?>" data-img="<?= $image['img_src'] ?>" data-date="<?= $image['dateStart']; ?>" data-location="<?= $image['location']; ?>" data-url="<?=  get_site_url()."/association/?fiche=".$image['association']; ?>" role="button">voir l'événement</a>
						 <!-- <p><?= $image['location'];?></p> -->

						 <!-- <a data-url="<?= get_site_url()."/association/?fiche=".$images['post_id']; ?>" class="btn btn-association" role="button">voir la fiche</a> -->

					 </div>
				 </div>
				 <?php
				 $active = "";
				 }
				 ?>
				 <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: #ff6633;"></span>
					<span class="sr-only">Précèdent</span>
				</a>
				<a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: #ff6633;"></span>
					<span class="sr-only">Suivant</span>
				</a>
			 </div>
		</div>
	</div>

	<!-- agenda -->

	<?php
		$empty = array();
    $tableau = array();
		$tab = callEvent(20, 3);
		$tab = array_msort($tab, array('dateStart' => SORT_ASC));
		?>

		<section class="cd-horizontal-timeline col-md-12">
			<div class="timeline">
				<div class="events-wrapper">
					<div class="events">
						<ol>
						<?php
						 	$select = 'class="selected"';
								foreach($tab AS $key => $val)
							{
								$date = date_i18n("d/m/Y", strtotime($val['dateStart']));
								$date_show = date_i18n("d/m", strtotime($val['dateStart']));

								if(!in_array($date, $empty)){
								?>
									<li><a href="#0" data-date="<?= $date; ?>" <?= $select; ?>><?= $date_show; ?></a></li>
								<?php

									$empty[] = $date;
									$select = "";
								}
							}
						?>
						</ol>

						<span class="filling-line" aria-hidden="true"></span>
					</div> <!-- .events -->
				</div> <!-- .events-wrapper -->

				<ul class="cd-timeline-navigation">
					<li><a href="#0" class="prev inactive">Prev</a></li>
					<li><a href="#0" class="next">Next</a></li>
				</ul> <!-- .cd-timeline-navigation -->
			</div> <!-- .timeline -->

			<div class="events-content">
				<ol>
					<?php
					$selected = 'class="selected"';
					foreach($empty as $k_date => $v_date){
					?>
					<li data-date="<?= $v_date; ?>" <?= $selected; ?>>
					<?php
						foreach($tab AS $key => $val)
						{
							$date = date_i18n("d/m/Y", strtotime($val['dateStart']));
							$date_show = date_i18n("d/m", strtotime($val['dateStart']));
						?>
								<h3><?= $val['title'];?></h3>
								<p id="content"><?= $val['content'];?></p>
								<p id="location"><?= $val['location'];?></p>
								<pre> Du <?= $val['dateStart']; ?>  au <?= $val['dateEnd']; ?> </pre>
						<?php

						}
						$selected = "";
						?>
					</li>
						<?php
					}
					?>
				</ol>
			</div> <!-- .events-content -->
		</section>


</main>

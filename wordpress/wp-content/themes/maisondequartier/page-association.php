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

<?php get_sidebar('left'); ?>
			<!-- saloperie qui faisait chié pour le footer -->
				<!-- <div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column"> -->
					<main id="onepageasso" class="site-main" role="main">
						<?php
						if(get_query_var('fiche')){

							if($infosAsso = get_post($fiche)){
								if($infosAsso->post_type == 'fiche'){

?>
<!-- carte visite -->
<div class="container">
	<div class="row carteVisite">
			<div class="col-md-3 logo">
				<div class="thumbnail">
					<?php echo '<img src="'.$infosAsso->_logo.'" alt="'.$infosAsso->_logo.'">';?>


					<div class="caption">
						<h3><?php echo  $infosAsso->_name;?></h3>
					</div>
				</div>
			 </div>
			 <div class="col-md-9 description">
				 <p><?php echo $infosAsso->_desc;?></p>
				 <button type="button" name="button" class="btn btn-default center-block">Nous contacter</button>
			 </div>
	 </div>
 </div>
 <!-- fin carte visite -->

<?php
							}
						}
					}

					query_posts(array('post_type' => 'fiche'));

					bootstrapBasicPagination();
 ?>

 <!-- carousel bootstrap -->
 <div class="container carousel">
 <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
	 <!-- Indicators -->
	 <ol class="carousel-indicators">
		 <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		 <li data-target="#myCarousel" data-slide-to="1"></li>
		 <li data-target="#myCarousel" data-slide-to="2"></li>
		 <li data-target="#myCarousel" data-slide-to="3"></li>
	 </ol>

	 <!-- Wrapper for slides -->
	 <div class="carousel-inner" role="listbox">
		 <div class="item active">
			 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/photo.jpg" alt="évènement1">
				 <div class="carousel-caption">
					 <h3>Nom évènement 1</h3>
					 <p>Date</p>
				 </div>
		 </div>

		 <div class="item">
			 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/photo.jpg" alt="évènement2">
			 <div class="carousel-caption">
				 <h3>Nom évènement 2</h3>
				 <p>Date</p>
			 </div>
		 </div>
		 <div class="item">
			 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/photo.jpg" alt="évènement3">
			 <div class="carousel-caption">
				 <h3>Nom évènement 3</h3>
				 <p>Date</p>
			 </div>
		 </div>

		 <div class="item">
			 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/photo.jpg" alt="évènement4">
			 <div class="carousel-caption">
				 <h3>Nom évènement 4</h3>
				 <p>Date</p>
			 </div>
		 </div>
	 </div>

	 <!-- Left and right controls -->
	 <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		 <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		 <span class="sr-only">Previous</span>
	 </a>
	 <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		 <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		 <span class="sr-only">Next</span>
	 </a>
 </div>
</div>
 <!-- fin de carousel -->

 <?php

 query_posts(array( 'post_type'=>'activite'));
 if ( have_posts() ){
		 while ( have_posts() ){
				 the_post();
				 global $post;
	 ?>
 <!-- screenshot -->
 <div class="container">
	 <div class="row screenshot">
		 <div class="col-md-4">
			 <div class="thumbnail">
				 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/photo.jpg" alt="screenshot activité">
				 <div class="caption">
					 <h3><?= $post->post_title;?></h3>
					 <p><?= $post->mdq_event_description;?> </p>
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
		 <div class="col-md-3 membres">
			 <div class="thumbnail">
				 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/user.jpg" alt="...">
				 <div class="caption">
					 <h3>John Doe</h3>
					 <p>Directeur</p>
				 </div>
			 </div>
		 </div>
		 <div class="col-md-3 membres">
			 <div class="thumbnail">
				 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/user.jpg" alt="...">
				 <div class="caption">
					 <h3>John Doe</h3>
					 <p>Bénévole</p>
				 </div>
			 </div>
		 </div>
		 <div class="col-md-3 membres">
			 <div class="thumbnail">
				 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/user.jpg" alt="...">
				 <div class="caption">
					 <h3>John Doe</h3>
					 <p>Accompagnateur</p>
				 </div>
			 </div>
		 </div>
		 <div class="col-md-3 membres">
			 <div class="thumbnail">
				 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/user.jpg" alt="...">
				 <div class="caption">
					 <h3>John Doe</h3>
					 <p>Directeur</p>
				 </div>
			 </div>
		 </div>
	 </div>
	 <svg class="more" enable-background="new 0 0 48 48" height="60px" id="Layer_1" version="1.1" viewBox="0 0 48 48" width="60px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		 <path d="M24,0C10.745,0,0,10.745,0,24c0,13.254,10.745,24,24,24s24-10.746,24-24C48,10.745,37.255,0,24,0z   M34.031,24.766c0,1.109-0.9,1.305-1.354,1.332h-6.581l-0.008,6.607c-0.002,1.221-0.933,1.322-1.18,1.326L23.1,34.029  c-0.27-0.006-1.211-0.109-1.209-1.33l0.008-6.602h-6.602c-1.221,0-1.322-0.93-1.328-1.178v-1.809  c0.005-0.27,0.108-1.211,1.328-1.211h6.607l0.008-6.463c0.006-0.306,0.107-1.472,1.288-1.47l1.578,0.002  c1.11,0.001,1.305,0.902,1.331,1.356L26.102,21.9h6.458c0.306,0.006,1.472,0.105,1.472,1.287V24.766z" fill="#eb661b"/>
	 </svg>
 </div>
 <!-- fin membres asso -->

 <!-- adresse asso -->
<div class="container loc">
 <div class="row">
	 <div class="adresseAsso col-md-7">
		 <h2><?php echo  $infosAsso->_name; ?></h2>
		 <p><?php echo  $infosAsso->_address; ?></p>
		 <p><?php echo  $infosAsso->_pc; ?></p>
		 <p><?php echo  $infosAsso->_city; ?></p>
		 <p><?php echo  $infosAsso->_tel; ?></p>
		 <p><?php echo '<a href="'.$infosAsso->_link.'">'.$infosAsso->_link.'</a>'; ?></p>
		 <p>Ouverture: <?php echo  $infosAsso->_school;?></p>
		 <p>- <?php echo $infosAsso->_smallHolidays;?></p>

		 <h4>Jours d'ouverture : </h4>
		 <p>Du : <?php echo $infosAsso->_dayopen; ?> </p>
		 <p>jusqu'au : <?php echo $infosAsso->_dayclose; ?></p>

	 </div>
	 <div class="map col-md-5">
		 <img src="wp-content/themes/maisonquartier/img/img_onepageasso/map.png" alt="map lieux asso">
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
				 <select class="selectpicker form-control">
					 <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
						 <option selected disabled>Objet</option>
						 <option>Option1</option>
						 <option>Option2</option>
						 <option>Option3</option>
				 </select>
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

<?php get_footer(); ?>

<?php

function traitement_formulaire_don_cagnotte() {

	if (isset($_POST['cagnote-don-envoi']) && isset($_POST['cagnotte-verif'])) {

		if (wp_verify_nonce($_POST['cagnotte-verif'], 'faire-don')) {

			$don = intval($_POST['don']);

			if ($don < 0) {

				$url = add_query_arg('erreur', 'radin', wp_get_referer());

				wp_safe_redirect($url);
				exit();

			}

			else if ($don > 10000) {

				$url = add_query_arg('erreur', 'trop', wp_get_referer());

				wp_safe_redirect($url);
				exit();

			}

			else {

				$cagnotte_actuelle = intval(get_option('valeur_cagnotte', 0));
				$nouvelle_cagnotte = $cagnotte_actuelle + $don;

				update_option('valeur_cagnotte', $nouvelle_cagnotte);

			}

		}

	}
}
add_action('template_redirect', 'traitement_formulaire_don_cagnotte');
?>

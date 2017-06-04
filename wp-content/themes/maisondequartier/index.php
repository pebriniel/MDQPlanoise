<?php
/**
 * The main template file
 *
 * @package bootstrap-basic
 */

get_header();

get_sidebar('left');


get_template_part('content', get_post_format());



get_footer(); ?>

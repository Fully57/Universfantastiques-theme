<?php
/**
 * Template enfant single.php – se repose uniquement sur content-single.php modifié.
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'single' );
	endwhile;
endif;

get_footer();
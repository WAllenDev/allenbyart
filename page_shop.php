<?php
	/* Template Name: Shop Page Template */

	get_header();
?>

<?php
		// Start the loop

		if (have_posts()) :
			while (have_posts()) :
				the_post();
					the_content();
			endwhile;
		endif;

?>

<?php get_footer(); ?>
<?php
	/* Template Name: About Page Template */
	get_header();
?>
<main class="single-column about-text">
	<?php
		// Start the loop

		if (have_posts()) :
			while (have_posts()) :
				the_post();
					the_content();
			endwhile;
		endif;

	?>
</main>
<?php get_footer(); ?>
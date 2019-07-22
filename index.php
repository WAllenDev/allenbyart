<?php
/* Main Template File */

get_header();
?>

<main class="single-column intro-text">
	<h1><?php echo get_the_title(); ?></h1>

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
<?php
	/* Template Name:  Gallery page */

	get_header();
?>
<div class="content">
	<main>
		<!--for sure-->
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
</div>
<?php get_footer(); ?>
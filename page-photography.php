<?php
	/* Template Name:   Photography Gallery page */

	get_header();
?>
<div class="content">
	<main>
		<?php
			// Start the loop

			if (have_posts()) :
				while (have_posts()) :
					the_post();
						the_content();
				endwhile;
			endif;

			//custom loop to fetch thumbnails of images
			echo woocommerce_products_by_category( "photography" );

		?>
	</main>
</div>
<?php get_footer(); ?>
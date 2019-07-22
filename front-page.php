<?php

/* Front Page Template */

get_header();
?>
<div class="content">
		<?php echo woocommerce_featured_images(); ?>
	<div class="single-column intro-text">
		<h1><?php echo get_the_title() ?></h1>
		<main class="main-content">
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
</div>
<?php get_footer(); ?>
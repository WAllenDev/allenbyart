<?php

if( !function_exists('allenbyart_setup')):
	function allenbyart_setup() {
		// Let wordpress handle the title tags
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_image_size('hero-slider600h', 9999, 600);

	}
endif;
add_action('after_setup_theme','allenbyart_setup');

/* === Register Menus ===*/

function register_allenbyart_menus(){
	register_nav_menus(
		array(
			'primary' => __('Primary Navigation Menu'),
			'footer' => __('Footer Navigation Menu')
		)
	);
}
add_action('init','register_allenbyart_menus');

/* === Add Stylesheets and scripts=== */

function allenbyart_scripts() {

	// enqueue Bootstrap style sheet
	wp_enqueue_style('bootstrap','https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	// Enqueue google fonts: KoHo and Nunito
	wp_enqueue_style('allenbyart_googlefonts','https://fonts.googleapis.com/css?family=KoHo|Nunito' );
	// Enqueue jQuery
	wp_enqueue_script('allenbyart_jquery','https://code.jquery.com/jquery-3.4.1.min.js');
	// Enqueue javascript
	wp_enqueue_script('allenbyart_js',get_stylesheet_directory_uri().'/scripts/functions.js', array('allenbyart_jquery'), false, true);
	// Enqueue popper for Bootstrap
	wp_enqueue_script('allenbyart_popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' );
	// Enqueue Bootstrap
	wp_enqueue_script( 'allenbyart_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' );
	// Enqueue Font Awesome
	wp_enqueue_script( 'willallendevanddesign_fontawesome', 'https://kit.fontawesome.com/2552205db7.js' );
	// Enqueue main style sheet
	wp_enqueue_style('allenbyart_styles',get_stylesheet_uri());
}
add_action('wp_enqueue_scripts','allenbyart_scripts', 20);

add_image_size('large-media', 9999, 600, false);
add_image_size('mid-media', 9999, 400, false);
add_image_size('small-media', 9999, 200, false);
add_image_size('small-thumbnail', 240, 160, true);
add_image_size('large-thumbnail', 484, 324, true);

function my_custom_sizes( $sizes ) {
	return array_merge( $sizes, array (
		'large-media' => __( 'Large Media' ),
		'mid-media' => __( 'Mid-size Media' ),
		'small-media' => __( 'Handheld Media' ),
	));
}
add_filter('image_size_names_choose','my_custom_sizes' );

add_shortcode('woo_cart_button','woo_cart_button');
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_button() {
	ob_start();

	$cart_count = WC()->cart->cart_contents_count; //Set variable for cart item count
	$cart_url = wc_get_cart_url(); //Set Cart URL
	?>
	<li><a class="menu-item cart-contents" href="<? echo $cart_url; ?>" title="My Basket">
	<?php
	if ( $cart_count > 0 ) {
	?>
		<span class="cart-contents-count"><?php echo $cart_count; ?></span>
	<?php
	}
	?>
	</a></li>
	<?php
	return ob_get_clean();
}

add_filter('woocommerce_add_to_cart_fragments', 'woo_cart_button_count');
/**
 * Add AJAX shortcode when cart contents update
 */
function woo_cart_button_count($fragments) {
	ob_start();

	$cart_count = WC()->cart->cart_contents_count;
	$cart_url = wc_get_cart_url();

	?>
	<a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e('View Your shopping cart'); ?>">
	<?php
	if( $cart_count > 0 ) {
		?>
		<span class="cart-contents-count"><?php echo $cart_count; ?></span>
		<?php
	}
		?></a>
	<?php
	$fragments['a.cart-contents'] = ob_get_clean();

	return $fragments;
}

/*
*	Add custom classes and attributes to links
 */

function primary_menu_anchor_attributes( $atts, $item, $args ) {
	if( $args -> theme_location == 'primary' ) {
		$atts['class'] = 'nav-link';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'primary_menu_anchor_attributes', 10, 3 );

/**
 * Show cart contents / total Ajax
 */

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-customlocation" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><span class="fas fa-shopping-cart">121233</span><?php echo sprintf( $woocommerce->cart->cart_contents_count );?> 1234</a>
	<?php
	$fragments['a.cart-customlocation'] = ob_get_clean();
	return $fragments;
}

function woocommerce_products_by_category( $cat ) {

	ob_start();

	//Define Query Arguments
	$args = array(
		'category' => array( $cat ),
		'limit' => 50,
	);

	//create new Product Query
	$productLoop = new WC_Product_Query( $args );

	$product = $productLoop->get_products();

	//Get products number
	$product_count = count($product);

	// If results
	if( $product_count > 0 ) :

		echo '<ul class="gallery">';

			//Start the loop
			for($i = 0; $i < $product_count; $i++) {

				$image = get_the_post_thumbnail_url( $product[$i]->get_id(), 'small-media' );

				echo "<li>";
					echo '<div class="gallery-thumbnail-container">';
						echo '<a href="' . get_permalink( $product[$i]->get_id() ) . '" >';
							echo '<img class="gallery-thumbnail" src="' . $image . '" alt="' . $product[$i]->get_name() . '" title="' . $product[$i]->get_name() . '">';
						echo '</a>';
					echo '</div>';
				echo "</li>";
			}

		echo '</ul>';

	else :

		_e('No product matching your criteria.');

	endif;

	return ob_get_clean();
					
}

function woocommerce_featured_images() {
	ob_start();

	//Define Query Arguments
	$args = array(
		'category' => array( "featured" ),
		'limit' => 5,
	);

	//create new Product Query
	$productLoop = new WC_Product_Query( $args );

	$product = $productLoop->get_products();

	//Get products number
	$product_count = count($product);

	// If results
	if( $product_count > 0 ) :

		echo '<ul class="slideshow-container">';

			//Start the loop
			for($i = 0; $i < $product_count; $i++) {

				$image = get_the_post_thumbnail_url( $product[$i]->get_id(), 'large-media' );

				echo '<li class="slide-image-item fade">';
				echo '<div class="slide-table-wrapper">';
					echo '<a class="slide-link-wrapper" href="' . get_permalink( $product[$i]->get_id() ) . '" >';
						echo '<img class="slideshow-thumbnail" src="' . $image . '" alt="' . $product[$i]->get_name() . '">';
					echo '</a>';
				echo '</div>';
				echo "</li>";
			}

		echo '</ul>';

	else :

		_e('No product matching your criteria.');

	endif;

	return ob_get_clean();
}
<?php
/* Main Header Template */
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>

</head>

<body>
	<header>
		<div class="header-contact-info">
			<a class="contact-container" href="mailto:allenbyarts@gmail.com"><span class="fas fa-envelope"></span>&nbsp Allenbyarts@gmail.com</a>
			<a class="contact-container" href="tel:6198001997"><span class="fas fa-phone"></span>&nbsp 619.800.1887</a>
		</div>
		<nav class="navbar navbar-expand-lg">
			<a href="<?php echo home_url(); ?>">
				<img id="header-logo" src="<?php bloginfo('template_url') ?>/images\Nathaniel Allenby AA Logo-03-80.png" alt="Nathaniel Allenby Logo">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon fas fa-bars"></span>
			</button>
			<?php
			wp_nav_menu($arg = array(
				'container_class' => 'collapse navbar-collapse',
				'container_id' => 'navbarNav',
				'menu_class' => 'navbar-nav',
				'theme_location' => 'primary'
			));
			?>
		</nav>
	</header>
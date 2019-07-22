<?php
	/* Main Footer Code */
?>

		<footer>
			<div class="footer-content">
				<nav class="footer-nav-wrapper">
					<?php 
						wp_nav_menu( $arg = array (
							'menu_class' => 'nav-menu-footer',
							'theme_location' => 'footer'
						));
					?>
					<div class="footer-external-nav">
						<div class='footer-nav-image-wrapper'>
							<a href="http://www.cirquequirk.com/" target="_blank"><img src="<?php bloginfo('template_url') ?>/images/cirquequirk.png" alt="Cirque Quirk Logo"></a>
						</div>
						<div class='footer-nav-image-wrapper'>
							<a href="https://www.instagram.com/allenbyart/" target="_blank"><img src="<?php bloginfo('template_url') ?>/images/instagram80.png" alt="Instagrom Logo"></a>
						</div>
						<div class='footer-nav-image-wrapper'>
							<a href="https://www.facebook.com/AllenbyArt" target="_blank"><img src="<?php bloginfo('template_url') ?>/images/facebook80.png" alt="Facebook Logo"></a>
						</div>
					</div>
				</nav>
				<div class="footer-contact-info">
					<a class="contact-container" href="mailto:allenyarts@gmail.com"><span class="fas fa-envelope"></span>&nbsp Allenbyarts@gmail.com</a>
					<a class="contact-container" href="tel:6198001997"><span class="fas fa-phone"></span>&nbsp 619.800.1887</a>
				</div>
				<p class="footer-legalscript">&copy 2019 Nathaniel Allenby</p>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
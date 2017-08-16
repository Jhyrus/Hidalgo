<?php do_action( 'dynamicnews_before_footer' ); ?>

	<div id="footer-wrap">

		<footer id="footer" class="container clearfix" role="contentinfo">

			<?php // Check if there is a top navigation menu.
			if ( has_nav_menu( 'footer' ) ) : ?>

				<nav id="footernav" class="clearfix" role="navigation">
					<?php
						// Get Navigation out of Theme Options
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'container' => false,
							'menu_id' => 'footernav-menu',
							'echo' => true,
							'fallback_cb' => '',
							'depth' => 1,
							)
						);
					?>
				</nav>

			<?php endif; ?>
			<div class="footer-div">
				<p>Calle 24 de Calacoto, Edificio Cesur, Of.310</p>
				<p>(+591) (2) 2120285</p>
			</div>
			<div class="footer-div" style="text-align: center;">
				<img src="http://hidalgosc.com/wp-content/uploads/2017/03/logo-footer.jpg" alt="">
				<div id="footer-text">
					<!-- <?php do_action( 'dynamicnews_footer_text' ); ?> -->
				</div>
			</div>
			<div class="footer-div">
				<p>Av. Mariscal Santa Cruz, Edificio Hansa, piso 12, Of. 1</p>
				<p>(+591) (2) 2407540</p>
				<!-- <p>(+591) (2) 2498364</p> -->
			</div>

		</footer>

	</div>

</div><!-- end #wrapper -->

<?php wp_footer(); ?>
</body>
</html>

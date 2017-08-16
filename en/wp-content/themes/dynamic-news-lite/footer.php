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
				<p>24th St. Torre Cesur Off. 310.</p>
				<p>Calacoto</p>
				<p>La Paz-Bolivia</p>
				<p>(+591) (2) 2120285</p>
			</div>
			<div class="footer-div" style="text-align: center;">
				<img src="http://hidalgosc.com/en/wp-content/uploads/2017/07/logo-footer.jpg" alt="">
				<div id="footer-text">
					<!-- <?php do_action( 'dynamicnews_footer_text' ); ?> -->
				</div>
			</div>
			<div class="footer-div">
				<p>Ave. Mariscal Santa Cruz. Bldg. Hansa.</p>
				<p>Floor 12. Off. 1</p>
				<p>La Paz-Bolivia</p>
				<p>(+591) (2) 2407540</p>
			</div>

		</footer>

	</div>

</div><!-- end #wrapper -->

<?php wp_footer(); ?>
</body>
</html>

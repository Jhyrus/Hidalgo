<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package wpkube
 * @since wpkube 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="header-bg">
            <img src="<?php echo get_template_directory_uri().'/img/bg.png' ?>">
		<hgroup class="logo boxed">
            <?php if ( wpkube_get_option('logo_text') ) : ?>
                <?php if ( is_singular() ) $logotag = 'h2'; else $logotag = 'h1'; ?>
                <h2 class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            <?php else : ?>
                <h2 class="no-heading-style"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
                    <img src="<?php if ( wpkube_get_option('logo') ) echo wpkube_get_option('logo'); else echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h2>
            <?php endif; ?>
		</hgroup>

		<nav role="navigation" class="site-navigation primary-navigation group">
			<?php
                if ( has_nav_menu( 'footer' ) ) {
                    wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'menu footer-menu group' ) );
                }
            ?>
		</nav><!-- .site-navigation .main-navigation -->
            
        <?php if ( wpkube_get_option('footer_content') ): ?>
            <div class="footer-content">
                <?php echo esc_attr( wpkube_get_option('footer_content') ); ?>
                <?php if ( wpkube_get_option('footer_button') ): ?>
                    <div class="footer-button">
                        <a href="<?php echo esc_url( wpkube_get_option('footer_button_link') ); ?>">
                            <button class="button"><?php echo esc_attr( wpkube_get_option('footer_button') ); ?></button>
                        </a>
                    </div>
                <?php endif; ?>
            </div><!--.footer-content-->
        <?php endif; ?>
            
		<div class="site-info">
			<?php do_action( 'wpkube_credits' ); ?>
			<?php if ( wpkube_get_option('footer_credit') ): ?>
            <?php echo esc_attr( wpkube_get_option('footer_credit') ); ?>
            <?php else: ?>
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'palmas' ) ); ?>"></a>
            &copy; <?php printf( __( 'Palmas WordPress Theme by WPKube is powered by WordPress & Theme by %s.', 'palmas' ), '<a rel="nofollow" target="_blank" href="'.esc_url('http://www.wpkube.com/').'">WPKube</a>' ); ?>
            <?php endif; ?>
		</div><!-- .site-info -->
        </div>
	</footer> <!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->
<script type="text/javascript">

jQuery(document).ready(function($){
	$('#featured-slider').flexslider({ controlNav : false  <?php if ( !wpkube_get_option('slider_auto')) echo ', slideshow:false' ?> <?php if ( !wpkube_get_option('slider_auto_timer')) echo ', slideshowSpeed:5000'; else echo ', slideshowSpeed:' . wpkube_get_option('slider_auto_timer') . '000'  ?>});
	if ( $('#carousel-slider').width() < 720 ){
		slideWidth = (($('#carousel-slider').width() )/2)  ;
	}
	else{
		slideWidth = (($('#carousel-slider').width() )/3)  ;
	}
	$('#carousel-slider').flexslider({ controlNav : false, itemWidth: slideWidth,minItems:2,  maxItem:3, animation: 'slide', move:1 <?php if ( !wpkube_get_option('carousel_auto')) echo ', slideshow:false' ?> <?php if ( !wpkube_get_option('carousel_auto_timer')) echo ', slideshowSpeed:5000'; else echo ', slideshowSpeed:' . wpkube_get_option('carousel_auto_timer') . '000'  ?>});
});

<?php if ( wpkube_get_option('footer_script') ) echo wpkube_get_option('footer_script'); ?>
</script>
<?php wp_footer(); ?>

</body>
</html>
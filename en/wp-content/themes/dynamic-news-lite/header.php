<!DOCTYPE html><!-- HTML 5 -->
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45104590-7', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_head(); ?>
<script>
	$(document).ready(function(){
		altura=229;

		$(window).on('scroll', function(){

		if ( $(window).scrollTop() > altura ) 
		{
			$('#navi-wrap').addClass ('menu-pegado');
			$('.logomenu').addClass ('logomenuadd');

		}
		else 
		{
			$('#navi-wrap').removeClass ('menu-pegado');
			$('.logomenu').removeClass ('logomenuadd');
		}	
	});
});

</script>
</head>

<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">

	<div id="topnavi-wrap">
		<?php get_template_part( 'inc/top-navigation' ); ?>
	</div>

	<div id="header-wrap">
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
					<div class="footer-div">&nbsp;</div>
					<div class="footer-div">
						<div id="footer-text">
							<!-- <?php do_action( 'dynamicnews_footer_text' ); ?> -->
							&nbsp;
						</div>
					</div>
                    
                    <div class="no-redes" align="right">
                                               
                        <div class="footer-div" style="text-align: right;">					
                      <p><a href="http://hidalgosc.com/en" target="_blank">www.hidalgosc.com</a>
					  <br/><br/>
					  <a href="http://hidalgosc.com">EN / ES</a></p>                                               	
					    </div>
                        
                     </div>
                    
                    <div class="redes" align="center">
                        <div id="googleplus"><a href="https://plus.google.com/u/0/117707286720553533743" target="_blank"><img src="http://www.hidalgosc.com/wp-content/uploads/2017/04/iconos-hidalgo-08.png" width="100%"></a></div>
                        <div id="linkedin"><img src="http://www.hidalgosc.com/wp-content/uploads/2017/04/iconos-hidalgo-07.png" width="100%" style="margin-right:20px;;"></div>
                        
                        <div class="footer-div" style="text-align: center;">					
                      <p><a href="http://hidalgosc.com/en" target="_blank">www.hidalgosc.com</a>
					  <br/><br/>
					  <a href="http://hidalgosc.com">EN / ES</a></p>                                               	
					    </div>
                        
                     </div>
                        
					

				</footer>

			</div>
		<header id="header" class="container clearfix" role="banner">

			<div id="logo" class="clearfix">

				<?php dynamicnews_site_logo(); ?>
				<?php dynamicnews_site_title(); ?>
				<?php dynamicnews_site_description(); ?>

			</div>

			<div id="header-content" class="clearfix">
				<?php get_template_part( 'inc/header-content' ); ?>
			</div>

		</header>

	</div>

	<div id="navi-wrap">
		<nav id="mainnav" class="container clearfix" role="navigation">
			<?php
				// Get Navigation out of Theme Options
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => false,
					'menu_id' => 'mainnav-menu',
					'menu_class' => 'main-navigation-menu',
					'echo' => true,
					'fallback_cb' => 'dynamicnews_default_menu',
					'depth' => 0,
				) );
			?>
		</nav>
	</div>

	<?php // Display Custom Header Image
		dynamicnews_display_custom_header(); ?>

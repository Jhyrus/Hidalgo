<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package wpkube
 * @since wpkube 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( wpkube_get_option('favicon') ) :?>
<link rel="shortcut icon" href="<?php echo ( wpkube_get_option('favicon') ); ?>">
<?php else : ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
<?php endif; ?>		
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<?php wp_head(); ?>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/selectivizr-min.js" type="text/javascript"></script>
<![endif]-->
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js" type="text/javascript"></script>
<![endif]-->

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header sticky-nav" role="banner">
		<?php if ( is_active_sidebar( 'sidebar-header' ) ) : ?>
        <div id="sidebar-top" class="boxed" >
            <?php dynamic_sidebar( 'sidebar-header' ); ?>
        </div>
        <?php endif; ?>
		<hgroup class="logo boxed">
		<?php if ( wpkube_get_option('logo_text') ) : ?>
        	<?php if ( is_singular() ) $logotag = 'h2'; else $logotag = 'h1'; ?>
			<h2 class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		<?php else : ?>
			<h2 class="no-heading-style"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" >
				<img src="<?php if ( wpkube_get_option('logo') ) echo wpkube_get_option('logo'); else echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" /></a></h2>
		<?php endif; ?>
        <div class="menu-btn off-menu fa fa-align-justify" data-effect="st-effect-4"></div>
		</hgroup>
        <div class="header-right">
		<nav role="navigation" class="site-navigation primary-navigation group">
			<?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu group' ) );
                }
            ?>
		</nav><!-- .site-navigation .main-navigation -->
        </div>
	</header><!-- #masthead .site-header -->
        <?php
            if ( is_home() || is_front_page() ) {
				$cat = wpkube_get_option('slider_category');
				$num = wpkube_get_option('slider_post_number');
				if( wpkube_get_option('enable_slider') ){
					wpkube_featured_posts('cat='.$cat.'&showposts='.$num);
                }
                if( wpkube_get_option('enable_pp') ){
				wpkube_carousel_posts();
                }
            }
        ?>
	<div id="main" class="site-main boxed group">
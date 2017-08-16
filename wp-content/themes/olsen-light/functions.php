<?php
require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/sanitization.php';
require get_template_directory() . '/inc/functions.php';
require get_template_directory() . '/inc/helpers-post-meta.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-styles.php';

add_action( 'after_setup_theme', 'olsen_light_content_width', 0 );
function olsen_light_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'olsen_light_content_width', 665 );
}

add_action( 'after_setup_theme', 'olsen_light_setup' );
if( !function_exists( 'olsen_light_setup' ) ) :
function olsen_light_setup() {

	if ( ! defined( 'CI_THEME_NAME' ) ) {
		define( 'CI_THEME_NAME', 'olsen-light' );
	}

	load_theme_textdomain( 'olsen-light', get_template_directory() . '/languages' );

	/*
	 * Theme supports.
	 */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Image sizes.
	 */
	set_post_thumbnail_size( 665, 435, true );
	add_image_size( 'olsen_light_square', 200, 200, true );

	/*
	 * Navigation menus.
	 */
	register_nav_menus( array(
		'main_menu'   => esc_html__( 'Main Menu', 'olsen-light' ),
		'footer_menu' => esc_html__( 'Footer Menu', 'olsen-light' ),
	) );

	/*
	 * Default hooks
	 */
	// Prints the inline JS scripts that are registered for printing, and removes them from the queue.
	add_action( 'admin_footer', 'olsen_light_print_inline_js' );
	add_action( 'wp_footer', 'olsen_light_print_inline_js' );

	// Handle the dismissible sample content notice.
	add_action( 'admin_notices', 'olsen_light_admin_notice_sample_content' );
	add_action( 'wp_ajax_olsen_light_dismiss_sample_content', 'olsen_light_ajax_dismiss_sample_content' );

	// Wraps post counts in span.ci-count
	// Needed for the default widgets, however more appropriate filters don't exist.
	add_filter( 'get_archives_link', 'olsen_light_wrap_archive_widget_post_counts_in_span', 10, 2 );
	add_filter( 'wp_list_categories', 'olsen_light_wrap_category_widget_post_counts_in_span', 10, 2 );
}
endif;



add_action( 'wp_enqueue_scripts', 'olsen_light_enqueue_scripts' );
function olsen_light_enqueue_scripts() {

	/*
	 * Styles
	 */
	$theme = wp_get_theme();

	$font_url = '';
	/* translators: If there are characters in your language that are not supported by Lora and Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lora and Lato fonts: on or off', 'olsen-light' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'Lora:400,700,400italic,700italic|Lato:400,400italic,700,700italic' ), '//fonts.googleapis.com/css' );
	}
	wp_register_style( 'olsen-light-google-font', esc_url( $font_url ) );

	wp_register_style( 'olsen-light-base', get_template_directory_uri() . '/css/base.css', array(), $theme->get( 'Version' ) );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.6.3' );
	wp_register_style( 'olsen-light-magnific', get_template_directory_uri() . '/css/magnific.css', array(), '1.0.0' );
	wp_register_style( 'olsen-light-slick', get_template_directory_uri() . '/css/slick.css', array(), '1.5.7' );
	wp_register_style( 'olsen-light-mmenu', get_template_directory_uri() . '/css/mmenu.css', array(), '5.2.0' );

	wp_enqueue_style( 'olsen-light-style', get_template_directory_uri() . '/style.css', array(
		'olsen-light-google-font',
		'olsen-light-base',
		'font-awesome',
		'olsen-light-magnific',
		'olsen-light-slick',
		'olsen-light-mmenu'
	), $theme->get( 'Version' ) );

	if( is_child_theme() ) {
		wp_enqueue_style( 'olsen-light-style-child', get_stylesheet_directory_uri() . '/style.css', array(
			'olsen-light-style',
		), $theme->get( 'Version' ) );
	}

	/*
	 * Scripts
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'olsen-light-superfish', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ), '1.7.5', true );
	wp_register_script( 'olsen-light-matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	wp_register_script( 'olsen-light-slick', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), '1.5.7', true );
	wp_register_script( 'olsen-light-mmenu-offcanvas', get_template_directory_uri() . '/js/jquery.mmenu.offcanvas.js', array( 'jquery' ), '5.2.0', true );
	wp_register_script( 'olsen-light-mmenu-navbars', get_template_directory_uri() . '/js/jquery.mmenu.navbars.js', array( 'jquery' ), '5.2.0', true );
	wp_register_script( 'olsen-light-mmenu-autoheight', get_template_directory_uri() . '/js/jquery.mmenu.autoheight.js', array( 'jquery' ), '5.2.0', true );
	wp_register_script( 'olsen-light-mmenu', get_template_directory_uri() . '/js/jquery.mmenu.oncanvas.js', array( 'jquery', ), '5.2.0', true );
	wp_register_script( 'olsen-light-fitVids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.1', true );
	wp_register_script( 'olsen-light-magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.js', array( 'jquery' ), '1.0.0', true );

	/*
	 * Enqueue
	 */
	wp_enqueue_script( 'olsen-light-front-scripts', get_template_directory_uri() . '/js/scripts.js', array(
		'jquery',
		'olsen-light-superfish',
		'olsen-light-matchHeight',
		'olsen-light-slick',
		'olsen-light-mmenu',
		'olsen-light-mmenu-offcanvas',
		'olsen-light-mmenu-navbars',
		'olsen-light-mmenu-autoheight',
		'olsen-light-fitVids',
		'olsen-light-magnific'
	), $theme->get( 'Version' ), true );

}

add_action( 'admin_enqueue_scripts', 'olsen_light_admin_enqueue_scripts' );
function olsen_light_admin_enqueue_scripts( $hook ) {
	$theme = wp_get_theme();

	/*
	 * Styles
	 */


	/*
	 * Scripts
	 */
	wp_register_script( 'olsen-light-customizer', get_template_directory_uri() . '/js/admin/customizer-scripts.js', array( 'jquery' ), $theme->get( 'Version' ), true );
	$params = array(
		'documentation_text' => esc_html__( 'Documentation', 'olsen-light' ),
		'upgrade_text'       => esc_html__( 'Upgrade to Pro', 'olsen-light' ),
	);
	wp_localize_script( 'olsen-light-customizer', 'olsen_light_customizer', $params );


	/*
	 * Enqueue
	 */
	if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
		wp_enqueue_media();
		wp_enqueue_style( 'olsen-light-post-meta' );
		wp_enqueue_script( 'olsen-light-post-meta' );
	}

	if ( in_array( $hook, array( 'profile.php', 'user-edit.php' ) ) ) {
		wp_enqueue_media();
		wp_enqueue_style( 'olsen-light-post-meta' );
		wp_enqueue_script( 'olsen-light-post-meta' );
	}

	if ( in_array( $hook, array( 'widgets.php', 'customize.php' ) ) ) {
		wp_enqueue_media();
		wp_enqueue_style( 'olsen-light-post-meta' );
		wp_enqueue_script( 'olsen-light-post-meta' );
		wp_enqueue_script( 'olsen-light-customizer' );
	}

}

add_action( 'customize_controls_print_styles', 'olsen_light_enqueue_customizer_styles' );
function olsen_light_enqueue_customizer_styles() {
	$theme = wp_get_theme();

	wp_register_style( 'olsen-light-customizer-styles', get_template_directory_uri() . '/css/admin/customizer-styles.css', array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'olsen-light-customizer-styles' );
}


add_action( 'widgets_init', 'olsen_light_widgets_init' );
function olsen_light_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html_x( 'Blog', 'widget area', 'olsen-light' ),
		'id'            => 'blog',
		'description'   => esc_html__( 'This is the main sidebar.', 'olsen-light' ),
		'before_widget' => '<aside id="%1$s" class="widget group %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html_x( 'Pages', 'widget area', 'olsen-light' ),
		'id'            => 'page',
		'description'   => esc_html__( 'This sidebar appears on your static pages. If empty, the Blog sidebar will be shown instead.', 'olsen-light' ),
		'before_widget' => '<aside id="%1$s" class="widget group %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html_x( 'Footer Sidebar', 'widget area', 'olsen-light' ),
		'id'            => 'footer-widgets',
		'description'   => esc_html__( 'Special site-wide sidebar for the WP Instagram Widget plugin.', 'olsen-light' ),
		'before_widget' => '<aside id="%1$s" class="widget group %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'olsen_light_load_widgets' );
function olsen_light_load_widgets() {
	require get_template_directory() . '/inc/widgets/about-me.php';
	require get_template_directory() . '/inc/widgets/latest-posts.php';
	require get_template_directory() . '/inc/widgets/socials.php';
}

add_filter( 'excerpt_length', 'olsen_light_excerpt_length' );
function olsen_light_excerpt_length( $length ) {
	return get_theme_mod( 'excerpt_length', 55 );
}


add_filter( 'previous_posts_link_attributes', 'olsen_light_previous_posts_link_attributes' );
function olsen_light_previous_posts_link_attributes( $attrs ) {
	$attrs .= ' class="paging-standard paging-older"';
	return $attrs;
}
add_filter( 'next_posts_link_attributes', 'olsen_light_next_posts_link_attributes' );
function olsen_light_next_posts_link_attributes( $attrs ) {
	$attrs .= ' class="paging-standard paging-newer"';
	return $attrs;
}

add_filter( 'wp_page_menu', 'olsen_light_wp_page_menu', 10, 2 );
function olsen_light_wp_page_menu( $menu, $args ) {
	preg_match( '#^<div class="(.*?)">(?:.*?)</div>$#', $menu, $matches );
	$menu = preg_replace( '#^<div class=".*?">#', '', $menu, 1 );
	$menu = preg_replace( '#</div>$#', '', $menu, 1 );
	$menu = preg_replace( '#^<ul>#', '<ul class="' . esc_attr( $args['menu_class'] ) . '">', $menu, 1 );
	return $menu;
}


add_filter( 'the_content', 'olsen_light_lightbox_rel', 12 );
add_filter( 'get_comment_text', 'olsen_light_lightbox_rel' );
add_filter( 'wp_get_attachment_link', 'olsen_light_lightbox_rel' );
if ( ! function_exists( 'olsen_light_lightbox_rel' ) ):
function olsen_light_lightbox_rel( $content ) {
	global $post;
	$pattern     = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 data-lightbox="gal[' . $post->ID . ']"$6>$7</a>';
	$content     = preg_replace( $pattern, $replacement, $content );

	return $content;
}
endif;


add_filter( 'wp_link_pages_args', 'olsen_light_wp_link_pages_args' );
function olsen_light_wp_link_pages_args( $params ) {
	$params = array_merge( $params, array(
		'before' => '<p class="link-pages">' . esc_html__( 'Pages:', 'olsen-light' ),
		'after'  => '</p>',
	) );

	return $params;
}

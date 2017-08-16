<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package wpkube
 * @since wpkube 1.00
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since wpkube 1.00
 */
function wpkube_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wpkube_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since wpkube 1.00
 */
function wpkube_body_classes( $classes ) {
	global $post;
	
	$classes[] = wpkube_get_option('layout_default') ? wpkube_get_option('layout_default') : 'left-sidebar';
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'wpkube_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since wpkube 1.00
 */
function wpkube_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'wpkube_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @since wpkube 1.00
 */
function wpkube_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'palmas' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wpkube_wp_title', 10, 2 );

/**
 * Set the excerpt length.
 *
 * @since wpkube 1.00
 */
function wpkube_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpkube_excerpt_length', 999 );

/**
 * Fix the excerpt more text
 *
 * @since wpkube 1.00
 */
function wpkube_excerpt_more($more) {
	global $post;
	return '...';
}
add_filter('excerpt_more', 'wpkube_excerpt_more');


/*
 * Manage font to load based on the customizer setting
 *
 */
function wpkube_load_font(){

	$websafe_lib = array(

			'Arial__400,700',
			'Arial_Black__400,700',
			'Book_Antiqua__400,700',
			'Comic_Sans_MS__400,700',
			'Courier_New__400,700',
			'Geneva__400,700',
			'Georgia__400,700',
			'Helvetica__400,700',
			'Impact__400,700',
			'Lucida_Console__400,700',
			'Lucida_Grande__400,700',
			'Lucida_Sans_Unicode__400,700',
			'Monaco__400,700',
			'New_York__400,700',
			'Palatino_Lynotype__400,700',
			'Tahoma__400,700',
			'Times_New_Roman__400,700',
			'Trebuchet_MS__400,700',
			'Verdana__400,700',

		);

	$default_font = array(
			'body_font' => 'Roboto__100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',
			'heading_font' => 'Nixie_One__400',
			'menu_font' => 'Karla__400,400italic,700,700italic',
		);

	$added = array();

	foreach ( $default_font as $section => $default ){

		if ( !( $font_to_load = get_theme_mod($section) ) ){
			$font_to_load = $default;
		}

		if ( !in_array( $font_to_load, $websafe_lib ) && !in_array( $font_to_load, $added ) ) {
			$added[] = $font_to_load;
			$font_to_load = str_replace( '__', ':', $font_to_load );
			$font_id = substr( $font_to_load, 0, strpos( $font_to_load, ':') );
			$font_to_load = str_replace( '_', '+', $font_to_load );
			$font_url = 'http://fonts.googleapis.com/css?family=' . $font_to_load;
			wp_enqueue_style( $font_id , $font_url );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'wpkube_load_font' );


/*
 * Apply font to css based on the customizer setting
 *
 */
function wpkube_apply_fonts() {

	$echo = '';
	if ( $font_to_load = get_theme_mod('body_font') ) {
		$echo .= 'body, .no-heading-style, input[type=text], input[type=email], input[type=password], textarea {';
		$echo .= 'font-family : "' . str_replace( '_', ' ', substr( $font_to_load, 0, strpos( $font_to_load, '__') ) ) . '"; ';
		$echo .= '}';
	}

	if ( $font_to_load = get_theme_mod('heading_font') ) {
		$echo .= 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {';
		$echo .= 'font-family : "' . str_replace( '_', ' ', substr( $font_to_load, 0, strpos( $font_to_load, '__') ) ) . '"; ';
		$echo .= '}';
	}

	if ( $font_to_load = get_theme_mod('menu_font') ) {
		$echo .= '.secondary-navigation > div > ul > li > a, .section-title, #reply-title, .widget-title, button, html input[type="button"], input[type="reset"], input[type="submit"] {';
		$echo .= 'font-family : "' . str_replace( '_', ' ', substr( $font_to_load, 0, strpos( $font_to_load, '__') ) ) . '"; ';
		$echo .= '}';
	}

	if ( $echo ) {
		echo '<style id="apply-webfont">' . $echo . '</style>';
	}

}
add_action( 'wp_head', 'wpkube_apply_fonts' );




/**
 * Remove first gallery shortcode if found in post
 *
 * @since wpkube 1.00
 */
function wpkube_remove_first_gallery($content){
	global $post;
	$pattern = get_shortcode_regex();
    preg_match('/'.$pattern.'/s', $post->post_content, $matches);
	if (isset($matches[0])){
		$content = str_replace( $matches[0], '', $content );
	}
	return $content;
}

/**
 * Check if a post have gallery shortcode
 *
 * @since wpkube 1.00
 */
function wpkube_have_gallery(){
	global $post;
	$pattern = get_shortcode_regex();
    preg_match('/'.$pattern.'/s', $post->post_content, $matches);
	if (isset($matches[0])){
		$have_gallery = true;
	}else{
		$have_gallery = false;
	}
	return $have_gallery;
}

/**
 * remove some rel
 *
 * @since wpkube 1.00
 */
//add_filter( 'the_category', 'wpkube_add_nofollow_cat' );
function wpkube_add_nofollow_cat( $text) {
	$text = str_replace('rel="category tag"', "", $text);
	return $text;
}

/**
 * Display image caption
 *
 * @since wpkube 1.00
 */
function wpkube_img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    ), $attr));
     
    if ( 1 > (int) $width || empty($caption) )
        return $val;
 
    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
 
    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . (int) $width . 'px">'
    . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
add_filter('img_caption_shortcode', 'wpkube_img_caption_shortcode_filter',10,3);

/**
 * Adding styling to the editor
 *
 * @since wpkube 1.00
 */
function wpkube_add_editor_styles() {
    add_editor_style( 'style-editor.css' );
}
add_action( 'init', 'wpkube_add_editor_styles' );

add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * adding a class to the ul of menu, this is used in fallback menu
 *
 * @since wpkube 1.00
 */
function wpkube_strip_div_menu_page($menu){
	$menu = str_replace('<ul>', '<ul class="group">', $menu );
	return strip_tags($menu, '<ul><li><a><span>');
}

/**
 * Exclude some posts with certain categories from recent posts stream
 *
 * @since wpkube 1.00
 */
function wpkube_exclude_categories( $query ){
	global $theme_options;
	if ( $query->is_home() && $query->is_main_query() && wpkube_get_option('exclude_categories') ) {
		$query->query_vars['category__not_in'] = wpkube_get_option('exclude_categories');
	}
}
add_action( 'pre_get_posts', 'wpkube_exclude_categories' );

?>
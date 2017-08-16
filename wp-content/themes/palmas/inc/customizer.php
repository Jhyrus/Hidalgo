<?php
/**
 * wpkube Theme Customizer
 *
 * @package wpkube
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function wpkube_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->get_section('background_image')->priority = 41;
	$wp_customize->get_section('colors')->priority = 35;
	$wp_customize->get_section('colors')->title = __('Background & Sidebar Colors', 'palmas');
	$wp_customize->get_setting( 'background_color' )->priority= 1;

	/* Section : Logo % Favicon
	---------------------------------*/
	$wp_customize->add_section( 'logo_favicon', array(
			'title'    => __( 'Logo & Favicon', 'palmas' ),
			'priority' => 30,
	) );

	/* Section : Featured post slider
	---------------------------------*/
	$wp_customize->add_section( 'featured_post_slider', array(
			'title'    => __( 'Featured Post Slider Options', 'palmas' ),
			'priority' => 31,
	) );

	/* Section : Featured post carousel
	---------------------------------*/
	$wp_customize->add_section( 'featured_post_carousel', array(
			'title'    => __( 'Featured Post Carousel Options', 'palmas' ),
			'priority' => 32,
	) );

	/* Section : Footer setting
	---------------------------------*/
	$wp_customize->add_section( 'footer', array(
			'title'    => __( 'Footer Setting', 'palmas' ),
			'priority' => 42,
	) );

	/* Section : Layout Setting
	---------------------------------*/
	$wp_customize->add_section( 'layout', array(
			'title'    => __( 'Layout Setting', 'palmas' ),
			'priority' => 34,
	) );

	/* Section : primary Menu Colors
	---------------------------------*/
	$wp_customize->add_section( 'primary_menu_colors', array(
			'title'    => __( 'Primary Menu Colors', 'palmas' ),
			'priority' => 37,
	) );

	/* Section : Main Content Colors
	---------------------------------*/
	$wp_customize->add_section( 'content_colors', array(
			'title'    => __( 'Main Content Colors', 'palmas' ),
			'priority' => 38,
	) );

	/* Section : Typography setting
	---------------------------------*/
	$wp_customize->add_section( 'typography', array(
			'title'    => __( 'Typography Setting', 'palmas' ),
			'priority' => 39,
	) );

}

add_action( 'customize_register', 'wpkube_customize_register' );


/**
 * List of customizer settings
 */
function wpkube_customize_items( $settings ) {

	$default_color_options = array(
		'font_color' => '#222222',
		'link_color' => '#dc2834',
		'meta_color' => '#aaaaaa',
		'border_color' => '#dddddd',
		'palmas_widget_title_color' => '#222222',
		'menu_background' => '#dc2834',
		'menu_link' => '#ffffff',
		'menu_link_hover' => '#ff9397',
		'menu_border_color' => '#ff9397',
		'primary_menu_color' => '#222222',
		'primary_menu_color_hover' => '#aaaaaa',
		'content_background_color' => '#ffffff',
		'content_font_color' => '#222222',
		'content_link_color' => '#dc2834',
		'content_meta_color' => '#bbbbbb',
		'content_border_color' => '#dddddd',
		'content_section_title_color' => '#0e1430',
		'heading_font' => 'Roboto__100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',
		'heading_font_style' => 'normal',
		'heading_font_weight' => '400',
		'body_font' => 'Roboto__100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',
		'menu_font' => 'Karla__400,400italic,700,700italic',
		'menu_font_style' => 'normal',
		'menu_font_weight' => '700',
	);


	/* Section : Logo % Favicon
	---------------------------------*/

	/* Upload logo option */
	$settings[] = array(
		'id' => 'logo',
		'control' => 'image',
		'label' => __('Logo Upload', 'palmas'),
		'section' => 'logo_favicon',
	);

	/* Text logo option checkbox */
	$settings[] = array(
		'id' => 'logo_text',
		'default' => false,
		'label'    => __( 'Use site title as text for logo', 'palmas' ),
		'section'  => 'logo_favicon',
		'control'     => 'checkbox',
		'priority' => 1,
	);

	/* Upload favicon option */
	$settings[] = array(
		'id' => 'favicon',
		'control' => 'image',
		'label' => __('favicon Upload', 'palmas'),
		'section' => 'logo_favicon',
	);


	/* Section : Featured post slider
	---------------------------------*/


	/* Enable/disable checkbox */
	$settings[] = array(
		'id' => 'enable_slider',
		'default' => false,
		'label'    => __( 'Enable slider on homepage', 'palmas' ),
		'section'  => 'featured_post_slider',
		'priority' => 1,
		'control'     => 'checkbox',
	);
    $settings[] = array(
		'id' => 'slider_heading',
		'default' => '',
        'transport'   => 'refresh',
		'control' => 'textarea',
		'label' => __('Slider Heading', 'palmas'),
		'section' => 'featured_post_slider',
	);
    $settings[] = array(
		'id' => 'slider_text',
		'default' => '',
        'transport'   => 'refresh',
		'control' => 'textarea',
		'label' => __('Slider Text', 'palmas'),
		'section' => 'featured_post_slider',
	);
    /* Upload logo option */
	$settings[] = array(
		'id' => 'slider_bg',
		'control' => 'image',
		'label' => __('Slider Background', 'palmas'),
		'section' => 'featured_post_slider',
	);

	/* Slider category select */
	$settings[] = array(
		'id' => 'slider_category',
		'default' => '',
		'label'    => __( 'Select the category for slider', 'palmas' ),
		'section'  => 'featured_post_slider',
		'priority' => 2,
		'control'     => 'select',
		'choices'  => wpkube_taxonomy_array(),
	);

	/* Slider post number */
	$settings[] = array(
		'id' => 'slider_post_number',
		'default' => 5,
		'label'    => __( 'Select the maximum post number', 'palmas' ),
		'section'  => 'featured_post_slider',
		'priority' => 3,
		'control'     => 'select',
		'choices'  =>  array( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'),
	);

	/* Enable/disable auto slider */
	$settings[] = array(
		'id' => 'slider_auto',
		'default' => false,
		'label'    => __( 'Enable auto slide', 'palmas' ),
		'section'  => 'featured_post_slider',
		'priority' => 4,
		'control'     => 'checkbox',
	);

	/* Slider auto slide timer*/
	$settings[] = array(
		'id' => 'slider_auto_timer',
		'default' => 5,
		'label'    => __( 'Auto slide timer', 'palmas' ),
		'section'  => 'featured_post_slider',
		'control'     => 'select',
		'priority' => 5,
		'choices'  =>  array( '1'=>'1 second', '2'=>'2 seconds', '3'=>'3 seconds', '4'=>'4 seconds', '5'=>'5 seconds', '6'=>'6 seconds', '7'=>'7 seconds', '8'=>'8 seconds', '9'=>'9 seconds', '10'=>'10 seconds'),
	);

	/* Show/hide in second page and next */
	$settings[] = array(
		'id' => 'slider_hide_next',
		'default' => false,
		'label'    => __( 'Hide slider in second page and next', 'palmas' ),
		'section'  => 'featured_post_slider',
		'priority' => 6,
		'control'     => 'checkbox',
	);

    /* Enable/disable checkbox */
    	$settings[] = array(
		'id' => 'enable_pp',
		'default' => false,
		'label'    => __( 'Enable Popular post on homepage', 'palmas' ),
		'section'  => 'featured_post_slider',
		'priority' => 1,
		'control'     => 'checkbox',
	);


	/* Section : Post Setting
	---------------------------------*/

	$settings[] = array(
		'id' => 'exclude_categories',
		'default' => '',
		'control' => 'select',
		'label' => __('Do not show posts if home with these categories', 'palmas'),
		'section' => 'post_setting',
		'choices'  => wpkube_taxonomy_array(),
	);


	/* Section : Footer setting
	---------------------------------*/

	/* Credit text on footer */
	$settings[] = array(
		'id' => 'footer_credit',
		'default' => '',
		'transport' => 'refresh',
		'control' => 'textarea',
		'label' => __('Credit text on footer', 'palmas'),
		'section' => 'footer',
	);
    /* text on footer */
	$settings[] = array(
		'id' => 'footer_content',
		'default' => '',
		'transport' => 'refresh',
		'control' => 'textarea',
		'label' => __('Text on footer', 'palmas'),
		'section' => 'footer',
	);
    /* text on footer */
	$settings[] = array(
		'id' => 'footer_button',
		'default' => '',
		'transport' => 'refresh',
		'control' => 'textarea',
		'label' => __('Footer button text', 'palmas'),
		'section' => 'footer',
	);
    /* text on footer */
	$settings[] = array(
		'id' => 'footer_button_link',
		'default' => '',
		'transport' => 'refresh',
		'control' => 'url',
		'label' => __('Footer button link', 'palmas'),
		'section' => 'footer',
	);
	/* Additional script  */
	$settings[] = array(
		'id' => 'footer_script',
		'default' => '',
		'sanitize_callback' => 'wpkube_sanitize_text',
		'control' => 'textarea',
		'label' => __('Add aditional script, please do not include <script> tag.', 'palmas'),
		'section' => 'footer',
	);


	/* Section : Layout Setting
	---------------------------------*/

	$settings[] = array(
		'id' => 'layout_default',
		'default' => 'left-sidebar',
		'label'    => __( 'General Layout', 'palmas' ),
		'section'  => 'layout',
		'priority' => 1,
		'control'     => 'radio',
		'choices'  =>  array( 'right-sidebar'=>'Right Sidebar', 'left-sidebar'=>'Left Sidebar'),
	);

	/* General colors ( the controls added to existing section 'colors')
	---------------------------------*/
	$settings[] = array(
		'id' => 'font_color',
		'default' =>  $default_color_options['font_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Font color', 'palmas' ),
		'section' => 'colors',
		'priority' => 1,
		'apply_css' => array (
			array(
				'selector' => 'body, .no-heading-style, #primary .entry-title a, .popular-posts article .home-thumb:after, #primary input[type=text], #primary input[type=email], #primary input[type=password], #primary textarea',
				'property' => 'color',
			),
		),
	);

	$settings[] = array(
		'id' => 'link_color',
		'default' => $default_color_options['link_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Link color', 'palmas' ),
		'section' => 'colors',
		'priority' => 2,
		'apply_css' => array (
			array(
				'selector' => '.tabs ul.nav-tab li.tab-active a:before, #primary .entry-title a:hover, .popular-posts article .home-thumb:hover:after',
				'property' => 'color',
			)
		),
	);

	$settings[] = array(
		'id' => 'meta_color',
		'default' => $default_color_options['meta_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Meta text color', 'palmas' ),
		'section' => 'colors',
		'priority' => 3,
		'apply_css' => array (
			array(
				'selector' => '.entry-meta, .entry-meta .comments-link a, .widget_twitter li > a, .tabs ul.nav-tab li a, #respond .required-attr, .widget_nav_menu [class^="icon-"] a:before',
				'property' => 'color',
			)
		),
	);

	$settings[] = array(
		'id' => 'border_color',
		'default' => $default_color_options['border_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Border color', 'palmas' ),
		'section' => 'colors',
		'priority' => 4,
		'apply_css' => array (
			array(
				'selector' => '.primary-navigation > div > ul > li a, .tabs ul.nav-tab li.second_tab, .tabs ul.nav-tab li.third_tab',
				'property' => 'border-left-color',
			),
			array(
				'selector' => '.widget ul li, .tabs ul.nav-tab li a, .widget_posts article, .widget-title, .primary-navigation > div > ul ul a',
				'property' => 'border-bottom-color',
			),
			array(
				'selector' => '#twitter_account, .tabs ul.nav-tab li a, #primary, .primary-navigation, .primary-navigation > div, .site-info, .site-footer',
				'property' => 'border-top-color',
			),
			array(
				'selector' => '#primary input[type=text], #primary input[type=email], #primary input[type=password], #primary textarea',
				'property' => 'border-color',
			),
		),
	);

	$settings[] = array(
		'id' => 'palmas_widget_title_color',
		'default' => $default_color_options['palmas_widget_title_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Widget title color', 'palmas' ),
		'section' => 'colors',
		'priority' => 4,
		'apply_css' => array (
			array(
				'selector' => '.widget-title',
				'property' => 'color',
			)
		),
	);

	/* Section : primary Menu Colors
	---------------------------------*/

	$settings[] = array(
		'id' => 'primary_menu_color',
		'default' => $default_color_options['primary_menu_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Primary menu link color', 'palmas' ),
		'section' => 'primary_menu_colors',
		'priority' => 5,
		'apply_css' => array (
			array(
				'selector' => '.primary-navigation a',
				'property' => 'color',
			)
		),
	);

	$settings[] = array(
		'id' => 'primary_menu_color_hover',
		'default' => $default_color_options['primary_menu_color_hover'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Primary menu link hover color', 'palmas' ),
		'section' => 'primary_menu_colors',
		'priority' => 6,
		'apply_css' => array (
			array(
				'selector' => '.primary-navigation a:hover',
				'property' => 'color',
			)
		),
	);


	/* Section : Main Content Colors
	---------------------------------*/

	$settings[] = array(
		'id' => 'content_background_color',
		'default' => $default_color_options['content_background_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Content and sidebar background color', 'palmas' ),
		'section' => 'content_colors',
		'priority' => 1,
		'apply_css' => array (
			array(
				'selector' => '.post-content',
				'property' => 'background-color',
			)
		),
	);

	$settings[] = array(
		'id' => 'content_font_color',
		'default' => $default_color_options['content_font_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Main content font color', 'palmas' ),
		'section' => 'content_colors',
		'priority' => 2,
		'apply_css' => array (
			array(
				'selector' => '#primary, #primary input[type=text], #primary input[type=email], #primary input[type=password], #primary textarea',
				'property' => 'color',
			),
			array(
				'selector' => '#primary button:hover, #primary input[type="button"]:hover, #primary input[type="reset"]:hover, #primary input[type="submit"]:hover',
				'property' => 'background-color',
			),
		),
	);

	$settings[] = array(
		'id' => 'content_link_color',
		'default' => $default_color_options['content_link_color'],
		'transport' => 'postMessage',
		'label'   => __( 'Main content link color', 'palmas' ),
		'control' => 'color',
		'section' => 'content_colors',
		'priority' => 3,
		'apply_css' => array (
			array(
				'selector' => '#primary a, #primary .entry-title a:hover',
				'property' => 'color',
			),
			array(
				'selector' => '#primary button, #primary input[type="button"], #primary input[type="reset"], #primary input[type="submit"]',
				'property' => 'background-color',
			),
		),
	);

	$settings[] = array(
		'id' => 'content_meta_color',
		'default' => $default_color_options['content_meta_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Main content meta text color', 'palmas' ),
		'section' => 'content_colors',
		'priority' => 4,
		'apply_css' => array (
			array(
				'selector' => '#primary .entry-meta, #primary .entry-meta a,  #primary .entry-meta-single, .hentry footer .inline-icon-user, #primary .post-tags, #primary #breadcrumbs, #primary .entry-meta .comments-link a, #comments .commentlist li .comment-meta a',
				'property' => 'color',
			)
		),
	);

	$settings[] = array(
		'id' => 'content_border_color',
		'default' => $default_color_options['content_border_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Borders color', 'palmas' ),
		'section' => 'content_colors',
		'priority' => 5,
		'apply_css' => array (
			array(
				'selector' => '#primary #breadcrumbs, #comments .commentlist li article.comment, .single .post .related-box ul li',
				'property' => 'border-bottom-color',
			),
			array(
				'selector' => '#primary input[type=text], #primary input[type=email], #primary input[type=password], #primary textarea, .wp-caption, pre',
				'property' => 'border-color',
			),
			array(
				'selector' => '.hentry:before, .single .post > footer, .page-navigation, #comments .commentlist li article.comment',
				'property' => 'border-top-color',
			),
			array(
				'selector' => '.hentry blockquote',
				'property' => 'border-left-color',
			),
		),
	);

	$settings[] = array(
		'id' => 'content_section_title_color',
		'default' => $default_color_options['content_section_title_color'],
		'transport' => 'postMessage',
		'control' => 'color',
		'label'   => __( 'Section title font color', 'palmas' ),
		'section' => 'content_colors',
		'priority' => 6,
		'apply_css' => array (
			array(
				'selector' => '.section-title, .slider-header h2, #primary .section-title a, #reply-title, .section-title:after, #reply-title:after, #carousel-slider .flex-direction-nav a',
				'property' => 'color',
			)
		),
	);


	/* Section : Typography setting
	---------------------------------*/

	$settings[] = array(
		'id' => 'heading_font',
		'default' => $default_color_options['heading_font'],
		'label'    => __( 'Heading font', 'palmas' ),
		'section'  => 'typography',
		'priority' => 1,
		'control'     => 'select',
		'choices'  => wpkube_array_font(),
	);

	$settings[] = array(
		'id' => 'heading_font_style',
		'default' => $default_color_options['heading_font_style'],
		//'label'    => __( 'Heading font', 'palmas' ),
		'section'  => 'typography',
		'priority' => 2,
		'control'     => 'radio',
		'choices'  => array('italic'=>'Italic', 'normal'=>'Normal'),
		'transport' => 'postMessage',
		'apply_css' => array (
			array(
				'selector' => 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6',
				'property' => 'font-style',
			)
		),
	);

	$settings[] = array(
		'id' => 'heading_font_weight',
		'default' => $default_color_options['heading_font_weight'],
		//'label'    => __( 'Heading font', 'palmas' ),
		'section'  => 'typography',
		'priority' => 3,
		'control'     => 'select',
		'choices'  => array('100'=>'100', '200'=>'200', '300'=>'300', '400'=>'400 (Normal)', '500'=>'500', '600'=>'600', '700'=>'700 (Bold)', '800'=>'800', '900'=>'900', ),
		'transport' => 'postMessage',
		'apply_css' => array (
			array(
				'selector' => 'h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6',
				'property' => 'font-weight',
			)
		),
	);

	$settings[] = array(
		'id' => 'body_font',
		'default' => $default_color_options['body_font'],
		'label'    => __( 'Body font', 'palmas' ),
		'section'  => 'typography',
		'priority' => 4,
		'control'     => 'select',
		'choices'  => wpkube_array_font(),
	);

	$settings[] = array(
		'id' => 'menu_font',
		'default' => $default_color_options['menu_font'],
		'label'    => __( 'Menu font', 'palmas' ),
		'section'  => 'typography',
		'priority' => 7,
		'control'     => 'select',
		'choices'  => wpkube_array_font(),
	);

	$settings[] = array(
		'id' => 'menu_font_style',
		'default' => $default_color_options['menu_font_style'],
		//'label'    => __( 'Heading font', 'palmas' ),
		'section'  => 'typography',
		'priority' => 8,
		'control'     => 'radio',
		'choices'  => array('italic'=>'Italic', 'normal'=>'Normal'),
		'transport' => 'postMessage',
		'apply_css' => array (
			array(
				'selector' => '.primary-navigation > div > ul > li > a, .section-title, #reply-title, .widget-title, button, html input[type="button"], input[type="reset"], input[type="submit"]',
				'property' => 'font-style',
			),
		),
	);

	$settings[] = array(
		'id' => 'menu_font_weight',
		'default' => $default_color_options['menu_font_weight'],
		//'label'    => __( 'Heading font', 'palmas' ),
		'section'  => 'typography',
		'priority' => 9,
		'control'     => 'select',
		'choices'  => array('100'=>'100', '200'=>'200', '300'=>'300', '400'=>'400 (Normal)', '500'=>'500', '600'=>'600', '700'=>'700 (Bold)', '800'=>'800', '900'=>'900', ),
		'transport' => 'postMessage',
		'apply_css' => array (
			array(
				'selector' => '.primary-navigation > div > ul > li > a, .section-title, #reply-title, .widget-title, button, html input[type="button"], input[type="reset"], input[type="submit"]',
				'property' => 'font-weight',
			),
		),
	);


	return $settings;
}
add_filter('customizer_wrapper_settings', 'wpkube_customize_items' );
add_filter('apply_customizer_css', 'wpkube_customize_items' );
add_filter('export_customizer_settings', 'wpkube_customize_items' );



/* Following is the helper for customizer's select's choices array */

/**
 * Return array of terms of taxonomy
 *
 * @param $taxonomy is the taxonomy, default = category
 * @return array of terms based on taxonomy
 */
function wpkube_taxonomy_array( $taxonomy = 'category' ){
	$terms = get_terms($taxonomy, 'hide_empty=1');
	$array_tax = array();
	if ( is_array($terms) && count($terms)> 0 ){
		foreach ( $terms as $term ){
			$array_tax[$term->term_id] = $term->name;
		}
	}

	return $array_tax;
}

/* Following will be the callback functions that used as active_callback
 * properties on customizer controls
 */

/**
 * Active callback for footer background control options
 *
 * @param $control is customize control object
 * @return boolean, true if the background image setting isset/not empty
 */
function wpkube_is_footer_background( $control ) {
	$is_bg = $control->manager->get_setting('footer_background_image')->value();



	return isset( $is_bg );
}


/**
 * Array list for Google Webfonts.
 *
 */
function wpkube_array_font(){

	/* Web safe fonts */
	$font[""] = "[Default]";
	$font["Arial__400,700"] = "Arial";
	$font["Arial_Black__400,700"] = "Arial Black";
	$font["Book_Antiqua__400,700"] = "Book Antiqua";
	$font["Comic_Sans_MS__400,700"] = "Comic Sans MS";
	$font["Courier_New__400,700"] = "Courier New";
	$font["Geneva__400,700"] = "Geneva";
	$font["Georgia__400,700"] = "Georgia";
	$font["Helvetica__400,700"] = "Helvetica";
	$font["Impact__400,700"] = "Impact";
	$font["Lucida_Console__400,700"] = "Lucida Console";
	$font["Lucida_Grande__400,700"] = "Lucida Grande";
	$font["Lucida_Sans_Unicode__400,700"] = "Lucida Sans Unicode";
	$font["Monaco__400,700"] = "Monaco";
	$font["New_York__400,700"] = "New York";
	$font["Palatino_Lynotype__400,700"] = "Palatino Lynotype";
	$font["Tahoma__400,700"] = "Tahoma";
	$font["Times_New_Roman__400,700"] = "Times New Roman";
	$font["Trebuchet_MS__400,700"] = "Trebuchet MS";
	$font["Verdana__400,700"] = "Verdana";

	/* Google webfonts */
	$font["ABeeZee__400,400italic"] = "ABeeZee";
	$font["Abel__400"] = "Abel";
	$font["Abril_Fatface__400"] = "Abril Fatface";
	$font["Aclonica__400"] = "Aclonica";
	$font["Acme__400"] = "Acme";
	$font["Actor__400"] = "Actor";
	$font["Adamina__400"] = "Adamina";
	$font["Advent_Pro__100,200,300,400,500,600,700"] = "Advent Pro";
	$font["Aguafina_Script__400"] = "Aguafina Script";
	$font["Akronim__400"] = "Akronim";
	$font["Aladin__400"] = "Aladin";
	$font["Aldrich__400"] = "Aldrich";
	$font["Alef__400,700"] = "Alef";
	$font["Alegreya__400,400italic,700,700italic,900,900italic"] = "Alegreya";
	$font["Alegreya_SC__400,400italic,700,700italic,900,900italic"] = "Alegreya SC";
	$font["Alex_Brush__400"] = "Alex Brush";
	$font["Alfa_Slab_One__400"] = "Alfa Slab One";
	$font["Alice__400"] = "Alice";
	$font["Alike__400"] = "Alike";
	$font["Alike_Angular__400"] = "Alike Angular";
	$font["Allan__400,700"] = "Allan";
	$font["Allerta__400"] = "Allerta";
	$font["Allerta_Stencil__400"] = "Allerta Stencil";
	$font["Allura__400"] = "Allura";
	$font["Almendra__400,400italic,700,700italic"] = "Almendra";
	$font["Almendra_Display__400"] = "Almendra Display";
	$font["Almendra_SC__400"] = "Almendra SC";
	$font["Amarante__400"] = "Amarante";
	$font["Amaranth__400,400italic,700,700italic"] = "Amaranth";
	$font["Amatic_SC__400,700"] = "Amatic SC";
	$font["Amethysta__400"] = "Amethysta";
	$font["Anaheim__400"] = "Anaheim";
	$font["Andada__400"] = "Andada";
	$font["Andika__400"] = "Andika";
	$font["Angkor__400"] = "Angkor";
	$font["Annie_Use_Your_Telescope__400"] = "Annie Use Your Telescope";
	$font["Anonymous_Pro__400,400italic,700,700italic"] = "Anonymous Pro";
	$font["Antic__400"] = "Antic";
	$font["Antic_Didone__400"] = "Antic Didone";
	$font["Antic_Slab__400"] = "Antic Slab";
	$font["Anton__400"] = "Anton";
	$font["Arapey__400,400italic"] = "Arapey";
	$font["Arbutus__400"] = "Arbutus";
	$font["Arbutus_Slab__400"] = "Arbutus Slab";
	$font["Architects_Daughter__400"] = "Architects Daughter";
	$font["Archivo_Black__400"] = "Archivo Black";
	$font["Archivo_Narrow__400,400italic,700,700italic"] = "Archivo Narrow";
	$font["Arimo__400,400italic,700,700italic"] = "Arimo";
	$font["Arizonia__400"] = "Arizonia";
	$font["Armata__400"] = "Armata";
	$font["Artifika__400"] = "Artifika";
	$font["Arvo__400,400italic,700,700italic"] = "Arvo";
	$font["Asap__400,400italic,700,700italic"] = "Asap";
	$font["Asset__400"] = "Asset";
	$font["Astloch__400,700"] = "Astloch";
	$font["Asul__400,700"] = "Asul";
	$font["Atomic_Age__400"] = "Atomic Age";
	$font["Aubrey__400"] = "Aubrey";
	$font["Audiowide__400"] = "Audiowide";
	$font["Autour_One__400"] = "Autour One";
	$font["Average__400"] = "Average";
	$font["Average_Sans__400"] = "Average Sans";
	$font["Averia_Gruesa_Libre__400"] = "Averia Gruesa Libre";
	$font["Averia_Libre__300,300italic,400,400italic,700,700italic"] = "Averia Libre";
	$font["Averia_Sans_Libre__300,300italic,400,400italic,700,700italic"] = "Averia Sans Libre";
	$font["Averia_Serif_Libre__300,300italic,400,400italic,700,700italic"] = "Averia Serif Libre";
	$font["Bad_Script__400"] = "Bad Script";
	$font["Balthazar__400"] = "Balthazar";
	$font["Bangers__400"] = "Bangers";
	$font["Basic__400"] = "Basic";
	$font["Battambang__400,700"] = "Battambang";
	$font["Baumans__400"] = "Baumans";
	$font["Bayon__400"] = "Bayon";
	$font["Belgrano__400"] = "Belgrano";
	$font["Belleza__400"] = "Belleza";
	$font["BenchNine__300,400,700"] = "BenchNine";
	$font["Bentham__400"] = "Bentham";
	$font["Berkshire_Swash__400"] = "Berkshire Swash";
	$font["Bevan__400"] = "Bevan";
	$font["Bigelow_Rules__400"] = "Bigelow Rules";
	$font["Bigshot_One__400"] = "Bigshot One";
	$font["Bilbo__400"] = "Bilbo";
	$font["Bilbo_Swash_Caps__400"] = "Bilbo Swash Caps";
	$font["Bitter__400,400italic,700"] = "Bitter";
	$font["Black_Ops_One__400"] = "Black Ops One";
	$font["Bokor__400"] = "Bokor";
	$font["Bonbon__400"] = "Bonbon";
	$font["Boogaloo__400"] = "Boogaloo";
	$font["Bowlby_One__400"] = "Bowlby One";
	$font["Bowlby_One_SC__400"] = "Bowlby One SC";
	$font["Brawler__400"] = "Brawler";
	$font["Bree_Serif__400"] = "Bree Serif";
	$font["Bubblegum_Sans__400"] = "Bubblegum Sans";
	$font["Bubbler_One__400"] = "Bubbler One";
	$font["Buda__300"] = "Buda";
	$font["Buenard__400,700"] = "Buenard";
	$font["Butcherman__400"] = "Butcherman";
	$font["Butterfly_Kids__400"] = "Butterfly Kids";
	$font["Cabin__400,400italic,500,500italic,600,600italic,700,700italic"] = "Cabin";
	$font["Cabin_Condensed__400,500,600,700"] = "Cabin Condensed";
	$font["Cabin_Sketch__400,700"] = "Cabin Sketch";
	$font["Caesar_Dressing__400"] = "Caesar Dressing";
	$font["Cagliostro__400"] = "Cagliostro";
	$font["Calligraffitti__400"] = "Calligraffitti";
	$font["Cambo__400"] = "Cambo";
	$font["Candal__400"] = "Candal";
	$font["Cantarell__400,400italic,700,700italic"] = "Cantarell";
	$font["Cantata_One__400"] = "Cantata One";
	$font["Cantora_One__400"] = "Cantora One";
	$font["Capriola__400"] = "Capriola";
	$font["Cardo__400,400italic,700"] = "Cardo";
	$font["Carme__400"] = "Carme";
	$font["Carrois_Gothic__400"] = "Carrois Gothic";
	$font["Carrois_Gothic_SC__400"] = "Carrois Gothic SC";
	$font["Carter_One__400"] = "Carter One";
	$font["Caudex__400,400italic,700,700italic"] = "Caudex";
	$font["Cedarville_Cursive__400"] = "Cedarville Cursive";
	$font["Ceviche_One__400"] = "Ceviche One";
	$font["Changa_One__400,400italic"] = "Changa One";
	$font["Chango__400"] = "Chango";
	$font["Chau_Philomene_One__400,400italic"] = "Chau Philomene One";
	$font["Chela_One__400"] = "Chela One";
	$font["Chelsea_Market__400"] = "Chelsea Market";
	$font["Chenla__400"] = "Chenla";
	$font["Cherry_Cream_Soda__400"] = "Cherry Cream Soda";
	$font["Cherry_Swash__400,700"] = "Cherry Swash";
	$font["Chewy__400"] = "Chewy";
	$font["Chicle__400"] = "Chicle";
	$font["Chivo__400,400italic,900,900italic"] = "Chivo";
	$font["Cinzel__400,700,900"] = "Cinzel";
	$font["Cinzel_Decorative__400,700,900"] = "Cinzel Decorative";
	$font["Clicker_Script__400"] = "Clicker Script";
	$font["Coda__400,800"] = "Coda";
	$font["Coda_Caption__800"] = "Coda Caption";
	$font["Codystar__300,400"] = "Codystar";
	$font["Combo__400"] = "Combo";
	$font["Comfortaa__300,400,700"] = "Comfortaa";
	$font["Coming_Soon__400"] = "Coming Soon";
	$font["Concert_One__400"] = "Concert One";
	$font["Condiment__400"] = "Condiment";
	$font["Content__400,700"] = "Content";
	$font["Contrail_One__400"] = "Contrail One";
	$font["Convergence__400"] = "Convergence";
	$font["Cookie__400"] = "Cookie";
	$font["Copse__400"] = "Copse";
	$font["Corben__400,700"] = "Corben";
	$font["Courgette__400"] = "Courgette";
	$font["Cousine__400,400italic,700,700italic"] = "Cousine";
	$font["Coustard__400,900"] = "Coustard";
	$font["Covered_By_Your_Grace__400"] = "Covered By Your Grace";
	$font["Crafty_Girls__400"] = "Crafty Girls";
	$font["Creepster__400"] = "Creepster";
	$font["Crete_Round__400,400italic"] = "Crete Round";
	$font["Crimson_Text__400,400italic,600,600italic,700,700italic"] = "Crimson Text";
	$font["Croissant_One__400"] = "Croissant One";
	$font["Crushed__400"] = "Crushed";
	$font["Cuprum__400,400italic,700,700italic"] = "Cuprum";
	$font["Cutive__400"] = "Cutive";
	$font["Cutive_Mono__400"] = "Cutive Mono";
	$font["Damion__400"] = "Damion";
	$font["Dancing_Script__400,700"] = "Dancing Script";
	$font["Dangrek__400"] = "Dangrek";
	$font["Dawning_of_a_New_Day__400"] = "Dawning of a New Day";
	$font["Days_One__400"] = "Days One";
	$font["Delius__400"] = "Delius";
	$font["Delius_Swash_Caps__400"] = "Delius Swash Caps";
	$font["Delius_Unicase__400,700"] = "Delius Unicase";
	$font["Della_Respira__400"] = "Della Respira";
	$font["Denk_One__400"] = "Denk One";
	$font["Devonshire__400"] = "Devonshire";
	$font["Didact_Gothic__400"] = "Didact Gothic";
	$font["Diplomata__400"] = "Diplomata";
	$font["Diplomata_SC__400"] = "Diplomata SC";
	$font["Domine__400,700"] = "Domine";
	$font["Donegal_One__400"] = "Donegal One";
	$font["Doppio_One__400"] = "Doppio One";
	$font["Dorsa__400"] = "Dorsa";
	$font["Dosis__200,300,400,500,600,700,800"] = "Dosis";
	$font["Dr_Sugiyama__400"] = "Dr Sugiyama";
	$font["Droid_Sans__400,700"] = "Droid Sans";
	$font["Droid_Sans_Mono__400"] = "Droid Sans Mono";
	$font["Droid_Serif__400,400italic,700,700italic"] = "Droid Serif";
	$font["Duru_Sans__400"] = "Duru Sans";
	$font["Dynalight__400"] = "Dynalight";
	$font["EB_Garamond__400"] = "EB Garamond";
	$font["Eagle_Lake__400"] = "Eagle Lake";
	$font["Eater__400"] = "Eater";
	$font["Economica__400,400italic,700,700italic"] = "Economica";
	$font["Electrolize__400"] = "Electrolize";
	$font["Elsie__400,900"] = "Elsie";
	$font["Elsie_Swash_Caps__400,900"] = "Elsie Swash Caps";
	$font["Emblema_One__400"] = "Emblema One";
	$font["Emilys_Candy__400"] = "Emilys Candy";
	$font["Engagement__400"] = "Engagement";
	$font["Englebert__400"] = "Englebert";
	$font["Enriqueta__400,700"] = "Enriqueta";
	$font["Erica_One__400"] = "Erica One";
	$font["Esteban__400"] = "Esteban";
	$font["Euphoria_Script__400"] = "Euphoria Script";
	$font["Ewert__400"] = "Ewert";
	$font["Exo__100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"] = "Exo";
	$font["Expletus_Sans__400,400italic,500,500italic,600,600italic,700,700italic"] = "Expletus Sans";
	$font["Fanwood_Text__400,400italic"] = "Fanwood Text";
	$font["Fascinate__400"] = "Fascinate";
	$font["Fascinate_Inline__400"] = "Fascinate Inline";
	$font["Faster_One__400"] = "Faster One";
	$font["Fasthand__400"] = "Fasthand";
	$font["Fauna_One__400"] = "Fauna One";
	$font["Federant__400"] = "Federant";
	$font["Federo__400"] = "Federo";
	$font["Felipa__400"] = "Felipa";
	$font["Fenix__400"] = "Fenix";
	$font["Finger_Paint__400"] = "Finger Paint";
	$font["Fjalla_One__400"] = "Fjalla One";
	$font["Fjord_One__400"] = "Fjord One";
	$font["Flamenco__300,400"] = "Flamenco";
	$font["Flavors__400"] = "Flavors";
	$font["Fondamento__400,400italic"] = "Fondamento";
	$font["Fontdiner_Swanky__400"] = "Fontdiner Swanky";
	$font["Forum__400"] = "Forum";
	$font["Francois_One__400"] = "Francois One";
	$font["Freckle_Face__400"] = "Freckle Face";
	$font["Fredericka_the_Great__400"] = "Fredericka the Great";
	$font["Fredoka_One__400"] = "Fredoka One";
	$font["Freehand__400"] = "Freehand";
	$font["Fresca__400"] = "Fresca";
	$font["Frijole__400"] = "Frijole";
	$font["Fruktur__400"] = "Fruktur";
	$font["Fugaz_One__400"] = "Fugaz One";
	$font["GFS_Didot__400"] = "GFS Didot";
	$font["GFS_Neohellenic__400,400italic,700,700italic"] = "GFS Neohellenic";
	$font["Gabriela__400"] = "Gabriela";
	$font["Gafata__400"] = "Gafata";
	$font["Galdeano__400"] = "Galdeano";
	$font["Galindo__400"] = "Galindo";
	$font["Gentium_Basic__400,400italic,700,700italic"] = "Gentium Basic";
	$font["Gentium_Book_Basic__400,400italic,700,700italic"] = "Gentium Book Basic";
	$font["Geo__400,400italic"] = "Geo";
	$font["Geostar__400"] = "Geostar";
	$font["Geostar_Fill__400"] = "Geostar Fill";
	$font["Germania_One__400"] = "Germania One";
	$font["Gilda_Display__400"] = "Gilda Display";
	$font["Give_You_Glory__400"] = "Give You Glory";
	$font["Glass_Antiqua__400"] = "Glass Antiqua";
	$font["Glegoo__400"] = "Glegoo";
	$font["Gloria_Hallelujah__400"] = "Gloria Hallelujah";
	$font["Goblin_One__400"] = "Goblin One";
	$font["Gochi_Hand__400"] = "Gochi Hand";
	$font["Gorditas__400,700"] = "Gorditas";
	$font["Goudy_Bookletter_1911__400"] = "Goudy Bookletter 1911";
	$font["Graduate__400"] = "Graduate";
	$font["Grand_Hotel__400"] = "Grand Hotel";
	$font["Gravitas_One__400"] = "Gravitas One";
	$font["Great_Vibes__400"] = "Great Vibes";
	$font["Griffy__400"] = "Griffy";
	$font["Gruppo__400"] = "Gruppo";
	$font["Gudea__400,400italic,700"] = "Gudea";
	$font["Habibi__400"] = "Habibi";
	$font["Hammersmith_One__400"] = "Hammersmith One";
	$font["Hanalei__400"] = "Hanalei";
	$font["Hanalei_Fill__400"] = "Hanalei Fill";
	$font["Handlee__400"] = "Handlee";
	$font["Hanuman__400,700"] = "Hanuman";
	$font["Happy_Monkey__400"] = "Happy Monkey";
	$font["Headland_One__400"] = "Headland One";
	$font["Henny_Penny__400"] = "Henny Penny";
	$font["Herr_Von_Muellerhoff__400"] = "Herr Von Muellerhoff";
	$font["Holtwood_One_SC__400"] = "Holtwood One SC";
	$font["Homemade_Apple__400"] = "Homemade Apple";
	$font["Homenaje__400"] = "Homenaje";
	$font["IM_Fell_DW_Pica__400,400italic"] = "IM Fell DW Pica";
	$font["IM_Fell_DW_Pica_SC__400"] = "IM Fell DW Pica SC";
	$font["IM_Fell_Double_Pica__400,400italic"] = "IM Fell Double Pica";
	$font["IM_Fell_Double_Pica_SC__400"] = "IM Fell Double Pica SC";
	$font["IM_Fell_English__400,400italic"] = "IM Fell English";
	$font["IM_Fell_English_SC__400"] = "IM Fell English SC";
	$font["IM_Fell_French_Canon__400,400italic"] = "IM Fell French Canon";
	$font["IM_Fell_French_Canon_SC__400"] = "IM Fell French Canon SC";
	$font["IM_Fell_Great_Primer__400,400italic"] = "IM Fell Great Primer";
	$font["IM_Fell_Great_Primer_SC__400"] = "IM Fell Great Primer SC";
	$font["Iceberg__400"] = "Iceberg";
	$font["Iceland__400"] = "Iceland";
	$font["Imprima__400"] = "Imprima";
	$font["Inconsolata__400,700"] = "Inconsolata";
	$font["Inder__400"] = "Inder";
	$font["Indie_Flower__400"] = "Indie Flower";
	$font["Inika__400,700"] = "Inika";
	$font["Irish_Grover__400"] = "Irish Grover";
	$font["Istok_Web__400,400italic,700,700italic"] = "Istok Web";
	$font["Italiana__400"] = "Italiana";
	$font["Italianno__400"] = "Italianno";
	$font["Jacques_Francois__400"] = "Jacques Francois";
	$font["Jacques_Francois_Shadow__400"] = "Jacques Francois Shadow";
	$font["Jim_Nightshade__400"] = "Jim Nightshade";
	$font["Jockey_One__400"] = "Jockey One";
	$font["Jolly_Lodger__400"] = "Jolly Lodger";
	$font["Josefin_Sans__100,100italic,300,300italic,400,400italic,600,600italic,700,700italic"] = "Josefin Sans";
	$font["Josefin_Slab__100,100italic,300,300italic,400,400italic,600,600italic,700,700italic"] = "Josefin Slab";
	$font["Joti_One__400"] = "Joti One";
	$font["Judson__400,400italic,700"] = "Judson";
	$font["Julee__400"] = "Julee";
	$font["Julius_Sans_One__400"] = "Julius Sans One";
	$font["Junge__400"] = "Junge";
	$font["Jura__300,400,500,600"] = "Jura";
	$font["Just_Another_Hand__400"] = "Just Another Hand";
	$font["Just_Me_Again_Down_Here__400"] = "Just Me Again Down Here";
	$font["Kameron__400,700"] = "Kameron";
	$font["Karla__400,400italic,700,700italic"] = "Karla";
	$font["Kaushan_Script__400"] = "Kaushan Script";
	$font["Kavoon__400"] = "Kavoon";
	$font["Keania_One__400"] = "Keania One";
	$font["Kelly_Slab__400"] = "Kelly Slab";
	$font["Kenia__400"] = "Kenia";
	$font["Khmer__400"] = "Khmer";
	$font["Kite_One__400"] = "Kite One";
	$font["Knewave__400"] = "Knewave";
	$font["Kotta_One__400"] = "Kotta One";
	$font["Koulen__400"] = "Koulen";
	$font["Kranky__400"] = "Kranky";
	$font["Kreon__300,400,700"] = "Kreon";
	$font["Kristi__400"] = "Kristi";
	$font["Krona_One__400"] = "Krona One";
	$font["La_Belle_Aurore__400"] = "La Belle Aurore";
	$font["Lancelot__400"] = "Lancelot";
	$font["Lato__100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"] = "Lato";
	$font["League_Script__400"] = "League Script";
	$font["Leckerli_One__400"] = "Leckerli One";
	$font["Ledger__400"] = "Ledger";
	$font["Lekton__400,400italic,700"] = "Lekton";
	$font["Lemon__400"] = "Lemon";
	$font["Libre_Baskerville__400,400italic,700"] = "Libre Baskerville";
	$font["Life_Savers__400,700"] = "Life Savers";
	$font["Lilita_One__400"] = "Lilita One";
	$font["Lily_Script_One__400"] = "Lily Script One";
	$font["Limelight__400"] = "Limelight";
	$font["Linden_Hill__400,400italic"] = "Linden Hill";
	$font["Lobster__400"] = "Lobster";
	$font["Lobster_Two__400,400italic,700,700italic"] = "Lobster Two";
	$font["Londrina_Outline__400"] = "Londrina Outline";
	$font["Londrina_Shadow__400"] = "Londrina Shadow";
	$font["Londrina_Sketch__400"] = "Londrina Sketch";
	$font["Londrina_Solid__400"] = "Londrina Solid";
	$font["Lora__400,400italic,700,700italic"] = "Lora";
	$font["Love_Ya_Like_A_Sister__400"] = "Love Ya Like A Sister";
	$font["Loved_by_the_King__400"] = "Loved by the King";
	$font["Lovers_Quarrel__400"] = "Lovers Quarrel";
	$font["Luckiest_Guy__400"] = "Luckiest Guy";
	$font["Lusitana__400,700"] = "Lusitana";
	$font["Lustria__400"] = "Lustria";
	$font["Macondo__400"] = "Macondo";
	$font["Macondo_Swash_Caps__400"] = "Macondo Swash Caps";
	$font["Magra__400,700"] = "Magra";
	$font["Maiden_Orange__400"] = "Maiden Orange";
	$font["Mako__400"] = "Mako";
	$font["Marcellus__400"] = "Marcellus";
	$font["Marcellus_SC__400"] = "Marcellus SC";
	$font["Marck_Script__400"] = "Marck Script";
	$font["Margarine__400"] = "Margarine";
	$font["Marko_One__400"] = "Marko One";
	$font["Marmelad__400"] = "Marmelad";
	$font["Marvel__400,400italic,700,700italic"] = "Marvel";
	$font["Mate__400,400italic"] = "Mate";
	$font["Mate_SC__400"] = "Mate SC";
	$font["Maven_Pro__400,500,700,900"] = "Maven Pro";
	$font["McLaren__400"] = "McLaren";
	$font["Meddon__400"] = "Meddon";
	$font["MedievalSharp__400"] = "MedievalSharp";
	$font["Medula_One__400"] = "Medula One";
	$font["Megrim__400"] = "Megrim";
	$font["Meie_Script__400"] = "Meie Script";
	$font["Merienda__400,700"] = "Merienda";
	$font["Merienda_One__400"] = "Merienda One";
	$font["Merriweather__300,300italic,400,400italic,700,700italic,900,900italic"] = "Merriweather";
	$font["Merriweather_Sans__300,300italic,400,400italic,700,700italic,800,800italic"] = "Merriweather Sans";
	$font["Metal__400"] = "Metal";
	$font["Metal_Mania__400"] = "Metal Mania";
	$font["Metamorphous__400"] = "Metamorphous";
	$font["Metrophobic__400"] = "Metrophobic";
	$font["Michroma__400"] = "Michroma";
	$font["Milonga__400"] = "Milonga";
	$font["Miltonian__400"] = "Miltonian";
	$font["Miltonian_Tattoo__400"] = "Miltonian Tattoo";
	$font["Miniver__400"] = "Miniver";
	$font["Miss_Fajardose__400"] = "Miss Fajardose";
	$font["Modern_Antiqua__400"] = "Modern Antiqua";
	$font["Molengo__400"] = "Molengo";
	$font["Molle__400italic"] = "Molle";
	$font["Monda__400,700"] = "Monda";
	$font["Monofett__400"] = "Monofett";
	$font["Monoton__400"] = "Monoton";
	$font["Monsieur_La_Doulaise__400"] = "Monsieur La Doulaise";
	$font["Montaga__400"] = "Montaga";
	$font["Montez__400"] = "Montez";
	$font["Montserrat__400,700"] = "Montserrat";
	$font["Montserrat_Alternates__400,700"] = "Montserrat Alternates";
	$font["Montserrat_Subrayada__400,700"] = "Montserrat Subrayada";
	$font["Moul__400"] = "Moul";
	$font["Moulpali__400"] = "Moulpali";
	$font["Mountains_of_Christmas__400,700"] = "Mountains of Christmas";
	$font["Mouse_Memoirs__400"] = "Mouse Memoirs";
	$font["Mr_Bedfort__400"] = "Mr Bedfort";
	$font["Mr_Dafoe__400"] = "Mr Dafoe";
	$font["Mr_De_Haviland__400"] = "Mr De Haviland";
	$font["Mrs_Saint_Delafield__400"] = "Mrs Saint Delafield";
	$font["Mrs_Sheppards__400"] = "Mrs Sheppards";
	$font["Muli__300,300italic,400,400italic"] = "Muli";
	$font["Mystery_Quest__400"] = "Mystery Quest";
	$font["Neucha__400"] = "Neucha";
	$font["Neuton__200,300,400,400italic,700,800"] = "Neuton";
	$font["New_Rocker__400"] = "New Rocker";
	$font["News_Cycle__400,700"] = "News Cycle";
	$font["Niconne__400"] = "Niconne";
	$font["Nixie_One__400"] = "Nixie One";
	$font["Nobile__400,400italic,700,700italic"] = "Nobile";
	$font["Nokora__400,700"] = "Nokora";
	$font["Norican__400"] = "Norican";
	$font["Nosifer__400"] = "Nosifer";
	$font["Nothing_You_Could_Do__400"] = "Nothing You Could Do";
	$font["Noticia_Text__400,400italic,700,700italic"] = "Noticia Text";
	$font["Noto_Sans__400,400italic,700,700italic"] = "Noto Sans";
	$font["Noto_Serif__400,400italic,700,700italic"] = "Noto Serif";
	$font["Nova_Cut__400"] = "Nova Cut";
	$font["Nova_Flat__400"] = "Nova Flat";
	$font["Nova_Mono__400"] = "Nova Mono";
	$font["Nova_Oval__400"] = "Nova Oval";
	$font["Nova_Round__400"] = "Nova Round";
	$font["Nova_Script__400"] = "Nova Script";
	$font["Nova_Slim__400"] = "Nova Slim";
	$font["Nova_Square__400"] = "Nova Square";
	$font["Numans__400"] = "Numans";
	$font["Nunito__300,400,700"] = "Nunito";
	$font["Odor_Mean_Chey__400"] = "Odor Mean Chey";
	$font["Offside__400"] = "Offside";
	$font["Old_Standard_TT__400,400italic,700"] = "Old Standard TT";
	$font["Oldenburg__400"] = "Oldenburg";
	$font["Oleo_Script__400,700"] = "Oleo Script";
	$font["Oleo_Script_Swash_Caps__400,700"] = "Oleo Script Swash Caps";
	$font["Open_Sans__300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"] = "Open Sans";
	$font["Open_Sans_Condensed__300,300italic,700"] = "Open Sans Condensed";
	$font["Oranienbaum__400"] = "Oranienbaum";
	$font["Orbitron__400,500,700,900"] = "Orbitron";
	$font["Oregano__400,400italic"] = "Oregano";
	$font["Orienta__400"] = "Orienta";
	$font["Original_Surfer__400"] = "Original Surfer";
	$font["Oswald__300,400,700"] = "Oswald";
	$font["Over_the_Rainbow__400"] = "Over the Rainbow";
	$font["Overlock__400,400italic,700,700italic,900,900italic"] = "Overlock";
	$font["Overlock_SC__400"] = "Overlock SC";
	$font["Ovo__400"] = "Ovo";
	$font["Oxygen__300,400,700"] = "Oxygen";
	$font["Oxygen_Mono__400"] = "Oxygen Mono";
	$font["PT_Mono__400"] = "PT Mono";
	$font["PT_Sans__400,400italic,700,700italic"] = "PT Sans";
	$font["PT_Sans_Caption__400,700"] = "PT Sans Caption";
	$font["PT_Sans_Narrow__400,700"] = "PT Sans Narrow";
	$font["PT_Serif__400,400italic,700,700italic"] = "PT Serif";
	$font["PT_Serif_Caption__400,400italic"] = "PT Serif Caption";
	$font["Pacifico__400"] = "Pacifico";
	$font["Paprika__400"] = "Paprika";
	$font["Parisienne__400"] = "Parisienne";
	$font["Passero_One__400"] = "Passero One";
	$font["Passion_One__400,700,900"] = "Passion One";
	$font["Pathway_Gothic_One__400"] = "Pathway Gothic One";
	$font["Patrick_Hand__400"] = "Patrick Hand";
	$font["Patrick_Hand_SC__400"] = "Patrick Hand SC";
	$font["Patua_One__400"] = "Patua One";
	$font["Paytone_One__400"] = "Paytone One";
	$font["Peralta__400"] = "Peralta";
	$font["Permanent_Marker__400"] = "Permanent Marker";
	$font["Petit_Formal_Script__400"] = "Petit Formal Script";
	$font["Petrona__400"] = "Petrona";
	$font["Philosopher__400,400italic,700,700italic"] = "Philosopher";
	$font["Piedra__400"] = "Piedra";
	$font["Pinyon_Script__400"] = "Pinyon Script";
	$font["Pirata_One__400"] = "Pirata One";
	$font["Plaster__400"] = "Plaster";
	$font["Play__400,700"] = "Play";
	$font["Playball__400"] = "Playball";
	$font["Playfair_Display__400,400italic,700,700italic,900,900italic"] = "Playfair Display";
	$font["Playfair_Display_SC__400,400italic,700,700italic,900,900italic"] = "Playfair Display SC";
	$font["Podkova__400,700"] = "Podkova";
	$font["Poiret_One__400"] = "Poiret One";
	$font["Poller_One__400"] = "Poller One";
	$font["Poly__400,400italic"] = "Poly";
	$font["Pompiere__400"] = "Pompiere";
	$font["Pontano_Sans__400"] = "Pontano Sans";
	$font["Port_Lligat_Sans__400"] = "Port Lligat Sans";
	$font["Port_Lligat_Slab__400"] = "Port Lligat Slab";
	$font["Prata__400"] = "Prata";
	$font["Preahvihear__400"] = "Preahvihear";
	$font["Press_Start_2P__400"] = "Press Start 2P";
	$font["Princess_Sofia__400"] = "Princess Sofia";
	$font["Prociono__400"] = "Prociono";
	$font["Prosto_One__400"] = "Prosto One";
	$font["Puritan__400,400italic,700,700italic"] = "Puritan";
	$font["Purple_Purse__400"] = "Purple Purse";
	$font["Quando__400"] = "Quando";
	$font["Quantico__400,400italic,700,700italic"] = "Quantico";
	$font["Quattrocento__400,700"] = "Quattrocento";
	$font["Quattrocento_Sans__400,400italic,700,700italic"] = "Quattrocento Sans";
	$font["Questrial__400"] = "Questrial";
	$font["Quicksand__300,400,700"] = "Quicksand";
	$font["Quintessential__400"] = "Quintessential";
	$font["Qwigley__400"] = "Qwigley";
	$font["Racing_Sans_One__400"] = "Racing Sans One";
	$font["Radley__400,400italic"] = "Radley";
	$font["Raleway__100,200,300,400,500,600,700,800,900"] = "Raleway";
	$font["Raleway_Dots__400"] = "Raleway Dots";
	$font["Rambla__400,400italic,700,700italic"] = "Rambla";
	$font["Rammetto_One__400"] = "Rammetto One";
	$font["Ranchers__400"] = "Ranchers";
	$font["Rancho__400"] = "Rancho";
	$font["Rationale__400"] = "Rationale";
	$font["Redressed__400"] = "Redressed";
	$font["Reenie_Beanie__400"] = "Reenie Beanie";
	$font["Revalia__400"] = "Revalia";
	$font["Ribeye__400"] = "Ribeye";
	$font["Ribeye_Marrow__400"] = "Ribeye Marrow";
	$font["Righteous__400"] = "Righteous";
	$font["Risque__400"] = "Risque";
	$font["Roboto__100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic"] = "Roboto";
	$font["Roboto_Condensed__300,300italic,400,400italic,700,700italic"] = "Roboto Condensed";
	$font["Roboto_Slab__100,300,400,700"] = "Roboto Slab";
	$font["Rochester__400"] = "Rochester";
	$font["Rock_Salt__400"] = "Rock Salt";
	$font["Rokkitt__400,700"] = "Rokkitt";
	$font["Romanesco__400"] = "Romanesco";
	$font["Ropa_Sans__400,400italic"] = "Ropa Sans";
	$font["Rosario__400,400italic,700,700italic"] = "Rosario";
	$font["Rosarivo__400,400italic"] = "Rosarivo";
	$font["Rouge_Script__400"] = "Rouge Script";
	$font["Ruda__400,700,900"] = "Ruda";
	$font["Rufina__400,700"] = "Rufina";
	$font["Ruge_Boogie__400"] = "Ruge Boogie";
	$font["Ruluko__400"] = "Ruluko";
	$font["Rum_Raisin__400"] = "Rum Raisin";
	$font["Ruslan_Display__400"] = "Ruslan Display";
	$font["Russo_One__400"] = "Russo One";
	$font["Ruthie__400"] = "Ruthie";
	$font["Rye__400"] = "Rye";
	$font["Sacramento__400"] = "Sacramento";
	$font["Sail__400"] = "Sail";
	$font["Salsa__400"] = "Salsa";
	$font["Sanchez__400,400italic"] = "Sanchez";
	$font["Sancreek__400"] = "Sancreek";
	$font["Sansita_One__400"] = "Sansita One";
	$font["Sarina__400"] = "Sarina";
	$font["Satisfy__400"] = "Satisfy";
	$font["Scada__400,400italic,700,700italic"] = "Scada";
	$font["Schoolbell__400"] = "Schoolbell";
	$font["Seaweed_Script__400"] = "Seaweed Script";
	$font["Sevillana__400"] = "Sevillana";
	$font["Seymour_One__400"] = "Seymour One";
	$font["Shadows_Into_Light__400"] = "Shadows Into Light";
	$font["Shadows_Into_Light_Two__400"] = "Shadows Into Light Two";
	$font["Shanti__400"] = "Shanti";
	$font["Share__400,400italic,700,700italic"] = "Share";
	$font["Share_Tech__400"] = "Share Tech";
	$font["Share_Tech_Mono__400"] = "Share Tech Mono";
	$font["Shojumaru__400"] = "Shojumaru";
	$font["Short_Stack__400"] = "Short Stack";
	$font["Siemreap__400"] = "Siemreap";
	$font["Sigmar_One__400"] = "Sigmar One";
	$font["Signika__300,400,600,700"] = "Signika";
	$font["Signika_Negative__300,400,600,700"] = "Signika Negative";
	$font["Simonetta__400,400italic,900,900italic"] = "Simonetta";
	$font["Sintony__400,700"] = "Sintony";
	$font["Sirin_Stencil__400"] = "Sirin Stencil";
	$font["Six_Caps__400"] = "Six Caps";
	$font["Skranji__400,700"] = "Skranji";
	$font["Slackey__400"] = "Slackey";
	$font["Smokum__400"] = "Smokum";
	$font["Smythe__400"] = "Smythe";
	$font["Sniglet__800"] = "Sniglet";
	$font["Snippet__400"] = "Snippet";
	$font["Snowburst_One__400"] = "Snowburst One";
	$font["Sofadi_One__400"] = "Sofadi One";
	$font["Sofia__400"] = "Sofia";
	$font["Sonsie_One__400"] = "Sonsie One";
	$font["Sorts_Mill_Goudy__400,400italic"] = "Sorts Mill Goudy";
	$font["Source_Code_Pro__200,300,400,500,600,700,900"] = "Source Code Pro";
	$font["Source_Sans_Pro__200,200italic,300,300italic,400,400italic,600,600italic,700,700italic,900,900italic"] = "Source Sans Pro";
	$font["Special_Elite__400"] = "Special Elite";
	$font["Spicy_Rice__400"] = "Spicy Rice";
	$font["Spinnaker__400"] = "Spinnaker";
	$font["Spirax__400"] = "Spirax";
	$font["Squada_One__400"] = "Squada One";
	$font["Stalemate__400"] = "Stalemate";
	$font["Stalinist_One__400"] = "Stalinist One";
	$font["Stardos_Stencil__400,700"] = "Stardos Stencil";
	$font["Stint_Ultra_Condensed__400"] = "Stint Ultra Condensed";
	$font["Stint_Ultra_Expanded__400"] = "Stint Ultra Expanded";
	$font["Stoke__300,400"] = "Stoke";
	$font["Strait__400"] = "Strait";
	$font["Sue_Ellen_Francisco__400"] = "Sue Ellen Francisco";
	$font["Sunshiney__400"] = "Sunshiney";
	$font["Supermercado_One__400"] = "Supermercado One";
	$font["Suwannaphum__400"] = "Suwannaphum";
	$font["Swanky_and_Moo_Moo__400"] = "Swanky and Moo Moo";
	$font["Syncopate__400,700"] = "Syncopate";
	$font["Tangerine__400,700"] = "Tangerine";
	$font["Taprom__400"] = "Taprom";
	$font["Tauri__400"] = "Tauri";
	$font["Telex__400"] = "Telex";
	$font["Tenor_Sans__400"] = "Tenor Sans";
	$font["Text_Me_One__400"] = "Text Me One";
	$font["The_Girl_Next_Door__400"] = "The Girl Next Door";
	$font["Tienne__400,700,900"] = "Tienne";
	$font["Tinos__400,400italic,700,700italic"] = "Tinos";
	$font["Titan_One__400"] = "Titan One";
	$font["Titillium_Web__200,200italic,300,300italic,400,400italic,600,600italic,700,700italic,900"] = "Titillium Web";
	$font["Trade_Winds__400"] = "Trade Winds";
	$font["Trocchi__400"] = "Trocchi";
	$font["Trochut__400,400italic,700"] = "Trochut";
	$font["Trykker__400"] = "Trykker";
	$font["Tulpen_One__400"] = "Tulpen One";
	$font["Ubuntu__300,300italic,400,400italic,500,500italic,700,700italic"] = "Ubuntu";
	$font["Ubuntu_Condensed__400"] = "Ubuntu Condensed";
	$font["Ubuntu_Mono__400,400italic,700,700italic"] = "Ubuntu Mono";
	$font["Ultra__400"] = "Ultra";
	$font["Uncial_Antiqua__400"] = "Uncial Antiqua";
	$font["Underdog__400"] = "Underdog";
	$font["Unica_One__400"] = "Unica One";
	$font["UnifrakturCook__700"] = "UnifrakturCook";
	$font["UnifrakturMaguntia__400"] = "UnifrakturMaguntia";
	$font["Unkempt__400,700"] = "Unkempt";
	$font["Unlock__400"] = "Unlock";
	$font["Unna__400"] = "Unna";
	$font["VT323__400"] = "VT323";
	$font["Vampiro_One__400"] = "Vampiro One";
	$font["Varela__400"] = "Varela";
	$font["Varela_Round__400"] = "Varela Round";
	$font["Vast_Shadow__400"] = "Vast Shadow";
	$font["Vibur__400"] = "Vibur";
	$font["Vidaloka__400"] = "Vidaloka";
	$font["Viga__400"] = "Viga";
	$font["Voces__400"] = "Voces";
	$font["Volkhov__400,400italic,700,700italic"] = "Volkhov";
	$font["Vollkorn__400,400italic,700,700italic"] = "Vollkorn";
	$font["Voltaire__400"] = "Voltaire";
	$font["Waiting_for_the_Sunrise__400"] = "Waiting for the Sunrise";
	$font["Wallpoet__400"] = "Wallpoet";
	$font["Walter_Turncoat__400"] = "Walter Turncoat";
	$font["Warnes__400"] = "Warnes";
	$font["Wellfleet__400"] = "Wellfleet";
	$font["Wendy_One__400"] = "Wendy One";
	$font["Wire_One__400"] = "Wire One";
	$font["Yanone_Kaffeesatz__200,300,400,700"] = "Yanone Kaffeesatz";
	$font["Yellowtail__400"] = "Yellowtail";
	$font["Yeseva_One__400"] = "Yeseva One";
	$font["Yesteryear__400"] = "Yesteryear";
	$font["Zeyada__400"] = "Zeyada";

	return $font;
}


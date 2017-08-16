<?php

function customizer_wrapper_settings( $wp_customize ) {

	$settings = array();

	$settings = apply_filters( 'customizer_wrapper_settings', $settings );
	$i = 1;
	foreach ( $settings as $setting ) {
		$wp_customize->add_setting( $setting[ 'id' ], array(
			'default' => empty( $setting[ 'default' ] ) ? null : $setting[ 'default' ],
			'transport' => empty( $setting[ 'transport' ] ) ? null : $setting[ 'transport' ],
			'capability' => empty( $setting[ 'capability' ] ) ? 'edit_theme_options' : $setting[ 'capability' ],
			'theme_supports' => empty( $setting[ 'theme_supports' ] ) ? null : $setting[ 'theme_supports' ],
			'sanitize_callback' => empty( $setting[ 'sanitize_callback' ] ) ? null : $setting[ 'sanitize_callback' ],
			'sanitize_js_callback' => empty( $setting[ 'sanitize_js_callback' ] ) ? null : $setting[ 'sanitize_js_callback' ],
			'type' => empty( $setting[ 'type' ] ) ? null : $setting[ 'type' ],
		) );

		$setting['control_id'] = empty( $setting['control_id'] ) ? $setting['id'] : $setting['control_id']; 

		if ( 'image' === $setting[ 'control' ] ) {
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting['control_id'],
				array(
					'label' => empty( $setting[ 'label' ] ) ? null : $setting[ 'label' ],
					'section' => empty( $setting[ 'section' ] ) ? null : $setting[ 'section' ],
					'settings' => $setting['id'],
					'priority' => empty( $setting[ 'priority' ] ) ? $i : $setting[ 'priority' ],
					'active_callback' => empty( $setting[ 'active_callback' ] ) ? null : $setting[ 'active_callback' ],
					'description' => empty( $setting[ 'description' ] ) ? null : $setting[ 'description' ],
				)
			) );
		} else if ( 'color' === $setting[ 'control' ] ) {
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting['control_id'],
				array(
					'label' => empty( $setting[ 'label' ] ) ? null : $setting[ 'label' ],
					'section' => empty( $setting[ 'section' ] ) ? null : $setting[ 'section' ],
					'settings' => $setting['id'],
					'priority' => empty( $setting[ 'priority' ] ) ? $i : $setting[ 'priority' ],
					'active_callback' => empty( $setting[ 'active_callback' ] ) ? null : $setting[ 'active_callback' ],
					'description' => empty( $setting[ 'description' ] ) ? null : $setting[ 'description' ],
				)
			) );
		} else if ( 'radio-image' === $setting[ 'control' ] ) {
			$wp_customize->add_control( new Plus62_Customize_Image_Select_Control( $wp_customize, $setting['control_id'],
				array(
					'label' => empty( $setting[ 'label' ] ) ? null : $setting[ 'label' ],
					'section' => empty( $setting[ 'section' ] ) ? null : $setting[ 'section' ],
					'settings' => $setting['id'],
					'priority' => empty( $setting[ 'priority' ] ) ? $i : $setting[ 'priority' ],
					'active_callback' => empty( $setting[ 'active_callback' ] ) ? null : $setting[ 'active_callback' ],
					'choices' => $setting['choices'],
					'column' => $setting['column'],
					'description' => empty( $setting[ 'description' ] ) ? null : $setting[ 'description' ],
				)
			) );
		} else {
			$wp_customize->add_control( $setting[ 'control_id' ], array(
				'settings' => $setting['id'],
				'label' => empty( $setting[ 'label' ] ) ? null : $setting[ 'label' ],
				'section' => empty( $setting[ 'section' ] ) ? null : $setting[ 'section' ],
				'type' => empty( $setting[ 'control' ] ) ? null : $setting[ 'control' ],
				'choices' => empty( $setting[ 'choices' ] ) ? null : $setting[ 'choices' ],
				'input_attrs' => empty( $setting[ 'input_attrs' ] ) ? null : $setting[ 'input_attrs' ],
				'priority' => empty( $setting[ 'priority' ] ) ? $i : $setting[ 'priority' ],
				'active_callback' => empty( $setting[ 'active_callback' ] ) ? null : $setting[ 'active_callback' ],
				'description' => empty( $setting[ 'description' ] ) ? null : $setting[ 'description' ],
			) );
		}

		$i++;
	}
}
add_action( 'customize_register', 'customizer_wrapper_settings', 100, 1 );


function apply_customizer_css(){

	$settings = array();
	$settings = apply_filters( 'apply_customizer_css', $settings );

	$css = '';
	$customize_js_var = array();

	$selectors = array();
	$media_queries = array();

	foreach ( $settings as $setting ) {

		if ( isset( $setting['type'] ) && $setting['type'] == 'option' ){
			$value = get_option( $setting['id'] );
		}else{
			$value = get_theme_mod($setting['id']);
		}

		if ( !empty( $setting['apply_css'] ) && is_array($setting['apply_css']) ){

			foreach ( $setting['apply_css'] as $apply_css ){
				$mq = empty( $apply_css['media_query'] ) ? 'global' : $apply_css['media_query'];
				$selector = empty( $apply_css['selector'] ) ? '' : $apply_css['selector'];
				$property = empty( $apply_css['property'] ) ? '' : $apply_css['property'];
				$unit = empty( $apply_css['unit'] ) ? '' : $apply_css['unit'];
				$value_in_text = empty( $apply_css['value_in_text'] ) ? '' : $apply_css['value_in_text'];


				if ( $value && ( $value !== $setting['default'] ) ){


					if ( !isset($media_queries[$mq][$selector]) ) {
						$media_queries[$mq][$selector] = '';
					}

					if ( isset($apply_css['value_in_text']) ) {

						$media_queries[$mq][$selector] .= $property . ': ' . str_replace('%value%', $value, $value_in_text) . ' ;';

					}else{

						$media_queries[$mq][$selector] .= $property . ': ' . $value . $unit . ' ;';

					}

				}

				if ( $setting['transport'] == 'postMessage'){
					$customize_js_var[] = 
						array ( 
							'id' => $setting['id'],
							'default' => isset($setting['default']) ? $setting['default'] : null,
							'selector' => $selector,
							'property' =>$property,
							'unit' => $unit,
							'value_in_text' => $value_in_text,
							'mq' => $mq,
						);
				}

			}

		}
	}

	foreach ( $media_queries as $mq => $selectors ) {
		if ( $mq !== 'global' ) $css .= $mq . " {\n";
		foreach ( $selectors as $selector => $value ) {
			$css .= $selector . " { " . $value . "}\n";			
		}
		if ( $mq !== 'global' ) $css .= "}\n";
	}

	/*foreach ($selectors as $selector => $value ) {
		$css .= $selector . " { " . $value . "}\n";
	}*/

	//if ( $css ) 
	$css = '<style id="apply-customizer-css" >'  . "\n" . $css  . '</style>';


	$js_var = json_encode( $customize_js_var );

	echo $css;
	echo "\n";

	if ( $js_var && !empty($GLOBALS['wp_customize']) ){
		echo '<script type="text/javascript">' . "\n";
		echo '	var _customizerCSS = ' . $js_var . ';' . "\n";
		echo '</script>' . "\n";
		echo "\n";
	}

}
add_action('wp_head', 'apply_customizer_css' );


function plus62_add_image_select_control(){
	if ( class_exists('WP_Customize_Control') ){
		/**
		 * Adds radio-image support to the theme customizer
		 */
		class Plus62_Customize_Image_Select_Control extends WP_Customize_Control {

			public $type = 'radio-image';

			public $column = 4;

			public function enqueue() {
				wp_enqueue_style( 'riveted-customize-image-select', get_template_directory_uri() . '/css/customize-image-select.css' );
			}
		
			public function render_content() {


				if ( empty( $this->choices ) )
					return;

				$name = '_customize-radio-image' . $this->id;
			
				if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif;

				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo $this->description ; ?></span>
				<?php endif;

				$column = empty($this->column) ? 2 : $this->column ;
				$image_width = 1 / $column * 100;
				?>
				<div class="customize-radio-image-choices-wrapper">
					<?php

					foreach ( $this->choices as $value => $img ) :
					?>
						<label style='width:<?php echo $image_width; ?>%'>
							<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
							<img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>" />
						</label>
					<?php
					endforeach;
					?>
				</div> <?php
			}
		}

	}
}

add_action( 'customize_register', 'plus62_add_image_select_control' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wpkube_customize_preview_js() {
	wp_enqueue_script( 'wpkube_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'wpkube_customize_preview_js' );

/**
 * Binds JS handlers for the helper in the customizer admin.
 */
function wpkube_customize_admin_js() {
	wp_enqueue_script( 'wpkube_customizer_admin', get_template_directory_uri() . '/js/customizer-admin.js', array( ), '20141114', true );
	//wp_enqueue_style( 'wpkube_customizer_admin_style', get_template_directory_uri() . '/css/admin-customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'wpkube_customize_admin_js' );


?>
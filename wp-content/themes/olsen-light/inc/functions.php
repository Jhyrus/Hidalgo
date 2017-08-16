<?php
if ( ! function_exists( 'olsen_light_get_social_networks') ) {
	function olsen_light_get_social_networks() {
		return array(
			array(
				'name'  => 'facebook',
				'label' => esc_html__( 'Facebook', 'olsen-light' ),
				'icon'  => 'fa-facebook'
			),
			array(
				'name'  => 'twitter',
				'label' => esc_html__( 'Twitter', 'olsen-light' ),
				'icon'  => 'fa-twitter'
			),
			array(
				'name'  => 'pinterest',
				'label' => esc_html__( 'Pinterest', 'olsen-light' ),
				'icon'  => 'fa-pinterest'
			),
			array(
				'name'  => 'instagram',
				'label' => esc_html__( 'Instagram', 'olsen-light' ),
				'icon'  => 'fa-instagram'
			),
			array(
				'name'  => 'gplus',
				'label' => esc_html__( 'Google Plus', 'olsen-light' ),
				'icon'  => 'fa-google-plus'
			),
			array(
				'name'  => 'linkedin',
				'label' => esc_html__( 'LinkedIn', 'olsen-light' ),
				'icon'  => 'fa-linkedin'
			),
			array(
				'name'  => 'tumblr',
				'label' => esc_html__( 'Tumblr', 'olsen-light' ),
				'icon'  => 'fa-tumblr'
			),
			array(
				'name'  => 'flickr',
				'label' => esc_html__( 'Flickr', 'olsen-light' ),
				'icon'  => 'fa-flickr'
			),
			array(
				'name'  => 'bloglovin',
				'label' => esc_html__( 'Bloglovin', 'olsen-light' ),
				'icon'  => 'fa-heart'
			),
			array(
				'name'  => 'youtube',
				'label' => esc_html__( 'YouTube', 'olsen-light' ),
				'icon'  => 'fa-youtube'
			),
			array(
				'name'  => 'vimeo',
				'label' => esc_html__( 'Vimeo', 'olsen-light' ),
				'icon'  => 'fa-vimeo'
			),
			array(
				'name'  => 'dribbble',
				'label' => esc_html__( 'Dribbble', 'olsen-light' ),
				'icon'  => 'fa-dribbble'
			),
			array(
				'name'  => 'wordpress',
				'label' => esc_html__( 'WordPress', 'olsen-light' ),
				'icon'  => 'fa-wordpress'
			),
			array(
				'name'  => '500px',
				'label' => esc_html__( '500px', 'olsen-light' ),
				'icon'  => 'fa-500px'
			),
			array(
				'name'  => 'soundcloud',
				'label' => esc_html__( 'Soundcloud', 'olsen-light' ),
				'icon'  => 'fa-soundcloud'
			),
			array(
				'name'  => 'spotify',
				'label' => esc_html__( 'Spotify', 'olsen-light' ),
				'icon'  => 'fa-spotify'
			),
			array(
				'name'  => 'vine',
				'label' => esc_html__( 'Vine', 'olsen-light' ),
				'icon'  => 'fa-vine'
			),
		);
	}
}



if ( ! function_exists( 'olsen_light_pagination' ) ):
	/**
	 * Echoes pagination links if applicable. Output depends on pagination method selected from the customizer.
	 *
	 * @param array $args An array of arguments to change default behavior.
	 * @param object|bool $query A WP_Query object to paginate. Defaults to boolean false and uses the global $wp_query
	 *
	 * @return void
	 */
	function olsen_light_pagination( $args = array(), $query = false ) {
		$args = wp_parse_args( $args, apply_filters( 'olsen_light_pagination_default_args', array(
			'container_id'        => 'paging',
			'container_class'     => 'group',
			'prev_text'           => esc_html__( 'Previous page', 'olsen-light' ),
			'next_text'           => esc_html__( 'Next page', 'olsen-light' ),
			'paginate_links_args' => array()
		) ) );

		if ( 'object' != gettype( $query ) || 'WP_Query' != get_class( $query ) ) {
			global $wp_query;
			$query = $wp_query;
		}

		// Set things up for paginate_links()
		$unreal_pagenum = 999999999;
		$permastruct    = get_option( 'permalink_structure' );

		$paginate_links_args = wp_parse_args( $args['paginate_links_args'], array(
			'base'    => str_replace( $unreal_pagenum, '%#%', esc_url( get_pagenum_link( $unreal_pagenum ) ) ),
			'format'  => empty( $permastruct ) ? '&page=%#%' : 'page/%#%/',
			'total'   => $query->max_num_pages,
			'current' => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
		) );

		$method = get_theme_mod( 'pagination_method', 'numbers' );

		if ( $query->max_num_pages > 1 ) {
			?>
			<div
			<?php echo empty( $args['container_id'] ) ? '' : 'id="' . esc_attr( $args['container_id'] ) . '"'; ?>
			<?php echo empty( $args['container_class'] ) ? '' : 'class="' . esc_attr( $args['container_class'] ) . '"'; ?>
			><?php

			switch ( $method ) {
				case 'text':
					previous_posts_link( $args['prev_text'] );
					next_posts_link( $args['next_text'], $query->max_num_pages );
					break;
				case 'numbers':
				default:
					echo paginate_links( $paginate_links_args );
					break;
			}

			?></div><?php
		}

	}
endif;

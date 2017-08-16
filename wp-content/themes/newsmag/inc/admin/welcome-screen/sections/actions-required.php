<?php
/**
 * Actions required
 */

wp_enqueue_style( 'plugin-install' );
wp_enqueue_script( 'plugin-install' );
wp_enqueue_script( 'updates' );
?>

<div class="feature-section action-required demo-import-boxed" id="plugin-filter">

	<?php
	global $newsmag_required_actions;

	if ( ! empty( $newsmag_required_actions ) ):

		/* newsmag_show_required_actions is an array of true/false for each required action that was dismissed */
		$newsmag_show_required_actions = get_option( "newsmag_show_required_actions" );
		$hooray = true;

		foreach ( $newsmag_required_actions as $newsmag_required_action_key => $newsmag_required_action_value ):
			$hidden = false;
			if ( @$newsmag_show_required_actions[ $newsmag_required_action_value['id'] ] === false ) {
				$hidden = true;
			}
			if ( @$newsmag_required_action_value['check'] ) {
				continue;
			}
			?>
			<div class="newsmag-action-required-box">
				<?php if ( ! $hidden ): ?>
					<span data-action="dismiss" class="dashicons dashicons-visibility newsmag-required-action-button"
					      id="<?php echo esc_attr( $newsmag_required_action_value['id'] ); ?>"></span>
				<?php else: ?>
					<span data-action="add" class="dashicons dashicons-hidden newsmag-required-action-button"
					      id="<?php echo esc_attr( $newsmag_required_action_value['id'] ); ?>"></span>
				<?php endif; ?>
				<h3><?php if ( ! empty( $newsmag_required_action_value['title'] ) ): echo esc_html( $newsmag_required_action_value['title'] ); endif; ?></h3>
				<p>
					<?php if ( ! empty( $newsmag_required_action_value['description'] ) ): echo esc_html( $newsmag_required_action_value['description'] ); endif; ?>
					<?php if ( ! empty( $newsmag_required_action_value['help'] ) ): echo '<br/>' . wp_kses_post( $newsmag_required_action_value['help'] ); endif; ?>
				</p>
				<?php
				if ( ! empty( $newsmag_required_action_value['plugin_slug'] ) ) {
					$active = $this->check_active( $newsmag_required_action_value['plugin_slug'] );
					$url    = $this->create_action_link( $active['needs'], $newsmag_required_action_value['plugin_slug'] );
					$label  = '';

					switch ( $active['needs'] ) {
						case 'install':
							$class = 'install-now button';
							$label = __( 'Install', 'newsmag' );
							break;
						case 'activate':
							$class = 'activate-now button button-primary';
							$label = __( 'Activate', 'newsmag' );
							break;
						case 'deactivate':
							$class = 'deactivate-now button';
							$label = __( 'Deactivate', 'newsmag' );
							break;
					}

					?>
					<p class="plugin-card-<?php echo esc_attr( $newsmag_required_action_value['plugin_slug'] ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
						<a data-slug="<?php echo esc_attr( $newsmag_required_action_value['plugin_slug'] ) ?>"
						   class="<?php echo esc_attr( $class ); ?>"
						   href="<?php echo esc_url( $url ) ?>"> <?php echo esc_html( $label ) ?> </a>
					</p>
					<?php
				};
				?>
			</div>
			<?php
			$hooray = false;
		endforeach;
	endif;

	if ( $hooray ):
		echo '<span class="hooray">' . __( 'Hooray! There are no required actions for you right now.', 'newsmag' ) . '</span>';
	endif;
	?>

</div>

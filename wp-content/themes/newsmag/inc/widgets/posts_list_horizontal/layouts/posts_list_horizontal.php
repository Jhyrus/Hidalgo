<?php if ( $posts->have_posts() ): $i = 0; ?>

	<div class="newsmag-margin-top post-list-horizontal newsmag-blog-post-layout-row">
		<div class="col-md-12">
			<?php
			$idObj = get_category_by_slug( $instance['newsmag_category'] );
			?>
			<h2>
				<?php
				if ( ! empty( $instance['title'] ) ) {
					?>
					<span><?php echo esc_html( $instance['title'] ); ?></span>
					<?php
				} else {
					?>
					<a href="<?php echo esc_url( get_category_link( $idObj->term_id ) ) ?>">
						<?php echo ( empty( $instance['title'] ) && $idObj !== false ) ? esc_html( $idObj->name ) : esc_html( $instance['title'] ); ?>
					</a>
				<?php } ?>
			</h2>
		</div>
		<?php while ( $posts->have_posts() ) : $posts->the_post();
			$i ++;
			$category = get_the_category();
			$image    = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . esc_url( get_template_directory_uri() . '/assets/images/picture_placeholder.jpg' ) . '" />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-post-horizontal' );
			}
			$image_obj    = array( 'id' => get_the_ID(), 'image' => $image );
			$new_image    = apply_filters( 'newsmag_widget_image', $image_obj );
			$allowed_tags = array(
				'img'      => array(
					'data-src'    => true,
					'data-srcset' => true,
					'srcset'      => true,
					'sizes'       => true,
					'src'         => true,
					'class'       => true,
					'alt'         => true,
					'width'       => true,
					'height'      => true
				),
				'noscript' => array()
			);
			?>

			<div class="col-md-3 col-sm-6">
				<div class="newsmag-post-box-a thumbnail-layout">
					<div class="newsmag-image">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>">
							<?php echo wp_kses( $new_image, $allowed_tags ); ?>
						</a>
						<span class="newsmag-post-box-a-category">
							<a href="<?php echo esc_url_raw( get_category_link( $category[0] ) ) ?>">
								<?php echo esc_html( $category[0]->name ) ?>
							</a>
						</span>
					</div>
					<h3>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
					</h3>
					<div class="meta">
						<span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
						<?php newsmag_posted_on( 'comments' ); ?>
						<?php if ( current_user_can( 'manage_options' ) ) { ?>
							<a class="newsmag-comments-link " target="_blank"
							   href="<?php echo get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit' ?>">
								<span class="fa fa-edit"></span> <?php echo __( 'Edit', 'newsmag' ) ?>
							</a>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php

			if ( fmod( $i, 4 ) == 0 && $i != (int) $posts->post_count ) {
				echo '</div><div class="newsmag-blog-post-layout-row">';
			} elseif ( $i == (int) $posts->post_count ) {
				continue;
			}

		endwhile; ?>
	</div>
<?php endif; ?>


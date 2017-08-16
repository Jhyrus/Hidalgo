<?php
if ( $posts->have_posts() ):

	$i = 0; ?>
	<div class="col-md-4">
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php $category = get_the_category();
			if ( $i == 0 ) {
				$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/picture_placeholder.jpg" />';
				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-post-horizontal' );
				}
				$image_obj    = array( 'id' => get_the_ID(), 'image' => $image );
				$new_image    = apply_filters( 'newsmag_widget_image', $image_obj );
				$allowed_tags = array(
					'img'      => array(
						'data-srcset' => true,
						'data-src'    => true,
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
				<div class="newsmag-post-box-a posts-column-layout">
					<h2>
						<?php
						if ( ! empty( $instance['title'] ) ) {
							?>
							<span><?php echo esc_html( $instance['title'] ); ?></span>
							<?php
						} else {
							?>
							<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ) ?>">
								<?php echo empty( $instance['title'] ) ? esc_html( $category[0]->name ) : esc_html( $instance['title'] ); ?>
							</a>
						<?php } ?>
					</h2>
					<div class="newsmag-image">
						<a class="newsmag-post-box-image" href="<?php echo esc_url( get_the_permalink() ); ?>">
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
						<?php if ( $instance['show_date'] === 'on' ): ?>
							<span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
							<?php newsmag_posted_on( 'comments' ); ?>
						<?php endif; ?>
						<?php if ( current_user_can( 'manage_options' ) ) { ?>
							<a class="newsmag-comments-link " target="_blank"
							   href="<?php echo get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit' ?>">
								<span class="fa fa-edit"></span> <?php echo __( 'Edit', 'newsmag' ) ?>
							</a>
						<?php } ?>
					</div>
					<?php
					$excerpt = get_the_content();
					$length  = (int) get_theme_mod( 'newsmag_excerpt_length', 25 );
					?>
					<p>
						<?php echo wp_kses_post( wp_trim_words( strip_shortcodes( $excerpt ), $length ) ); ?>
					</p>
				</div>
				<?php
			} else {
				$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/picture_placeholder_list.jpg" />';
				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-list-image' );
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
				<div class="newsmag-blog-post-layout-b">
					<div class="row">
						<div class="col-sm-3 col-xs-4">
							<div class="newsmag-image">
								<a href=" <?php echo esc_url( get_the_permalink() ); ?>">
									<?php echo wp_kses( $new_image, $allowed_tags ); ?>
								</a>
							</div>
						</div>
						<div class="col-sm-9 col-xs-8">
							<div class="newsmag-title">
								<h3>
									<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a>
								</h3>
								<div class="meta">
									<?php if ( $instance['show_date'] === 'on' ): ?>
										<span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
										<?php newsmag_posted_on( 'comments' ); ?>
									<?php endif; ?>
									<?php if ( current_user_can( 'manage_options' ) ) { ?>
										<a class="newsmag-comments-link " target="_blank"
										   href="<?php echo get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit' ?>">
											<span class="fa fa-edit"></span> <?php echo __( 'Edit', 'newsmag' ) ?>
										</a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			$i ++; ?>
		<?php endwhile; ?>
	</div>
<?php endif; ?>
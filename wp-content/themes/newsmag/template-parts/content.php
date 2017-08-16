<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'newsmag-blog-post-layout' ); ?>>
	<?php
	$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . esc_url( get_template_directory_uri() . '/assets/images/picture_placeholder.jpg' ) . '" />';
	if ( has_post_thumbnail() ) {
		$image = is_sticky() ? get_the_post_thumbnail( get_the_ID(), 'newsmag-single-post' ) : get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
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
	$categories   = get_the_category();

	?>
	<?php if ( is_sticky() ): ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="newsmag-image newsmag-sticky-post-image">
					<?php if ( get_post_format() ): ?>
						<div class="newsmag-format-sign">
							<span class="<?php echo esc_attr( newsmag_format_icon( get_post_format() ) ) ?>"></span>
						</div>
					<?php endif; ?>

					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						<?php echo wp_kses( $new_image, $allowed_tags ) ?>
					</a>
					<span class="newsmag-post-box-category">
						<a href="<?php echo esc_url_raw( get_category_link( $categories[0] ) ) ?>">
							<?php echo esc_html( $categories[0]->name ) ?>
						</a>
					</span>
				</div>
				<div class="newsmag-title newsmag-sticky-post-title">
					<h3>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
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
				<div class="newsmag-content entry-content">
					<?php if ( is_single() ) {
						the_content();
					} else {
						$excerpt = get_the_content();
						$length  = (int) get_theme_mod( 'newsmag_excerpt_length', 25 );
						?>
						<p>
							<?php echo wp_kses_post( wp_trim_words( strip_shortcodes( $excerpt ), $length ) ); ?>
						</p>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="row">
			<div class="col-sm-4 col-xs-12">
				<div class="newsmag-image">
					<?php if ( get_post_format() ): ?>
						<div class="newsmag-format-sign">
							<span class="<?php echo esc_attr( newsmag_format_icon( get_post_format() ) ) ?>"></span>
						</div>
					<?php endif; ?>
					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						<?php echo wp_kses( $new_image, $allowed_tags ) ?>
					</a>
					<?php if ( ! empty( $categories ) ) { ?>
						<span class="newsmag-post-box-category">
						<a href="<?php echo esc_url_raw( get_category_link( $categories[0] ) ) ?>">
							<?php echo esc_html( $categories[0]->name ); ?>
						</a>
					</span>
					<?php } ?>
				</div>
			</div>
			<div class="col-sm-8 col-xs-12">
				<div class="newsmag-title">
					<h3>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
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
				<div class="newsmag-content entry-content">
					<?php if ( is_single() ) {
						the_content();
					} else {
						$excerpt = get_the_content();
						$length  = (int) get_theme_mod( 'newsmag_excerpt_length', 25 );
						?>
						<p>
							<?php echo wp_kses_post( wp_trim_words( strip_shortcodes( $excerpt ), $length ) ); ?>
						</p>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</article><!-- #post-## -->

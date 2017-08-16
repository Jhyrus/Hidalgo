<?php
/**
 * The Template for displaying all single posts.
 *
 * @package wpkube
 * @since wpkube 1.0
 */

get_header(); ?>

		<div id="primary" class="content-area boxed">
			<?php wpkube_breadcrumb(); ?>
			<div id="content" class="site-content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<div class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>', 'palmas' ),
									esc_attr( get_the_date( 'c' ) ),
									esc_html( get_the_date() ),
									wp_get_attachment_url(),
									$metadata['width'],
									$metadata['height'],
									get_permalink( $post->post_parent ),
									esc_attr( get_the_title( $post->post_parent ) ),
									get_the_title( $post->post_parent )
								);
							?>
							<?php edit_post_link( __( 'Edit', 'palmas' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->
						<h1 class="entry-title"><?php the_title(); ?></h1>

					</header><!-- .entry-header -->

					<div class="entry-content boxed">
					<div class="entry-content">

						<div class="entry-attachment">
							<div class="attachment">
								<?php
									/**
									 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
									 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
									 */
									$attachments = array_values( get_children( array(
										'post_parent'    => $post->post_parent,
										'post_status'    => 'inherit',
										'post_type'      => 'attachment',
										'post_mime_type' => 'image',
										'order'          => 'ASC',
										'orderby'        => 'menu_order ID'
									) ) );
									foreach ( $attachments as $k => $attachment ) {
										if ( $attachment->ID == $post->ID )
											break;
									}
									$k++;
									// If there is more than 1 attachment in a gallery
									if ( count( $attachments ) > 1 ) {
										if ( isset( $attachments[ $k ] ) )
											// get the URL of the next image attachment
											$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
										else
											// or get the URL of the first image attachment
											$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
									} else {
										// or, if there's only 1 image, get the URL of the image
										$next_attachment_url = wp_get_attachment_url();
									}
								?>

								<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
									$attachment_size = apply_filters( 'wpkube_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
									echo wp_get_attachment_image( $post->ID, $attachment_size );
								?></a>
							</div><!-- .attachment -->

							<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- .entry-caption -->
							<?php endif; ?>
						</div><!-- .entry-attachment -->

						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'palmas' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

				</article><!-- #post-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */
// Grab the current author
$curauth             = get_userdata( $post->post_author );
$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', true );
$image_in_content    = get_theme_mod( 'newsmag_featured_image_in_content', true );
$author              = get_theme_mod( 'newsmag_enable_author_box', true );
?>
<?php if ( $image_in_content ): ?>
	<div class="row newsmag-margin-bottom <?php echo $breadcrumbs_enabled ? '' : 'newsmag-margin-top' ?> ">
		<div class="col-md-12">
			<div class="newsmag-image">
				<?php
				if ( has_post_thumbnail() ) {
					$image        = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
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

					echo wp_kses($new_image, $allowed_tags);
				}
				?>
			</div>
		</div>
	</div>
<?php endif; ?>
<div
	class="row newsmag-article-post <?php echo ( ! $breadcrumbs_enabled && ! $image_in_content ) ? 'newsmag-margin-top' : '' ?>">
	<?php if ( $author ): ?>
		<div class="col-md-3">
			<?php
			// Include author information
			get_template_part( 'template-parts/author-info' );
			?>
		</div>
	<?php endif; ?>
	<div
		class="<?php echo $author ? 'col-md-9' : 'col-md-12'; ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<div class="newsmag-post-meta">
					<span class="fa fa-folder-o"></span> <?php the_category( ',' ); ?> <span class="sep">|</span> <span
						class="fa fa-clock-o"></span> <?php newsmag_posted_on( 'date' ); ?>
				</div><!-- .entry-meta -->
				<?php if ( is_single() ) {
					the_content();
				} else {
					$excerpt = get_the_excerpt();
					$length  = (int) get_theme_mod( 'newsmag_excerpt_length', 25 );
					?>
					<p>
						<?php echo wp_kses_post( wp_trim_words( $excerpt, $length ) ); ?>
					</p>
				<?php }

				wp_link_pages( array(
					               'before' => '<ul class="newsmag-pager">',
					               'after'  => '</ul>',
				               ) );

				$prev = get_previous_post_link();
				$prev = str_replace( '&laquo;', '<div class="wrapper"><span class="fa fa-angle-left"></span>', $prev );
				$prev = str_replace( '</a>', '</a></div>', $prev );
				$next = get_next_post_link();
				$next = str_replace( '&raquo;', '<span class="fa fa-angle-right"></span></div>', $next );
				$next = str_replace( '<a', '<div class="wrapper"><a', $next );
				?>
				<div class="newsmag-next-prev row">
					<div class="col-md-6 text-left">
						<?php echo wp_kses_post( $prev ) ?>
					</div>
					<div class="col-md-6 text-right">
						<?php echo wp_kses_post( $next ) ?>
					</div>
				</div>
			</div>
		</article><!-- #post-## -->
	</div>
</div>
<div class="row newsmag-article-post-footer">
	<div class="col-md-12">
		<?php
		$tags_enabled = get_theme_mod( 'newsmag_show_single_post_tags', true );
		$has_tag      = has_tag();
		if ( $tags_enabled && $has_tag ): ?>
			<footer class="entry-footer">
				<?php
				if ( 'post' === get_post_type() ) : ?>
					<div class="newsmag-post-meta">
						<?php newsmag_posted_on( 'tags' ); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</footer><!-- .entry-footer -->

		<?php endif; ?>
		<?php do_action( 'newsmag_single_after_article' ); ?>

	</div>
</div>


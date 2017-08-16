<article id="entry-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">
	<?php if ( get_post_type() === 'post' ) : ?>
		<div class="entry-meta entry-meta-top">
			<p class="entry-categories">
				<?php the_category( ', ' ); ?>
			</p>
		</div>
	<?php endif; ?>

	<h2 class="entry-title" itemprop="headline">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>

	<?php if ( get_post_type() === 'post' ) : ?>
		<div class="entry-meta entry-meta-bottom">
			<time class="entry-date" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<a href="<?php echo esc_url( get_comments_link() ); ?>" class="entry-comments-no"><?php comments_number(); ?></a>
		</div>
	<?php endif; ?>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-featured">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'itemprop' => 'image' ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content" itemprop="text">
		<?php if ( ! get_theme_mod( 'excerpt_on_classic_layout' ) ) {
			the_content( '' );
		} else {
			the_excerpt();
		} ?>
	</div>

	<div class="entry-utils group">
		<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Continue Reading', 'olsen-light' ); ?></a>

		<?php get_template_part( 'part', 'social-sharing' ); ?>
	</div>
</article>

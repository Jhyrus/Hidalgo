<?php
/**
 * @package wpkube
 * @since wpkube 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('group'); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="home-thumb boxed" >
            <?php the_post_thumbnail('large'); ?>
            </a>
        <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content boxed">
		<?php the_content(); ?>
        <p class="post-tags"><?php the_tags('<span class="icon-tag hidden-text-icon">Tags</span> ', ', ', ''); ?></p>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'palmas' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
    

</article><!-- #post-<?php the_ID(); ?> -->

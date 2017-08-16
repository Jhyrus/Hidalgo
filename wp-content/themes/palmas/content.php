<?php
/**
 * @package wpkube
 * @since wpkube 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('boxed'); ?>>
	<?php $nothumb = "no-thumb"; ?>
    <?php if (has_post_thumbnail()): ?>
    	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="home-thumb boxed" >
    	<?php the_post_thumbnail('thumb-435'); ?>
    	</a>
    	<?php $nothumb = ""; ?>
    <?php endif; ?>
    <div class="post-content">
	<header class="entry-header <?php echo $nothumb; ?>">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'palmas' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry-meta">
            <span class="post-cats"><?php the_category(', '); ?></span>
            <span class="sep">/</span>
			<?php
				wpkube_posted_on();
			?>
            
			<?php  //edit_post_link( __( 'Edit', 'palmas' ), ' <span class="sep">/</span> <span class="edit-link">', '</span>' );  ?>

		</div><!-- .entry-meta -->

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary  <?php echo $nothumb; ?>">
		<?php the_excerpt(); ?>
        <p class="read-more"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'palmas' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php _e("Read more", 'palmas'); ?></a></p>
        <div class="post-bottom">
        <span class="post-author"><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span>
        <span class="comments-link"><i class="fa fa-comment-o"></i><?php comments_popup_link( __( '0', 'palmas' ), __( '1', 'palmas' ), __( '%', 'palmas' ) ); ?></span></div>
	</div><!-- .entry-summary -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->

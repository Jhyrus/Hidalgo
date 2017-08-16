<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package wpkube
 * @since wpkube 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area boxed">
			<h3 class="section-title"><span><?php printf( __( 'Search Results for: %s', 'palmas' ), '<span>' . get_search_query() . '</span>' ); ?></span></h3>

			<div id="content" class="site-content group" role="main">

			<?php if ( have_posts() ) : ?>


				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ); ?>

				<?php endwhile; ?>

				<?php wpkube_pagenavi(); ?>
				<div class="layout-toggle group">
					<a class="layout-grid" href="#"><?php _e('Grid', 'palmas'); ?></a>
					<a class="layout-list" href="#"><?php _e('List', 'palmas'); ?></a>
				</div>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
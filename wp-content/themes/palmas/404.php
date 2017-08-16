<?php
/**
 * The template for displaying 404 error not found.
 *
 * @package wpkube
 * @since wpkube 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area boxed">
			<h3 class="section-title"><span><?php printf( __( '404 Error page not found', 'palmas' ), '<span>' . get_search_query() . '</span>' ); ?></span></h3>

			<div id="content" class="site-content group" role="main">

			<?php if ( have_posts() ) : ?>


				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ); ?>

				<?php endwhile; ?>

				<?php wpkube_pagenavi(); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

get_header();
$image = get_custom_header();
$title = '';

while ( have_posts() ) : the_post();
	$img   = get_the_post_thumbnail_url();
	$title = get_the_title();
endwhile;

if ( empty( $img ) ) {
	$img = get_custom_header();
	$img = $img->url;
}

?>
<?php if ( ! empty( $img ) ): ?>
	<div class="newsmag-custom-header"
	     style="background-image:url(<?php echo esc_url_raw( $img ) ?>)">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h3><?php echo esc_html( $title ) ?></h3>
				</div>
			</div>
		</div>
	</div>
<?php endif;
	$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', true );
	if ( $breadcrumbs_enabled ) { ?>
	<div class="container newsmag-breadcrumbs-container">
		<div class="row newsmag-breadcrumbs-row">
			<div class="col-xs-12">
				<?php newsmag_breadcrumbs(); ?>
			</div>
		</div>
	</div>
<?php } ?>
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main row" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
<?php
get_footer();

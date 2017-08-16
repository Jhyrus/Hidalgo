<?php
/*
  Template Name: Blog Page
 */
get_header();
?>
<div class="clear"></div>
<div class="page-content">
    <div class="grid_16 alpha">
        <div class="content-bar">
            <?php
            $limit = get_option('posts_per_page');
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            query_posts('showposts=' . $limit . '&paged=' . $paged);
            $wp_query->is_archive = true;
            $wp_query->is_home = false;
            ?>
            <!-- Start the Loop. -->
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'squirrel'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h1>
                        <ul class="post_meta">
                            <li class="posted_by"><span><?php _e('Posted by', 'squirrel'); ?></span>&nbsp;<?php the_author_posts_link(); ?></li>
                            <li class="post_date"><span><?php _e('on', 'squirrel'); ?></span>&nbsp;<?php echo get_the_time('M, d, Y') ?></li>
                            <li class="post_category"><span><?php _e('in', 'squirrel'); ?></span>&nbsp;<?php the_category(', '); ?></li>
                            <li class="postc_comment"><span><?php _e('Blog', 'squirrel'); ?></span>&nbsp;<?php comments_popup_link(__('No Comments.', 'squirrel'), __('1 Comment.', 'squirrel'), __('% Comments.', 'squirrel')); ?></li>
                        </ul>
                        <div class="post_content"> <?php if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) { ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('post_thumbnail', array('class' => 'postimg')); ?>
                                </a>
                            <?php } else { ?>
                                <a href="<?php the_permalink() ?>"><?php echo squirrel_main_image(250, 170); ?></a>
                                <?php
                            }
                            the_excerpt();
                            ?>
                            <div class="clear"></div>
                            <?php if (has_tag()) { ?>
                                <div class="tag">
                                    <?php the_tags(__('Post Tagged with&nbsp;', 'squirrel'), ', ', ''); ?>
                                </div>
                            <?php } ?>
                            <a class="read_more" href="<?php the_permalink() ?>"><?php _e('Read More', 'squirrel'); ?></a> </div>
                    </div>
                    <!--End post-->
                    <?php
                endwhile;
            else:
                ?>
                <div class="post">
                    <p>
                        <?php _e('Sorry, no posts matched your criteria.', 'squirrel'); ?>
                    </p>
                </div>
            <?php endif; ?>
            <!--End Loop-->
            <div class="clear"></div>
            <nav id="nav-single"> <span class="nav-previous">
                    <?php next_posts_link(__('&larr; Older posts', 'squirrel')); ?>
                </span> <span class="nav-next">
                    <?php previous_posts_link(__('Newer posts &rarr;', 'squirrel')); ?>
                </span> </nav>
        </div>
    </div>
    <div class="grid_8 omega">
        <!--Start Sidebar-->
        <?php get_sidebar(); ?>
        <!--End Sidebar-->
    </div>
</div>
</div>
<?php get_footer(); ?>
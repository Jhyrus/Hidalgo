<div class="sidebar">
    <?php if (!dynamic_sidebar('primary-widget-area')) : ?>
        <h4>
            <?php _e('Categories', 'squirrel'); ?>
        </h4>
        <ul>
            <?php wp_list_categories('title_li'); ?>
        </ul>
        <h4>
            <?php _e('Archives', 'squirrel'); ?>
        </h4>
        <ul>
            <?php wp_get_archives('type=monthly'); ?>
        </ul>
        <h4><?php _e('Search:', 'squirrel'); ?></h4>
        <?php
        get_search_form();
    endif; // end primary widget area 
// A second sidebar for widgets, just because.
    if (is_active_sidebar('secondary-widget-area')) :

        dynamic_sidebar('secondary-widget-area');
    endif;
    ?>
</div>
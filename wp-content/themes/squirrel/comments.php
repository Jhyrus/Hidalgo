<?php
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'squirrel'); ?></p>
    <?php
    return;
}
if (comments_open() && post_type_supports(get_post_type(), 'comments')) : // comments are closed 
    ?>
    <h3><?php _e('Comments &amp; Responses', 'squirrel'); ?></h3>
<?php endif; ?>
<!-- You can start editing here. -->
<div id="commentsbox">
    <?php if (have_comments()) : ?>
        <h3 id="comments">
            <?php
            comments_number(__('No Responses', 'squirrel'), __('One Response', 'squirrel'), __('% Responses', 'squirrel'));
            _e('so far.', 'squirrel');
            ?>
        </h3>
        <ol class="commentlist">
            <?php wp_list_comments(); ?>
        </ol>
        <div class="comment-nav">
            <div class="alignleft">
                <?php previous_comments_link() ?>
            </div>
            <div class="alignright">
                <?php next_comments_link() ?>
            </div>
        </div>
        <?php
    else : // this is displayed if there are no comments so far 
        if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : // comments are closed  
            ?>
            <!-- If comments are closed. -->
            <?php
        endif;
    endif;
    if (comments_open()) :
        ?>
        <div id="comment-form">
            <?php comment_form(); ?>
        </div>
    <?php endif; // if you delete this the sky will fall on your head     ?>
</div>

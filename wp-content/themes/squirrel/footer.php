<div class="clear"></div>
<!--End Index-->
<!--Start Footer-->
<div class="footer">
    <?php
    /* A sidebar in the footer? Yep. You can can customize
     * your footer with four columns of widgets.
     */
    get_sidebar('footer');
    ?>
</div>
<div class="footer-strip"></div>
<!--Start footer bottom inner-->
<div class="bottom-footer">
    <div class="footer_bottom_inner"> 
        <?php if (squirrel_get_option('squirrel_cright') != '') { ?>
            <span class="copyright"><?php echo squirrel_get_option('squirrel_cright'); ?></span> 
            <?php
        } else {
            printf('<span class="copyright"><a rel="nofollow" href="' . esc_url('http://www.inkthemes.com') . '">Squirrel Theme</a> powered by <a href="' . esc_url('http://www.wordpress.org') . '">WordPress</a></span>');
        }
        ?>
    </div>
</div>
<!--End Footer bottom inner-->
<!--End Footer bottom-->
</div>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>

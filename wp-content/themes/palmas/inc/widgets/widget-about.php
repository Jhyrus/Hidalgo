<?php
// Creating the widget 
class kube_about_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'kube_about_widget', 

        // Widget name will appear in UI
        __('(WPKube) About Widget', 'palmas'), 

        // Widget description
        array( 'description' => __( 'A widget to show author description and image', 'palmas' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = $instance['sub-title'];
		$author_description = $instance['author_description'];
		$author_image = $instance['author_image'];
		$author_fb = $instance['author_fb'];
		$author_twitter = $instance['author_twitter'];
		$author_linkedin = $instance['author_linkedin'];
		$author_pinterest = $instance['author_pinterest'];
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        ?>
            <div class="about-widget">
                <?php
                    if ( ! empty( $author_image ) )
                    echo '<img src="' . esc_url( $author_image ) . '">';
        
                    if ( ! empty( $title ) )
                    echo $args['before_title'] . $title . $args['after_title'];
        
                    if ( ! empty( $sub_title ) )
                    echo '<span>' . esc_html( $sub_title ) . '</span>';
        
                    if ( ! empty( $author_description ) )
                    echo '<p>' . esc_html( $author_description ) . '</p>';
        
                    echo '<div class="author-social-links">';
        
                        if ( ! empty( $author_fb ) )
                        echo '<span><a href="' . esc_url( $author_fb ) . '"><i class="fa fa-facebook"></i></a></span>';
        
                        if ( ! empty( $author_twitter ) )
                        echo '<span><a href="' . esc_url( $author_twitter ) . '"><i class="fa fa-twitter"></i></a></span>';
        
                        if ( ! empty( $author_linkedin ) )
                        echo '<span><a href="' . esc_url( $author_linkedin ) . '"><i class="fa fa-linkedin"></i></a></span>';
        
                        if ( ! empty( $author_pinterest ) )
                        echo '<span><a href="' . esc_url( $author_pinterest ) . '"><i class="fa fa-pinterest"></i></a></span>';
        
                    echo '</div>';
                ?>
            </div>
        <?php
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        $defaults = array(
			'title' => '',
			'sub-title' => '',
			'author_description' => '',
			'author_image' => '',
			'author_fb' => '',
			'author_twitter' => '',
			'author_linkedin' => '',
			'author_pinterest' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','palmas' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php if(!empty($instance['title'])) { echo $instance['title']; } ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'sub-title' ); ?>"><?php _e( 'Sub Title:','palmas' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'sub-title' ); ?>" name="<?php echo $this->get_field_name( 'sub-title' ); ?>" type="text" value="<?php if(!empty($instance['sub-title'])) { echo $instance['sub-title']; } ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'author_image' ); ?>"><?php _e( 'Author Image:','palmas' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'author_image' ); ?>" name="<?php echo $this->get_field_name( 'author_image' ); ?>" type="text" value="<?php echo esc_url( $instance['author_image'] ); ?>" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'author_description' ); ?>"><?php _e('Author Description:','palmas') ?></label>
			<textarea id="<?php echo $this->get_field_id( 'author_description' ); ?>" name="<?php echo $this->get_field_name( 'author_description' ); ?>" cols="20" rows="10" class="widefat"><?php echo esc_html($instance['author_description']); ?></textarea>
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'author_fb' ); ?>"><?php _e( 'Facebook URL:','palmas' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'author_fb' ); ?>" name="<?php echo $this->get_field_name( 'author_fb' ); ?>" type="text" value="<?php echo esc_url( $instance['author_fb'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'author_twitter' ); ?>"><?php _e( 'Twitter URL:','palmas' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'author_twitter' ); ?>" name="<?php echo $this->get_field_name( 'author_twitter' ); ?>" type="text" value="<?php echo esc_url( $instance['author_twitter'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'author_linkedin' ); ?>"><?php _e( 'LinkedIn URL:','palmas' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'author_linkedin' ); ?>" name="<?php echo $this->get_field_name( 'author_linkedin' ); ?>" type="text" value="<?php echo esc_url( $instance['author_linkedin'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'author_pinterest' ); ?>"><?php _e( 'Pinterest URL:','palmas' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'author_pinterest' ); ?>" name="<?php echo $this->get_field_name( 'author_pinterest' ); ?>" type="text" value="<?php echo esc_url( $instance['author_pinterest'] ); ?>" />
        </p>
        <?php 
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['sub-title'] = ( ! empty( $new_instance['sub-title'] ) ) ? strip_tags( $new_instance['sub-title'] ) : '';
		$instance['author_description'] = $new_instance['author_description'];
		$instance['author_image'] = $new_instance['author_image'];
		$instance['author_fb'] = $new_instance['author_fb'];
		$instance['author_twitter'] = $new_instance['author_twitter'];
		$instance['author_linkedin'] = $new_instance['author_linkedin'];
		$instance['author_pinterest'] = $new_instance['author_pinterest'];
        return $instance;
    }
} // Class kube_about_widget ends here

// Register and load the widget
function kube_about_load_widget() {
	register_widget( 'kube_about_widget' );
}
add_action( 'widgets_init', 'kube_about_load_widget' );
?>
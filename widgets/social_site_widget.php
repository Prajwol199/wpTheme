<?php
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Creating the widget 
class wpb_widget extends WP_Widget {
 
	function __construct() {
		parent::__construct(
		 
		// Base ID of your widget
		'wpb_widget', 
		 
		// Widget name will appear in UI
		__('Link of social site', 'wpb_widget_domain'), 
		 
		// Widget description
		array( 'description' => __( 'Enter the link of your social site', 'wpb_widget_domain' ), ) 
		);
	}
	 
	// Creating widget front-end
	 
	public function widget( $args, $instance ) {
		$facebook = apply_filters( 'widget_title', $instance['facebook'] );
		$twitter = apply_filters( 'widget_title', $instance['twitter'] );
		$linkedin = apply_filters( 'widget_title', $instance['linkedin'] );
		// $title = $instance['title'] ;
		 
		// before and after widget arguments are defined by themes
		// echo $args['before_widget'];
		if ( ! empty( $facebook  ) && ! empty( $twitter  ) && ! empty( $linkedin  ))
		// echo $args['before_title'] . $facebook . $args['after_title'];
		// echo $args['before_title'] . $twitter . $args['after_title'];
		// echo $args['before_title'] . $linkedin . $args['after_title'];
		?>
		<div class="rt-social-group mt-4">
			<ul>
				<li><a href="<?php echo $facebook ?>"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="<?php echo $twitter ?>"><i class="fab fa-twitter"></i></a></li>
				<li><a href="<?php echo $linkedin ?>"><i class="fab fa-linkedin-in"></i></a></li>
			</ul>
		</div><!-- social -->
		<?php 
		// echo $args['after_widget'];
	}
	         
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'facebook' ] ) && isset( $instance[ 'twitter' ] ) && isset( $instance[ 'linkedin' ] )) {
			$facebook = $instance[ 'facebook' ];
			$twitter = $instance[ 'twitter' ];
			$linkedin = $instance[ 'linkedin' ];
		}
		else {
			$facebook = __( 'Facebook link', 'wpb_widget_domain' );
			$twitter = __( 'Twitter link', 'wpb_widget_domain' );
			$linkedin = __( 'linkedin link', 'wpb_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Enter facebook link:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Enter twitter link:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'Enter linkedin link:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
		</p>
		<?php 
	}
	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
		$instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
		return $instance;
	}
} // Class wpb_widget ends here
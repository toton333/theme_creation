<?php

/*
Plugin Name: Prof Widget
Plugin URI: localhost/professionalism
Author: Bishan
Author URI: localhost/professionalism
Description: A widget with a subtitle field
Version: 1.0
Tags: widget, prof, simple, double heading, subtitle, extra field


*/

class Prof_widget extends WP_Widget{

	function __construct(){
      parent:: __construct('prof_widget', __('Prof Widget', 'prof'), array('description' => __( 'A Bish Product', 'prof' )));

	}

	public function widget($args, $instance){

		$title    = apply_filters('widget_title', !empty($instance['title'])? $instance['title'] : '', $instance, $this->id_base  );
		$subtitle = !empty($instance['subtitle']) ? $instance['subtitle'] : '';
		$message  = !empty($instance['message']) ? $instance['message'] : '';

		echo $args['before_widget'];
		echo $args['before_title'];
		if ($title || $subtitle) {
			echo '<h1>'.$title.'</h1><h2>'.$subtitle.'</h2>';
		}
		echo $args['after_title'];
		if ($message) {
			echo $instance['message'];
		}
		echo $args['after_widget'];

	}

	public function form($instance){

		$instance    = wp_parse_args((array)$instance, array('title' => '', 'subtitle' => '', 'message' => '' ));
		$title       = $instance['title'];
		$subtitle    = $instance['subtitle'];
		$message     = $instance['message'];

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e( 'Title', 'prof' ); ?> </label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo esc_attr($title ); ?>"            >
			
		</p>



		<?php

	}

	public function update($new_instance, $old_instance){


	}



}

add_action('widgets_init', function(){
	register_widget('Prof_widget' );
} );




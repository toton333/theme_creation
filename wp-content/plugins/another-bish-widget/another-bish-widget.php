<?php
/**
* A test widget
* The Another bish widget plugin adds a widget section
* to create various fields.
*
* @package ABW
*
* @wordpress-plugin
*Plugin Name: Another Bish Widget
*Plugin URI:  http://google.com
*Description: A custom widget to display lastest posts
*Version:     1.5
*Author:      Bishan Ghosal
*Author URI:  http://google.com
*License:     GPL2
*License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

/**
* Another bish widget class
*/
class Another_bish_widget extends WP_Widget{

	 function __construct(){
	 	parent::__construct('another_bish_widget', __('Another Bish Widget'), array('description' => __('A Bish production widget')));
	 }

	 

	/**
	 * @param array $args
	 * @param array $instance
	 */
    public function widget($args, $instance){

 		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        
        echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if (!empty($instance['cat'])) {
			$post_args = array('post_type' => 'post', 'category_name' => $instance['cat'], 'order' => $instance['order']);
			$posts = get_posts($post_args );
			foreach ($posts as $post) {
				echo '<a href="'.get_permalink($post->ID).'"><h5>'.$post->post_title. '</h5></a>';
			}

			wp_reset_postdata();

		}
		if ($instance['fb'] && !empty($instance['fb_link'])  ) {

			$fb_link = (substr($instance['fb_link'], 0, 7) == 'http://' ||  substr($instance['fb_link'], 0, 8) == 'https://' ) ? $instance['fb_link'] : 'http://'.$instance['fb_link'];
            echo '<p><a href="'.$fb_link.'">'.__('Facebook').'</a></p>';		
		}

		if ($instance['t'] && !empty($instance['t_link']) ) {
			$t_link = (substr($instance['t_link'], 0, 7) == 'http://' ||  substr($instance['t_link'], 0, 8) == 'https://' ) ? $instance['t_link'] : 'http://'.$instance['t_link'];
            echo '<p><a href="'.$t_link.'">'.__('Twitter').'</a></p>';
		}

		if ($instance['yt'] && !empty($instance['yt']) ) {
			$yt_link = (substr($instance['yt_link'], 0, 7) == 'http://' ||  substr($instance['yt_link'], 0, 8) == 'https://' ) ? $instance['yt_link'] : 'http://'.$instance['yt_link'];
            echo '<p><a href="'.$yt_link.'">'.__('YouTube').'</a></p>';
		}




		echo $args['after_widget'];
	 	 
	 }

	/**
	 * @param array $instance
	 */

	 public function form($instance){

	 	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'cat' => '', 'order' => 'DESC', 'fb' => false, 't' => false, 'yt' => false, 'fb_link' => '', 't_link' => '', 'yt_link' => '' ) );
		$title    = $instance['title'];
		$cat      = $instance['cat'];
		$order    = $instance['order'];
		$fb_link  = $instance['fb_link'];
		$t_link   = $instance['t_link'];
		$yt_link  = $instance['yt_link'];
	 	?>
			<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Category:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" type="text" value="<?php echo esc_attr( $cat ); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Descending or Ascending order?:' ); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('order') ?>" id="<?php echo $this->get_field_id('order') ?>">
					<option value="DESC" <?php selected($order, 'DESC' ); ?>  ><?php _e( 'DESC' ); ?></option>
					<option value="ASC"  <?php selected($order, 'ASC' );  ?>  ><?php _e( 'ASC' ); ?></option>
				</select>
			</p>
			<p>
				<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('fb') ?>" name="<?php echo $this->get_field_name('fb') ?>"   <?php checked($instance['fb'], true) ?>   />
		        <label for="<?php echo $this->get_field_id('fb'); ?>"><?php _e('Facebook'); ?></label><br />
		        <input value="<?php echo esc_attr( $fb_link ); ?>" placeholder="<?php _e('Enter Facebook Address'); ?>" class="widefat" type="text" id="<?php echo $this->get_field_id('fb_link') ?>"  name="<?php echo $this->get_field_name('fb_link') ?>" /><br/><br/>

		        <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('t') ?>" name="<?php echo $this->get_field_name('t') ?>"   <?php checked($instance['t'], true) ?>   />
		        <label for="<?php echo $this->get_field_id('t'); ?>"><?php _e('Twitter'); ?></label><br />
		        <input value="<?php echo esc_attr( $t_link ); ?>" placeholder="<?php _e('Enter Twitter Address'); ?>" class="widefat" type="text" id="<?php echo $this->get_field_id('t_link') ?>"  name="<?php echo $this->get_field_name('t_link') ?>" /><br/><br/>

		        <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('yt') ?>" name="<?php echo $this->get_field_name('yt') ?>"   <?php checked($instance['yt'], true) ?>   />
		        <label for="<?php echo $this->get_field_id('yt'); ?>"><?php _e('YouTube'); ?></label><br />
		        <input value="<?php echo esc_attr( $yt_link ); ?>" placeholder="<?php _e('Enter YouTube Address'); ?>" class="widefat" type="text" id="<?php echo $this->get_field_id('yt_link') ?>"  name="<?php echo $this->get_field_name('yt_link') ?>" /><br/><br/>

			</p>
			<?php

	 }

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */

	 public function update($new_instance, $old_instance){

	 	$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['cat'] = ( ! empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
			$instance['order'] = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
			$instance['fb_link'] = ( ! empty( $new_instance['fb_link'] ) ) ? strip_tags( $new_instance['fb_link'] ) : '';
			$instance['t_link'] = ( ! empty( $new_instance['t_link'] ) ) ? strip_tags( $new_instance['t_link'] ) : '';
			$instance['yt_link'] = ( ! empty( $new_instance['yt_link'] ) ) ? strip_tags( $new_instance['yt_link'] ) : '';

			$checkbox_array = array('fb' => 0, 't' => 0, 'yt' => 0);
			foreach ($checkbox_array as $key => $value) {
				if (isset($new_instance[$key])) {
					$instance[$key] = 1;
				}
			}

			return $instance;

	 }


} 

add_action('widgets_init', function(){
	register_widget('Another_bish_widget' );
});
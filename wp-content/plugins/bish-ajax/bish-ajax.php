<?php 
/*
Plugin Name: Bish Ajax
Plugin URI:  http://www.google.com
Description: A simple ajax test plugin
Version:     1.0
Author:      Bishan Ghosal
Author URI:  http://www.google.com
License:     
License URI: 
Domain Path: 
Text Domain: 
*/

//menu creation

function bish_plugin_menu() {
	global $option_page;
	 //$option_page = add_options_page( __('Bish Ajax', 'theme_creation'), __('Bish Ajax Setting', 'theme_creation'), 'manage_options', 'bish-ajax', 'bish_plugin_options' );
	 //for top level menu
	 	 $option_page = add_menu_page( __('Bish Ajax', 'theme_creation'), __('Bish Ajax Setting', 'theme_creation'), 'manage_options', 'bish-ajax', 'bish_plugin_options', '' ,30 );

}
add_action( 'admin_menu', 'bish_plugin_menu' );

//plugin html
function bish_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
    
   <div class="bish_ajax">
   	<h3><?php _e( 'Bish Ajax', 'theme_creation' ); ?></h3>
   	<form action="" id="bish_form" method ="POST">
   		<input type="text" name="bish_input" id="bish_input"><br>
   		<input type="submit" class="button-primary" value="Submit">
   	</form>
   	<span id="result"></span>
   </div>

	<?php
}

//plugin styles and scripts
 function my_enqueue($hook) {
 	global $option_page;
    if ( $hook != $option_page ) {
        return;
    }

    wp_enqueue_style( 'bish-style', plugin_dir_url( __FILE__ ) . '/style.css', array(), null, 'all' );
    
    wp_enqueue_script( 'bish-ajax', plugin_dir_url( __FILE__ ) . '/js/bish-ajax.js', array('jquery') );
    // declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
   wp_localize_script( 'bish-ajax', 'ajaxobject', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'ajaxnonce' => wp_create_nonce('my_nonce') ) );

}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );

function bish_ajax_processing(){
	if (isset($_POST['post_id']) && wp_verify_nonce($_POST['ajaxnonce'], 'my_nonce')) {
		if(!empty($_POST['post_id'])){
			$post_id = $_POST['post_id'];
			//for custom queries use $wpdb class
			//get_results() for all rows and cols, get_row() for single row, get_col() for single cols, get_var() for single
			global $wpdb;
			$wpdb->update($wpdb->posts, array('post_title' => $post_id), array('ID' => 1), array("%s"), array("%d"));
            /*
			$posts = $wpdb->get_results(
				"SELECT post_title, post_content, post_author 
				FROM $wpdb->posts
				WHERE post_type = '".htmlentities($post_id)."'
				AND post_status != 'auto-draft'
				ORDER BY post_date DESC LIMIT 0,4"
				); 
				$result = '';
				if (!empty($posts)) {
					$result .= '<table><tr><th>Title</th><th>Content</th><th>Author</th></tr>';
					foreach ($posts as $post) {
						$result .= '<tr><td>'.$post->post_title.'</td><td>'.$post->post_content.'</td><td>'.get_the_author_meta( 'user_nicename', $post->post_author ).'</td></tr>';
					}
					$result .= '</table>';

				} else {
					$result = __( 'No result Found', 'theme_creation' );
				}
				echo $result;
				*/
				                
            /*
			//get posts  using WP_Query() , i think better to use get_posts() if there is no pagination
			$args = array('post_type' => 'post', 'category_name'=> $post_id);
			
			$posts = new WP_Query($args);
			$result = '';
			if ($posts->have_posts()) {
				$result .= '<table><tr><th>Title</th><th>Content</th></tr>';
				while ($posts->have_posts()) {
					$posts->the_post();
					$result .= '<tr><td>'.get_the_title(). '</td><td>'.get_the_content().'</td></tr>';
				}
				$result .= '</table>';
			}else{
				$result .= 'No Result Found.';
			}
			wp_reset_postdata();
			echo $result;
			*/

            /*
			//get posts using get_posts()
			$args = array('post_type' => 'post', 'category_name'=> $post_id);
			$posts = get_posts( $args );
			$result = '';
			if (!empty($posts)) {
				$result .= __('<table><tr><th>Title</th><th>Content</th></tr>', 'theme_creation');
				foreach ($posts as $post) {
					setup_postdata( $post );
					$result .= '<tr><td> '.apply_filters( 'the_title', $post->post_title ).'</td><td>'.apply_filters( 'the_content', $post->post_content ).'</td></tr>';
				}
				$result .= __('</table>', 'theme_creation');
			} else {
				$result .= __('No Result Found.', 'theme_creation');
			}
			
			
			wp_reset_postdata();
			echo $result;
			*/
			
		    /*
		    //for author related information, reference get_post_field(), get_the_author_meta()
			$author_id = get_post_field( 'post_author', $post_id );
			echo get_the_author_meta( 'user_email', $author_id );
			*/

		}else{
			_e( 'Please insert something.', 'theme_creation' );
		}
	}
	die();
}
add_action('wp_ajax_my_post', 'bish_ajax_processing');
add_action('wp_aja_nopriv_my_post', 'bish_ajax_processing');



<?php

//theme styles and scripts
function theme_creation_scripts() {
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
	wp_enqueue_style( 'normalize-style', get_template_directory_uri() . '/css/normalize.css', array(), null, 'all' );

	wp_enqueue_script( 'example1', get_template_directory_uri() . '/js/example1.js', array('jquery'), '1.0.0', true );
	// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
   wp_localize_script( 'example1', 'ajaxobject', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'ajaxnonce' => wp_create_nonce('my_nonce') ) );
}
add_action( 'wp_enqueue_scripts', 'theme_creation_scripts' );

//theme setup
if ( ! function_exists( 'theme_creation_setup' ) ) :

function theme_creation_setup() {

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'theme_creation' ),
		'footer'  => __( 'Footer Menu', 'theme_creation' ),
	) );
	add_theme_support( 'post-thumbnails' );
	add_image_size('thumb', 220, 180, true);
	add_image_size('medium', 500, 300, true);

}
endif; // theme_creation_setup

add_action( 'after_setup_theme', 'theme_creation_setup' );

function post_title(){
	if (isset($_POST['post_id']) && wp_verify_nonce($_POST['ajaxnonce'], 'my_nonce')) {
		$post_id = $_POST['post_id'];
		if(!empty($post_id)){
         echo $post_id;
		}else{
          echo 'Please Insert a post id.';
		}
	}
	die();
}
add_action('wp_ajax_my_post', 'post_title');
add_action('wp_ajax_nopriv_my_post', 'post_title');

//widget
function theme_creation_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'theme_creation' ),
        'id' => 'sidebar-1',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );

    register_sidebar( array(
        'name' => __( 'Second Wiget Area', 'theme_creation' ),
        'id' => 'sidebar-2',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
 
}
add_action( 'widgets_init', 'theme_creation_widgets_init' );

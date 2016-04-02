<?php
 
function sandbox_example_theme_menu() {
 
    add_theme_page(
        'Sandbox Theme',            // The title to be displayed in the browser window for this page.
        'Sandbox Theme',            // The text to be displayed for this menu item
        'manage_options',            // Which type of users can see this menu item
        'sandbox_theme_page',    // The unique ID - that is, the slug - for this menu item
        'sandbox_theme_display'     // The name of the function to call when rendering this menu's page
    );
 
} // end sandbox_example_theme_menu
add_action( 'admin_menu', 'sandbox_example_theme_menu' );
 
/**
 * Renders a simple page to display for the theme menu defined above.
 */
function sandbox_theme_display() {
?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">
     
        <div id="icon-themes" class="icon32"></div>
        <h2><?php _e( 'Sandbox Theme Options', 'WordPress-Settings-Sandbox'); ?></h2>

        <?php settings_errors(); ?>

        <?php $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'display_section'   ?>

        <h2 class="nav-tab-wrapper">
        <a href="?page=sandbox_theme_page&tab=display_section"
         class="nav-tab  <?php echo $active_tab == 'display_section' ? 'nav-tab-active' : ''  ?>">
         <?php _e( 'Display Section', 'WordPress-Settings-Sandbox' ); ?></a>
        <a href="?page=sandbox_theme_page&tab=social_section" 
        class="nav-tab <?php echo $active_tab == 'social_section' ? 'nav-tab-active' : ''  ?> ">
        <?php _e( 'Social Section', 'WordPress-Settings-Sandbox' ); ?></a>
        </h2>
         
        <form method="post" action="options.php">

            <?php 

                do_settings_sections( $active_tab ); 
                settings_fields( $active_tab );
            
            ?>
            
           
            <?php submit_button(); ?>
        </form>
        <!--
         if there is no tabbed section and all sections are in a single page then we need to provide a commong settings_fields parameter and need to use a common first parameter of register setting
         <?php do_settings_sections( 'sandbox_theme_page' ); ?> 
            <?php settings_fields( 'common_first_parameter_of_register_setting' ); ?>
            <?php submit_button(); ?>
        
         -->
<?php
} // end sandbox_theme_display
 
function sandbox_initialize_display_options() {
 
    // If the theme options don't exist, create them.
    if( false == get_option( 'sandbox_theme_display_options' ) ) {  
        add_option( 'sandbox_theme_display_options' );
    } // end if
 
    // First, we register a section. This is necessary since all future options must belong to a 
    add_settings_section(
        'display_section',         // ID used to identify this section and with which to register options
        __( 'Display Options', 'WordPress-Settings-Sandbox' ),  // Title to be displayed on the administration page
        'sandbox_general_options_callback', // Callback used to render the description of the section
        'display_section'     // Page on which to add this section of options
    );
     
    // Next, we'll introduce the fields for toggling the visibility of content elements.
    add_settings_field( 
        'show_header',                      // ID used to identify the field throughout the theme
        __( 'Header', 'WordPress-Settings-Sandbox' ),    // The label to the left of the option interface element
        'sandbox_toggle_header_callback',   // The name of the function responsible for rendering the option interface
        'display_section',       // The page on which this option will be displayed
        'display_section',         // The name of the section to which this field belongs
        array(                              // The array of arguments to pass to the callback. In this case, just a description.
            'Activate this setting to display the header.'
        )
    );
     
    add_settings_field( 
        'show_content',                     
        __( 'Content', 'WordPress-Settings-Sandbox' ),              
        'sandbox_toggle_content_callback',  
        'display_section',                    
        'display_section',         
        array(                              
            'Activate this setting to display the content.'
        )
    );
     
    add_settings_field( 
        'show_footer',                      
        __( 'Footer', 'WordPress-Settings-Sandbox' ),               
        'sandbox_toggle_footer_callback',   
        'display_section',        
        'display_section',         
        array(                              
            'Activate this setting to display the footer.'
        )
    );
     
    // Finally, we register the fields with WordPress
    register_setting(
        'display_section',   //group name(section name)
        'sandbox_theme_display_options' //it is a array name which is an option in wp_options table. It can holds all three fiends, i.e sandbox_theme_display_options[show_header], sandbox_theme_display_options[show_content] and sandbox_theme_display_options[show_footer]
    );
     
} // end sandbox_initialize_theme_options
add_action('admin_init', 'sandbox_initialize_display_options');
 
function sandbox_general_options_callback() {
    _e( '<p>Select which areas of content you wish to display.</p>', 'WordPress-Settings-Sandbox' );
} // end sandbox_general_options_callback
 
function sandbox_toggle_header_callback($args) {
     
    // First, we read the options collection
    $options = get_option('sandbox_theme_display_options');
     
    // Next, we update the name attribute to access this element's ID in the context of the display options array
    // We also access the show_header element of the options collection in the call to the checked() helper function
    $html = '<input type="checkbox" id="show_header" name="sandbox_theme_display_options[show_header]" value="1" ' . checked(1, $options['show_header'], false) . '/>'; 
     
    // Here, we'll take the first argument of the array and add it to a label next to the checkbox
    $html .= '<label for="show_header"> '  . $args[0] . '</label>'; 
     
    echo $html;
     
} // end sandbox_toggle_header_callback
 
function sandbox_toggle_content_callback($args) {
 
    $options = get_option('sandbox_theme_display_options');
     
    $html = '<input type="checkbox" id="show_content" name="sandbox_theme_display_options[show_content]" value="1" ' . checked(1, $options['show_content'], false) . '/>'; 
    $html .= '<label for="show_content"> '  . $args[0] . '</label>'; 
     
    echo $html;
     
} // end sandbox_toggle_content_callback
 
function sandbox_toggle_footer_callback($args) {
     
    $options = get_option('sandbox_theme_display_options');
     
    $html = '<input type="checkbox" id="show_footer" name="sandbox_theme_display_options[show_footer]" value="1" ' . checked(1, $options['show_footer'], false) . '/>'; 
    $html .= '<label for="show_footer"> '  . $args[0] . '</label>'; 
     
    echo $html;
     
} // end sandbox_toggle_footer_callback



//social options

function sandbox_initialize_social_optons(){

    if (false == get_option( 'sandbox_theme_social_options' )) {
        add_option('sandbox_theme_social_options' );
    }

    add_settings_section( 'social_section', __('Social Section', 'WordPress-Settings-Sandbox'), 'social_section_callback', 'social_section' );
    add_settings_field( 'sandbox_facebook', __('Facebook', 'WordPress-Settings-Sandbox'), 'sandbox_facebook_callback', 'social_section', 'social_section', array('Enter Facebook link...') );
    add_settings_field( 'sandbox_twitter', __('Twitter', 'WordPress-Settings-Sandbox'), 'sandbox_twitter_callback', 'social_section', 'social_section', array('Enter Twitter link...') );
    add_settings_field( 'sandbox_youtube', __('YouTube', 'WordPress-Settings-Sandbox'), 'sandbox_youtube_callback', 'social_section', 'social_section', array('Enter YouTube link...') );
    register_setting( 'social_section', 'sandbox_theme_social_options', 'sandbox_social_sanitization'); 
    /*
    for tabbed navigation we have to use unique first parameter for each register_setting.
    if sections are in a same page then have to use a common first parameter for all register_setting.
    */
}
add_action('admin_init', 'sandbox_initialize_social_optons' );

//section callback
function social_section_callback(){
    _e( '<p>Setting for social media links.</p>', 'WordPress-Settings-Sandbox' );
}

//facebook field callback
function sandbox_facebook_callback($args){
    $social_options = get_option('sandbox_theme_social_options' );
    echo '<input type="text" id="sandbox_facebook" name="sandbox_theme_social_options[sandbox_facebook]" value="'.$social_options['sandbox_facebook'].'"  placeholder="'.$args[0].'" >';
}

//twitter field callback
function sandbox_twitter_callback($args){
    $social_options = get_option('sandbox_theme_social_options' );
    echo '<input type="text" id="sandbox_twitter" name="sandbox_theme_social_options[sandbox_twitter]" value="'.$social_options['sandbox_twitter'].'"  placeholder="'.$args[0].'" >';
}

//youtube field callback
function sandbox_youtube_callback($args){
    $social_options = get_option('sandbox_theme_social_options' );
    echo '<input type="text" id="sandbox_youtube" name="sandbox_theme_social_options[sandbox_youtube]" value="'.$social_options['sandbox_youtube'].'"  placeholder="'.$args[0].'" >';
}
//social sanitization
function sandbox_social_sanitization($input){
    $output = array();
    foreach( $input as $key => $val ) {   
        if( isset ( $input[$key] ) ) {
            $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
        } 
     
    } 
    return apply_filters( 'sandbox_social_sanitization', $output, $input ); 
}

<?php 
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}
 
$option_name = 'prof_widget';
 
// For site options in Multisite
delete_site_option( $option_name );

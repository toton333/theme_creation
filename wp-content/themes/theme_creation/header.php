<!doctype html>
<html lang="<?php bloginfo('language') ?>">
<head>
	<meta charset="<?php bloginfo('charset') ?>" >
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
	<title><?php bloginfo('name') ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="page-wrap">
		<header class="clearfix">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			
			<div class="search">
				<?php  get_search_form(); ?>
			</div><!-- end of search form div -->
			
	        
		</header>
		<div class="mainmenu clearfix">
			<?php

			if (function_exists('wp_nav_menu')) {
                $args = array(
                     'theme_location'  => 'primary',
                     'container' => 'none'
                	);
				wp_nav_menu($args);
			}
             
			?>
		</div> <!--end of navigation div -->
			
		<div class="inner-wrap clearfix">
           
           	
           
           
		
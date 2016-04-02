<!DOCTYPE html>
<html>
    <head>    
        <title>The Complete Guide To The Settings API | Sandbox Theme</title>
    </head>
    <body>
     
        <?php $display_options = get_option( 'sandbox_theme_display_options' ); ?>
        <?php $social_options = get_option ( 'sandbox_theme_social_options' ); ?>
     
        <?php if( $display_options[ 'show_header' ] ) { ?>
            <div id="header">
                <h1>Sandbox Header</h1>
            </div><!-- /#header -->
        <?php } // end if ?>
         
        <?php if( $display_options[ 'show_content' ] ) { ?>
            <div id="content" style="border-bottom:1px solid grey; padding-bottom:10px;" >
                Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur aliquet quam id dui posuere blandit. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Nulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Nulla quis lorem ut libero malesuada feugiat. Donec rutrum congue leo eget malesuada.
            </div><!-- /#content -->
        <?php } // end if ?>
         
        <?php if( $display_options[ 'show_footer' ] ) { ?>
            <div id="footer">
                <?php 
                 $social_string = '';
                  foreach ($social_options as $key => $value) {
                      $social_string .= $social_options[$key] ? '<a href="'.$value.'">'.ltrim($key, 'sandbox_').'</a> | ' : '';
                  }
                  echo rtrim($social_string, ' | ');
                ?>
                <p>© <?php echo date('Y'); ?> All Rights Reserved.</p>
            </div><!-- /#footer -->
        <?php } // end if ?>
     
    </body>
</html>
<?php ?>
<head>
<meta charset="utf-8">
<title><?php wp_title( '&#124;', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="site-container container-fluid">	
        <div class="site-header">	
            <?php $header_image = get_header_image();
            if ( ! empty( $header_image ) ) { ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                   <img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="
                <?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a><?php 
                    
            }?>
            <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
            <nav class="navbar navbar-default" role="navigation">
                <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                   

        <?php
            wp_nav_menu( array(
                'menu'              => 'main',
                'theme_location'    => 'main',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'menu nav-primary menu-primary',
	        'container_id'      => '',
                'menu_class'        => 'menu-main menu-primary nav navbar-nav container'
         
             
            
	      ));
        ?>
    </div>
</nav>
	</div>
	


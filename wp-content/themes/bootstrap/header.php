<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8">
<title><?php wp_title( '&#124;', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="site-container">	
        <div class="site-header">	
	    <nav class="nav-primary navbar-default" role="navigation">
		 <?php wp_nav_menu( array(
		    'theme_location'    => 'primary',
		    'depth'             => 2,
		    'container'         => 'div',
		    'container_class'   => 'container',
		    'container_id'      => '',
		    'menu_class'        => 'menu-main menu-primary'));
		 ?>
	    </nav>
	    <div class="container">	
		<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>
	</div>
    <div class="site-content">	


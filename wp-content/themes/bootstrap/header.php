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
<?php 
global $my_Admin;
$headerlayout = $my_Admin->get_option_value('header_layout');
$image1 = $my_Admin->get_option_value('header_image1');

if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>    

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <div class="site-container">	
        <div class="site-header">	
	<?php echo $image1;?>
<?php if ($headerlayout==='header1') get_template_part( 'header_contact' ); ?>
       <div id="headerslide" data-service="<?php echo $image1;?>" style="height:35vh;width:100%;">	
	   <p class="caption"></p>
          <p class="caption2"></p>
       </div>    
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
	    <div class="site-description">	
	    <div class="container"><div class="col-md-12">
		<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div></div>
	</div></div>
    <div class="site-content">	


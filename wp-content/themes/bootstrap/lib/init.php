<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*****************************************************************************
** custom colours
 * CSS in admin side
*****************************************************************************/
add_action('admin_head', 'custom_colors');
function custom_colors() {
    echo '<style type="text/css"> 
    span.helptext {
	    color: blue;
	}
    span.helptext:hover:after {
	color: blue;
	content: attr(data-tip-content);
	background: yellow;
	border: 1px dotted black;
	margin: 10px;
	padding: 10px;
	cursor: pointer;
    }
    .image-radio img {
width: 20%;
height: auto;
}
    </style>';
   }


/*****************************************************************************
************************Add theme templates **********************************
*****************************************************************************/
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    $x= load_theme_textdomain('txt_kobotolo', get_template_directory() . '/languages');
    get_template_part('lib/post_functions' );
    get_template_part('lib/kobotolo_tax');
    get_template_part('lib/cls_menu');
    //get_template_part('lib/resonsive_menu');
    //get_template_part('lib/kobotolo_settings');
     get_template_part('lib/cls_optionbase');
    get_template_part('lib/cls_themeoptions');
    get_template_part('lib/cls_inittheme');
    include_once get_template_directory() . '/lib/plugins/sidebar_generator.php';
    include_once get_template_directory() . '/lib/plugins/multi-post-thumbnails.php';
     get_template_part('lib/cls_themepagesettings');

    //    add_theme_page('KoBoToLo Settings', 'KoBoToLo Settings');//, 'administrator');//, $menu_slug, $function, $icon_url, $position ); 

    if ( ! isset( $content_width ) ) {
	$content_width = 600;
    }
    add_editor_style( get_stylesheet_directory_uri().'/style.css'); 
//Define additional "post thumbnails". Relies on MultiPostThumbnails to work
if (class_exists('MultiPostThumbnails')) {
    _log('class exists');
    new MultiPostThumbnails(array(
        'label' => __('2nd Feature Image','txt_kobotolo'),
        'id' => 'feature-image-2',
        'post_type' => 'post'
        )
    );
    new MultiPostThumbnails(array(
        'label' => __('3nd Feature Image','txt_kobotolo'),
        'id' => 'feature-image-3',
        'post_type' => 'post'
        )
    );
}}

/*****************************************************************************
************************Addmin scripts ***************************************
*****************************************************************************/
add_action( 'admin_enqueue_scripts', 'kobotolo_admin_scripts' );
function kobotolo_admin_scripts()
{
    wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script(        'iris',
            admin_url( 'js/iris.min.js' ),
            array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ),
            false,
            1
        );
    wp_enqueue_script( 'admin-script-handle',get_stylesheet_directory_uri() . '/lib/js/settings.js', array( 'wp-color-picker' ), false, true ); 
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
 
    wp_enqueue_script('media-upload');
    wp_enqueue_script( 'admin-script-handle2',get_stylesheet_directory_uri() . '/lib/js/kobotolo_mediaupload.js',array('jquery'), '', true ); 
    wp_enqueue_script('kobotolo_mediaupload');
    //<link rel="stylesheet" href="flexslider.css" type="text/css">
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    //<script src="jquery.flexslider.js"></script>
//    wp_enqueue_script('script', plugins_url('upload.js', __FILE__), array('jquery'), '', true); 
?>

<?php

}

/*****************************************************************************
****************************Wp scripts ***************************************
*****************************************************************************/
add_action( 'wp_enqueue_scripts', 'kobotolo_scripts' );
function kobotolo_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/bootstrap/css/bootstrap.css', array(), '4.0.3' );
    wp_enqueue_style( 'bootstrap-resp', get_stylesheet_directory_uri() . '/bootstrap/css/bootstrap-responsive.css', array(), '4.0.3' );
    wp_enqueue_script( 'bootstrapjs', get_stylesheet_directory_uri() . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
    wp_enqueue_script( 'menu', get_stylesheet_directory_uri() . '/lib/js/drop-down-nav.js', array( 'jquery' ) );
    wp_enqueue_style( 'menucss', get_stylesheet_directory_uri()  . '/lib/css/menu.css', array(), '4.0.3' );
    wp_enqueue_script( 'masonry' );
    wp_enqueue_script( 'masonry-init', get_stylesheet_directory_uri() . '/lib/js/masonry-init.js', '', array( 'jquery' ), true);
    wp_enqueue_script( 'flexsliderjs',get_stylesheet_directory_uri() . '/lib/js/jquery.flexslider.js',array('jquery'), '', true ); 
    wp_enqueue_script( 'flexslider-init', get_stylesheet_directory_uri() . '/lib/js/flexslider_init.js', '', array( 'jquery' ), true);
    wp_enqueue_script( 'backstretchjs',get_stylesheet_directory_uri() . '/lib/js/jquery.backstretch.js',array('jquery'), '', true ); 
    wp_enqueue_script( 'vegas-init', get_stylesheet_directory_uri() . '/lib/js/vegas_init.js', '', array( 'jquery' ), true);
    
    wp_enqueue_style( 'afn-font-awesome', get_stylesheet_directory_uri()  . '/lib/css/font-awesome.min.css', array(), '4.0.3' );
    wp_enqueue_style( 'vegascss', get_stylesheet_directory_uri()  . '/lib/css/jquery.vegas.css', array(), '4.0.3' );
    //wp_enqueue_style( 'bootstrapcss', get_stylesheet_directory_uri() . '/lib/css/flexslider.css', array(), '4.0.3' );
    wp_enqueue_style( 'flexslidercss', get_stylesheet_directory_uri() . '/lib/css/flexslider.css', array(), '4.0.3' );
}

/*****************************************************************************
****************************Add image sizes **********************************
*****************************************************************************/
add_image_size('portfolio_3', 500, 500, true);
add_image_size('portfolio_4', 400, 400, true);
add_image_size('portfolio_5', 300, 300, true);
add_image_size('post_thumbnail', 100, 100, true);
define('HEADER_IMAGE_WIDTH', 300);
define('HEADER_IMAGE_HEIGHT', 80);
/*****************************************************************************
****************************Add theme support **********************************
*****************************************************************************/
add_theme_support( 'post-thumbnails');
add_theme_support( 'custom-background' );
add_theme_support( 'html5', array( 'gallery', 'caption' ) );
$args = array(
	'flex-width'    => true,
	'width'         => 980,
	'flex-height'    => true,
	'height'        => 200,
	'default-image' => get_template_directory_uri() . '/images/header.jpg',
);
add_theme_support( 'custom-header', $args );
add_post_type_support( 'post', 'excerpt' ); 
add_theme_support( 'automatic-feed-links' );
/*****************************************************************************
**************************** Init menu **********************************
*****************************************************************************/
add_action( 'init', 'kobotolo_menus' );
function kobotolo_menus() {
  register_nav_menus(
    array(
      'primary' => __( 'Header Menu', 'txt_kobotolo' )
      )
  );
  kobotolo_custom_post_type();
}

/*****************************************************************************
**************************** Init widgets ************************************
*****************************************************************************/
function kobotolo_widgets_init() {
	register_sidebar( array(
		'name' => 'Home right sidebar',
		'id' => 'default',
		'before_widget' => '<div class="col-md-4>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Home Below Nav',
		'id' => 'below_nav',
		'before_widget' => '<div class="slider">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => 'Footer left',
		'id' => 'footer_left',
		'before_widget' => '<div class="footer-left">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => 'Footer center',
		'id' => 'footer_center',
		'before_widget' => '<div class="footer-center ">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => 'Footer right',
		'id' => 'footer_right',
		'before_widget' => '<div class="footer-right">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
    //get_template_part('lib/KoBoToLo - Meta');
    //get_template_part('lib/portfolio');
}
add_action( 'widgets_init', 'kobotolo_widgets_init' );


/*****************************************************************************
**************************** Add image sizes on the fly **********************
*****************************************************************************/
add_filter('image_downsize', 'ml_media_downsize', 10, 3);
function ml_media_downsize($out, $id, $size) {
    $test =0;
    if (is_admin()) return;
if ($test) print_r($size);
if ($test) print_r($out);
if ($test) print_r($id);
    
    $imagedata = wp_get_attachment_metadata($id);
if ($test) echo "\nImagemetadata<pre>";
if ($test) var_dump($imagedata['sizes']);
    
    if (is_array($imagedata) && isset($imagedata['sizes'][$size]))
    return false;
    
if ($test) echo "\nmedia_down_size do not exist i databas\n ";
    	global $_wp_additional_image_sizes;
if ($test) print_r($_wp_additional_image_sizes[$size]);
        if (!isset($_wp_additional_image_sizes[$size])) return false;
if ($test) echo "\nsize do not exist".$size."\n";
if ($test) echo "\nid:". get_attached_file($id)."\n";
    $filepath=get_attached_file($id);
        
if ($test) 	echo "\nfilepath:".$filepath."\n";
	$resized = image_make_intermediate_size(
                $filepath,
		$_wp_additional_image_sizes[$size]['width'],
                $_wp_additional_image_sizes[$size]['height'],
                $_wp_additional_image_sizes[$size]['crop']
            );
if ($test) 	    echo "\nResized=";
if ($test) print_r($resized);
	    if (!$resized )
                return false;
if ($test) echo 'media_dow_size 2';

            // Save image meta, or WP can't see that the thumb exists now
            $imagedata['sizes'][$size] = $resized;
            wp_update_attachment_metadata($id, $imagedata);

            $att_url = wp_get_attachment_url($id);
            return array(dirname($att_url) . '/' . $resized['file'], $resized['width'], $resized['height'], true);
if ($test)  echo "</pre>\n";       
 
}
    
function filter_image_sizes( $sizes) {   
    unset( $sizes['portfolio_3']);
    unset( $sizes['portfolio_4']);
    unset( $sizes['portfolio_5']);
    unset( $sizes['post_thumbnail']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'filter_image_sizes');
/*****************************************************************************
************************Nou used **********************************
*****************************************************************************/
function mytheme_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'mytheme_new_section_name' , array(
    'title'      => __( 'Visible Section Name', 'txt_kobotolo' ),
    'priority'   => 30,
) );
    
   $wp_customize->add_setting( 'header_textcolor' , array(
    'default'     => '#000000',
    'transport'   => 'refresh',
) );//All our sections, settings, and controls will be added here
}

//add_action( 'customize_register', 'mytheme_customize_register' );
add_filter( 'wp_nav_menu_items', 'kobotolo_menu', 10, 2 );
function kobotolo_menu($menu, stdClass $args) {
    $args = (array)$args;   
    //echo '<br><pre>';print_r($args);echo '</pre>';
    
//echo 'kobotolo_menu';
    if ( 'primary' == $args['theme_location']  ) {
	$logo= '<img src="'.get_header_image().'" style="float:left;"/>';
	$menu='<li class="menu-item"><a href="'.'">'.$logo.'</a></li>'.$menu;
        global $my_Admin;
	
	$logo = $my_Admin->get_option_value('logo');
	$soc = $my_Admin->get_option_value('facebook');
	
	if ($soc!=='') {
	    $soc='<div class="menu-right"> <li class="menu-item"><a href="'.$soc.'"><i class="fa fa-facebook"></i></a></li>';
	}
		
	$soc2 = $my_Admin->get_option_value('twitter');
	if ($soc2!=='') {
	$soc2 =  '<li class="menu-item"><a href="'.$soc2.'"><i class="fa fa-twitter"></i></a></li></div>';
//		<i class="fa fa-twitter"></i>';
	}
	$menu= $menu.$soc.$soc2;
	}
return $menu;
}
        if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}

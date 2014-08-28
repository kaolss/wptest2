<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once( dirname( __FILE__ ) . '/post_functions.php' );
require_once( dirname( __FILE__ ) . '/kobotolo_settings.php' );
require_once( dirname( __FILE__ ) . '/portfolio.php' );
require_once( dirname( __FILE__ ) . '/portfolio2.php' );
require_once( dirname( __FILE__ ) . '/KoBoToLo - Meta.php' );

add_action( 'wp_enqueue_scripts', 'load_fontawesome_style', 999 );
function load_fontawesome_style() {
    wp_enqueue_style( 'afn-font-awesome', get_bloginfo( 'stylesheet_directory' ) . '/fonts/font-awesome.min.css', array(), '4.0.3' );
}

add_filter( 'wp_nav_menu_items', 'kobotolo_menu', 10, 2 );
function kobotolo_menu($menu, stdClass $args) {
    $args = (array)$args;   
    if ( 'header-menu' == $args['theme_location']  ) {?>
		<?php 
		$menu= '<img src="'.get_header_image().'" />'.$menu;
        $soc =  '<li class="menu-item menu-right"><a href="http://xxx"><i class="fa fa-facebook"></i></a></li>';
        $soc2 =  '<li class="menu-item menu-right"><a href="http://xxx"><i class="fa fa-twitter"></i></a></li>';
//		<i class="fa fa-twitter"></i>';
  
	$menu= $menu.$soc.$soc2;
	}
return $menu;
}

add_action( 'wp_enqueue_scripts', 'kobotolo_scripts' );
function kobotolo_scripts()
{
wp_enqueue_script('jquery');
    wp_enqueue_script( 'bootstrapjs', get_bloginfo( 'stylesheet_directory' ) . '/bootstrap/js/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'init_carousel', get_bloginfo( 'stylesheet_directory' ) . '/lib/carousel.js', array( 'jquery' ) );
    wp_enqueue_style( 'bootstrap', get_bloginfo( 'stylesheet_directory' ) . '/bootstrap/css/bootstrap.css', array(), '4.0.3' );
    wp_enqueue_style( 'bootstrap-resp', get_bloginfo( 'stylesheet_directory' ) . '/bootstrap/css/bootstrap-responsive.css', array(), '4.0.3' );


}
add_image_size('portfolio_3', 500, 500, true);
add_image_size('portfolio_4', 400, 400, true);
add_image_size('portfolio_5', 300, 300, true);
//add_filter('image_size_names_choose', 'display_image_sizes');
function display_image_sizes($sizes) {
   $sizes['portfolio'] = __( 'portfolio' );
   return $sizes;
}

add_theme_support( 'html5' );
add_theme_support( 'post-thumbnails');
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_post_type_support( 'post', 'excerpt' ); 

add_action( 'init', 'kobotolo_menus' );
function kobotolo_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
  kobotolo_custom_post_type();
}

function kobotolo_widgets_init() {
	register_sidebar( array(
		'name' => 'Home right sidebar',
		'id' => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Home Below Nav',
		'id' => 'below_nav',
		'before_widget' => '<div class="slider">',
		'after_widget' => '</div>',
		'before_title' => '>',
		'after_title' => '>',
	) );
	register_sidebar( array(
		'name' => 'Footer left',
		'id' => 'footer_left',
		'before_widget' => '<div class="footer-left">',
		'after_widget' => '</div>',
		'before_title' => '>',
		'after_title' => '>',
	) );
	register_sidebar( array(
		'name' => 'Footer center',
		'id' => 'footer_center',
		'before_widget' => '<div class="footer-center ">',
		'after_widget' => '</div>',
		'before_title' => '>',
		'after_title' => '>',
	) );
	register_sidebar( array(
		'name' => 'Footer right',
		'id' => 'footer_right',
		'before_widget' => '<div class="footer-right">',
		'after_widget' => '</div>',
		'before_title' => '>',
		'after_title' => '>',
	) );
}
add_action( 'widgets_init', 'kobotolo_widgets_init' );

function mason_script() {
 wp_enqueue_script( 'masonry' );
 wp_enqueue_script( 'masonry-init', get_bloginfo( 'stylesheet_directory' ) . '/lib/js/masonry-init.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'mason_script' );

add_filter('image_downsize', 'ml_media_downsize', 10, 3);
function ml_media_downsize($out, $id, $size) {
    if (is_admin()) return;
	$imagedata = wp_get_attachment_metadata($id);
	if (is_array($imagedata) && isset($imagedata['sizes'][$size]))
                return false;
	global $_wp_additional_image_sizes;
        if (!isset($_wp_additional_image_sizes[$size])) return false;
            if (!$resized = image_make_intermediate_size(
                get_attached_file($id),
                $_wp_additional_image_sizes[$size]['width'],
                $_wp_additional_image_sizes[$size]['height'],
                $_wp_additional_image_sizes[$size]['crop']
            ))
                return false;

            // Save image meta, or WP can't see that the thumb exists now
 //           $imagedata['sizes'][$size] = $resized;
            wp_update_attachment_metadata($id, $imagedata);

            $att_url = wp_get_attachment_url($id);
            return array(dirname($att_url) . '/' . $resized['file'], $resized['width'], $resized['height'], true);
        }


//        add_filter('intermediate_image_sizes_advanced', 'ml_media_prevent_resize_on_upload');
        function ml_media_prevent_resize_on_upload($sizes) {
            // Removing these defaults might cause problems, so we don't
            return array(
                'thumbnail' => $sizes['thumbnail'],
                'medium' => $sizes['medium'],
                'large' => $sizes['large']
            );
        }
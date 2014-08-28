<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //require_once( dirname( __FILE__ ) . '/KoBoToLo - Meta.php' );
if ( ! function_exists('Kobotolo_custom_post_type') ) {

// Register Custom Post Type
    function Kobotolo_custom_post_type() {
        
	$labels = array(
		'name'                => _x( 'Portfolio items', 'Post Type General Name', 'txt_KoBoToLo' ),
		'singular_name'       => _x( 'Portfolio item', 'Post Type Singular Name', 'txt_KoBoToLo' ),
		'menu_name'           => __( 'Portfolio', 'txt_KoBoToLo' ),
		'parent_item_colon'   => __( 'Parent Item:', 'txt_KoBoToLo' ),
		'all_items'           => __( 'All portfolio items', 'txt_KoBoToLo' ),
		'view_item'           => __( 'View Item', 'txt_KoBoToLo' ),
		'add_new_item'        => __( 'Add New Item', 'txt_KoBoToLo' ),
		'add_new'             => __( 'Add New', 'txt_KoBoToLo' ),
		'edit_item'           => __( 'Edit Item', 'txt_KoBoToLo' ),
		'update_item'         => __( 'Update Item', 'txt_KoBoToLo' ),
		'search_items'        => __( 'Search Item', 'txt_KoBoToLo' ),
		'not_found'           => __( 'Not found', 'txt_KoBoToLo' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'txt_KoBoToLo' ),
	);
	$args = array(
		'description'         => __( 'Post type for portfolio items', 'txt_KoBoToLo' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'          => array( 'portfolio_categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
                'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
	);
	register_post_type( 'portfolio_kobotolo', $args );
        
	}
       

    $labels = array( 
        'name' => _x( 'Portfolio filter', 'portfolio_categories' ),
        'singular_name' => _x( 'Portfolio filter', 'portfolio_categories' ),
        'search_items' => _x( 'Search Portfolio filter', 'portfolio_categories' ),
        'popular_items' => _x( 'Popular filters', 'portfolio_categories' ),
        'all_items' => _x( 'All filters', 'portfolio_categories' ),
        'parent_item' => _x( 'Parent filter', 'portfolio_categories' ),
        'parent_item_colon' => _x( 'Parent Filter:', 'portfolio_categories' ),
        'edit_item' => _x( 'Edit Filter', 'portfolio_categories' ),
        'update_item' => _x( 'Update Filter', 'portfolio_categories' ),
        'add_new_item' => _x( 'Add New Filter', 'portfolio_categories' ),
        'new_item_name' => _x( 'New PFilter', 'portfolio_categories' ),
        'separate_items_with_commas' => _x( 'Separate Filters with commas', 'portfolio_categories' ),
        'add_or_remove_items' => _x( 'Add or remove Filter', 'portfolio_categories' ),
        'choose_from_most_used' => _x( 'Choose from the most used Filter', 'portfolio_categories' ),
        'menu_name' => _x( 'Portfolio Filter', 'portfolio_categories' ),
        // 'register_meta_box_cb' => 'add_events_metaboxes',
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'portfolio_categories', array('portfolio_kobotolo','pages'), $args );

}    

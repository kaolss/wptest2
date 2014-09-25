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
		'name'                => __( 'Portfolio items', 'txt_kobotolo' ),
		'singular_name'       => __( 'Portfolio item', 'txt_kobotolo' ),
		'menu_name'           => __( 'Portfolio', 'txt_kobotolo' ),
		'parent_item_colon'   => __( 'Parent Item:', 'txt_kobotolo' ),
		'all_items'           => __( 'All portfolio items', 'txt_kobotolo' ),
		'view_item'           => __( 'View Item', 'txt_kobotolo' ),
		'add_new_item'        => __( 'Add New Portfolio Post', 'txt_kobotolo' ),
		'add_new'             => __( 'Add New Portfolio', 'txt_kobotolo' ),
		'edit_item'           => __( 'Edit Item', 'txt_kobotolo' ),
		'update_item'         => __( 'Update Item', 'txt_kobotolo' ),
		'search_items'        => __( 'Search Item', 'txt_kobotolo' ),
		'not_found'           => __( 'Not found', 'txt_kobotolo' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'txt_kobotolo' ),
	);
	
	$args = array(
		'description'         => __( 'Post type for portfolio items', 'txt_kobotolo' ),
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
        'name' => _x( 'Portfolio filter','portfolio_filter','txt_kobotolo' ),
        'singular_name' => _x( 'Portfolio filter', 'portfolio_filter', 'txt_kobotolo'),
        'search_items' => __( 'Search Portfolio filter','txt_kobotolo' ),
        'popular_items' => __( 'Popular filters', 'txt_kobotolo' ),
        'all_items' => __( 'All filters', 'txt_kobotolo'),
        'parent_item' => __( 'Parent filter', 'txt_kobotolo' ),
        'parent_item_colon' => __( 'Parent Filter:', 'txt_kobotolo' ),
        'edit_item' => __( 'Edit Filter' ,'txt_kobotolo'),
        'update_item' => __( 'Update Filter', 'txt_kobotolo'),
        'add_new_item' => __( 'Add New Filter', 'txt_kobotolo' ),
        'new_item_name' => __( 'New Item Name', 'txt_kobotolo' ),
        'separate_items_with_commas' => _x( 'Separate Filters with commas','portfolio_filter', 'txt_kobotolo'),
        'add_or_remove_items' => _x( 'Add or remove Filter','portfolio_filter', 'txt_kobotolo' ),
        'choose_from_most_used' => _x( 'Choose from the most used Filter', 'portfolio_filter','txt_kobotolo' ),
        'menu_name' => __( 'Portfolio Filter', 'txt_kobotolo' ),
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

    register_taxonomy( 'portfolio_categories', array('portfolio_kobotolo','page'), $args );

}    

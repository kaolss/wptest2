<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once( dirname( __FILE__ ) . '/KoBoToLo - Meta.php' );
if ( ! function_exists('custom_post_type') ) {

// Register Custom Post Type
function Kobotolo_custom_post_type() {
        
	$labels = array(
		'name'                => _x( 'Portfolio items', 'Post Type General Name', 'txt_KoBoToLo' ),
		'singular_name'       => _x( 'Portfolio item', 'Post Type Singular Name', 'txt_KoBoToLo' ),
		'menu_name'           => __( 'Portfolio kobotolo', 'txt_KoBoToLo' ),
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
		'label'               => __( 'pioio', 'txt_KoBoToLo' ),
		'description'         => __( 'Post type for portfolio items', 'txt_KoBoToLo' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'          => array( 'portfolio_categories' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		//'register_meta_box_cb' => 'add_events_metaboxes',
            'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
	);
	register_post_type( 'portfoliok', $args );
        
	}
       

    $labels = array( 
        'name' => _x( 'Portfolio_categories', 'portfolio_categories' ),
        'singular_name' => _x( 'Portfolio_category', 'portfolio_categories' ),
        'search_items' => _x( 'Search Portfolio_categories', 'portfolio_categories' ),
        'popular_items' => _x( 'Popular Portfolio_categories', 'portfolio_categories' ),
        'all_items' => _x( 'All Portfolio_categories', 'portfolio_categories' ),
        'parent_item' => _x( 'Parent Portfolio_category', 'portfolio_categories' ),
        'parent_item_colon' => _x( 'Parent Portfolio_category:', 'portfolio_categories' ),
        'edit_item' => _x( 'Edit Portfolio_category', 'portfolio_categories' ),
        'update_item' => _x( 'Update Portfolio_category', 'portfolio_categories' ),
        'add_new_item' => _x( 'Add New Portfolio_category', 'portfolio_categories' ),
        'new_item_name' => _x( 'New Portfolio_category', 'portfolio_categories' ),
        'separate_items_with_commas' => _x( 'Separate portfolio_categories with commas', 'portfolio_categories' ),
        'add_or_remove_items' => _x( 'Add or remove portfolio_categories', 'portfolio_categories' ),
        'choose_from_most_used' => _x( 'Choose from the most used portfolio_categories', 'portfolio_categories' ),
        'menu_name' => _x( 'Portfolio_categories', 'portfolio_categories' ),
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

    register_taxonomy( 'portfolio_categories', array('Portfoliok','pages'), $args );

    $meta_boxes[] = array(
    'id' => 'my-meta-box-2',
    'title' => 'Custom meta box 2',
    'pages' => array('post', 'page'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Categories',
            'id' => $prefix . 'cats',
            'type' => 'taxonomy',                    // taxonomy
            'options' => array(
                'taxonomy' => 'portfolio_categories',            // taxonomy name
                'type' => 'select',                    // how to show taxonomy? 'select' (default) or 'checkbox_list'
                'args' => array()                    // arguments to query taxonomy, see http://goo.gl/795Vm
            )
    )
));
    
    $Meta_fields_check = 
	array ('usesidebar'=>'Vill du visa sidebar på sidan?');
    $Meta_fields_text = 
	array ('number'=>'Hur många bilder per rad (3, 4 eller 5)');
    $Meta_fields_textarea = 
	array ('open');
 
    
    $Meta = new Cls_Meta($Meta_fields_check, $Meta_fields_text, $Meta_fields_textarea);  
}


// Hook into the 'init' action
//add_action( 'init', 'custom_post_type', 0 );

        




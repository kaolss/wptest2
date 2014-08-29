<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 require_once( dirname( __FILE__ ) . '/KoBoToLo - Meta.php' );

    $meta_boxes[] = array(
    'id' => 'my-meta-box-2',
    'title' => 'Custom meta box 2',
    'pages' => array('post', 'page'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Categories',
            'id' =>  'cats',
            'type' => 'taxonomy',                    // taxonomy
            'options' => array(
                'taxonomy' => 'portfolio_categories',            // taxonomy name
                'type' => 'select',                    // how to show taxonomy? 'select' (default) or 'checkbox_list'
                'args' => array()                    // arguments to query taxonomy, see http://goo.gl/795Vm
            )
    )
));
    
     $Meta_fields_check = 
	array ('usesidebar'=>array('Visa sidebar',0));
    $Meta_fields_text = 
	array ('number'=>array('Detta är en textarea','Detta är defaulttexten'));
    $Meta_fields_textarea = 
	array ('txt'=>array('Hur många bilder per rad (13, 14 eller 15)',3));
    $Meta_fields_special = array ('portfolio_categories'=> array('Taxonomy','Välj filter för portfolion'),
      'category'=> array('Taxonomy','Välj filter för portfolion'));
     
    //$Meta = new Cls_Meta($Meta_fields_check, $Meta_fields_text, $Meta_fields_textarea, 'kobotolo_portfolio2');  



// Hook into the 'init' action
//add_action( 'init', 'custom_post_type', 0 );





<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once( dirname( __FILE__ ) . '/KoBoToLo - Meta.php' );

    $Meta_fields_check = 
	array ('usesidebar'=>array(__('Show sidebar?','txt_kobotolo'),0));
    $Meta_fields_text = 
	array ('number'=>array(__('How many images in rows (3, 4 eller 5)','txt_kobotolo'),3));
    $Meta_fields_textarea = 
	array ();
    $Meta_fields_special = array ('portfolio_categories'=> array('Taxonomy',__('Select filters for portfolio','txt_kobotolo')));
     
    $Meta = new Cls_Meta('page',$Meta_fields_check, $Meta_fields_text, $Meta_fields_textarea, 'kobotolo_portfolio', $Meta_fields_special);  

    $Meta_fields_check2 = array();
    $Meta_fields_text2 = 
	array ('link'=>array(__('Link on click','txt_kobotolo'),''));
    $Meta_fields_textarea2 = 
	array ();
    $Meta_fields_special2 = array ();
     
    $Meta2 = new Cls_Meta('post_type',$Meta_fields_check2, $Meta_fields_text2, $Meta_fields_textarea2, 'portfolio_kobotolo', $Meta_fields_special2);  



// Hook into the 'init' action
//add_action( 'init', 'custom_post_type', 0 );





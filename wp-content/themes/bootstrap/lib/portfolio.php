<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once( dirname( __FILE__ ) . '/KoBoToLo - Meta.php' );

    $Meta_fields_check = 
	array ('usesidebar'=>array('Visa sidebar på sidan?',0));
    $Meta_fields_text = 
	array ('number'=>array('Hur många bilder per rad (3, 4 eller 5)',3));
    $Meta_fields_textarea = 
	array ();
    $Meta_fields_special = array ('portfolio_categories'=> array('Taxonomy','Välj filter för portfolion'));
     
    $Meta = new Cls_Meta('page',$Meta_fields_check, $Meta_fields_text, $Meta_fields_textarea, 'kobotolo_portfolio', $Meta_fields_special);  

    $Meta_fields_check2 = array();
    $Meta_fields_text2 = 
	array ('link'=>array('Länk ()',''));
    $Meta_fields_textarea2 = 
	array ();
    $Meta_fields_special2 = array ();
     
    $Meta2 = new Cls_Meta('post_type',$Meta_fields_check2, $Meta_fields_text2, $Meta_fields_textarea2, 'portfolio_kobotolo', $Meta_fields_special2);  



// Hook into the 'init' action
//add_action( 'init', 'custom_post_type', 0 );





<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $my_Admin;
$x= $my_Admin->get_option_value('sidebar_pos');
$Meta_fieldsxx = array ('portfolio_categories'=> 
	    array('type'=>'Taxonomy'
		,'helptext'=>__('Which portfolio filters should be included?','txt_kobotolo')
		,'label'=>__('Select filters for portfolio','txt_kobotolo')
		,'default'=>''));     

$Metaxx = new Cls_Meta(
    array('kobotolo_portfolio')
    ,__('Portfolio Filter settings','txt_kobotolo'), 'special', $Meta_fieldsxx, 'kobotolo_portfolio_page_filter');  


$Meta_fields = array (
    'number' =>array('type' =>'text'
		,'label'=>__('How many images in rows (3, 4 eller 5)','txt_kobotolo')
		,'helptext'=>__('How many images in rows (3, 4 eller 5)','txt_kobotolo')
		,'default'=>'3'));     

$Meta = new Cls_Meta(
    array( 'kobotolo_portfolio')
    ,__('Portfolio page settings','txt_kobotolo'), 'page', $Meta_fields, 'kobotolo_portfolio_page');  


$Meta_fields2 = array(
    'link'=>array('type'=>'text'
      , 'label'=>__('Link on click on portfolio page','txt_kobotolo')
      , 'helptext'=>__('If nothing enter - porrtfolio post will be opened (this post)','txt_kobotolo')
      ,'default'=>''));
$Meta2 = new Cls_Meta('portfolio_kobotolo',__('Portfolio settings','txt_kobotolo'),'post_type',$Meta_fields2, 'portfolio_kobotolo');  


global $wp_registered_sidebars;
global $sbg;
$Meta_fields3 = array (
    'pagesidebar'=>array('type'=>'select'
      ,'label'=>__('Place for sidebar','txt_kobotolo')
      ,'helptext'=>__('Use => Left, Right, None or Theme','txt_kobotolo')
      ,'values'=> array('Theme', 'Left', 'Right','None')
      ,'default'=> 'Theme')
 ,'choosensidebar'=>array('type'=>'select'
      ,'label'=>__('Select sidebar','txt_kobotolo')
      ,'values'=> $sbg->get_sidebars()
      ,'helptext'=>__('Use => Left, Right, None or Theme','txt_kobotolo')
      ,'default'=>'Theme')
     );
$Meta3 = new Cls_Meta(array('page'),
        $hedaer=__('Page settings','txt_kobotolo'), 
	$type='page',
	$meta=$Meta_fields3, 
	$DB_field='kobotolo_page' );

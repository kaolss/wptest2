<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$Meta_fields = array (
    'number' =>array('type' =>'text'
		,'label'=>__('How many images in rows (3, 4 eller 5)','txt_kobotolo')
		,'default'=>'3')
    ,'portfolio_categories'=> array('type'=>'special'
		,'what'=>'Taxonomy'
		,'label'=>__('Select filters for portfolio','txt_kobotolo')
		,'default'=>''));     
$Meta = new Cls_Meta('Portfolio page settings', 'page', $Meta_fields, 'kobotolo_portfolio');  

$Meta_fields2 = array(
    'link'=>array('type'=>'text'
      , 'label'=>__('Link on click','txt_kobotolo')
      ,'default'=>'vvvvvvv'));
$Meta2 = new Cls_Meta('Portfolio settings','post_type',$Meta_fields2, 'portfolio_kobotolo');  

$Meta_fields3 = array (
    'sidebar'=>array('type'=>'text'
      ,'label'=>__('Place for sidebar','txt_kobotolo')
      ,'default'=>'right'));
$Meta3 = new Cls_Meta('Page settings', 'page',$Meta_fields3, 'page' );
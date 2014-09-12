<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_action( 'wp_head', 'kobotolo_head' );

/*****************************************************************************
** kobotolo_head
*****************************************************************************/
function kobotolo_head (){
    global $my_Admin;
    if ($my_Admin->get_option_value('boxed')==='checked') { ?>
        <style>
	    body {
		background: <?php echo $my_Admin->get_option_value('color_scheme')?>;
	    } 
	    .site-container {
		width:1170px;
		margin:0 auto;
		border-left:10px black solid;
		border-right:10px black solid;
	    }
	</style>
    <?php    }
    
    ?>
    <style>
	#rememberNav nav, div#offcanvas nav {
	/************ add height for menu here *******/
	    background: <?php echo $my_Admin->get_option_value('menu_bg')?>;
	}
    </style>
    
    <?php 
    echo 'testing sidebar';
    $sidebar= $my_Admin->get_option_value('sidebar_pos');
    if (is_page()) {  
	echo 'is page';
    	$meta = get_post_meta(get_the_ID(), 'page');
	if (isset($meta[0])) {
	    var_dump($meta[0]);
		$tag_meta = $meta[0]; 
	    $sidebar=$tag_meta['sidebar']?:3;   echo 'sidebar'.$sidebar; 
	}}
    
    switch ( $sidebar) {
	case 'left':
	    add_action('sidebar_left', 'kobotolo_sidebar', 10);
	    break;
	case 'right':
	    add_action('sidebar_right', 'kobotolo_sidebar', 10);
	    break;
	case 'none':?>
	    <style>
		.col-md-8.main-content {
		    width:100%;
		}
	    </style>
	    <?php
    }
}

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
function kobotolo_head (){ ?>
    <style>
    <?php global $my_Admin;
    $primary = $my_Admin->get_option_value('page_bg');    

    switch ( $primary) {
	case 'ligt' : ?>
		body {background: whitesmoke;
		    color:black;}
	    <?php break;
	case 'medium' : ?>
		body {background: grey;
		color:black;}
	    <?php break;
	default: ?>
		body {background: black;
		    color:grey;}
    <?php }    ?>
		
    
    <?php    if ($my_Admin->get_option_value('boxed')==='checked') { ?>    
	    body {
		background: <?php echo $my_Admin->get_option_value('page_bg')?>;
	    } 
	    .site-container {
		max-width:1170px;
		margin:0 auto;
		border-left:2px black solid;
		border-right:2px black solid;
	    }
    	
    <?php    }
    $secondary = $my_Admin->get_option_value('secondary');    

    switch ( $secondary) {
	case 'red' :?>
	    a {color:red;
	    }
	    .btn-primary {
color: #fff;
background-color: red;//#428bca;
border-color: darkred;//#357ebd;
}
	    <?php break;
	default:
    }?>
    
    
	</style>
    <style>
	#rememberNav nav, div#offcanvas nav {
	/************ add height for menu here *******/
	    background: <?php echo $my_Admin->get_option_value('menu_bg')?>;
	}
    </style>
    
    <?php 
//    echo '<br>testing sidebar';
    $sidebar= $my_Admin->get_option_value('sidebar_pos');
    _log("sidebar general placering =>".$sidebar);
    if (is_page()) {  
	_log( 'is page');
    	$meta = get_post_meta(get_the_ID(), 'page');
	if (isset($meta[0])) {
		$tag_meta = $meta[0]; 
		//_log($tag_meta['sidebarplace']);
	    $sidebar=$tag_meta['pagesidebar']!='Theme'? $pagesidebar:$tag_meta['sidebar'] ;   
	}}
    _log("sidebar placering =>".$sidebar);
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

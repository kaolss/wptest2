<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}?>
<div  class="sidebar">
   <?php 
   _log("sidebar.php");
//      dynamic_sidebar( 'kontakt' ); 
   generated_dynamic_sidebar('right');?>
</div>

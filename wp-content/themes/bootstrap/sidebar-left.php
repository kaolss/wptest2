<?php

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}?>
<div  class="sidebar">
   <?php 
   _log("sidebar left.php");?>
	<?php generated_dynamic_sidebar('left');?>
</div>

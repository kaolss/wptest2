<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $my_Admin;
    
_log('Header contact'); ?>
<div class="header_contact">
    <div class="container">
	<div class="contactrow">
	    <div class="menu-topright"> 
		<?php echo '<span style="">'.$my_Admin->get_option_value('contact_text').'</span>'; 
		do_action('kobotolo_social_icons'); ?>
	    </div>
	</div>
    </div>
</div>

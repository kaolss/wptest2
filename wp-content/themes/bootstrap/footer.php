<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row before_footer">
    <div class="container">
        <div class="col-md-4">
	    <?php dynamic_sidebar( 'footer_left' ); ?>
	</div>	
	<div class="col-md-4">
	    <?php dynamic_sidebar( 'footer_center' ); ?>
	</div>	
	<div class="col-md-4">
	    <?php dynamic_sidebar( 'footer_right' );?>
	</div>
	<hr>
    </div>
</div>
<footer>
    <div class="container">
	<div class="col-md-12">
	<?php do_action('kobotolo_footer'); ?>
	</div> <!-- /container -->
    </div> <!-- /container -->
</footer>

<?php wp_footer(); ?>
</div> <!-- /container -->
</body>
</html>

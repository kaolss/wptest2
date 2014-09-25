<?php

?>
<footer>
    <div class="container-fluid">
	<div class="row footerarea">
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
	    </div>
	    <div class="container">
		<div class="row copyrightarea">
		    <div class="col-md-12">
			<?php do_action('kobotolo_footer'); ?>
		    </div> <!-- /container -->
		</div> <!-- /container -->
	    </div> <!-- /container -->
	</div> <!-- /container -->
    </div> <!-- /container -->
</footer>

<?php wp_footer(); ?>
</div> <!-- /container -->
</body>
</html>

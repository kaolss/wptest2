<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row before_footer">
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
<hr>
<footer>
  <p>© Company 2012</p>
</footer>
<?php wp_footer(); ?>
</div> <!-- /container -->
</body>
</html>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

get_header(); 
_log("==>Page.php")?>

<div class="site-inner">
    <div class="container">
	<?php //do_action('sidebar_left'); 
get_sidebar("left"); ?>  	
  	
	<div class="col-md-8 main-content">
	<?php if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); ?>
		<div class="entry post-<?php the_ID(); ?>" <?php post_class(); ?> ">
			<?php do_action( 'entry_data' ); ?>
			<?php do_action( 'entry_thumbnail' ); ?>
			<?php do_action( 'entry_content' ); ?>
			<?php do_action( 'entry_meta' ); ?>
			<?php do_action( 'entry_comment' ); ?>
		</DIV><?php endwhile; 
	else: ?>
		<p><?php _e('Sorry, this page does not exist.', txt_KoBoToLo); ?></p>
	<?php endif; ?>

  </div>
	    <?php //do_action('sidebar_right'); ?>  	
	<?php get_sidebar(); ?>  	
  </div>
</div>
</div>
<?php get_footer(); ?>
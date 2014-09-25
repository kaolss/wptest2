<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_header(); 
_log( 'index.php');?>
<div class="site-inner">
    <div class="container">
	<?php //do_action('sidebar_left');   	
	get_sidebar("left"); ?>  	
<div class="col-md-8 main-content">
	    <?php if ( have_posts() ) : 
		do_action( 'loop_header' ); 
		 while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
                    <?php do_action( 'entry_data' ); ?>
                    <?php do_action( 'entry_thumbnail' ); ?>
                    <?php do_action( 'entry_content' ); ?>
                    <?php do_action( 'entry_meta' ); ?>
                    <?php do_action( 'entry_comment' ); ?>
		    </article>
		<?php endwhile; 
	    else: ?>
		<p><?php _e('Sorry, this page does not exist.','txt_kobotolo'); ?></p>
	    <?php endif; ?>
	</div>
	<?php get_sidebar(); ?>  	
	    <?php //do_action('sidebar_right'); ?>  	
    </div>
</div>

<?php get_footer(); ?>
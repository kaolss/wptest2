<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_header(); 
echo 'index.php';?>
<div class="container-fluid">
    <div class="container">
    <div class="row site-inner">
  <div class="col-md-8">
      
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
  <div class="col-md-4">
	<?php get_sidebar(); ?>  	
  </div>
</div>
	</div></div>

<?php get_footer(); ?>
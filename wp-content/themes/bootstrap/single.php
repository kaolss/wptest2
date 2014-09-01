<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

get_header(); 
echo 'single'; ?>

<div class="container-fluid">
    <div class="container">
<div class="row site-inner">
  <div class="col-md-8">
	<?php if ( have_posts() ) : 
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
		<p><?php _e('Sorry, this page does not exist.'); ?></p>
	<?php endif; ?>

  </div>
  <div class="col-md-4 col-xs-12">
	<?php get_sidebar(); ?>  	
  </div>
</div>
</div>

<?php get_footer(); ?>
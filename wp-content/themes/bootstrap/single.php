<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

get_header(); 
$test=0;
?>

<div class="container-fluid">
<?php if ($test)_log('single efter test karin007 och igen');?>
    <div class="container">
	<div class="row site-inner">
	    <div class="col-md-8">
      
		<?php if ( have_posts() ) : 
	    	while ( have_posts() ) : the_post(); ?>
		    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
                        <?php do_action( 'entry_data' ); ?>
			<?php if (class_exists('MultiPostThumbnails')) {
			    _log('class exists in single');?>
			    <div class="flexslider">
			    <ul class="slides">
				<li>
				    <?php    MultiPostThumbnails::the_post_thumbnail('post', 'feature-image-2', get_the_id(),'portfolio_3'); ?>
				    <p class="flexslider-caption">Första bilden</p>
				</li>
				<li>
				    <?php    MultiPostThumbnails::the_post_thumbnail('post', 'feature-image-3', get_the_id(),'portfolio_3'); ?>
				    <p class="flexslider-caption">Andra bilden</p>
				</li>
			    </ul>
			</div>
		
		    <?php }?>
		    <?php do_action( 'entry_thumbnail' ); ?>
			<?php do_action( 'entry_content' ); ?>
			<?php do_action( 'entry_meta' ); ?>
			<?php do_action( 'entry_comment' ); ?>
                    </article>
                <?php endwhile; 
		
		else: ?>
		    <p><?php _e('Sorry, this page does not exist.',txt_KoBoToLo); ?></p>
		<?php endif; ?>
<?php if ($test)_log('single inan sidebar');?>
  </div>
  <div class="col-md-4 col-xs-12">
	<?php get_sidebar(); ?>  	
  </div>
</div>
</div>
<?php if ($test)_log('single innan footer');?>

<?php get_footer(); ?>
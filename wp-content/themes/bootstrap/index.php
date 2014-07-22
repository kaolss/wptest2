<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_header(); ?>
<div class="row">
	<div class="span8">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="entry">
			<?php get_template_part( 'entry-data' ); ?>
			<?php if( has_post_thumbnail() ) : ?>
				<br>
				<div class="span2">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('thumbnail'); ?>
					</a>
				</div>
			<?php endif; ?>
			<div class="span5 entry-content">
				<?php $content= get_the_content(); 
				echo $content;?>
			</div>
			<?php get_template_part( 'entry-meta' ); ?>
			<br>
			<?php comments_template(); ?>
			</div>
				<?php endwhile; 
		else: ?>
			<p><?php _e('Sorry, this page does not exist.'); ?></p>
		<?php endif; ?>
  </div>
  <div class="span4">
	<?php get_sidebar(); ?>  	
  </div>
</div>

<?php get_footer(); ?>
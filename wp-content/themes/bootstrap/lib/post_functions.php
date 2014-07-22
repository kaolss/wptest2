<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*****************************************************************************
********************** Entry data ********************************************
*****************************************************************************/
add_action( 'entry_data', 'kobotolo_entry_data', 10 );
function kobotolo_entry_data( ) {?>
	<div class="entry-data">
		<?php if (is_single()){ 
			the_title('<h1 class="entry-title post-title">','</h1>'); 
		}
		else { ?>
			<h2 class="entry-title post-title">
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php }
		$date= get_the_date();
		?>
		<span class=" span-date"><?php echo $date.',&nbsp; ';?></span>
		<span class=" span-author"><?php the_author_link();?></span><br>
	</div>
<?php } 

/*****************************************************************************
********************** Entry meta *******************************************
*****************************************************************************/
add_action( 'entry_meta', 'kobotolo_entry_meta', 10 );
function kobotolo_entry_meta( ) {
	if (is_single()) {?>
	<div class="entry-meta">
		<span class=" span-cat"><?php echo the_category(',&nbsp; ');?></span>
	</div>
	<?php }
} 
/*****************************************************************************
********************** Loop start *******************************************
****************************************************************************/
add_action( 'loop_header', 'kobotolo_loop_header', 10 );
function kobotolo_loop_header( ) { ?>
	<div class="loop_header">
		<?php if (is_category()) { ?>
			<h1><?php single_cat_title(); ?></h1>
			<?php echo category_description(); 
		}	
		else if (is_archive()) { ?>
			<h1>Arkiv för</h1>
		<?php } ?> 
	</div>
<?php } 
/*****************************************************************************
********************** Entry content *******************************************
****************************************************************************/
add_action( 'entry_content', 'kobotolo_entry_content', 10 );
function kobotolo_entry_content( ) { 
	if (is_single() || is_page()) {?>
		<?php $content= the_content(); 
	}
	else {
		$content= get_the_excerpt(); 
	 }
	echo $content;
		 } 
/*****************************************************************************
********************** Entry thumbnail ****************************************
****************************************************************************/
add_action( 'entry_thumbnail', 'kobotolo_entry_thumbnail', 10 );
function kobotolo_entry_thumbnail( ) {
	if( has_post_thumbnail() && !is_single() ) : ?>
		<br>
		<div class="col-md-3">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('thumbnail'); ?>
			</a>
		</div>
	<?php endif; ?>
<?php } 


add_filter( 'get_the_excerpt', 'sp_read_more_custom_excerpt' );
function sp_read_more_custom_excerpt( $text ) {
   if ( strpos( $text, '[&hellip;]') ) {
      $excerpt = str_replace( '[&hellip;]', 
	 '<p><a href="' .get_permalink().'" class="btn btn-sm btn-primary">Läs mer <i class="fa fa-arrow-right"></i></a>', $text );
		} 
   else {
		$excerpt = $text . '<p><a href="' . get_permalink() . '"class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i>Läs mer </a></p>';
   }
   return $excerpt;
}
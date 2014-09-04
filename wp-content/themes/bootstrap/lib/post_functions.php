<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*****************************************************************************
********************** Entry data ********************************************
*****************************************************************************/
add_action('entry_data', 'kobotolo_entry_data', 10);
function kobotolo_entry_data($showinfo=true) { ?>
    <div class="entry-data">
	<?php if (is_single()) {
	    the_title('<h1 class="entry-title post-title">', '</h1>');
	} 
	else { ?>
	    <h2 class="entry-title post-title">
	    <a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php }
	if ($showinfo) {
            $date = get_the_date();	?>
	<span class=" span-date"><?php echo $date . ',&nbsp; '; ?></span>
	<span class=" span-author"><?php the_author_posts_link(); ?></span><br>
        <?php } ?></div>
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
           <h1 class="page-title">
                <?php if ( is_day() ) : ?>
                    <?php printf( __( 'Daily Archives: <span>%s</span>', 'txt_kobotolo' ), get_the_date() ); ?>
                <?php elseif ( is_month() ) : ?>
                    <?php printf( __( 'Monthly Archives: <span>%s</span>', 'txt_kobotolo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'txt_kobotolo' ) ) ); ?>
                <?php elseif ( is_year() ) : ?>
                    <?php printf( __( 'Yearly Archives: <span>%s</span>', 'txt_kobotolo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'txt_kobotolo' ) ) ); ?>
                <?php else : ?>
                    <?php _e( 'Blog Archives', 'twentyten' ); ?>
                <?php endif; ?>
            </h1>
        <?php	} ?>
    </div>
<?php }
/*****************************************************************************
********************** Entry content *******************************************
****************************************************************************/
add_action( 'entry_content', 'kobotolo_entry_content', 10 );
function kobotolo_entry_content( ) {
// @TODO Lägg till en div
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
add_action( 'entry_thumbnail', 'kobotolo_entry_thumbnail', 10,2 );
function kobotolo_entry_thumbnail( $portfolio_nr=3, $link='') {
    //echo 'entry thumbnail';
    
    if( has_post_thumbnail() && !is_single()&& get_post_type()=='post' ) : ?>
        <br>
        <div class="col-md-3">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
    <?php elseif (get_post_type()=='portfolio_kobotolo' ) : 
	if ($link=='') {?> 
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	<?php }
	else {?>
            <a href="<?php echo $link ?>" title="<?php the_title_attribute(); ?>">
	<?php } ?>
	    <?php //the_post_thumbnail(); 
		    $i= get_the_post_thumbnail( get_the_ID(),'portfolio_'.$portfolio_nr, array( 'class' => 'portfolio-image' ) ); 
		   print_r( $i);		    ?>
	    </a> 
	<?php         endif; ?>
<?php }


add_filter( 'get_the_excerpt', 'kobotolo_read_more_custom_excerpt' );
function kobotolo_read_more_custom_excerpt( $text ) {
    if (strpos( $text, '[&hellip;]') ) {
       $excerpt = str_replace( '[&hellip;]',
	  '<p><a href="' .get_permalink().'" class="btn btn-sm btn-primary">'. _e("Read more","txt_kobotolo").'<i class="fa fa-arrow-right"></i></a>', $text );
		 }
    else {
	$excerpt = $text . '<p><a href="' . get_permalink() . '" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i>'._e("Read more","txt_kobotolo").'</a></p>';
    }
    return $excerpt;
}
function make_term_button($t,$parentid="") {
    /* Filter buttons */
    $s=get_term_children( $t->term_id, 'portfolio_categories'); 
    if (count($s)>0) {
	foreach ($s as $t2) {   
    	    $term = get_term_by( 'id', $t2, 'portfolio_categories');?>
	<?php    make_term_button($term,'tag177');
	} 
    }
    else {?>
	<button class=" tag<?php echo $t->term_id.' '.$parentid;?> " id="tag<?php echo $t->term_id;?>" name ="<?php echo $t->name;?>"><?php echo $t->name;?></button>	
    <?php }
}
    

function make_term_tag($t,$parentid="") {
    /* Filter buttons */
    echo ' tag'.$t->term_id;
    if ($t->parent>0) {
	$term = get_term_by( 'id', $t->parent, 'portfolio_categories');
    	make_term_tag($term); 
    }
}
    

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Template Name: KoBoToLo Portfolio Four Column
get_header(); 

/* Get meta */
$meta = get_post_meta($post->ID, 'kobotolo_portfolio');
$tag_meta = $meta[0]; 
$nr=$tag_meta['number']?:3;

$terms=get_the_terms($post->ID,'portfolio_categories');
$Pk[] = '';?>
<div class="site-inner">
    <div class="container">
	<?php do_action('sidebar_left'); ?>  	
	<div class="col-md-8 main-content">
	    
	<div class="filter_buttons">
	<button id="alla" name="Alla">Alla</button>
	<?php 
	if ($terms) 
	    foreach ($terms as $t) {
	    if ($t->count>1) {
                array_push($Pk, $t->term_id);
                make_term_button($t);
            }
	} ?>
    </div>
    <?php if ( have_posts() ) : 
	while ( have_posts() ) : the_post(); ?>
	    <div class="entry post-<?php the_ID(); ?>" <?php post_class(); ?> ">
		<?php do_action( 'entry_content' ); ?>
		<?php do_action( 'entry_meta' ); ?>
	    </div>
	<?php endwhile; 
    else: ?>
	<p><?php _e('Sorry, this page does not exist.',txt_KoBoToLo); ?></p>
    <?php endif; ?>

    <?php $args = array(
	'posts_per_page' => -1,
	'post_type' => 'portfolio_kobotolo',
	'post_status' => 'publish',
	'orderby' => 'rand',
	'showposts' => 60,
	'tax_query' => array(
	    array(
		'taxonomy' => 'portfolio_categories',
		'field' => 'term_id',
		'terms' => $Pk,//array(11,9,12,10)
		'include_children' => true
	  )
	));
    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) {?>
	<div id="portfolio">
	    <?php while ( $the_query->have_posts() ) {
	    $the_query->the_post(); ?>
	    <div class="portfolio-item post-<?php echo $nr; ?>">
		<div class="alla  
		    <?php  $terms=get_the_terms(get_the_ID(),'portfolio_categories');
		    foreach ($terms as $t) {
			make_term_tag($t);
		    }?>
		 ">
		    <?php 
		    $meta = get_post_meta(get_the_ID(), 'portfolio_kobotolo');
		    $tag_meta = isset($meta[0]) ?$meta[0]:''; 
		    $link=isset($tag_meta['link'])?$tag_meta['link']:'';
		    do_action( 'entry_thumbnail',$nr,$link ); ?>
		</div>
		<div class="text">
		    <?php the_title('<h2 class="entry-title post-title">', '</h2>');
		    do_action( 'entry_content' ); ?>
		</div>
	    </div>
	    <?php } ?>
        </div>

    <?php } else {
	// no posts found
    } ?>
    </div>
<?php wp_reset_postdata();
  do_action('sidebar_right'); ?>  	
</div>

<?php get_footer(); ?>
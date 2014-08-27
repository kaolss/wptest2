<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Template Name: Portfolio Four Column
get_header(); echo 'page portfolio'; 
$meta = get_post_meta(get_the_ID(), 'products');
$tag_meta = $meta[0]; 
$nr=$tag_meta['number'];
$usesidebar=$tag_meta['usesidebar'];
$terms=get_the_terms($post->ID,'portfolio_categories');
$Pk = array();
foreach ($terms as $t) {
    $Pk[] = $t->term_id;
} 
$Pk = join( ", ", $Pk );?>
<button id="alla" name="Alla">Alla</button>
<?php foreach ($terms as $t) {?>
    <button id="tag<?php echo $t->term_id;?>" name ="<?php echo $t->name;?>"><?php echo $t->name;?></button>
<?php }?>

<div class="row site-inner">
  <div class="col-md-8">
	<?php if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); ?>
		<div class="entry post-<?php the_ID(); ?>" <?php post_class(); ?> ">
			<?php //do_action( 'entry_data' ); ?>
			<?php //do_action( 'entry_thumbnail' ); ?>
			<?php do_action( 'entry_content' ); ?>
			<?php do_action( 'entry_meta' ); ?>
			<?php //do_action( 'entry_comment' ); ?>
		</DIV><?php endwhile; 
	else: ?>
		<p><?php _e('Sorry, this page does not exist.'); ?></p>
	<?php endif; ?>


<?php // The Query

$args = array(
    'posts_per_page' => -1,
    'post_type' => 'portfoliok',
    'post_status' => 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'portfolio_categories',
            'field' => 'id',
//            'terms' => $terms
        'terms' => $Pk,//array(11,9,12,10)
        'include_children' => true,
            'operator'=>'OR')
    )
);
print_r($Pk);

$the_query = new WP_Query( $args );
//$the_query = new WP_Query( 'post_type=portfoliok');

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div id="portfolio">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post(); ?>
                <div class="portfolio-item post-<?php echo $nr; ?>">
                    <div class="alla  
                 <?php  $terms=get_the_terms(get_the_ID(),'portfolio_categories');
                    foreach ($terms as $t) {
                       echo ' tag'.$t->term_id;
                    }  
                 echo '">';?>
                    <?php do_action( 'entry_thumbnail' ); ?></DIV>
                    <div class="text">
                        <?php do_action( 'entry_data',false ); ?>
			<?php do_action( 'entry_content' ); ?></div>
			<?php //do_action( 'entry_meta' ); ?>
			<?php //do_action( 'entry_comment' ); ?>
		</DIV>
        <?php }
        echo '</div>';

} else {
	// no posts found
}
?>
  </div>
<?php /* Restore original Post Data */
wp_reset_postdata();?>
  <div class="col-md-4">
	<?php get_sidebar(); ?>  	
  </div>
</div>

<?php get_footer(); ?>
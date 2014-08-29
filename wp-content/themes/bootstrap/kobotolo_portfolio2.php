<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Template Name: Portfolio Four Column
get_header(); 
/**
 * RETORNA URL DO POST_THUMBNAIL PARA BACKGROUND-IMAGE
 * @param 		int: get_the_ID()
 * @param 		string: thumbnail, medium, large, full
 **/
function post_thumbnail_url($post_id, $size = 'thumbnail'){
	$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size );
	$url = $thumb[0];
	//wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
	return $url;
}
//echo 'page portfolio'; 
//echo 'Post ID'.$post->ID.'<br>';

$meta = get_post_meta($post->ID, 'kobotolo_portfolio');
$tag_meta = $meta[0]; 
//print_r($tag_meta);
$nr=$tag_meta['number']?:3;
//echo 'Nr'.$nr.'<br>';
$usesidebar=isset($tag_meta['usesidebar'])?:0;
//echo 'usesidebar'.$usesidebar.'<br>';


$terms=get_the_terms($post->ID,'portfolio_categories');
$Pk = '';
foreach ($terms as $t) {
    if ($Pk!='') $Pk .=',';
    $Pk .= $t->term_id;
} 
?>
<button id="alla" name="Alla">Alla</button>
<?php foreach ($terms as $t) {?>
    <button id="tag<?php echo $t->term_id;?>" name ="<?php echo $t->name;?>"><?php echo $t->name;?></button>
<?php }?>

<div class="row site-inner">
  <?php if ($usesidebar) { 
      echo '<div class="col-md-8">';
  } 
  else {
    echo '<div class="col-md-12">'; 
      
  }
  ?>
  
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
        'terms' => $Pk,//array(11,9,12,10)
 //       'terms' => '192,193',
        'include_children' => true,
            'operator'=>'OR')
    )
);
//echo $Pk;
$the_query = new WP_Query( $args );
//$the_query = new WP_Query( 'post_type=portfoliok');

// The Loop
if ( $the_query->have_posts() ) {
	echo '<div id="portfolio2">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post(); 
		$img_src=post_thumbnail_url(get_the_ID(),'medium');;
		//echo $img_src?>
                <div class="portfolio-item2 post-<?php echo $nr; ?>"             
		     style=" background-image:url('<?php echo $img_src;?>');">
       
                    <div class="alla  
                 <?php  $terms=get_the_terms(get_the_ID(),'portfolio_categories');
                      ?>">
                    <?php //do_action( 'entry_thumbnail' ); ?></DIV>
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
wp_reset_postdata();
if ($usesidebar) { ?>
  <div class="col-md-4">
	<?php get_sidebar(); ?>  	
  </div>
<?php }?>
</div>

<?php get_footer(); ?>
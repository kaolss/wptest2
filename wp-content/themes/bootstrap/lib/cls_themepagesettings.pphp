<?php 
/* 
Plugin Name: KoBoToLo - Meta
Plugin URI:  
Description: General class for metaboxes on pages 
Version: 1
Author: KoBoToLo - Karin H Olsson
Author URI: http://www.kobotolo.se 
*/

class Cls_Meta {
    private $Header;
    private $DB_field;
    private $Meta_fields;
    private $Type;
    public function __construct($header, $type, $meta, $DB_field ){
	add_action('admin_head', array( $this, 'show_metabox'));
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );		
        $this->Header=$header;
        $this->Type=$type;
        $this->Meta_fields=$meta;
        $this->DB_field=$DB_field;    
    }
    
/*****************************************************************************
* add_meta_box
*****************************************************************************/
    public function add_meta_box() {
        switch ($this->Type) {
	    case 'post_type':
		add_meta_box(
                 $this->DB_field.'div'
	        ,$this->Header 
                ,array( $this, 'render_meta_box_content' )
                ,'portfolio_kobotolo'
                ,'normal'
                ,'high');
		break;
	    case 'page':
		add_meta_box(
                 $this->DB_field.'div'
	        ,$this->Header 
                ,array( $this, 'render_meta_box_content' )
                ,'page'
                ,'normal'
                ,'high');	
	} 
    }
    function Meta_install() {    }

/*******************************************************************************
 * * save
******************************************************************************/
    public function save( $post_id ) {
	if ( ! isset( $_POST['kobotolo_meta_nonce'] ) )return $post_id;
	$nonce = $_POST['kobotolo_meta_nonce'];
	if ( ! wp_verify_nonce( $nonce, 'kobotolo_meta' ) ) return $post_id;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
	if ( 'page' == $_POST['post_type'] ) {
	    if ( ! current_user_can( 'edit_page', $post_id ) )return $post_id;
	} 
	else {
	    if ( ! current_user_can( 'edit_post', $post_id ) )	return $post_id;
	}
	$cat_keys = array_keys($_POST[$this->DB_field]);

	foreach ($cat_keys as $key){    
	    if (isset($_POST[$this->DB_field][$key])) { 
		echo '<script>alert("xxx");</sxript>';
		if ($_POST[$this->DB_field][$key] != $this->Meta_fields[$key]['default'] ){
		    $cat_meta[$key] = $_POST[$this->DB_field][$key];
		}}    
	}
	if (is_null($cat_meta) ) return $post_id;
	update_post_meta( $post_id, $this->DB_field, $cat_meta );
    }
/****************************************************************************
 * * Function name
 *****************************************************************************/  
    public function get_default_value( $field_id ) {
	$cat_keys = array_keys($_POST[$this->DB_field]);
	foreach ($cat_keys as $key){
	    
	    if (isset($_POST[$this->DB_field][$key])) { 
		if ($_POST[$this->DB_field][$key] !==$this->Meta_fields[$key]['default'] ){
                $cat_meta[$key] = $_POST[$this->DB_field][$key];
	    }}    
	}
    }
/*****************************************************************************
	     * Function name
*****************************************************************************/
    public function render_meta_box_content(  ) {             
	wp_nonce_field( 'kobotolo_meta', 'kobotolo_meta_nonce' );
	$value = get_post_meta(get_the_ID(),$this->DB_field);
	foreach ($this->Meta_fields as $key=>$field) {
	    $text=''; ?>
	    <label for="<?php echo $key;?>"><?php echo  $field['label'];?></label>
	    <?php if (isset($value[0][$key])) $x=$value[0][$key]; else $x=$field['default']; 
	    switch ($field['type']) {
		case 'chkBox' :
		    if (isset($value[0][$key])) $x=$value[0][$key]; else $x=$field['default']; ?>
		    if ($x=='1') {$text=" checked";} ?>
			<input type="checkbox" value='1' id="<?php echo $this->DB_field.'['.$key; ?>]" 
			name="<?php echo $this->DB_field.'['.$key; ?>]" 
			<?php echo $text; ?>><br/>		
		    <?php  
		    break;
		case 'text' : ?>
        		<input type="text" size="35" 
			id="<?php echo $this->DB_field.'['.$key; ?>]"
			name="<?php echo $this->DB_field.'['.$key; ?>]"value="<?php echo $x;?>" /><br>	
			<?php    break;
		case 'textarea' :
		    echo 'field';print_r($field);echo '<br>'; ?>
		    <textarea id="<?php echo $this->DB_field.'['.$key; ?>]"  
		    wrap="hard" name="<?php echo $this->DB_field.'['.$key; ?>]"  
		    cols="35" rows="2"><?php echo $x;?></textarea><br/> 
		    <?php break;
		case 'special' :
		    $this->render_special($field, $key);
		    break;
	    }
    }
//    $this->get_default_value();
}
/****************************************************************************
** render special
*****************************************************************************/
    Private function render_special($field, $key ) {
	switch( $field['what']){
	    case 'Taxonomy':?>
		<div class="categorydiv">
		    <ul class="categorychecklist">
		    <?php wp_terms_checklist(get_the_ID(), array(
		    'taxonomy' => $key,
		      'checked_ontop',false)); ?>
		    </ul></div>
	    <?php break;            
	}
    }

/****************************************************************************
** show_metabox
*****************************************************************************/
    function show_metabox() {
	global $current_screen;
	if (get_post_type()==$this->DB_field &&
	    $this->DB_field == $current_screen->id){ ?>
	    <script type="text/javascript">
	        jQuery(document).ready( function($) {
		    $z='<?php echo $this->DB_field;?>';
		    $x=$z+'.php';
		    $y='#'+$z+'div';
		    console.log('x'+$x+'y'+$y);
		    $($y).show();
		});
	    </script>
	<?php return; 
	}
	if('page' != $current_screen->id) return; ?>
	    <script type="text/javascript">
		jQuery(document).ready( function($) {
		    $z='<?php echo $this->DB_field;?>';
		    $x=$z+'.php';
		    $y='#'+$z+'div';
		    console.log('x'+$x+'y'+$y);
		    if($('#page_template').val() === $x) {
			$($y).show();
		    } else {
			$($y).hide();
		    }
	           if (typeof console == "object") 
			console.log ('default value = ' + $('#page_template').val());
		   $('#page_template').live('change', function(){
		    $z='<?php echo $this->DB_field;?>';
		    $x=$z+'.php';
		    $y='#'+$z+'div';
	   
		   if($(this).val() == $x) {
			console.log('lika med ska visa');
			$($y).show();
		    } else {
                    // hide your meta box
			console.log('inte lika med ska intevisa' + $y);
			$($y).hide();
		    }
                    if (typeof console == "object") 
	                console.log ('live change value = ' + $(this).val());
            });                 
        });    
        </script>
<?php
    }
}
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
    private $DB_field;
    private $Meta_fields_check;
    private $Meta_fields_text;
    private $Meta_fields_area;
    private $Meta_fields_special;
    private $Type;
    public function __construct($type, $check, $text, $textarea, $DB_field, $special=''){
	add_action('admin_head', array( $this, 'show_metabox'));
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );		
        $this->Type=$type;
        $this->Meta_fields_check=$check;
        $this->Meta_fields_area=$textarea;
        $this->Meta_fields_text=$text;
        $this->DB_field=$DB_field;    
        $this->Meta_fields_special=$special;    
    }
    public function add_meta_box() {
	echo 'add_meta_box';
        switch ($this->Type) {
	    case 'post_type':
		add_meta_box(
                 $this->DB_field.'div'
	        ,__( 'Portfolio Settings', 'txt_KoBoToLo' )
                ,array( $this, 'render_meta_box_content' )
                ,'portfolio_kobotolo'
                ,'normal'
                ,'high');
		break;
	    case 'page':
		add_meta_box(
                 $this->DB_field.'div'
	        ,__( 'Portfolio Settings', 'txt_KoBoToLo' )
                ,array( $this, 'render_meta_box_content' )
                ,'page'
                ,'normal'
                ,'high');	
    	
	} 
	}
    function Meta_install() {    }

    public function save( $post_id ) {
            // Check if our nonce is set.
	if ( ! isset( $_POST['kobotolo_meta_nonce'] ) )return $post_id;
	$nonce = $_POST['kobotolo_meta_nonce'];
	// Verify that the nonce is valid.
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
	    if (isset($_POST[$this->DB_field][$key])){
                $cat_meta[$key] = $_POST[$this->DB_field][$key];
	    }    
	}
	update_post_meta( $post_id, $this->DB_field, $cat_meta );
    }
    public function render_meta_box_content( $post ) {
	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'kobotolo_meta', 'kobotolo_meta_nonce' );
	$value = get_post_meta( $post->ID, $this->DB_field);
	/*********************** Checkboxes ***********************************/
	foreach ($this->Meta_fields_check as $key=>$field) {
	    $text='';
	    if (isset($value[0][$key])) $x=$value[0][$key]; else $x=$field[1];
		if ($x=='1') {$text=" checked";} ?>
		<label for="<?php echo $key;?>"><?php echo  $field[0];?></label>
		    <input type="checkbox" value='1' id="<?php echo $this->DB_field.'['.$key; ?>]" 
			name="<?php echo $this->DB_field.'['.$key; ?>]" 
		    <?php echo $text; ?>><br/>		
	<?php } 
	
	/*********************** Textareaor ***********************************/
	foreach ($this->Meta_fields_area as $key=>$field) {
	    echo 'field';print_r($field);echo '<br>';
	    if (isset($value[0][$key])) $x=$value[0][$key]; else $x=$field[1]; ?>
	    <label for="<?php echo $key;?>"><?php echo $field[0];?></label>
	    <textarea id="<?php echo $this->DB_field.'['.$key; ?>]"  
		wrap="hard" name="<?php echo $this->DB_field.'['.$key; ?>]"  
		cols="35" rows="2"><?php echo $x;?></textarea><br/>
	<?php } 
	
	/*********************** Text ***********************************/
	foreach ($this->Meta_fields_text as $key=>$field) {
	    if (isset($value[0][$key])) $x=$value[0][$key]; else $x=$field[1];?>
	    <label for="<?php echo $key;?>"><?php  $field[0];?></label>
		<input type="text" size="35" 
		id="<?php echo $this->DB_field.'['.$key; ?>]"
		name="<?php echo $this->DB_field.'['.$key; ?>]"value="<?php echo $x;?>" /><br>
	<?php } 			
	
	$this->render_special();
    }

    Private function render_special() {
	if ($this->Meta_fields_special!='') {
//	    print_r($this->Meta_fields_special);
	    foreach ($this->Meta_fields_special as $key=>$field) {
		//echo 'key';print_r($key);echo '<br>field';print_r($field);
		switch( $field[0]){
		case 'Taxonomy':?>
			<label for="<?php echo $fields[1];?>"><?php echo $field[1]?></label>
		        <div>
			    <?php wp_terms_checklist(get_the_ID(), array(
				    'taxonomy' => $key
			    )); ?>
			</div>
		<?php break;
	    }   
        }
    }}

function show_metabox() {
    global $current_screen;
    print_r($current_screen->id);
    if (get_post_type()==$this->DB_field) {echo 'xxxxxxxxxxxxxxxxxxxxxxxx';
    if($this->DB_field == $current_screen->id){  
	echo "\npost typ";?>
        <script type="text/javascript">
        jQuery(document).ready( function($) {

            /**
             * Adjust visibility of the meta box at startup
            */
	    $z='<?php echo $this->DB_field;?>';
	    $x=$z+'.php';
	    $y='#'+$z+'div';
	    
	    console.log('x'+$x+'y'+$y);
                $($y).show();
	    });
		    </script>
    <?php 
   return; 
}}
?>
<?php    if('page' != $current_screen->id) return; ?>
        <script type="text/javascript">
        jQuery(document).ready( function($) {

            /**
             * Adjust visibility of the meta box at startup
            */
	    $z='<?php echo $this->DB_field;?>';
	    $x=$z+'.php';
	    $y='#'+$z+'div';
	    
	    console.log('x'+$x+'y'+$y);
	    if($('#page_template').val() === $x) {
                $($y).show();
            } else {
                $($y).hide();
            }

            // Debug only
            // - outputs the template filename
            // - checking for console existance to avoid js errors in non-compliant browsers
            if (typeof console == "object") 
                console.log ('default value = ' + $('#page_template').val());

            /**
             * Live adjustment of the meta box visibility
            */
            $('#page_template').live('change', function(){
	    $z='<?php echo $this->DB_field;?>';
	    $x=$z+'.php';
	    $y='#'+$z+'div';
	   
	   if($(this).val() == $x) {
                    // show the meta box
           	 console.log('lika med ska visa');
		 $($y).show();
                } else {
                    // hide your meta box
           	 console.log('inte lika med ska intevisa' + $y);
                    $($y).hide();
                }

                // Debug only
                if (typeof console == "object") 
                    console.log ('live change value = ' + $(this).val());
            });                 
        });    
        </script>
<?php
}
//load_plugin_textdomain('kobotolo', false, basename( dirname( __FILE__ ) ) . '/languages' );
//register_activation_hook( __FILE__, array( 'Cls_Meta', 'meta_install' ) );

}?>
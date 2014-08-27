<?php 
/* 
Plugin Name: KoBoToLo - Meta
Plugin URI:  
Description: (c) KoBoToLo - to be used by varmlandsmat.se. Adds the post-type producents and associated meta. Adds an orderby by post_type title
Version: 1
Author: KoBoToLo - Karin H Olsson
Author URI: http://www.kobotolo.se 
*/

class Cls_Meta {
    private $Meta_fields_check;
    private $Meta_fields_text;
    private $Meta_fields_textarea;
    public function __construct($check, $text, $textarea){
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );		
        $this->Meta_fields_check=$check;
        $this->Meta_fields_text=$text;
        $this->Meta_fields_textarea=$textarea;    
    }
    public function add_meta_box() {
        add_meta_box(
                 'portfolio_pagediv'
                ,__( 'Portfolio Settings', 'txt_KoBoToLo' )
                ,array( $this, 'render_meta_box_content' )
                ,'page'
                ,'normal'
                ,'high'
        );
    }
    public function add_events_metaboxes (){
            echo 'add_events_metaboxes';
            $args = array(
                //'descendants_and_self'  => 0,
                //'selected_cats'         => false,
                //'popular_cats'          => false,
                //'walker'                => null,
                'taxonomy'              => 'portfolio_categories',
                //'checked_ontop'         => true
                ); 
            wp_terms_checklist($post_ID, $args );
        }

	function Meta_install() {    }

	public function save( $post_id ) {
            // Check if our nonce is set.
		if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['myplugin_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		} 
		else {

			if ( ! current_user_can( 'edit_post', $post_id ) )	return $post_id;
		}
		/* OK, its safe for us to save the data now. */
        
		// Sanitize the user input.
		$cat_keys = array_keys($_POST['products']);
        foreach ($cat_keys as $key){
             if (isset($_POST['products'][$key])){
                $cat_meta[$key] = $_POST['products'][$key];
             }
          }
		  
		  update_post_meta( $post_id, 'products', $cat_meta );
          if (isset($_POST['products']['butik']))
          {

		  	$cat_ids = array(7,43);
		
			$s= wp_set_object_terms( $post_id, $cat_ids, 'producentkat' );
			
		  }
		else  {
			wp_set_object_terms( $post_id, null, 'producentkat' );
				  	$cat_ids = array(43);
		
			$s= wp_set_object_terms( $post_id, $cat_ids, 'producentkat' );
		}
}
    public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

		
		$value = get_post_meta( $post->ID, 'products');
                  foreach ($this->Meta_fields_check as $field) {
			$name = 'pro_'.$field;
			$text='';
			//echo $value[0]['butik'];
			if (isset($value[0][$field])) $x=$value[0][$field]; else $x='';
			if ($x=='1') {$text=" checked";} ?>
    		<label for="<?php echo $field;?>"><?php _e( $field, 'kobotolo' );?></label><br>
		
			<input type="checkbox" value='1' id="products[<?php echo $field; ?>]" 
			name="products[<?php echo $field; ?>]" 
			<?php echo $text; ?>><br/>		
		<?php } 
		foreach ($this->Meta_fields_textarea as $field) {
			if (isset($value[0][$field])) $x=$value[0][$field]; else $x='';?>
			<label for="<?php echo $field;?>"><?php _e( $field, 'kobotolo' );?></label><br>
			<textarea id="products[<?php echo $field; ?>]"  
				wrap="hard" name="products[<?php echo $field; ?>]"  
				cols="35" rows="2"><?php echo $x;?></textarea><br/>
		<?php } 
		foreach ($this->Meta_fields_text as $key=>$field) {
			//echo 'key'.$key.'<br>';
                        //echo 'field'.$field.'<br>';
                        if (isset($value[0][$key])) $x=$value[0][$key]; else $x='';?>
			<label for="<?php echo $key;?>"><?php _e( $field, 'kobotolo' );?></label><br>
			<input type="text" size="35" 
			id="products[<?php echo $key; ?>]" 
			name="products[<?php echo $key; ?>]" 
			value="<?php echo $x;?>" /><br>
		<?php } 			
            $args = array(
                //'descendants_and_self'  => 0,
                //'selected_cats'         => false,
                //'popular_cats'          => false,
                //'walker'                => null,
                'taxonomy'              => 'portfolio_categories',
                //'checked_ontop'         => true
                ); 
            //$x= wp_terms_checklist($post->ID, $args );?>
            <label for="inputCountries">Cats</label>
				<div>
					<?php wp_terms_checklist(get_the_ID(), array(
						'taxonomy' => 'portfolio_categories',
					)); ?>
				</div>
<?php	}
}
/* 
 * Change Meta Box visibility according to Page Template
 *
 * Observation: this example swaps the Featured Image meta box visibility
 *
 * Usage:
 * - adjust $('#postimagediv') to your meta box
 * - change 'page-portfolio.php' to your template's filename
 * - remove the console.log outputs
 */

add_action('admin_head', 'wpse_50092_script_enqueuer');

function wpse_50092_script_enqueuer() {
    global $current_screen;
    if('page' != $current_screen->id) return;

    ?>
        <script type="text/javascript">
        jQuery(document).ready( function($) {

            /**
             * Adjust visibility of the meta box at startup
            */
            if($('#page_template').val() == 'page-portfolio.php') {
                // show the meta box
                $('#postimagediv').show(); 
                $('#Information').show();
            } else {
                // hide your meta box
                $('#Information').hide();
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
                    if($(this).val() == 'page-portfolio.php') {
                    // show the meta box
                   $('#postimagediv').show(); 
                $('#Information').show();
                } else {
                    // hide your meta box
                    $('#Information').hide();
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

?>
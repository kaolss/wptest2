<?php 
/* Plugin Name: KoBoToLo - Meta
Plugin URI:  
Description: General class for metaboxes on pages 
Version: 1
Author: KoBoToLo - Karin H Olsson
Author URI: http://www.kobotolo.se 
*/

class Cls_themepagesettings extends cls_optionsbase{
private $test=0;
    
/****************************************************************************
** option fields
*****************************************************************************/
 public function option_fields() {
    if ( ! empty( $this->option_metabox ) ) {
	return $this->option_metabox;
    }        
    /*************************************************************************
    ** Advanced settings
    *************************************************************************/
    global $wp_registered_sidebars;
    global $sbg;
    $sidebars = $sbg->get_sidebars();
    $sidebars[]='Theme';
    $this->option_metabox[] = array(
	    'id'         => 'kobotolo_portfolio_page',
            'title'      => 'KoBoToLo Portflio Settings',
            'show_on'    => array( 'key' => 'page', 'template' =>  'kobotolo_portfolio.php', 
		    'div'=>'kobotolo_portfolio_pagediv'  ),
            'show_names' => true,
            'fields'     => array(
         	array(
		    'name' => __('Custom CSS', 'txt_kobotolo')
		    ,'label'=>__('How many images in rows (3, 4 eller 5)','txt_kobotolo')
		    ,'helptext'=>__('How many images in rows (3, 4 eller 5)','txt_kobotolo')
		    ,'id' => 'number'
		    ,'rep'=>false
		    ,'default' => '3'				
		    ,'values'=> array('3', '4', '5')
		    ,'type' => 'select'
		),
	    ));
    /*****************************************************************************/
    $this->option_metabox[] = array(
            'id'         => 'kobotolo_page',
            'title'      => 'Page Settings',
            'show_on'    => array( 'key' => 'page', 'template' =>  'default',
		'div'=>'kobotolo_pagediv'),
            'show_names' => true,
            'fields'     => array(
		array(
		    'name' => __('Custom CSS', 'txt_kobotolo')
		    ,'label'=>__('Place for sidebar','txt_kobotolo')
		    ,'helptext'=>__('Use => Left, Right, None or Theme','txt_kobotolo')
		    ,'id' => 'pagesidebar'
		    ,'default' => 'Theme'				
	            ,'rep'=>FALSE
		    ,'values'=> array('Theme', 'left', 'right','none')
		    ,'type' => 'select'
		),    
	        array(
		    'name' => __('Custom CSS', 'txt_kobotolo')
		    ,'label'=>__('Select sidebar','txt_kobotolo')
		    ,'helptext'=>__('Use => Left, Right, None or Theme','txt_kobotolo')
		    ,'id' => 'choosesidebar'
		    ,'default' => 'Theme'				
	            ,'values'=> $sidebars//array($sbg->get_sidebars(),'default')
		    ,'type' => 'select'
		)     
      )
);
/*****************************************************************************/
 $this->option_metabox[] = array(
            'id'         => 'kobotolo_page_filter',
            'title'      => 'POrtfolio post Settings',
            'show_on'    => array( 'key' => 'special', 'template' =>  'kobotolo_portfolio.php',
		'div'=>'kobotolo_filterdiv'),
                'show_names' => true,
	        'fields'     => array(
		    array('name' => __('Custom CSS', 'txt_kobotolo')
		    ,'label'=>__('Select filters for portfolio','txt_kobotolo')
		    ,'helptext'=>__('Which portfolio filters should be included?','txt_kobotolo')
		    ,'id' => 'filters'
		    ,'default' => ''				
	            ,'values'=> 'portfolio_categories'
		    ,'type' => 'Taxonomy'
		)     
     ));
/*****************************************************************************/
 $this->option_metabox[] = array(
            'id'         => 'kobotolo_portfolio_post',
            'title'      => 'Portfolio post Settings',
            'show_on'    => array( 'key' => 'post_type', 'template' =>  'portfolio_kobotolo',
		'div'=>'kobotolo_portfolio_postdiv'),
                'show_names' => true,
	        'fields'     => array(
		    array('name' => __('portfolio', 'txt_kobotolo')
		    ,'label'=>__('Select filters for portfolio','txt_kobotolo')
		    ,'helptext'=>__('Which portfolio filters should be included?','txt_kobotolo')
		    ,'id' => 'link'
		    ,'default' => ''				
	            ,'values'=> ''
		    ,'type' => 'text'
		)     
     ));
    return $this->option_metabox;
}

/*****************************************************************************
** __get
*****************************************************************************/
    public function __get( $field ) {
return;
        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'fields', 'title', 'options_pages' ), true ) ) {
            return $this->{$field};
        }
        if ( 'option_metabox' === $field ) {
            return $this->option_fields();
        }

        throw new Exception( 'Invalid property: ' . $field );
    }


/*****************************************************************************
** Render special.
*****************************************************************************/
    Public function render_special($tabform, $key ) {
	$this->test=0;
	 $div = $key;
	 if ($this->test) :
	    if  ($this->test) _log('render special field');
	    if  ($this->test) _log($tabform);
	    if  ($this->test) _log('render special key');
	endif;
	switch( $tabform['fields'][0]['type']){
	    case 'Taxonomy':
		remove_meta_box('portfolio_categoriesdiv', 'page', 'side');
		add_meta_box($tabform['show_on']['div'], 
		    $tabform['title'], 
		    'post_categories_meta_box', 
		    'page', 
		    'normal', 
		    'high', 
		    array( 'taxonomy' => $tabform['fields'][0]['values'] ));
	    break;            
	}
     }
   
/*****************************************************************************
* add_meta_box
*****************************************************************************/
    public function add_meta_box() {
	foreach ( $this->option_metabox as $tab_form) : 
	 if ($this->test){
	    _log('ADD META BOXloop for tabforms');
	    _log(' show_onkey');
	    _log($tab_form['show_on']['key']);
	    _log($tab_form['id']);
	 }
	switch ($tab_form['show_on']['key']) {
	    case 'post_type':
		add_meta_box(
		    $tab_form['show_on']['div']
		   ,$tab_form['title'] 
		   ,array( $this, 'render_meta_box_content' )
		   ,'portfolio_kobotolo'
		   ,'normal'
		   ,'high'
		   , array('dBfield'=>$tab_form['id'],'info'=>$tab_form['fields']));	
		break;
	    case 'page':
		add_meta_box(
		    $tab_form['show_on']['div']
		   ,$tab_form['title'] 
		   ,array( $this, 'render_meta_box_content' )
		   ,'page'
		   ,'normal'
		   ,'high'
		   , array('dBfield'=>$tab_form['id'],'info'=>$tab_form['fields']));	
		break;
	    case 'special':
		//_log("Anrop till render special");
		$this->render_special(
		$tab_form, 
		'1');	
	    break;
	} 
	endforeach;
	
    }
    function Meta_install() {    }

/*******************************************************************************
 * * save
******************************************************************************/
    public function save( $post_id ) {
	$this->test=1;
	if ( $this->test) _log('save startad');
	if ( ! isset( $_POST['kobotolo_meta_nonce'] ) )return $post_id;
	$nonce = $_POST['kobotolo_meta_nonce'];
	if ( ! wp_verify_nonce( $nonce, 'kobotolo_meta' ) ) return $post_id;
if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
	if ( 'page' == $_POST['post_type'] ) :
if ( ! current_user_can( 'edit_page', $post_id ) )return $post_id;
	
	else 
	    if ( ! current_user_can( 'edit_post', $post_id ) )	return $post_id;
	endif;
	if ( $this->test) _log('starting loop');
	foreach ( $this->option_metabox as $tab_form) : 
	   if  ($this->test) _log('First loop followe by id');	
	   if  ($this->test) _log($tab_form['id']);	
	    if (!array_key_exists ($tab_form['id'],
		$_POST)) continue; 
	    $cat_keys = array_keys($_POST[$tab_form['id']] );
	    if  ($this->test) _log('Time to save');
	    if  ($this->test) _log($tab_form['id']);
	    foreach ($cat_keys as $key){    
		if  ($this->test) _log('second loop key');
		if  ($this->test) _log($key);
		if  ($this->test) _log('tabform id key');
		$s=$tab_form['id'];
		if  ($this->test) _log($s);
		if (isset($_POST[$s][$key])) { 
		    if ($_POST[$s][$key] != $this->get_option_value($key) ){
		    if  ($this->test) _log('differnt valurs need to save');
			$cat_meta[$key] = $_POST[$s][$key];
		}}    
	}
	    if (! isset($cat_meta)) :
		delete_post_meta( $post_id, $s);
		continue;
	    endif;
	update_post_meta( $post_id, $s, $cat_meta );
    endforeach;
    
	    }
/*****************************************************************************
 * * Render meta box content
*****************************************************************************/
    public function render_meta_box_content( $post, $metafields) { 
	if  ($this->test) _log('START Render meta box content');
	$c=$metafields['args']['info'];
	$d=$metafields['args']['dBfield'];
	$this->kobotolo_init();
	?>        
	<table>
	    <?php wp_nonce_field( 'kobotolo_meta', 'kobotolo_meta_nonce' );
	    foreach ($c as $key=>$field) :
		$value= $this->options[$d][$field['id']];
		//_log($c);
		if ($field['type']!='select') $field['values']="";
		if ($field['type']=='Taxonomy') continue;
		if (isset($value[$key])) $x=$value[$key]; else $x=$field['default']; 
		if (isset($field['what'])) $y=$field['what']; else $y="";
		$field['rep'] = isset($field['rep']) ? $field['rep'] : false;
   		
		$args =array(
		  'dbid' => $d.'['.$field['id'].']', 
		  'type' =>  $field['type'],
		  'label' => $field['label'],
		  'localid'=>$d.'['.$field['id'].']', 
		  'helptext' => $field['helptext'], 
		  'rep'=>$field['rep'],
		  'value' =>$value,
		  'optionvalues'=>$optionvalues=$field['values'],
		  'specialfunction'=>$y
		);
		
		    options_fields::make_text_box($args);
		    /*
		    $dbid=$d.'['.$field['id'].']', 
		    $type = $field['type'], 
		    $label= $field['label'],
		    $localid=$d.'['.$field['id'].']', 
		    $helptext= $field['helptext'], 
		    $rep=$field['rep'],
		    $value=$value,
		    $optionvalues=$optionvalues=$field['values'],
		    $specialfunction=$y);*/
	    endforeach ?>
	    </table>
    <?php }


/****************************************************************************
** show_metabox
*****************************************************************************/
    function show_metabox() {
	global $current_screen;
	foreach ( $this->option_metabox as $tab_form) : 
	    $xx=$tab_form['show_on']['template'];
	    $div=$tab_form['show_on']['div'];
/****************** POST TYPE *************************************************/
	    if (get_post_type()==$xx &&
	    $this->Type == $current_screen->id){ 
	    if  ($this->test) _log ('OK');?>
	    <script type="text/javascript">
	        jQuery(document).ready( function($) {
		    $z='<?php echo $tab_form['key'];//$this->DB_field;?>';
		    $x='<?php echo $xx;?>'+'.php';
		    $y='#'+'<?php echo $div;?>'
		    console.log('x'+$x+'y'+$y);
		    $($y).show();
		});
	    </script>
	    <?php return; 
	    }
/****************** PAGE *************************************************/
	    if('page' != $current_screen->id) return; ?>
		<script type="text/javascript">
		    jQuery(document).ready( function($) {
			$y='#'+'<?php echo $div;?>';
			$x='<?php echo $xx;?>';
			console.log('x'+$x+'y'+$y);
			if($('#page_template').val() === $x) {
//			    console.log('Lika med X');
			    $($y).show();
			} else {
			    console.log('Inte lika med X');
			    console.log($('#page_template').val());
			    if ($x !=='default') $($y).hide();
			}
			if (typeof console == "object") 
			    console.log ('default value = ' + $('#page_template').val());
			    $('#page_template').live('change', function(){
				    $x='<?php echo $xx;//this->Show_on;?>';
				    $y='#'+'<?php echo $div;?>';
				    console.log('live change');
		    
				    if($(this).val() === $x) {
					console.log('LIVE CHANGE lika med ska visa');
					$($y).show();
    				    } else {
					console.log('LIVE CHANGE inte lika med ska intevisa ' + $x);
					console.log($(this).val());
					if($x !== 'default')$($y).hide();
			}
			if (typeof console == "object") 
			    console.log ('live change value = ' + $(this).val());
		    }
		);                 
        });    
        </script>
<?php
    endforeach;
    
	    }
}
global $my_Pagesettings;
$my_Pagesettings = new Cls_themepagesettings;

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class cls_optionsbase {
    private $test=1;
    protected $option_metabox = array();
    protected $options = array();
    protected $istheme = false;
    public function __construct($theme=false)
    {
        $this->istheme=$theme;
        $this->option_fields();
        if (!$theme) {
	    add_action('admin_head', array( $this, 'show_metabox'));
	    add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
	    add_action( 'save_post', array( $this, 'save' ) );		
	}
	    else{
	    $this->title = __( 'Theme Options', 'txt_kobotolo' );
	    add_action( 'admin_init', array( $this, 'register_settings_for_theme' ) );
	    add_action( 'admin_menu', array( $this, 'add_theme_page' ) ); 
	    $this->kobotolo_init();
	}
    }
/*****************************************************************************
** Init fields
*****************************************************************************/
    public function option_fields() {}
    
/*****************************************************************************
** Init and remeber all values
*****************************************************************************/
    public function kobotolo_init() {
	if  ($this->test) _log('START kobotolo_init');
	if ( ! empty( $this->options ) ) {
	if  ($this->test)_log('array already init');
	    return $this->options;
    }        
    $option_tabs = $this->option_fields();
        foreach ($option_tabs as $index => $option_tab) {
	    
	    global $post;
	    if (!$this->istheme)  {
		if  ($this->test) _log('Getting values for not theme');
		$dbvalues = get_post_meta(get_the_id(),$option_tab['id'],true);
	    }else {
		$dbvalues = get_option($option_tab['id'],true);
	    }
	    foreach ($option_tab['fields'] as $key => $field_id) {
		$rep=isset($field_id['repeated']) ? :false;
		if ($rep) :
		    _log("found repeated field".$key);
		    $found=TRUE;
		    $nr=0;
		    while($found) :
			$intid = $field_id['id'].$nr;
			$intiddb = $field_id['id'];//.'0';
			_log('intid'.$intid);
			
			if (isset($dbvalues[$intid]) && $dbvalues[$intid]!=="" ) :
			    $x=  $dbvalues[$intid];
				$this->options[$option_tab['id']][$field_id['id']][]= $x;
			else : 
			    $x=$field_id['default'];
			    $found=false;
			endif;
			
			$nr=$nr+1;
		    endwhile;
		else: 
		    $x= isset($dbvalues[$field_id['id']]) ? $dbvalues[$field_id['id']] : $field_id['default'];
		    $this->options[$option_tab['id']][$field_id['id']]= $x;
		endif;
		}
	    }
	if  ($this->test) _log($this->options);
        if  ($this->test) _log('STOPP kobotolo_init');
	
    }
/*****************************************************************************
** get_option_key
*****************************************************************************/
    public function get_option_key($field_id) {
    	if  ($this->test) _log('Anrop till get_option_key ===>'.$field_id);
	$option_tabs = $this->option_fields();
    	foreach ($option_tabs as $key=>$option_tab) { //search all tabs
	    foreach ($option_tab['fields'] as $field) { //search all fields
		if ($field['id'] == $field_id) {
		    if  ($this->test) _log('returning'.$option_tab['id']);
			return $option_tab['id'];
		}
	    }
    	}
	if  ($this->test) _log('get option key not found');
	return $this->key; //return default key if field id not found
    }

/*****************************************************************************
** get_option_value
*****************************************************************************/
    public function get_option_value($field_id) {
	$this->kobotolo_init();
	$option_tab = $this->get_option_key($field_id);
	 if  ($this->test)_log('returning '.$this->options[$option_tab][$field_id].'for post ='.get_the_ID());
	return $this->options[$option_tab][$field_id]; 
    }
/****************************************************************************
 * * get_default_value
 ****************************************************************************/  
    public function get_value( $field_id ) {
	if  ($this->test) _log($field_id);
	$option_tab = $this->get_option_key($field_id);
	//$cat_keys = array_keys($_POST[$this->DB_field]);
	foreach ($this->options as $key=>$field){    
	    if ($key==$field) {
		return $options[$key][$field_id];
	}
    }}
/*****************************************************************************
** Add_theme_page
*****************************************************************************/
    public function add_theme_page() {        
	if (!$this->istheme) return;
	$option_tabs = $this->option_fields();
        foreach ($option_tabs as $index => $option_tab) {
	    if ( $index == 0) {
		$this->options_pages[] = add_theme_page( $this->title, $this->title, 
		    'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) ); 
		add_theme_page( $option_tabs[0]['id'], $this->title, 
		    $option_tab['title'], 'manage_options', $option_tab['id'], 
		    array( $this, 'admin_page_display' ) ); 
	    } else {
		$this->options_pages[] = add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) );
	    }
	}
    }

/*****************************************************************************
** Add_theme_page
*****************************************************************************/
    public function register_settings_for_theme() {
        if (!$this->istheme) return;
	$option_tabs = $this->option_fields();
	foreach ($option_tabs as $index => $option_tab) {
	    $x=$option_tab['id']; 
	    register_setting( $x, $option_tab['id'] );
	}	
    }
/*****************************************************************************
** Add_theme_page
*****************************************************************************/
    public function admin_page_display() {
        if (!$this->istheme) return;
    	$option_tabs = $this->option_fields(); //get all option tabs
    	$tab_forms = array();     	   	?>
        <div class="wrap cmb_options_page <?php echo '';//$this->key; ?>">        	
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
            
            <!-- Options Page Nav Tabs -->           
            <h2 class="nav-tab-wrapper">
            	<?php foreach ($option_tabs as $option_tab) :
		    $tab_slug = $option_tab['id'];
		    $nav_class = 'nav-tab';
		    if ( $tab_slug == $_GET['page'] ) {
			    $nav_class .= ' nav-tab-active'; //add active class to current tab
			    $tab_forms[] = $option_tab; //add current tab to forms to be rendered
		    }
            	?>            	
            	<a class="<?php echo $nav_class; ?>" href="<?php menu_page_url( $tab_slug ); ?>"><?php echo ($option_tab['title']); ?></a>
            	<?php endforeach; ?>
            </h2>
            <!-- End of Nav Tabs -->

            <?php foreach ($tab_forms as $tab_form) : echo '1        ';//render all tab forms (normaly just 1 form) ?>
            
	    <div id="<?php echo ($tab_form['id']); ?>" class="group">
            	<?php $this->generate_form( $tab_form, $tab_form['id']);//cmb_metabox_form( $tab_form, $tab_form['id'] ); ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * CMB Tabbed Theme Options
 *
 * @author    Arushad Ahmed <@dash8x, contact@arushad.org>
 * @link      http://arushad.org/how-to-create-a-tabbed-options-page-for-your-wordpress-theme-using-cmb
 * @version   0.1.0
 */
class my_Admin {
    private $key = 'my_options';
    protected $option_metabox = array();
    protected $options = array();
    protected $title = '';
    protected $options_pages = array();
    public function __construct() {
        $this->title = __( 'Theme Options', 'txt_kobotolo' );
	$this->hooks();
	
    }
    public function hooks() {
        add_action( 'admin_init', array( $this, 'init' ) );
        add_action( 'wp_head', array( $this, 'kobotolo_init' ) );
        //add_action( 'admin_init', array( $this, 'kobotolo_init' ) );
        add_action( 'admin_menu', array( $this, 'add_theme_page' ) ); //create tab pages
    }

    public function init() {
    	$option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
	    $x=$option_tab['id']; echo '<br init x '>$x;
        	register_setting( 'kobotolo_'.$x, 'kobotolo_'.$option_tab['id'] );
	}	
    }
    public function kobotolo_init() {
        /*echo '<br>Kobotolo init - get values to array <br>';
	echo 'före kobotolo intit';print_r($this->options);
	echo 'utskrift klar<br>';
	*/
	$option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
	  //  echo 'kobotolo_init'. $option_tab['id'].'<br>';
	    $dbvalues = get_option('kobotolo_'.$option_tab['id']);
	    $this->options[$option_tab['id']] = $dbvalues;//get_option($option_tab['id']);
            /*echo 'dbvalues<br>';
	    echo 'options with dbvalurs';print_r($this->options);
	    var_dump($dbvalues);
	    */foreach ($option_tab['fields'] as $key => $field_id) {
		//echo '<br>i nästlad loop<br>';
		//echo 'key ';var_dump($key);
		//echo '<br>field id ';var_dump($field_id);
	        $x= isset($dbvalues[$field_id['id']]) ? $dbvalues[$field_id['id']] :$field_id['default'];
	    	//echo '<br>dbarray id ';var_dump($dbvalues[$field_id['id'] ]);
		//echo '<br>x ';var_dump($x);
		$this->options[$option_tab['id']][$field_id['id']]= $x;



//get_option($option_tab['id']);
//                echo '<br>this options ';var_dump($this->options[$option_tab['id']][$field_id]);
		
		/*		echo isset($dbvalues[$field_id['id'] ]).'isset?<br>'; 		
		//var_dump($x);
		echo 'ssssssssssssssssssssssssssssssssssss'.'=x<br>';
		
		var_dump($x);echo '<x init'.'=x<br>';
		//$this->options[$option_tab['id']][$field_id] = $x;//get_option($option_tab['id']);
*/		
		}
	    	//echo '<br><br><br><br>';	
	
	    }
/*echo 'after kobotolo intit';print_r($this->options);
echo 'utskrift klar<br>';
*/    }

    public function add_theme_page() {        
        $option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
	    if ( $index == 0) {
		$this->options_pages[] = add_theme_page( $this->title, $this->title, 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) ); //Link admin menu to first tab
		add_theme_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) ); //Duplicate menu link for first submenu page
	    } else {
		$this->options_pages[] = add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) );
	    }
	    //$this->options[$option_tab['id']] = get_option($option_tab['id']);
	}
    $this->kobotolo_init();
    }
    public function admin_page_display() {
    	$option_tabs = self::option_fields(); //get all option tabs
    	$tab_forms = array();     	   	?>
        <div class="wrap cmb_options_page <?php echo $this->key; ?>">        	
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

/******************************************************************************
*******************************************************************************/
     function generate_form($tab_form, $id){	
	 $idform='kobotolo_'.$id;?>
	<form  action="options.php" method="post">
	    <table> 
	    <?php settings_fields( 'kobotolo_'.$id);
		do_settings_sections( 'kobotolo_'.$id );
		echo '<br>id'.'kobotolo_'.$id;
		foreach ($tab_form['fields'] as $key=>$value) :
		    $type=$value['type'];
		    $text= $value['desc']; ?>
		    <tr><th>
			<label for="<?php echo $value['id']; ?>"><?php echo $text; ?></label>
		    </th><td>
		    <?php $val=$this->options[$id][$value['id']];  //$value['default'];
		    switch ($type) {
			case 'chkBox': 
			    $checked = $val=='checked' ? $val : "notchecked";?>
			    <input type="checkbox" 
				id="<?php echo $value['id']; ?>" 
				name="<?php echo $idform; ?>[<?php echo $value['id']; ?>]" 
				       <?php echo $checked; ?> 
				value="<?php echo 'checked'; ?>"/>
			    <?php break; 
			  case 'colorpicker': ?>
		           <input class="color-picker" 
			       name="<?php echo $idform; ?>[<?php echo $value['id']; ?>]"  
		               type="text" 
		               value="<?php echo $val; ?>"/>
			
			    <?php break;
			default: ?>
			    <input type="text" id="<?php echo $value['id']; ?>" 
				 name="<?php echo $idform; ?>[<?php echo $value['id']; ?>]"  
				value="<?php echo $val; ?>"/>
			    <?php 
			  } ?>
			</td>
		    </tr>
		    <?php
		endforeach; ?>
	    </table>	
	<?php submit_button(); ?>
	</form>
</div>
<?php } /**
     * Defines the theme option metabox and field configuration
     * @since  0.1.0
     * @return array
     */
    public function option_fields() {

        // Only need to initiate the array once per page-load
        if ( ! empty( $this->option_metabox ) ) {
            return $this->option_metabox;
        }        

/*        $this->option_metabox[] = array(
            'id'         => 'general_options', //id used as tab page slug, must be unique
            'title'      => 'General Options',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'general_options' ), ), //value must be same as id
            'show_names' => true,
            'fields'     => array(
		array(
			'name' => __('Header Logo', 'txt_kobotolo'),
			'desc' => __('Logo to be displayed in the header menu.', 'txt_kobotolo'),
			'id' => 'header_logo', //each field id must be unique
			'default' => 'header logo',
			'type' => 'file',
		),		
		array(
			'name' => __('Login Logo', 'txt_kobotolo'),
			'desc' => __('Logo to be displayed in the login page. (320x120)', 'txt_kobotolo'),
			'id' => 'login_logo',
			'default' => 'Login logo',
			'type' => 'file',
		),
		array(
			'name' => __('Favicon', 'txt_kobotolo'),
			'desc' => __('Site favicon. (32x32)', 'txt_kobotolo'),
			'id' => 'favicon',
			'default' => 'favicon',
			'type' => 'file',
		),
		array(
			'name' => __( 'SEO', 'txt_kobotolo' ),
			'desc' => __( 'Search Engine Optimization Settings.', 'txt_kobotolo' ),
			'id'   => 'branding_title', //field id must be unique
			'default' => '',
			'type' => 'title',
		),
		array(
			'name' => __('Site Keywords', 'txt_kobotolo'),
			'desc' => __('Keywords describing this site, comma separated.', 'txt_kobotolo'),
			'id' => 'site_keywords',
			'default' => '',				
			'type' => 'textarea_small',
		),
	)
        );		
*/
        $this->option_metabox[] = array(
            'id'         => 'social_options',
            'title'      => 'Social Media Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'social_options' ), ),
            'show_names' => true,
            'fields'     => array(
		array(
			'name' => __('Facebook Username', 'txt_kobotolo'),
			'desc' => __('Username of Facebook page.', 'txt_kobotolo'),
			'id' => 'facebook',
			'default' => '',					
			'type' => 'text'
		),
		array(
		    'name' => __('Twitter Username', 'txt_kobotolo'),
		    'desc' => __('Username of Twitter profile.', 'txt_kobotolo'),
		    'id' => 'twitter',
		    'default' => '',					
		    'type' => 'text'
	    ),
		array(
		    'name' => __('Youtube Username', 'txt_kobotolo'),
		    'desc' => __('Username of Youtube channel.', 'txt_kobotolo'),
		    'id' => 'youtube',
		    'default' => '',					
		    'type' => 'text'
	    ),
	    array(
		    'name' => __('Flickr Username', 'txt_kobotolo'),
		    'desc' => __('Username of Flickr profile.', 'txt_kobotolo'),
		    'id' => 'flickr',
		    'default' => '',					
		    'type' => 'text'
	    ),
	    array(
		    'name' => __('Google+ Profile ID', 'txt_kobotolo'),
		    'desc' => __('ID of Google+ profile.', 'txt_kobotolo'),
		    'id' => 'google_plus',
		    'default' => '',					
		    'type' => 'text'
	    ),
	)
        );

        $this->option_metabox[] = array(
            'id'         => 'advanced_options',
            'title'      => 'Advanced Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'advanced_options' ), ),
            'show_names' => true,
            'fields'     => array(
            	array(
		    'name' => __('Color Scheme', 'txt_kobotolo'),
		    'desc' => __('Main theme color.', 'txt_kobotolo'),
		    'id' => 'color_scheme',
		    'default' => '',				
		    'type' => 'colorpicker',
	    ),
		array(
		    'name' => __('Custom CSS', 'txt_kobotolo'),
		    'desc' => __('Enter any custom CSS you want here.', 'txt_kobotolo'),
		    'id' => 'new_custom_css',
		    'default' => '',				
		    'type' => 'textarea',
	    ),
    )
        );
        
        $this->option_metabox[] = array(
            'id'         => 'menu_options',
            'title'      => 'Menu Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'menu_options' ), ),
            'show_names' => true,
            'fields'     => array(
            	array(
		    'name' => __('Color Scheme', 'txt_kobotolo'),
		    'desc' => __('Background menu.', 'txt_kobotolo'),
		    'id' => 'menu_bg',
		    'default' => '#fff',				
		    'type' => 'colorpicker',
	    ),
		array(
		    'name' => __('Page Boxed', 'txt_kobotolo'),
		    'desc' => __('Page Boxed.', 'txt_kobotolo'),
		    'id' => 'boxed',
		    'default' => 'notchecked',				
		    'type' => 'chkBox',
	    ),
	      array(
		    'name' => __('Sidebar position default', 'txt_kobotolo'),
		    'desc' => __('Sidebar position default.', 'txt_kobotolo'),
		    'id' => 'sidebar_pos',
		    'default' => 'left',				
		    'type' => 'text',
	    ),
			)
        );
        
        //insert extra tabs here

        return $this->option_metabox;
    }

    /**
     * Returns the option key for a given field id
     * @since  0.1.0
     * @return array
     */
    public function get_option_key($field_id) {
    	$option_tabs = $this->option_fields();
    	foreach ($option_tabs as $option_tab) { //search all tabs
    		foreach ($option_tab['fields'] as $field) { //search all fields
    			if ($field['id'] == $field_id) {
    				return $option_tab['id'];
    			}
    		}
    	}
    	return $this->key; //return default key if field id not found
    }
    public function get_option_value($field_id) {
	$option_tab = $this->get_option_key($field_id);
	return $this->options[$option_tab][$field_id]; //return default key if field id not found
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {

        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'fields', 'title', 'options_pages' ), true ) ) {
            return $this->{$field};
        }
        if ( 'option_metabox' === $field ) {
            return $this->option_fields();
        }

        throw new Exception( 'Invalid property: ' . $field );
    }

}

// Get it started
    global $my_Admin;
$my_Admin = new my_Admin();
$my_Admin->hooks();
//$my_Admin->init();
//echo 'cc'.$my_Admin->get_option_key('menu_bg');
//echo get_option($my_Admin->get_option_key('menu_bg'));
//echo '<br>gggggggggg'.my_option('menu_bg').'<br>';
/**
 * Wrapper function around cmb_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function my_option( $key = '' ) {
    global $my_Admin;
    echo $key;
    $x=$my_Admin->get_option_value( $key);
    
echo 'aaa';    //ar_dump($my_Admin->options);echo 'bbb';
return $x;

}


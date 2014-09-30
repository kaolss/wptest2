<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class my_Admin  extends cls_optionsbase{
   
    public function hooks() {
         }

/******************************************************************************
*******************************************************************************/
     function generate_form($tab_form, $id){?>
	<form  action="options.php" method="post">
	    <table> 
		<?php settings_fields( $id);
		do_settings_sections( $id );
		foreach ($tab_form['fields'] as $key=>$value) :
		    $valid= $value['id']; 
		    $sss=(isset($value['selectvalues']) ? $value['selectvalues']:'');
		    $rep=(isset($value['repeated']) ? $value['repeated']:false);
		    _log($id);
		   _log($this->options[$id]);
$args =array(
		  'dbid' => $id, 
		  'type' =>  $value['type'],
		  'label' => $value['label'],
		  'localid'=>$value['id'],//$value['id'], 
		  'helptext' => $value['helptext'], 
		  'rep'=>$rep,
		  'value' =>$this->options[$id][$value['id']],
		  'optionvalues'=>$sss);
		
		    options_fields::make_text_box($args);

		    
		    
		    
		    /*options_fields::make_text_box( 
			$dbid = $id, 
			$type = $value['type'], 
			$label= $value['label'],
			$localid=$value['id'],//$value['id'],//'kobotolo_'.$id,//$this->DB_field.'['.$key.']', 
			$helptext= $value['helptext'],//'',//$field['helptext'], 
			$value=$this->options[$id][$value['id']],//,//$x,
			$repeated=$rep,
			$selectedvalues=$sss//value['selectvalues'])
			);*///
		endforeach; ?>
	    </table>	
	<?php submit_button(); ?>
	</form>
</div>
<?php } 
    public function option_fields() {

        // Only need to initiate the array once per page-load
        if ( ! empty( $this->option_metabox ) ) :
            return $this->option_metabox;
        endif;        

/*****************************************************************************
** Social settings
*****************************************************************************/
        $this->option_metabox[] = array(
            'id'         => 'kobotolo_social_options',
            'title'      => 'Social Media Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'social_options' ), ),
            'show_names' => true,
            'fields'     => array(
		array(
			'name' => __('Facebook Username', 'txt_kobotolo'),
			'label' => __('Username of Facebook page.', 'txt_kobotolo'),
			'id' => 'facebook',
			'helptext' => '',					
			'default' => '',					
			'type' => 'text'
		),
		array(
		    'name' => __('Twitter Username', 'txt_kobotolo'),
		    'label' => __('Username of Twitter profile.', 'txt_kobotolo'),
		    'id' => 'twitter',
		    'default' => '',					
			'helptext' => '',					
		    'type' => 'text'
	    ),
		array(
		    'name' => __('Youtube Username', 'txt_kobotolo'),
		    'label' => __('Username of Youtube channel.', 'txt_kobotolo'),
		    'id' => 'youtube',
		    'default' => '',					
			'helptext' => '',					
		    'type' => 'text'
	    ),
	    array(
		    'name' => __('Flickr Username', 'txt_kobotolo'),
		    'label' => __('Username of Flickr profile.', 'txt_kobotolo'),
		    'id' => 'flickr',
		    'default' => '',					
			'helptext' => '',					
		    'type' => 'text'
	    ),
	    array(
		    'name' => __('Google+ Profile ID', 'txt_kobotolo'),
		    'label' => __('ID of Google+ profile.', 'txt_kobotolo'),
		    'id' => 'google_plus',
		    'default' => '',					
			'helptext' => '',					
		    'type' => 'text'
	    ),
	)
        );
/*****************************************************************************
** Advanced settings
*****************************************************************************/

        $this->option_metabox[] = array(
            'id'         => 'kobotolo_advanced_options',
            'title'      => 'Advanced Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'advanced_options' ), ),
            'show_names' => true,
            'fields'     => array(
		array(
		    'name' => __('Custom CSS', 'txt_kobotolo'),
		    'label' => __('Enter any custom CSS you want here.', 'txt_kobotolo'),
		    'id' => 'new_custom_css',
		    'default' => '',				
			'helptext' => '',					
		    'type' => 'textarea',
	    ),
    )
        );
        
/*****************************************************************************
** General settings
*****************************************************************************/
	
        $this->option_metabox[] = array(
            'id'         => 'kobotolo_general_options',
            'title'      => 'General Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'general_options' ), ),
            'show_names' => true,
            'fields'     => array(
            	array(
		    'name' => __('Color Scheme', 'txt_kobotolo'),
		    'label' => __('Header image', 'txt_kobotolo'),
		    'helptext' => __('Choose your logo', 'txt_kobotolo'),
		    'id' => 'logo',
		    'default' => '',				
		    'type' => 'image',
	    ),
            	array(
		    'name' => __('Color Scheme', 'txt_kobotolo'),
		    'label' => __('Main theme color.', 'txt_kobotolo'),
		    'id' => 'page_bg',
		    'default' => 'light',				
		    'helptext' => '',					
		    'type' => 'select',
		    'selectvalues' => array('light','medium','dark'),
	    ),
	    array(
		    'name' => __('Color Scheme', 'txt_kobotolo'),
		    'label' => __('Secondary theme color.', 'txt_kobotolo'),
		    'id' => 'secondary',
		    'default' => 'blue',				
		    'helptext' => '',					
		    'type' => 'select',
		    'selectvalues' => array('blue','red','green'),
	    ),
		array(
		    'name' => __('Page Boxed', 'txt_kobotolo'),
		    'label' => __('Page Boxed.', 'txt_kobotolo'),
		    'helptext' => __('Check this if you want a narrow layout.', 'txt_kobotolo'),
		    'id' => 'boxed',
		    'default' => '',				
		    'type' => 'chkBox',
	    ),
	      ));
/*****************************************************************************
** Menu settings
*****************************************************************************/
	
        $this->option_metabox[] = array(
            'id'         => 'kobotolo_menu_options',
            'title'      => 'Menu Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'menu_options' ), ),
            'show_names' => true,
            'fields'     => array(
            	array(
		    'name' => __('Color Scheme', 'txt_kobotolo'),
		    'label' => __('Menu colour', 'txt_kobotolo'),
		    'helptext' => __('Choose colour for menu.', 'txt_kobotolo'),
		    'id' => 'menu_bg',
		    'default' => '#fff',				
		    'type' => 'colorpicker',
	    ),
	      array(
		    'name' => __('Sidebar position default', 'txt_kobotolo'),
		    'label' => __('Sidebar position default.', 'txt_kobotolo'),
		    'helptext' => __('Choose default position for sidebar.', 'txt_kobotolo'),
		    'id' => 'sidebar_pos',
		    'default' => 'left',				
		    'type' => 'select',
		    'selectvalues' => array('left','right','none'),
		
	    ),
));			
/*****************************************************************************
** Header settings
*****************************************************************************/
	
        $this->option_metabox[] = array(
            'id'         => 'kobotolo_header_options',
            'title'      => 'Header Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'header_options' ), ),
            'show_names' => true,
            'fields'     => array(
	     /* array(
		    'name' => __('Header choose', 'txt_kobotolo'),
		    'label' => __('Choose header layout', 'txt_kobotolo'),
		    'helptext' => __('Choose the header you prefer', 'txt_kobotolo'),
		    'id' => 'header_layout',
		    'default' => 'header1',				
		    'type' => 'radioimage',
		    'selectvalues' => array('header1','header2','header3'),
		
	    ),*/
	      array(
		    'name' => __('xx', 'txt_kobotolo'),
		    'label' => __('Text above header in layout 1', 'txt_kobotolo'),
		    'helptext' => __('Text above header in layout 1', 'txt_kobotolo'),
		    'id' => 'contact_text',
		    'default' => 'Contact us',				
		    'repeated' => 'true',
		    'type' => 'text',
	    ),
	      array(
		    'name' => __('xx', 'txt_kobotolo'),
		    'label' => __('Image 1 in header', 'txt_kobotolo'),
		    'helptext' => __('Text above header in layout 1', 'txt_kobotolo'),
		    'id' => 'header_image1',
		    'default' => '',
		    'repeated' => 'true',
		    'type' => 'image',
	    ),
			)
        );
        
        
        return $this->option_metabox;
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
/*    public function __get( $field ) {

        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'fields', 'title', 'options_pages' ), true ) ) {
            return $this->{$field};
        }
        if ( 'option_metabox' === $field ) {
            return $this->option_fields();
        }

        throw new Exception( 'Invalid property: ' . $field );
    }
*/
}

// Get it started
    global $my_Admin;
$my_Admin = new my_Admin(true);
$my_Admin->hooks();
get_template_part('lib/options.fields');

function my_option( $key = '' ) {
    global $my_Admin;
    echo $key;
    $x=$my_Admin->get_option_value( $key);
    
return $x;
}
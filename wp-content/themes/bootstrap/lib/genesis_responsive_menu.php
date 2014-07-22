<?php
/**
 * Plugin Name: Genesis responsive menu
 * Plugin URI: 
 * Description: Makes the primary menu responsive.
 * Version: 0.01
 * Author: Karin H Olsson
 * Author URI: http://kobotolo.se
 * License: GPL2
 */

//add_action( 'wp_head', 'ok_responsive_head' );
function ok_responsive_head (){
    $options = get_option('grm_css_data');
	?>
		<style>
			
			.nav-primary .menu-item {
			/************ add height for menu here *******/
				line-height:<?php echo $options['Primary-nav Height']; ?>;
				height:<?php echo $options['Primary-nav Height']; ?>;	
				background:<?php echo $options['Primary-nav Color']; ?>
			
			}
			.nav-primary .sub-menu .menu-item {
			/************ add height for submenu here *******/
				line-height: <?php echo $options['Primary-nav sub-item Height'];?>;
				height:<?php echo $options['Primary-nav sub-item Height'];?>;
				width: <?php echo $options['Primary-nav sub-item Width'];?>;
	}
			#rememberNav .sub-menu .menu-item a{
				background: <?php echo $options['Primary-nav sub-item background'];?>;
				color: <?php echo $options['Primary-nav sub-item color'];?>;
			}		
		</style>
	<?php
}

add_action( 'wp_enqueue_scripts', 'ok_responsive_css' );

function ok_responsive_css() {
    wp_enqueue_script('nav_for_mobile', get_stylesheet_directory_uri(). '/lib/plugins/grm/js/drop-down-nav.js' , array('jquery'), '0.5' );	
	wp_enqueue_style( 'genesis_responsive_menu', get_stylesheet_directory_uri().'/lib/plugins/grm/css/genesis_responsive_menu.css', array(), '0.0.1' );
	if ( file_exists( get_stylesheet_directory()."/custom.css" ) ) {
		wp_enqueue_style( 'genesis_responsive_menu_custom', get_stylesheet_directory_uri() . '/custom.css', array(), '0.0.1' );
	}		
}

add_action('admin_menu', 'grm_create_menu');

function grm_create_menu() {

	//create new top-level menu
	add_menu_page('Genesis responsive menu', 'Genesis responsive menu', 'administrator', __FILE__, 'grm_settings_page',plugins_url('/images/icon.png', __FILE__));
	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'grm-settings-group', 'grm_css_data' );
}

function grm_settings_page() { ?>
	<div class="wrap">
	<h2>Genesis responsive menu</h2>
	<?php
	$dbArray = get_option('grm_css_data');
	$defaultArray = grm_init_json();
	$tempArray = array_merge($defaultArray, $dbArray);
	$jsonArray = array_intersect_key($tempArray,$defaultArray);
	?> 
    <form action="options.php" method="post">
		<table> 
		<?php
		
        settings_fields( 'grm-settings-group');
        do_settings_sections( 'grm-settings-group' );
			var_dump($jsonArray);
			foreach ($jsonArray as $key=>$value) :
				?>
				<tr>
					<th>
						<label for="<?php echo $key; ?>">
							<?php echo $key; ?>
						</label>
					</th>
					<td>
							<input id="<?php echo $key; ?>" name="grm_css_data[<?php echo $key; ?>]" value="<?php echo $value; ?>"/>
					</td>
				</tr>
				<?php
			endforeach;
		?>
		</table>
		
		<?php submit_button(); ?>
	</form>
	

</div>
<?php } 


function grm_init_json(){
    return Array('Primary-nav Height' => '40px', 
				 'Primary-nav Color'  => 'blue',
				 'Primary-nav sub-item Height' => '40px',
				 'Primary-nav sub-item Width' => '150px',
		
				 'Primary-nav sub-item background' => 'white',
				 'Primary-nav sub-item color' => 'black',
				 'Mobile-nav Height' => '80px',
				 'Mobile-nav Background' => 'yellow'
		
		);
}

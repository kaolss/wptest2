<?php


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function kobotolo_register_mysettings() {
	//register our settings
	register_setting( 'kobotolo-settings-group', 'kobotolo_data' );
}

function theme_options_panel(){
  add_menu_page('KoBoToLo', 'KoBoToLo', 'manage_options', 'theme-options', 'kobotolo_settings_page');
  add_submenu_page( 'theme-options', 'Settings page title', 'Settings menu label', 'manage_options', 'theme-op-settings', 'wps_theme_func_settings');
  add_submenu_page( 'theme-options', 'FAQ page title', 'FAQ menu label', 'manage_options', 'theme-op-faq', 'wps_theme_func_faq');
	add_action( 'admin_init', 'kobotolo_register_mysettings' );
  
}
add_action('admin_menu', 'theme_options_panel');
function wps_theme_func(){
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>Theme</h2></div>';
}
function wps_theme_func_settings(){
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>Settings</h2></div>';
}
function wps_theme_func_faq(){
	echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
	<h2>FAQ</h2></div>';
}
add_action( 'wp_head', 'kobotolo_head' );

function kobotolo_head (){
    $options = get_option('kobotolo_data');
	if (!isset($options['chBoxed'])) {?>
		<style>
			.box {
			/************ add height for menu here *******/
				width:100%;
				margin:0 auto;
			}
			.slider {
			/************ add height for menu here *******
				height:50vh;*/
			
			}
		</style>
	<?php }
}

function my_custom_submenu_page_callback() {
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
		echo '<h2>My Custom Submenu Page</h2>';
	echo '</div>';
}
function kobotolo_settings_page() { ?>
	<div class="wrap">
	<h2>KoBoToLo</h2>
	<?php
	$dbArray = get_option('kobotolo_data');
	var_dump($dbArray);
			$defaultArray = kobotolo_init_json();
	$jsonArray = $defaultArray;
	if (!is_null($dbArray)) {
		echo 'det är en array';
		$tempArray = array_merge($defaultArray, $dbArray);
		$jsonArray = array_intersect_key($tempArray,$defaultArray);
	}
	?> 
    <form action="options.php" method="post">
		<table> 
		<?php
		
        settings_fields( 'kobotolo-settings-group');
        do_settings_sections( 'kobotolo_data' );
			foreach ($jsonArray as $key=>$value) :
				$type='value';
				$text= $key;
				
				if ($key=="chBoxed") {
					$type='chbox';
				}?>
				<tr>
					<th>
						<label for="<?php echo $key; ?>">
							<?php echo $text; ?>
						</label>
					</th>
					<td>
					<?php
						if ($type=='chbox') {
						$checked = $value=='checked' ? $value : " "; 
						echo $checked.'ccc';?>
						<input type="checkbox" id="<?php echo $key; ?>" name="kobotolo_data[<?php echo $key; ?>]" <?php echo $checked; ?> value="<?php echo 'checked'; ?>"/>
						<?php } 
						else { ?>
							<input id="<?php echo $key; ?>" name="kobotolo_data[<?php echo $key; ?>]"  value="<?php echo $value; ?>"/>

						<?php }?>		
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
function kobotolo_init_json(){
    return Array('chBoxed' => '', 
			 'Mobile-nav Background' => 'yellow'
		);
}

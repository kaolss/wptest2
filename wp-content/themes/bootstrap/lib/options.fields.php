<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class options_fields {
    public static function make_text_box_inside($dbid, $type, $label, $localid, $helptext, $value, $rep, $optionvalues="", $specialfunction="") { 
	    $id=$dbid.'['.$localid.']';
	    ?> 
	<tr>
	    <td>
		<label for="<?php echo $id;?>"><?php echo  $label;?></label>
	    </td>
	    <td>
		<?php switch ($type) {
		    case 'text' : ?>
			<input type="text" size="35" 
			    id="<?php echo $id;?>"
			    name="<?php echo $id; ?>"
			    value="<?php echo $value;?>" />		    
			<?php break;
		    case 'chkBox' :
			$text="";
			if ($value=='checked') {$text='checked';} ?>
			    <input type="checkbox" 
			name="<?php echo $id; ?>" 
			id="<?php echo $id; ?>" 
				   value="checked" 
			<?php echo $text; ?>>		
			<?php  
			break;
		    case 'select' : ?>
			<select 
			    id="<?php echo $id;?>"
			    name="<?php echo $id; ?>">			
			    <?php foreach ($optionvalues as $selectvalue) { 
				$text=""; 
				if ($value==$selectvalue) {$text=" selected";} ?>
				<option value="<?php echo $selectvalue.'" '.$text?>><?php echo $selectvalue?></option> 
			    <?php }?>
			</select>
			<?php break;
		    case 'radioimage' : ?>
			<div class="radio-button-wrapper">
			    <?php foreach ($optionvalues as $selectvalue) { 
				$text="";
				if ($value==$selectvalue) {$text=" checked";} ?>
				
				<span class="image-radio">
			            <input type="radio"
					id="<?php echo $id?>"
					value="<?php echo $selectvalue?>"
					name="<?php echo $id; ?>"
					<?php  echo $text?>>			
			        <img src="<?php echo get_template_directory_uri(). '/images/'.$selectvalue.'.jpg';?>">
				</span>
			    <?php }?>
			
			</div>
			<?php break;
		    case 'textarea' : ?>
			<textarea 
			    id="<?php echo $id;?>"
			    name="<?php echo $id; ?>"			
			    wrap="hard"   
			    cols="35" rows="2"><?php echo $value;?></textarea> 
			<?php break;
		    case 'colorpicker': ?>
		           <input class="color-picker" 
			       name="<?php echo $id; ?>"  
		               type="text" 
		               value="<?php echo $value; ?>"/>
			
			    <?php break;
		    
			case 'special' :
			self::render_special($specialfunction, $id);
			break;
		    case 'image' : ?>
			<?php if ($value==='') : ?>
			    <input type="text" 
			       	id="image_path" 
				name="<?php echo $id; ?>" 
			        value="<?php echo $value;?>" />	
				<input id="upload_image" type="button" 
			       class="button" 
			       id="<?php echo $id; ?>" value="<?php _e( 'Upload Logo', 'txt_kobotolo' ); ?>" />
			<?php else : ?>
			    <input type="text" 
			       	id="<?php echo $id;?>"
			    	name="<?php echo $id; ?>" 
			        value="<?php echo $value;?>" />	
			
			    <?php endif; ?>
		    <td>	
	<?php ?>
	    </td>			<?php break; ?>
		<?php } ?>		    
	    </td>
	    <td>
		<span data-tip="true" class="helptext" data-tip-content="<?php echo $helptext;?>"> ? </span><br>
	    </td>
</tr>    <?php }

    public static function make_text_box($dbid, $type, $label, $localid, $helptext, $value, $rep, $optionvalues="", $specialfunction="") { 
	if (!$rep) :
	    options_fields::make_text_box_inside($dbid, $type, $label, $localid, $helptext, $value, $rep, $optionvalues, $specialfunction);
	    return;
	else :
	    _log($localid);
	    $i=$localid.'0';
	    _log($i);
	    $nr=0;
	    foreach ($value as $val) :
		$i=$localid.$nr;
		_log('index '.$nr.'   '.$i);
	    	options_fields::make_text_box_inside($dbid, $type, $label, $i, $helptext, $val, $rep, $optionvalues, $specialfunction);
		$nr=$nr+1;
	    endforeach;
		$i=$localid.$nr;
		_log('index '.$nr.'   '.$i);
	    	options_fields::make_text_box_inside($dbid, $type, $label, $i, $helptext, '', $rep, $optionvalues, $specialfunction);
	    ?>
 
<?php	
	endif;
    }
}
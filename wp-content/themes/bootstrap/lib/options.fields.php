<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class options_fields {
    private static function make_text_box_inside($args) {
	$type  = isset($args['type']) ? $args['type']:'text';
	$value  = isset($args['value']) ? $args['value']:'';
	$dbid  = $args['dbid'];
	$localid  = $args['localid'];
	$optionvalues  = $args['optionvalues'];
	
	$id=$dbid.'['.$localid.']';?>
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
		<?php break;
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
			<?php 
			$nr  = $args['nr'];
			if ($value==='') : ?>
			    <img src="" id="img<?php echo $nr;?>">
			    <input class="hidden" type="text" size="35" 
				id="<?php echo 'image-path'.$nr;?>" 
				name="<?php echo $id; ?>" 
			        value="<?php echo $value;?>" />
			    <input class="upload_image" type="button" 
			       class="button" data-rel="<?php echo 'image-path'.$nr;?>"
			       id="<?php echo $id; ?>" value="<?php _e( 'Upload Logo', 'txt_kobotolo' ); ?>" />
		
			<?php else : ?>
			    <img src="<?php echo $value;?>">
			    <input type="text" class="hidden" size="35" 
				id="<?php echo 'image-path'.$nr;?>" 
				name="<?php echo $id; ?>" 
			        value="<?php echo $value;?>" />
			
			<?php endif; ?>
			<?php break; ?>
		<?php } ?>		    
	    
    <?php }

    public static function make_text_box($args) {
	/**************** Init args **************************************/
	$label  = isset($args['label']) ? $args['label'] : 'Value?';
	$rep = isset($args['rep']) ? $args['rep'] :false ;
	$helptext  = isset($args['helptext']) ? $args['helptext']:'';
	$type  = isset($args['type']) ? $args['type']:'';
	
	$dbid  = $args['dbid'];
	$localid  = $args['localid'];
	$id=$dbid.'['.$localid.']'; 
	
	/**************** Make Label and helptext ***************************/?>
	<tr>
	    <td width="25%">
		<label for="<?php echo $id;?>"><h2>
		    <?php echo  $label;?>		<span data-tip="true" class="helptext" data-tip-content="<?php echo $helptext;?>"> ? </span>
		</h2></label>
	    </td>
	</tr>
	<?php 
	/**************** Non repetive field *********************************/
	if (!$rep) : 
	    $value  = isset($args['value']) ? $args['value']:'';
	?>
	    <tr><td>
		<?php options_fields::make_text_box_inside($args);?>
	    </td></tr>
		<?php return;
	else : 
	/******************** Repetitive field *********************************/
	    $value  = isset($args['value']) ? $args['value']: array();
	    $nr=0;?>
	    <table class="repeat-group">
		<?php 
		foreach ($value as $val) : 
		    $i=$localid.']['.$nr.'';		    
		    $intargs=$args;
		    $intargs['value']=$val;
		    $intargs['nr']=$nr;
		    
		    $intargs['localid']=$i; ?>
		    <tr class="repeat-field">
			<td ><?php options_fields::make_text_box_inside($intargs); ?>
			<input class="dodelete" type="button" class="button" 
			id="<?php echo $i; ?>" value="<?php _e( 'Remove', 'txt_kobotolo' ); ?>" />
			</td></tr>
		    <?php $nr=$nr+1;
		endforeach;
	    
		$intargs=$args;
		$i='justtocopy';
		$intargs['localid']=$i; 
		$intargs['dbid']='justtocopy'; 
		$intargs['value']='';
		    $intargs['nr']=$nr;
		_log('intargs======================>');
		_log($intargs);
		/* ****** Make add button width empty box *****************/
		?> 
		<tr class="to-copy repeat-field" data-rel="<?php echo $id;?>"><td>
		    <?php options_fields::make_text_box_inside($intargs); ?>
			<input class="dodelete" type="button" class="button" 
			id="<?php echo $i; ?>" value="<?php _e( 'Remove', 'txt_kobotolo' ); ?>" />
		</td></tr>
		
	    <tr><td>
		 <input class="doadd" type="button" class="button" 
		    id="<?php echo $i; ?>" value="<?php _e( 'Add', 'txt_kobotolo' ); ?>" />
	    </td>
	    </tr>
	    </table>
		<?php $i=$localid.$nr;?>
	    
		<?php //options_fields::make_text_box_inside($intargs); 
	endif;
    }
}
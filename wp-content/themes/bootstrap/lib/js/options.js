/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$j = jQuery.noConflict();
jQuery(function($){
$("body").on("click", ".dodelete", function(e){
    console.log("do delete");
    $(this).parent().remove();
});


$(".repeat-group").on("click", ".doadd", function(e){    
     
    $loop = $(this).parent().parent().parent();
    count = $loop.children('.repeat-field').not('.to-copy').length;
    $table = $(this).parent().parent();
        
    // the group to copy
    $group = $loop.find('.to-copy').clone().insertBefore($table).removeClass('to-copy');
    
    $input = $group.find('input').not('.dodelete');
    $inputids = $group.find('input').not('.dodelete');
    $imgs = $group.find('img').not('.dodelete');
    input_name = $group.attr('data-rel');
                
    count = $loop.children('.repeat-field').not('.to-copy').length;
    $input.attr('name', input_name + '[' + ( count + 1 ) + ']');
    $inputids.attr('id', ( count + 1 ) );
    $inputids.attr('data-rel', ( count + 1 ) );
    $imgs.attr('id', ( "img" + (count + 1) ) );

    });
});

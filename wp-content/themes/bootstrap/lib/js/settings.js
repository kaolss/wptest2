/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function( $ ) {
    $(function() {
         
        // Add Color Picker to all inputs that have 'color-field' class
        //$( '.color-picker' ).wpColorPicker();
        $('.color-picker').iris();
        console.log("color picker");
         
    });
})( jQuery );

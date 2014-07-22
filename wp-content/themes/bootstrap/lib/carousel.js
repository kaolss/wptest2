/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(document).ready(function($) {
    $("#slideshow > div:gt(0)").hide();
    setInterval(function() { 
      $('#slideshow > div:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slideshow');
    },  3000);
});
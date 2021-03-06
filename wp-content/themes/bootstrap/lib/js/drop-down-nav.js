/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var offCanvas=false; /* Are we using mobile menu? start with not */
var startLeft = 0; /* Remember initial value */
var modernBrowser = false;

jQuery( function($) {
    'use strict';
    startLeft = $(".site-container").css("marginLeft");
    /* Make a newdiv first and wrap normal menu so we can get it back */ 
    $( '<div id="menu-mobile"> </div>' ).insertBefore( 'ul.menu-primary' );
    $(".nav-primary" ).wrap( "<div id='rememberNav'></div>" );   
    $( '<div id="offcanvas"></div>' ).insertBefore( '.site-container' );
    if ( typeof Modernizr=== 'undefined' ) {
        modernBrowser = true; 
        console.log('modern=true');
    }
    else {
        modernBrowser = Modernizr.csstransitions; 
    }
        
    /* Lets move menu if a amall window */
    if ($(window).width()<769) {
        console.log('small window');
        $(".nav-primary").appendTo('#offcanvas');
        offCanvas=true;
        $( '<div id="offcanvasclear"></div>' ).insertBefore( '.site-container' );
    }
    
    /* Handle clicks */
    $('#menu-mobile').click (function(){
        /* In what state are we */
        var myMarginTop = $(".menu-primary").css("width");
                if (myMarginTop==="auto") { myMarginTop="0px";}
        console.log(myMarginTop);

        if (offcanvas) {
        console.log('offcanvas');
     if (myMarginTop==="0px"){
        console.log('margintop=0');
                if (!modernBrowser) { // Test if CSS transitions are supported
                    $( '.menu-primary' ).animate({
                      'width': '250'  }, 500);
                 $( 'div.site-container' ).animate({
                    'margin-left': '250',
                    'width': '100%'  }, 1000);
                 }
                else {    
                    $( '.site-container' ).css('margin-left', '250px');
                    $( 'body' ).css('overflow', 'hidden');
                    $( '.menu-primary' ).css('width', '250');
                }            }
            else {
        console.log('margintop<>0');
                if(!modernBrowser) { // Test if CSS transitions are supported                  
                    $( 'div.site-container' ).animate({
                    'margin-left': 0}, 1000);         
                    $( '.menu-primary' ).animate({
                      'width':'0'  }, 500);
                  }
                else {
                    $( '.site-container' ).css('margin-left', '0');
                    $( '.menu-primary' ).css('width', '0');
                }
            }
        }
    });
    
   /* Handle resize, needed for ipad, reset values and move menu if changed */
    $(window).bind('resize',function(){changedwindow();});
    $(window).bind('orientationchange',function(){changedwindow();});

   
   var changedwindow = function(){
        if ($(document).width()<769) {
            $("div.site-container").css("margin-left",startLeft);
            $('.menu-primary').css('width',"0%");
            if(!offCanvas) {
                offCanvas=true;
                $(".nav-primary").appendTo('#offcanvas');
                $( '<div id="offcanvasclear"></div>' ).insertBefore( '.site-container' );
           }
        }
        else {
           $( 'div#offcanvasclear' ).remove( );
            $(".nav-primary").appendTo('#rememberNav');
           offCanvas=false;
           $("div.site-container").css("margin-left",startLeft);
           $('.menu-primary').css('width',"100%");
       }
  };
}); 

 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(function($) {
    
    var items = [
  { img: "wp-content/uploads/2014/08/image7.jpg", caption1: "This is the first caption.", caption2:"Rad2"},
  { img: "wp-content/uploads/2014/08/Penguins.jpg", caption1: "This is the second caption.",caption2:"Och Rad2"}
];

$('#headerslide').each(function() {
        var container = $(this);
        var service = container.data('service');
        console.log('service'+service);

        // service variable now contains the value of $myService->getValue();
    });
    
var images = $.map(items, function(i) { return i.img; });

$("#headerslide").backstretch(images, {duration: 3000, fade: 750});

$(window).on("backstretch.show", function(e, instance) {
  console.log("CCCCCCCCCCCCCCCCCCCC");
  var newCaption = items[instance.index].caption1;
  var newCaption2 = items[instance.index].caption2;
  console.log(( newCaption ));
  $(".caption").text( newCaption );
  $(".caption2").text( newCaption2 );
});

});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


jQuery(function($) {
	var $container = $('#portfolio');
 
	$container.imagesLoaded( function(){
		$container.masonry({
			itemSelector: '.portfolio-item',
                        gutterwidh:0,
			isAnimated: true
			
		});
        });
        $("button").click(function(){
        $(".archivetitle").html(this.name);
        console.log("xxx");
        $(".alla").hide();
        $("."+this.id).show();
        $container.masonry();
    });
});

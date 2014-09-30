/* jQuery(function($){
$("body").on("click", ".dodelete", function(e){
*/

var $d ="";

$j = jQuery.noConflict();
 jQuery(function($){
 /* user clicks button on custom field, runs below code that opens new window */
    $("body").on("click",".upload_image",function(e) {
        $d=$(this).attr("data-rel");
        console.log($d);
         console.log("media upload");
        /*Thickbox function aimed to show the media window. This function accepts three parameters:
         * 
         * Name of the window: "In our case Upload a Image"
         * URL : Executes a WordPress library that handles and validates files.
         * ImageGroup : As we are not going to work with groups of images but just with one that why we set it false.
         */
        
	tb_show('Upload a Image', 'media-upload.php?referer=media_page&type=image&TB_iframe=true&post_id=0', false);
        
        /*var $service = $j('#upload_image').attr('data-service');
        console.log('service'+$service);

	article = document.querySelector('.upload_image'),
        data = article.dataset;
	console.log('service'+data.select);*/
    });

    

    // window.send_to_editor(html) is how WP would normally handle the received data. It will deliver image data in HTML format, so you can put them wherever you want.
	
    window.send_to_editor = function(html) {
        var image_url = $j('img', html).attr('src');
	e = "#".concat($d);
        f = "#img".concat($d);
        $j(e).val(image_url);
        $j(f).attr("src", image_url);
        tb_remove(); // calls the tb_remove() of the Thickbox plugin 
        $j('#submit_button').trigger('click');
    };
});
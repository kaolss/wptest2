$j = jQuery.noConflict();
$j(document).ready(function() {
var article;
 /* user clicks button on custom field, runs below code that opens new window */
    $j('#upload_image').click(function() {
        
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
	console.log('send to editor service');//+data.select+image_url);
        //x="#"+data.select;
        //console.log(x);
        //$j(x).val(image_url);
        $j("#image_path").val(image_url);
        tb_remove(); // calls the tb_remove() of the Thickbox plugin 
        $j('#submit_button').trigger('click');
    }

});
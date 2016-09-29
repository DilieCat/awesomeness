jQuery(document).ready(function() {

	

    jQuery(".tabs-menu a").click(function(event) {
        event.preventDefault();
        jQuery(this).parent().addClass("current");
        jQuery(this).parent().siblings().removeClass("current");
        var tab = jQuery(this).attr("href");
        jQuery(".tab-content").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
    });

	jQuery(".custom-upload").bind("click", function() {
        jQuery("#imageInput").trigger("click");
		console.log("upload");

    });

	jQuery("a.custom-vorige").hide();
	jQuery("a.custom-volgende").hide();
	jQuery("a.custom-upload-bottom").hide();
	jQuery("a.custom-cart-bottom").hide();
	jQuery(".postid-2144 .single_add_to_cart_button").hide();
	
	
	
	
    jQuery("a.custom-volgende").click(function(event) {
        if (!jQuery(this).hasClass('disabled')) {
            var current_tab = jQuery(".tabs-menu li.current a").attr('href');
            var current_tab_id = parseInt(current_tab.substr(current_tab.length - 1)) + 1;
			console.log(current_tab_id);
            jQuery(".tabs-menu a[href='#tab-" + current_tab_id + "']").trigger("click");
			jQuery("a.custom-vorige").show();
			jQuery("a.custom-volgende").hide();
			jQuery("a.custom-upload-bottom").hide();
			jQuery(".postid-2144 .single_add_to_cart_button").show();
			
        }
        return false;
    });

    jQuery("a.custom-vorige").click(function(event) {
        if (!jQuery(this).hasClass('disabled')) {
            var current_tab = jQuery(".tabs-menu li.current a").attr('href');
            var current_tab_id = parseInt(current_tab.substr(current_tab.length - 1)) - 1;
            console.log(current_tab_id);
			jQuery(".tabs-menu a[href='#tab-" + current_tab_id + "']").trigger("click");
			jQuery("a.custom-volgende").show();
			jQuery("a.custom-upload-bottom").show();
			jQuery(".postid-2144 .single_add_to_cart_button").hide();
			
        }
        return false;
    });
	
	
	jQuery(".afreken").click(function(e){
		if (jQuery(this).hasClass('disabled')) {
 			e.preventDefault();
		}
		jQuery(".canvas_content form.cart").submit(); // fix for outside form buttons
	});


    jQuery("select.input_default_type").bind("keyup keydown change select", function() {
        jQuery("select.input_default").trigger("change");

    });
	
	
	
	jQuery("select.effectOpties").bind("change select", function() {
      
	  	var currentCleanImage = jQuery("#upload_image").val();
		
		
		var selectedFilter = jQuery( "select.effectOpties option:selected" ).val();
		
		jQuery(".image_container img").data('filter', selectedFilter);
		jQuery(".image_container img").attr("src", currentCleanImage);
		jQuery('.filter').filterMe();
		
		console.log(selectedFilter);

    });


	jQuery("select.afmetingen").bind("keyup keydown change select", function() {
	
	var currentVerhouding = jQuery( "select.verhouding option:selected" ).val().toLowerCase();
	
	var currentMateriaal = jQuery( "select.materiaal option:selected" ).val().toLowerCase();
	var selectedSize = jQuery( "select.afmetingen."+currentMateriaal+" option:selected" ).val();
	console.log(selectedSize);
	console.log(currentMateriaal);
	
	var arr = selectedSize.split('x');
	
	if (currentVerhouding == "liggend") {
	var canvas_height = arr[1];
	var canvas_width = arr[0];
	}
	else
	{
	var canvas_height = arr[0];
	var canvas_width = arr[1];
	}
	
	 
	jQuery(".canvas_preview").height(canvas_height);
	jQuery(".canvas_preview_y").html(canvas_height + " cm");
	jQuery(".canvas_preview").width(canvas_width);
	jQuery(".canvas_preview_x").html(canvas_width + " cm");
	
	var container_height = canvas_offset; //jQuery(".canvas_preview_container").height();
	var canvas_height_calc = jQuery(".canvas_preview").height();
	var canvas_pos = (container_height) - (canvas_height_calc);
				
                
	jQuery(".canvas_preview_table").css({ 'top': canvas_pos + "px" });

	});
	jQuery("select.verhouding").bind("keyup keydown change select", function() {
	jQuery("select.afmetingen").trigger("change")
	});
	
	var canvas_offset = 240;
    jQuery("select.input_default").bind("keyup keydown change select", function() {

        var canvas_size = jQuery("select.input_default").val();
		
        if (canvas_size != "eigenformaat") {

            var arr = canvas_size.split('x');
            var canvas_type = jQuery("select.input_default_type").val();

            if (canvas_type == "liggend") {
                var canvas_height = arr[0];
                var canvas_width = arr[1];
                jQuery(".canvas_preview").height(canvas_height);
                jQuery(".canvas_preview_y").html(canvas_height + " cm");
                jQuery(".canvas_preview").width(canvas_width);
                jQuery(".canvas_preview_x").html(canvas_width + " cm");
                
				var container_height = canvas_offset; //jQuery(".canvas_preview_container").height();
				var canvas_height_calc = jQuery(".canvas_preview").height();
				var canvas_pos = (container_height) - (canvas_height_calc);
				
                
				jQuery(".canvas_preview_table").css({ 'top': canvas_pos + "px" });
				jQuery("select.input_lengte").val( arr[0] );
				jQuery("select.input_breedte").val( arr[1] );

                jQuery('.formule_1 .formule_waarde').text(canvas_width + "cm x " + canvas_height + "cm");
                jQuery('.canvas_waarde_1 .waarde').text(canvas_height + "cm x " + canvas_width + "cm");
                jQuery('.canvas_waarde_1 .wijzig').show();
                update_canvas_attr();

                jQuery(".canvas_size_select").hide();
                jQuery(".canvas_type").show();
            } else {
                var canvas_height = arr[1];
                var canvas_width = arr[0];
                jQuery(".canvas_preview").height(canvas_height);
                jQuery(".canvas_preview_y").html(canvas_height + " cm");
                jQuery(".canvas_preview").width(canvas_width);
                jQuery(".canvas_preview_x").html(canvas_width + " cm");
                
				var container_height = canvas_offset; //jQuery(".canvas_preview_container").height();
				var canvas_height_calc = jQuery(".canvas_preview").height();
				var canvas_pos = (container_height) - ( canvas_height_calc);
						
                
				jQuery(".canvas_preview_table").css({'top': canvas_pos + "px"});
				jQuery("select.input_lengte").val( arr[1] );
				jQuery("select.input_breedte").val( arr[0] );
				

                jQuery('.formule_1 .formule_waarde').text(canvas_width + "cm x " + canvas_height + "cm");
                jQuery('.canvas_waarde_1 .waarde').text(canvas_height + "cm x " + canvas_width + "cm");
                jQuery('.canvas_waarde_1 .wijzig').show();
                update_canvas_attr();

                jQuery(".canvas_size_select").hide();
                jQuery(".canvas_type").show();
            }
        } else {
            jQuery(".canvas_size_select").show();
            jQuery(".canvas_type").hide();
            jQuery("select.input_lengte").trigger("change");
            jQuery("select.input_breedte").trigger("change");
        }
    });

  

  
	jQuery("input#imageInput").change(function (){
		   jQuery("#submit-btn").trigger("click");
		 });

    var progressbox = jQuery('#progressbox');
    var progressbar = jQuery('#progressbar');
    var statustxt = jQuery('#statustxt');
    var completed = '0%';

    var options = {
        target: '#output', // target element(s) to be updated with server response 
        beforeSubmit: beforeSubmit, // pre-submit callback 
        uploadProgress: OnProgress,
        success: afterSuccess, // post-submit callback 
        resetForm: true // reset the form after successful submit 
    };

    jQuery('#MyUploadForm').submit(function() {
        jQuery(this).ajaxSubmit(options);
        // return false to prevent standard browser submit and page navigation 
        return false;
    });

    //when upload progresses	
    function OnProgress(event, position, total, percentComplete) {
        //Progress bar
        progressbar.width(percentComplete + '%') //update progressbar percent complete
        statustxt.html(percentComplete + '%'); //update status text
        if (percentComplete > 50) {
            statustxt.css('color', '#fff'); //change status text to white after 50%
        }
    }

    //after succesful upload
    function afterSuccess() {
        //jQuery('#submit-btn').show(); //hide submit button
        jQuery('#loading-img').hide(); //hide submit button
		jQuery("a.custom-volgende").show();
		jQuery("a.custom-upload-bottom").show();
	
	
		jQuery('#progressbox').hide();

		
    }

    //function to check file size before uploading.
    function beforeSubmit() {
        //check whether browser fully supports all File API
        if (window.File && window.FileReader && window.FileList && window.Blob) {

            if (!jQuery('#imageInput').val()) //check empty input filed
            {
                jQuery("#output").html("Geen foto geselecteerd");
                return false
            }

            var fsize = parseInt(jQuery('#imageInput')[0].files[0].size); //get file size
            var ftype = jQuery('#imageInput')[0].files[0].type; // get file type

            //allow only valid image file types 
            switch (ftype) {
                case 'image/png':
                case 'image/gif':
                case 'image/jpeg':
                case 'image/pjpeg':
                    break;
                default:
                    jQuery("#output").html("<b>" + ftype + "</b> Filetype niet ondersteund!");
                    return false
            }
			
			
			if ( fsize < 250000 ) {
				
                jQuery(".image_upload_warning").html("<b>" + bytesToSize(fsize) + "</b> Afbeelding is te klein!");
            }
			else
			{
				jQuery(".image_upload_warning").html(" ");
			}
            //Allowed file size is less than 1 MB (1048576)
            if (fsize > 20485760) {
                jQuery("#output").html("<b>" + bytesToSize(fsize) + "</b> Afbeelding is te groot!");
                return false
            }
			
            //Progress bar
            progressbox.show(); //show progressbar
            progressbar.width(completed); //initial value 0% of progressbar
            statustxt.html(completed); //set status text
            statustxt.css('color', '#000'); //initial color of status text


            jQuery('#submit-btn').hide(); //hide submit button
            jQuery('#loading-img').show(); //hide submit button
            jQuery("#output").html("");
        } else {
            //Output error to older unsupported browsers that doesn't support HTML5 File API
            jQuery("#output").html("Uw browser ondersteund geen bestanden upload naar onze server, mail aub naar info@canvasfoto.nl");
            return false;
        }
    }

    //function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }
	jQuery('table.price-grid-table').floatThead({
		position: 'fixed',
		zIndex: 99
	});

});
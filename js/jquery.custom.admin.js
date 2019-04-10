/*-----------------------------------------------------------------------------------
 	Portfolio Edit Page Interactions
-----------------------------------------------------------------------------------*/
 
jQuery(document).ready(function($) {

    jQuery('.colorpicker').wpColorPicker();

/*----------------------------------------------------------------------------------*/
/*  Post Format Custom Fields Hide/Show
/*----------------------------------------------------------------------------------*/

    /*----------------------------------------------------------------------------------*/
    /*  Image Options
    /*----------------------------------------------------------------------------------*/

    var imageOptions = jQuery('#icy-meta-lightbox-box');
    var imageTrigger = jQuery('#post-format-image');
    
    imageOptions.css('display', 'none');

    /*----------------------------------------------------------------------------------*/
    /*  Image Options
    /*----------------------------------------------------------------------------------*/

    var galleryOptions = jQuery('#icy-meta-gallery-box');
    var galleryTrigger = jQuery('#post-format-gallery');
    
    galleryOptions.css('display', 'none');
    
    /*----------------------------------------------------------------------------------*/
    /*  Video Options
    /*----------------------------------------------------------------------------------*/

    var videoOptions = jQuery('#icy-meta-video-box');
    var videoTrigger = jQuery('#post-format-video');
    
    videoOptions.css('display', 'none');

    /*----------------------------------------------------------------------------------*/
    /*  The Brain
    /*----------------------------------------------------------------------------------*/

    var group = jQuery('#post-formats-select input');

    
    group.change( function() {
        
        if(jQuery(this).val() == 'video') {
            videoOptions.css('display', 'block');
            icyHideAll(videoOptions);
            
        } else if(jQuery(this).val() == 'image') {
            imageOptions.css('display', 'block');
            icyHideAll(imageOptions);
                    
        } else if(jQuery(this).val() == 'gallery') {
            galleryOptions.css('display', 'block');
            icyHideAll(galleryOptions);
            
        } else {
            videoOptions.css('display', 'none');
            galleryOptions.css('display', 'none');
            imageOptions.css('display', 'none');
        }
        
    });    
        
    if(videoTrigger.is(':checked'))
        videoOptions.css('display', 'block');
        
    if(imageTrigger.is(':checked'))
        imageOptions.css('display', 'block');

    if(galleryTrigger.is(':checked'))
        galleryOptions.css('display', 'block');
        
    function icyHideAll(notThisOne) {
        videoOptions.css('display', 'none');
        galleryOptions.css('display', 'none');                        
        imageOptions.css('display', 'none');
        notThisOne.css('display', 'block');
    }

});
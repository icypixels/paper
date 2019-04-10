/*-----------------------------------------------------------------------------------*/
/*  jquery.custom.js
/*  This file contains all the required custom code for the theme to function properly.
/*  Can be easily tweaked by the end user to adjust things to their liking.
/*-----------------------------------------------------------------------------------*/ 

/*-----------------------------------------------------------------------------------*/
/*  Global Variables
/*-----------------------------------------------------------------------------------*/ 
if ( !icyGlobal ) {
    var icyGlobal = {}; // Global storage
    var icyViewHeight = 0;;
}

if ( !icyGlobal.isMobile ) {
    icyGlobal.isMobile  = (/(Android|BlackBerry|iPhone|iPod|iPad|Palm|Symbian)/.test(navigator.userAgent));
    if (icyGlobal.isMobile) {
        jQuery('body').addClass('is-mobile');
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Mobile Menu Function Triggers
/*-----------------------------------------------------------------------------------*/ 
function icy_menu_trigger() {
    jQuery('.icy-menu-trigger').click(function(e) {        
        jQuery('#icy-nav').stop().slideToggle(500);        
        e.preventDefault();
    });
}

function icy_mobilenav() {          
    icy_menu_trigger();         
}

function icy_get_current_viewport_height() {
    icyViewHeight = jQuery(window).height();
}

function icy_viewport_find() {

    setTimeout(function() {
        var viewportWidth = jQuery(window).width();
        if (viewportWidth < 1101) {
            if (jQuery('body').hasClass('icy-right-visible'))
            {
                jQuery('body').removeClass('icy-right-visible');
                jQuery('body').addClass('icy-right-visible-off');
            }
        } else {
            if (jQuery('body').hasClass('icy-right-visible-off'))
            {
                jQuery('body').Class('icy-right-visible');
                jQuery('body').addClass('icy-right-visible-off');
            }
        }
    }, 0); 

}

/*-----------------------------------------------------------------------------------*/
/*  Document Ready Code
/*-----------------------------------------------------------------------------------*/ 
jQuery(document).ready(function($) {

    "use strict";

    jQuery('html').addClass('js-ready');
    /*-----------------------------------------------------------------------------------*/
    /*  Navigation
    /*-----------------------------------------------------------------------------------*/ 
    jQuery("nav#primary-nav ul").supersubs({
            minWidth:    13,            
            maxWidth:    35,   // maximum width of sub-menus in em units
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over
                               // due to slight rounding differences and font-family
            }).superfish({
                delay: 0,
                animation:     {height:'show'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method. Used to animate the sub-menu open
                animationOut:  {height:'hide', opacity: 'hide'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method Used to animate the sub-menu closed
                speed:         'normal',           // speed of the opening animation. Equivalent to second parameter of jQueryâ€™s .animate() method
                speedOut:      0, 
                autoArrows: false
    });

    jQuery('#icy-nav ul').superfish({
                delay: 100,
                animation:     {height:'show'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method. Used to animate the sub-menu open
                animationOut:  {height:'hide'},   // an object equivalent to first parameter of jQueryâ€™s .animate() method Used to animate the sub-menu closed
                speed:         'normal',           // speed of the opening animation. Equivalent to second parameter of jQueryâ€™s .animate() method
                speedOut:      'fast', 
                autoArrows: false
    });


    /*-----------------------------------------------------------------------------------*/
    /*  FitVids
    /*---------------------------------------------------------------------------------- */

    jQuery('.icy_video,.fitVids').fitVids();

    /*-----------------------------------------------------------------------------------*/
    /*  View.js
    /*---------------------------------------------------------------------------------- */

    if (jQuery('.gallery-images').length) {
        new View( jQuery('.gallery-images a[href], .gallery-item a[href]') );        
    }  

    /*-----------------------------------------------------------------------------------*/
    /*  Mobile Menu Start
    /*---------------------------------------------------------------------------------- */

    icy_mobilenav();
    icy_get_current_viewport_height();
    // jQuery('.right-side, .left-side').css({
    //     'min-height': icyViewHeight + 'px',
    //     'max-height': icyViewHeight + 'px'
    // });

    jQuery('.menu-container button').click(function() {
        if (jQuery(this).hasClass('close')) {
            jQuery(this).removeClass('close');
            jQuery('body').toggleClass( "menu-opened");            
            jQuery('.sidebar').css({'z-index': '0'});
        } else {
            jQuery(this).addClass('close');
            jQuery('body').toggleClass( "menu-opened");
            setTimeout(function() {
                jQuery('.sidebar').css({'z-index': '9'});
            }, 500); 
        }
    });

    icy_viewport_find();

});

jQuery(window).resize(function() {
    icy_viewport_find();
});


/*-----------------------------------------------------------------------------------*/
/*  Window Load Code
/*-----------------------------------------------------------------------------------*/ 
jQuery(window).load(function($){

    jQuery('.sidebar').addClass('loaded');

    jQuery('.left-side .featured-content img').addClass('fadeIn animated');

    var widthView = jQuery(window).width();



    if (jQuery.flexslider) {
        /*-----------------------------------------------------------------------------------*/
        /*  Slider
        /*-----------------------------------------------------------------------------------*/ 
        jQuery(".flexslider").flexslider({ 
            animation: 'fade',            
            slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
            animationSpeed: 700,            //Integer: Set the speed of animations, in milliseconds                     
            animationLoop: true, 
            slideshow: true,               // Set to true to autostart slideshow.
            controlNav: false,
            directionNav: true,
            smoothHeight: true,        
            useCSS: true,  
            
        });
    }   
});

function icy_load_menu() {
    jQuery('.menu-container button').click(function() {
        if (jQuery(this).hasClass('close')) {
            jQuery(this).removeClass('close');
            jQuery('body').toggleClass( "menu-opened");
        } else {
            jQuery(this).addClass('close');
            jQuery('body').toggleClass( "menu-opened");
        }
    });
}
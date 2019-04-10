<?php

/**
 * Collection of theme functions which enable us to set various things in the theme, like favicons, custom CSS, lightboxes, etc.
 *
 * @package     Icy Framework
 * @copyright   Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author      Paul Roman
 *
 * @since       Icy Framework 1.0
 */

/**
 * Output Custom CSS
 *
 * @return  string   $output    Outputs the string of Custom CSS defined in theme customizer
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 *          
 */

function icy_head_css() {
    global $icy_options;
		$primary = ''; $secondary = ''; $output = '';

        $primary = $icy_options['primary_accent'];
        $css = $icy_options['custom_css']; 

        if ($primary != '') {
            $output .= 'button:hover,input[type="submit"]:hover,input[type="button"],input[type="submit"],.more-link,.search .featured-content .overlay,span.reply-to a:hover { background-color: '.$primary.'; }';
            $output .= '.more-link:hover,input[type="button"]:hover,input[type="submit"]:hover,a:hover,nav#primary-nav ul > li:hover a:hover,.navigation-posts a:hover, .navigation-posts a:hover .fa,blockquote { color: '.$primary.'; }';
            $output .= 'input:focus,textarea:focus,input[type="button"],input[type="submit"],.more-link,.more-link:hover,input[type="button"]:hover,input[type="submit"]:hover,blockquote { border-color: '.$primary.'; }';
        }

        if ($css != '') {
            $output .= $css;
        }

        if ($output <> '') {
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
}
add_action('wp_head', 'icy_head_css');

function icy_insert_image_src_rel_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
    if(has_post_thumbnail( $post->ID )) {     
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail-blog' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }    
}
add_action( 'wp_head', 'icy_insert_image_src_rel_in_head', 5 );


/**
 * Body Class
 *
 * @return  array   $classes    adds different classnames to the <body>
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer   
 */

if ( !function_exists( 'icy_body_class' ) ) { 
    function icy_body_class($classes) {       
    global $icy_options;
    
        // $theme_layout = $icy_options['theme_layout'];

        // $classes[] .= $theme_layout;
        $classes[] .= 'icy-pixels';         

        return $classes;
    }
    add_filter('body_class','icy_body_class');
}        
        

/**
 * Favicon
 *
 * @return  string     Outputs the HTML required for the favicon to be displayed
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer   
 */

function icy_graphics() {
    global $icy_options;

    $output = '';
	$favicon = $icy_options['favicon'] ;
    
	if ($favicon != '') {
	   echo '<link rel="shortcut icon" href="' . $favicon . '"/>'."\n";
	}
}
add_action('wp_head', 'icy_graphics');

/*-----------------------------------------------------------------------------------*/
/* Ajax
/*-----------------------------------------------------------------------------------*/

add_action( "wp_ajax_get_ajax_post", "get_ajax_post" );
add_action( "wp_ajax_nopriv_get_ajax_post", "get_ajax_post" );

function get_prev_post_id() {
    global $wp_query;
        
    return 100;
}

function get_ajax_post() {

    if ( !wp_verify_nonce( $_REQUEST['nonce'], "icy-ajax-post" ) ) {
        exit("No naughty business please!");
    }

    global $post;   

    $postID = '';
    $content_post = '';
    $content = '';
    $post = '';
            
    if (isset($_REQUEST['postID'])) { $postID = $_REQUEST['postID']; }
    
    $content_post = get_post( $postID );
    $post_author = $content_post->post_author;
    $nicename = get_the_author_meta('user_nicename', $post_author);
    $content = $content_post->post_content;
    $title = $content_post->post_title;
    $author_id = $content_post->post_author;
    $nicename = get_userdata($author_id)->display_name;    
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]>', $content);
    $date_time = get_the_time('F d, Y', $postID);
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'thumbnail-blog' );
    $thumbnail_url = $thumbnail['0'];
                            
    ob_start();
?>

        

            <section class="left-side">               

                <figure class="featured-content">
                    <img src="<?php echo $thumbnail_url; ?>" alt="" />
                    <div class="overlay"></div>
                </figure>               

                <div class="container">

                    <div class="entry-title"><?php echo $title ?></div>

                    <div class="entry-meta">
                        <div class="meta-info">
                            <span class="information"><?php echo $date_time; ?></span>
                            <span class="meta-separator">&times;</span>
                            <span class="information">
                                <?php                                     
                                    echo $nicename;
                                ?>
                            </span>
                            <span class="meta-separator">&times;</span>
                            <span class="information">
                                <?php 
                                $categories = get_the_category($postID);
                                $separator = ' ';
                                $output = '';
                                if($categories){
                                    foreach($categories as $category) {
                                        $output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
                                    }
                                echo trim($output, $separator);
                                } ?>
                            </span>
                        </div>

                        <!--BEGIN .navigation-->
                        <div class="navigation-posts">

                            <?php

                            global $post; 

                            $currentpostID = $postID;

                            $postlist = get_posts();
                            $posts = array();
                            foreach ( $postlist as $post ) {
                               $posts[] += $post->ID;
                            }

                            $current = array_search( $currentpostID, $posts );                            
                            $next_id = $posts[$current-1];
                            $prev_id = $posts[$current+1];  
                            $prev_link = get_permalink( $prev_id );                            
                            $next_link = get_permalink( $next_id );

                            $nonce = wp_create_nonce( 'icy-ajax-post' );                                    
                            ?>                          
                        
                            <?php 
                                if (($prev_id != '') && ($prev_id != $currentpostID)) { ?>  
                                    <div class="nav-prev">
                                        <a href="<?php echo $prev_link; ?>" data-nonce="<?php echo $nonce; ?>" data-postID="<?php echo $prev_id; ?>" data-pagetitle="<?php echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); ?>" title="<?php echo get_the_title( $prev_id ); ?>">
                                            <i class="fa fa-chevron-left"></i><?php _e('Older', 'framework'); ?>
                                        </a>
                                    </div>
                            <?php }                         
                                if (($next_id != '') && ($next_id != $currentpostID)) {
                                    if (($prev_id != '') && ($prev_id != $currentpostID)) { ?> <span class="meta-separator">&times;</span><?php } ?>
                                    <div class="nav-next">
                                        <a href="<?php echo $next_link; ?>" data-nonce="<?php echo $nonce; ?>" data-postID="<?php echo $next_id; ?>" data-pagetitle="<?php echo " - "; bloginfo('name'); echo " - "; bloginfo('description'); ?>" title="<?php echo get_the_title( $next_id ); ?>">
                                            <?php _e('Newer', 'framework'); ?><i class="fa fa-chevron-right"></i>
                                        </a>
                                    </div>
                            <?php } ?>
                             
                            
                        <!--END .navigation-->
                        </div>
                    </div>

                </div><!--END .container -->

            </section> 


            <section class="right-side content" role="main">   

                <div class="menu-container">
                    <button type="button" role="button" aria-label="Toggle Navigation" class="menu-button lines-button x">
                        <span class="lines"></span>
                    </button>   
                </div> 

                <div class="container">
                    <article class="post-content">                
                        <?php echo $content ?>
                    </article>      
                </div>

            </section>        



<?php
    $result['html'] = ob_get_clean();

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    }
    else {
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }

    die();
}

/**
 * Event Single Tweak
 *
 * @return  string     Outputs the HTML required for the favicon to be displayed
 * @uses    The Modern Tribe "The Events Calendar" plugin
 */


function icy_event_single() {
        $event_id = get_the_ID();
        $skeleton_mode = apply_filters( 'tribe_events_single_event_the_meta_skeleton', false, $event_id ) ;
        $group_venue = apply_filters( 'tribe_events_single_event_the_meta_group_venue', false, $event_id );
        $html = '';

        if ( $skeleton_mode ) {

            // show all visible meta_groups in skeleton view
            $html .= tribe_get_the_event_meta();

        } else {
            if (tribe_embed_google_map( $event_id )) {
                $venue_details = tribe_get_meta( 'tribe_venue_map' );
                if ( !empty($venue_details) ) {
                    $html .= apply_filters( 'tribe_events_single_event_the_meta_venue_row', sprintf( '%s',
                        $venue_details
                    ) );
                }
            }

            $html .= '<div class="tribe-events-single-section tribe-events-event-meta tribe-clearfix">';
            // Event Details
            $html .= tribe_get_meta_group( 'tribe_event_details' );

            // When there is no map show the venue info up top
            if ( ! $group_venue && ! tribe_embed_google_map( $event_id ) ) {
                // Venue Details
                $html .= tribe_get_meta_group( 'tribe_event_venue' );
                $group_venue = false;
            } else if ( ! $group_venue && ! tribe_has_organizer( $event_id ) && tribe_address_exists( $event_id ) && tribe_embed_google_map( $event_id ) ) {
                $html .= sprintf( '%s<div class="tribe-events-meta-group tribe-events-meta-group-gmap">%s</div>',
                    tribe_get_meta_group( 'tribe_event_venue' )
                    //tribe_get_meta( 'tribe_venue_map' )
                );
                $group_venue = false;
            } else {
                $group_venue = true;
            }

            // Organizer Details
            if ( tribe_has_organizer( $event_id ) ) {
                $html .= tribe_get_meta_group( 'tribe_event_organizer' );
            }

            $html .= apply_filters( 'tribe_events_single_event_the_meta_addon', '', $event_id );

                if ( ! $skeleton_mode && $group_venue ) {
                    // If there's a venue map and custom fields or organizer, show venue details in this seperate section
                    $venue_details = tribe_get_meta_group( 'tribe_event_venue' );
                                     //tribe_get_meta( 'tribe_venue_map' );

                    if ( !empty($venue_details) ) {
                        $html .= apply_filters( 'tribe_events_single_event_the_meta_venue_row', sprintf( '%s',
                            $venue_details
                        ) );
                    }
                }

            $html .= '</div>';

        }

        return $html;
}
add_filter('tribe_events_single_event_meta', 'icy_graphics');


/**
 * Icy Gallery - Slideshow using the FlexSlider jquery library
 *
 * @return  string    Outputs HTML for the gallery slideshow
 * @uses    rwmb_meta();  Function to retrieve custom meta box information
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 */
if ( !function_exists( 'icy_gallery' ) ) {
    function icy_gallery($postid, $imagesize) {
    
        if (function_exists('rwmb_meta'))
        {

            $args = array();
            $caption = '';
            $url = '';
            $caption = '';
            $height = '';
            $width = '';
            $alt = '';
            $images_array = '';

            $args = array(
                'type' => 'plupload_image',
                'size' => $imagesize,
            );
            $images_array = rwmb_meta( '_icy_gallery_images', $args, $postid );
 
            if( !empty($images_array) && function_exists('rwmb_meta') ) {               
                echo "<!-- BEGIN #slider -->\n<div class='flexslider loading'>"; 
                echo '<ul class="slides">';
                $i = 0;

                foreach ($images_array as $image) {
                    $url = $image['url'];
                    $caption = $image['caption'];
                    $width = $image['width'];
                    $height = $image['height'];
                    $alt = $image['title'];

                    echo "<li><img height='".$height."' width='".$width."' src='".$url."' alt='".$alt."' />";
                        if ($caption != '') echo "<div class='flex-caption'><h2 class='caption-title'>" .$caption . "</h2></div>";
                    echo "</li>";
                }

                echo '</ul>';
                echo "<!-- END #slider -->\n</div>";
        
        
            }            
        
        }        
        
    }
}

/**
 * Icy Lightbox - lightweight lightbox system using the View.js jquery library http://finegoodsmarket.com/view/
 *
 * @return  string    Outputs HTML for the lightbox gallery
 * @uses    rwmb_meta();  Function to retrieve custom meta box information
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 */

if ( !function_exists( 'icy_lightbox' ) ) {
    function icy_lightbox($postid, $imagesize) {
        if (function_exists('rwmb_meta'))
        {

            $args = array();
            $caption = '';
            $url = '';
            $caption = '';
            $height = '';
            $width = '';
            $alt = '';
            $images_array = '';

            $args = array(
                'type' => 'plupload_image',
                'size' => $imagesize,
            );
            $images_array = rwmb_meta( '_icy_lightbox_images', $args, $postid );
            $images_size = rwmb_meta( '_icy_lightbox_columns', '', $postid);
 
            if( !empty($images_array) && function_exists('rwmb_meta') ) {

                

                echo "<!-- BEGIN .lightbox-gallery -->\n<div class='lightbox-gallery'>"; 
                echo '<ul class="gallery-images">';
                $i = 0;
                $id = rand(1,100);                

                foreach ($images_array as $image) {
                    $url = $image['url'];
                    $caption = $image['caption'];
                    $width = $image['width'];
                    $height = $image['height'];
                    $alt = $image['title'];                    

                    echo "<li class='".$images_size."'><a href='".$url."' rel='gallery_".$id."' title='".$caption."' class='view'>";
                        echo "<img height='".$height."' width='".$width."' src='".$url."' alt='".$alt."' />";                        
                    echo "</a></li>";

                    $i++;
                }

                echo '</ul>';
                echo "<!-- END .lightbox-gallery -->\n</div>";
            }

        }               

    }
}

/**
 * Icy WPML Language Switcher - Custom switcher in the header.php file
 *
 * @return  string    Outputs HTML for language switcher
 * @uses    icl_get_languages();    Returns an array with languages http://wpml.org/documentation/getting-started-guide/language-setup/custom-language-switcher/
 * @uses    icl_disp_language();    The icl_disp_language() function is created by WPML. What it does is check if the two arguments (native_language_name, translated_language_name) are different. If so, it returns them both, otherwise, it returns them just once.
 */

if (!function_exists('languages_list_footer') && function_exists('icl_get_languages')) {
    function languages_list_footer() {

        $languages = icl_get_languages('skip_missing=0&orderby=code');
        
        if(!empty($languages)){
        
            echo '<div class="header_language_list">';
            
            echo '<ul>';
        
            foreach($languages as $lang){                
    
                echo '<li>'; 
                    if($lang['active']) {
                        echo '<span class="active-language">';
                            echo $lang['language_code'];
                        echo '</span>';
                    } else {
                        echo '<a href="'.$lang['url'].'">';
                            echo $lang['language_code'];
                        echo '</a>';
                    }

                echo '</li>';

            }
        
            echo '</ul>';

            echo '</div>';

            
        }
    }
}

/**
 * Add custom JS to admin screen
 *
 * @return  array
 * @uses    wp_enqueue_Script();
 */



function portfolio_admin_style( $hook_suffix ) {   
    wp_enqueue_style( 'wp-color-picker' );        
    wp_enqueue_script( 'custom-admin', get_stylesheet_directory_uri() . '/js/jquery.custom.admin.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'portfolio_admin_style', 11 );


?>
<?php

/**
 * File: functions.php
 *
 *	Description: Here are a set of custom functions used for this theme framework.
 *	Please be extremely careful when you are editing this file, because when things
 *	tend to go bad, they go bad big time. Well, you have been warned ! :-)
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman
 *
 * @since		Icy Framework 1.0
 */

/**
 * Registering WP3.0+ Custom Menu 
 *
 * @return  void
 * @uses	init(); action
 */

function icy_register_menu() {
	register_nav_menu('main-menu', __('Main Menu', 'framework'));	
}
add_action('init', 'icy_register_menu');


/**
 * Loading Theme Translation
 *
 * @return  void
 * @uses	load_theme_textdomain();
 */

load_theme_textdomain('framework');

/**
 * Registering Sidebars
 *
 * @return  void
 * @uses	register_sidebars();
 */

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Main Sidebar',
		'id'   => 'sidebar-1',
		'description' => 'Displays on the blog page and besides the posts.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}


/**
 * Configuring WP 2.9+ thumbnail support and adds theme support for post formats
 *
 * @return  void
 * @uses	add_theme_support();
 * @uses	set_post_thumbnail_size();
 * @uses 	add_image_size();
 */

if ( function_exists('add_theme_support')) {
	add_theme_support( 'post-formats', array(			
			'gallery',			
			) 
	);		
	add_theme_support( 'post-thumbnails' ); //Adding theme support for post thumbnails
	add_theme_support( 'automatic-feed-links' ); //Adding support for automatic feed links	
	set_post_thumbnail_size( 300, 300, true );

	add_image_size('thumbnail-blog', 1000, 1000, false);	
	add_image_size('slider-image', 765, 9999, false);		
}

/**
 * Custom Excerpt Length
 *
 * @return  int
 * @uses 	filter 	excerpt_length(); 
 */

if ( !function_exists('icy_custom_excerpt_length') ) {
	function icy_custom_excerpt_length( $length ) {
		return 20;
	}
}
add_filter('excerpt_length', 'icy_custom_excerpt_length');


/**
 * Custom Excerpt String Text
 *
 * @return  string
 * @uses 	filter 	wp_trim_excerpt(); 
 */

if ( !function_exists('icy_excerpt') ) {
	function icy_excerpt( $more ) {
		return '...';
	}
}
add_filter('excerpt_more', 'icy_excerpt');


/**
 * Separated pings list
 *
 */

function icy_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

<?php }

/*--------------------------------------------------------------------------------------------------
	Altering the main query
--------------------------------------------------------------------------------------------------*/

function hwl_home_pagesize( $query ) {    
	if (is_admin())
		return;
    if ( $query->is_main_query() && $query->is_home() ) {
        // Display only 1 post for the original blog archive

        $query->set( 'posts_per_page', 1 );
        return;
    }
}
add_action( 'pre_get_posts', 'hwl_home_pagesize', 1 );


/**
 * Custom Login Logo. In order to modify the custom login logo, go to the theme folder and modify the custom-login-logo.png file.
 *
 * @return  void
 * @var 	int 	$content_width 
 */

if( ! isset( $content_width ) ) $content_width = 745;


/**
 * Custom caption function
 *
 * @var 	int 	$thumb_id
 * @return  void
 * @uses    get_posts();
 * @uses    get_post_thumbnail_id();
 */
if ( !function_exists('the_post_thumbnail_caption') ) {
	function the_post_thumbnail_caption() {
	  global $post;

	  $thumb_id = get_post_thumbnail_id($post->id);

	  $args = array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => $post->ID,
		'include'  => $thumb_id
		); 

	   $thumbnail_image = get_posts($args);

	   if ($thumbnail_image && isset($thumbnail_image[0])) {
	     //show thumbnail title
	     //echo $thumbnail_image[0]->post_title; 

	     //Uncomment to show the thumbnail caption
	     echo '<div class="icy_caption"><h3>'.$thumbnail_image[0]->post_excerpt.'</h3></div>';

	     //Uncomment to show the thumbnail description
	     //echo $thumbnail_image[0]->post_content; 

	     //Uncomment to show the thumbnail alt field
	     //$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	     //if(count($alt)) echo $alt;
	  }
	}
}

/**
 * Registering the custom javascript files
 *
 * @uses 	wp_register_script();
 * @uses    rwmb_meta();  Function to retrieve custom meta box information
 * @uses    thsp_cbp_get_options_values(); defined in customizer/helpers.php to retrieve values from the customizer
 * @uses 	is_singular();
 * @uses 	is_archive();
 *
 * @return  void
 */
function icy_register_js() {
	if (!is_admin()) {

		global $icy_options;		

		// Registering Javascripts							
		wp_register_script('modernizr', 	get_template_directory_uri() . '/js/modernizr.js', 'jquery', '2.6.2', TRUE);		
		wp_register_script('superfish',     get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', TRUE);												
		wp_register_script('icy_scripts', 	get_template_directory_uri() . '/js/jquery.icyscripts.min.js', 'jquery', '1.0', TRUE);
		wp_register_script('icy_scrollbar', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.min.js', 'jquery', '1.0', TRUE);
		wp_register_script('icy_custom',    get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'icy_scripts'), '1.0', TRUE);						

		// Enqueueing Javascripts
		wp_enqueue_script( 'jquery' );		
		wp_enqueue_script( 'modernizr' );		
		wp_enqueue_script( 'superfish' );									
		wp_enqueue_script( 'icy_scripts' );
		wp_enqueue_script( 'icy_scrollbar' );
		wp_enqueue_script( 'icy_custom' );	

		// Loading conditional scripts
		if(is_singular()) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 	
		if(is_archive()) wp_enqueue_script('icy_custom');
	}
}
add_action('wp_enqueue_scripts', 'icy_register_js');

/**
 * Registering Google Fonts
 *
 * @var 	$protocol
 * @uses 	wp_enqueue_style();
 *
 * @return  void
 */
function icy_google_fonts() {
  		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'icy-google-font', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400|Merriweather:400,700,300,900' rel='stylesheet' type='text/css" );

}

add_action( 'wp_enqueue_scripts', 'icy_google_fonts' );


/**
 * Registering and Enqueuing the CSS files
 *
 * @uses 	wp_register_style(); 	- Used to register .css files
 * @uses 	wp_enqueue_style(); 	- Used to enqueue .css files
 *
 * @return  void
 */
function icy_enqueue_stylesheets() {    	
		//Registering Stylesheets
    	wp_register_style('style_css',			get_template_directory_uri() . '/style.css');
    	//wp_register_style('pagenavi',			get_template_directory_uri() . '/css/pagenavi-css.css');
    	wp_register_style('flexslider_css',		get_template_directory_uri() . '/css/flexslider.css');    	
    	wp_register_style('fontawesome',		get_template_directory_uri() . '/css/font-awesome.min.css');

    	//Enqueue Stylesheets
		wp_enqueue_style('style_css');		
		wp_enqueue_style('fontawesome');

		if (is_home() || is_single() || is_archive() || is_front_page()) {
			wp_enqueue_style('pagenavi');
			wp_enqueue_style('flexslider_css');
		}	    	

    	if ( is_child_theme() && 'paper' == get_template() ) { 
 	        wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'style_css' ), '1.0'); 
 	    } 
}
add_action('wp_enqueue_scripts', 'icy_enqueue_stylesheets');

/**
 * Adding Browser Detection Class
 *
 * @return  array 	$classes
 */
if ( !function_exists( 'icy_browser_body_class' ) ) {
    function icy_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';
	
		if($is_iphone) $classes[] = 'iphone';
		return $classes;
    }
    
    add_filter('body_class','icy_browser_body_class');
}


/**
 * Custom Comment Styling
 *
 * @return  string 	$output
 */

function icy_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<!--BEGIN .comment -->
    	<div id="comment-<?php comment_ID(); ?>" class="comment-content commentary-no-<?php comment_ID(); ?> <?php if($isByAuthor == true) : ?>bypostauthor<?php endif; ?>">
    		
			<figure class="author-avatar">
    			<?php echo get_avatar($comment,$size='64'); ?>        		
	        </figure>    			
		
			<div class="commentary-content">
	    		<!--BEGIN .comment-author -->
	    		<div class="comment-author commentary">

	    			<h3 class="author-name"><?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?></h3>
	    			<h6 class="comment-date"><?php printf(__('%1$s @ %2$s', 'framework'), get_comment_date('d/m/y'),  get_comment_time()) ?>&nbsp;<?php edit_comment_link(__('[Edit]', 'framework'),' ',' ') ?></h6>
	    			
	         	<!--END .comment-author -->
	    		</div>    		
		      
		    	<?php if ($comment->comment_approved == '0') : ?>
		        	<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></em>     
		      	<?php endif; ?>			  						

			</div>

			<!--BEGIN .comment-entry -->
      		<div class="comment-entry commentary span12">
    			<?php comment_text() ?>

    			<span class="reply-to"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
      		<!--END .comment-entry -->      		
			</div>
      
		<!--END .comment -->      
    	</div>

<?php
}

/**
 * Filtering which allows shortcodes in text widgets
 *
 * @return  void
 */

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');


/**
 * Remove version number next to each script that is enqueued to minimize redirects
 *
 * @uses 	remove_query_arg();
 * @return  string $src;
 */
function _remove_wp_ver_css_js( $src ) {
    if( strpos( $src, '?ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', '_remove_wp_ver_css_js', 10 );
add_filter( 'script_loader_src', '_remove_wp_ver_css_js', 10 );

/**
 *
 * INCLUDING THE THEME FUNCTIONS, METABOX, REQUIRED PLUGINS, THEME CUSTOMIZER AND AUTO-UPDATE FEATURE
 *
 */

define('ICY_FILEPATH', get_template_directory());
define('ICY_DIRECTORY', get_template_directory_uri());

require_once (ICY_FILEPATH . '/functions/theme-functions.php');
require_once (ICY_FILEPATH . '/functions/theme-metabox.php');
require_once (ICY_FILEPATH . '/functions/theme-require-plugins.php');
require_once (ICY_FILEPATH . '/customizer/customizer.php' );

require_once (ICY_FILEPATH . '/functions/class-pixelentity-theme-update.php');

/**
 * Auto update setup
 *
 * @uses 	PixelentityThemeUpdate::init
 * @return  void;
 */

$theme_options = thsp_cbp_get_options_values();
$user = $theme_options['buyer_username'];
$api = $theme_options['buyer_apikey'];
PixelentityThemeUpdate::init($user,$api, 'Icy Pixels');

?>
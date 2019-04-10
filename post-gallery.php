<?php
/**
 * File: post-gallery.php
 * This file is used to display a gallery slideshow inside a post.
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman
 * @uses 		icy_gallery() 		details here: /functions/theme-functions.php
 *
 * @since		Icy Framework 1.0
 */
?>

<!--BEGIN .post-media -->
<div class="post-media">

    <?php 	
		icy_gallery($post->ID, 'slider-image'); 
    ?>
    
<!--END .post-media -->
</div>



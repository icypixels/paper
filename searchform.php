<?php
/**
 * File: searchform.php
 * This file is used to display the searchform.
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman 
 *
 * @since		Icy Framework 1.0
 */
?>

        <!-- #searchbar -->
        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" class="clearfix" >
            <div>
                <input type="text" name="s" id="s"/><i class="fa fa-search searchform-icon"></i>
            </div>
        </form>
        <!-- /#searchbar-->    
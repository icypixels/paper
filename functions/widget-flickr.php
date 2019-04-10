<?php

/**
 * Custom Flickr Photostream
 * Description: A widget that displays your flickr photos
 *
 * @package		Icy Framework
 * @copyright	Copyright (c) 2013, Paul Roman | Icy Pixels
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Paul Roman
 *
 * @since		Icy Framework 1.0
 */


/**
 * Helper array that holds array of theme options.
 *
 * @var 	array	$icy_options	Array of theme options
 * @uses	thsp_get_theme_customizer_fields()	defined in customizer/helpers.php
 */

global $icy_options;




// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'icy_flickr_widgets' );

// Register widget
function icy_flickr_widgets() {
	register_widget( 'icy_Flickr_Widget' );
}

// Widget class
class icy_flickr_widget extends WP_Widget {


	/**
	 * Widget Setup
	 *
	 * @var 	$widget_ops
	 * @uses	WP_Widget
	 */
		
	function icy_Flickr_Widget() {

		$widget_ops = array(
			'classname' => 'icy_flickr_widget',
			'description' => __('A widget that displays your Flickr photos.', 'framework')
		);

		$this->WP_Widget( 'icy_flickr_widget', __('Custom Flickr Photos', 'framework'), $widget_ops);
		
	}


	/**
	 * Widget Setup
	 *
	 * @var 	$args
	 * @var 	$instance
	 * @uses	WP_Widget
	 * @return 	string - Widget content
	 */
		
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$flickrID = $instance['flickrID'];
		$postcount = $instance['postcount'];
		$type = $instance['type'];
		$display = $instance['display'];

		echo $before_widget;

			if ( $title )
				echo $before_title . $title . $after_title;

			 ?>
				
			<div id="flickr_badge_wrapper" class="clearfix">
			
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $postcount ?>&amp;display=<?php echo $display ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type ?>&amp;<?php echo $type ?>=<?php echo $flickrID ?>"></script>
				
			</div>
		
		<?php

		echo $after_widget;
		
	}


	/**
	 * Update Widget
	 *
	 * @var 	$instance
	 * @uses	WP_Widget
	 */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickrID'] = strip_tags( $new_instance['flickrID'] );
		$instance['postcount'] = $new_instance['postcount'];
		$instance['type'] = $new_instance['type'];
		$instance['display'] = $new_instance['display'];

		return $instance;
	}


	/**
	 * Widget Settings
	 *
	 * @var 	$instance
	 * @var 	$defaults
	 * @uses	WP_Widget
	 */
		 
	function form( $instance ) {

		$defaults = array(
			'title' => 'My Photostream',
			'flickrID' => '613394@N22',
			'postcount' => '8',
			'type' => 'group',
			'display' => 'latest',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'flickrID' ); ?>"><?php _e('Flickr ID:', 'framework') ?> (<a href="http://idgettr.com/">idGettr</a>)</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'flickrID' ); ?>" name="<?php echo $this->get_field_name( 'flickrID' ); ?>" value="<?php echo $instance['flickrID']; ?>" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of Photos:', 'framework') ?></label>
				<select id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" class="widefat">
					<option <?php if ( '4' == $instance['postcount'] ) echo 'selected="selected"'; ?>>4</option>
					<option <?php if ( '6' == $instance['postcount'] ) echo 'selected="selected"'; ?>>6</option>
					<option <?php if ( '8' == $instance['postcount'] ) echo 'selected="selected"'; ?>>8</option>
					<option <?php if ( '9' == $instance['postcount'] ) echo 'selected="selected"'; ?>>9</option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e('Type (user or group):', 'framework') ?></label>
				<select id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat">
					<option <?php if ( 'user' == $instance['type'] ) echo 'selected="selected"'; ?>>user</option>
					<option <?php if ( 'group' == $instance['type'] ) echo 'selected="selected"'; ?>>group</option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'display' ); ?>"><?php _e('Display (random or latest):', 'framework') ?></label>
				<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>" class="widefat">
					<option <?php if ( 'random' == $instance['display'] ) echo 'selected="selected"'; ?>>random</option>
					<option <?php if ( 'latest' == $instance['display'] ) echo 'selected="selected"'; ?>>latest</option>
				</select>
			</p>
			
		<?php
	}
}
?>
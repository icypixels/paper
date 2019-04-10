<?php

/**
 * Custom Video Widget
 *	Description: A widget that displays your latest video
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
add_action( 'widgets_init', 'icy_video_widgets' );
// Register widget
function icy_video_widgets() {
	register_widget( 'icy_Video_Widget' );
}
// Widget class
class icy_video_widget extends WP_Widget {


	/**
	 * Widget Setup
	 *
	 * @var 	$widget_ops
	 * @uses	WP_Widget
	 */
		
	function icy_Video_Widget() {

		$widget_ops = array(
			'classname' => 'icy_video_widget',
			'description' => __('A widget that displays your YouTube or Vimeo Video.', 'framework')
		);

		$control_ops = array(
			'width' => 220,
			'height' => 220,
			'id_base' => 'icy_video_widget'
		);

		$this->WP_Widget( 'icy_video_widget', __('Custom Video Widget', 'framework'), $widget_ops, $control_ops );
		
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
		$embed = $instance['embed'];
		$desc = $instance['desc'];

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		?>
			
			<div class="icy_video">
				<?php echo $embed ?>
			</div>
			
			<?php if($desc != '') { ?><p class="icy_video_desc"><?php echo $desc ?></p><?php } ?>
		
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
		
		$instance['desc'] = stripslashes( $new_instance['desc']);
		$instance['embed'] = stripslashes( $new_instance['embed']);

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
			'title' => 'My Latest Video',
			'embed' => stripslashes( '<iframe src="http://player.vimeo.com/video/7585127?title=0&amp;portrait=0&amp;color=ff9933" width="220" height="220" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>'),
			'desc' => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'embed' ); ?>"><?php _e('Embed Code:', 'framework') ?></label>
			<textarea style="height:200px;" class="widefat" id="<?php echo $this->get_field_id( 'embed' ); ?>" name="<?php echo $this->get_field_name( 'embed' ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['embed'] ), ENT_QUOTES)); ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
		</p>
			
		<?php
	}
}
?>
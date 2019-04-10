<?php 

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
global $meta_boxes;

$meta_boxes = array();

function icy_register_meta_boxes( $meta_boxes )
{

	$prefix = '_icy_';

	$meta_boxes[] = array(	
		'id' => 'icy-meta-gallery-box',
		'title' => __( 'Gallery Settings', 'framework' ),
		'desc' => __('Upload your images to the gallery.', 'framework'),
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(						
			array(
				'name'             => __( 'Select / Upload Photo', 'framework' ),
				'id'               => "{$prefix}gallery_images",
				'type'             => 'image_advanced',			
			),
		),
	);

	$meta_boxes[] = array(	
		'id' => 'icy-meta-post-options-box',
		'title' => __( 'Post Options', 'framework' ),
		'desc' => __('Configure each individual post however you wish.', 'framework'),
		'pages' => array('post'),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => true,
		'fields' => array(						
			
			array(
				'name'     => __( 'Intro styling', 'framework' ),
				'id'       => "icy_intro_styling",
				'type'     => 'select',
			
				'options'  => array(
					'intro-enabled' => __( 'On', 'framework' ),
					'intro-disabled' => __( 'Off', 'framework' ),
				),
			
				'multiple'    => false,
				'std'         => 'intro-disabled',
				'placeholder' => __( 'Select an Item', 'framework' ),
			),
		),
	);


	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'icy_register_meta_boxes' );


?>
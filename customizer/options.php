<?php

/**
 * Get Theme Customizer Fields
 *
 * @package		Theme_Customizer_Boilerplate
 * @copyright	Copyright (c) 2013, Slobodan Manic
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * @author		Slobodan Manic
 *
 * @since		Theme_Customizer_Boilerplate 1.0
 */


/**
 * Helper function that holds array of theme options.
 *
 * @return	array	$options	Array of theme options
 * @uses	thsp_get_theme_customizer_fields()	defined in customizer/helpers.php
 */
function thsp_cbp_get_fields() {

	/*
	 * Using helper function to get default required capability
	 */
	$thsp_cbp_capability = thsp_cbp_capability();
	
	$options = array(

		
		// Section ID
		'icy_theme_logo' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Logo Setup', 'framework' ),
				'description' => __( 'Setup your own logo & favicon for your website.', 'framework' ),
				'priority' => 1
			),
			'fields' => array(
							
				'logo' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 2
					)
				),
				'logo_retina' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Retina', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 3
					)
				),
				'logo_width' => array(
					'setting_args' => array(
						'default' => '167',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Width (px)', 'framework' ),
						'type' => 'text', // Image upload field control
						'priority' => 4
					)
				),
				'logo_height' => array(
					'setting_args' => array(
						'default' => '64',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Logo Height (px)', 'framework' ),
						'type' => 'text', // Image upload field control
						'priority' => 5
					)
				),								
				'favicon' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Favicon', 'framework' ),
						'type' => 'image', // Image upload field control
						'priority' => 6
					)
				),				
			),
			
		),
		// Section ID
		'icy_theme_settings' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Theme Settings', 'framework' ),
				'description' => __( 'Theme settings helping you customize your brand new theme and make it your own.', 'framework' ),
				'priority' => 6
			),
			'fields' => array(											
				// 'theme_layout' => array(
				// 	'setting_args' => array(
				// 		'default' => 'right-aligned',
				// 		'type' => 'option',
				// 		'capability' => $thsp_cbp_capability,
				// 		'transport' => 'refresh',
				// 	),					
				// 	'control_args' => array(
				// 		'label' => __( 'Sidebar Layout', 'framework' ),
				// 		'type' => 'select',
				// 		'choices' => array(
				// 			'icy-right-hidden' => array(
				// 				'label' => __( 'On the Right - Hidden', 'framework' )
				// 			),
				// 			'icy-right-visible' => array(
				// 				'label' => __( 'On the Right - Always Visible', 'framework' )
				// 			),
				// 			'icy-left-hidden' => array(
				// 				'label' => __( 'On the Left - Hidden', 'framework' )
				// 			),
				// 			'icy-left-visible' => array(
				// 				'label' => __( 'On the Left - Always Visible', 'framework' )
				// 			),
				// 			'icy-center-hidden' => array(
				// 				'label' => __( 'In Center - Hidden', 'framework' )
				// 			)
				// 		),					
				// 		'priority' => 1
				// 	)
				// ),
				'custom_css' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Custom CSS', 'framework' ),
						'type' => 'textarea', // Textarea control
						'priority' => 2
					)
				),


			),
			
		),

		'icy_update_settings' => array(
			'existing_section' => false,
			'args' => array(
				'title' => __( 'Auto-Update Settings', 'framework' ),
				'description' => __( 'Easily update your theme with the push of a button.', 'framework' ),
				'priority' => 7
			),
			'fields' => array(				
				'buyer_username' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Buyer Username', 'framework' ),
						'description' => __( 'Please provide a username in order for the auto-update to work.', 'framework'),
						'type' => 'text', 
						'priority' => 1
					)
				),
				'buyer_apikey' => array(
					'setting_args' => array(
						'default' => '',
						'type' => 'option',
						'capability' => $thsp_cbp_capability,
						'transport' => 'refresh',
					),					
					'control_args' => array(
						'label' => __( 'Buyer API key', 'framework' ),
						'description' => __( 'Please provide a API key in order for the auto-update to work.', 'framework'),
						'type' => 'text', 
						'priority' => 2
					)
				),				
			),
			
		),
		
		'colors' => array(
			'existing_section' => true,
			'fields' => array(				
				'primary_accent' => array(
						'setting_args' => array(
							'default' => '#b59a65',
							'type' => 'option',
							'capability' => $thsp_cbp_capability,					
							'transport' => 'refresh',
						),					
						'control_args' => array(
							'label' => __( 'Primary Accent color', 'framework' ),
							'type' => 'color',							
							'priority' => 1
						)
				),																		
			)
		)

	);
	
	/* 
	 * 'thsp_cbp_options_array' filter hook will allow you to 
	 * add/remove some of these options from a child theme
	 */
	return apply_filters( 'thsp_cbp_options_array', $options );
	
}
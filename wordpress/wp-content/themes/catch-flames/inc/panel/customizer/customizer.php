<?php
/**
 * Catch Flames Customizer/Theme Options
 *
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 2.7
 */

/**
 * Implements Catch Flames theme options into Theme Customizer.
 *
 * @param $wp_customize Theme Customizer object
 * @return void
 *
 * @since Catch Flames 2.7
 */
function catchflames_customize_register( $wp_customize ) {
	global $catchflames_options_settings, $catchflames_options_defaults;
    
    $options = $catchflames_options_settings;

	$defaults = $catchflames_options_defaults;

	//Custom Controls
	require get_template_directory() . '/inc/panel/customizer/customizer-custom-controls.php';

	$theme_slug = 'catchflames_';

	$settings_page_tabs = array(
		'theme_options' => array(
			'id' 			=> 'theme_options',
			'title' 		=> __( 'Theme Options', 'catch-flames' ),
			'description' 	=> __( 'Basic theme Options', 'catch-flames' ),
			'sections' 		=> array(
				'favicon' => array(
					'id' 				=> 'favicon',
					'title' 			=> __( 'Favicon', 'catch-flames' ),
					'description' 		=> '',
					'active_callback'	=> 'catchflames_is_site_icon_active',
				),
				'web_clip_icon_options' => array(
					'id' 				=> 'web_clip_icon_options',
					'title' 			=> __( 'Webclip Icon Options', 'catch-flames' ),
					'description' 		=> __( 'Web Clip Icon for Apple devices. Recommended Size - Width 144px and Height 144px height, which will support High Resolution Devices like iPad Retina', 'catch-flames' ),
					'active_callback'	=> 'catchflames_is_site_icon_active',
				),
				'fixed_header_top_options' => array(
					'id' 			=> 'fixed_header_top_options',
					'title' 		=> __( 'Fixed Header Top Options', 'catch-flames' ),
					'description' 		=> __( 'Fixed Header Top Menu : You need to create custom menu and then assign menu location as Featured Header Top Menu. For more go to Menu Option', 'catch-flames' ),
				),
				'header_options' => array(
					'id' 			=> 'header_options',
					'title' 		=> __( 'Header Options', 'catch-flames' ),
					'description' 	=> '',
				),
				'search_text_settings' => array(
					'id' 			=> 'search_text_settings',
					'title' 		=> __( 'Search Options', 'catch-flames' ),
					'description' 	=> '',
				),
				'layout_options' => array(
					'id' 			=> 'layout_options',
					'title' 		=> __( 'Layout Options', 'catch-flames' ),
					'description' 	=> '',
				),				
				'homepage_settings' => array(
					'id' 			=> 'homepage_settings',
					'title' 		=> __( 'Homepage / Frontpage Category Setting', 'catch-flames' ),
					'description' 	=> '',
				),
				'excerpt_more_tag_settings' => array(
					'id' 			=> 'excerpt_more_tag_settings',
					'title' 		=> __( 'Excerpt / More Tag Settings', 'catch-flames' ),
					'description' 	=> '',
				),
				'feed_url' => array(
					'id' 			=> 'feed_url',
					'title' 		=> __( 'Feed Redirect', 'catch-flames' ),
					'description' 	=> '',
				),
				'custom_css' => array(
					'id' 			=> 'custom_css',
					'title' 		=> __( 'Custom CSS', 'catch-flames' ),
					'description' 	=> '',
				),
				'scrollup' => array(
					'id' 			=> 'scrollup',
					'title' 		=> __( 'Scroll Up', 'catch-flames' ),
					'description' 	=> '',
				),
			),
		),
		'featured_slider' => array(
			'id' 			=> 'featured_slider',
			'title' 		=> __( 'Featured Slider', 'catch-flames' ),
			'description' 	=> __( 'Featured Slider', 'catch-flames' ),
			'sections' 		=> array(
				'slider_options' => array(
					'id' 			=> 'slider_options',
					'title' 		=> __( 'Slider Options', 'catch-flames' ),
					'description' 	=> '',
				),
			)
		),

		'social_links' => array(
			'id' 			=> 'social_links',
			'title' 		=> __( 'Social Links', 'catch-flames' ),
			'description' 	=> __( 'Add your social links here', 'catch-flames' ),
			'sections' 		=> array(
				'social_links' => array(
					'id' 			=> 'social_links',
					'title' 		=> __( 'Social Links', 'catch-flames' ),
					'description' 	=> '',
				),
			),
		),
		'tools' => array(
			'id' 			=> 'tools',
			'title' 		=> __( 'Tools', 'catch-flames' ),
			'description' 	=>  sprintf( __( 'Tools falls under Plugins Territory according to Theme Review Guidelines in WordPress.org. This feature will be depreciated in future versions from Catch Flames free version. If you want this feature, then you can add <a target="_blank" href="%s">Catch Web Tools</a>  plugin.', 'catch-flames' ), esc_url( 'https://wordpress.org/plugins/catch-web-tools/' ) ),
			'sections' 		=> array(
				'tools' => array(
					'id' 			=> 'tools',
					'title' 		=> __( 'Tools', 'catch-flames' ),
					'description' 	=>  sprintf( __( 'Tools falls under Plugins Territory according to Theme Review Guidelines in WordPress.org. This feature will be depreciated in future versions from Catch Flames free version. If you want this feature, then you can add <a target="_blank" href="%s">Catch Web Tools</a>  plugin.', 'catch-flames' ), esc_url( 'https://wordpress.org/plugins/catch-web-tools/' ) ),
				),
			),
		),
	);

	//Add Panels and sections
	foreach ( $settings_page_tabs as $panel ) {
		$wp_customize->add_panel(
			$theme_slug . $panel['id'], 
			array(
				'priority' 		=> 200,
				'capability' 	=> 'edit_theme_options',
				'title' 		=> $panel['title'],
				'description' 	=> $panel['description'],
			) 
		);

		// Loop through tabs for sections
		foreach ( $panel['sections'] as $section ) {
			$params = array(
								'title'			=> $section['title'],
								'description'	=> $section['description'],
								'panel'			=> $theme_slug . $panel['id']
							);

			if ( isset( $section['active_callback'] ) ) {
				$params['active_callback'] = $section['active_callback'];
			}

			$wp_customize->add_section(
				// $id
				$theme_slug . $section['id'],
				// parameters
				$params
				
			);
		}
	}

	//Add Menu Options Section Without a panel
	$wp_customize->add_section( 
		'catchflames_menu_options', 
		array(
			'description'	=> __( 'Extra Menu Options specific to this theme', 'catch-flames' ),
			'priority' 		=> 105,
			'title'    		=> __( 'Menu Options', 'catch-flames' ),
			) 
		);

	$settings_parameters = array(
		//Disable Header Menu
		'disable_header_menu' => array(
			'id' 				=> 'disable_header_menu',
			'title' 			=> __( 'Check to Disable Default Page Menu', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'checkbox',
			'sanitize' 			=> 'catchflames_sanitize_checkbox',
			'panel' 			=> 'theme_options',
			'section' 			=> 'menu_options',
			'default' 			=> $defaults['disable_header_menu'],
		),

		//Favicon
		'remove_favicon' => array(
			'id' 				=> 'remove_favicon',
			'title' 			=> __( 'Check to Disable Favicon', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'checkbox',
			'sanitize' 			=> 'catchflames_sanitize_checkbox',
			'panel' 			=> 'theme_options',
			'section' 			=> 'favicon',
			'default' 			=> $defaults['remove_favicon'],
		),
		'fav_icon' => array(
			'id' 				=> 'fav_icon',
			'title' 			=> __( 'Fav Icon', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'image',
			'sanitize' 			=> 'catchflames_sanitize_image',
			'panel' 			=> 'theme_options',
			'section' 			=> 'favicon',
			'default' 			=> $defaults['favicon'],
		),

		//Web Clip Icon
		'remove_web_clip' => array(
			'id' 				=> 'remove_web_clip',
			'title' 			=> __( 'Check to Disable Web Clip Icon', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'checkbox',
			'sanitize' 			=> 'catchflames_sanitize_checkbox',
			'panel' 			=> 'theme_options',
			'section' 			=> 'web_clip_icon_options',
			'default' 			=> $defaults['remove_web_clip'],
		),
		'web_clip' => array(
			'id' 				=> 'web_clip',
			'title' 			=> __( 'Web Clip Icon', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'image',
			'sanitize' 			=> 'catchflames_sanitize_image',
			'panel' 			=> 'theme_options',
			'section' 			=> 'web_clip_icon_options',
			'default' 			=> $defaults['web_clip'],
		),

		//Fixed Header Top Options
		'enable_header_top' => array(
			'id' 			=> 'enable_header_top',
			'title' 		=> __( 'Check to Enable Fixed Header Top', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'checkbox',
			'sanitize' 		=> 'catchflames_sanitize_checkbox',
			'panel' 		=> 'theme_options',
			'section' 		=> 'fixed_header_top_options',
			'default' 		=> $defaults['enable_header_top']
		),
		'disable_top_menu_logo' => array(
			'id' 			=> 'disable_top_menu_logo',
			'title' 		=> __( 'Check to Disable Logo in Fixed Header Top', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'checkbox',
			'sanitize' 		=> 'catchflames_sanitize_checkbox',
			'panel' 		=> 'theme_options',
			'section' 		=> 'fixed_header_top_options',
			'default' 		=> $defaults['disable_top_menu_logo']
		),
		'top_menu_logo' => array(
			'id' 			=> 'top_menu_logo',
			'title' 		=> __( 'Logo in Fixed Header Top', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'image',
			'sanitize' 		=> 'catchflames_sanitize_image',
			'panel' 		=> 'theme_options',
			'section' 		=> 'fixed_header_top_options',
			'default' 		=> $defaults['top_menu_logo']
		),

		//Header Options
		'remove_header_logo' => array(
			'id' 			=> 'remove_header_logo',
			'title' 		=> __( 'Check to Disable Header Logo', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'checkbox',
			'sanitize' 		=> 'catchflames_sanitize_checkbox',
			'panel' 		=> 'theme_options',
			'section' 		=> 'header_options',
			'default' 		=> $defaults['remove_header_logo']
		),
		'featured_logo_header' => array(
			'id' 			=> 'featured_logo_header',
			'title' 		=> __( 'Logo', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'image',
			'sanitize' 		=> 'catchflames_sanitize_image',
			'panel' 		=> 'theme_options',
			'section' 		=> 'header_options',
			'default' 		=> $defaults['featured_logo_header']
		),

		//Header Image Options
		'enable_featured_header_image' => array(
			'id' 			=> 'enable_featured_header_image',
			'title' 		=> __( 'Enable Featured Header Image on', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'select',
			'sanitize' 		=> 'catchflames_sanitize_select',
			'section' 		=> 'header_image',
			'default' 		=> $defaults['enable_featured_header_image'],
			'choices'		=> catchflames_enable_header_featured_image_options(),
		),
		'featured_header_image_alt' => array(
			'id' 			=> 'featured_header_image_alt',
			'title' 		=> __( 'Featured Header Image Alt/Title Tag', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'text',
			'sanitize' 		=> 'sanitize_text_field',
			'section' 		=> 'header_image',
			'default' 		=> $defaults['featured_header_image_alt']
		),
		'featured_header_image_url' => array(
			'id' 				=> 'featured_header_image_url',
			'title' 			=> __( 'Featured Header Image Link URL', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'url',
			'sanitize' 			=> 'esc_url_raw',
			'section' 			=> 'header_image',
			'default' 			=> $defaults['featured_header_image_url']
		),
		'reset_header_image' => array(
			'id' 			=> 'reset_header_image',
			'title' 		=> __( 'Check to Reset Header Featured Image Options', 'catch-flames' ),
			'description'	=> __( 'Please refresh the customizer after saving if reset option is used', 'catch-flames' ),
			'field_type' 	=> 'checkbox',
			'sanitize' 		=> 'catchflames_sanitize_reset_header_image',
			'section' 		=> 'header_image',
			'default' 		=> $defaults['reset_sidebar_layout']
		),

		//Search Settings
		'search_display_text' => array(
			'id' 			=> 'search_display_text',
			'title' 		=> __( 'Default Display Text in Search', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'text',
			'sanitize' 		=> 'sanitize_text_field',
			'panel' 		=> 'theme_options',
			'section' 		=> 'search_text_settings',
			'default' 		=> $defaults['search_display_text']
		),

		//Layout Options
		'sidebar_layout' => array(
			'id' 			=> 'sidebar_layout',
			'title' 		=> __( 'Sidebar Layout Options', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'select',
			'sanitize' 		=> 'catchflames_sanitize_select',
			'panel' 		=> 'theme_options',
			'section' 		=> 'layout_options',
			'default' 		=> $defaults['sidebar_layout'],
			'choices'		=> catchflames_sidebar_layout_options(),
		),
		'content_layout' => array(
			'id' 			=> 'content_layout',
			'title' 		=> __( 'Full Content Display', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'select',
			'sanitize' 		=> 'catchflames_sanitize_select',
			'panel' 		=> 'theme_options',
			'section' 		=> 'layout_options',
			'default' 		=> $defaults['content_layout'],
			'choices'		=> catchflames_content_layout_options(),
		),
		'reset_sidebar_layout' => array(
			'id' 			=> 'reset_sidebar_layout',
			'title' 		=> __( 'Check to Reset Layout', 'catch-flames' ),
			'description'	=> __( 'Please refresh the customizer after saving if reset option is used', 'catch-flames' ),
			'field_type' 	=> 'checkbox',
			'sanitize' 		=> 'catchflames_sanitize_reset_layout',
			'panel' 		=> 'theme_options',
			'section' 		=> 'layout_options',
			'default' 		=> $defaults['reset_sidebar_layout']
		),

		//Homepage/Frontpage Settings
		'front_page_category' => array(
			'id' 			=> 'front_page_category',
			'title' 		=> __( 'Front page posts categories:', 'catch-flames' ),
			'description'	=> __( 'Only posts that belong to the categories selected here will be displayed on the front page', 'catch-flames' ),
			'field_type' 	=> 'category-multiple',
			'sanitize' 		=> 'catchflames_sanitize_category_list',
			'panel' 		=> 'theme_options',
			'section' 		=> 'homepage_settings',
			'default' 		=> $defaults['front_page_category']
		),		

		//Excerpt More Settings
		'more_tag_text' => array(
			'id' 			=> 'more_tag_text',
			'title' 		=> __( 'More Tag Text', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'text',
			'sanitize' 		=> 'sanitize_text_field',
			'panel' 		=> 'theme_options',
			'section' 		=> 'excerpt_more_tag_settings',
			'default' 		=> $defaults['more_tag_text']
		),
		'excerpt_length' => array(
			'id' 			=> 'excerpt_length',
			'title' 		=> __( 'Excerpt length(words)', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'number',
			'sanitize' 		=> 'catchflames_sanitize_number_range',
			'panel' 		=> 'theme_options',
			'section' 		=> 'excerpt_more_tag_settings',
			'default' 		=> $defaults['excerpt_length'],
			'input_attrs' 	=> array(
					            'style' => 'width: 45px;',
					            'min'   => 0,
					            'max'   => 999999,
					            'step'  => 1,
					        	)
		),
		'reset_moretag' => array(
			'id' 			=> 'reset_moretag',
			'title' 		=> __( 'Check to Reset Excerpt', 'catch-flames' ),
			'description'	=> __( 'Please refresh the customizer after saving if reset option is used', 'catch-flames' ),
			'field_type' 	=> 'checkbox',
			'sanitize' 		=> 'catchflames_sanitize_reset_moretag',
			'panel' 		=> 'theme_options',
			'section' 		=> 'excerpt_more_tag_settings',
			'default' 		=> ''
		),

		//Custom Css
		'custom_css' => array(
			'id' 			=> 'custom_css',
			'title' 		=> __( 'Enter your custom CSS styles', 'catch-flames' ),
			'description' 	=> '',
			'field_type' 	=> 'textarea',
			'sanitize' 		=> 'catchflames_sanitize_custom_css',
			'panel' 		=> 'theme_options',
			'section' 		=> 'custom_css',
			'default' 		=> $defaults['custom_css']
		),

		//Scroll Up
		'disable_scrollup' => array(
			'id' 			=> 'disable_scrollup',
			'title' 		=> __( 'Check to Disable Scroll Up', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'checkbox',
			'sanitize' 		=> 'catchflames_sanitize_checkbox',
			'panel' 		=> 'theme_options',
			'section' 		=> 'scrollup',
			'default' 		=> $defaults['disable_scrollup']
		),

		//Color Scheme
		'color_scheme' => array(
			'id' 			=> 'color_scheme',
			'title' 		=> __( 'Default Color Scheme', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'radio',
			'sanitize' 		=> 'catchflames_sanitize_select',
			'section' 		=> 'colors',
			'default' 		=> $defaults['color_scheme'],
			'choices'		=> catchflames_color_schemes(),
		),

		//Slider Options
		'enable_slider' => array(
			'id' 			=> 'enable_slider',
			'title' 		=> __( 'Enable Slider', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'select',
			'sanitize' 		=> 'catchflames_sanitize_select',
			'panel' 		=> 'featured_slider',
			'section' 		=> 'slider_options',
			'default' 		=> $defaults['enable_slider'],
			'choices'		=> catchflames_enable_slider_options(),
		),
		'select_slider_type' => array(
			'id' 				=> 'select_slider_type',
			'title' 			=> __( 'Select Slider Type', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'select',
			'sanitize' 			=> 'catchflames_sanitize_select',
			'panel' 			=> 'featured_slider',
			'section' 			=> 'slider_options',
			'default' 			=> $defaults['select_slider_type'],
			'active_callback'	=> 'catchflames_is_slider_active',
			'choices'			=> catchflames_slider_types(),
		),
		'transition_effect' => array(
			'id' 				=> 'transition_effect',
			'title' 			=> __( 'Transition Effect', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'select',
			'sanitize' 			=> 'catchflames_sanitize_select',
			'panel' 			=> 'featured_slider',
			'section' 			=> 'slider_options',
			'default' 			=> $defaults['transition_effect'],
			'active_callback'	=> 'catchflames_is_slider_active',
			'choices'			=> catchflames_transition_effects(),
		),
		'transition_delay' => array(
			'id' 				=> 'transition_delay',
			'title' 			=> __( 'Transition Delay', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'number',
			'sanitize' 			=> 'catchflames_sanitize_number_range',
			'panel' 			=> 'featured_slider',
			'section' 			=> 'slider_options',
			'default' 			=> $defaults['transition_delay'],
			'active_callback'	=> 'catchflames_is_slider_active',
			'input_attrs' 		=> array(
						            'style' => 'width: 45px;',
						            'min'   => 0,
						            'max'   => 999999999,
						            'step'  => 1,
						        	)
		),
		'transition_duration' => array(
			'id' 				=> 'transition_duration',
			'title' 			=> __( 'Transition Length', 'catch-flames' ),
			'description'		=> '',
			'field_type' 		=> 'number',
			'sanitize' 			=> 'catchflames_sanitize_number_range',
			'panel' 			=> 'featured_slider',
			'section' 			=> 'slider_options',
			'default' 			=> $defaults['transition_duration'],
			'active_callback'	=> 'catchflames_is_slider_active',
			'input_attrs' 		=> array(
						            'style' => 'width: 45px;',
						            'min'   => 0,
						            'max'   => 999999999,
						            'step'  => 1,
						        	)
		),
		'slider_qty' => array(
			'id' 				=> 'slider_qty',
			'title' 			=> __( 'Number of Slides', 'catch-flames' ),
			'description'		=> __( 'Customizer page needs to be refreshed after saving if number of slides is changed', 'catch-flames' ),
			'field_type' 		=> 'number',
			'sanitize' 			=> 'catchflames_sanitize_number_range',
			'panel' 			=> 'featured_slider',
			'section' 			=> 'slider_options',
			'default' 			=> $defaults['slider_qty'],
			'active_callback'	=> 'catchflames_is_page_slider_active',
			'input_attrs' 		=> array(
						            'style' => 'width: 45px;',
						            'min'   => 0,
						            'max'   => 20,
						            'step'  => 1,
						        	)
		),

		//Social Links
		'disable_footer_social' => array(
			'id' 				=> 'disable_footer_social',
			'title' 			=> __( 'Check to Enable Social Icons in Footer', 'catch-flames' ),
			'field_type' 		=> 'checkbox',
			'sanitize' 			=> 'catchflames_sanitize_checkbox',
			'panel' 			=> 'social_links',
			'section' 			=> 'social_links',
			'default' 			=> $defaults['disable_footer_social'],
		),
		'social_facebook' => array(
			'id' 			=> 'social_facebook',
			'title' 		=> __( 'Facebook', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_facebook']
		),
		'social_twitter' => array(
			'id' 			=> 'social_twitter',
			'title' 		=> __( 'Twitter', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_twitter']
		),
		'social_googleplus' => array(
			'id' 			=> 'social_googleplus',
			'title' 		=> __( 'Google+', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_googleplus']
		),
		'social_pinterest' => array(
			'id' 			=> 'social_pinterest',
			'title' 		=> __( 'Pinterest', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_pinterest']
		),
		'social_youtube' => array(
			'id' 			=> 'social_youtube',
			'title' 		=> __( 'Youtube', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_youtube']
		),
		'social_vimeo' => array(
			'id' 			=> 'social_vimeo',
			'title' 		=> __( 'Vimeo', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_vimeo']
		),
		'social_linkedin' => array(
			'id' 			=> 'social_linkedin',
			'title' 		=> __( 'LinkedIn', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_linkedin']
		),
		'social_aim' => array(
			'id' 			=> 'social_aim',
			'title' 		=> __( 'AIM', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_aim']
		),
		'social_myspace' => array(
			'id' 			=> 'social_myspace',
			'title' 		=> __( 'MySpace', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_myspace']
		),
		'social_flickr' => array(
			'id' 			=> 'social_flickr',
			'title' 		=> __( 'Flickr', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_flickr']
		),
		'social_tumblr' => array(
			'id' 			=> 'social_tumblr',
			'title' 		=> __( 'Tumblr', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_tumblr']
		),
		'social_deviantart' => array(
			'id' 			=> 'social_deviantart',
			'title' 		=> __( 'deviantART', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_deviantart']
		),
		'social_dribbble' => array(
			'id' 			=> 'social_dribbble',
			'title' 		=> __( 'Dribbble', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_dribbble']
		),
		'social_wordpress' => array(
			'id' 			=> 'social_wordpress',
			'title' 		=> __( 'WordPress', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_wordpress']
		),
		'social_rss' => array(
			'id' 			=> 'social_rss',
			'title' 		=> __( 'RSS', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_rss']
		),
		'social_slideshare' => array(
			'id' 			=> 'social_slideshare',
			'title' 		=> __( 'Slideshare', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_slideshare']
		),
		'social_instagram' => array(
			'id' 			=> 'social_instagram',
			'title' 		=> __( 'Instagram', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_instagram']
		),
		'social_skype' => array(
			'id' 			=> 'social_skype',
			'title' 		=> __( 'Skype', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'sanitize_text_field',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_skype']
		),
		'social_soundcloud' => array(
			'id' 			=> 'social_soundcloud',
			'title' 		=> __( 'Soundcloud', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_soundcloud']
		),
		'social_email' => array(
			'id' 			=> 'social_email',
			'title' 		=> __( 'Email', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'sanitize_email',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_email']
		),
		'social_contact' => array(
			'id' 			=> 'social_contact',
			'title' 		=> __( 'Contact', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_contact']
		),
		'social_xing' => array(
			'id' 			=> 'social_xing',
			'title' 		=> __( 'Xing', 'catch-flames' ),
			'description'	=> '',
			'field_type' 	=> 'url',
			'sanitize' 		=> 'esc_url_raw',
			'panel' 		=> 'social_links',
			'section' 		=> 'social_links',
			'default' 		=> $defaults['social_xing']
		),
		'enable_specificfeeds' => array(
			'id' 				=> 'enable_specificfeeds',
			'title' 			=> __( 'Check to Enable SpecificFeeds', 'catch-flames' ),
			'field_type' 		=> 'checkbox',
			'sanitize' 			=> 'catchflames_sanitize_checkbox',
			'panel' 			=> 'social_links',
			'section' 			=> 'social_links',
			'default' 			=> $defaults['enable_specificfeeds'],
		),
	);	

	foreach ( $settings_parameters as $option ) {
		if( 'image' == $option['field_type'] ) {
			$wp_customize->add_setting(
				// $id
				$theme_slug . 'options[' . $option['id'] . ']',
				// parameters array
				array(
					'type'				=> 'option',
					'sanitize_callback'	=> $option['sanitize'],
					'default'			=> $option['default']
				)
			);

			$wp_customize->add_control( 
				new WP_Customize_Image_Control( 
					$wp_customize,$theme_slug . 'options[' . $option['id'] . ']',
					array(
						'label'		=> $option['title'],
						'section'   => $theme_slug . $option['section'],
						'settings'  => $theme_slug . 'options[' . $option['id'] . ']',
					) 
				) 
			);
		}
		else if ('checkbox' == $option['field_type'] ) {
			$wp_customize->add_setting(
				// $id
				$theme_slug . 'options[' . $option['id'] . ']',
				// parameters array
				array(
					'type'				=> 'option',
					'sanitize_callback'	=> $option['sanitize'],
					'default'			=> $option['default'],				)
			);

			$params = array(
						'label'		=> $option['title'],
						'settings'  => $theme_slug . 'options[' . $option['id'] . ']',
						'name'  	=> $theme_slug . 'options[' . $option['id'] . ']',
					);
			
			if ( isset( $option['active_callback']  ) ){
				$params['active_callback'] = $option['active_callback'];
			}

			if ( 'header_image' == $option['section'] ){
				$params['section'] = $option['section'];
			}
			else {
				$params['section']	= $theme_slug . $option['section'];
			}

			$wp_customize->add_control( 
				new Catchflames_Customize_Checkbox( 
					$wp_customize,$theme_slug . 'options[' . $option['id'] . ']',
					$params	
				) 
			);
		}
		else if ('category-multiple' == $option['field_type'] ) {
			$wp_customize->add_setting(
				// $id
				$theme_slug . 'options[' . $option['id'] . ']',
				// parameters array
				array(
					'type'				=> 'option',
					'sanitize_callback'	=> $option['sanitize'],
					'default'			=> $option['default']
				)
			);

			$params = array(
						'label'			=> $option['title'],
						'section'		=> $theme_slug . $option['section'],
						'settings'		=> $theme_slug . 'options[' . $option['id'] . ']',
						'description'	=> $option['description'],
						'name'	 		=> $theme_slug . 'options[' . $option['id'] . ']',
					);
			
			if ( isset( $option['active_callback']  ) ){
				$params['active_callback'] = $option['active_callback'];
			}

			$wp_customize->add_control( 
				new Catchflames_Customize_Dropdown_Categories_Control ( 
					$wp_customize,
					$theme_slug . 'options[' . $option['id'] . ']',
					$params
				)
			);
		}
		else {
			//Normal Loop
			$wp_customize->add_setting(
				// $id
				$theme_slug . 'options[' . $option['id'] . ']',
				// parameters array
				array(
					'default'			=> $option['default'],
					'type'				=> 'option',
					'sanitize_callback'	=> $option['sanitize']
				)
			);

			// Add setting control
			$params = array(
					'label'			=> $option['title'],
					'settings'		=> $theme_slug . 'options[' . $option['id'] . ']',
					'type'			=> $option['field_type'],
					'description'   => $option['description'],
				) ;

			if ( isset( $option['choices']  ) ){
				$params['choices'] = $option['choices'];
			}

			if ( isset( $option['active_callback']  ) ){
				$params['active_callback'] = $option['active_callback'];
			}

			if ( isset( $option['input_attrs']  ) ){
				$params['input_attrs'] = $option['input_attrs'];
			}

			if ( 'header_image' == $option['section'] || 'colors' == $option['section'] ){
				$params['section'] = $option['section'];
			}
			else {
				$params['section']	= $theme_slug . $option['section'];
			}

			$wp_customize->add_control(
				// $id
				$theme_slug . 'options[' . $option['id'] . ']',
				$params			
			);
		}
	}

	//Add featured post elements with respect to no of featured sliders
	for ( $i = 1; $i <= $options[ 'slider_qty' ]; $i++ ) {
		$wp_customize->add_setting(
			// $id
			$theme_slug . 'options[featured_slider_page][' . $i . ']',
			// parameters array
			array(
				'type'				=> 'option',
				'sanitize_callback'	=> 'catchflames_sanitize_post_id'
			)
		);

		$wp_customize->add_control( 
			$theme_slug . 'options[featured_slider_page][' . $i . ']',
			array(
				'label'				=> sprintf( __( 'Featured Page Slider #%s', 'catch-flames' ), $i ),
				'section'   		=> $theme_slug .'slider_options',
				'settings'  		=> $theme_slug . 'options[featured_slider_page][' . $i . ']',
				'type'				=> 'dropdown-pages',
				'active_callback'	=> 'catchflames_is_page_slider_active',
				'input_attrs' 		=> array(
	        		'style' => 'width: 100px;'
	    		),
			)
		);
	}


	// Reset all settings to default
	$wp_customize->add_section( 'catchflames_reset_all_settings', array(
		'description'	=> __( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'catch-flames' ),
		'priority' 		=> 700,
		'title'    		=> __( 'Reset all settings', 'catch-flames' ),
	) );

	$wp_customize->add_setting( 'catchflames_options[reset_all_settings]', array(
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'catchflames_reset_all_settings',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( 'catchflames_options[reset_all_settings]', array(
		'label'    => __( 'Check to reset all settings to default', 'catch-flames' ),
		'section'  => 'catchflames_reset_all_settings',
		'settings' => 'catchflames_options[reset_all_settings]',
		'type'     => 'checkbox'
	) );
	// Reset all settings to default end

	//Important Links
	$wp_customize->add_section( 'important_links', array(
		'priority' 		=> 999,
		'title'   	 	=> __( 'Important Links', 'catch-flames' ),
	) );

	/**
	 * Has dummy Sanitizaition function as it contains no value to be sanitized
	 */
	$wp_customize->add_setting( 'important_links', array(
		'sanitize_callback'	=> 'catchflames_sanitize_important_link',
	) );

	$wp_customize->add_control( new Catchflames_Important_Links( $wp_customize, 'important_links', array(
        'label'   	=> __( 'Important Links', 'catch-flames' ),
        'section'  	=> 'important_links',
        'settings' 	=> 'important_links',
        'type'     	=> 'important_links',
    ) ) );  
    //Important Links End
}
add_action( 'customize_register', 'catchflames_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously for catch-flames.
 * And flushes out all transient data on preview
 *
 * @since Catch Flames 2.7
 */
function catchflames_customize_preview() {
	//Remove transients on preview
	catchflames_themeoption_invalidate_caches();

	global $catchflames_options_defaults ,$catchflames_options_settings;

	$catchflames_options_settings = catchflames_options_set_defaults( $catchflames_options_defaults );
}
add_action( 'customize_preview_init', 'catchflames_customize_preview' );
add_action( 'customize_save', 'catchflames_customize_preview' );


/**
 * Custom scripts and styles on Customizer for Catch Flames
 *
 * @since Catch Flames 2.7
 */
function catchflames_customize_scripts() {
	wp_register_script( 'catchflames_customizer_custom', get_template_directory_uri() . '/inc/panel/customizer-custom-scripts.js', array( 'jquery' ), '20140108', true );

    $catchflames_misc_links = array(
							'upgrade_link' 				=> esc_url( 'http://catchthemes.com/themes/catch-flames-pro/' ),
							'upgrade_text'	 			=> __( 'Upgrade To Pro &raquo;', 'catch-flames' ),
		);

    //Add More Theme Options Button
    wp_localize_script( 'catchflames_customizer_custom', 'catchflames_misc_links', $catchflames_misc_links );

    wp_enqueue_script( 'catchflames_customizer_custom' );

    wp_enqueue_style( 'catchflames_customizer_custom', get_template_directory_uri() . '/inc/panel/catchflames-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'catchflames_customize_scripts' );

//Active callbacks for customizer
require get_template_directory() . '/inc/panel/customizer/customizer-active-callbacks.php';

//Sanitize functions for customizer
require get_template_directory() . '/inc/panel/customizer/customizer-sanitize-functions.php';
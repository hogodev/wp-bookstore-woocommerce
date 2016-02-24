<?php
/**
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 2.7
 */


/**
 * Sanitizes Checkboxes
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_checkbox( $input ) {
	if ( "1" == $input ) {
		return "1";
	} 
	else {
		return "0";
   	}
}


/**
 * Sanitizes Custom CSS 
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_custom_css( $input ) {
	if ( $input != '' ) { 
        $input = str_replace( '<=', '&lt;=', $input ); 
        
        $input = wp_kses_split( $input, array(), array() ); 
        
        $input = str_replace( '&gt;', '>', $input ); 
        
        $input = strip_tags( $input ); 

        return $input;
 	}
    else {
    	return '';
    }
}

/**
 * Image sanitization callback example.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * - Sanitization: image file extension
 * - Control: text, WP_Customize_Image_Control
 * 
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function catchflames_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Sanitizes post_id in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_post_id( $input ) {
    // Ensure $input is an absolute integer.
	$post_id = absint( $input );
	// If $page_id is an ID of a published page, return it; otherwise, return false
	return ( 'publish' == get_post_status( $post_id ) ? $post_id : false );
}


/**
 * Sanitizes category list in slider
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_category_list( $input ) {
	if ( $input != '' ) { 
		$args = array(
						'type'			=> 'post',
						'child_of'      => 0,
						'parent'        => '',
						'orderby'       => 'name',
						'order'         => 'ASC',
						'hide_empty'    => 0,
						'hierarchical'  => 0,
						'taxonomy'      => 'category',
					); 
		
		$categories = ( get_categories( $args ) );

		$category_list 	=	array();
		
		foreach ( $categories as $category )
			$category_list 	=	array_merge( $category_list, array( $category->term_id ) );

		if ( count( array_intersect( $input, $category_list ) ) == count( $input ) ) {
	    	return $input;
	    } 
	    else {
    		return '';
   		}
    }
    else {
    	return '';
    }
}


/**
 * Number Range sanitization callback example.
 *
 * - Sanitization: number_range
 * - Control: number, tel
 * 
 * Sanitization callback for 'number' or 'tel' type text inputs. This callback sanitizes
 * `$number` as an absolute integer within a defined min-max range.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to check within the numeric range defined by the setting.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise,
 *                    the setting default.
 */
function catchflames_sanitize_number_range( $number, $setting ) {

	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;	
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}


/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 * 
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 * 
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function catchflames_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


/**
 * Reset all settings to default
 * @param  $input entered value
 * @return sanitized output
 *
 * @since Catch Flames 2.7
 */
function catchflames_reset_all_settings( $input ) {
	if ( $input == 1 ) {
        // Delete all theme options
        delete_option('catchflames_options' );
       
        // Flush out all transients	on reset
        catchflames_themeoption_invalidate_caches();
    } 
    else {
        return '';
    }
}


/**
 * Dummy Sanitizaition function as it contains no value to be sanitized
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_important_link() {
	return false;
}


/**
 * Reset featured image
 * @param  $input entered value
 * @return nothing
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_reset_featured_image( $input ) {
	//Reset Header Featured Image Options
	if( $input == 1 ) {
		global $catchflames_options_settings, $catchflames_options_defaults;
    	
    	$options = $catchflames_options_settings;	
	
		$defaults = $catchflames_options_defaults;

		$options[ 'enable_featured_header_image' ] 	= $defaults[ 'enable_featured_header_image' ];
		$options[ 'page_featured_image' ] 			= $defaults[ 'page_featured_image' ];
		$options[ 'featured_header_image' ] 		= $defaults[ 'featured_header_image' ];
		$options[ 'featured_header_image_alt' ] 	= $defaults[ 'featured_header_image_alt' ];
		$options[ 'featured_header_image_url' ] 	= $defaults[ 'featured_header_image_url' ];
		$options[ 'featured_header_image_base' ] 	= $defaults[ 'featured_header_image_base' ];

		update_option( 'catchflames_options', $options );
	}
}


/**
 * Reset layout
 * @param  $input entered value
 * @return nothing
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_reset_layout( $input ) {
	//Reset Header Featured Image Options
	if( $input == 1 ) {
		global $catchflames_options_settings, $catchflames_options_defaults;
    	
    	$options = $catchflames_options_settings;	
	
		$defaults = $catchflames_options_defaults;

		$options[ 'sidebar_layout' ] = $defaults[ 'sidebar_layout' ];
		$options[ 'content_layout' ] = $defaults[ 'content_layout' ];
		
		update_option( 'catchflames_options', $options );
	}
}


/**
 * Reset more tag
 * @param  $input entered value
 * @return nothing
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_reset_moretag( $input ) {
	if( $input == 1 ) {
		global $catchflames_options_settings, $catchflames_options_defaults;
    	
    	$options = $catchflames_options_settings;	
	
		$defaults = $catchflames_options_defaults;

		$options[ 'more_tag_text' ]	= $defaults[ 'more_tag_text' ];
		$options[ 'excerpt_length' ]= $defaults[ 'excerpt_length' ];

		update_option( 'catchflames_options', $options );
	}
}


/**
 * Reset Header Image
 * @param  $input entered value
 * @return nothing
 *
 * @since Catch Flames 2.7
 */
function catchflames_sanitize_reset_header_image( $input ) {
	if( $input == 1 ) {
		global $catchflames_options_settings, $catchflames_options_defaults;
    	
    	$options = $catchflames_options_settings;	
	
		$defaults = $catchflames_options_defaults;

		$options[ 'enable_featured_header_image' ] 	= $defaults[ 'enable_featured_header_image' ];
		$options[ 'featured_header_image_alt' ] 	= $defaults[ 'featured_header_image_alt' ];
		$options[ 'featured_header_image_url' ] 	= $defaults[ 'featured_header_image_url' ];

		update_option( 'catchflames_options', $options );
	}
}
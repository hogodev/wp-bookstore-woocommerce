<?php
/**
 * @package Catch Themes
 * @subpackage Catch Flames
 * @since Catch Flames 2.7
 */


if( ! function_exists( 'catchflames_is_favicon_active' ) ) :
	/**
	* Return true if no core site icon is present
	*
	* @since Catch Flames 2.7
	*/
	function catchflames_is_site_icon_active( $control ) {
		//Check if has_site_icon function exists. If it does not, WP version is less than 4.3
		if ( function_exists( 'has_site_icon' ) ) { 
			//Return true if core site icon is not present, else return false
			return !has_site_icon();
		}
		else {		
			return true;
		}
	}
endif;

if( ! function_exists( 'catchflames_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Catch Flames 2.7
	*/
	function catchflames_is_slider_active( $control ) {
		global $wp_query;
		
		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts'); 

		$enable = $control->manager->get_setting( 'catchflames_options[enable_slider]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( $enable == 'enable-slider-allpage' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enable == 'enable-slider-homepage' ) );
	}
endif;


if( ! function_exists( 'catchflames_is_page_slider_active' ) ) :
	/**
	* Return true if page slider is active
	*
	* @since Catch Flames 2.7
	*/
	function catchflames_is_page_slider_active( $control ) {
		global $wp_query;
		
		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts'); 

		$enable = $control->manager->get_setting( 'catchflames_options[enable_slider]' )->value();

		$type 	= $control->manager->get_setting( 'catchflames_options[select_slider_type]' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( ( $enable == 'enable-slider-allpage' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enable == 'enable-slider-homepage' ) ) && 'page-slider' == $type );
	}
endif;
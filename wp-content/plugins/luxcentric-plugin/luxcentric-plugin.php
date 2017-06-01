<?php
/**
 * Plugin Name: Luxcentric Site Plugin
 * Plugin URI: https://luxcentric.com/
 * Description: Custom code for luxcentric website.
 * Version: 1.0.0
 * Author: Gary Ritchie
 * Requires at least: 4.7
 * Tested up to: 4.7
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Add Shortcode
function luxcentric_courses() {
	if (is_user_logged_in()) {
		echo do_shortcode("[woocommerce_my_account]");
		echo do_shortcode("[sensei_user_courses]");
	} else {
		echo do_shortcode("[woocommerce_my_account]");
	}
}
add_shortcode( 'luxcentric_user_courses', 'luxcentric_courses' );

?>

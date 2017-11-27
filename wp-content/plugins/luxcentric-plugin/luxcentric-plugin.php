<?php
/**
 * Plugin Name: Luxcentric Site Plugin
 * Plugin URI: https://luxcentric.com/
 * Description: Custom code for luxcentric website.
 * Version: 1.0.7
 * Author: Gary Ritchie
 * Requires at least: 4.7
 * Tested up to: 4.9
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once( plugin_dir_path( __FILE__ ) . 'lx-shortcodes.php' );
require_once( plugin_dir_path( __FILE__ ) . 'lx-zoho.php' );

/**
 * Modified version of class-sensei-course.php, private function
 * Sensei_Course::add_course_access_permission_message
 *
 */
function lx_add_course_access_permission_message( $message ) {
	global $post;
	if ( Sensei()->settings->get( 'access_permission' ) ) {
		$message = apply_filters( 'sensei_couse_access_permission_message', $message, $post->ID );
		if ( ! empty( $message ) ) {
			Sensei()->notices->add_notice( $message, 'info' );
		}
	}
}

// determine if we should use luxcentric_course_prefix instead
// of Sensei_Course::the_course_enrolment_actions
function luxcentric_use_custom_enrolment_actions() {
	global $post;

	if ( 'course' != $post->post_type ) {
		return false;
	}

	if ( is_user_logged_in() ) {
		return false;
	}

	if ( Sensei_WC::is_woocommerce_active() && Sensei_WC::is_course_purchasable( $post->ID ) ) {
		return false;
	}

	return true;
}

// modified version of Sensei_Course::the_course_enrolment_actions; only call
// if user not logged in, and it's a free course
function luxcentric_course_prefix() {

	global $post;

	if ( ! luxcentric_use_custom_enrolment_actions() ) {
		error_log( 'unexpected call to luxcentric_course_prefix' );

		return;
	}

	?>
    <section class="course-meta course-enrolment">
	<?php
	if ( get_option( 'users_can_register' ) ) {

		// show the registration form
		echo do_shortcode( '[woocommerce_simple_registration]' );
	} // end if user can register

	echo do_shortcode( '[woocommerce_my_account]' );
	?>
    </section><?php

}// end luxcentric_course_prefix

?>

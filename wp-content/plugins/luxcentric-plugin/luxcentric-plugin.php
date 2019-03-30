<?php
/**
 * Plugin Name: Luxcentric Site Plugin
 * Plugin URI: https://luxcentric.com/
 * Description: Custom code for luxcentric website.
 * Version: 1.0.9
 * Author: Gary Ritchie
 * Requires at least: 4.9
 * Tested up to: 5.1.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once( plugin_dir_path( __FILE__ ) . 'lx-shortcodes.php' );
require_once( plugin_dir_path( __FILE__ ) . 'lx-zoho.php' );
require_once( plugin_dir_path( __FILE__ ) . 'lx-freeproduct.php' );

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
	echo do_shortcode( '[woocommerce_my_account]' );
	?>
    </section><?php

}// end luxcentric_course_prefix

function luxcentric_add_name_input(){
	// Name Field Option.
	$required = true;

	?>
	<p class="woocommerce-FormRow woocommerce-FormRow--first form-row form-row-first">
		<label for="reg_sr_firstname"><?php _e( 'First Name', 'woocommerce-simple-registration' ); ?><?php echo( $required ? ' <span class="required">*</span>' : '' ) ?></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="sr_firstname" id="reg_sr_firstname" value="<?php if ( ! empty( $_POST['sr_firstname'] ) ) {echo esc_attr( $_POST['sr_firstname'] );} ?>" <?php echo( $required ? ' required' : '' ) ?>/>
		</p>

		<p class="woocommerce-FormRow woocommerce-FormRow--last form-row form-row-last">
			<label for="reg_sr_lastname"><?php _e( 'Last Name', 'woocommerce-simple-registration' ); ?><?php echo( $required ? ' <span class="required">*</span>' : '' ) ?></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="sr_lastname" id="reg_sr_lastname" value="<?php if ( ! empty( $_POST['sr_lastname'] ) ) {echo esc_attr( $_POST['sr_lastname'] );} ?>" <?php echo( $required ? ' required' : '' ) ?> />
		</p>
	<?php
}

function luxcentric_save_name_input( $customer_id ){
	/* Strip slash everything */
	$request = stripslashes_deep( $_POST );

	/* Save First Name */
	if ( isset( $request['sr_firstname'] ) && !empty( $request['sr_firstname'] ) ) {
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $request['sr_firstname'] ) );
	}
	/* Save Last Name */
	if ( isset( $request['sr_lastname'] ) && !empty( $request['sr_lastname'] ) ) {
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $request['sr_lastname'] ) );
	}
}
?>

<?php
/**
 * Plugin Name: Luxcentric Site Plugin
 * Plugin URI: https://luxcentric.com/
 * Description: Custom code for luxcentric website.
 * Version: 1.0.11
 * Author: Gary Ritchie
 * Requires at least: 4.9
 * Tested up to: 5.2.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once( plugin_dir_path( __FILE__ ) . 'lx-shortcodes.php' );
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

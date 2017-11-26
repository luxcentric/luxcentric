<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 11/25/17
 * Time: 5:20 PM
 */

/**
 * SHORTCODE: [luxcentric_user_courses]
 * https://github.com/luxcentric/luxcentric/issues/4
 */
function luxcentric_courses() {
	if ( is_user_logged_in() ) {
		echo do_shortcode( "[woocommerce_my_account]" );
		echo do_shortcode( "[sensei_user_courses]" );
	} else {
		echo do_shortcode( "[woocommerce_my_account]" );
	}
}

add_shortcode( 'luxcentric_user_courses', 'luxcentric_courses' );

/**
 * SHORTCODE: [lx_not_signed_in]
 *
 * Show text only if user is not signed in.
 *
 * [lx_not_signed_in]some text[/lx_not_signed_in]
 */
function lx_not_signed_in( $atts, $content = null ) {
	if ( is_user_logged_in() ) {
		return "";
	} else {
		return $content;
	}
}

add_shortcode( 'lx_not_signed_in', 'lx_not_signed_in' );

?>

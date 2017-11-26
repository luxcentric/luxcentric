<?php
/**
 * Created by PhpStorm.
 * User: gary
 * Date: 11/25/17
 * Time: 5:41 PM
 */

function lux_woocommerce_created_customer( $customer_id, $new_customer_data, $password_generated ) {
	$first = get_user_meta( $customer_id, 'first_name', true );
	$last  = get_user_meta( $customer_id, 'last_name', true );
	$email = $new_customer_data['user_email'];

	$zohoApiToken = get_option( 'pp_wczcp_zoho_api_token' );
	if ( empty( $zohoApiToken ) ) {
		return;
	}

	$apiUrl = get_option( 'pp_wczcp_zoho_host',
			'https://crm.zoho.com' ) . '/crm/private/xml/Contacts/insertRecords';

	$post_body = '<Contacts><row no="1">';
	$post_body .= "<FL val=\"First Name\">$first</FL>";
	$post_body .= "<FL val=\"Last Name\">$last</FL>";
	$post_body .= "<FL val=\"Email\">$email</FL>";
	$post_body .= '<FL val="Lead Source">Registration</FL>';
	$post_body .= '<FL val="Account Name">Lux-Member</FL>';
	$post_body .= '</row></Contacts>';

	$params = array(
		'authtoken'      => $zohoApiToken,
		'scope'          => 'crmapi',
		'duplicateCheck' => 1,
		'xmlData'        => $post_body
	);

	$response = wp_remote_post( $apiUrl, array( 'body' => $params ) );
	// if ( is_wp_error( $response ) ) {
	//  $error_message = $response->get_error_message();
	//  echo "Something went wrong: $error_message";
	// } else {
	//  echo 'Response:<pre>';
	//  print_r( $response );
	//  echo '</pre>';
	// }
}

add_action( 'woocommerce_created_customer', 'lux_woocommerce_created_customer', 20, 3 );

?>

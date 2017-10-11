<?php
/**
 * Plugin Name: Luxcentric Site Plugin
 * Plugin URI: https://luxcentric.com/
 * Description: Custom code for luxcentric website.
 * Version: 1.0.3
 * Author: Gary Ritchie
 * Requires at least: 4.7
 * Tested up to: 4.8.2
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

// Show text only if user is not signed in
function lx_not_signed_in( $atts, $content = null ) {
    if (is_user_logged_in()) {
        return "";
    } else {
        return $content;
    }
}
add_shortcode( 'lx_not_signed_in', 'lx_not_signed_in' );

// modified version of class-sensei-course.php, private function
// Sensei_Course::add_course_access_permission_message
function lx_add_course_access_permission_message( $message )
{
    global $post;
    if ( Sensei()->settings->get('access_permission') ) {
        $message = apply_filters( 'sensei_couse_access_permission_message', $message, $post->ID );
        if (!empty($message)) {
            Sensei()->notices->add_notice($message, 'info');
        }
    }
}

// determine if we should use luxcentric_course_prefix instead
// of Sensei_Course::the_course_enrolment_actions
function luxcentric_use_custom_enrolment_actions() {
    global $post;

    if ( 'course' != $post->post_type ) {
        return FALSE;
    }

    if ( is_user_logged_in() ) {
        return FALSE;
    }

    if ( Sensei_WC::is_woocommerce_active() && Sensei_WC::is_course_purchasable( $post->ID ) ) {
        return FALSE;
    }
    return TRUE;
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
    if( get_option( 'users_can_register') ) {

        // show the registration form
        echo do_shortcode( '[woocommerce_simple_registration]' );
    } // end if user can register

    echo do_shortcode( '[woocommerce_my_account]' );
    ?>
    </section><?php

}// end luxcentric_course_prefix

function lux_current_url() {
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));
    return $current_url;
}

/**
 * Process the registration form. Modified version of WC_Form_Handler version
 */
function lux_process_registration() {
    $nonce_value = isset( $_POST['_wpnonce'] ) ? $_POST['_wpnonce'] : '';
    $nonce_value = isset( $_POST['woocommerce-register-nonce'] ) ? $_POST['woocommerce-register-nonce'] : $nonce_value;

    if ( ! empty( $_POST['register'] ) && wp_verify_nonce( $nonce_value, 'woocommerce-register' ) ) {
        $username = 'no' === get_option( 'woocommerce_registration_generate_username' ) ? $_POST['username'] : '';
        $password = 'no' === get_option( 'woocommerce_registration_generate_password' ) ? $_POST['password'] : '';
        $email    = $_POST['email'];

        try {
            $validation_error = new WP_Error();
            $validation_error = apply_filters( 'woocommerce_process_registration_errors', $validation_error, $username, $password, $email );

            if ( $validation_error->get_error_code() ) {
                throw new Exception( $validation_error->get_error_message() );
            }

            // Anti-spam trap
            if ( ! empty( $_POST['email_2'] ) ) {
                throw new Exception( __( 'Anti-spam field was filled in.', 'woocommerce' ) );
            }

            $new_customer = wc_create_new_customer( sanitize_email( $email ), wc_clean( $username ), $password );

            if ( is_wp_error( $new_customer ) ) {
                throw new Exception( $new_customer->get_error_message() );
            }

            if ( apply_filters( 'woocommerce_registration_auth_new_customer', true, $new_customer ) ) {
                wc_set_customer_auth_cookie( $new_customer );
            }

            // allow redirect to same page using same logic as login
            if ( ! empty( $_POST['redirect'] ) ) {
                $redirect = $_POST['redirect'];
            } elseif ( wc_get_raw_referer() ) {
                $redirect = wc_get_raw_referer();
            } else {
                $redirect = wc_get_page_permalink( 'myaccount' );
            }
            wp_redirect( wp_validate_redirect( apply_filters( 'woocommerce_registration_redirect', $redirect ), wc_get_page_permalink( 'myaccount' ) ) );
            exit;

        } catch ( Exception $e ) {
            wc_add_notice( '<strong>' . __( 'Error:', 'woocommerce' ) . '</strong> ' . $e->getMessage(), 'error' );
        }
    }
}
add_action( 'wp_loaded', 'lux_process_registration', 19 );

function lux_woocommerce_created_customer( $customer_id, $new_customer_data, $password_generated ) {
  $first = get_user_meta( $customer_id, 'first_name', true);
  $last = get_user_meta( $customer_id, 'last_name', true);
  $email = $new_customer_data['user_email'];

  $zohoApiToken = get_option('pp_wczcp_zoho_api_token');
  if (empty($zohoApiToken))
    return;

   $apiUrl = get_option('pp_wczcp_zoho_host',
       'https://crm.zoho.com').'/crm/private/xml/Contacts/insertRecords';

  $post_body = '<Contacts><row no="1">';
  $post_body .= "<FL val=\"First Name\">$first</FL>";
  $post_body .= "<FL val=\"Last Name\">$last</FL>";
  $post_body .= "<FL val=\"Email\">$email</FL>";
  $post_body .= '<FL val="Lead Source">Registration</FL>';
  $post_body .= '</row></Contacts>';

  $params = array(
    'authtoken' => $zohoApiToken,
    'scope' => 'crmapi',
    'duplicateCheck' => 1,
    'xmlData' => $post_body
  );

  $response = wp_remote_post( $apiUrl, array('body' => $params));
  // if ( is_wp_error( $response ) ) {
  //   $error_message = $response->get_error_message();
  //   echo "Something went wrong: $error_message";
  // } else {
  //   echo 'Response:<pre>';
  //   print_r( $response );
  //   echo '</pre>';
  // }
};

add_action( 'woocommerce_created_customer', 'lux_woocommerce_created_customer', 20, 3 );

?>

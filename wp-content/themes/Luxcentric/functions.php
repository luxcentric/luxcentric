<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );
require_once( 'library/social_media_widget.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

// Include shortcodes
include 'shortcodes.php';

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style();

  // let's get language support going, if you need it
  //load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  //require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/*
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722

  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162

  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');

  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

  register_sidebar(array(
    'id' => 'sidebar2',
    'name' => __( 'Header Sidebar', 'bonestheme' ),
    'description' => __( 'Header sidebar.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar3',
    'name' => __( 'Footer Sidebar', 'bonestheme' ),
    'description' => __( 'Footer sidebar.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'sidebar4',
    'name' => __( 'Social Share', 'bonestheme' ),
    'description' => __( 'Social Share sidebar.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', '//fonts.googleapis.com/css?family=Montserrat:400,700');
}
add_action('wp_enqueue_scripts', 'bones_fonts');


/**
 * Remove empty paragraphs created by wpautop()
 * @author Ryan Hamilton
 * @link https://gist.github.com/Fantikerz/5557617
 */
function remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
    return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);

// clean up formatting in shortcodes
function snix_clean_shortcodes($content) {
  $array = array (
    '<p>[' => '[',
    ']</p>' => ']',
    ']<br />' => ']'
  );

  $content = strtr($content, $array);
  return $content;
}
add_filter('the_content', 'snix_clean_shortcodes');

// Add php to text widget
add_filter('widget_text','execute_php',100);
function execute_php($html) {
  if (strpos($html,"<"."?php") !== false) {
    ob_start();
    eval("?".">".$html);
    $html = ob_get_contents();
    ob_end_clean();
  }
  return $html;
}

/* Change Excerpt length */
function new_excerpt_length($length) {
    return 75;
}
add_filter('excerpt_length', 'new_excerpt_length');

/* add searchbox to main menu */
add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
    if ( $args->theme_location == 'main-nav' ) {
      ob_start();
      dynamic_sidebar('sidebar2');
      $sidebar = ob_get_contents();
      ob_end_clean();

      return $items . '<li id="menu-item-search">' . $sidebar . '</li>';
    }

    return $items;
}

/*Add LoginOut in Footer Menu */
/*add_filter( 'wp_nav_menu_items', 'add_loginout_footerlink', 10, 2 );
function add_loginout_footerlink( $items, $args ) {
  if (is_user_logged_in() && $args->theme_location == 'footer-links') {
      $newitems =  $items . '<li id="menu-item-12" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12"><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">My Account</a></li>'
      . '<li id="menu-item-13" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-13"><a href="'. wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) .'">Logout</a></li>';
      $items = $newitems;
  }
  elseif (!is_user_logged_in() && $args->theme_location == 'footer-links') {
      $newitems = $items . '<li id="menu-item-10" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10"><a href="' . get_permalink( get_page_by_path( 'membership-info' ) ) . '">Sign Up</a></li>'
      . '<li id="menu-item-11" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-11"><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">Login</a></li>';
      $items = $newitems;
  }
  return $items;
}*/

/*************************/
/** woocommerce section **/
/*************************/

/*Add LoginOut in WooCommerce Menu */
add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
  if (is_user_logged_in() && $args->theme_location == 'woo-links') {
      $newitems = '<li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">MY ACCOUNT</a></li>'
      . '<li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="'. wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) .'">MEMBER LOG OUT</a></li>' . $items;
      $items = $newitems;
  }
  elseif (!is_user_logged_in() && $args->theme_location == 'woo-links') {
      $newitems = '<li id="menu-item-6" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6"><a href="' . get_permalink( get_page_by_path( 'membership-info' ) ) . '">SIGN UP</a></li>'
      . '<li id="menu-item-7" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7"><a href="' . get_permalink( wc_get_page_id( 'myaccount' ) ) . '">MEMBER SIGN IN</a></li>' . $items;
      $items = $newitems;
  }
  return $items;
}


remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/* woocommerce and woocommerce sensei wrapper */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

// hide "Your theme does not declare WooCommerce support" message
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// hide "Your theme does not declare Sensei support message
add_action( 'after_setup_theme', 'declare_sensei_support' );
function declare_sensei_support() {
    add_theme_support( 'sensei' );
}

global $woothemes_sensei;
remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );

add_action('sensei_before_main_content', 'my_theme_wrapper_start', 10);
add_action('sensei_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
  echo '<div id="content"><div id="inner-content" class="wrap cf"><main id="main" role="main"><article role="article"><section class="entry-content cf" itemprop="articleBody">';
}

function my_theme_wrapper_end() {
  echo '</section></article></main></div></div>';
}

/* remove woo add-to-cart button */
//function remove_loop_button(){
  //remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
  //remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
//}
//add_action('init','remove_loop_button');

/**
 * Removes coupon form, order notes, and several billing fields if the checkout doesn't require payment
 * Tutorial: http://skyver.ge/c
 */
function sv_free_checkout_fields() {

  // Bail we're not at checkout, or if we're at checkout but payment is needed
  if ( function_exists( 'is_checkout' ) && ( ! is_checkout() || ( is_checkout() && WC()->cart->needs_payment() ) ) ) {
    return;
  }

 // remove coupon forms since why would you want a coupon for a free cart??
  remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

   // Remove the "Additional Info" order notes
  add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

  // Unset the fields we don't want in a free checkout
  function unset_unwanted_checkout_fields( $fields ) {

    // add or remove billing fields you do not want
    // list of fields: http://docs.woothemes.com/document/tutorial-customising-checkout-fields-using-actions-and-filters/#section-2
    $billing_keys = array(
      'billing_company',
      'billing_phone',
      'billing_address_1',
      'billing_address_2',
      'billing_city',
      'billing_postcode',
      'billing_country',
      'billing_state',
    );

    // unset each of those unwanted fields
    foreach( $billing_keys as $key ) {
      unset( $fields['billing'][$key] );
    }

    return $fields;
  }
  add_filter( 'woocommerce_checkout_fields', 'unset_unwanted_checkout_fields' );

  // A tiny CSS tweak for the account fields; this is optional
  function print_custom_css() {
    echo '<style>.create-account { display: inline-block; margin: 1em 0; }</style>';
  }
  add_action( 'wp_head', 'print_custom_css' );
}
// free products cause billing fields to be hidden but they are still
// required so preventing checkout; until we figure out how to fix that,
// just show all fields
//add_action( 'wp', 'sv_free_checkout_fields' );

add_filter( 'default_checkout_billing_state', 'change_default_billing_checkout_state' );
function change_default_billing_checkout_state() {
  return 'WA'; // state code
}

/* add redirect to scheduler message to email */
add_action( 'woocommerce_email_before_order_table', 'add_order_email_instructions', 10, 2 );
function add_order_email_instructions( $order, $sent_to_admin ) {

  if ( ! $sent_to_admin ) {
    $items = $order->get_items();

    foreach ( $items as $item ) {
      $product_name = $item['name'];
      $product_id = $item['product_id'];

      if( has_term( 'tech-tackle', 'product_cat', $product_id ) ) {
        echo '<p><strong>Next Step:</strong> Please <a class="calendly" href="http://http://50.87.234.135/schedule-tech-tackle/" alt="Schedule Tech Tackle">Click Here</a> to schedule an appointment for ' . $product_name . '.</p>';
      } elseif( has_term( 'brain-access', 'product_cat', $product_id ) ) {
        echo '<p><strong>Next Step:</strong> Please <a class="calendly" href="http://50.87.234.135/schedule-brain-access/" alt="Schedule Brain Access">Click Here</a> to schedule an appointment for ' . $product_name . '.</p>';
      }
    }
  }
}

/**
 * Redirect users after Membership add to cart.
 */
function my_membership_add_to_cart_redirect( $url ) {

  if ( ! isset( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
    return $url;
  }

  $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );

  // Only redirect on products that have the 'membership' category
  if ( has_term( 'membership', 'product_cat', $product_id ) ) {
    $url = wc_get_checkout_url();
  }

  return $url;

}
/* add_filter( 'woocommerce_add_to_cart_redirect', 'my_membership_add_to_cart_redirect' ); */

function my_custom_my_account_menu_items( $items ) {
    $items = array(
        'dashboard'         => __( 'My Account', 'woocommerce' ),
        'orders'            => __( 'Orders', 'woocommerce' ),
        'downloads'       => __( 'Downloads', 'woocommerce' ),
        'edit-address'    => __( 'Addresses', 'woocommerce' ),
        'edit-account'      => __( 'Account Details', 'woocommerce' ),
        'customer-logout'   => __( 'Logout', 'woocommerce' ),
    );

    return $items;
}

add_filter( 'woocommerce_account_menu_items', 'my_custom_my_account_menu_items' );

// This was messing up display of more than 2 products on a page.
// https://github.com/luxcentric/luxcentric/issues/71
//add_action( 'woocommerce_after_shop_loop_item', 'show_product_excerpt' );
//function show_product_excerpt() {
//    echo '<div id="product-details" style="display: none;">';
//      the_excerpt();
//    echo '</div>';
//}

// display course thumbnail before course title
if ( function_exists( 'Sensei' ) ) {
    remove_action('sensei_course_content_inside_before', array( Sensei()->course, 'course_image' ) ,10, 1 );
    add_action('sensei_course_content_inside_before', array( Sensei()->course, 'course_image' ) ,3, 1 );
}

/* tribe events calendar */
// Singular
add_filter( 'tribe_event_label_singular', 'event_display_name' );
function event_display_name() {
  return 'Workshop';
}
add_filter( 'tribe_event_label_singular_lowercase', 'event_display_name_lowercase' );
function event_display_name_lowercase() {
  return 'workshop';
}

// Plural
add_filter( 'tribe_event_label_plural', 'event_display_name_plural' );
function event_display_name_plural() {
  return 'Workshops';
}
add_filter( 'tribe_event_label_plural_lowercase', 'event_display_name_plural_lowercase' );
function event_display_name_plural_lowercase() {
  return 'workshops';
}

// add svg image support
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/* check if user using smaller mobile device */
function my_wp_is_mobile() {
  include_once ( get_template_directory() . '/Mobile_Detect.php');
  $detect = new Mobile_Detect;
  if( $detect->isMobile() && !$detect->isTablet() ) {
    return true;
  } else {
    return false;
  }
}
/* check if user using tablet device */
function my_wp_is_tablet() {
  include_once ( get_template_directory() . '/Mobile_Detect.php');
  $detect = new Mobile_Detect;
  if( $detect->isTablet() ) {
    return true;
  } else {
    return false;
  }
}

function add_is_mobile_bodyclass($classes) {
  //adds a class of "wp_is_mobile" to the body class of the page
  if (wp_is_mobile()) {
    $classes[] = 'wp_is_mobile';
  }
  return $classes;
}
add_filter('body_class','add_is_mobile_bodyclass');

// don't show related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/* DON'T DELETE THIS CLOSING TAG */ ?>

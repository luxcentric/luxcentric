<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(' | '); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

<!--Zoho  Web-Optin Form Starts Here-->
<link href="https://campaigns.zoho.com/css/ui.theme.css" rel="stylesheet" type="text/css" />
<link href="https://campaigns.zoho.com/css/ui.datepicker.css" rel="stylesheet" type="text/css" />
<link href="https://campaigns.zoho.com/css/ui.core.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://campaigns.zoho.com/js/jquery-1.11.0.min.js"></script>
<script type='text/javascript' src='https://campaigns.zoho.com/js/jquery-migrate-1.2.1.min.js'></script>
<script type="text/javascript" src='https://campaigns.zoho.com/js/ui.datepicker.js'  charset="utf-8"></script>
<script type="text/javascript" src="https://campaigns.zoho.com/js/jquery.form.js"></script>
<script type="text/javascript" src="https://campaigns.zoho.com/js/optin_min.js"></script>
<script type="text/javascript">
var $ZC = jQuery.noConflict();
var trackingText='ZCFORMVIEW';
$ZC(document).ready( function($) {
$ZC("#zc_trackCode").val(trackingText);
	$ZC("#fieldBorder").val($ZC("[changeItem='SIGNUP_FORM_FIELD']").css("border-color"));
	_setOptin(false,function(th){
	/*Before submit, if you want to trigger your event, "include your code here"*/
});

/*Load Captcha For this*/ 
 loadCaptcha('https://campaigns.zoho.com/campaigns/CaptchaVerify.zc?mode=generate');

 /*Tracking Enabled*/ 
 trackSignupEvent(trackingText);
 });
</script>

	</head>

	<body <?php body_class(); ?>>

		<div id="container">			

			<header class="header" role="banner">

				<div id="top-bar-wrapper">
					<div id="top-bar-pattern">&nbsp;</div>
					<div id="top-bar" class="wrap">
						<div id="sidebar2" class="sidebar">
							<?php bones_woo_links(); ?>

							<?php if (is_active_sidebar('sidebar2')) :
								dynamic_sidebar('sidebar2');
							endif; ?>
						</div>
					</div>
				</div>

				<div id="inner-header" class="wrap cf">

					<div id="nav-wrapper">
						<div id="logo" class="h1">
							<a href="<?php echo home_url(); ?>" rel="nofollow">
								<img src="<?php echo get_template_directory_uri(); ?>/library/images/logo.png" alt="Luxcentric" />
							</a>
						</div>

						<nav id="main-menu" role="navigation">
							<?php bones_main_nav(); ?>
						</nav>
					</div>
						
					<div class="cf"></div>
					<hr class="white" />

				</div>

			</header>

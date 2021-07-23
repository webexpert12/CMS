<?php		
	$default_logo = SMARTSite_PATH_LoginLogo_URL.'inc/img/wordpress-logo.svg';
	$siteoption = get_option('SMARTSite_settings_branding');

	$wordPress_essentials_custom_logo_url = $siteoption['pk_wp_login_logo'] ? $siteoption['pk_wp_login_logo'] : $default_logo ;		
	$wordPress_essentials_custom_background_url = $siteoption['pk_wp_image_background'];
	$wordPress_essentials_background_overlay = $siteoption['pk_dashboard_background_overlay'];
	$form_label_color = $siteoption['pk_form_label_color'] ? $siteoption['pk_form_label_color'] : "#333";
	$form_button_color = $siteoption['pk_form_button_color'] ? $siteoption['pk_form_button_color'] : "#007cba";
	$background_full_screen = $siteoption['pk_background_full_screen'] ? 'cover' : 'contain';

	
	
echo '<style type="text/css">
		.login h1 a {
			background-image:url('.$wordPress_essentials_custom_logo_url.' ) !important;
		}

		#login label{
			color: '.$form_label_color.' !important;
		}

		#login label{
			color: '.$form_label_color.' !important;
		}

		#login .button-primary {
			background: '.$form_button_color.';
			border-color: '.$form_button_color.';
		}

		body {  
			background-image: url('.$wordPress_essentials_custom_background_url.');
			background-repeat: no-repeat;
			background-position: center center;
			background-size: '.$background_full_screen.'; 
		}

		.login:before { 
			position: absolute;
			content: "";
			background: '.$wordPress_essentials_background_overlay.';
			width: 100%;
			height: 100%;
			z-index: -1; 
			opacity:0.8;
		}
</style>';
?>
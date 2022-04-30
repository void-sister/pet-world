<?php
//Class definition: Privacy Class
if( !class_exists( 'dttheme_privacy_class' ) ) {

	class dttheme_privacy_class {

		function __construct() {

			// hook privacy message into commentform
			$privacy_cmdfrm = petsworld_option('privacy','enable-commentfrm-msg');
			if( isset( $privacy_cmdfrm ) ) {
				add_filter( 'preprocess_comment', array( $this, 'dttheme_privacy_verify_comment_checkbox' )  );
			}

			// hook privacy message into mailchimpform
			$privacy_mcfrm = petsworld_option('privacy','enable-mailchimpfrm-msg');
			if( isset( $privacy_mcfrm ) ) {
				add_filter( 'dt_sc_mailchimp_form_elements', array( $this, 'dttheme_privacy_mailchimp_checkbox' ) , 10 , 2 );
			}
			
			// hook privacy message into login/registration forms
			$privacy_loginfrm = petsworld_option('privacy','enable-loginfrm-msg');
			if( isset( $privacy_loginfrm ) ) {
				add_action( 'login_form', array( $this, 'dttheme_privacy_login_extra' ) , 10 , 2 );
				add_action( 'woocommerce_login_form', array( $this, 'dttheme_privacy_login_extra' ) , 10 , 2 );
				add_filter( 'wp_authenticate_user', array( $this,'dttheme_authenticate_user_acc' ), 99999, 2);
			}

			add_action( 'wp_enqueue_scripts', array( $this, 'dttheme_footer_script' ) , 1000 );

			add_action( 'wp_footer', array( $this, 'dttheme_print_tracking_code' ), 100 );
		}

		/* ---------------------------------------------------------------------------
		 *	Creates the checkbox html to the comment form
		 * --------------------------------------------------------------------------- */
		function dttheme_privacy_comment_checkbox_content( $content = "", $extra_class = "" ) {

			if( empty($content) ) $content = do_shortcode( petsworld_option('privacy', 'commentfrm-msg') );

			$output = '<p class="comment-form-dt-privatepolicy '.$extra_class.'">
						<input id="comment-form-dt-privatepolicy" name="comment-form-dt-privatepolicy" type="checkbox" value="yes">
						<label for="comment-form-dt-privatepolicy">'.$content.'</label>
					  </p>';

			return $output;
		}

		/* ---------------------------------------------------------------------------
		 *	Checks if the user accepted the privacy policy in comment form
		 * --------------------------------------------------------------------------- */
		function dttheme_privacy_verify_comment_checkbox( $commentdata ) {

			$post_type = get_post_type($_POST['comment_post_ID']);

			if($post_type!= 'product'){

				if ( ! is_user_logged_in() && ! isset( $_POST['comment-form-dt-privatepolicy'] ) ) {
					$error_message = apply_filters( 'dttheme_privacy_comment_checkbox_error_message', __( 'Error: You must agree to our privacy policy to comment on this site...' , 'petsworld-core' ) );
					wp_die( $error_message );
				}
			}

		    return $commentdata;
		}

		/* ---------------------------------------------------------------------------
		 *	Checks if the user accepted the privacy policy in mailchimp form
		 * --------------------------------------------------------------------------- */
		function dttheme_privacy_mailchimp_checkbox( $content = "", $attrs ) {

			if( empty($content) ) $content = do_shortcode( petsworld_option('privacy', 'mailchimpfrm-msg') );

			$output = '<div class="dt-privacy-wrapper">';
				$output .= '<input name="dt_mc_privacy" id="dt_mc_privacy" value="true" type="checkbox" checked required="required"><label for="dt_mc_privacy">'.$content.'</label>';
			$output .= '</div>';

			return $output;
		}
		
		/* ---------------------------------------------------------------------------
		 *	Checks if the user accepted the privacy policy in login form
		 * --------------------------------------------------------------------------- */
		function dttheme_privacy_login_extra( $form ) {

			$content = do_shortcode( petsworld_option('privacy', 'loginfrm-msg') );
			echo ( $this->dttheme_privacy_comment_checkbox_content( $content , 'forgetmenot') );
		}

		/* ---------------------------------------------------------------------------
		 *	Authenticate the extra checkbox in the user login screen
		 * --------------------------------------------------------------------------- */
		function dttheme_authenticate_user_acc( $user, $password ) {

			// See if the checkbox #login_accept was checked
		    if ( isset( $_REQUEST['comment-form-dt-privatepolicy'] ) ) {
		        // Checkbox on, allow login
		        return $user;
		    } else {
		        // Did NOT check the box, do not allow login
		        $error = new WP_Error();
		        $error->add('did_not_accept', __( 'You must acknowledge and agree to the privacy policy' , 'petsworld-core'));
		        return $error;
		    }
		}

		/* ---------------------------------------------------------------------------
		 *	Javascript that gets appended to pages that got a privacy shortcode toggle
		 * --------------------------------------------------------------------------- */
		function dttheme_footer_script() {

			wp_add_inline_script( 'jq-cookie-js', "function dt_privacy_cookie_setter( cookie_name ) {
				
			var toggle = jQuery('.' + cookie_name);
			toggle.each(function()
			{
				if(document.cookie.match(cookie_name)) this.checked = false;
			});

			jQuery('.' + 'dt-switch-' + cookie_name).each(function()
			{
				this.className += ' active ';
			});

			toggle.on('click', function() {
				if(this.checked) {
					document.cookie = cookie_name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
				}
				else {
					var theDate = new Date();
					var oneYearLater = new Date( theDate.getTime() + 31536000000 );
					document.cookie = cookie_name + '=true; Path=/; Expires='+oneYearLater.toGMTString()+';';
				}
			});
			};
			dt_privacy_cookie_setter('dtPrivacyGoogleTrackingDisabled');
			dt_privacy_cookie_setter('dtPrivacyGoogleWebfontsDisabled');
			dt_privacy_cookie_setter('dtPrivacyGoogleMapsDisabled');
			dt_privacy_cookie_setter('dtPrivacyVideoEmbedsDisabled'); " );
		}


		/* ---------------------------------------------------------------------------
		 *	Print Tracking Code
		 * --------------------------------------------------------------------------- */
		function dttheme_print_tracking_code() {

			$temp = petsworld_option('pageoptions', 'tracking-code');

			$tracking_code = "<!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src='https://www.googletagmanager.com/gtag/js?id=".$temp."'></script>
			<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '".$temp."', { 'anonymize_ip': true });
			</script>";
			
			$enable_code = petsworld_option('pageoptions', 'enable-tracking-code');

			if( !empty( $temp ) && isset( $enable_code ) ) {
				//extract UA ID from code
				$UAID = false;
				$extra_code = "";
				preg_match("!UA-[0-9]+-[0-9]+!", $tracking_code, $match);

				if(!empty($match) && isset($match[0])) $UAID = $match[0];

				//if we got a valid uaid, add the js cookie check 
				if($UAID){
				$extra_code = "
				<script>
				if(document.cookie.match(/dtPrivacyGoogleTrackingDisabled/)){ window['ga-disable-{$UAID}'] = true; }
				</script>";
				}

				echo ( ($extra_code . $tracking_code) );
			}
		}
	}
}

function dttheme_privacy_helper() {

	return new dttheme_privacy_class();
}
add_action('init', 'dttheme_privacy_helper', 20);


/* --------------------------------------------------------------------------------
 * Creates a modal window informing the user about the use of cookies on the site
 * Sets a cookie when the confirm button is clicked, and hides the box.
 * -------------------------------------------------------------------------------- */
if( ! function_exists( 'dttheme_cookie_consent' ) ) {

    function dttheme_cookie_consent() {

        $cookie_bar = petsworld_option('privacy','enable-cookie-msgbar');
		if( isset( $cookie_bar ) ) {

			$message  = petsworld_option('privacy','cookiebar-msg');
			$position = petsworld_option('privacy','cookiebar-position'); ?>

            <div class="dt-cookie-consent cookiebar-hidden dt-cookiemessage-<?php echo esc_attr($position); ?>">
	            <div class="container">
    		        <p class="dt_cookie_text"><?php echo do_shortcode($message); ?></p><?php

					$cookie_contents = $message;
					$cookie_contents = md5($cookie_contents);

					$buttons = petsworld_option('privacy-bar');
					$i = 0;
					$extra_info = "";

					if( empty( $buttons ) ):
						?><a href="#" class="dt-sc-button filled small dt-cookie-consent-button dt-cookie-close-bar" data-contents="<?php echo esc_attr($cookie_contents); ?>"><?php esc_html_e('OK', 'petsworld-core'); ?></a><?php
					endif;

					if( !empty( $buttons ) ):
						foreach($buttons as $button) {
							$i++;
							$data  = "";
							$btn_class = "dt-extra-cookie-btn";
							$label = !empty( $button['label'] ) ? $button['label'] : "×";
							$link  = !empty( $button['link'] ) && $button['action'] == 'link' ? $button['link'] : "#";

							if( empty( $button['action'] ) ) {
								$btn_class = " dt-cookie-close-bar ";
								$data = "data-contents='{$cookie_contents}'";
							} elseif( $button['action'] == 'info_modal' ) {
								$link .= 'dt-consent-extra-info';
							}
	
							if( !empty( $button['action'] ) && $button['action'] == 'info_modal' ) {
								$heading = __( "Cookie and Privacy Settings", 'petsworld-core' );
								$contents = array(
	
											array(	'label'		=> __( 'How we use cookies', 'petsworld-core' ) , 
													'content'	=> __( 'We may request cookies to be set on your device. We use cookies to let us know when you visit our websites, how you interact with us, to enrich your user experience, and to customize your relationship with our website. <br><br>Click on the different category headings to find out more. You can also change some of your preferences. Note that blocking some types of cookies may impact your experience on our websites and the services we are able to offer.', 'petsworld-core' )),
	
											array(	'label'		=> __( 'Essential Website Cookies', 'petsworld-core' ), 
													'content'	=> __( 'These cookies are strictly necessary to provide you with services available through our website and to use some of its features. <br><br>Because these cookies are strictly necessary to deliver the website, you cannot refuse them without impacting how our site functions. You can block or delete them by changing your browser settings and force blocking all cookies on this website.', 'petsworld-core' )),
	
								);


								$analtics_check = petsworld_option('pageoptions','tracking-code');
								
								if(!empty( $analtics_check ) ) {
									$contents[] = array(	'label'		=> __( 'Google Analytics Cookies', 'petsworld-core' ), 
															'content'	=> __( 'These cookies collect information that is used either in aggregate form to help us understand how our website is being used or how effective our marketing campaigns are, or to help us customize our website and application for you in order to enhance your experience. <br><br>If you do not want that we track your visist to our site you can disable tracking in your browser here: [dt_sc_privacy_google_tracking]', 'petsworld-core' ));
								}
	
								$contents[] = array(	'label'		=> __( 'Other external services', 'petsworld-core' ), 
														'content'	=> __( 'We also use different external services like Google Webfonts, Google Maps and external Video providers. Since these providers may collect personal data like your IP address we allow you to block them here. Please be aware that this might heavily reduce the functionality and appearance of our site. Changes will take effect once you reload the page.<br><br>

				Google Webfont Settings:					
				[dt_sc_privacy_google_webfonts]

				Google Map Settings:
				[dt_sc_privacy_google_maps]

				Vimeo and Youtube video embeds:
				[dt_sc_privacy_video_embeds]', 'petsworld-core' )
								);

								$wp_privacy_page = get_option('wp_page_for_privacy_policy');
								
								if( !empty( $wp_privacy_page ) ) {
									$contents[] = array(	'label'		=> __( 'Privacy Policy', 'petsworld-core' ), 
															'content'	=> __( 'You can read about our cookies and privacy settings in detail on our Privacy Policy Page. <br><br> [dt_sc_privacy_link]', 'petsworld-core' ));
								}
								
								$custom_model = petsworld_option('privacy','enable-custom-model');
								if( isset( $custom_model ) ) {
									$contents = petsworld_option('privacy-model');
									$heading  = str_replace("'", "&apos;", petsworld_option('privacy', 'custom-model-title'));
								}

								$content  = "";



								if( !empty( $contents ) ) {
								
								foreach($contents as $content_block ) {

									$content .= '[dt_sc_tab title="'.$content_block['label'].'"]';
										$content .= $content_block['content'];
									$content .= '[/dt_sc_tab]';

								}
								
								}

								$btn_class .= " dt-cookie-info-btn ";
								$extra_info = "<div id='dt-consent-extra-info' class='dt-inline-modal main_color zoom-anim-dialog mfp-hide'>".do_shortcode("

									<h4>{$heading}</h4>

									[dt_sc_tabs type='vertical']
										{$content}
									[/dt_sc_tabs]
								")."</div>";

								
							}
	
							echo "<a href='{$link}' class='dt-sc-button filled small dt-cookie-consent-button dt-cookie-consent-button-{$i} {$btn_class}' {$data}>{$label}</a>";
						}
					endif;?>
                </div>
            </div><?php

		    echo do_shortcode($extra_info);
        }
    }
    add_action('wp_footer', 'dttheme_cookie_consent', 3);
}
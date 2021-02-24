<?php
/**
 * Plugin Name: URC Vignette
 * Description: Show subscribe form
 * Version: 1.0
 * Author: Jake Almeda
 * Author URI: http://smarterwebpackages.com/
 * Network: true
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class URCVignetteJavaScripts {


	private $ctimer_expiry = 2, // in minutes
			$cookie_name = 'urc_viggy';


	// handle the session
	public function urc_viggy_session() {

		//global $_COOKIE;

		//$ctimer_start = time();
		$ct_expiry = ( time() + ( $this->ctimer_expiry * 60 ) ); // minutes

	    if( !isset( $_COOKIE[ $this->cookie_name ] ) ) {

	    	// set initial value of the cookie to 1 - indication that the pop-up needs to show
	    	setcookie( $this->cookie_name, 1, $ct_expiry, '/' );

	    } else {

	    	/* ----------------------
	    	 * edit the cookie value
	    	 * we change the value to tell JS that PHP will not trigger the pop-up anymore
	    	 * JS will now utilize its randomizer to decide when to show the pop-up window again
	    	 * ------------------- */
			setcookie( $this->cookie_name, 2, $ct_expiry, '/');

	    }

	}


	// JS | last arg is true - will be placed before </body>
	public function urc_vignette_enqueue_scripts() {

		global $_COOKIE;
		// check if cookie exists
		if( isset( $_COOKIE[ $this->cookie_name ] ) ) {
			// get value
			$pop_cookie = $_COOKIE[ $this->cookie_name ];
		} else {
			// cookie doesn't exist, add a counter not to show the pop-up window
			$pop_cookie = 2;
		}

		/*$script_name = 'urc_vignette_js';

	    // last arg is true - will be placed before </body>
	    wp_register_script( $script_name, plugin_dir_url( __FILE__ ).'js/asset.js', array( 'jquery' ), '1.0.0.0', TRUE );
	    
	    // Localize the script with new data
	    $ajax_files = array(
	        'urc_vignette_cookie' 		=> 		$pop_cookie,
	    );
	    wp_localize_script( $script_name, 'urc_vignette', $ajax_files );
	     
	    // Enqueued script with localized data.
	    wp_enqueue_script( $script_name );
	    */

		// enqueue styles
		wp_enqueue_style( 'urc_vignette_css', plugin_dir_url( __FILE__ ).'css/style.css' );

	}


	// Subcribe form
	private function urc_get_full_subscribe_form() {

		if( function_exists( 'setup_original_subscribe' ) ) {

			return setup_original_subscribe();

		} else {

			return '<div class="group mailchimp-subscribe">
				<div class="item-subscribe cta-subscribe">
				<div class="pretitle"><span class="fontsize-xsml">For A</span> <span class="fontsize-sml">LIMITED TIME ONLY</span><br><span class="fontsize-xsml">Get </span> <span class="fontsize-sml">FREE</span> <span class="fontsize-xsml">Copies Of My</span></div>
				<div class="photo"></div>
				<div class="title"><span class="fontsize-med">Enter Your Name &amp; Email Below for Instant Access:</span></div>

					<!-- Begin Mailchimp Signup Form -->
					<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
					<style type="text/css">
					#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
					/* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
					We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
					</style>
					<div id="mc_embed_signup">
					<form action="https://understandingrelationships.us2.list-manage.com/subscribe/post?u=8fcb0ea8d36b15793f40f7ee8&amp;id=0463614dd6" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="">
						<div id="mc_embed_signup_scroll">

						<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
						<div class="mc-field-group">
						<label for="mce-EMAIL">Email  <span class="asterisk">*</span>
						</label>
						<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						</div>
						<div class="mc-field-group">
						<label for="mce-FNAME">Name   <span class="asterisk">*</span>
						</label>
						<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
						</div>
						<div id="mce-responses" class="clear">
						<div class="response" id="mce-error-response" style="display:none"></div>
						<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8fcb0ea8d36b15793f40f7ee8_0463614dd6" tabindex="-1" value=""></div>
						<div class="clear formsubmit"><input type="submit" value="Instant Access" name="subscribe" id="mc-embedded-subscribe" class="button" onclick="return gtag_report_conversion(\'https://staging.understandingrelationships.com/members-section\')"></div>
						</div>
					</form>
					</div>

					<!--End mc_embed_signup-->

				<div class="disclaimer">Enter your name &amp; email in the boxes above to gain access to FREE Digital Online Versions of my popular eBooks &amp; audio course. When you click the “Instant Access” button, you will gain access to the members area of my website to read my eBooks, &amp; listen to the audio lessons right in your web browser! You’ll also get my best pickup, dating, relationship &amp; life success secrets &amp; strategies in my FREE newsletter. All information is 100% confidential. “Employ your time in improving yourself by other men’s writings, so that you shall gain easily what others have labored hard for.” ~ Socrates. “The man who doesn’t read good books has no advantage over the man who can’t read them.” ~ Mark Twain</div>
				</div>
				</div>';

		}

	}


	// actual pop-up form
	public function urc_vignette_popup_form() {

		?>
		<div class="popup-overlay">
			<!--Creates the popup content-->
			<div class="popup-content">

				<!--span class="close">&times;</span-->
				<?php echo $this->urc_get_full_subscribe_form(); ?>
				<input type="hidden" id="popup-counter" />
				<input type="hidden" id="popup-randomizer" />
				<button class="close">Close</button>

			</div>
		</div>
		<?php
		
	}

	/*public function show_me() {
		?><input type="text" id="popup-randomizer" /><?php
	}*/


	// Construct
	public function __construct() {

		// add the form in the document
		add_action( 'genesis_before_content', array( $this, 'urc_vignette_popup_form' ) );

		//add_action( 'genesis_after_header', array( $this, 'show_me' ) );

		// add cookie creation during init execution
		add_action( 'init', array( $this, 'urc_viggy_session' ) );

		// enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'urc_vignette_enqueue_scripts' ) );

	}

}
$z = new URCVignetteJavaScripts();

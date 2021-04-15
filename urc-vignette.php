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


	/*private $ctimer_expiry = 20, // in minutes
			$cookie_name = 'urc_viggy',
			$cookie_guide = 'hide', // show to show or whatever value to hide
			$cookie_val;
*/       

	// handle the session
	/*public function urc_viggy_session() {
		
		// set global variable to check what page we're in
		//global $post;
    	//$post_slug = $post->post_name;

		$current_url = explode( "/", $_SERVER['REQUEST_URI'] );
		$set_home = 0;
		$set_f_ebook = 0;

		//if ( is_front_page() && is_home() || is_front_page() || is_home() ) {
		if( empty( $current_url[ 1 ] ) ) {

			// HOME PAGE
			// set variable for jQuery
			$this->cookie_val = 2;

			// if statement guide
			if( $this->cookie_guide == 'show' ) {
				echo '<h3>HOMEPAGE - do not show</h3>';
			}

			$set_home = 0;

		} else {

			$set_home = 1;

		}

		if( $current_url[ 1 ] == 'free-ebook' ) {

		//if( $post->post_name == 'free-ebook' ) {
		//if( $current_url[ 1 ] == 'free-ebook' ) {

			// set variable for jQuery
			$this->cookie_val = 2;

			// if statement guide
			if( $this->cookie_guide == 'show' ) {
				echo '<h3>'.strtoupper( $current_url[ 1 ] ).'  - do not show</h3>';
			}

			$set_f_ebook = 0;
		} else {

			$set_f_ebook = 1;

		}

		// create cookies if not homepage and free-ebook
		if( $set_home == 1 && $set_f_ebook == 1 ) {

			$ct_expiry = ( time() + ( $this->ctimer_expiry * 60 ) ); // minutes

			if( !isset( $_COOKIE[ $this->cookie_name ] ) ) {

				$ctrigger = 1;

				// set initial value of the cookie to 1 - indication that the pop-up needs to show
				setcookie( $this->cookie_name, $ctrigger, $ct_expiry, '/' );

				// set variable for jQuery
				$this->cookie_val = $ctrigger;

				// if statement guide
				if( $this->cookie_guide == 'show' ) {
					echo '<h3>Not homepage - show</h3>';
				}

			} else {

				$ctrigger = 2;
*/
				/* ----------------------
				 * edit the cookie value
				 * we change the value to tell JS that PHP will not trigger the pop-up anymore
				 * JS will now utilize its randomizer to decide when to show the pop-up window again
				 * ------------------- */
/*				setcookie( $this->cookie_name, $ctrigger, $ct_expiry, '/' );

				// set variable for jQuery
				$this->cookie_val = $ctrigger;

				// if statement guide
				if( $this->cookie_guide == 'show' ) {
					echo '<h3>Not homepage - Do NOT show, cookie exists</h3>';
				}

			}

		}

	}*/


	// JS | last arg is true - will be placed before </body>
	public function urc_vignette_enqueue_scripts() {

		/*global $_COOKIE;
		// check if cookie exists
		if( isset( $_COOKIE[ $this->cookie_name ] ) ) {
			// get value
			$pop_cookie = $_COOKIE[ $this->cookie_name ];
		} else {
			// cookie doesn't exist, add a counter not to show the pop-up window
			//$pop_cookie = 1;
		}*/

		// set global variable to check what page we're in
		global $post;
    	//$post_slug = $post->post_name;

		$script_name = 'urc_vignette_js';

	    // last arg is true - will be placed before </body>
	    wp_register_script( $script_name, plugin_dir_url( __FILE__ ).'js/asset.js', array( 'jquery' ), '1.0.0.0', TRUE );
	    
	    // Localize the script with new data
	    $ajax_files = array(
	        //'urc_vignette_cookie' 		=> 		$this->cookie_val,
	        'urc_page'					=> $post->post_name,
	    );
	    wp_localize_script( $script_name, 'urc_vignette', $ajax_files );
	     
	    // Enqueued script with localized data.
	    wp_enqueue_script( $script_name );

		// enqueue styles
		wp_enqueue_style( 'urc_vignette_css', plugin_dir_url( __FILE__ ).'css/style.css' );

	}


	// Subcribe form
	private function urc_get_full_subscribe_form_viggy() {

		return '<div class="group mailchimp-subscribe">
			<div class="item-subscribe">
			<div class="pretitle"><span class="fontsize-xsml">For A</span> <span class="fontsize-sml">LIMITED TIME ONLY</span><br><span class="fontsize-xsml">Get </span> <span class="fontsize-sml">FREE</span> <span class="fontsize-xsml">Copies Of My</span></div>
			<div class="photo"></div>
			<div class="title hide-onmobile"><span class="fontsize-med">Enter Your Name &amp; Email Below for Instant Access:</span></div>

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

					<div class="indicates-required hide-onmobile"><span class="asterisk">*</span> indicates required</div>
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
					<div class="clear formsubmit"><input type="submit" value="Instant Access" name="subscribe" id="mc-embedded-subscribe" class="button" onclick="return gtag_report_conversion(\'https://understandingrelationships.com/members-section\')"></div>
					</div>
				</form>
				</div>

				<!--End mc_embed_signup-->

			<div class="disclaimer">Enter your name &amp; email in the boxes above to gain access to FREE Digital Online Versions of my popular eBooks &amp; audio course. When you click the “Instant Access” button, you will gain access to the members area of my website to read my eBooks, &amp; listen to the audio lessons right in your web browser!</div>
			</div>
			</div>';

	}


	// container for the pop up window
	public function urc_vignette_popup_form() {

		?>
		<div class="popup-overlay">

			<!--Creates the popup content-->
			<div class="popup-content center">

				<!--span class="close">&times;</span-->
				<a class="close" style="color:white;padding:0.5rem;background-color:black;display:block;">Close Ad</a>
				<div class="popup-form">
					<?php echo $this->urc_get_full_subscribe_form_viggy(); ?>
					<input type="hidden" id="popup-counter" />
					<!--input type="hidden" id="popup-randomizer" /-->
				</div>
				<a class="close" style="color:white;padding:0.5rem;background-color:black;display:block;">Close Ad</a>

			</div>
		</div>
		<?php
		
	}

	// for adding popup cover
	public function urc_popup_cover() {
		?><div class="popup-cover"><?php
			echo '<div class="close-btn"><img src="'.plugin_dir_url( __FILE__ ).'images/btn_close.png" border="0" /></div>';
		?></div><?php
	}


	// for development/validation purposes only
	public function show_me() {
		/*
		Counter:
		<input type="text" id="popup-counter" class="randon-inputs" />
		*/
		?><div class="item dateauthor">
		Randomizer:
		<input type="text" id="popup-randomizer" class="randon-inputs" />
		</div><?php
	}


	// Construct
	public function __construct() {

		// add the form in the document
		add_action( 'genesis_footer', array( $this, 'urc_vignette_popup_form' ) );

		// add the popup cover
		add_action( 'genesis_before', array( $this, 'urc_popup_cover' ) );

		// genesis_after_header
		add_action( 'genesis_before_sidebar_widget_area', array( $this, 'show_me' ) );

		// add cookie creation during init execution
		//add_action( 'init', array( $this, 'urc_viggy_session' ) );
		//add_action( 'template_redirect', array( $this, 'urc_viggy_session' ) ); // only use if using WP functions

		// enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'urc_vignette_enqueue_scripts' ), 2000 );

	}

}
$z = new URCVignetteJavaScripts();

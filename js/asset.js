(function($) {

	var DocTopLocation, PopUpCounter, //PopUpRandomizer,
//		CookiePopUp = urc_vignette.urc_vignette_cookie,
		PageSlug = urc_vignette.urc_page,
		TarWinScroll = $( document ).height() / 2,
//		MaxRandCount = 5, // randomizer will choose from 1 to MaxRandCount
//		TarRandCount = [ "2", "4" ]; // pop up will show if any of these are chosen by the randomizer
		MaxRandCount = 10,
		TarRandCount = 1;


	//appends an "active" class to .popup and .popup-content when the "Open" button is clicked
	/*$( ".open" ).on( "click", function() {
		$( ".popup-overlay, .popup-content" ).addClass( "active" );
	});*/


	// execute when document has finished loading
	$( document ).ready( function() {

		// choose a random number within the range
		$( "#popup-randomizer" ).val( Math.floor( Math.random() * MaxRandCount ) + 1 );

	});


	$( window ).scroll( function( event ) {

	    DocTopLocation = $( window ).scrollTop();
	    //WinBottom = DocTopLocation + WinHeight;

	    // Do something
	    if( DocTopLocation >= TarWinScroll ) {

	    	// get text field value
			PopUpCounter = $( "#popup-counter" ).val();

	    	// Prioritize pop up for Cookie
/*	    	if( CookiePopUp == 1 && PopUpCounter != 1 ) {

	    		TriggerViggyPopUp();

	    	} else {
*/
				if( PopUpCounter != 1 && PageSlug != 'free-ebook' ) {

					// check randomizer
					PopUpRandomizer = $( "#popup-randomizer" ).val();

					// inArray returns the location of the instance
					//if( $.inArray( PopUpRandomizer, TarRandCount ) > -1 ) {
					if( PopUpRandomizer == TarRandCount ) {
						
						TriggerViggyPopUp();

					}

				}

//			} // if( CookiePopUp == 1 ) {

	    }

	});


	// show the pop-up and related items
	function TriggerViggyPopUp() {

		//$( ".popup-overlay" ).css( "top", TarWinScroll );

		// show the pop up window
		$( ".popup-overlay, .popup-content" ).addClass( "active" );
		$( ".popup-cover" ).addClass( "activ" );

		// add counter
		$( "#popup-counter" ).val( "1" ); // show only once
		//$( "#popup-counter" ).val( "0" ); // show every refresh
		
		// disable scrolling
		$('body').addClass( 'stop-scrolling' );

	}


	// hide the pop-up and related items
	function TriggerViggyPopUpNot() {
		// hide the pop up window
		$( ".popup-overlay, .popup-content" ).removeClass( "active" );
		$( ".popup-cover" ).removeClass( "activ" );

		// enable scrolling
		$('body').removeClass( 'stop-scrolling' );
	}


	//removes the "active" class to .popup and .popup-content when the "Close" button is clicked 
	//$( ".close, .popup-overlay" ).on( "click", function() {
	$( ".close, .popup-cover, .close-btn" ).on( "click", function() {

		TriggerViggyPopUpNot();

	});


	$( ".popup-overlay" ).on( "click", function(e) {
		
		// Do nothing if .popup-overlay was not directly clicked
		// (elements inside the said DIV is clicked)
     	if(e.target !== e.currentTarget) return;

		TriggerViggyPopUpNot();

	});


	// close pop-up when ESC key is pressed
	$( document ).keydown( function( e ) {

	     if( e.key === "Escape" ) { // escape key maps to keycode `27`

	        TriggerViggyPopUpNot();

	    }

	});


	// listen to any anchor link clicks
	/*$( "a" ).on( "click", function( e ) {
		
		// save the actual url of the link
		TargetLink = $( this ).attr( 'href' );

		// show the pop up window
		$( ".popup-overlay, .popup-content" ).addClass( "active" );

		// stop the link from loading the page
		e.preventDefault();

	});*/


})( jQuery );
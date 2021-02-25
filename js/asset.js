(function($) {

	var DocTopLocation, PopUpCounter, PopUpRandomizer,
		CookiePopUp = urc_vignette.urc_vignette_cookie,
		TarWinScroll = 400,
		MaxRandCount = 5, // randomizer will choose from 1 to MaxRandCount
		TarRandCount = [ "2", "4" ]; // pop up will show if any of these are chosen by the randomizer
	
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
	    	if( CookiePopUp == 1 && PopUpCounter != 1 ) {

	    		TriggerViggyPopUp();

	    	} else {

				if( PopUpCounter != 1 ) {

					// check randomizer
					PopUpRandomizer = $( "#popup-randomizer" ).val();
					// inArray returns the location of the instance
					if( $.inArray( PopUpRandomizer, TarRandCount ) > -1 ) {
						/*
						// show the pop up window
						$( ".popup-overlay, .popup-content" ).addClass( "active" );

						// add counter
						$( "#popup-counter" ).val( "1" );
						
						// disable scrolling
						$('body').addClass( 'stop-scrolling' );
						*/
						TriggerViggyPopUp();
					}

				}

			} // if( CookiePopUp == 1 ) {

	    }

	});


	function TriggerViggyPopUp() {

		// show the pop up window
		$( ".popup-overlay, .popup-content" ).addClass( "active" );

		// add counter
		$( "#popup-counter" ).val( "1" );
		
		// disable scrolling
		$('body').addClass( 'stop-scrolling' );

	}


	//removes the "active" class to .popup and .popup-content when the "Close" button is clicked 
	//$( ".close, .popup-overlay" ).on( "click", function() {
	$( ".close" ).on( "click", function() {

		// hide the pop up window
		$( ".popup-overlay, .popup-content" ).removeClass( "active" );

		// enable scrolling
		$('body').removeClass( 'stop-scrolling' );

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
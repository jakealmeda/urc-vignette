(function($) {

	var DocTopLocation, //TargetLink, 
		DocHeight = $( document ).height(),
		//WinHeight = $( window ).height(),
		PopUpCounter, PopUpRandomizer,
		TarWinScroll = 400,
		MaxRandCount = 5,
		TarRandCount = [ "2", "4" ];
	
	//appends an "active" class to .popup and .popup-content when the "Open" button is clicked
	/*$( ".open" ).on( "click", function() {
		$( ".popup-overlay, .popup-content" ).addClass( "active" );
	});*/


	// execute when document has finished loading
	$( document ).ready( function() {

		$( "#popup-randomizer" ).val( Math.floor( Math.random() * MaxRandCount ) + 1 );

	});


	$( window ).scroll( function( event ) {

	    DocTopLocation = $( window ).scrollTop();
	    //WinBottom = DocTopLocation + WinHeight;

	    // Do something
	    if( DocTopLocation >= TarWinScroll ) {

	    	// get text field value
	    	PopUpCounter = $( "#popup-counter" ).val();
	    	//alert( 'JAKE: ' + $.inArray( $( "#popup-randomizer" ).val(), TarRandCount ) );
	    	if( PopUpCounter != 1 ) {

	    		// check randomizer
	    		PopUpRandomizer = $( "#popup-randomizer" ).val();
	    		if( $.inArray( PopUpRandomizer, TarRandCount ) > -1 ) {

			    	// show the pop up window
					$( ".popup-overlay, .popup-content" ).addClass( "active" );

					// add counter
					$( "#popup-counter" ).val( "1" );
					
					// disable scrolling
					$('body').addClass( 'stop-scrolling' );

				}

			}

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


	//removes the "active" class to .popup and .popup-content when the "Close" button is clicked 
	//$( ".close, .popup-overlay" ).on( "click", function() {
	$( ".close" ).on( "click", function() {

		// hide the pop up window
		$( ".popup-overlay, .popup-content" ).removeClass( "active" );

		// enable scrolling
		$('body').removeClass( 'stop-scrolling' );

	});  

})( jQuery );
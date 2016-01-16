jQuery( function ( $ ) {

	$( '.nav-primary .genesis-nav-menu' ).addClass( 'bg-menu' ).before( '<div class="bg-menu-icon"></div>' );

	$( '.bg-menu-icon' ).click( function () {
		$( this ).next( '.nav-primary .genesis-nav-menu' ).slideToggle();
	});
	
	$( '.bg-menu' ).on( 'click', '.menu-item', function ( event ) {
		if ( event.target !== this )
			return;
		$( this ).find( '.sub-menu:first' ).slideToggle( function () {
			$( this ).parent().toggleClass( 'menu-open' );
		});
	});

});
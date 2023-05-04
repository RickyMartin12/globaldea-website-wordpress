jQuery( document ).ready(
	function ( $ ) {
		$( document ).on( 'click', '.tg-infinite-scroll-button:not(.loading)', function () {
			var $this = $( this ),
			    page  = $this.attr( 'data-page' );
			$.ajax( {
				url        : colormagInfiniteScroll.ajaxUrl,
				method     : 'POST',
				data       : {
					page   : page,
					action : 'infinite_scroll_nonce',
					nonce  : colormagInfiniteScroll.nonce,
				},
				beforeSend : function () {
					$this.find( '.load-more-icon' ).removeClass( 'display' ).addClass( 'loader' );
				},
				error      : function ( xhr ) {
					console.warn( xhr.statusText + xhr.responseText );
				},
				success    : function ( response ) {
					if ( response == 0 ) {
						$( '.infinite-scroll' ).append( '<span class="no-more-post-text">No More Posts to Show</span>' );
						$this.slideUp( 0 );
					} else {
						$( '.tg-infinite-scroll-container' ).append( response );
						$this.find( '.load-more-icon' ).removeClass( 'loader' ).addClass( 'display' );
					}
				},
				complete   : function () {
					$this.attr( 'data-page', parseInt( page ) + 1 );
				}
			} );
		} );
	}
);

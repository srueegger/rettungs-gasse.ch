(function($) {
	'use strict';
	
	$('#testimonial-slider').on('slide.bs.carousel', function (e) {
		var $e = $(e.relatedTarget);
		var idx = $e.index();
		var itemsPerSlide = 3;
		var totalItems = $('.carousel-testimonial-item').length;
		if (idx >= totalItems-(itemsPerSlide-1)) {
			var it = itemsPerSlide - (totalItems - idx);
			for (var i=0; i<it; i++) {
				if (e.direction=="left") {
					$('.carousel-testimonial-item').eq(i).appendTo('.carousel-inner-testimonial');
				} else {
					$('.carousel-testimonial-item').eq(0).appendTo('.carousel-inner-testimonial');
				}
			}
		}
	});
	
	//Add or Remove is-active Class to hamburger Menu
	var $hamburger = $("#mainmenu-trigger-menu");
	$hamburger.on("click", function(e) {
		$hamburger.toggleClass("is-active");
	});
	
	//Scroll to top Button
	$.fn.scrollToTop = function() {
		var scrollButton = $( this );
		/* Hide Button by default */
		scrollButton.hide();
		/* Show Button on scroll down */
		var showButton = function() {
			var window_top = $( window ).scrollTop();
			if ( window_top > 250 ) {
				scrollButton.fadeIn( 600 );
			} else {
				scrollButton.fadeOut( 600 );
			}
		}
		showButton();
		$( window ).scroll( showButton );
		/* Scroll back to top when element is clicked */
		scrollButton.click( function () {
			$( 'html, body' ).animate( { scrollTop: 0 }, 300 );
			return false;
		} );
	};
	$( document ).ready( function() {
		/* Add Button to HTML DOM */
		$( 'body' ).append( '<button id="scroll-to-top"><i class="fa fa-chevron-up"></i></button>' );
		$( '#scroll-to-top' ).scrollToTop();
	});
	
	//Responsive oEmebed Videos (Youtube and Vimeo)
	$(document).ready(function($) {
		var $all_oembed_videos = $("iframe[src*='youtube'], iframe[src*='vimeo']");
		$all_oembed_videos.each(function() {
			$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
	 	});
	});

})(jQuery);

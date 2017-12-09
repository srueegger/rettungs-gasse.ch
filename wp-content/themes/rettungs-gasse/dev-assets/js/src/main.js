(function($) {
	'use strict';
	
	//Testimonial Slider
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
	
	//LP Content Slider
	$('#lp-content-slider').on('slide.bs.carousel', function (e) {
		var $e = $(e.relatedTarget);
		var idx = $e.index();
		var itemsPerSlide = 3;
		var totalItems = $('.carousel-lpcontent-item').length;
		if (idx >= totalItems-(itemsPerSlide-1)) {
			var it = itemsPerSlide - (totalItems - idx);
			for (var i=0; i<it; i++) {
				if (e.direction=="left") {
					$('.carousel-lpcontent-item').eq(i).appendTo('.carousel-inner-lpcontentslider');
				} else {
					$('.carousel-lpcontent-item').eq(0).appendTo('.carousel-inner-lpcontentslider');
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
	
	//Helpers for Render Google Maps
	function new_map( $el ) {
		var $markers = $el.find('.marker');
		var args = {
			zoom		: 16,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map( $el[0], args);
		map.markers = [];
		$markers.each(function(){
			add_marker( $(this), map );
		});
		center_map( map );
		return map;
	}
	
	function add_marker( $marker, map ) {
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map
		});
		map.markers.push( marker );
		if( $marker.html() ) {
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( map, marker );
			});
		}
	}
	
	function center_map( map ) {
		var bounds = new google.maps.LatLngBounds();
		$.each( map.markers, function( i, marker ){
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
			bounds.extend( latlng );
		});
		if( map.markers.length == 1 ) {
		    map.setCenter( bounds.getCenter() );
		    map.setZoom( 16 );
		} else {
			map.fitBounds( bounds );
		}
	}
	
	//Render the Maps
	var map = null;
	$(document).ready(function(){
		$('#single-event-map').each(function(){
			map = new_map( $(this) );
		}); 
	});

})(jQuery);

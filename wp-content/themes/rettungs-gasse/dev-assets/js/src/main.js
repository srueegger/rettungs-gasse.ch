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
		$('#all-event-map').each(function(){
			map = new_map( $(this) );
		});
	});

	//Activate Filter Content (Mitstreiter Archive)
	if($('.filter-content').length) {
		var containerEl = document.querySelector('.filter-content');
		var mixer = mixitup(containerEl, {
			animation: {
				enable: true
			},
			selectors: {
				control: '[data-mixitup-control]'
			}
		});
	}

	//Activate Filter Testimonials Page
	if($('.filter-content-testimonials').length) {
		var containerEl = document.querySelector('.filter-content-testimonials');
		var mixer = mixitup(containerEl, {
			animation: {
				enable: true
			},
			selectors: {
				control: '[data-mixitup-control]'
			}
		});
	}

	//Sprachauswahl Landing Page
	$(document).ready(function() {
		var movementStrength = 25;
		var height = movementStrength / $(window).height();
		var width = movementStrength / $(window).width();
		$(".lng-page").mousemove(function(e){
				  var pageX = e.pageX - ($(window).width() / 2);
				  var pageY = e.pageY - ($(window).height() / 2);
				  var newvalueX = width * pageX * -1 - 25;
				  var newvalueY = height * pageY * -1 - 50;
				  $('.lng-page').css("background-position", newvalueX+"px     "+newvalueY+"px");
		});
	});

	//Count Up Some Numbers
	$('.counter-box').each(function() {
		var $this = $(this),
			countTo = $this.attr('data-count');
		$({ countNum: $this.text()}).animate({
		  countNum: countTo
		},
		{
		  duration: 8000,
		  easing:'linear',
		  step: function() {
			$this.text(Math.floor(this.countNum));
		},
		complete: function() {
			$this.text(this.countNum);
		}
		});
	});

	//Team Seite
	/*$('.team-image').click(function() {
		var teamID = $(this).attr('id').split('-');
		$('.teamopen').slideToggle(500, 'linear');
		$('.teamopen').removeClass('teamopen');
		$('#team-desc-' + teamID[1]).addClass('teamopen');
		$('#team-desc-' + teamID[1]).slideToggle(500, 'linear');
	});*/

	$('.close-team-desc').click(function() {
		var teamID = $(this).attr('id').split('-');
		$('#team-desc-' + teamID[3]).slideToggle(500, 'linear');
	});

	$('.team-layer').hover(function() {
		var teamID = $(this).attr('id').split('-');
		$('#team-caption-' + teamID[1]).addClass('d-block');
	}, 
	function () {
		var teamID = $(this).attr('id').split('-');
		$('#team-caption-' + teamID[1]).removeClass('d-block');
	});
	
	/*$('.team-caption').click(function() {
		var teamID = $(this).attr('id').split('-');
		$('.teamopen').slideToggle(500, 'linear');
		$('.teamopen' + teamID[2]).removeClass('teamopen');
		$('#team-desc-' + teamID[2]).addClass('teamopen');
		$('#team-desc-' + teamID[2]).slideToggle(500, 'linear');
	});*/

	//Frontpage Scroll to Arrow
	$(document).ready(function(){
		$('#fp-scroll-button').click(function() {
			$('html, body').animate({
				scrollTop: $('#scrolltarget').offset().top + (-125)
			}, 2000);
		});
	});

	//Logo beim Scrollen verkleinern
	$(document).ready(function(){
		$(window).scroll(function(){
			if($(this).scrollTop()>=30){
				$('#header-logo').attr('style','width: 150px !important;');
			} else if ($(this).scrollTop()<30) {
				$('#header-logo').attr('style','width: 250px !important');
			}
		})
	});

	//Testimonial Modal get Informations
	$('#testimonialModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var name = button.data('testname');
		var content = button.data('txtcontent');
		var img = button.data('img');
		var job = button.data('job');
		var modal = $(this);
		modal.find('.modal-title').text('Testimonial von ' + name);
		modal.find('#modal-txt-content').html(content);
		modal.find('#testimonial-image-modal').prop('alt', name);
		modal.find('#testimonial-image-modal').prop('src', img);
		modal.find('#testimonial-job').text(job);
	});

	//Team Modal get Informations
	$('#teamModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var name = button.data('teamname');
		var img = button.data('img');
		var terms = button.data('terms');
		var quote = button.data('quote');
		var txt = button.data('txt');
		var mail = button.data('mail');
		var linkedin = button.data('linkedin');
		var facebook = button.data('facebook');
		var twitter = button.data('twitter');
		var instagram = button.data('instagram');
		var xing = button.data('xing');
		var modal = $(this);
		modal.find('.modal-title').text(name);
		modal.find('#team-image-modal').prop('alt', name);
		modal.find('#team-image-modal').prop('src', img);
		modal.find('.term-titles').text(terms);
		modal.find('.team-quote-insert').html(quote);
		modal.find('.team-txt').html(txt);
		if(mail == '') {
			$('.mail-li').hide();
		}else{
			modal.find('.mail-link').prop('href', 'mailto:'+mail);
		}
		if(linkedin == '') {
			$('.linkedin-li').hide();
		}else{
			modal.find('.linkedin-link').prop('href', linkedin);
		}
		if(facebook == '') {
			$('.facebook-li').hide();
		}else{
			$('.facebook-link').prop('href', facebook);
		}
		if(twitter == '') {
			$('.twitter-li').hide();
		}else{
			$('.twitter-link').prop('href', twitter);
		}
		if(instagram == '') {
			$('.instagram-li').hide();
		}else{
			$('.instagram-link').prop('href', instagram);
		}
		if(xing == '') {
			$('.xing-li').hide();
		}else{
			$('.xing-link').prop('href', xing);
		}
	});
})(jQuery);

// You can also use "$(window).load(function() {"
$(function () {

		// Slideshow 4
		$("#slider4").responsiveSlides({
				auto: true,
				pager: false,
				nav: true,
				maxwidth: 'auto',
				speed: 2000,
				namespace: "callbacks",
				before: function () {
						$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
						$('.events').append("<li>after event fired.</li>");
				}
		});

});
$(document).on('opening', '.remodal', function () {
		console.log('opening');
});

$(document).on('opened', '.remodal', function () {
		console.log('opened');
});

$(document).on('closing', '.remodal', function (e) {
		console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
});

$(document).on('closed', '.remodal', function (e) {
		console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
});

$(document).on('confirmation', '.remodal', function () {
		console.log('confirmation');
});

$(document).on('cancellation', '.remodal', function () {
		console.log('cancellation');
});

//  Usage:
//  $(function() {
//
//    // In this case the initialization function returns the already created instance
//    var inst = $('[data-remodal-id=modal]').remodal();
//
//    inst.open();
//    inst.close();
//    inst.getState();
//    inst.destroy();
//  });

//  The second way to initialize:
$('[data-remodal-id=modal2]').remodal({
		modifier: 'with-red-theme'
});

if ($('#gimmic').length) {
		var scrollTrigger = 100, // px
				backToTop = function () {
						var scrollTop = $(window).scrollTop();
						if (scrollTop > scrollTrigger) {
								$('#gimmic').addClass('show');
						} else {
								$('#gimmic').removeClass('show');
						}
				};
		backToTop();
		$(window).on('scroll', function () {
				backToTop();
		});
		$('#gimmic').on('click', function (e) {
				e.preventDefault();
				$('html,body').animate({
						scrollTop: 0
				}, 700);
		});
}

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function (event) {
		didScroll = true;
});

setInterval(function () {
		if (didScroll) {
				hasScrolled();
				didScroll = false;
		}
}, 250);

function hasScrolled() {
		var st = $(this).scrollTop();

		// Make sure they scroll more than delta
		if (Math.abs(lastScrollTop - st) <= delta)
				return;

		// If they scrolled down and are past the navbar, add class .nav-up.
		// This is necessary so you never see what is "behind" the navbar.
		if (st > lastScrollTop && st > navbarHeight) {
				// Scroll Down
				$('header').removeClass('header').addClass('nav-up');
		} else {
				// Scroll Up
				if (st + $(window).height() < $(document).height()) {
						$('header').removeClass('nav-up').addClass('header');
				}
		}

		lastScrollTop = st;
}

// Basic FitVids Test
$(".containerv").fitVids();
// Custom selector and No-Double-Wrapping Prevention Test
$(".containerv").fitVids({customSelector: "iframe[src^='http://socialcam.com']"});

$(function () {
		$("#facebook-share").on("click", function () {
				var url = window.location.href;     // Returns full URL
				var fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "pop", "width=600, height=400, scrollbars=no");
				return false;
		});

		$("#twitter-share").on("click", function () {
				var url = window.location.href;     // Returns full URL
				var fbpopup = window.open("https://twitter.com/intent/tweet?text=" + url, "pop", "width=700, height=450, scrollbars=no");
				return false;
		});

		$("#pinterest-share").on("click", function () {
				var url = window.location.href;     // Returns full URL
				var title = $('#title').text();
				var img_url = 'http://mydm.me/store/' + $('#url_img').val();
				var fbpopup = window.open("http://pinterest.com/pin/create/button/?url=" + url + "&media=" + img_url + "&description=" + title, "pop", "width=700, height=450, scrollbars=no");
				return false;
		});

});

$(document).ready(function () {
		$('nav').before('<div id="smartbutton"></div>');
		$('#smartbutton').append('<div class="buttonline"></div>');
		$('#smartbutton').append('<div class="buttonline"></div>');
		$('#smartbutton').append('<div class="buttonline"></div>');

		// add click listener
		$('#smartbutton').click(function (event) {
				$('nav').animate({height: 'toggle'}, 200);
		});
});

$(document).ready(function () {

		var nice = $("html").niceScroll();  // The document page (body)

});

$(window).on("scroll", function () {
		if ($(window).scrollTop() > 50) {
				$(".header").addClass("active");
		} else {
				//remove the background property so it comes transparent again (defined in your css)
				$(".header").removeClass("active");
		}
});

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
$(function () {

		// $('#st-accordion').accordion();

});

$('.wall').jaliswall({item: '.wall-item'});

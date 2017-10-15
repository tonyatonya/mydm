
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



$(window).on("scroll", function () {
    if ($(window).scrollTop() > 50) {
        $(".header").addClass("active");
        console.log("header active");
    } else {
        //remove the background property so it comes transparent again (defined in your css)
        $(".header").removeClass("active");
        console.log("header no active");
    }
});



$(document).ready(function () {
    var nice = $("html").niceScroll();  // The document page (body)

    $('nav').before('<div id="smartbutton"></div>');
    $('#smartbutton').append('<div class="buttonline"></div>');
    $('#smartbutton').append('<div class="buttonline"></div>');
    $('#smartbutton').append('<div class="buttonline"></div>');

    // add click listener
    $('#smartbutton').click(function (event) {
        $('nav').animate({height: 'toggle'}, 200);
    });


	/************************************ Modal *********************************/
	$(".member-btn").click(function(e){
		e.preventDefault();
		$("#login").modal('show');
	})

	$(".register").click(function(e){
		e.preventDefault();
		$('#login').on('hidden.bs.modal', function (e){
			$("#register").modal('show');
		})
	})

	$("#complete").on('show.bs.modal', function (e){
		setTimeout(function(){
			$("#complete").modal('hide');
		}, 5000)
	});
	/************************************ End Modal *****************************/
	$(".bullet-row .bullet-row-topic").click(function(){
		if($(this).parent().hasClass("active")==false){
			$(".bullet-row li.active").find(".bullet-row-content").slideToggle();
			$(".bullet-row li.active").removeClass("active");
			$(this).parent().addClass("active");
			$(this).parent().find(".bullet-row-content").slideToggle();
		}else{
			$(this).parent().removeClass("active");
			$(this).parent().find(".bullet-row-content").slideToggle();
		}

	})


	/*********************************** Bullet List ****************************/


});
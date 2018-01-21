
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
        //console.log("header active");
    } else {
        //remove the background property so it comes transparent again (defined in your css)
        $(".header").removeClass("active");
        //console.log("header no active");
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



	/********************************** Equal Height ****************************/

	equalheight = function(container){

	var currentTallest = 0,
	     currentRowStart = 0,
	     rowDivs = new Array(),
	     $el,
	     topPosition = 0;
	 $(container).each(function() {

	   $el = $(this);
	   $($el).height('auto')
	   topPostion = $el.position().top;

	   if (currentRowStart != topPostion) {
	     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	       rowDivs[currentDiv].height(currentTallest);
	     }
	     rowDivs.length = 0; // empty the array
	     currentRowStart = topPostion;
	     currentTallest = $el.height();
	     rowDivs.push($el);
	   } else {
	     rowDivs.push($el);
	     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
	  }
	   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
	     rowDivs[currentDiv].height(currentTallest);
	   }
	 });
	}

	/********************************** Equal Height ****************************/


});


// Page loginUser
function processLogin() {
    var u_login = $('#u_login').val()
    var u_password =  $('#u_password').val()

    if (!u_login) {
        $('#user_err_msg').html('Please enter username')
        u_login.required = true;
        return false;
    }else{
         $('#user_err_msg').html('')
    }

     if (!u_password) {
         $('#password_err_msg').html('Please enter Password')
        u_password.required = true;
        return false;
    }else{
         $('#password_err_msg').html('')
    }

    ajax = new SmartAjax('POSTFORM', 'operations.php', 'form');
    ajax.executeAjax("loginUser",
        function (result) {
          console.log(result);
            if (result[0] == "true") {

                // if (confirm("Login Successfuly Do you want go to previous page.")) {

                   window.location = "./";

                // } else {
                //     window.location = "/store";
                // }


            } else
                alert(result[1]);
        }
    );
}
function requestPass() {
    document.getElementById('imgAjaxLogin').style.display = "none";
    document.getElementById('imgSubmit_Pass').style.display = "none";
}

function sendform() {

       var name = $('input[name^=name]').val();
       var email = $('input[name^=email]').val();
       var login_name = $('input[name^=login_name]').val();
       var country = $('#country option:selected').val();
       var address = $('textarea#address').val();

       console.log(address)
       if(!name){
            $('#msg_name').html('Please Enter your name')
            return false
       }else{
            $('#msg_name').html('')
       }

       if(!email){
            $('#msg_email').html('Please Enter your email')
         return false
       }else{
            $('#msg_email').html('')
       }
         if(!login_name){
            $('#msg_username').html('Please Enter your login name')
            return false
       }else{
            $('#msg_username').html('')
       }
        if(country == '- please select -'){
            $('#msg_country').html('Please Enter your Country')
            return false
       }else{
            $('#msg_country').html('')
       }
        if(!address){
            $('#msg_address').html('Please Enter your Address')
            return false
       }else{
            $('#msg_address').html('')
       }

        var password = $('input[name^=password]').val();
        var re_password = $('input[name^=re_password]').val();

        if(!password){
            $('#msg_password').html('Please Enter your Password')
            return false
        }else{
            $('#msg_password').html('')
        }

        if(!re_password){
            $('#msg_repassword').html('Please Enter your Password Match On Upper')
             return false
        }else{
            $('#msg_repassword').html('')
        }
        if (password == re_password) {
            form.submit();
        } else {
            alert('Please input your password with a same password')
        }
}

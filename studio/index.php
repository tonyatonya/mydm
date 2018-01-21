<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>MYDM</title>

<meta name="description" content="Branding, Creative, Design, Colors, Graphic Design, Typography, Logo Design, Identity Design, Concept, Patterns, Corporate Identity, Products, Website, Print, Pattern, Packaging, Graphic Design Bangkok, Graphic Design Thailand, Lovely Graphic, Design House, Design Studio, Collaterals, Creative, Details, Refined Graphic, Crafty Graphic, Phai Subhawita Klunson, Art Direction, Lifestyle Product, Textile, Hand screen, Hand Paint, Concept Store, Craft, Details, Happy Design, Art Direction, Pattern, Visuals, Luxury, Stitch, Thread, Premium Product, Mydm, Arts, Homemade, Fabrics, DIY, Concept, Beautiful, Pretty Design, Chic, Minimal, Stylish, Friendly, Detailed Visual, myMom myDad, Family, Handmade, Homemade, Warm, Passion, Home, Irresistible, Design Solutions, Cute, Pretty, Beautiful, Smart, Typography, Bangkok Graphic Design, Thailand Graphic Studio, Custom Design, Original Design, Thai Design, Oriental, Idea, International, Paint, Illustration, Food, Homey, Slow life, MYDM" />

<meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
<meta name="HandheldFriendly" content="true"/>
<meta name="MobileOptimized" content="320"/>

<!--CSS -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/responsivemobilemenu.css" type="text/css"/>
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/grid.css" rel="stylesheet" type="text/css" />
<link href="css/gen-font.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/supersized.shutter.css" type="text/css" media="screen" />



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript" src="js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="js/supersized.shutter.min.js"></script>
<style type="text/css" />
video {
     max-width: 100%;
     height: auto;
}
iframe, embed,object {
     max-width: 100%;
}
	.containerv {
     width: 100%;
	 margin:0 auto;
}

	.vendor {
     padding:0;
}

</style>

<script type="text/javascript">

$(function() {
    $(window).scroll(function(){
        var scrollTop = $(window).scrollTop();
        if(scrollTop != 0)
            $('.mainmenu ').stop().animate({'opacity':'0.0'},300);
        else
            $('.mainmenu ').stop().animate({'opacity':'1'},300);
    });

    $('.mainmenu ').hover(
        function (e) {
            var scrollTop = $(window).scrollTop();
            if(scrollTop != 0){
                $('.mainmenu ').stop().animate({'opacity':'1'},300);
            }
        },
        function (e) {
            var scrollTop = $(window).scrollTop();
            if(scrollTop != 0){
                $('.mainmenu ').stop().animate({'opacity':'0.0'},300);
            }
        }
    );
});


$(document).ready(function(){
	$('.navigation').localScroll(700);

	//.parallax(xPosition, speedFactor, outerHeight) options:
	//xPosition - Horizontal position of the element
	//inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
	//outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
	$('#intro').parallax("50%", 0.1);
	$('#second').parallax("50%", 0.1);
	$('.bg').parallax("50%", 0.4);
	$('#third').parallax("50%", 0.3);

})


</script>

<script type="text/javascript">

			jQuery(function($){

				$.supersized({

					// Functionality
					slide_interval          :   4000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	3000,		// Speed of transition

					// Components
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  	[			// Slideshow Images
														{image : 'images/background-homepage/bg-work000.jpg'},
														{image : 'images/background-homepage/bg-work0.jpg'},
														{image : 'images/background-homepage/bg-work1.jpg'},
														{image : 'images/background-homepage/bg-work1-1.jpg'},
														{image : 'images/background-homepage/bg-work2.jpg'},
														{image : 'images/background-homepage/bg-work2-1.jpg'},
														{image : 'images/background-homepage/bg-work3.jpg'},
														{image : 'images/background-homepage/bg-work4.jpg'},
														{image : 'images/background-homepage/bg-work5.jpg'},
														{image : 'images/background-homepage/bg-work6.jpg'},

												]

				});
		    });

		</script>

</head>

<body>
<?php include('inc-header.php'); ?>
	<div id="intro" >
			<div class="container clearfix">
	  			<div id="content" class="grid_10">
                	<div id="captiondata">
                		<div class="btn"><a href="work.html">see more</a></div>
                        <div id="arrowdown" class="navigation"><a href="#second"  title="Prev Section"><img src="images/arrow-down1.png"></a></div>
					</div>
				</div>

				</div>

  </div> <!--.story-->


	 <div class="containerv">
                	<div class="vendor">
            			<iframe src="http://player.vimeo.com/video/120923743?title=0&amp;byline=0&amp;portrait=0" width="430px" height="242px"
 					   		frameborder="0">
						</iframe>
                    </div>
	</div>
 <!--#intro-->

	<div id="second" style="-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="container2 clearfix">
		<div id="content" class="grid_12">
            <div class="captionbg">
            	<div style="width:100%; text-align:center; padding-top:80px;"><img src="images/logo-mydm-white-logo.png"></div>
		    	<h1 style="margin-top:15px;">"DESIGN MATTERS"</h1>
			  <h4 style="margin-top:15px;">BRAND IDENTITY <span style="font-weight:normal;">//</span> ART DIRECTION  <span style="font-weight:normal;">//</span> GRAPHIC DESIGN </h4>
                <div id="content" class="tcont"><p>MYDM, by Phai Subhawita Klunson, is a Bangkok-based graphic design house offering a variety of creative branding and design services for a wide range of private and corporate clients who value our refined and detail visuals.<br>

To get the finest execution, we craft the concept and develop beautiful and <br>honest graphic out of our sincere care.</p></div>
			  <div style="width:100%; text-align:center; padding-top:5px;" class="btn"><a href="about.html">know us more</a></div>
                <div id="arrowdown" class="navigation"><a href="#intro" title="Next Section"><img src="images/arrow-up1.png"></a></div>
            </div>
			</div>
            </div>  <!--.story-->

	</div> <!--#second-->

<?php include('inc-footer.php'); ?>

<script>
  $(document).ready(function() {

	var nice = $("html").niceScroll();  // The document page (body)

  });
</script>
<script type="text/javascript" src="js/jquery.fitvids.js"></script>
      <script>
        // Basic FitVids Test
        $(".containerv").fitVids();
        // Custom selector and No-Double-Wrapping Prevention Test
        $(".containerv").fitVids({ customSelector: "iframe[src^='http://socialcam.com']"});
      </script>
	<script type="text/javascript">
	//<![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded
			$('#status').fadeOut(); // will first fade out the loading animation
			$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'visible'});
		})
	//]]>
	</script>


</body>
</html>

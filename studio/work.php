<?php 

	session_start();
	require_once "initapp.php";

	$work_list = "";
	$works = "";
	$i = 0;
	$sql = "select * from d_works order by id desc";
	if(!$db->execute($sql))
		throw new Exception("Operation Error");
	while($db->read()){
		$i += 1;
		if($i % 4 == 1){
			$work_list  .= "<div class='multiple'>
					<ul>";
		}
		$work_list .= "<li><a href='work/work-detail.php?id=".$db->result['id']."'  >".$db->result['name']."</a></li>";
		$works .= "<div class='pic'>
								<a href='work/work-detail.php?id=".$db->result['id']."'>
									<img src='images/work/work-thumbs/".$db->result['thumb_image']."' class='pic-image' alt='Pic'/>
									<span class='pic-caption bottom-to-top'>
										<h1 class='pic-title'>".$db->result['name']."</h1>
										<p><img src='images/small-logo.png'></p>
									</span>
									</a> 
								</a>    
							</div>";
		if($i % 4 == 0){
			$work_list  .= "</ul>
				</div>";
		}
	}
	if($i % 4 != 0){
		$work_list  .= "</ul>
			</div>";
	}
?>

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

<link rel="stylesheet" href="css/responsivemobilemenu-op.css" type="text/css"/>
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="stylesheet" href="css/sass-compiled.css" />


<link rel="stylesheet" type="text/css" href="css/slick.css"/>
<link rel="stylesheet" type="text/css" href="css/totop-style.css" media="screen"/>
<link href="css/css-work.css" rel="stylesheet" type="text/css">
<link href="css/otherpages-style.css" rel="stylesheet" type="text/css" />
<link href="css/grid.css" rel="stylesheet" type="text/css" />
<link href="css/gen-font.css" rel="stylesheet" type="text/css" />
<link href="css/aboutus-column.css" rel="stylesheet" type="text/css" />

<script src="js/modernizr.js" type="text/javascript"></script>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<link rel="stylesheet" href="css/preload-styles.css" type="text/css" media="screen, print"/>

</head>


<body>
<div id="preloader">
	<div id="status">&nbsp;</div>
</div>

<div id="intro">
<nav class="mainmenu right">
	 <div class ="container clearfix">
     <div id="content" class="grid_12">
    	<div class="logo"></div>
			<ul>
        			<li><a href="index.html" >HOME</a></li>
					<li class="current"><a href="work.php">WORKS</a></li>
					<li><a href="shop.php">SHOP</a></li>
					<li><a href="about.html">ABOUT</a></li>
                    <li><a href="#">BLOG</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
			</ul>
      </div>
      </div>
</nav>


<section id="scontainer">
	<div id="pageheadercont">
    	<div class ="container clearfix">
    		<div id="content" class="grid_12">
    			<div id="pageheader" class="grid_1-5">WORKS</div>
                <div id="pagedes">This is what we do.<div class="exbtn"><a href="download/MYDM_Port_131014.pdf">download sample works</a></div></div>
                
               	
                <div class="grid_12" style="width:100%;">
                <div class="slider responsive">
					<?=$work_list ?>
				</div>
                </div> <!-- #content -->
                
                
		<section class="wrapper cl" style=" background:url(images/bg-pattern4.png) repeat-x top;">
			<?=$works?>
		<!--
		<div class="pic">
        <a href="work/work-detail0.html">
		    <img src="images/work/work-thumbs/w1.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">CASSIA Website</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
        </a>    
		</div>


		<div class="pic">
        <a href="work/work-detail1.html">
		    <img src="images/work/work-thumbs/w2.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">The Beginning of Forever</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>
        
        <div class="pic">
        <a href="work/work-detail2.html">
		    <img src="images/work/work-thumbs/w5.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">ACTs Of Green</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>
        
        <div class="pic">
        <a href="work/work-detail3.html">
		    <img src="images/work/work-thumbs/w3.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">JK Journey</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>

		<div class="pic">
        <a href="work/work-detail4.html">
		    <img src="images/work/work-thumbs/w4.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Laguna Shores</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>

	
		

	
		<div class="pic">
        <a href="work/work-detail5.html">
		    <img src="images/work/work-thumbs/w6.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">FOMO THAI</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>

	
		<div class="pic">
        <a href="work/work-detail6.html">
		    <img src="images/work/work-thumbs/w7.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Words of Youth</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>

	
		<div class="pic">
        <a href="work/work-detail7.html">
		    <img src="images/work/work-thumbs/w8.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">NAKORN SI TAMMARAT's Power Development Plan Infographic</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>


		<div class="pic">
        <a href="work/work-detail8.html">
		    <img src="images/work/work-thumbs/w9.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">DIR4</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>


		<div class="pic">
        <a href="work/work-detail13.html">
		    <img src="images/work/work-thumbs/w10.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Laguna Property</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>
        
        <div class="pic">
        <a href="work/work-detail14.html">
		    <img src="images/work/work-thumbs/w11.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Amorvida Coffee Brewhouse</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
        </a>
		</div>


		<div class="pic">
        <a href="work/work-detail15.html">
		    <img src="images/work/work-thumbs/w12.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Khon Collection</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>


		<div class="pic">
        <a href="work/work-detail16.html">
		    <img src="images/work/work-thumbs/w13.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Banyan Tree Residences</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>


		<div class="pic">
        <a href="work/work-detail9.html">
		    <img src="images/work/work-thumbs/w14.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">STUDIO4</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>
        
        <div class="pic">
        <a href="work/work-detail10.html">
		    <img src="images/work/work-thumbs/w15.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">BENJAPAYO</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>
        
        <div class="pic">
        <a href="work/work-detail11.html">
		    <img src="images/work/work-thumbs/w16.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Dimsum Lover</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>
        
        <div class="pic">
        <a href="work/work-detail12.html">
		    <img src="images/work/work-thumbs/w17.jpg" class="pic-image" alt="Pic"/>
		    <span class="pic-caption bottom-to-top">
		        <h1 class="pic-title">Original Recipe</h1>
		        <p><img src="images/small-logo.png"></p>
		    </span>
            </a> 
		</div>
        
      -->
        
        

		
	</section>
                
    		</div>
    	</div>
    </div>

	<div  id="nav_up" class="arrowup"><a href="#intro" title="Next Section"><img src="images/arrow-up2.png" style="clear:both; margin:0 auto;"><br><span style="width:100%;">Top</span></a></div>
    
    

</section>

</div>




<footer>
		<div class="container clearfix">
			<div id="content" class="grid_12">
    			<div class="grid_7">
                	<div class="cont">
    					<h1>
                        <a href="https://www.google.co.th/maps/dir//13.703916,100.605744/@13.7050133,100.6059472,17z/data=!4m4!4m3!1m0!1m1!4e1?hl=en" target="_blank"><img src="images/google-map-btn.png">
                        </a>
                        </h1>
   				  		<p>+66 (0) 965695142</p>
    					<p>phai.subhawita@mydm.me</p>
                    </div>
                </div>
                <div class="grid_4" style="float:right;">
                	<div class="container">
    				<div class="cont">
                    	<ul>
                        	<li><a href="http://www.behance.net/mydm" target="_blank"><img src="images/social-behance2.png"></a></li>                            <li><a href="https://www.facebook.com/MYDM.ME" target="_blank"><img src="images/social-facebook2.png"></a></li>                            <li><a href="https://www.instagram.com/mydm.me"  target="_blank"><img src="images/social-ig2.png"></a></li>                                                   	                          
                        	<li><a href="download/MYDM_Port_131014.pdf" target="_blank"><img src="images/social-pdf.png"></a></li>                                                 	
                        </ul>
                        
                    </div>
                    <div class="cpr"><p>© 2014 MYDM Co.,Ltd. All Rights Reserved.</p></div>
                    </div>
    			</div>
    </div>
    </div> <div class="fcont"></div><!--.story-->
</footer>
<script>
  $(document).ready(function() {
  
	var nice = $("html").niceScroll();  // The document page (body)
    
  });

</script>
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script src="js/scroll-startstop.events.jquery.js" type="text/javascript"></script>
		<script>
			$(function() {
				var $elem = $('#intro');
				
				$('#nav_up').fadeIn('slow');				
				$('#nav_up').click(
					function (e) {
						$('html, body').animate({scrollTop: '0px'}, 800);
					}
				);
            });
			
			  $(document).ready(function() {
  
	var nice = $("html").niceScroll();  // The document page (body)
    
  });
			
</script>
	<script>
		document.addEventListener("touchstart", function(){}, true);
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

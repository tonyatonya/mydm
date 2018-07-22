<?php 
session_start();
$your_email ='phai.subhawita@mydm.me';// <<=== update to your email address // phai.subhawita@mydm.me oudluck@gmail.com

$errors = '';
$name = '';
$address = '';
$tel = '';
$visitor_email = '';
$user_message = '';

if(isset($_POST['submit']))
{
	
	$name = $_POST['name'];
	$address = $_POST['address'];
	$tel = $_POST['tel'];	
	$visitor_email = $_POST['email'];
	$user_message = $_POST['message'];
	///------------Do Validations-------------
	if(empty($name)||empty($visitor_email))
	{
		$errors .= "\n Name and Email are required fields. ";	
	}
	if(IsInjected($visitor_email))
	{
		$errors .= "\n Bad email value!";
	}
	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n The captcha code does not match!";
	}
	
	if(empty($errors))
	{
		//send the email
		$to = $your_email;
		$subject="New form submission";
		$from = $visitor_email;
		$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "A user  $name submitted the contact form:\n".
		"NAME: $name\n".
		"ADDRESS: $address\n".
		"TEL: $tel\n".
		"EMAIL: $visitor_email \n".
		"PROJECT DESCRIPTION: $message \n ".
		"$user_message\n".
		"IP: $ip\n";	
		
		$headers = "From: $from \r\n";
		$headers .= "Reply-To: $visitor_email \r\n";
		
		mail($to, $subject, $body,$headers);
						
		header('Location: thank-you.html');
	}
}

// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
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
<link rel="stylesheet" type="text/css" href="css/totop-style.css" media="screen"/>
<link href="css/form-style.css" rel="stylesheet" type="text/css">
<link href="css/css-contact.css" rel="stylesheet" type="text/css">
<link href="css/otherpages-style.css" rel="stylesheet" type="text/css" />
<link href="css/grid.css" rel="stylesheet" type="text/css" />
<link href="css/gen-font.css" rel="stylesheet" type="text/css" />
<link href="css/contact-column.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo-1.4.2-min.js"></script>
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>	
</head>


<body>

<div id="intro">
<nav class="mainmenu right">
	 <div class ="container clearfix">
     <div id="content" class="grid_12">
    	<div class="logo"></div>
			<ul>
        			<li><a href="index.html" >HOME</a></li>
					<li><a href="work.html">WORKS</a></li>
					<li><a href="shop.html">SHOP</a></li>
					<li><a href="about.html">ABOUT</a></li>
                    <li><a href="#">BLOG</a></li>
                    <li class="current"><a href="contact.html">CONTACT</a></li>
			</ul>
      </div>
      </div>
</nav>


<section id="scontainer">
	<div class ="container clearfix">
		<div id="content" class="grid_12">
    		<div id="pageheader" class="grid_1-5">CONTACT
        	</div>
            <div id="pagedes">Drop by and Say Hello!</div>
            
            <article class="grid_12">
        			<div id="articlecont" style="background:url(images/bg-pattern4.png) repeat-x bottom">
                    <p>Please take a moment to let us know what brought you here – we'd love to hear more about you and the project(s) you have in mind.</p>			  			
        			</div>
                    <div class="grid_3">
                   		<div id="contactinfo">
                   			<h3>ADDRESS</h3><br>
                            	<span style="font-size:11px; font-weight:bolder;">MYDM CO., LTD.</span><br>
								13 Sukhumvit 85, Phra Khanong<br>
								Bangkok,10260 Thailand
                         </div>
                         <div id="contactinfo">
                   			<h3>INQUIRE</h3><br>
								phai.subhawita@mydm.me
                         </div>
                         <div id="contactinfo">
                   			<h3>CALL US</h3><br>
								TEL +66 (0) 965695142
                         </div>
                         
                    </div>
                    <div class="grid_8" style="float:right;">
                    
                    	<div class="wrapper">
						<div id="main">
						
                        <?php
							if(!empty($errors)){
							echo "<p class='err'>".nl2br($errors)."</p>";
							}
						?>
                        
		<!-- Form -->	<div id='contact_form_errorloc' class='err'></div>
						<form id="contact-form" method="post" name="contact_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"> 
		
						<h4>Fill in the form below, and we'll get back to you within 24 hours.</h4>
                        
						<div>
							<label>					
								<input placeholder="NAME" input type="text" name="name" value='<?php echo htmlentities($name) ?>' tabindex="2" required autofocus>
							</label>
						</div>
						<div>
							<label>
								<input placeholder="ADDRESS" input type="text" name="address" value='<?php echo htmlentities($address) ?>' tabindex="3" required>
							</label>
						</div>
						<div>
							<label>					
								<input placeholder="PHONE NUMBER" input type="text" name="tel" value='<?php echo htmlentities($tel) ?>' tabindex="4" required>
							</label>
						</div>
						<div>
							<label>					
								<input placeholder="EMAIL" input type="text" name="email" value='<?php echo htmlentities($visitor_email) ?>' tabindex="5" required>
							</label>
						</div>
                        <div>
							<label>					
								<textarea name="message" id="message" tabindex="1" placeholder="PROJECT DESCRIPTION" <?php echo htmlentities($user_message) ?> required></textarea>
							</label>
						</div>
                        <div>
                        <img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
<label for='message'><h4>Enter the code above here :<h4></label><br>
<input id="6_letters_code" name="6_letters_code" type="text"><br>
<h4>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh<h4>
						</div>
			
			<div>
				<button name="submit" type="submit" id="contact-submit">send email</button>
			</div>
		</form>
<script language="JavaScript">
// Code for validating the form
// Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
// for details
var frmvalidator  = new Validator("contact_form");
//remove the following two lines if you like error message box popups
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("name","req","Please provide your name"); 
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
		<!-- /Form -->
		
		</div>
	</div>
                    
                    </div>
			</article>                        			
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
    </div><div class="fcont"></div> <!--.story-->
</footer>
<script>
  $(document).ready(function() {
  
	var nice = $("html").niceScroll();  // The document page (body)
    
  });

</script>

<script src="js/form-scripts.js"></script>
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
</body>

</html>

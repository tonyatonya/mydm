<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>MYDM</title>   

<meta name="description" content="Insert Your Site Description" /> 

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
<link href="css/css-shop.css" rel="stylesheet" type="text/css">
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
</head>


<body>

<div id="intro">
<nav class="mainmenu right">
	 <div class ="container clearfix">
     <div id="content" class="grid_12">
    	<div class="logo"></div>
			<ul>
        			<li><a href="index.html" >HOME</a></li>
					<li><a href="work.php">WORKS</a></li>
					<li  class="current"><a href="shop.php">SHOP</a></li>
					<li><a href="about.html">ABOUT</a></li>
                    <li><a href="#">BLOG</a></li>
                    <li><a href="contact.php">CONTACT</a></li>
			</ul>
      </div>
      </div>
</nav>


<section id="scontainer" name="scontainer">
	<div class ="container clearfix">
		<div id="content" class="grid_12">
    		<div id="pageheader" class="grid_1-5">SHOP
        	</div>
            <div id="pagedes">Every detail counts.</div>
            
            <article class="grid_12">
        			<div id="articlecont2">
                    	<h3>SHOPPING CART</h3>			  			
        			</div>
            		<div id="totalcont">
						<p><strong>Thank you for your order</strong></p>
						<p>Your order has been completed as following detail <br/>
						<?php
						echo '<strong>Pay by</strong> : Paypal/Credit Card <br/>';
						echo isset($_SESSION['PayPalTransactionID']) && $_SESSION['PayPalTransactionID'] != '' ? '<strong>Transaction ID</strong>: '.$_SESSION['PayPalTransactionID'].'<br/>' : '';
						echo isset($_SESSION['GrandTotal']) && $_SESSION['GrandTotal'] != '' ? '<strong>Total</strong>: '.number_format($_SESSION['GrandTotal'],2).' Baht<br/>' : '';
						?>
						</p>
						<p>The products will be delivered to you within 7 working days </p>
            		</div>
				<div id="resultcont">
                  <div class="rightcont"> 
                            <div class="btngoon"><a href="shop.php">continue shopping</a>
                  </div>
                             
						</div>
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
   				  		<p>+66 (0) 81 408 0060</p>
    					<p>phai.subhawita@mydm.me</p>
                    </div>
                </div>
                <div class="grid_4" style="float:right;">
                	<div class="container">
    				<div class="cont">
                    	<ul>
                        	<li><a href="http://www.behance.net/mydm" target="_blank"><img src="images/social-behance2.png"></a></li>                            <li><a href="https://www.facebook.com/MYDM.ME" target="_blank"><img src="images/social-facebook2.png"></a></li>                            <li><a href="http://instagram.com/phai_subhawita" target="_blank"><img src="images/social-ig2.png"></a></li>
                            <li><a href="download/MYDM_Port_131014.pdf" target="_blank"><img src="images/social-pdf.png"></a></li>
                        </ul>
                        
                    </div>
                    <div class="cpr"><p>© 2014 MYDM Co.,Ltd. All Rights Reserved.</p></div>
                    </div>
    			</div>
    </div>
    </div> <!--.story-->
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


<?php
require_once('library/paypal/includes/config.php');
require_once "initapp.php";

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Samsung eService</title>
	<link rel="stylesheet" href="css/fontstyle.css" />
	<link rel="stylesheet" href="css/formalize.css" />
	<script src="js/jquery.js"></script>
	<script src="js/jquery.formalize.js"></script>
	<script src="js/appfunction.js"></script>
	<script src="js/BrowserDetect.js"></script>
	<script src="js/energize-min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/appair.js" ></script>

</head>
<body>		
	
<?php include "init_style.php" ?>

		<div id='pageContentForm' >
			<p><strong>ขอบคุณที่ใช้บริการค่ะ</strong></p>
			<p>เราได้รับชำระค่าบริการจากท่านเรียบร้อยแล้ว ตามรายละเอียดดังนี้<br/>
			<?php
			echo '<strong>ช่องทางการชำระ</strong> : Paypal/บัตรเครดิต <br/>';
			echo isset($_SESSION['PayPalTransactionID']) && $_SESSION['PayPalTransactionID'] != '' ? '<strong>Transaction ID</strong>: '.$_SESSION['PayPalTransactionID'].'<br/>' : '';
			echo isset($_SESSION['GrandTotal']) && $_SESSION['GrandTotal'] != '' ? '<strong>ยอดชำระ</strong>: '.number_format($_SESSION['GrandTotal'],2).' บาท<br/>' : '';

			$service = new Service($_SESSION['ItemID']);
			$service->updateStatus('PaymentNotified');

			?></p>
			<p><strong>กรุณารอรับ SMS เพื่อยืนยันนัดหมายค่ะ</strong></p>
		</div>
		

</body>
</html>
<script>
	var percent = parseInt($(window).width()*100/400).toString() +"%";
	$("#pageContentForm").css("font-size",percent);
</script>
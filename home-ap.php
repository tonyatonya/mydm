<?php header("Refresh:1000; URL=http://mydm.me/store/home.php"); ?>
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
<link href="css/hap-gen-font.css" rel="stylesheet" type="text/css" />
<link href="css/hap-style02.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
var time = 15; // Time coutdown
var page = "http://www.redirect-url.com/";
function countDown(){
time--;
gett("timecount").innerHTML = time;
if(time == -1){
window.location = page;
}
}
function gett(id){
if(document.getElementById) return document.getElementById(id);
if(document.all) return document.all.id;
if(document.layers) return document.layers.id;
if(window.opera) return window.opera.id;
}
function init(){
if(gett('timecount')){
setInterval(countDown, 1000);
gett("timecount").innerHTML = time;
}
else{
setTimeout(init, 50);
}
}
document.onload = init();

</script>



</head>

<body>
<header id="header"><img src="images/logo-mydm.svg"></header>
<div class="row">
   <a href="studio/index.html">
   <div class="row1">
   		<div class="white1">
			<h1>STUDIO</h1>
            <p>Creative Design House</p>
    	</div>
   </div>
   </a>
   <a href="store/index.html">
   <div class="row2">
      	<div class="white2">
			<h1>STORE</h1>
            <p>Inspiring Handcraft Patterns And Products</p>
    	</div>
   </div>
  </a>
</div>

</body>

</html>

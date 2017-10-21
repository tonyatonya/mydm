<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]>
<html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]>
<html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)]>
<html class="no-js ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en-US"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <title>MYDM</title>

    <meta name="description"
          content="Branding, Creative, Design, Colors, Graphic Design, Typography, Logo Design, Identity Design, Concept, Patterns, Corporate Identity, Products, Website, Print, Pattern, Packaging, Graphic Design Bangkok, Graphic Design Thailand, Lovely Graphic, Design House, Design Studio, Collaterals, Creative, Details, Refined Graphic, Crafty Graphic, Phai Subhawita Klunson, Art Direction, Lifestyle Product, Textile, Hand screen, Hand Paint, Concept Store, Craft, Details, Happy Design, Art Direction, Pattern, Visuals, Luxury, Stitch, Thread, Premium Product, Mydm, Arts, Homemade, Fabrics, DIY, Concept, Beautiful, Pretty Design, Chic, Minimal, Stylish, Friendly, Detailed Visual, myMom myDad, Family, Handmade, Homemade, Warm, Passion, Home, Irresistible, Design Solutions, Cute, Pretty, Beautiful, Smart, Typography, Bangkok Graphic Design, Thailand Graphic Studio, Custom Design, Original Design, Thai Design, Oriental, Idea, International, Paint, Illustration, Food, Homey, Slow life, MYDM"/>

    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
    <meta name="HandheldFriendly" content="true"/>
    <meta name="MobileOptimized" content="320"/>

    <!--CSS -->
    <link href="../css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="../js/tooltip.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href="../css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="../css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/collection-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/jquery.excoloSlider.css" rel="stylesheet"/>
    <link href="../css/column.css" rel="stylesheet" type="text/css"/>
    <link href="../css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/gen-font.css" rel="stylesheet" type="text/css"/>
    <link href="css/collection-style.css" rel="stylesheet" type="text/css"/>

    <!--<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->

    <script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.excoloSlider.js"></script>

    <!--  CART  -->
    <script type="text/javascript" src="../addcart.js"></script>
    <!--  Account -->
    <!--<script type="text/javascript" src="../account.js"></script>-->
</head>
<body>
<!-- HEADER BOX -->
<header class="header">
    <div id="top-nav">
        <div class="boxleft">
            <a id="swit-btn" class="current" href="../index.html">STORE</a>
            <a id="swit-btn" href="../../studio/index.html" target="_blank" style="margin-right:20px;">STUDIO</a>
        </div>

    </div>
    <div class="container clearfix">
        <a id="logo" href="../index.html"></a>
        <div class="boxright">
            <ul>
                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip1', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="../images/top-icon-fav.svg"></a>
                </li>
				<li style="position:relative">
                	<div class="bag-container">
                    	<div class="bagcount"></div>
	                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
	                       onclick="tooltip.pop(this, '#tip2', {sticky:true, position:4, cssClass:'no-padding'})">
		                       <img src="../images/top-icon-count.svg">
		                </a>
                	</div>
                </li>


                <li>
                    <a id="icon-btn" class="tooltip member-btn" href="#">
	                    <img src="../images/top-icon-member.svg">
	                </a>
                </li>
            </ul>
        </div>
        <nav>
            <a href="../collection/collection.php" class="navitem">COLLECTIONS</a>
            <a href="../shops/store-home.php" class="navitem">SHOP</a>
            <a href="../story/story.php" class="navitem">STORY</a>
            <a href="../blog/blog.php" class="navitem">BLOG</a>
            <a href="../misc/contact.php" class="navitem">LOCATION</a>
        </nav>
    </div>
</header>
<div style="display:none;">
    <div id="tip1">
        <div>
            <div class="head">MY FAVOURITE</div>
            <div class="body" style="padding:20px; background:#f5f6f7">
                <p>COLLECT YOUR FAVOURITE ITEMS AND REVIEW THEM NEXT VISITFOR INSPIRATION.</p>
            </div>
            <div class="bottom">
                <a href="../account/member-account.php" class="btn">VIEW MY FAVOURITE</a>
            </div>
        </div>
    </div>

    <div id="tip2">
        <div>
            <div class="head"><span class="inbag"></span> ITEM IN BAG</div>
            <div class="body">
                <div id="totalcart"></div>
            </div>
            <div class="bottom">
                <div class="seedetail">
                    <span>
                    <a href="../shops/shop-cart-total.php" class="btn" id="viewbag"
                       style="display: none">VIEW BAG </a>
                    <a href="../shops/" class="btn">SHOP NOW!!</a>
                        </span>
                </div>
            </div>
        </div>
    </div>

    <div id="tip3">
        <div>
            <div class="head">MY ACCOUNT</div>
            <div class="body">
                <table>
                    <tr>
                        <td>WISH LIST</td>
                        <td id="myemail">MY EMAIL PREFERENCE</td>
                    </tr>
                    <tr>
                        <td>INVENTORY</td>
                        <td id="myaddress">ADDRESS BOOK</td>
                    </tr>
                    <tr>
                        <td>MY ORDERS</td>
                        <td id="myorder">ACCOUNT DETAILS</td>
                    </tr>
                    <tr>
                        <td>MY GIFT CARDS</td>
                        <td id="myfav">FAVOURITE COLLECTIONS</td>
                    </tr>
                </table>

            </div>
            <div class="bottom">
                <a href="../account/member-account.php" class="btn" id="member" style="display: none">YOUR INFO</a>
                <a href="../account/login.php" class="btn" id="signin">SIGN IN</a>
                <a class="btn" id="signout" style="display: none;cursor: pointer">SIGN OUT</a>
            </div>
        </div>
    </div>

</div>
<!-- HEADER BOX -->

<section class="collsec">
    <article>
        <div class="container clearfix">
            <div class="collcolumn clearfix">
                <h1>CUT & PAINT COLLECTION</h1>
                <p>From our background of designer and home maker, plus our love of handcraft,
                    we combine these two into a perfect blend, reflecting in our work of functional
                    and inspring home and style items for everyday use. </p>
                <p>This collection “Cut and Paint” portrays our passion in handcraft, pattern,
                    painting, paper work, screening, and cutting. With such lively colour combination,
                    “Cut and Paint” collection is designed to inspire you,
                </p>
                <img src="images/hr.svg" style="margin-top:30px; zoom:120%;"><br>
                <img src="images/signature.svg" style="margin-top:10px; zoom:150%;">
            </div>
            <div class="collcolumn2 clearfix">
                <img src="images/head-img-coll1.jpg" alt="collection1" style="margin-top:44px; width:80%;">
                <img src="../images/cutnpaint.svg" class="cnp">
                <a href="../pdf/MYDM Catalogue_151217 with no price.pdf" target="_blank" class="dl">download catalogue
                    here > ></a>
            </div>
        </div>
    </article>
    <article>
        <div class="clearfix">
            <div id="sliderB" class="slider collection-slider">
                <div style="background:url(images/slide1.jpg) no-repeat; background-size:contain; background-position:top center"></div>
<!--                 <div style="background:url(images/slide2.jpg) no-repeat; background-size:contain; background-position:top center"></div> -->
            </div>
        </div>

    </article>

    <article>
        <div class="container clearfix" style="margin-top:80px;">
            <div class="gcoll-left">
                <img src="images/collection01.jpg">
                <img src="images/collection02.jpg">
                <img src="images/collection03.jpg">
            </div>
            <div class="gcoll-right">
                <div class="right1">
                    <img src="images/collection06.jpg">
                    <img src="images/collection07.jpg">
                </div>
                <div class="right2">
                    <img src="images/collection04.jpg">
                    <img src="images/collection05.jpg">
                </div>
            </div>
        </div>
        <div class="container clearfix" style="margin-top:80px; margin-bottom:80px;">
            <img src="images/collection08.jpg" style="width:100%; margin-bottom:4%;">
            <a class="collbtn" href="../pdf/MYDM Catalogue_151217 with no price.pdf" target="_blank">DOWNLOAD CATALOGUE</a>
            <!--<a class="collbtn" href="../shop/index.html">SHOP THE COLLECTION</a>-->
        </div>
    </article>

</section>

<section class="container clearfix">
    <div class="grid_12">
        <div class="wrapper grid3">

            <article class="col">
                <div class="footer-nav">
                    <a id="footer-btn" href="../misc/faq.php">FAQ</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="../misc/terms.php">TERMS</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="../misc/privacy-policy.php">PRIVACY POLICY</a>
                </div>
            </article>

            <article class="col3"
                     style=" width:38%; font-size:11px; color:#333; margin-top:20px; letter-spacing:1px; font-family:Georgia, 'Times New Roman', Times, serif; font-weight:bold;">
                MYDM : Inspiring handcraft patterns created for your everyday life
            </article>

            <article class="col4" style="width:24%;">
                <div class="contain">
                    <div class="cont">
                        <ul>
                            <li><a href="https://www.facebook.com/MYDM.ME" target="_blank"><img
                                    src="../images/bullet-fb.svg"></a></li>
                            <li><a href="https://www.instagram.com/mydm.me" target="_blank"><img
                                    src="../images/bullet-insta.svg"></a></li>
                            <li><a href="https://www.pinterest.com/mydmme" target="_blank"><img
                                    src="../images/bullet-pin.svg"></a></li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
<footer>
    <div class="container clearfix">
        <div class="grid_12" style="margin:0 !important;">
            <div class="cpr">© 2015 MYDM Co., Ltd.</div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sliderB").excoloSlider();
	})
</script>
<!--------------------------- ---------------------------------------->
<link href="../css/modal.css" rel="stylesheet"/>
<link href="../css/form.css" rel="stylesheet"/>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<?php include('../login.php'); ?>
<!--------------------------- ---------------------------------------->
</body>
</html>
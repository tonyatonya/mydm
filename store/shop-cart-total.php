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

    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = yes">
    <meta name="HandheldFriendly" content="true"/>
    <meta name="MobileOptimized" content="320"/>

    <!--CSS -->

    <link href="css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="js/tooltip.js" type="text/javascript"></script>
    <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>-->
    <link href="css/store-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/column.css" rel="stylesheet" type="text/css"/>
    <link href="css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="css/gen-font.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <script language="javascript" type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <!--   ################ Smart  Ajax ####################-->
    <script type="text/javascript" src="shops/library/Common/appfunction.js"></script>

    <link rel="stylesheet" href="css/remodal.css">
    <link rel="stylesheet" href="css/remodal-default-theme.css">

<!--    <link rel="stylesheet" type="text/css" href="css/totop-style.css" media="screen"/>-->
<!--    <link href="css/css-shop.css" rel="stylesheet" type="text/css">-->
<!--    <link href="css/otherpages-style.css" rel="stylesheet" type="text/css"/>-->
<!--    <link href="css/grid.css" rel="stylesheet" type="text/css"/>-->
<!--    <link href="css/gen-font.css" rel="stylesheet" type="text/css"/>-->
<!--    <link href="css/contact-column.css" rel="stylesheet" type="text/css"/>-->

    <!--  CART  -->
    <script type="text/javascript" src="addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="account.js"></script>
    <style>
	td{
		text-align:center}
    </style>


<!--CSS -->
<!--<link rel="stylesheet" href="css/responsivemobilemenu-op.css" type="text/css"/>-->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="css/totop-style.css" media="screen"/>
<link href="css/css-shop.css" rel="stylesheet" type="text/css">
</head>
<body>

<!-- HEADER BOX -->
<?php include 'inc-header.php'; ?>
<!-- HEADER BOX -->
<!--    <section class="container clearfix">-->
    <section id="scontainer" name="scontainer" style="margin-top: 150px; margin-bottom:100px;">
        <div class="container clearfix">
            <div id="content" class="grid_12">
                <div id="pageheader" class="grid_1-5">SHOP
                </div>
                <div id="pagedes">Every detail counts.</div>

                <article class="grid_12">
                    <div id="articlecont2">
                        <h3>SHOPPING CART</h3>
                    </div>
                    <div id="totalcont">

                    </div>
                    <div id="resultcont">
                        <div class="leftcont">
                            <div class="btncart"><a href="#">update shopping bag</a>
                            </div>
                            <p>*Please note that the exact price of and item is not finalished until you have selected
                                your shipping destination, and will be displayed under *Order Summary* on the Secure
                                Payment Page prior to complete payment.
                            </p>
                        </div>
                        <div class="rightcont">
                            <div class="subtotal" style="margin:0 0 50px 0;">
                                <ul>
                                    <li style="width:100px;">sub total</li>
                                    <li>$</li>
                                    <li id='totalvalue'>0</li>
                                </ul>


                            </div>

                            <div class="proceed"><a href="#" onclick="makeSubmit()">proceed to purchase</a>
                            </div>

                            <div class="btngoon"><a href="store-home.php">continue shopping</a>
                            </div>

                        </div>
                    </div>
                </article>
            </div>
        </div>
        <!--        <div  id="nav_up" class="arrowup"><a href="#intro" title="Next Section"><img src="images/arrow-up2.png" style="clear:both; margin:0 auto;"><br><span style="width:100%;">Top</span></a></div>-->
    </section>

<?php include 'inc-footer.php'; ?>
<script type="text/javascript" src="js/shop-cart-total.js"></script>

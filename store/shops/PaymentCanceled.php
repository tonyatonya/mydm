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


    <link rel="stylesheet" type="text/css" href="css/totop-style.css" media="screen"/>
    <link href="css/css-shop.css" rel="stylesheet" type="text/css">

    <!--CSS -->

    <link href="../css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="../js/tooltip.js" type="text/javascript"></script>
    <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>-->
    <link href="css/store-style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="../css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/column.css" rel="stylesheet" type="text/css"/>
    <link href="../css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/gen-font.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/animate.css">

    <script language="javascript" type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <!--   ################ Smart  Ajax ####################-->
    <script type="text/javascript" src="/store/shops/library/Common/appfunction.js"></script>

    <link rel="stylesheet" href="/store/css/remodal.css">
    <link rel="stylesheet" href="/store/css/remodal-default-theme.css">


    <!--  CART  -->
    <script type="text/javascript" src="../addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="../account.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var nice = $("html").niceScroll();  // The document page (body)

        });
    </script>
</head>

<!-- HEADER BOX -->
<header class="header">
    <div id="top-nav">
        <div class="boxleft">
            <a id="swit-btn" class="current" href="#">STORE</a>
            <a id="swit-btn" href="#" style="margin-right:20px;">STUDIO</a>
            <ul>
                <li><a id="others-btn" href="#modal" class="current">THAILAND</a></li>
                <li id="others-btn">$ USD</li>
                <li><a id="others-btn" href="#modal">ENGLISH</a></li>
            </ul>
        </div>

    </div>
    <div class="container clearfix">
        <a id="logo" class="col" href="#"></a>
        <div class="boxright">
            <ul>
                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip1', {sticky:true, position:2, cssClass:'no-padding', offsetX:512})"><img
                            src="../images/top-icon-fav.svg"></a>
                </li>

                <li style="position:relative">
                    <div class="bagcount"></div>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip2', {sticky:true, position:2, cssClass:'no-padding', offsetX:530})"><img
                            src="../images/top-icon-count.svg"></a>
                </li>

                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip3', {sticky:true, position:2, cssClass:'no-padding', offsetX:548})"><img
                            src="../images/top-icon-member.svg"></a>
                </li>
            </ul>
        </div>
        <nav>
            <a href="index.html" class="navitem">COLLECTIONS</a>
            <a href="../shop/index.html" class="navitem">SHOP</a>
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
                <a href="/store/account/member-account.php" class="btn">VIEW MY FAVOURITE</a>
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
                    <a href="/store/shops/shop-cart-total.php" class="btn" id="viewbag"
                       style="display: none">VIEW BAG </a>
                    <a href="/store/shops/" class="btn">SHOP NOW!!</a>
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
                <a href="/store/account/member-account.php" class="btn" id="member" style="display: none">YOUR INFO</a>
                <a href="/store/account/login.php" class="btn" id="signin">SIGN IN</a>
                <a class="btn" id="signout" style="display: none;cursor: pointer">SIGN OUT</a>
            </div>
        </div>
    </div>

</div>
<!-- HEADER BOX -->

<body>

<div id="intro">


    <section id="scontainer" name="scontainer" style="margin-top: 150px">
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
                        <p style="text-align: center">
                            Payment was cancelled. You are not yet to complete order.
                        </p>
                    </div>
                    <div id="resultcont">
                        <div class="rightcont">
                            <div class="btngoon"><a href="store-home.php">continue shopping</a>
                            </div>

                        </div>
                    </div>

            </div>
        </div>
        </article>
    </section>

</div>


<script>

    $(document).ready(function () {

        var nice = $("html").niceScroll();  // The document page (body)

    });

</script>

<script src="js/form-scripts.js"></script>
<script src="js/scroll-startstop.events.jquery.js" type="text/javascript"></script>
<script>
    $(function () {
        var $elem = $('#intro');

        $('#nav_up').fadeIn('slow');


        $('#nav_up').click(
            function (e) {
                $('html, body').animate({scrollTop: '0px'}, 800);
            }
        );
    });

    $(document).ready(function () {

        var nice = $("html").niceScroll();  // The document page (body)

    });

</script>
</body>
<section class="container clearfix">
    <div class="grid_12">
        <div class="wrapper grid3">

            <article class="col">
                <div class="footer-nav">
                    <a id="footer-btn" href="#modal">FAQ</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="#modal">TERMS</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="#modal">CONTACT</a>
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
</html>

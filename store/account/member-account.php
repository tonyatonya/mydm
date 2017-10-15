<?php



session_start();

require_once "initapp.php";


if(empty($_SESSION['u_id']) ){
    header("Location: login.php");
}

$user = $_SESSION;
$user_id = $_SESSION['u_id'];

$sql = "select * from sto_fav_list fl join sto_products pd on pd.p_id = fl.p_id join sto_pattern pat on pd.p_pattern_id = pat.p_pattern_id where fl.u_id = '" . $user_id . "' ";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
while ($db->read()) {

    $myfav[] = $db->result;

}


$sql = "select * from sto_purchased ps join sto_products pd on pd.p_id = ps.p_id join sto_pattern pat on pd.p_pattern_id = pat.p_pattern_id where ps.u_id = '" . $user_id . "' ";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
while ($db->read()) {

    $myorder[] = $db->result;

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
<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>-->
    <link href="css/account.css" rel="stylesheet" type="text/css" />
    <link href="../css/header-menu.css" rel="stylesheet" type="text/css" />
    <link href="../css/general-style.css" rel="stylesheet" type="text/css" />
    <link href="../css/column.css" rel="stylesheet" type="text/css" />
    <link href="../css/grid.css" rel="stylesheet" type="text/css" />
    <link href="../css/gen-font.css" rel="stylesheet" type="text/css" />

    <script  language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>


    <link href="../css/tooltip.css" rel="stylesheet" type="text/css" />
    <script src="../js/tooltip.js" type="text/javascript"></script>
    <!--  CART  -->
    <script type="text/javascript" src="/store/addcart.js"></script>
    <!--  Favorite -->
    <script type="text/javascript" src="/store/addfav.js"></script>
    <!--  Favorite -->
    <script type="text/javascript" src="/store/account.js"></script>

</head>
<body>


<header class="header">
    <div id="top-nav">
        <div class="boxleft">
            <a id="swit-btn" class="current" href="../index.html">STORE</a>
            <a id="swit-btn" href="../../studio/index.html" target="_blank" style="margin-right:20px;">STUDIO</a>
        </div>

    </div>
    <div class="container clearfix">
        <a id="logo" class="col" href="../index.html"></a>
        <div class="boxright">
            <ul>
                <li>
                    <a  id="icon-btn" class="tooltip" href="#demo1_tip" onclick="tooltip.pop(this, '#tip1', {sticky:true, position:2, cssClass:'no-padding', offsetX:512})"><img src="../images/top-icon-fav.svg"></a>
                </li>

                <li style="position:relative"><div class="bagcount"></div>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip" onclick="tooltip.pop(this, '#tip2', {sticky:true, position:2, cssClass:'no-padding', offsetX:530})"><img src="../images/top-icon-count.svg"></a>
                </li>

                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip" onclick="tooltip.pop(this, '#tip3', {sticky:true, position:2, cssClass:'no-padding', offsetX:548})"><img src="../images/top-icon-member.svg"></a>
                </li>
            </ul>
        </div>
        <nav>
            <a href="index.html" class="navitem">COLLECTIONS</a>
            <a href="../shop/index.html" class="navitem">SHOP</a>
            <a href="../story/index.html" class="navitem">STORY</a>
            <a href="../blog/index.html" class="navitem">BLOG</a>
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
                    <a href="/store/shops/shop-cart-total.php" class="btn" id="viewbag" style="display: none">VIEW BAG </a>
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
                <a href="/store/account/member-account.php" class="btn" id="member" style="display: none" >YOUR INFO</a>
                <a href="/store/account/login.php" class="btn" id="signin">SIGN IN</a>
                <a  class="btn" id="signout" style="display: none;cursor: pointer" >SIGN OUT</a>
            </div>
        </div>
    </div>

</div>

<section class="container clearfix">
    <div id="cont3">
        <article class="member-detail">name : <?= $user['u_name'] ?></article>
        <article class="member-detail">username : <?= $user['u_login'] ?></article>
        <article class="member-detail">country : <?= $user['u_country'] ?></article>
        <hr>
        <h4>Your bought listed</h4>
        <hr>
        <div class="wrapper grid4" style="padding-bottom:30px !important;">
            <?php foreach ($myorder as $item) { ?>
                <article class="colacc">
                    <img src="../images/products/product-thumbs/<?= $item['p_thumb_image'] ?>" >
                    <div class="name"><?=$item['p_pattern_name']?></div>
                    <div class="type"><?=$item['p_name']?></div>
                    <div class="no">Item no:<span><?=$item['p_code']?></span></div>
                    <div class="view">view</div>
                </article>
            <? } ?>


        </div>
        <hr>
        <h4>Your favourite listed</h4>
        <hr>
        <div class="wrapper grid4" style="margin-top:30px">

            <?php foreach ($myfav as $item ) { ?>
            <article class="colacc">
                <img src="../images/products/product-thumbs/<?= $item['p_thumb_image'] ?>" >
                <div class="name"><?=$item['p_pattern_name']?></div>
                <div class="type"><?=$item['p_name']?></div>
                <div class="no">Item no:<span><?=$item['p_code']?></span></div>
                <div class="view">view</div>
            </article>
            <?php } ?>
        </div>
    </div>
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

            <article class="col3" style=" width:38%; font-size:11px; color:#333; margin-top:20px; letter-spacing:1px; font-family:Georgia, 'Times New Roman', Times, serif; font-weight:bold;">MYDM : Inspiring handcraft patterns created for your everyday life
            </article>

            <article class="col4" style="width:24%;">
                <div class="contain">
                    <div class="cont">
                        <ul>
                            <li><a href="https://www.facebook.com/MYDM.ME" target="_blank"><img src="../images/bullet-fb.svg"></a></li>
                            <li><a href="https://www.instagram.com/mydm.me" target="_blank"><img src="../images/bullet-insta.svg"></a></li>
                            <li><a href="https://www.pinterest.com/mydmme" target="_blank"><img src="../images/bullet-pin.svg"></a></li>
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


<script>
    $(document).ready(function() {
        $('nav').before('<div id="smartbutton"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');

        // add click listener
        $('#smartbutton').click(function(event)
        {
            $('nav').animate({height:'toggle'},200);
        });
    });
</script>
<script>
    $(document).ready(function() {

        var nice = $("html").niceScroll();  // The document page (body)

    });

    $(window).on("scroll", function() {
        if($(window).scrollTop() > 50) {
            $(".header").addClass("active");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $(".header").removeClass("active");
        }
    });

</script>

<script>
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header').outerHeight();

    $(window).scroll(function(event){
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            $('header').removeClass('header').addClass('nav-up');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $('header').removeClass('nav-up').addClass('header');
            }
        }

        lastScrollTop = st;
    }
    $(function() {

        $('#st-accordion').accordion();

    });
</script>
</body>
</html>
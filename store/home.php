<?php
session_start();
require_once("initapp.php");


//in case empty tag
$sql = "select * from sto_blog blog where blog.blog_id <> 0 and blog.blog_status != 'hide' and blog.blog_type = 'inspiring design' group by blog.blog_id order by blog.blog_id desc";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
if ($db->read()) {
    $inspi_blog = $db->result;
}

$sql = "select * from sto_blog blog where blog.blog_id <> 0 and blog.blog_status != 'hide' and blog.blog_type = 'press' group by blog.blog_id order by blog.blog_id desc";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
if ($db->read()) {
    $press_blog = $db->result;
}


?>

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
    <link href="css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="js/tooltip.js" type="text/javascript"></script>

    <link href="css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/responsiveslides.css" rel="stylesheet" type="text/css"/>
    <link href="css/column.css" rel="stylesheet" type="text/css"/>
    <link href="css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="css/gen-font.css" rel="stylesheet" type="text/css"/>

<!--    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>-->

    <link rel="stylesheet" href="css/remodal.css">
    <link rel="stylesheet" href="css/remodal-default-theme.css">

    <style>
        .remodal-bg.with-red-theme.remodal-is-opening,
        .remodal-bg.with-red-theme.remodal-is-opened {
            filter: none;
        }

        .remodal-overlay.with-red-theme {
            background-color: #fff;
        }

        .remodal.with-red-theme {
            background: #fff;
        }
    </style>

    <!--<script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/responsiveslides.js"></script>

    <!--  CART  -->
    <script type="text/javascript" src="addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="account.js"></script>

</head>
<body>


<header class="header">
    <div id="top-nav">
        <div class="boxleft">
            <a id="swit-btn" class="current" href="index.html">STORE</a>
            <a id="swit-btn" href="../studio/index.html" target="_blank" style="margin-right:20px;">STUDIO</a>
        </div>

    </div>
    <div class="container clearfix">
        <a id="logo" class="col" href="index.html"></a>
        <div class="boxright">
            <ul>
                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip1', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="images/top-icon-fav.svg"></a>
                </li>

                <li style="position:relative">
                	<div class="bag-container">
                    <div class="bagcount"></div>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip2', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="images/top-icon-count.svg"></a>
                	</div>
                </li>

                <li>
               		<a id="icon-btn" class="tooltip member-btn" href="#">
	               		<img src="images/top-icon-member.svg">
	               	</a>

                </li>
            </ul>
        </div>
        <nav>
            <a href="collection/index.html" class="navitem">COLLECTIONS</a>
            <a href="shops/index.html" class="navitem">SHOP</a>
            <a href="story/index.html" class="navitem">STORY</a>
            <a href="blog/index.html" class="navitem">BLOG</a>
            <a href="misc/contact.php" class="navitem">LOCATION</a>
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
                <a href="account/member-account.php" class="btn">VIEW MY FAVOURITE</a>
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
                    <a href="shops/shop-cart-total.php" class="btn" id="viewbag"
                       style="display: none">VIEW BAG </a>
                    <a href="shops/" class="btn">SHOP NOW!!</a>
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
                <a href="account/member-account.php" class="btn" id="member" style="display: none">YOUR INFO</a>
                <a href="account/login.php" class="btn" id="signin">SIGN IN</a>
                <a class="btn" id="signout" style="display: none;cursor: pointer">SIGN OUT</a>
            </div>
        </div>
    </div>

</div>
<section style="margin-bottom:40px;">
    <div>
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/0.jpg" alt="">
            </li>
            <li>
                <img src="images/00.jpg" alt="">
            </li>
        </ul>
    </div>

</section>

<section class="container clearfix" style="margin-bottom:60px;">
    <div class="containerv">
        <img src="images/cutnpaint.svg"><br>
        <br>
        <a href="pdf/MYDM Catalogue_151217 with no price.pdf" target="_blank" class="head">download catalogue here >
            ></a>
        <div class="content"><img src="images/examp-pic-vid.jpg"></div>
        <!--
           <div class="vendor">
               <iframe src="http://player.vimeo.com/video/120923743?title=0&amp;byline=0&amp;portrait=0" width="auto" height="auto"
                   frameborder="0">
               </iframe>
           </div>
           -->
    </div>
</section>

<section class="container clearfix" style="margin-bottom:60px;">
    <div id="content" class="grid_12">
        <div class="wrapper grid3">
            <div class="allitem-nav">
                <a id="swit-btn" class="current" href="shops/store-home.php" style="font-size:10px !important">VIEW ALL ITEMS</a>
            </div>
            <article class="col">
                <a href="shops/store-home.php?type=1"><img src="images/home-coll-01.jpg">
                    <div class="name">HOME & LIVING</div>
                    <hr>
                    <p>Make your home happy</p></a>
            </article>

            <article class="col">
                <a href="shops/store-home.php?type=2"><img src="images/home-coll-02.jpg">
                    <div class="name">WEAR</div>
                    <hr>
                    <p>Make yourself lively</p>
            </article>

            <article class="col">
                <a href="shops/store-home.php?type=3"><img src="images/home-coll-03.jpg">
                    <div class="name">FABRIC</div>
                    <hr>
                    <p>Be creative and inspired</p></a>
            </article>

        </div>
    </div>
</section>

<section class="container  clearfix" style="margin-bottom:60px;">
    <div id="content" class="grid_12">
        <div class="wrapper grid3">
            <article class="col2">
                <a href="#top" id="gimmic"><img src="images/gimmic.svg"></a>
            </article>

            <article class="col2">
                <a href="blog/blog-detail.php?id=<?= $inspi_blog['blog_id'] ?>">
                    <img src="blog/images/blog/<?= $inspi_blog['blog_thumb_img'] ?>">
                    <span>Inspiration Design</span></a>
            </article>

            <article class="col2">
                <a href="blog/blog-detail.php?id=<?= $press_blog['blog_id'] ?>">
                    <img src="blog/images/blog/<?= $press_blog['blog_thumb_img'] ?>">
                    <span>Press</span></a>
            </article>

        </div>
    </div>
</section>

<section class="container clearfix">
    <div class="grid_12">
        <div class="wrapper grid3">

            <article class="col">
                <div class="footer-nav">
                    <a id="footer-btn" href="misc/faq.php">FAQ</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="misc/terms.php">TERMS</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="misc/privacy-policy.php">PRIVACY POLICY</a>
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
                                        src="images/bullet-fb.svg"></a></li>
                            <li><a href="https://www.instagram.com/mydm.me/" target="_blank"><img
                                        src="images/bullet-insta.svg"></a></li>
                            <li><a href="https://www.pinterest.com/mydmme" target="_blank"><img
                                        src="images/bullet-pin.svg"></a></li>
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

<div class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
    <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
    <div>
        <img src="images/popup.jpg">
        <div class="stt"></div>
        <p>
            Our team is currently working very hard on the website.<br>
            For now you can view our product via catalogue.
        </p>
        <img src="images/arrow_popup.svg" style="width:5%; clear:both;"><br>
        <a href="pdf/MYDM Catalogue_151217 with no price.pdf" target="_blank" class="head" style="letter-spacing:2px;">download</a>
    </div>
</div>

<script>
    // You can also use "$(window).load(function() {"
    $(function () {

        // Slideshow 4
        $("#slider4").responsiveSlides({
            auto: true,
            pager: false,
            nav: true,
            maxwidth: 'auto',
            speed: 2000,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });

</script>

<script type="text/javascript" src="js/jquery.fitvids.js"></script>
<script>
    // Basic FitVids Test
    $(".containerv").fitVids();
    // Custom selector and No-Double-Wrapping Prevention Test
    $(".containerv").fitVids({customSelector: "iframe[src^='http://socialcam.com']"});
</script>

<script src="js/remodal.js"></script>

<!-- Events -->
<script>
    $(document).on('opening', '.remodal', function () {
        console.log('opening');
    });

    $(document).on('opened', '.remodal', function () {
        console.log('opened');
    });

    $(document).on('closing', '.remodal', function (e) {
        console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
    });

    $(document).on('closed', '.remodal', function (e) {
        console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
    });

    $(document).on('confirmation', '.remodal', function () {
        console.log('confirmation');
    });

    $(document).on('cancellation', '.remodal', function () {
        console.log('cancellation');
    });

    //  Usage:
    //  $(function() {
    //
    //    // In this case the initialization function returns the already created instance
    //    var inst = $('[data-remodal-id=modal]').remodal();
    //
    //    inst.open();
    //    inst.close();
    //    inst.getState();
    //    inst.destroy();
    //  });

    //  The second way to initialize:
    $('[data-remodal-id=modal2]').remodal({
        modifier: 'with-red-theme'
    });

    if ($('#gimmic').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('#gimmic').addClass('show');
                } else {
                    $('#gimmic').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#gimmic').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    // Hide Header on on scroll down
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


</script>

<script type="text/javascript" src="js/main.js"></script>
<!--------------------------- ---------------------------------------->
<link href="css/fixed.css" rel="stylesheet"/>

<script type="text/javascript" src="js/bootstrap.js"></script>
<?php include('login.php'); ?>
<!--------------------------- ---------------------------------------->
</body>
</html>
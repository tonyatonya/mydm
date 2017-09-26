<?php
session_start();
require_once "initapp.php";


$list_page = "blog.php";
$products_list = "";
$i = 0;
$tag = $_GET['tag'];
$type = $_GET['type'];
if (!$_POST) {


} else {

    if ($_POST['cmd'] == 'loadBlog') {
        $command = $_POST['cmd'];
        $type = $_POST['type'];
        $blog_tag = $_POST['tag'];


        if (!empty($type)) {

            $cause .= "and blog.blog_type = '" . $type . "'";
        }

        if (!empty($blog_tag)) {

            $cause2 .= "and bt.blog_tag_name = '" . $blog_tag . "'";
        }
        //in case empty tag
        if (empty($blog_tag)) {
            $sql = "select * from sto_blog blog where blog.blog_id <> 0 and blog.blog_status != 'hide' " . $cause . "group by blog.blog_id order by blog.blog_id desc";
        } else {
            $sql = "select * from sto_blog blog join sto_blog_tags bt on blog.blog_id = bt.blog_id where blog.blog_id <> 0 and blog.blog_status != 'hide' " . $cause2 . "group by blog.blog_id order by blog.blog_id desc";
        }


        if (!$db->execute($sql))
            throw new Exception("Operation Error");


        $blogs_list = "";
        while ($db->read()) {
            $i += 1;

            $blogs_list .= " <article class='wall-item'>";
            $blogs_list .= "   <div class='label'>" . $db->result['blog_type'] . "</div>";
            $blogs_list .= "    <h1>" . $db->result['blog_title'] . "</h1>";
            $blogs_list .= "   <img src=\"../blog/images/blog/" . $db->result['blog_thumb_img'] . "\"   >";
            $blogs_list .= "     <p>" . $db->result['blog_information'] . "</p>";
            $blogs_list .= "      <a href='#' class='morenshare'>share</a>";
            $blogs_list .= "     <a href='blog-detail.php?id=" . $db->result['blog_id'] . "' class='morenshare'>read more</a>";
            $blogs_list .= " </article>";


        }


        $data = array();

        $data['content_data'] = $blogs_list;
        $result['message'] = $data;


    }

    echo json_encode($result);
    exit();
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

    <link href="../css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="../js/tooltip.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href="css/blog-style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="../css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/column.css" rel="stylesheet" type="text/css"/>
    <link href="../css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/gen-font.css" rel="stylesheet" type="text/css"/>
    <!--   ################ Smart  Ajax ####################-->
    <script type="text/javascript" src="/store/shops/library/Common/appfunction.js"></script>

    <link rel="stylesheet" href="/store/css/remodal.css">
    <link rel="stylesheet" href="/store/css/remodal-default-theme.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <!--  CART  -->
    <script type="text/javascript" src="/store/addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="/store/account.js"></script>

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
        <a id="logo" class="col" href="../index.html"></a>
        <div class="boxright">
            <ul>
                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip1', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="../images/top-icon-fav.svg"></a>
                </li>

                <li style="position:relative">
                    <div class="bagcount"></div>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip2', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="../images/top-icon-count.svg"></a>
                </li>

                <li>
                    <a id="icon-btn" class="tooltip" href="#demo1_tip"
                       onclick="tooltip.pop(this, '#tip3', {sticky:true, position:4, cssClass:'no-padding'})"><img
                            src="../images/top-icon-member.svg"></a>
                </li>
            </ul>
        </div>
        <nav>
            <a href="../collection/index.html" class="navitem">COLLECTIONS</a>
            <a href="../shops/index.html" class="navitem">SHOP</a>
            <a href="../story/index.html" class="navitem">STORY</a>
            <a href="index.html" class="navitem">BLOG</a>
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

<script type="text/javascript">

    function searchProduct(type) {
        var submit = 1;
        if (typeof(type) === "undefined") {
            type = 0;
        }
        var tag = $('#tag').val();
        var navigate_type = $('#type').val();

        if (navigate_type != "") {
            type = navigate_type;
        }


        if (submit == 1) {
            var ajax = new SmartAjax('POST', '<?=$list_page?>', 'type=' + type + '&tag=' + tag);
            ajax.requestJSON("loadBlog",
                function (response) {
                    var msg = response.message;

                    $('#cont').html(msg.content_data);
                    $('#cont').trigger("create");
                    $('.wall').jaliswall({item: '.wall-item'});

                }
            );
        }

    }

    $(document).ready(function () {
        searchProduct();
    });


    $(document).ready(function () {

        $('#all').click(function () {
            searchProduct(0);
        });

        $('#inspi_type').click(function () {
            searchProduct('inspiring design');
        });

        $('#press_type').click(function () {

            searchProduct('press');
        });
    });
</script>
<style>

    .wall-item {
        margin-top: 25px;
        font-size: 21px;
        text-align: center;
        -webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
        -moz-animation: fadein 2s; /* Firefox < 16 */
        -ms-animation: fadein 2s; /* Internet Explorer */
        -o-animation: fadein 2s; /* Opera < 12.1 */
        animation: fadein 2s;
    }

    @keyframes fadein {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Firefox < 16 */
    @-moz-keyframes fadein {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Safari, Chrome and Opera > 12.1 */
    @-webkit-keyframes fadein {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Internet Explorer */
    @-ms-keyframes fadein {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Opera < 12.1 */
    @-o-keyframes fadein {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

</style>


<section class="container clearfix">
    <div class="bmenucont">

        <a id="all" href="#" class="blogmenu">view all</a>
        <a id="inspi_type" href="#" class="blogmenu">

            inspiring design</a>
        <a id="press_type" href="#" class="blogmenu">press

        </a>

    </div>

    <input type="hidden" id="tag" value="<?= $tag ?>">
    <input type="hidden" id="type" value="<?= $type ?>">
    <div id="cont" class="wall">

    </div>


</section>

<section class="container clearfix">
    <div class="grid_12">
        <div class="wrapper grid3">

            <article class="col">
                <div class="footer-nav">
                    <a id="footer-btn" href="../misc/faq.html">FAQ</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="../misc/terms.html">TERMS</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="../misc/privacy-policy.html">PRIVACY POLICY</a>
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


<script>
    $(document).ready(function () {
        $('nav').before('<div id="smartbutton"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');
        $('#smartbutton').append('<div class="buttonline"></div>');

        // add click listener
        $('#smartbutton').click(function (event) {
            $('nav').animate({height: 'toggle'}, 200);
        });
    });
</script>
<script>
    $(document).ready(function () {

        var nice = $("html").niceScroll();  // The document page (body)

    });

    $(window).on("scroll", function () {
        if ($(window).scrollTop() > 50) {
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
    //		$(function() {
    //
    //				$('#st-accordion').accordion();
    //
    //            });
</script>
<script src="js/jaliswall.js"></script>

<script>

    $('.wall').jaliswall({item: '.wall-item'});
</script>
</body>
</html>
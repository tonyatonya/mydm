<?php


require_once ('initapp.php');

session_start();
if(!$_SESSION)
{
    header('Location: /store/account/login.php');
}


//COOKIE VALUE
$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);

$cookie = $_COOKIE['shoppingCart'];
if(!$cookie)
    header('Location: /store/shops');
$cookie = stripslashes($cookie);
$savedCardArray = json_decode($cookie, true);
$data = array();
foreach ($savedCardArray as $item)
{
    $data[] = $item['id'];
}

// TRANSACTION ID
$transaction_id = 'NULL';
if(isset($_SESSION['PayPalTransactionID'])){
    $transaction_id = $_SESSION['PayPalTransactionID'];
}


$purchased = array();

$user_id = $_SESSION['u_id'];
mysql_query('set names utf8');
foreach ($data as $key => $item)
{
    $purchased =  array(
        'u_id' => $user_id,
        'p_id' => $item,
        'transaction_id' => $transaction_id
    );

    $columns = implode(", ",array_keys($purchased));
    $escaped_values = array_map('mysql_real_escape_string', array_values($purchased));
    $values  = implode(", ", $escaped_values);
    $sql = "insert into sto_purchased ( $columns ) VALUES ( $values )";

    $exec = mysql_query($sql) or die(mysql_error());

}






if($exec)
    setcookie("shoppingCart", "", time() - 3600 ,'/store/');


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


<!--CSS -->
\

<!--<link rel="stylesheet" href="css/responsivemobilemenu-op.css" type="text/css"/>-->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="css/totop-style.css" media="screen"/>
<link href="css/css-shop.css" rel="stylesheet" type="text/css">



<body>


<section id="scontainer" name="scontainer" style="margin-top: 200px;">
    <div class="container clearfix">
        <div id="content" class="grid_12">
            <div id="pageheader" class="grid_1-5">SHOP
            </div>
            <div id="pagedes">Every detail counts.</div>
            <div id="articlecont2">
                <h3>SHOPPING CART</h3>
            </div>
            <article class="grid_12">

                <div id="totalcont" style="text-align: center">
                    <p><strong>Thank you for your order</strong></p>
                    <p>Your order has been completed as following detail <br/>
                        <?php
                        echo '<strong>Pay by</strong> : Paypal/Credit Card <br/>';
                        echo isset($_SESSION['PayPalTransactionID']) && $_SESSION['PayPalTransactionID'] != '' ? '<strong>Transaction ID</strong>: ' . $_SESSION['PayPalTransactionID'] . '<br/>' : '';
                        echo isset($_SESSION['GrandTotal']) && $_SESSION['GrandTotal'] != '' ? '<strong>Total</strong>: ' . number_format($_SESSION['GrandTotal'], 2) . ' Baht<br/>' : '';
                        ?>
                    </p>
                    <p>The products will be delivered to you within 7 working days </p>
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
    </div>
    </div>

</section>

</div>


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

<script>

    $(document).ready(function () {

        var nice = $("html").niceScroll();  // The document page (body)

    });
    function getCookie(c_name) {
        var c_value = document.cookie;
        var c_start = c_value.indexOf(" " + c_name + "=");
        if (c_start == -1) {
            c_start = c_value.indexOf(c_name + "=");
        }
        if (c_start == -1) {
            c_value = null;
        }
        else {
            c_start = c_value.indexOf("=", c_start) + 1;
            var c_end = c_value.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = c_value.length;
            }
            c_value = unescape(c_value.substring(c_start, c_end));
        }
        return c_value;
    }

    function deleteCookie(name) {
        var value = "";
        var days = -1;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toGMTString();
        }
        else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    $(document).ready(function () {


        var tmpval = getCookie("shoppingCart");
        if (tmpval != null && tmpval != "") {
            cart = JSON.parse(tmpval);
        } else {
            cart = [];
        }

        deleteCookie("shoppingCart");

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

</html>


<?php
require_once('library/paypal/includes/config.php');
require_once "initapp.php";

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Samsung eService</title>
    <link rel="stylesheet" href="css/fontstyle.css"/>
    <link rel="stylesheet" href="css/formalize.css"/>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.formalize.js"></script>
    <script src="js/appfunction.js"></script>
    <script src="js/BrowserDetect.js"></script>
    <script src="js/energize-min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/appair.js"></script>

</head>
<body>

<?php include "init_style.php" ?>

<!--<div id='pageContentForm' >
			<p><strong>ขอบคุณที่ใช้บริการค่ะ</strong></p>
			<p>เราได้รับชำระค่าบริการจากท่านเรียบร้อยแล้ว ตามรายละเอียดดังนี้<br/>
			<?php
/*			echo '<strong>ช่องทางการชำระ</strong> : Paypal/บัตรเครดิต <br/>';
			echo isset($_SESSION['PayPalTransactionID']) && $_SESSION['PayPalTransactionID'] != '' ? '<strong>Transaction ID</strong>: '.$_SESSION['PayPalTransactionID'].'<br/>' : '';
			echo isset($_SESSION['GrandTotal']) && $_SESSION['GrandTotal'] != '' ? '<strong>ยอดชำระ</strong>: '.number_format($_SESSION['GrandTotal'],2).' บาท<br/>' : '';

			$service = new Service($_SESSION['ItemID']);
			$service->updateStatus('PaymentNotified');

			*/ ?></p>
<!--			<p><strong>กรุณารอรับ SMS เพื่อยืนยันนัดหมายค่ะ</strong></p>-->


</body>
</html>
<script>
    var percent = parseInt($(window).width() * 100 / 400).toString() + "%";
    $("#pageContentForm").css("font-size", percent);
</script>
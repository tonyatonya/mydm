<?php
session_start();
$your_email = 'phai.subhawita@mydm.me';// <<=== update to your email address // phai.subhawita@mydm.me oudluck@gmail.com

$errors = '';

$name = $_SESSION['u_name'];
$email = $_SESSION['u_email'];
$sendto = '';
$user_message = '';
$user = $_SESSION;
//echo '5555555555555555';
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    if (!empty($_POST['subject']) && isset($_POST['subject'])) {
        $sendto = $_POST['subject'];
    } else {
        $errors .= "\n Please select subjects";
    }

    $user_message = $_POST['message'];

    ///------------Do Validations-------------
    if (empty($name) || empty($user_message)) {
        $errors .= "\n Name and Email are required fields. ";
    }
    if (IsInjected($email)) {
        $errors .= "\n Bad email value!";
    }
    //Capcha
    if (empty($_SESSION['6_letters_code']) ||
        strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0
    ) {
        //Note: the captcha code is compared case insensitively.
        //if you want case sensitive match, update the check above to
        // strcmp()
        $errors .= "\n The captcha code does not match!";
    }

    if (empty($errors)) {
        //send the email
        $to = $sendto;
        $subject = "Contact to ";
        $from = $email;
        echo $to . "\n";
        echo $subject;
        echo $from;
        echo $sendto;
//        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

        $body = "User Name :  $name submitted the contact form Mydm.me Store\n" .
            "NAME: $name\n" .
            "EMAIL: $email \n" .
            "MESSAGE: $user_message \n " .

            $headers = "From: $from \r\n";
        $headers .= "Reply-To: $sendto \r\n";

        mail($to, $subject, $body, $headers);

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
    if (preg_match($inject, $str)) {
        return true;
    } else {
        return false;
    }
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
    <link href="css/contact.css" rel="stylesheet" type="text/css"/>
    <link href="../css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="../css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/column.css" rel="stylesheet" type="text/css"/>
    <link href="../css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/gen-font.css" rel="stylesheet" type="text/css"/>

    <script language="javascript" type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <script language="JavaScript" src="scripts/gen_validatorv31.js" type="text/javascript"></script>

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
            <a href="../blog/index.html" class="navitem">BLOG</a>
            <a href="contact.php" class="navitem">LOCATION</a>
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

<section class="container clearfix">
    <div id="cont">
        <div class="infocol">
            <img src="images/logo2.svg" style="zoom:80%;">
            <h3>MYDM PRODUCT ENQUIRIES</h3>
            <p>If you have a question about any of our<br>
                products, feel free to contact us:</p>
            <p>E: info@mydm.me</p>

            <h3>MYDM STUDIO</h3>
            <p>MYDM studio is our homey place where<br>
                we create all beautiful design.<br></p>
            <p>13 Sukhumvit 85 Road<br>
                Bangchak, Phra Khanong<br>
                Bangkok 10260, Thailand.<br>
                E: info@mydm.me<br>
                phai.subhawita@mydm.me</p>

            <h3>PR & MARKETING ENQUIRIES</h3>
            <p>Please be in touch with us at:<br>
                E: marketing@mydm.me</p>

            <h3>INTERN / JOB ENQUIRIES</h3>
            <p>If you would like to get some hand-on<br>
                experience at MYDM, please include<br>
                your resume and the reason you’d like to<br>
                intern or become a part of us.<br><br>
                E: info@mydm.me</p>
        </div>

        <div class="formcol">
            <?php
            if (!empty($errors)) {
                echo "<p class='err' style='color: red'>" . nl2br($errors) . "</p>";
            }
            ?>


            <form id="form" name="form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

                <img src="images/contact.svg" style="zoom:150%;">
                <div>
                    <label for='name'>your name <span class='required'>(required)</span></label>
                    <input type='text' name='name' value="<?php echo $name ?>">
                </div>

                <div>
                    <label for='email'>your email <span class='required'>(required)</span></label>
                    <input type='email' name='email' value="<?php echo $email ?>">
                </div>
                <div class="style-select">
                    <label for='subject'>select subject <span class='required'>(required)</span></label>
                    <select name='subject' size="1">
                        <!--                        List Email in value              -->
                        <option value="">- please select -</option>
                        <option value="info@mydm.me">Customer service</option>
                        <option value="marketing@mydm.me">Marketing and PR enquiries</option>
                        <option value="marketing@mydm.me">Business partnership</option>
                        <option value="info@mydm.me">Career opportunity</option>
                        <option value="info@mydm.me">Others</option>
                        select subject require<span class='required'>(required)</span></select>
                </div>

                <div>
                    <label for='message'>your message <span class='required'>(required)</span></label>
                    <textarea name='message' required><?php echo $user_message ?></textarea>
                </div>
                <div>
                    <img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg'><br>
                    <label for='message'>
                        <h4>Enter the code above here :<h4>
                    </label><br>
                    <input id="6_letters_code" name="6_letters_code" type="text"><br>
                    <h4>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh<h4>
                </div>

                <div>

                    <button name="submit" type='submit'>SEND</button>
                    <button type='reset'>RESET</button>

                </div>
            </form>


        </div>
    </div>
</section>

<section class="container clearfix">
    <div class="grid_12">
        <div class="wrapper grid3">

            <article class="col">
                <div class="footer-nav">
                    <a id="footer-btn" href="faq.html">FAQ</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="term.html">TERMS</a>
                    <div id="footer-btn-bullet"></div>
                    <a id="footer-btn" href="privacy-policy.html">PRIVACY POLICY</a>
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

<script language="JavaScript">
    // Code for validating the form
    // Visit http://www.javascript-coder.com/html-form/javascript-form-validation.phtml
    // for details
    var frmvalidator = new Validator("form");
    //remove the following two lines if you like error message box popups
    frmvalidator.EnableOnPageErrorDisplaySingleBox();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("name", "req", "Please provide your name");
    frmvalidator.addValidation("email", "req", "Please provide your email");
    frmvalidator.addValidation("email", "email", "Please enter a valid email address");
</script>
<script language='JavaScript' type='text/javascript'>
    function refreshCaptcha() {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
    }
</script>

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
    $(function () {

        $('#st-accordion').accordion();

    });
</script>
</body>
</html>
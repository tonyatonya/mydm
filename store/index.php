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
	<?php include 'inc-header.php'; ?>
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

	<?php include 'inc-footer.php'; ?>

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
<script type="text/javascript" src="js/jquery.fitvids.js"></script>
<script src="js/remodal.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/store-index.js"></script>
<!-- ------------------------- ---------------------------------------->
<link href="css/fixed.css" rel="stylesheet"/>

<script type="text/javascript" src="js/bootstrap.js"></script>
<?php include('login.php'); ?>
<!-- ------------------------- ---------------------------------------->
</body>
</html>

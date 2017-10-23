<?php

session_start();

require_once "initapp.php";


$product_detail = array();
$product_care_icon = array();
$products_data = "";
if (isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])) {
    $user_id = $_SESSION['u_id'];
} else {
    $user_id = 0;
}


$product_id = mysql_escape_string($_GET['p_id']);
//$sql = "select * from sto_products pro join sto_pattern pat on pro.p_pattern_id = pat.p_pattern_id join sto_category cate on cate.p_cate_id = pro.p_cate_id where p_id = '" .$_GET['id']. "' ;";
$sql = "select * from sto_products pro join sto_pattern pat on pro.p_pattern_id = pat.p_pattern_id join sto_category cate on cate.p_cate_id = pro.p_cate_id where pro.p_id = '" . $product_id . "'";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
if ($db->read()) {
    $product_detail = $db->result;
    $products_data .= " {id: " . $db->result['p_id'] . ",code: '" . $db->result['p_code'] . "', name:'" . $db->result['p_name'] . "', price:" . $db->result['p_price'] . ",image:'" . $db->result['p_thumb_image'] . "',qty:1}";
}

$sql = "select * from sto_products pro join sto_pattern pat on pro.p_pattern_id = pat.p_pattern_id join sto_category cate on cate.p_cate_id = pro.p_cate_id where pro.p_id = '" . $product_detail['p_ref1_id'] . "' or pro.p_id = '" . $product_detail['p_ref2_id'] . "'";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
while ($db->read()) {
    $product_link[] = $db->result;
}

$sql = "select * from sto_products pro join sto_pattern pat on pro.p_pattern_id = pat.p_pattern_id join sto_category cate on cate.p_cate_id = pro.p_cate_id where pro.p_id = '" . $product_detail['p_ref2_id'] . "'";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
if ($db->read()) {
    $product_link2 = $db->result;
}

$sql = "select * from sto_care_icon sci join sto_icon_refer sir on sir.p_icon_id = sci.p_icon_id where sci.p_id = '" . $product_id . "'";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
while ($db->read()) {
    $product_care_icon[] = $db->result;

}

$sql = "select * from sto_product_collection where  p_id = '" . $product_id . "' order by seq asc";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
while ($db->read()) {
    $product_collection[] = $db->result;
}

$sql = "select * from sto_product_descrip_img where  p_id = '" . $product_id . "'  order by seq desc";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
while ($db->read()) {
    $product_descrip_img[] = $db->result;
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


    <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>-->
    <link href="css/store-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/light-carousel.css" rel="stylesheet" type="text/css">
    <link href="../css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="../css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/column.css" rel="stylesheet" type="text/css"/>
    <link href="../css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="../css/gen-font.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <!--<script language="javascript" type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="../js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <!--   ################ Smart  Ajax ####################-->
    <script type="text/javascript" src="../shops/library/Common/appfunction.js"></script>

    <link rel="stylesheet" href="../css/remodal.css">
    <link rel="stylesheet" href="../css/remodal-default-theme.css">
    <!--    TOOL TIPS -->
    <link href="../css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="../js/tooltip.js" type="text/javascript"></script>


    <!--  Favorite -->
    <script type="text/javascript" src="../addfav.js"></script>
    <!--  CART  -->
    <script type="text/javascript" src="../addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="../account.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            var nice = $("html").niceScroll();  // The document page (body)

        });

        $(function () {
            $("#facebook-share").on("click", function () {
                var url = window.location.href;     // Returns full URL
                var fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "pop", "width=600, height=400, scrollbars=no");
                return false;
            });

            $("#twitter-share").on("click", function () {
                var url = window.location.href;     // Returns full URL
                var fbpopup = window.open("https://twitter.com/intent/tweet?text=" + url, "pop", "width=700, height=450, scrollbars=no");
                return false;
            });

            $("#pinterest-share").on("click", function () {
                var url = window.location.href;     // Returns full URL
                var title = $('#title').text();
                var img_url = 'http://mydm.me../' + $('#url_img').val();
                var fbpopup = window.open("http://pinterest.com/pin/create/button/?url=" + url + "&media=" + img_url + "&description=" + title, "pop", "width=700, height=450, scrollbars=no");
                return false;
            });

        });


    </script>


</head>
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
<section class="container clearfix">
    <div id="cont">
	    <div class="filter-group">
			<button class="viewall">VIEW ALL ITEMS</button>
			<div class="select-holder">
				<select>
					<option>Price</option>
					<option>100</option>
					<option>200</option>
				</select>
			</div>
			<div class="select-holder">
				<select>
					<option>Category</option>
					<option>Category Name</option>
					<option>Category Name</option>
				</select>
			</div>
			<div class="select-holder">
				<select>
					<option>Pattern</option>
					<option>Pattern Name</option>
					<option>Pattern Name</option>
				</select>
			</div>
			<!-- เลือกแล้ว Jump ไปที่หน้ารวม Products แล้ว Filter ตามสิ่งที่เลือกมา ตัว Option น่าจะต้องเขียนโปรแกรม -->
		</div>
        <input type="hidden" id="url_img"
               value="./images/products/product-thumbs/<?= $product_detail['p_thumb_image'] ?>">

        <!-- main slider -->
        <div class="img-product-slider">
			<ul>
		         <?php if (isset($product_collection) && !empty($product_collection)) {
			         $i=0;
		         ?>

                        <?php foreach ($product_collection as $item) { ?>

                            <li data-slide-index="<? echo $i; ?>">

                                <img src="../images/products/product-detail/<?= $item['p_id'] ?>/<?= $item['p_img'] ?>"
                                     alt="">

                            </li>


                        <?php
	                        $i++;
	                        }
	                    ?>

                    <?php } else { ?>
                        <li><img src="../images/nopic.png" alt="Product Collection Comming Soon ...>"></li>
                    <?php } ?>

		    </ul>
		    <!-- product-name -->
		    <h2 class="product-name"><?= $product_detail['p_pattern_name'] ?> <?= $product_detail['p_name'] ?></h2>
		    <!-- end product-name -->
		</div>
        <!-- end main slider -->


		<!-- thumb for mobile -->
		<div class="img-product-slider-pager mobile-thumb">
			    <ul>

			        <?php if (isset($product_collection) && !empty($product_collection)) {
				        $i=0;
			        ?>
                        <?php foreach ($product_collection as $item) { ?>
                            <li data-slide-index="<?php echo $i ; ?>">
                                <?php if(isset($item['p_img_show']) && !empty($item['p_img_show'])) {?>
                                <a href="#">
                                <img
                                    src="../images/products/product-detail/<?= $item['p_id'] ?>/collect/<?= $item['p_img_show'] ?>"
                                    alt="<?= $product_detail['p_pattern_name'] ?> <?= $product_detail['p_name'] ?>">
                                </a>
                                <?php } else{ ?>
                                    <a href="#">
                                        <img src="../images/nopic.png" alt="Product Collection Coming Soon ...>">
                                    </a>
                                <? } ?>
                            </li>

                        <?php
	                        $i++;
	                        } ?>
                    <?php } else { ?>
                        <li><img src="../images/nopic.png" alt="Product Collection Coming Soon ...>"></li>
                    <?php } ?>
			    </ul>
		    </div>
		<!-- end thumb for mobile -->

		<!--
        <article class="gallcontainer">
            <div class="carousel">

                <ul>

                    <?php if (isset($product_collection) && !empty($product_collection)) { ?>
                        <?php foreach ($product_collection as $item) { ?>

                            <li>
                                <div class="coruoselContainner">
                                <img src="../images/products/product-detail/<?= $item['p_id'] ?>/<?= $item['p_img'] ?>"
                                     alt="<?= $product_detail['p_pattern_name'] ?><p><?= $product_detail['p_name'] ?></p>">
                                </div>
                            </li>

                        <?php } ?>

                    <?php } else { ?>
                        <li><img src="../images/nopic.png" alt="Product Collection Comming Soon ...>"></li>
                    <?php } ?>

                </ul>

                <div class="controls">
                    <div class="prev"></div>
                    <div class="next"></div>
                </div>
            </div>
            <div class="thumbnails">
                <ul>
                    <?php if (isset($product_collection) && !empty($product_collection)) { ?>
                        <?php foreach ($product_collection as $item) { ?>
                            <li>
                                <?php if(isset($item['p_img_show']) && !empty($item['p_img_show'])) {?>
                                <div class="imgContainer">
                                <img
                                    src="../images/products/product-detail/<?= $item['p_id'] ?>/collect/<?= $item['p_img_show'] ?>"
                                    alt="<?= $product_detail['p_pattern_name'] ?><p><?= $product_detail['p_name'] ?></p>">
                                </div>
                                <?php } else{ ?>
                                    <div class="imgContainer">
                                        <img src="../images/nopic.png" alt="Product Collection Coming Soon ...>">
                                    </div>
                                <? } ?>
                            </li>
                        <?php } ?>
                    <?php } else { ?>
                        <li><img src="../images/nopic.png" alt="Product Collection Coming Soon ...>"></li>
                    <?php } ?>

                </ul>
            </div>
        </article>
        -->
		<!--
        <style>
            .small > p  {
                line-height: 140%;
            }
        </style>
        -->

        <article class="detailcolleft">
            <div class="motto"><?= $product_detail['p_title'] ?></div>
            <div class="head">Description</div>
            <p><?= $product_detail['p_description'] ?></p>
            <div class="head">Information</div>
            <div class="small"><?= $product_detail['p_information'] ?></div>
            <div class="head">Material and care</div>

            <p ><?= $product_detail['p_material'] ?></p>

            <?php foreach ($product_care_icon as $item) { ?>
                <img width="16" height="16" src="../images/care-icon/<?= $item['p_icon_img'] ?>"/>
            <?php } ?>


            <div class="price"><?= '$' . $product_detail['p_price'] ?></div>
            <?php if (isset($product_descrip_img) && !empty($product_descrip_img)) { ?>
                <?php foreach ($product_descrip_img as $item) { ?>
                    <img
                        src="../images/products/product-description/<?= $product_detail['p_id'] ?>/<?= $item['p_img'] ?>"
                        class="prod">
                <?php } ?>
            <?php } ?>

        </article>

        <article class="detailcolright">
	        <div class="img-product-slider-pager" id="#bx-pager">
			    <ul>

			        <?php if (isset($product_collection) && !empty($product_collection)) {
				        $i=0;
			        ?>
                        <?php foreach ($product_collection as $item) { ?>
                            <li data-slide-index="<?php echo $i ; ?>">
                                <?php if(isset($item['p_img_show']) && !empty($item['p_img_show'])) {?>
                                <a href="#">
                                <img
                                    src="../images/products/product-detail/<?= $item['p_id'] ?>/collect/<?= $item['p_img_show'] ?>"
                                    alt="<?= $product_detail['p_pattern_name'] ?> <?= $product_detail['p_name'] ?>">
                                </a>
                                <?php } else{ ?>
                                    <a href="#">
                                        <img src="../images/nopic.png" alt="Product Collection Coming Soon ...>">
                                    </a>
                                <? } ?>
                            </li>

                        <?php
	                        $i++;
	                        } ?>
                    <?php } else { ?>
                        <li><img src="../images/nopic.png" alt="Product Collection Coming Soon ...>"></li>
                    <?php } ?>
			    </ul>
		    </div>
            <div class="colorbox">
                <div class="items" style="line-height:10px;">Color :</div>
                <?php if (isset($product_link) && !empty($product_link)) { ?>
                    <?php foreach ($product_link as $link) { ?>
                        <a href="../shops/store-product-detail.php?p_id=<?= $link['p_id'] ?>"><img
                                src="../images/products/product-thumbs/<?= $link['p_thumb_image'] ?> " width="50px"
                                height="50px"></a>

                    <?php } ?>
                <?php } else {

                } ?>


            </div>
            <div class="colorbox2">
                <?php if ($user_id > 0) { ?>
                    <img src="images/btn-fav.svg" class="items" style="cursor: pointer;"
                         onclick="addFav(<?= $product_id ?>)">
                <?php } else { ?>
                	<!--
                    <a  href="../account/login.php"><img src="images/btn-fav.svg" class="items"
                                                            style="cursor: pointer;"> </a>
                    -->
                    <a class="member-btn" href="#"><img src="images/btn-fav.svg" class="items"
                                                            style="cursor: pointer;"> </a>
                <?php } ?>


                <img src="images/btn-add.svg" class="items" style="cursor: pointer;"
                     onclick="addToCart(<?= $products_data ?>)">
            </div>
            <table width="100%">
                <tr>

                    <td><a class="item" id="facebook-share" style="cursor: pointer"><img src="images/icon-fb.svg"></a>
                    </td>
                    <td><a class="item" id="twitter-share" style="cursor: pointer"><img src="images/icon-tw.svg"></a>
                    </td>
                    <td><a class="item" id="pinterest-share" style="cursor: pointer"><img src="images/icon-pi.svg"></a>
                    </td>
                </tr>
            </table>

        </article>

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
                    <a id="footer-btn" href="../misc/faq.php">PRIVACY POLICY</a>
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
<!--------------------------- ---------------------------------------->
<link href="../css/fixed.css" rel="stylesheet"/>

<script type="text/javascript" src="../js/bootstrap.js"></script>
<?php include('../login.php'); ?>
<!--------------------------- ---------------------------------------->

<link rel="stylesheet" href="../css/jquery.bxslider.css">
<script type="text/javascript" src="../js/jquery.bxslider.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var slider = $('.img-product-slider ul').bxSlider({
	            mode: 'fade', //mode: 'fade','horizontal'
	            //speed: 300,
	            auto: false,
	            infiniteLoop: true,
	            hideControlOnEnd: true,
	            useCSS: false,
	            pager:false,
	        });
		$(".img-product-slider-pager ul li a").click(function(e){
			e.preventDefault();
			$(".bx-thumb ul li a.active").removeClass("active");
			$(this).addClass("active");
			var _index = $(this).parent().attr("data-slide-index");
			console.log("_index = ", _index);
			slider.goToSlide(_index);
		})

		$(".product-name").appendTo($(".img-product-slider .bx-viewport"));
		//product-name
	})
</script>


<!--
<script src="js/jquery.light-carousel.js"></script>
<script>
    $('.gallcontainer').lightCarousel();
</script>
-->
</body>
</html>

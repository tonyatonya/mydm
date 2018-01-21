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
    <link href="css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/column.css" rel="stylesheet" type="text/css"/>
    <link href="css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="css/gen-font.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <!--<script language="javascript" type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <!--   ################ Smart  Ajax ####################-->
    <script type="text/javascript" src="shops/library/Common/appfunction.js"></script>

    <link rel="stylesheet" href="css/remodal.css">
    <link rel="stylesheet" href="css/remodal-default-theme.css">
    <!--    TOOL TIPS -->
    <link href="css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="js/tooltip.js" type="text/javascript"></script>


    <!--  Favorite -->
    <script type="text/javascript" src="addfav.js"></script>
    <!--  CART  -->
    <script type="text/javascript" src="addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="account.js"></script>
</head>
<!-- HEADER BOX -->
<?php include 'inc-header.php'; ?>
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

                                <img src="images/products/product-detail/<?= $item['p_id'] ?>/<?= $item['p_img'] ?>"
                                     alt="">

                            </li>


                        <?php
	                        $i++;
	                        }
	                    ?>

                    <?php } else { ?>
                        <li><img src="images/nopic.png" alt="Product Collection Comming Soon ...>"></li>
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
			        <?php
								if (isset($product_collection) && !empty($product_collection)) {
				        		$i=0;
										foreach ($product_collection as $item) {
														echo '<li data-slide-index="'. $i .'">'."\n";
																if(isset($item['p_img_show']) && !empty($item['p_img_show'])) {
																	echo '<a href="#">'
																				.'<img
                                    src="images/products/product-detail/'. $item['p_id'] .'/collect/'. $item['p_img_show'] .'"
                                    alt="'. $product_detail['p_pattern_name'] .' '. $product_detail['p_name'] .'">'
                                			.'</a>';
																} else{
																	echo '<a href="#">'
																			.'<img src="images/nopic.png" alt="Product Collection Coming Soon ...>">'
																			.'</a>';
																}
														echo '</li>';
										      $i++;
	                   }
								} else {
										echo '<li><img src="images/nopic.png" alt="Product Collection Coming Soon ...>"></li>';
							  } ?>
			    </ul>
		</div>


        <article class="detailcolleft">
            <div class="motto"><?= $product_detail['p_title'] ?></div>
            <div class="head">Description</div>
            <p><?= $product_detail['p_description'] ?></p>
            <div class="head">Information</div>
            <div class="small"><?= $product_detail['p_information'] ?></div>
            <div class="head">Material and care</div>

            <p ><?= $product_detail['p_material'] ?></p>

            <?php foreach ($product_care_icon as $item) { ?>
                <img width="16" height="16" src="images/care-icon/<?= $item['p_icon_img'] ?>"/>
            <?php } ?>


            <div class="price"><?= '$' . $product_detail['p_price'] ?></div>
            <?php if (isset($product_descrip_img) && !empty($product_descrip_img)) { ?>
                <?php foreach ($product_descrip_img as $item) { ?>
                    <img
                        src="images/products/product-description/<?= $product_detail['p_id'] ?>/<?= $item['p_img'] ?>"
                        class="prod">
                <?php } ?>
            <?php } ?>

        </article>

        <article class="detailcolright">
	        <div class="img-product-slider-pager" id="#bx-pager">
			    <ul>

			        <?php
								if (isset($product_collection) && !empty($product_collection)) {
				        $i=0;
									foreach ($product_collection as $item) {
                      echo '<li data-slide-index="'.  $i .'">';
											if(isset($item['p_img_show']) && !empty($item['p_img_show'])) {
													echo '<a href="#">'
															.'<img src="images/products/product-detail/'. $item['p_id'] .'/collect/'. $item['p_img_show'] .'"
                                    alt="'. $product_detail['p_pattern_name'] .' '. $product_detail['p_name'] .'">'
                              .'</a>';
											} else {
												 	echo '<a href="#">'
																		.'<img src="images/nopic.png" alt="Product Collection Coming Soon ...>">'
                                .'</a>';
                      }
											echo '</li>';
											$i++;
	                }
								} else {
                    echo '<li><img src="images/nopic.png" alt="Product Collection Coming Soon ...>"></li>';
                }
							?>
			    </ul>
		    </div>
            <div class="colorbox">
                <div class="items" style="line-height:10px;">Color :</div>
                <?php if (isset($product_link) && !empty($product_link)) { ?>
                    <?php foreach ($product_link as $link) { ?>
                        <a href="shops/store-product-detail.php?p_id=<?= $link['p_id'] ?>"><img
                                src="images/products/product-thumbs/<?= $link['p_thumb_image'] ?> " width="50px"
                                height="50px"></a>

                    <?php } ?>
                <?php } else {

                } ?>


            </div>
            <div class="colorbox2">
                <?php if ($user_id > 0) { ?>
                    <img src="images/shops/btn-fav.svg" class="items" style="cursor: pointer;"
                         onclick="addFav(<?= $product_id ?>)">
                <?php } else { ?>
                	<!--
                    <a  href="account/login.php"><img src="images/btn-fav.svg" class="items"
                                                            style="cursor: pointer;"> </a>
                    -->
                    <a class="member-btn" href="#"><img src="images/shops/btn-fav.svg" class="items"
                                                            style="cursor: pointer;"> </a>
                <?php } ?>


                <img src="images/shops/btn-add.svg" class="items" style="cursor: pointer;"
                     onclick="addToCart(<?= $products_data ?>)">
            </div>
            <table width="100%">
                <tr>

                    <td><a class="item" id="facebook-share" style="cursor: pointer"><img src="images/shops/icon-fb.svg"></a>
                    </td>
                    <td><a class="item" id="twitter-share" style="cursor: pointer"><img src="images/shops/icon-tw.svg"></a>
                    </td>
                    <td><a class="item" id="pinterest-share" style="cursor: pointer"><img src="images/shops/icon-pi.svg"></a>
                    </td>
                </tr>
            </table>

        </article>

    </div>
</section>

<?php include 'inc-footer.php'; ?>

<script type="text/javascript" src="js/main.js"></script>
<!--------------------------- ---------------------------------------->
<link href="css/fixed.css" rel="stylesheet"/>

<script type="text/javascript" src="js/bootstrap.js"></script>
<?php include('login.php'); ?>
<!--------------------------- ---------------------------------------->

<link rel="stylesheet" href="css/jquery.bxslider.css">
<script type="text/javascript" src="js/jquery.bxslider.js"></script>
<script type="text/javascript" src="js/store-product-detail.js"></script>
</body>
</html>

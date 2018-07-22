<?php
session_start();
require_once "initapp.php";

$type = "";

if($_GET){
    $type = $_GET['type'];
}



$list_page = "store-home.php";
$products_list = "";
$i = 0;

if (!$_POST) {

} else {

    if ($_POST['cmd'] == 'loadProduct') {
        $command = $_POST['cmd'];
        $category_id = $_POST['category_id'];
        $pattern_id = $_POST['pattern_id'];
//        $price = $_POST['price'];


        if (!empty($category_id)) {

            $cause .= "and pro.p_cate_id = '" . $category_id . "'";
        }
        if (!empty($pattern_id)) {

            $cause2 .= "and pro.p_pattern_id = '" . $pattern_id . "'";
        }
//        if (isset($price) && !empty($price)) {
//
//
//            $price = explode('-', $price);
//            $cause3 .= " and pro.p_price BETWEEN '" . $price[0] . "' and '" . $price[1] . "'";
//        }
        $sql = "select * from sto_products pro join sto_pattern pat on pro.p_pattern_id = pat.p_pattern_id join sto_category cate on cate.p_cate_id = pro.p_cate_id where pro.p_id <> 0 " . $cause . $cause2 . $cause3 . $cause4 ."order by pro.seq desc";

        if (!$db->execute($sql))
            throw new Exception("Operation Error");

        $products_list = "   <ul class=\"filterGrid\">";

        while ($db->read()) {
            $i += 1;

            $products_list .= "<a href=\"store-product-detail.php?p_id=" . $db->result['p_id'] . "\">";
            $products_list .= " <li class=\"price all\">";
            $products_list .= "   <img src=\"../images/products/product-thumbs/" . $db->result['p_thumb_image'] . "\">";
            $products_list .= "    <div class=\"name\">" . $db->result['p_pattern_name'] . "</div>";
            $products_list .= "     <div class=\"type\">" . $db->result['p_name'] . "</div>";
            $products_list .= "     <div class=\"no\">Item no : <span>" . $db->result['p_code'] . "</span></div>";
            $products_list .= "     <div class=\"view\">view</div>";
            $products_list .= " </li>";
            $products_list .= "</a>";

        }
        $products_list .= "</ul>";

        $data = array();

        $data['content_data'] = $products_list;

        $result['message'] = $data;


    }

    echo json_encode($result);
    exit();
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
    <link href="css/store-style.css" rel="stylesheet" type="text/css" />
    <link href="../css/header-menu.css" rel="stylesheet" type="text/css" />
    <link href="../css/general-style.css" rel="stylesheet" type="text/css" />
    <link href="../css/column.css" rel="stylesheet" type="text/css" />
    <link href="../css/grid.css" rel="stylesheet" type="text/css" />
    <link href="../css/gen-font.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link href="../css/tooltip.css" rel="stylesheet" type="text/css" />
    <script src="../js/tooltip.js" type="text/javascript"></script>

    <script  language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
    <!--   ################ Smart  Ajax ####################-->
    <script type="text/javascript" src="../shops/library/Common/appfunction.js"></script>

    <link rel="stylesheet" href="../css/remodal.css">
    <link rel="stylesheet" href="../css/remodal-default-theme.css">


    <!--  CART  -->
    <script type="text/javascript" src="../addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="../account.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var nice = $("html").niceScroll();  // The document page (body)


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


    <script type="text/javascript">


        function keepdata() {

        }


        function searchProduct(cat_id) {
            var submit = 1;
            var price = $('#price').val();
            if(cat_id != null){
                var category = cat_id;
            }else{
                var category = '';

                 category = $('#cateogory').val();
            }
                  var pattern = $('#pattern').val();


//            if(price_start > 0 && price_end <= 0 | price_end == ""){
//                alert('Please type input Price End');
//                submit = 0;
//            }
//
//            if(price_start > 0 && price_end <= 0 | price_start == ""){
//                alert('Please type input Price start');
//                submit = 0;
//            }
            if (submit == 1) {
                var ajax = new SmartAjax('POST', '<?=$list_page?>', 'category_id=' + category + '&pattern_id=' + pattern + '&price=' + price);
                ajax.requestJSON("loadProduct",
                    function (response) {
                        var msg = response.message;

                        $('#dataSpan').html(msg.content_data);
                        $('#dataSpan').trigger("create");

                    }
                );
            }

        }

        $(document).ready(function () {
            var type = $('#type').val()
            console.log(type)
            if(type){
                $('#cateogory').val(type)
                searchProduct(type);
            }else{

                 searchProduct();
            }

        });


        $(document).ready(function () {

            $('#all').click(function () {
                $('#pattern').val('');
                $('#cateogory').val('');
                $('#price').val('');
                searchProduct();
            });

            $('#pattern').change(function () {
                searchProduct();
            });

            $('#cateogory').change(function () {
                searchProduct();
            });

            /*$('#price').change(function () {
                searchProduct();
            });
*/
            $('#cat_home').click(function () {
                searchProduct(1);
            });
            $('#cat_wear').click(function () {
                searchProduct(2);
            });
            $('#cat_fab').click(function () {
                searchProduct(3);
            });
        });
    </script>

    <style>

        .filterGrid {
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
</head>
<body>


<section class="container clearfix">
    <div id="cont">
        <div class="collcolumn clearfix">
	        <!--
            <div class="allitem-nav">
                <a id="swit-btn" class="current" href="#modal" style="font-size:10px !important">VIEW ALL ITEMS</a>
            </div>
            -->
            <img src="images/head-img-coll1.jpg" alt="collection1" style="width:100%;">
            <img src="../images/cutnpaint.svg" class="cnp">
            <a href="../pdf/MYDM Catalogue.pdf" target="_blank" class="dl">download catalogue here
                > ></a>
        </div>
        <div class="collcolumn2 clearfix">
            <div class="imgcol"><img src="images/head-img-coll3.jpg" alt="collection1"></div>
            <div class="imgcol"><img src="images/head-img-coll2.jpg" alt="collection1"></div>
            <div class="imgcol"><img src="images/head-img-coll51.jpg" alt="collection1"></div>
            <div class="imgcol"><img src="images/head-img-coll4.jpg" alt="collection1"></div>
        </div>
    </div>

    <div id="content" class="grid_12" style="margin:100px 0">
        <div class="wrapper grid3">
            <article class="col">
                <a>
                    <div class="name" id="cat_home" style="cursor: pointer">HOME & LIVING</div>
                    <hr>
                    <p>Make your home happy</p>
                        </a>
            </article>

            <article class="col">
                    <a>
                    <div class="name" id="cat_wear" style="cursor: pointer">WEAR</div>
                    <hr>
                    <p>Make yourself lively</p>
                    </a>
            </article>

            <article class="col">
                <a>
                    <div class="name" id="cat_fab" style="cursor: pointer">FABRIC </div>
                    <hr>
                    <p>Be creative and inspired</p>

                </a>
            </article>

        </div>
    </div>


    <div class="centered">
        <button href="" id="all" class="button filterLink">VIEW ALL ITEMS</button>
        <select class="selectst" id="cateogory" name="cateogory">
            <option value="">Categories</option>
            <option value="1">Home & Living</option>
            <option value="2">Wear</option>
            <option value="3">Fabric</option>
        </select>
        <select class="selectst" id="pattern" name="pattern">
            <option value="">Pattern</option>
            <option value="1">Paint & Point</option>
            <option value="2">Dash & Tear</option>
            <option value="3">Brush & Brushing</option>
        </select>
    </div>
    <div id="dataSpan">
        <!-- ##################Products Item List #######################-->
        <?= $products_list ?>

    </div>

    <div style="width:100%; text-align:center; height:60px; margin:50px 0;"><img src="images/amout-order.svg" class="amout"></div>
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

    <input type="hidden" id="type" value="<?=$type ?>" >
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


<script src="js/filterGrid.js"></script>
</body>
</html>
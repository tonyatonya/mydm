<?php session_start();
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
<!--[if gt IE 8]><!-->  <!--<![endif]-->
<html lang="en-US">
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
    <link href="css/header-menu.css" rel="stylesheet" type="text/css" />
    <link href="css/general-style.css" rel="stylesheet" type="text/css" />
    <link href="css/column.css" rel="stylesheet" type="text/css" />
    <link href="css/grid.css" rel="stylesheet" type="text/css" />
    <link href="css/gen-font.css" rel="stylesheet" type="text/css" />

<!--     <script  language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>


    <link href="css/tooltip.css" rel="stylesheet" type="text/css" />
    <script src="js/tooltip.js" type="text/javascript"></script>
    <!--  CART  -->
    <script type="text/javascript" src="addcart.js"></script>
    <!--  Favorite -->
    <script type="text/javascript" src="addfav.js"></script>
    <!--  Favorite -->
    <script type="text/javascript" src="account.js"></script>

</head>
<body>
	<!-- HEADER BOX -->
	<?php include 'inc-header.php'; ?>
	<!-- HEADER BOX -->


<section class="container clearfix">
    <div id="cont3">
        <article class="member-detail">name : <?= $user['u_name'] ?></article>
        <article class="member-detail">username : <?= $user['u_login'] ?></article>
        <article class="member-detail">country : <?= $user['u_country'] ?></article>
        <hr>
        <h4>Your bought listed</h4>
        <hr>
        <div class="wrapper grid4" style="padding-bottom:30px !important;">
            <?php foreach ($myorder as $item) {
              echo '<article class="colacc">'
                  	.'<img src="images/products/product-thumbs/'. $item['p_thumb_image'] .'>" >'
                    .'<div class="name">'. $item['p_pattern_name'] .'</div>'
                    .'<div class="type">'. $item['p_name'] .'</div>'
                    .'<div class="no">Item no:<span>'. $item['p_code'] .'</span></div>'
                    .'<div class="view">view</div>'
                .'</article>';
            } ?>


        </div>
        <hr>
        <h4>Your favourite listed</h4>
        <hr>
        <div class="wrapper grid4" style="margin-top:30px">

            <?php foreach ($myfav as $item ) { ?>
            <article class="colacc">
                <img src="images/products/product-thumbs/<?= $item['p_thumb_image'] ?>" >
                <div class="name"><?=$item['p_pattern_name']?></div>
                <div class="type"><?=$item['p_name']?></div>
                <div class="no">Item no:<span><?=$item['p_code']?></span></div>
                <div class="view">view</div>
            </article>
            <?php } ?>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>


<script type="text/javascript" src="js/member-account.js"></script>
</body>
</html>

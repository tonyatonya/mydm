<?php

session_start();

require_once "initapp.php";


$blog_id = mysql_escape_string($_GET['id']);
//$sql = "select * from sto_products pro join sto_pattern pat on pro.p_pattern_id = pat.p_pattern_id join sto_category cate on cate.p_cate_id = pro.p_cate_id where p_id = '" .$_GET['id']. "' ;";
$sql = "select * from sto_blog blog where blog.blog_id = '" . $blog_id . "' and blog.blog_status != 'hide' ";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
if ($db->read()) {
    $blog_detail = $db->result;
}

$sql = "select blog_id from sto_blog where blog_id < '" . $blog_id . "' order by blog_id desc limit 1";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
if ($db->read()) {
    $older_id = $db->result['blog_id'];
}


$blog_tag = array();

$sql = "select * from sto_blog_tags where blog_id = '" . $blog_id . "' ";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
while ($db->read()) {
    $blog_tag[] = $db->result;
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href="css/blog-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/column.css" rel="stylesheet" type="text/css"/>
    <link href="css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="css/gen-font.css" rel="stylesheet" type="text/css"/>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>

    <link href="css/tooltip.css" rel="stylesheet" type="text/css"/>
</head>
<body>

	<!-- HEADER BOX -->
	<?php include 'inc-header.php'; ?>
	<!-- HEADER BOX -->

<section class="container clearfix">
    <div class="bmenucont">
        <a href="blog.php" class="blogmenu">view all</a>
        <a href="blog.php?type=inspiring design" class="blogmenu">inspiring design</a>
        <a href="blog.php?type=press" class="blogmenu">press</a>
    </div>

    <div id="cont" style="border-bottom:#000 1px solid; margin-bottom:50px;">
        <article class="detail">
            <input type="hidden" id="url_img" value="images/blog/<?= $blog_detail['blog_thumb_img'] ?>">
            <h3 id="title"><?= $blog_detail['blog_title'] ?></h3>

            <?= $blog_detail['blog_content'] ?>
    </div>
    <?php if ($older_id != NULL) { ?>
        <a href="blog-detail.php?id=<?= $older_id ?>" class="morenshare" style="text-transform:none">Older Post ></a>
    <?php } else { ?>
        <a href="" class="morenshare" style="text-transform:none" onclick="alert('This blog is oldest')">Older Post
            ></a>
    <?php } ?>
    <div class="share">
        <p>share </p>

        <a class="item" id="facebook-share" style="cursor: pointer"><img src="images/icon-fb.svg"></a>
        <a class="item" id="twitter-share" style="cursor: pointer"><img src="images/icon-tw.svg"></a>
        <a class="item" id="pinterest-share" style="cursor: pointer"><img src="images/icon-pi.svg"></a>

        </a>
    </div>
    <div class="tag">
        <p>tags </p>
        <?php foreach ($blog_tag as $row) { ?>
            <a href="blog.php?tag=<?= $row['blog_tag_name'] ?>" class="item"><?= $row['blog_tag_name'] ?> </a>
        <?php } ?>

    </div>
    </div>
</section>

<?php include 'inc-footer.php'; ?>
<script type="text/javascript" src="js/main.js"></script>
<!--------------------------- ---------------------------------------->
<link href="css/fixed.css" rel="stylesheet"/>

<script type="text/javascript" src="js/bootstrap.js"></script>
<?php include('login.php'); ?>
<!--------------------------- ---------------------------------------->
<script src="js/filterGrid.js"></script>
<script src="js/jaliswall.js"></script>
<script src="js/tooltip.js" type="text/javascript"></script>
<!--  CART  -->
<script type="text/javascript" src="addcart.js"></script>
<!--  Account -->
<script type="text/javascript" src="account.js"></script>

<script type="text/javascript" src="js/blog-detail.js"></script>

</body>
</html>

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
            $blogs_list .= "   <img src=\"blog/images/blog/" . $db->result['blog_thumb_img'] . "\"   >";
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

    <link href="css/tooltip.css" rel="stylesheet" type="text/css"/>
    <script src="js/tooltip.js" type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href="css/blog-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/header-menu.css" rel="stylesheet" type="text/css"/>
    <link href="css/general-style.css" rel="stylesheet" type="text/css"/>
    <link href="css/column.css" rel="stylesheet" type="text/css"/>
    <link href="css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="css/gen-font.css" rel="stylesheet" type="text/css"/>
    <!--   ################ Smart  Ajax ####################-->
    <script type="text/javascript" src="shops/library/Common/appfunction.js"></script>

    <link rel="stylesheet" href="css/remodal.css">
    <link rel="stylesheet" href="css/remodal-default-theme.css">
    <link rel="stylesheet" href="css/blog-index.css">

<!--     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <!--  CART  -->
    <script type="text/javascript" src="addcart.js"></script>
    <!--  Account -->
    <script type="text/javascript" src="account.js"></script>

</head>
<body>
<!-- HEADER BOX -->
<?php include 'inc-header.php'; ?>
<!-- HEADER BOX -->
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
    <div id="cont" class="wall"></div>
</section>
<?php include 'inc-footer.php'; ?>
<script type="text/javascript" src="js/main.js"></script>
<!--------------------------- ---------------------------------------->
<link href="css/fixed.css" rel="stylesheet"/>

<script type="text/javascript" src="js/bootstrap.js"></script>
<?php include('login.php'); ?>
<!--------------------------- ---------------------------------------->



<script src="js/jaliswall.js"></script>
<script>
    //$('.wall').jaliswall({item: '.wall-item'});
</script>


<script type="text/javascript" src="js/blog-index.js"></script>
</body>
</html>

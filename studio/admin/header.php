<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="en-US"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>MYDM</title>   

<meta name="description" content="Insert Your Site Description" /> 

<meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">
<meta name="HandheldFriendly" content="true"/>
<meta name="MobileOptimized" content="320"/>

<!--CSS -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/responsivemobilemenu-op.css" type="text/css"/>
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/files/css3-mediaqueries.js"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link rel="stylesheet" href="css/sass-compiled.css" />


<link rel="stylesheet" type="text/css" href="css/slick.css"/>
<link rel="stylesheet" type="text/css" href="css/totop-style.css" media="screen"/>
<link href="css/css-work.css" rel="stylesheet" type="text/css">
<link href="css/otherpages-style.css" rel="stylesheet" type="text/css" />
<link href="css/grid.css" rel="stylesheet" type="text/css" />
<link href="css/gen-font.css" rel="stylesheet" type="text/css" />
<link href="css/aboutus-column.css" rel="stylesheet" type="text/css" />

<script src="js/modernizr.js" type="text/javascript"></script>

<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript" src="library/Common/appfunction.js"></script>
<script>
	var form_name;
	function startUpload(name){
		if($('#buttonSave').length >0){
			$('#buttonSave').attr("disabled", "disabled");
			$('#buttonSave').val("WAIT");
		}
		if(document.forms[form_name].elements[name+"_image"] === undefined){
			document.getElementById(name+"_image").src = "images/loading.gif";
		}else{
			document.forms[form_name].elements[name+"_image"].src = "images/loading2.gif";
		}		 
		 document.forms[form_name].elements['upload_filename_field'].value = name;
		 document.forms[form_name].elements['upload_target_path'].value = "images/tmp/";
		 document.forms[form_name].submit();
		 return true;
	}

	function stopUpload(html){
		var name = document.forms[form_name].elements['upload_filename_field'].value;
		var result = html.split(String.fromCharCode(31));
		var src_image = "images/nopic.png";
		if(result[0] == "true"){
			var filename = result[1].split(".");
			document.forms[form_name].elements[name].value = filename[0];
			document.forms[form_name].elements[name+"_ext"].value  = filename[1];
			if(filename[1] == "jpg" || filename[1] == "png")
				src_image = document.forms[form_name].elements['upload_target_path'].value+result[1];
			else if(filename[1] == "mp4" || filename[1] == "avi") 
			    src_image = "images/video.jpg";
			else
			    src_image = "images/attachment.png";
			if(document.forms[form_name].elements[name+"_image"] === undefined){
				document.getElementById(name+"_image").src = src_image;
				document.getElementById(name+"_image").style.display = "";
			}else{
				document.forms[form_name].elements[name+"_image"].src = src_image;
				document.forms[form_name].elements[name+"_image"].style.display = "";
			}
		}else{
			document.forms[form_name].elements[name].value = "";
			document.forms[form_name].elements[name+"_file"].value = "";
			document.forms[form_name].elements[name+"_image"].style.display="none";
			alert(result[1]);
		}
		if($('#buttonSave').length >0){
			$('#buttonSave').removeAttr("disabled");
			$('#buttonSave').val("SAVE");
		}
	}
</script>
</head>


<body>

<div id="intro">
<nav class="mainmenu right">
	 <div class ="container clearfix">
     <div id="content" class="grid_12">
    	<div class="logo"></div>
			<ul style='<?=($user->checkUser() != 'admin' ? "display:none;" : "")?>'>
        			<li><a href="works.php" >WORKS</a></li>
					<li><a href="shop_collections.php">SHOP COLLECTIONS</a></li>
					<li><a href="shops.php">SHOPS</a></li>
					<li><a href='logout.php'>LOGOUT</a></li>
			</ul>
      </div>
      </div>
</nav>
<section id="scontainer">
<div id="pageheadercont">
    	<div class ="container clearfix">
    		<div id="content" class="grid_12">
				<br/>
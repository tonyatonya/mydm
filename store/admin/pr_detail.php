<?php 
	session_start();
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	require_once "initapp.php";

	$list_page = "pr.php";
	$detail_page = "pr_detail.php";
		
	if(!$_POST){
		if($user->checkUser() != "admin"){
			header("Location: login.php");
		}	
		$mode = $_GET['mode'];
		$id = $_GET['id'];
	}else{
		
		try
		{
			
			if($user->checkUser() != "admin"){
				throw new Exception("Session Expired. Please login again !!!");
			}
			
			$result = array();
			if($_POST["cmd"] == "loadData"){

				if($_POST['id'] == ""){
					throw new Exception("Id not found");
				}

				$sql = "select * from d_pr where id = '".$_POST['id']."'";
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				if($db->read()){
					$data = $db->result;
					$data['doc_date2'] = DateTimeObj::DatetoDisplay($db->result['doc_date']); 
				}
				
				$result['message'] = $data;
			}else if($_POST["cmd"] == "saveData"){
				
				if($_POST['doc_date'] == ""){
					throw new Exception("Please specify date");
				}
				
				if($_POST['mode'] == "add"){
					$sql = "insert into d_pr (title_TH,title_EN,title_JP,detail_TH,detail_EN,detail_JP,thumb_image,photo_image,doc_date)
						values (
							'".escape_text($_POST['title_TH'])."',
							'".escape_text($_POST['title_EN'])."',
							'".escape_text($_POST['title_JP'])."',
							'".escape_text(utf8_urldecode($_POST['detail_TH']))."',
							'".escape_text(utf8_urldecode($_POST['detail_EN']))."',
							'".escape_text(utf8_urldecode($_POST['detail_JP']))."',
							'',
							'',
							'".DateTimeObj::DatetoDatabase($_POST['doc_date'])."'
						)";
					if(!$db->executeNonquery($sql))
						throw new Exception("Operation Error");
						
					$sql="select max(id) as id from d_pr where doc_date = '".DateTimeObj::DatetoDatabase($_POST['doc_date'])."' ";
					if(!$db->execute($sql))
						throw new Exception("Operation Error");
					if(!$db->read())
						throw new Exception("Operation Error");
					$id = $db->result['id'];
					
					$photostamp = "_".time();
					if($_POST[thumb_photo] != ""){
						if(!Image::moveFile($_POST[thumb_photo],$id.$photostamp, $_POST[thumb_photo_ext], "images/tmp/", "../../images/about/pr/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_pr set 
									thumb_image = '../../images/about/pr/".$id.$photostamp.".".$_POST[thumb_photo_ext]."'
								where id = '".$id."' ";
						if(!$db->executeNonQuery($sql))
							throw new Exception("Operation Error");
					}
					if($_POST[main_photo] != ""){
						if(!Image::moveFile($_POST[main_photo],$id.$photostamp, $_POST[main_photo_ext], "images/tmp/", "../../images/about/pr/large-pic/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_pr set 
									photo_image = '../../images/about/pr/large-pic/".$id.$photostamp.".".$_POST[main_photo_ext]."'
								where id = '".$id."' ";
						if(!$db->executeNonQuery($sql))
							throw new Exception("Operation Error");
					}
				}else{
					if($_POST['id'] == ""){
						throw new Exception("Id not found");
					}

					$sql = "update d_pr set 
								title_TH = '".escape_text($_POST['title_TH'])."',
								title_EN = '".escape_text($_POST['title_EN'])."',
								title_JP = '".escape_text($_POST['title_JP'])."',
								detail_TH = '".escape_text(utf8_urldecode($_POST['detail_TH']))."',
								detail_EN = '".escape_text(utf8_urldecode($_POST['detail_EN']))."',
								detail_JP = '".escape_text(utf8_urldecode($_POST['detail_JP']))."',
								doc_date = '".DateTimeObj::DatetoDatabase($_POST['doc_date'])."' 
							where id='".$_POST['id']."' ";
					if(!$db->executeNonquery($sql))
						throw new Exception("Operation Error");
					
					$id = $_POST['id'];
					$photostamp = "_".time();
					if($_POST[thumb_photo] != ""){
						if(!Image::moveFile($_POST[thumb_photo],$id.$photostamp, $_POST[thumb_photo_ext], "images/tmp/", "../../images/about/pr/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_pr set 
									thumb_image = '../../images/about/pr/".$id.$photostamp.".".$_POST[thumb_photo_ext]."'
								where id = '".$id."' ";
						if(!$db->executeNonQuery($sql))
							throw new Exception("Operation Error");
					}
					if($_POST[main_photo] != ""){
						if(!Image::moveFile($_POST[main_photo],$id.$photostamp, $_POST[main_photo_ext], "images/tmp/", "../../images/about/pr/large-pic/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_pr set 
									photo_image = '../../images/about/pr/large-pic/".$id.$photostamp.".".$_POST[main_photo_ext]."'
								where id = '".$id."' ";
						if(!$db->executeNonQuery($sql))
							throw new Exception("Operation Error");
					}
				}
			}else{
				throw new Exception("No operations");
			}

			$result['msgStatus'] = "ok";
			print json_encode($result);
			
		}catch(Exception $ex){
			$result = array();
			$result['msgStatus'] = "error";
			$result['message'] = $ex->getMessage();
			print json_encode($result);
		}

		exit();
	}
	
	function utf8_urldecode($str) {
		$str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
		return html_entity_decode($str,null,'UTF-8');
	}
	
	function escape_text($str) {
		$result = str_replace("\'","#NL#",$str);
		$result = str_replace("'","#NL#",$result);
		$result = str_replace("#NL#","''",$result);
		return $result;
	}

?>

<?php include "header.php" ?>
<script src="library/ckeditor/ckeditor.js"></script>
<script src="library/ckeditor/adapters/jquery.js"></script>
<style>
.rightcont{
	/*background:#F2F7F7;*/
	font-weight:bold;
	font-family:Tahoma, Geneva, sans-serif;
	color:#333;
	font-size:13px;	
}
.rightcont p{
    font-weight:bold;
	font-family:Tahoma, Geneva, sans-serif;
	color:#333;
	font-size:13px;	 
}
.rightcont .formbox{
	margin-top:20px;
	height:380px;
	width:93%;
	padding:20px;
}
.rightcont .formbox .head{
	height:40px;
	width:98%;
	line-height:40px;
	color:#fff;
	font-size:18px;
	padding-left:15px;
	font-family: 'franklin_gothic_bookregular', sans-serif;
	margin-bottom:20px;
}
.rightcont .formbox span{
	font-weight:bold;
	font-family:Tahoma, Geneva, sans-serif;
	color:#333;
	font-size:13px;	
}
.rightcont .formbox .fs1{
	width:270px;
	float:left;
	margin-top:8px;
}
.rightcont .formbox .fs2{
	width:650px;
	float:left;
	margin-top:8px;
}
.rightcont .formbox .fs1 p{
	font-weight:bold;
	font-family:Tahoma, Geneva, sans-serif;
	color:#333;
	font-size:13px;
	width:100%;
	padding-bottom:0 !important;	
}
.rightcont .formbox .fs2 p{
	font-weight:bold;
	font-family:Tahoma, Geneva, sans-serif;
	color:#333;
	font-size:13px;
	width:100%;
	padding-bottom:0 !important;	
}
#buttonSave{
	padding:5px;
	text-align:center;
	text-decoration:none;
	margin-top:30px;
	margin-left:0px;
	float:left;
	width:60px;
	line-height:24px;
	height:30px;
	background:#333;
	display:block;
	color:#fff;
	font-weight:bold;
	font-family: 'franklin_gothic_bookregular' , sans-serif;
	border:none;
	cursor:pointer;
}
#buttonSave:hover{
	background:#cc0000;
	color:#000;	
}
</style>
<script language="JavaScript">
	form_name = "info_form";
	function loadData(id){
		
		var ajax = new SmartAjax('POST','<?=$detail_page?>','id='+id+'&lang='+lang);
		ajax.requestJSON("loadData",
			function(response){ 

				var status = response.msgStatus;
				var msg = response.message;

				if(status == "ok") {
					$('#title_TH').val(msg.title_TH);
					$('#title_EN').val(msg.title_EN);
					$('#title_JP').val(msg.title_JP);
					$('#detail_TH').val(msg.detail_TH);
					$('#detail_EN').val(msg.detail_EN);
					$('#detail_JP').val(msg.detail_JP);
					$('#doc_date').val(msg.doc_date2);
					if(msg.thumb_image == ""){
						$("#thumb_photo_image").attr("src","images/nopic.png");
					}else{
						$("#thumb_photo_image").attr("src",msg.thumb_image);
					}
					if(msg.photo_image == ""){
						$("#main_photo_image").attr("src","images/nopic.png");
					}else{
						$("#main_photo_image").attr("src",msg.photo_image);
					}
				}else {
					alert(msg);
				}
				setTextWithLang(lang);
			}
		);
	}
	
	function saveData(){
		$('#detail_TH').html(encodeURI($('#detail_TH').val()));
		$('#detail_EN').html(encodeURI($('#detail_EN').val()));
		$('#detail_JP').html(encodeURI($('#detail_JP').val()));
		var ajax = new SmartAjax('POSTFORM','<?=$detail_page?>',"info_form");
		ajax.requestJSON("saveData",
			function(response){ 
				var status = response.msgStatus;
				var msg = response.message;
				if(status == "ok") {
					alert("Save successful");
					window.location = "<?=$list_page?>";
				}else {
					alert(msg);
				}
			}
		);
	}
	
	$(document).ready(function(){
		$( "#doc_date" ).datepicker({
			showAnim:"drop"
		});
		$( '#detail_TH' ).ckeditor();
		$( '#detail_EN' ).ckeditor();
		$( '#detail_JP' ).ckeditor();
		if($('#mode').val() != "add"){
			loadData($('#id').val());
		}else{
			setTextWithLang(lang);
			$("#thumb_photo_image").attr("src","images/nopic.png");
			$("#main_photo_image").attr("src","images/nopic.png");
		}
	});
</script>
<div id="about-cont" >
        
	<div class="leftcont"><img src="../../images/about/get-to-know-head.png">
		<div class="menu">
			<ul>
				<li><a href="index.php" class="current">PR</a></li>
			</ul>
		</div>	
	</div>
	<div class="rightcont" style="height:100% !important; margin-bottom:50px; padding-left:20px !important;">
		<h1>PR Content</h1>
		<div class="formbox">
			<div style=" width:98% float:left; clear:both;">
				<form id='info_form' name='info_form' method="post" enctype="multipart/form-data" target="upload_file_target" action="upload_picture.php">
					<input id='id' name="id" type="hidden" value='<?=$id?>'>
					<input id='mode' name="mode" type="hidden" value='<?=$mode?>'>
					<input type='hidden' id='upload_filename_field'  name='upload_filename_field' value='' />
					<input type='hidden' id='upload_target_path'  name='upload_target_path' value='' />
					<p style="font-weight:bold;"><span style="color:red;">*</span>Require field</p>
					<div class="fs2"><p><span style="color:red;">*</span>Title <span style="font-style:italic; font-weight:normal;">(Thai)</span></p>
						<input id='title_TH' name="title_TH" type="text" style='width:90%;'>
					</div>
					<div class="fs2"><p><span style="color:red;">*</span>Title <span style="font-style:italic; font-weight:normal;">(English)</span></p>
						<input id='title_EN' name="title_EN" type="text" style='width:90%;'>
					</div>
					<div class="fs2"><p><span style="color:red;">*</span>Title <span style="font-style:italic; font-weight:normal;">(Japan)</span></p>
						<input id='title_JP' name="title_JP" type="text" style='width:90%;'>
					</div>
					<div class="fs2">
					  <p><span style="color:red;">*</span>Detail <span style="font-style:italic; font-weight:normal;">(Thai)</span></p>
					   <textarea id="detail_TH" name="detail_TH" style='width:90%;' rows="10"></textarea>
					 </div>
					 <div class="fs2">
					  <p><span style="color:red;">*</span>Detail <span style="font-style:italic; font-weight:normal;">(English)</span></p>
					   <textarea id="detail_EN" name="detail_EN" style='width:90%;' rows="10"></textarea>
					 </div>
					 <div class="fs2">
					  <p><span style="color:red;">*</span>Detail <span style="font-style:italic; font-weight:normal;">(Japan)</span></p>
					   <textarea id="detail_JP" name="detail_JP" style='width:90%;' rows="10"></textarea>
					 </div>
					<div class="fs2">
						<br/>
					   <div id='thumbPhotos' style='height:245px;'>
							<div class='divTopicHead'>Thumbnail Image</div><br/>
							<div  class='photo_block' >
								<a href="<?=$obj->data[thumb_photo]?>" target='_blank' >
									<img id="thumb_photo_image" name='thumb_photo_image'  src="images/loading2.gif"  style='height:150px;width:auto;'  />
								</a>
							</div>
							<input type='hidden' name='thumb_photo' value='' />
							<input type='hidden' name='thumb_photo_ext' value='' />
							<div  style='margin-left:10px;'>
								<input type="file" name="thumb_photo_file" name="thumb_photo_file" onChange="startUpload('thumb_photo');" <?=$mode_edit_display?> /><br/>
								<span class='comment' <?=$mode_edit_display?>  >Supported formats: Jpg, Png only, Size: Max 1 MB</span>
							</div>
						</div>
					</div>
					<div class="fs2">
						<br/>
					   <div id='mainPhotos' style='height:395px;'>
							<div class='divTopicHead'>Large Image</div><br/>
							<div  class='photo_block' >
								<a href="<?=$obj->data[main_photo]?>" target='_blank' >
									<img id="main_photo_image" name='main_photo_image'  src="images/loading2.gif" style='height:300px;width:auto;'  />
								</a>
							</div>
							<input type='hidden' name='main_photo' value='' />
							<input type='hidden' name='main_photo_ext' value='' />
							<div  style='margin-left:10px;'>
								<input type="file" name="main_photo_file" name="main_photo_file" onChange="startUpload('main_photo');" <?=$mode_edit_display?> /><br/>
								<span class='comment' <?=$mode_edit_display?>  >Supported formats: Jpg, Png only, Size: Max 1 MB</span>
							</div>
						</div>
					</div>
					<div class="fs1"><p><span style="color:red;">*</span>Date <span style="font-style:italic; font-weight:normal;"></span></p>
						<input id='doc_date' name="doc_date" type="text" style='width:90px;'>
					</div>
					<div  style="float:left; margin-left:2px;margin-top:10px;margin-bottom:10px; width:100%;">
						<input type="button" name="buttonSave" id="buttonSave" value="SAVE" onclick="saveData();">
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>
<iframe id="upload_file_target" name="upload_file_target" src="#" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
<?php include "footer.php" ?>


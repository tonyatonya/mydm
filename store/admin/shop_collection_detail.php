<?php 
	session_start();
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	require_once "initapp.php";

	$list_page = "shop_collections.php";
	$detail_page = "shop_collection_detail.php";
	
	$timestamp = time();
	
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

				$sql = "select * from d_product_categories where id = '".$_POST['id']."'";
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				if($db->read()){
					$data = $db->result;
					$data['thumb_image'] = "../images/shop/". $db->result['thumb_image'];
				}
				
				$result['message'] = $data;
			}else if($_POST["cmd"] == "saveData"){
				
				if($_POST['mode'] == "add"){
					$sql = "insert into d_product_categories (name,description)
						values (
							'".escape_text($_POST['name'])."',
							'".escape_text(utf8_urldecode($_POST['description']))."'
						)";
					if(!$db->executeNonquery($sql))
						throw new Exception("Operation Error");
						
					$sql="select max(id) as id from d_product_categories ";
					if(!$db->execute($sql))
						throw new Exception("Operation Error");
					if(!$db->read())
						throw new Exception("Operation Error");
					$id = $db->result['id'];
					
					$photostamp = "_".time();
					if($_POST[thumb_image] != ""){
						if(!Image::moveFile($_POST[thumb_image],$id.$photostamp, $_POST[thumb_image_ext], "images/tmp/", "../images/shop/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_product_categories set 
									thumb_image = '".$id.$photostamp.".".$_POST[thumb_image_ext]."'
								where id = '".$id."' ";
						if(!$db->executeNonQuery($sql))
							throw new Exception("Operation Error");
					}
					
					$data['save_id'] = $id; 
					$result['message'] = $data;
				}else{
				
					if($_POST['id'] == ""){
						throw new Exception("Id not found");
					}

					$sql = "update d_product_categories set 
								name = '".escape_text($_POST['name'])."',
								description = '".escape_text(utf8_urldecode($_POST['description']))."'
							where id='".$_POST['id']."' ";
					if(!$db->executeNonquery($sql))
						throw new Exception("Operation Error");
					
					$id = $_POST['id'];
					$photostamp = "_".time();
					if($_POST[thumb_image] != ""){
						if(!Image::moveFile($_POST[thumb_image],$id.$photostamp, $_POST[thumb_image_ext], "images/tmp/", "../images/shop/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_product_categories set 
									thumb_image = '".$id.$photostamp.".".$_POST[thumb_image_ext]."'
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
<script src="library/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="library/uploadify/uploadify.css">
<script src="library/ckeditor/ckeditor.js"></script>
<script src="library/ckeditor/adapters/jquery.js"></script>
<style>

</style>
<script language="JavaScript">
	form_name = "info_form";

	function loadData(id){
		
		var ajax = new SmartAjax('POST','<?=$detail_page?>','id='+id);
		ajax.requestJSON("loadData",
			function(response){ 

				var status = response.msgStatus;
				var msg = response.message;

				if(status == "ok") {
					$('#name').val(msg.name);
					$('#description').val(msg.description);
					if(msg.thumb_image == ""){
						$("#thumb_image_image").attr("src","images/nopic.png");
					}else{
						$("#thumb_image_image").attr("src", msg.thumb_image);
					}
				}else {
					alert(msg);
				}
			}
		);
	}
	
	function saveData(){
		$('#description').html(encodeURI($('#description').val()));
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
		$( '#description' ).ckeditor();
		if($('#mode').val() != "add"){
			loadData($('#id').val());
		}else{
			$("#thumb_image_image").attr("src","images/nopic.png");
		}
	});
</script>

<div style="height:100% !important; margin-bottom:50px; padding-left:20px !important;">
	<style>
		.caption{
			font-weight:bold;
			vertical-align:top;
			padding-top:5px;
		}
		.formtable td{
			text-align:left;
		}
	</style>
	<h1>Shop Collection Detail</h1>
	<div style=" width:98% float:left; clear:both;">
		<form id='info_form' name='info_form' method="post" enctype="multipart/form-data" target="upload_file_target" action="upload_picture.php">
			<input id='id' name="id" type="hidden" value='<?=$id?>'>
			<input id='mode' name="mode" type="hidden" value='<?=$mode?>'>
			<input type='hidden' id='upload_filename_field'  name='upload_filename_field' value='' />
			<input type='hidden' id='upload_target_path'  name='upload_target_path' value='' /><br/>
			<p style="font-weight:bold;float:right;"><a href='<?=$list_page?>'><< Back</a></p><br/>
			<div style='clear:both;'></div>
			<table class='formtable'>
				<tr>
					<td class='caption'><p><span style="color:red;">*</span>Name</p></td>
					<td><input id='name' name="name" type="text" style='width:90%;'></td>
				</tr>
				<tr>
					<td class='caption'><p>Description</p></td>
					<td> <textarea id="description" name="description" style='width:90%;' rows="10"></textarea></td>
				</tr>
				<tr>
					<td class='caption'><p>Thumbnail Image</p></td>
					<td> 
						<div id='thumbPhotos' >
							<div  class='photo_block' >
								<a href="<?=$data['thumb_image']?>" target='_blank' >
									<img id="thumb_image_image" name='thumb_image_image'  src="images/loading2.gif"  style='height:150px;width:auto;'  />
								</a>
							</div>
							<input type='hidden' name='thumb_image' value='' />
							<input type='hidden' name='thumb_image_ext' value='' />
							<div  style='margin-left:10px;'>
								<input type="file" name="thumb_image_file" name="thumb_image_file" onChange="startUpload('thumb_image');" <?=$mode_edit_display?> /><br/>
								<span class='comment' <?=$mode_edit_display?>  >Supported formats: Jpg, Png only, Size: Max 6 MB,Width : 470px - Height : 330px</span>
							</div><br/>
						</div>
					</td>
				</tr>
				<tr>
					<td class='caption'></td>
					<td> <input type="button" name="buttonSave" id="buttonSave" value="SAVE" onclick="saveData();"></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<iframe id="upload_file_target" name="upload_file_target" src="#" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
<?php include "footer.php" ?>


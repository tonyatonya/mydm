<?php 
	session_start();
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	require_once "initapp.php";

	$list_page = "works.php";
	$detail_page = "work_detail.php";
	
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

				$sql = "select * from d_works where id = '".$_POST['id']."'";
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				if($db->read()){
					$data = $db->result;
					$data['thumb_image'] = "../images/work/work-thumbs/". $db->result['thumb_image'];
				}
				
				$result['message'] = $data;
			}else if($_POST["cmd"] == "loadItem"){

				$content_data = "<thead><tr>
						<td style='width:5%;'>Order</td>
						<td style='width:10%;'>Type</td>
						<td style='width:80%;'>File</td>
						<td style='width:5%;'></td>
					</tr></thead><tbody>";
				
				$page = 1;
				
				$i = 0;
				$sql = "select * from d_work_items where work_id = '".$_POST['id']."' order by order_num ";
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				while($db->read()){
					$i += 1;
					if($db->result['type'] == "picture"){
						$file = "<a target='_blank' href='../images/work/work-detail/".$db->result['work_id']."/".$db->result['path']."'>
											<img src='../images/work/work-detail/".$db->result['work_id']."/".$db->result['path']."' style='width:50px;height:35px;' />
										</a>";
					}else{
						$file = $db->result['path'];
					}
					$content_data .= "<tr id='item_".$i."'>
								<td style='text-align:center;'>".$db->result['order_num']."</td>
								<td  style='text-align:center;'>".$db->result['type']."</td>
								<td style='padding:5px;'>".$file."</td>
								<td style='text-align:center;'>
									<img id='deleteItem".$db->result[id]."' src='images/delete.gif' style='width:16px;height:16px;cursor:pointer;' onclick='deleteItem(\"".$db->result[id]."\")' title='ลบ' />
								</td>
							</tr>";
				}
				
				if($i == 0){
					$content_data .= "<tr><td colspan=5 style='text-align:center;'>No Data</td></tr>";
				}
				
				$content_data .= "<tr>
						<td style='text-align:center;'><input id='order_num' name='order_num' type='text' style='width:80%;' placeholder='Order' ></td>
						<td style='text-align:center;'>
								<select id='add_type' name='add_type' style='padding:1px;' 
											onchange=\"if(this.value == 'picture'){ $('#add_image_pane').show(); $('#add_video_pane').hide(); } else { $('#add_image_pane').hide(); $('#add_video_pane').show();  }\">
									<option value='picture' selected>Picture</option>
									<option value='video'>Video</option>
								</select>
						</td>
						<td>
								<div id='add_image_pane'>
									<form name='manage_form' id='manage_form' method='POST' >
										<div id='fileUploadDiv'>
											<input id='Filedata' name='Filedata' type='file' class='fileUpload' size='30' multiple>
											<input type='hidden' id='work_id' name='work_id' value='' />
											<input type='hidden' id='order_num2' name='order_num' value='' />
											<input type='hidden' id='add_type' name='add_type' value='' />
											<input type='hidden' id='timestamp' name='timestamp' value='' />
											<input type='hidden' id='token' name='token' value='' />
										</div>
										<input type='hidden' id='fileUploaded' name='fileUploaded' />
										<div class='upload_progress'>
											<div class='upload_bar'></div>
											<div class='upload_percent'>0%</div>
										</div>
									</form>
								</div>
								<div id='add_video_pane' style='display:none;'>
									<input id='add_video' name='add_video' type='text' style='width:80%;float:left;' placeholder='Please input vimeo link' >
									<input type='button' name='buttonAddItem' id='buttonAddItem' value='Add' onclick='addItem();'  style='float:left'>
								</div>
						</td>
						<td style='text-align:center;'>
								
						</td>
				</tr>";

				$content_data .= "</tbody>";
				
				$data = array();
				$data['data_count'] = $data_count;
				$data['content_data'] = $content_data;

				$result['message'] = $data;
			}else if($_POST["cmd"] == "saveData"){
				
				//if($_POST['doc_date'] == ""){
				//	throw new Exception("Please specify date");
				//}
				
				if($_POST['mode'] == "add"){
					$sql = "insert into d_works (name,description,website)
						values (
							'".escape_text($_POST['name'])."',
							'".escape_text(utf8_urldecode($_POST['description']))."',
							'".escape_text($_POST['website'])."'
						)";
					if(!$db->executeNonquery($sql))
						throw new Exception("Operation Error");
						
					$sql="select max(id) as id from d_works ";
					if(!$db->execute($sql))
						throw new Exception("Operation Error");
					if(!$db->read())
						throw new Exception("Operation Error");
					$id = $db->result['id'];
					
					$photostamp = "_".time();
					if($_POST[thumb_image] != ""){
						if(!Image::moveFile($_POST[thumb_image],$id.$photostamp, $_POST[thumb_image_ext], "images/tmp/", "../images/work/work-thumbs/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_works set 
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

					$sql = "update d_works set 
								name = '".escape_text($_POST['name'])."',
								website = '".escape_text($_POST['website'])."',
								description = '".escape_text(utf8_urldecode($_POST['description']))."'
							where id='".$_POST['id']."' ";
					if(!$db->executeNonquery($sql))
						throw new Exception("Operation Error");
					
					$id = $_POST['id'];
					$photostamp = "_".time();
					if($_POST[thumb_image] != ""){
						if(!Image::moveFile($_POST[thumb_image],$id.$photostamp, $_POST[thumb_image_ext], "images/tmp/", "../images/work/work-thumbs/")){
							throw new Exception("Unable to save picture");
						}
						$sql="update d_works set 
									thumb_image = '".$id.$photostamp.".".$_POST[thumb_image_ext]."'
								where id = '".$id."' ";
						if(!$db->executeNonQuery($sql))
							throw new Exception("Operation Error");
					}

				}
				
			}else if($_POST["cmd"] == "addItem"){
				
				if($_POST['order_num'] == ""){
					throw new Exception('Please specify order number');
				}
				
				$sql="insert into d_work_items (work_id, type,path, order_num) 
							values ('".$_POST['work_id']."','video','".$_POST['path']."', '".$_POST['order_num']."'); ";
				if(!$db->executeNonQuery($sql)){
					throw new Exception("Operation Error");
				}
				
			}else if($_POST["cmd"] == "deleteItem"){
				
				$sql = "select * from d_work_items where work_id  = '".$_POST['work_id']."' and id = '".$_POST['id']."' ";
				if(!$db->execute($sql)){
					throw new Exception("Operation Error");
				}
				
				if($db->read()){
					$targetFile = "../images/work/work-detail/".$_POST['work_id']."/".$db->result['path']; 
					$sql="delete from d_work_items where work_id  = '".$_POST['work_id']."' and id = '".$_POST['id']."' "; 
					if(!$db->executeNonQuery($sql)){
						throw new Exception("Operation Error");
					}
					if (file_exists($targetFile)) {
						unlink($targetFile);
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
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<script src="library/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="library/uploadify/uploadify.css">
<script src="library/ckeditor/ckeditor.js"></script>
<script src="library/ckeditor/adapters/jquery.js"></script>
<script src='js/jquery.form.js'></script>
<style>
/*       Upload Bar    */
.upload_progress {
    position: relative;
    width: 400px;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 3px;
    display: none;
}

.upload_bar {
    background-color: #B4F5B4;
    width: 0%;
    height: 20px;
    border-radius: 3px;
}

.upload_percent {
    position: absolute;
    display: inline-block;
    top: 3px;
    left: 8%;
}
</style>
<script language="JavaScript">
	form_name = "info_form";
	
	function loadItem(){
		var ajax = new SmartAjax('POST','<?=$detail_page?>',"id=<?=$id?>");
		ajax.requestJSON("loadItem",
			function(response){ 
				var status = response.msgStatus;
				var msg = response.message;
				if(status == "ok") {
					$('#dataSpan').html(msg.content_data);
					$('#dataSpan').trigger("create");
					//################################################## FOR UPLOAD
					var fileuploadReset = $("#fileUploadDiv").html();
					$('#manage_form').ajaxForm({
						beforeSend: function () {
							$('#Filedata').attr("disabled", "disabled");
							$('#manage_form .upload_progress').show();
							$('#manage_form .upload_bar').width('0%');
							$('#manage_form .upload_percent').html('0%');
						},
						uploadProgress: function (event, position, total, percentComplete) {
							$('#manage_form .upload_bar').width(percentComplete + "%");
							$('#manage_form .upload_percent').html("กำลังอัพโหลดไฟล์ ความคืบหน้า " + percentComplete + "%");
						},
						success: function () {
							$('#manage_form .upload_bar').width('100%');
							$('#manage_form .upload_percent').html('100%');
						},
						complete: function (xhr) {
							$('#manage_form .upload_progress').hide();
							$('#Filedata').removeAttr("disabled");

							if (xhr.status == 200) {
								var result = JSON.parse(xhr.responseText);
								if (result.what == "ok") {
									loadItem();
								} else {
									alert(result.result_text);
									loadItem();
								}
							} else {
								alert("ไม่สามารถอัพโหลดไฟล์นี้ได้");
							}
							//$('#fileUploadDiv').empty().html(fileuploadReset).trigger("create");
							//$("#fileUploadDiv .fileUpload").on("change", function () {
							 //   startUpload();
							//});
						}
					});
					$("#fileUploadDiv .fileUpload").on("change", function () {
						startUpload();
					});
				}else {
					$('#dataSpan').html(msg);
				}
			}
		);
	}
	
	function addItem(){
		if($('#buttonAddItem').length >0){
			$('#buttonAddItem').attr("disabled", "disabled");
			$('#buttonAddItem').val("Adding...");
		}
		var ajax = new SmartAjax('POST','<?=$detail_page?>',"work_id=<?=$id?>&order_num="+ $("#order_num").val()+"&path="+$("#add_video").val());
		ajax.requestJSON("addItem",
			function(response){ 
				if($('#buttonAddItem').length >0){
					$('#buttonAddItem').removeAttr("disabled");
					$('#buttonAddItem').val("Add");
				}
				var status = response.msgStatus;
				var msg = response.message;
				if(status == "ok") {
					loadItem();
				}else {
					alert(msg);
				}
			}
		);
	}
	
	function deleteItem(id){
		$("#deleteItem"+id).attr('src',"images/loading1.gif");
		var ajax = new SmartAjax('POST','<?=$detail_page?>',"work_id=<?=$id?>&id="+ id);
		ajax.requestJSON("deleteItem",
			function(response){ 
				$("#deleteItem"+id).attr('src',"images/delete.gif");
				var status = response.msgStatus;
				var msg = response.message;
				if(status == "ok") {
					loadItem();
				}else {
					alert(msg);
				}
			}
		);
	}
	
	function loadData(id){
		
		var ajax = new SmartAjax('POST','<?=$detail_page?>','id='+id);
		ajax.requestJSON("loadData",
			function(response){ 

				var status = response.msgStatus;
				var msg = response.message;

				if(status == "ok") {
					$('#name').val(msg.name);
					$('#website').val(msg.website);
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
					if($("#mode").val() == "add"){
						window.location = "<?=$detail_page."?mode=edit&id="?>"+ msg.save_id;
					}else{
						window.location = "<?=$list_page?>";
					}
				}else {
					alert(msg);
				}
			}
		);
	}
	
	function startUpload() {
		if($("#order_num").val() == ""){
			alert("Please specify order number");
			loadItem();
			return;
		}
		$("#manage_form input[name=work_id]").val('<?=$id?>');
		$("#manage_form input[name=order_num]").val($("#order_num").val());
		$("#manage_form input[name=add_type]").val('picture');
		$("#manage_form input[name=timestamp]").val('<?=$timestamp?>');
		$("#manage_form input[name=token]").val('<?=md5('unique_salt' . $timestamp)?>');
        $("#manage_form").attr('action', 'uploadify.php');
        $("#manage_form").submit();
    }
		
	$(document).ready(function(){
//		$( '#description' ).ckeditor();
//		CKEDITOR.replace( 'description' );

		if($('#mode').val() != "add"){
			loadData($('#id').val());
			loadItem();
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
	<h1>Work Detail</h1>
	<div style=" width:98% float:left; clear:both;">
		<form id='info_form' name='info_form' method="post" enctype="multipart/form-data"  action="upload_data.php">
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
					<td class='caption'><p>Website</p></td>
					<td> <input id='website' name="website" type="text" style='width:90%;'></td>
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
								<input type="file" name="thumb_image_file"   <?=$mode_edit_display?> /><br/>
								<span class='comment' <?=$mode_edit_display?>  >Supported formats: Jpg, Png only, Size: Max 6 MB, Width : 250px - Height : 200px</span>
							</div><br/>
						</div>
					</td>
				</tr>
				<tr>
					<td class='caption'></td>
					<td> <input type="submit" name="buttonSave" id="buttonSave" value="SAVE" ></td>
				</tr>
			</table>
		</form>
	</div>

	<br/><br/><br/>
	<div style=" width:98% float:left; clear:both;<?=($mode == "add" ? "display:none;" : "")?>">
		<h1>Work Gallery</h1>
		<style>
			.datatable{
				border-collapse:collapse;
			}
			.datatable thead tr{
				background-color:#F7F8E0;
			}
			.datatable thead td{
				font-weight:bold;
				text-align:center;
			}
			.datatable td{
				text-align:left;
				border:1px solid #E6E6E6;
				padding:2px;
			}
		</style>
		<table id='dataSpan' class='datatable' width="100%" border="0" cellspacing="1" cellpadding="0" style="margin-top:5px;">

		</table>
	</div>
</div>

<iframe id="upload_file_target" name="upload_file_target" src="#" style="width:0;height:0;border:0px solid #fff;display:none;"></iframe>
<?php include "footer.php" ?>


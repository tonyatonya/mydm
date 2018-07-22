<?php 

	session_start();
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	require_once "initapp.php";

	$list_page = "works.php";
	$detail_page = "work_detail.php";
		
	if(!$_POST){
		if($user->checkUser() != "admin"){
			header("Location: login.php");
		}
	}else{
	
		try{
			if($user->checkUser() != "admin"){
				throw new Exception("Session Expired. Please login again !!!");
			}
			
			$result = array();
			if($_POST["cmd"] == "loadData"){

				$content_data = "<thead><tr>
						<td style='width:5%;'>#</td>
						<td  style='width:85%;'>Name</td>
						<td style='width:5%;'></td>
						<td style='width:5%;'></td>
					</tr></thead><tbody>";
				
				$page = 1;
				
				$cause = "";
				if(isset($_POST[search_text])){
					$search_text = $_POST[search_text];
					$cause .= "and  (
										name LIKE '%".$search_text."%' 
										)";
				}
				
				$sql = "select count(id) as data_count from d_works where id <> 0 ".$cause;
				
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				if(!$db->read())
					throw new Exception("Operation Error");
				$data_count = $db->result['data_count'];
				$page_size = 2000;
				$num_page = ceil($data_count/$page_size);
				$start_limit = ($page-1)*$page_size;
				$i = $start_limit;
				$sql = "select * from d_works where id <> 0 ".$cause." order by id desc LIMIT ".$start_limit.",".$page_size;
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				while($db->read()){
					$i += 1;
					$content_data .= "<tr  cellpadding='2'>
								<td style='text-align:center;'>".$i."</td>
								<td >".$db->result['name']."</td>
								<td style='text-align:center;'>
									<a href='".$detail_page."?mode=edit&id=".$db->result[id]."' title='แก้ไข' ><img src='images/edit.png' style='width:16px;height:16px;'  /></a>
								</td>
								<td style='text-align:center;'>
									<a href='#' onclick='processDelete(\"".$db->result[id]."\")' title='ลบ'><img src='images/delete.gif' style='width:16px;height:16px;' /></a>
								</td>
							</tr>";
				}
				
				if($data_count == 0){
					$content_data .= "<tr><td colspan=4 style='text-align:center;'>No Data</td></tr>";
				}

				$content_data .= "</tbody>";
				
				$data = array();
				$data['data_count'] = $data_count;
				$data['content_data'] = $content_data;

				$result['message'] = $data;
			}else if($_POST["cmd"] == "deleteData"){
				if($_POST['id'] == ""){
					throw new Exception("Id not found");
				}
				
				$sql = "delete from d_works where id='".$_POST['id']."' ";
				if(!$db->executeNonquery($sql))
					throw new Exception("Operation Error");
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

?>
<?php include "header.php"; ?>
<script language="JavaScript">
	function search(page){
		var ajax = new SmartAjax('POST','<?=$list_page?>',"search_text="+$('#search_text').val());
		ajax.requestJSON("loadData",
			function(response){ 
				var status = response.msgStatus;
				var msg = response.message;
				if(status == "ok") {
					$('#countPane').html(msg.data_count);
					$('#dataSpan').html(msg.content_data);
					$('#dataSpan').trigger("create");
				}else {
					$('#dataSpan').html(msg);
				}
			}
		);
	}
	
	function processDelete(id){
		if(confirm("Are you confirm to delete ?")){
			var ajax = new SmartAjax('POST','<?=$list_page?>','id='+id);
			ajax.requestJSON("deleteData",
				function(response){ 
					var status = response.msgStatus;
					var msg = response.message;
					if(status == "ok") {
						alert("Delete successful");
						search(1);
					}else {
						alert(msg);
					}
				}
			);
		}
	}
	
	$(document).ready(function(){
		search(1);
	});
</script>
<h1>Works</h1>
<div style='clear:both;'></div><br/>
<div id='search_pane' >
	<table   class='form-search' >
		<tr>
			<td class='form-caption'>
				<span class="text_label">คำค้น :</span>
			</td>
			<td colspan=3>
				 <input id='search_text' name='search_text' type='text' value='' style='width:400px;' onkeypress="if (event.keyCode == 13) {search(1); return false;}  " /> 
			</td>
			<td>
				<input type='button' value='ค้นหา' onclick="search(1);" />
			</td>
		</tr>
	</table>
</div>
<div style="margin-top:15px;float:left;">
	จำนวน <span id='countPane' style='color:red;'> 0 </span> รายการ &nbsp;|&nbsp; <a href="<?=$detail_page?>?mode=add">Add New</a>
</div>
<div style='clear:both;'></div>
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
		padding:5px;
	}
</style>
<table id='dataSpan' class='datatable' width="100%" border="0" cellspacing="1" cellpadding="0" style="margin-top:5px;">
	
</table>
<?php include "footer.php"; ?>


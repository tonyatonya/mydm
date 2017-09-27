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
	}else{
		
		try
		{
			if($user->checkUser() != "admin"){
				throw new Exception("Session Expired. Please login again !!!");
			}
			
			$result = array();
			if($_POST["cmd"] == "loadData"){

				$content_data = "<tr>
						<td class='tr-headdate' style='width:5%;'>#</td>
						<td class='tr-headtopic' style='width:70%;'>Title</td>
						<td class='tr-headtopic' style='width:15%;'>Date</td>
						<td class='tr-headtopic' style='width:5%;'></td>
						<td class='tr-headtopic' style='width:5%;'></td>
					</tr>";
					
				if(isset($_POST["page"]) and $_POST["page"] > 0){
					$page = $_POST["page"];
				}else
					$page = 1;

				if(isset($_POST["lang"]) and $_POST["lang"] != ""){
					$lang = $_POST["lang"];
				}else
					$lang = "EN";
					
				$cause = "";
				if(isset($_POST[search_text])){
					$search_text = $_POST[search_text];
					$cause .= "and  (
										title_TH LIKE '%".$search_text."%' or   
										title_EN LIKE '%".$search_text."%' or   
										title_JP LIKE '%".$search_text."%' or  
										title2_TH LIKE '%".$search_text."%' or  
										title2_EN LIKE '%".$search_text."%' or  
										title2_JP LIKE '%".$search_text."%' 
										)";
				}
				
				$sql = "select count(id) as data_count from d_pr where id <> 0 ".$cause;
				
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				if(!$db->read())
					throw new Exception("Operation Error");
				$data_count = $db->result['data_count'];
				$page_size = 10;
				$num_page = ceil($data_count/$page_size);
				$start_limit = ($page-1)*$page_size;
				$i = $start_limit;
				$sql = "select * from d_pr where id <> 0 ".$cause." order by doc_date desc, id desc LIMIT ".$start_limit.",".$page_size;
				if(!$db->execute($sql))
					throw new Exception("Operation Error");
				while($db->read()){
					$i += 1;
					$content_data .= "<tr  cellpadding='2'>
								<td ".($i % 2 == 0 ? "class='td-dtdate2'" : "class='td-dtdate'" )." >".$i."</td>
								<td ".($i % 2 == 0 ? "class='td-dt2'" : "class='td-dt'" )." >
									<span class='langTextEN' style='".($lang == "EN" ? "" : "display:none;" )."' >".$db->result['title_EN']."</span>
									<span class='langTextTH' style='".($lang == "TH" ? "" : "display:none;" )."' >".$db->result['title_TH']."</span>
									<span class='langTextJP' style='".($lang == "JP" ? "" : "display:none;" )."' >".$db->result['title_JP']."</span>
								</td>
								<td ".($i % 2 == 0 ? "class='td-dt2'" : "class='td-dt'" )." >
									<span class='langTextEN' style='".($lang == "EN" ? "" : "display:none;" )."' >".DateTimeObj::DatetoDisplay($db->result['doc_date'],"ShortEngDate2")."</span>
									<span class='langTextTH' style='".($lang == "TH" ? "" : "display:none;" )."' >".DateTimeObj::DatetoDisplay($db->result['doc_date'],"ShortThaiDate2")."</span>
									<span class='langTextJP' style='".($lang == "JP" ? "" : "display:none;" )."' >".DateTimeObj::DatetoDisplay($db->result['doc_date'],"ShortEngDate2")."</span>
								</td>
								<td ".($i % 2 == 0 ? "class='td-dt2'" : "class='td-dt'" ).">
									<a href='".$detail_page."?mode=edit&id=".$db->result[id]."' title='แก้ไข' ><img src='images/edit.png' style='width:16px;height:16px;'  /></a>
								</td>
								<td ".($i % 2 == 0 ? "class='td-dt2'" : "class='td-dt'" ).">
									<a href='#' onclick='processDelete(\"".$db->result[id]."\")' title='ลบ'><img src='images/delete.gif' style='width:16px;height:16px;' /></a>
								</td>
							</tr>";
				}
				
				if($data_count == 0){
					$content_data .= "<tr><td class='td-dt' colspan=5 style='text-align:center;'>No Data</td></tr>";
				}else{
					$pagenation = "
							<div class='pageof'>PAGE ".$page." OF ".$num_page."
							</div>
							<div class='pagenum'>
								<ul>";
					for($i=1;$i<=$num_page;$i++){
						$pagenation .= "<li><span onclick='search(".$i.");' ".($i == $page ? "class='current'" : "").">".$i."</span></li>";
					}
					$pagenation .=
									"</ul>
								</div>
								<div class='pagenav'>
								  <div class='prev' style='".($page < $num_page ? "" : "display:none;")."' onclick='search(".($page + 1).");' >NEXT</div> 
								  <div class='next' style='".($page > 1 ? "" : "display:none;")."' onclick='search(".($page - 1).");' >PREV</div>
								</div>
							";
				}

				$data = array();
				$data['data_count'] = $data_count;
				$data['content_data'] = $content_data;
				$data['pagenation'] = $pagenation;

				$result['message'] = $data;
			}else if($_POST["cmd"] == "deleteData"){
				if($_POST['id'] == ""){
					throw new Exception("Id not found");
				}
				
				$sql = "delete from d_pr where id='".$_POST['id']."' ";
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

<?php include "header.php" ?>
<script language="JavaScript">
	function search(page){
		var ajax = new SmartAjax('POST','<?=$list_page?>','page='+page+'&lang='+lang+"&search_text="+$('#search_text').val());
		ajax.requestJSON("loadData",
			function(response){ 
				var status = response.msgStatus;
				var msg = response.message;
				if(status == "ok") {
					$('#countPane').html(msg.data_count);
					$('#dataSpan').html(msg.content_data);
					$('.pagenationbox').html(msg.pagenation);
					$('#dataSpan').trigger("create");
					$('.pagenationbox').trigger("create");
				}else {
					$('.pagenationbox').html(msg);
				}
				setTextWithLang(lang);
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
<div id="about-cont" >
        
	<div class="leftcont"><img src="../../images/about/get-to-know-head.png">
		<div class="menu">
			<ul>
				<li><a href="index.php" class="current">PR</a></li>
			</ul>
		</div>	
	</div>
	<div class="rightcont" style="height:100% !important; margin-bottom:50px; padding-left:20px !important;">
		<h1>PR</h1>

		<div style='clear:both;'></div>
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
		<div class="text_label" style="margin-top:15px;">
			จำนวน <span id='countPane' style='color:red;'> 0 </span> รายการ &nbsp;|&nbsp; <a href="<?=$detail_page?>?mode=add">Add New</a>
		</div>
		<div style='clear:both;'></div>
		<table id='dataSpan' width="100%" border="0" cellspacing="1" cellpadding="0" style="margin-top:5px;">
			
		</table>
		<div class="pagenationbox">
			
		</div>
	</div>
</div>

<?php include "footer.php" ?>
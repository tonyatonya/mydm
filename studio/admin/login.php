<?php
	session_start();
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	require_once "initapp.php";

	$user_type = $user->checkUser();
	if($user_type == "admin")
		header("Location: index.php");
		
?>
<?php include "header.php"; ?>
<script language="JavaScript">
	function processLogin(){
		ajax = new SmartAjax('POSTFORM','operations.php','main_form');
		ajax.executeAjax("loginUser",
			function(result){ 
				if(result[0] == "true"){
					window.location = "index.php";
				}else
					alert(result[1]);
			}
		);
	}
	function requestPass(){
		document.getElementById('imgAjaxLogin').style.display = "none";
		document.getElementById('imgSubmit_Pass').style.display = "none";
	}
</script>
	
<div style="width:550px;margin:auto;">
	<h1>Admin Panel Login</h1>
	<form id="main_form" name="main_form" method="post" class="form-table" onsubmit="processLogin(); return false;" >
		<table>
			<tr>
				<td class="form-caption" >Username : </td>
				<td><input name="username" type="text"  class='input_large' value=""  />
				<td></td>
			</tr>
			<tr id='imgSubmit_Pass'>
				<td class="form-caption">Password : </td>
				<td>
					<input name="password" type="password" 	class='input_large' value=""   />
				</td>
			</tr>
			<tr>
				<td class="form-caption"></td>
				<td>
					<span id="imgAjaxLogin"><input type="submit" name="btnSubmit"  alt="Submit" value="Login" /></span>
				</td>
			</tr>
			<tr>
				<td class='form-caption'></td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</form>
</div>   
<?php include "footer.php"; ?>

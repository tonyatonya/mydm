<?php

	error_reporting(E_ERROR);
	ini_set("display_errors", 1);
	
	session_start();
	require_once "initapp.php";
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = "../images/work/work-detail/".$_POST['work_id']."/"; 

if (!is_dir($targetFolder)) {
	if(!mkdir($targetFolder,0777, true)){
		$data["what"] = "error";
		$data["result_text"] = 'Permission denied';
		echo json_encode($data);
		exit();
	}	
}	

if ($_POST['order_num'] == "") {
	$data["what"] = "error";
	$data["result_text"] = 'Please specify order number';
	echo json_encode($data);
	exit();
}	

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

try{
	if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
		$tempFile = $_FILES['Filedata']['tmp_name'];
		$targetPath = $targetFolder;
		$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
		
		// Validate the file type
		$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
		$fileParts = pathinfo($_FILES['Filedata']['name']);
		
		if($_FILES['Filedata']["size"] > 6 * 1048576 ){	//1048576B = 1MB
			$data["what"] = "error";
			$data["result_text"] = "File size exceed 6 MB";
		}else if (!in_array($fileParts['extension'],$fileTypes)) {
			$data["what"] = "error";
			$data["result_text"] = "Invalid file type.";
		} else {
			if(!move_uploaded_file($tempFile,$targetFile)){
				$data["what"] = "error";
				$data["result_text"] = 'Permission denied';
			}else{
				$sql="insert into d_work_items (work_id, type,path, order_num) 
							values ('".$_POST['work_id']."','picture','".$_FILES['Filedata']['name']."', '".$_POST['order_num']."'); ";
				if(!$db->executeNonQuery($sql)){
					$data["what"] = "error";
					$data["result_text"] = "Cannot insert data";
				}else{
					$data["what"] = "ok";
					$data["saved_path"] = $targetFile;
				}
			}
		}
	}else{
		$data["what"] = "error";
		$data["result_text"] = "Invalid token";
	}
}catch(Exception $ex){
	$data["what"] = "error";
	$data["result_text"] = "Unknown error";
}
echo json_encode($data);
?>
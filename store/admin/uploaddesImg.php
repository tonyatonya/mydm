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
$targetFolder = "../images/products/product-description/".$_POST['p_id']."/";

if (!is_dir($targetFolder)) {
    if(!mkdir($targetFolder,0777, true)){
        $data["what"] = "error";
        $data["result_text"] = 'Permission denied';
        echo json_encode($data);
        exit();
    }
}

//if ($_POST['order_num'] == "") {
//	$data["what"] = "error";
//	$data["result_text"] = 'Please specify order number';
//	echo json_encode($data);
//	exit();
//}

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

try{
    if (!empty($_FILES)) {
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
                $i= 1;

                $sql="select * from sto_product_descrip_img where p_id = '".$_POST['p_id']. "' order by seq desc";
                if(!$db->execute($sql))
                    throw new Exception("Operation Error");
                if ($db->read()) {
                    if(!empty($db->result['seq'])){
                        $i = $db->result['seq'];
                        $i++;
                    }

                }
                $sql="insert into sto_product_descrip_img (p_id, type,p_img, seq)
							values ('".$_POST['p_id']."','picture','".$_FILES['Filedata']['name']."', '".$i."'); ";
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
        $data["result_text"] = "Invalid token ja";
    }
}catch(Exception $ex){
    $data["what"] = "error";
    $data["result_text"] = "Unknown error";
}
echo json_encode($data);
?>
<?php


require_once "initapp.php";
$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);

/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

// Define a destination
$targetFolder = "../images/products/product-detail/".$_POST['p_id']."/collect/";

if (!is_dir($targetFolder)) {
    if(!mkdir($targetFolder,0777, true)){
        $data["what"] = "error";
        $data["result_text"] = 'Permission denied';
        echo json_encode($data);
        exit();
    }
}

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

try{
        $collect_id ="";
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
                $count_img=1;
                $sql="select * from sto_product_collection where p_id = '".$_POST['p_id']. "' and p_img_show = NULL order by seq asc";
                if(!$db->execute($sql))
                    throw new Exception("Operation Error");
                if ($db->read()) {
                    if(!empty($db->result['seq'])){
                        $i = $db->result['seq'];

                        $i++;
                    }
                    $collect_id = $db->result['collect_id'];
                    while($db->read()){
                        $count_img++;

                    }

                    $row = count($db->result);

                }


                    $query = "update sto_product_collection set p_img_show='" . $_FILES['Filedata']['name'] . "' where seq='" . $_POST['collect'] . "' ";
                    $exec = mysql_db_query($DB_NAME, $query);


                    if (!$exec) {
                        $data["what"] = "error";
                        $data["result_text"] = "Cannot insert data";
                    } else {
                        $data["what"] = "ok";
                        $data["saved_path"] = $targetFile ;
                    }
                }

        }

}catch(Exception $ex){
    $data["what"] = "error";
    $data["result_text"] = "Unknown error";
}
echo json_encode($data);
?>
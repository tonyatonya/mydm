<?php
	header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	require_once "initapp.php";
	
	$result = "";
	
	$file = $_FILES[$_POST["upload_filename_field"]."_file"];
	$target_path = $_POST["upload_target_path"];
	
	if($file["type"] != "image/pjpeg" and $file["type"] != "image/jpeg" and $file["type"] != "image/x-png" and $file["type"] != "image/png")
		$result = "false".chr(31)."Invalid file type, support only jpeg and png file format";
	else if(($file["size"]/1024) > 6144)
		$result = "false".chr(31)."File size is more than 3 MB !!!";
	else{
		$db->execute("select UNIX_TIMESTAMP( NOW( ) ) as timestamp ");
		$db->read();
		$filename = $db->result[timestamp].Encryption::random_gen(5);
		
		if($file["type"] == "image/x-png" or $file["type"] == "image/png")
			$filetype = ".png";
		else if ($file["type"] == "image/pjpeg" or $file["type"] == "image/jpeg")
			$filetype = ".jpg";
			
		if(@move_uploaded_file($file['tmp_name'], $target_path.$filename.$filetype)) {
			$result = "true".chr(31).$filename.$filetype;
		}else
			$result = "true".chr(31)."Unable to upload file, please try again";
	}
	sleep(1);
?>
<script language="javascript" type="text/javascript">
	//window.top.frames[0].stopUpload('<?=$result?>');
	window.top.window.stopUpload('<?=$result?>');
</script>   

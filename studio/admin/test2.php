<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?
//echo"$_FILES["filUpload"]["name"]";
if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"images/".$_FILES["filUpload"]["name"]))
{
	echo " Copy/Upload Complete";
}

?>
</body>
</html>
<?php 

 require_once "initapp.php";
 $conn=mysql_connect( "localhost","$DB_USERNAME","$DB_PASSWORD");
 mysql_select_db($DB_NAME);
          if($_POST['mode'] == "add"){ // check mode = add
			 $tmp_name = $_FILES["thumb_image_file"]["tmp_name"];
             if($tmp_name!=""){ // check attached file
			 $stampdate=date(YmdHis);
			 $img = $stampdate.$_FILES["thumb_image_file"]["name"];
			 move_uploaded_file($tmp_name, "../images/work/work-thumbs/$img");
			 }			
			
			 $query = "insert into d_works (name,description,website,thumb_image)
					   values('$_POST[name]', '$_POST[description]' ,'$_POST[website]','$img')"; 
			 $exec=mysql_db_query($DB_NAME,$query);
			 $id=mysql_insert_id();
		   }elseif($_POST['mode'] == "edit"){ // check mode = edit
		    $id=$_POST[id]; 
			$tmp_name = $_FILES["thumb_image_file"]["tmp_name"];
			if($tmp_name!=""){ // check attached file
			$stampdate=date(YmdHis);
			$img = $stampdate.$_FILES["thumb_image_file"]["name"];
			move_uploaded_file($tmp_name, "../images/work/work-thumbs/$img");
			$query = "update d_works set thumb_image='$img' where id='$id' ";
			$exec=mysql_db_query($DB_NAME,$query);
			}	
			$query = "update d_works set name='$_POST[name]',description='$_POST[description]',website='$_POST[website]' where id='$id' ";
			$exec=mysql_db_query($DB_NAME,$query);		
		   } 
	        // check execute error	
			if ($exec)
			{
			echo"<script> alert ('Save Successful') </script>";
			echo"<META HTTP-EQUIV=\"REFRESH\"CONTENT=\"1;URL=work_detail.php?mode=edit&id=$id\">";
			}
			else
			{
			echo"Error Can not insert to DB";
			}

?> 

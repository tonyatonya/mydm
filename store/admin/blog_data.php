<?php

require_once "initapp.php";
$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);
if ($_POST['mode'] == "add") { // check mode = add
    $tmp_name = $_FILES["thumb_image_file"]["tmp_name"];
    if ($tmp_name != "") { // check attached file
        $stampdate = date(YmdHis);
        $img = $stampdate . $_FILES["thumb_image_file"]["name"];
        move_uploaded_file($tmp_name, "../blog/images/blog/$img");
    }
    // insert Blog Data
    $query = "insert into sto_blog (blog_id,blog_title,blog_content,blog_thumb_img,blog_information,blog_status,blog_type)
	values('$_POST[blog_id]', '$_POST[blog_title]' ,'$_POST[blog_content]','$img','$_POST[blog_information]','$_POST[blog_status]', '$_POST[blog_type]'  )";

    mysql_query('set names utf8');

    $exec = mysql_query($query) or die(mysql_error());

    $id = mysql_insert_id();

    // insert Blog Tag
    $post_tag = mysql_real_escape_string($_POST['blog_tag']);
    $blog_tag =  explode(",",$post_tag);

    foreach ($blog_tag as $row)
    {
        $sql = "insert into sto_blog_tags (blog_id , blog_tag_name) values ('$id','$row')";
        mysql_query('set names utf8');
        mysql_query($sql) or die(mysql_error());
    }

    
} else if ($_POST['mode'] == "edit") { // check mode = edit
    $id = $_POST[id];
    $tmp_name = $_FILES["thumb_image_file"]["tmp_name"];
    if ($tmp_name != "") { // check attached file
        $stampdate = date(YmdHis);
        $img = $stampdate . $_FILES["thumb_image_file"]["name"];
        move_uploaded_file($tmp_name, "../blog/images/blog/$img");
        $query = "update sto_blog set blog_thumb_img='$img' where blog_id='$id' ";
        $exec = mysql_db_query($DB_NAME, $query);
    }
    
    $query = "update sto_blog set blog_title='$_POST[blog_title]',blog_content='$_POST[blog_content]',blog_status='$_POST[blog_status]',blog_information='$_POST[blog_information]' ,blog_type='$_POST[blog_type]' where blog_id ='$id' ";
    mysql_query('set names utf8');

    $exec = mysql_db_query($DB_NAME, $query);
    
    
    $del_sql = "DELETE FROM sto_blog_tags WHERE blog_id ='". $id ."'" ;
    mysql_query($del_sql) or die(mysql_error());
    // insert Blog Tag
    $post_tag = mysql_real_escape_string($_POST['blog_tag']);
    $blog_tag =  explode(",",$post_tag);

    foreach ($blog_tag as $row)
    {
        $sql = "insert into sto_blog_tags (blog_id , blog_tag_name) values ('$id','$row')";
        mysql_query('set names utf8');
        mysql_query($sql) or die(mysql_error());
    }



}
// check execute error
if ($exec) {
    echo "<script> alert('Save Successful') </script>";
    echo "<META HTTP-EQUIV=\"REFRESH\"CONTENT=\"1;URL=blog_list.php\">";

} else {
    echo "Error Can not insert to DB";
}

?>


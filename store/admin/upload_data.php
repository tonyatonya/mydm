<?php

require_once "initapp.php";
$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);
if ($_POST['mode'] == "add") { // check mode = add
    $tmp_name = $_FILES["thumb_image_file"]["tmp_name"];
    if ($tmp_name != "") { // check attached file
        $stampdate = date(YmdHis);
        $img = $stampdate . $_FILES["thumb_image_file"]["name"];
        move_uploaded_file($tmp_name, "../images/products/product-thumbs/$img");
    }
    $proc_link1 = 'NULL';
    $proc_link2 = 'NULL';
    if (isset($_POST['proc_link1']) && !empty($_POST['proc_link1']) && $_POST['proc_link1'] != "") {
        $sql = "select * from sto_products where p_code = '" . $_POST['proc_link1'] . "'";
        if (!$db->execute($sql))
            throw new Exception("Operation Error");
        if ($db->read()) {
            $proc_link1 = $db->result['p_id'];
        }
    }


    if (isset($_POST['proc_link2']) && !empty($_POST['proc_link2'])) {
        $sql = "select * from sto_products where p_code = '" . $_POST['proc_link2'] . "'";
        if (!$db->execute($sql))
            throw new Exception("Operation Error");
        if ($db->read()) {
            $proc_link2 = $db->result['p_id'];
        }
    }


    $sql = "SELECT * FROM  `sto_products` WHERE seq = ( SELECT MAX( seq ) FROM sto_products ) ;";
    if (!$db->execute($sql))
        throw new Exception("Operation Error");
    if ($db->read()) {
        $seq = $db->result['seq'];

        $seq++;
    }
    $query = "insert into sto_products (p_name,seq,p_title,p_code,p_description,p_information,p_material,p_cate_id,p_pattern_id,p_price,p_quantity,p_thumb_image ,p_ref1_id , p_ref2_id)
	values('$_POST[p_name]','$seq','$_POST[p_title]' ,'$_POST[p_code]' ,'$_POST[p_description]', '$_POST[p_information]', '$_POST[p_material]', '$_POST[p_cate_id]', '$_POST[p_pattern_id]', '$_POST[p_price]', '$_POST[p_quantity]','$img',$proc_link1 ,$proc_link2  )";
    
    mysql_query('set names utf8');

    $exec = mysql_query($query) or die(mysql_error());

    $id = mysql_insert_id();

    if (isset($_POST['care_icon'])) {
        $care_icon = $_POST['care_icon'];
        if (sizeof($care_icon) > 0) {
            foreach ($care_icon as $icon_id) {
                $query = "insert into sto_care_icon (p_id,p_icon_id) values('$id','$icon_id')";

            }
        }
    }


} elseif ($_POST['mode'] == "edit") { // check mode = edit
    $id = $_POST[id];
    $tmp_name = $_FILES["thumb_image_file"]["tmp_name"];
    if ($tmp_name != "") { // check attached file
        $stampdate = date(YmdHis);
        $img = $stampdate . $_FILES["thumb_image_file"]["name"];
        move_uploaded_file($tmp_name, "../images/products/product-thumbs/$img");
        $query = "update sto_products set p_thumb_image='$img' where p_id='$id' ";
        $exec = mysql_db_query($DB_NAME, $query);
    }

    $proc_link1 = 'NULL';
    $proc_link2 = 'NULL';
    if (isset($_POST['proc_link1']) && !empty($_POST['proc_link1']) && $_POST['proc_link1'] != "") {
        $sql = "select * from sto_products where p_code = '" . $_POST['proc_link1'] . "'";
        if (!$db->execute($sql))
            throw new Exception("Operation Error");
        if ($db->read()) {
            $proc_link1 = $db->result['p_id'];
        }
    }


    if (isset($_POST['proc_link2']) && !empty($_POST['proc_link2'])) {
        $sql = "select * from sto_products where p_code = '" . $_POST['proc_link2'] . "'";
        if (!$db->execute($sql))
            throw new Exception("Operation Error");
        if ($db->read()) {
            $proc_link2 = $db->result['p_id'];
        }
    }
    $query = "update sto_products set p_name='$_POST[p_name]' ,p_title='$_POST[p_title]',p_code='$_POST[p_code]',p_description='$_POST[p_description]' ,p_information='$_POST[p_information]' ,p_material='$_POST[p_material]',p_cate_id='$_POST[p_cate_id]',p_pattern_id='$_POST[p_pattern_id]',p_price='$_POST[p_price]',p_quantity='$_POST[p_quantity]',p_ref1_id=$proc_link1 ,p_ref2_id=$proc_link2 where p_id='$id' ";
    mysql_query('set names utf8');

    $exec = mysql_db_query($DB_NAME, $query);

    if (isset($_POST['care_icon'])) {

        $sql = "delete from sto_care_icon where p_id  = '$id '";
        $exec = mysql_query($sql);

        $care_icon = $_POST['care_icon'];
        if (sizeof($care_icon) > 0) {
            foreach ($care_icon as $icon_id) {
                $query = "insert into sto_care_icon (p_id,p_icon_id) values('$id','$icon_id')";
                $exec = mysql_query($query) or die(mysql_error());
            }
        }

    }
}
// check execute error
if ($exec) {
    echo "<script> alert('Save Successful') </script>";
    echo "<META HTTP-EQUIV=\"REFRESH\"CONTENT=\"1;URL=product_detail.php?mode=edit&id=$id\">";
//    echo "<META HTTP-EQUIV=\"REFRESH\"CONTENT=\"1;URL=products_list.php\">";
} else {
    echo "Error Can not insert to DB";
}

?>


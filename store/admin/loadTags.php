<?php
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
require_once "initapp.php";
$timestamp = time();

if (!$_POST) {
    if ($user->checkUser() != "admin") {
        header("Location: login.php");
    }

} else {

    if ($_POST["cmd"] == "loadData") {
        $tag_name = "";
        $sql = "SELECT  DISTINCT(blog_tag_name) FROM `sto_blog_tags` where blog_id > 0";

        if (!$db->execute($sql))
            throw new Exception("Operation Error");

        while ($db->read()) {
            $tag_name[] = $db->result['blog_tag_name'];
        }

        $data['tag_name'] = $tag_name;
        echo json_encode($data);
    }
}

?>
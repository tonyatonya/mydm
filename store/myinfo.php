<?php

session_start();
require_once "initapp.php";

$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);

$post = mysql_real_escape_string($_POST['p_id']);
$p_id = $post['p_id'];
if (isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])) {

    $user_id = $_SESSION['u_id'];

    $sql = "select count(*) as count from sto_fav_list where u_id = '" . $user_id . "' ";
    if (!$db->execute($sql))
        throw new Exception("Operation Error");
    if ($db->read()) {
        $myfav = $db->result['count'];
    }

    $sql = "select count(*) as count from sto_purchased where u_id = '" . $user_id . "' group by p_id";
    if (!$db->execute($sql))
        throw new Exception("Operation Error");
    if ($db->read()) {
        $myorder = $db->result['count'];
    }



    $user = $_SESSION;
    $data = array(
        'user' => $user,
        'order' => $myorder,
        'fav' => $myfav

    );

    echo json_encode($data);

} else {
    $data['msg'] = 'กรุณาล็อคอินก่อน';
    echo json_encode($data);
}


?>
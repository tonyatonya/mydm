<?php

session_start();
require_once "initapp.php";

$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);

$post = mysql_real_escape_string($_POST['p_id']);
$p_id = $post['p_id'];
if(isset($_SESSION['u_id']) && !empty($_SESSION['u_id'])) {
    $user_id = $_SESSION['u_id'];
}else{
      $data['msg'] = 'กรุณาล็อคอินก่อน' ;
      echo json_encode($data);
}

$sql = "select count(*) as count from sto_fav_list where u_id = '" . $user_id . "' and p_id = '".$p_id. "'";
if (!$db->execute($sql))
    throw new Exception("Operation Error");
if ($db->read()) {
    $exist = $db->result['count'];
}

if($exist == 0) {


    $query = "insert into sto_fav_list (fav_id , u_id, p_id) values (NULL , '$user_id' ,'$p_id' )";

//    mysql_query('set names utf8');

    $exec = mysql_query($query);

    $id = mysql_insert_id();

    $sql = "select count(*) as count from sto_fav_list where u_id = '" . $user_id . "'";

    if (!$db->execute($sql))
        throw new Exception("Operation Error");
    if ($db->read()) {
        $count = $db->result['count'];
    }

    if ($exec) {
        $data = array(
            'msg' => "Add Favarite Successful",
            'count' => $count
        );

        echo json_encode($data);
//    echo "<META HTTP-EQUIV=\"REFRESH\"CONTENT=\"1;URL=login.php\">";
    } else {
        $data = array(
            'msg' => "Cannot Add Favarite",
//            'msg' => $query,

        );

        echo json_encode($data);
    }

}else {
    $data = array(
        'msg' => "This Product is Already Added",

    );

    echo json_encode($data);

}


?>
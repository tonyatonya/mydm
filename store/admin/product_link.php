<?php

require_once "initapp.php";
if($_POST['phrase']) {
    $i = 0;
    $sql = "select * from sto_products where p_code like '%" . $_POST['phrase'] . "%'";
    if (!$db->execute($sql))
        throw new Exception("Operation Error");
    while ($db->read()) {

        $data[$i] = array(
            'p_code' => $db->result['p_code']
        );
        $i++;
    }


    echo json_encode($data);
}else{
    $data[$i] = array(
        'p_code' => 'NO DATA'
    );

    echo json_encode($data);
}

?>
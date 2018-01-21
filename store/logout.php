<?php
session_start();
?>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

if(empty($_SESSION)){

    $data = array(
        'msg' => 'LOG OUT SUCCESSFUL'
    );


    echo json_encode($data);
}
header('location: ./');//('./');
?>

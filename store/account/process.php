<?php
require_once "initapp.php";
$conn = mysql_connect("localhost", "$DB_USERNAME", "$DB_PASSWORD");
mysql_select_db($DB_NAME);

if (isset($_POST)){

    $name = mysql_real_escape_string($_POST['name']);
    $email = mysql_real_escape_string($_POST['email']);
    $login_name =  mysql_real_escape_string($_POST['login_name']);
    $password = mysql_real_escape_string($_POST['password']);
    $re_password = mysql_real_escape_string($_POST['re_password']);
    $country = mysql_real_escape_string($_POST['country']);
    $zipcode = mysql_real_escape_string($_POST['zipcode']);
    $address = mysql_real_escape_string($_POST['address']);
    $password = md5($password);

    $query = "insert into sto_user (u_id,u_name,u_email,u_login,u_password,status,usertype,u_country,u_zipcode,u_address,last_access_time)
			  values(NULL, '$name' ,'$email', '$login_name', '$password','Active','user', '$country', '$zipcode', '$address',CURRENT_TIMESTAMP )";
    mysql_query('set names utf8');

    $exec = mysql_query($query);

    $id = mysql_insert_id();


    if ($exec) {
        echo "<script> alert('Register Successful') </script>";
        echo"<META HTTP-EQUIV=\"REFRESH\"CONTENT=\"1;URL=login.php\">";
    }else{
        echo "<script> alert('Error') </script>";
    }

}else{

}


?>
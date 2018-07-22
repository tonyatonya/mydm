<?php

echo $_POST['name'];
$headers="From: admin@sightseeing.com\n";
$headers.="X-Sender: <$_POST[mail]>\n";
$headers.="X-Mailer: PHP\n";
$headers.="Return-Path: admin@sightseeing.com>\n";
$headers.= "Content-Type: text/html; charset=tis620";
$subject = "Confirmation Booking";
$mailto = "peekung114@hotmail.com";
$msg="test";
mail($mailto , $subject , $msg , $headers);
?>
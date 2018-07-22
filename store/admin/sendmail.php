<?php 	
	session_start();
	require_once "initapp.php";
	
	$org_name= "Chuo Senko";
	$admin_email = "admin@chuosenkko.co.th";
	$noreply_email = "Do-Not-Reply@chuosenkko.co.th";
	$footage = "";
	$signature = "Chuo Senko Team";
	$app_path = "http://www.chuosenkko.co.th/admin";

	function sendMailForgotPassword($email, $name, $pass){
		$header .= "Reply-To: ".$GLOBALS["org_name"]." (Do Not Reply) <".$GLOBALS["noreply_email"].">\r\n";     
		$header .= "Return-Path: ".$GLOBALS["org_name"]." <".$GLOBALS["admin_email"].">\r\n";     
		$header .= "From: ".$GLOBALS["org_name"]." <".$GLOBALS["admin_email"].">\r\n";     
		$header .= "Organization: ".$GLOBALS["org_name"]."\r\n";     
		$header .= "Content-Type: text/html; charset=utf-8 \r\n"; 
		$header .= "MIME-Version: 1.0' \r\n";
		$subject = "Your new password from ".$GLOBALS["org_name"]."";
		$message = "
<html>
<body style='font-family: Verdana, Geneva, sans-serif;color: #666;'>
	<p style='font-weight:bold;'>Dear ".$name.",</p>
	&nbsp;</br>
	<p> Your account has been reset.  Your new password is ".$pass."</p>
	<p> Please go to <a href='".$GLOBALS["app_path"]."'>".$GLOBALS["app_path"]."</a> to change your password</p>
&nbsp;<br/>	
	<p>".$GLOBALS["footage"]."</p>
	<p>".$GLOBALS["signature"]."</p>
<body>
</html>";
		$mail_sent = mail($email, $subject, $message, $header); 
		if(!$mail_sent)
			throw new Exception("Unable to send email, please contact us");
	}	
?>

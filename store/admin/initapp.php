<?php

	error_reporting(E_ERROR);
//	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	require_once "library/Common/DBConnect.php";
	require_once "library/Common/DateTimeObj.php";
	require_once "library/Common/Encryption.php";
	require_once "library/Common/HTMLGenerator.php";
	require_once "library/Common/Browser.php";
	require_once "library/Common/Image.php";
	require_once "library/User.php";
//	require_once "library/Company.php";
//	require_once "library/Customer.php";

	$DB_TYPE = "MySQL"; // MySQL & SQLite & XXX
	$DB_HOST = "localhost";
	$DB_USERNAME = "mydmme_admin";
	$DB_PASSWORD = "setup123456";
	$DB_NAME = "mydmme_db";
	$APP_NAME = "mydm_me";
	$APP_VERSION = "1.0";
	$APP_TITLE = "MYDM";
	
	$current_page="";
	
	$db = new DBConnect($DB_TYPE,$DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME);	
	$user = new User();
	if($user->checkUser() != ""){
		$user->load();
	}
	
	function getRealIpAddr(){
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	function checkBrowser(){
		$browser = new Browser();
		if(($browser->getVersion() >= 7.0 and $browser->getBrowser() == "Internet Explorer") or $browser->getBrowser()=="Chrome" or  $browser->getBrowser() == "Safari" or  
				$browser->getBrowser() == "Firefox" or $browser->getBrowser() == "iPhone" or $browser->getBrowser() == "Android"){

		}else
			print '<script type="text/javascript">alert("Your browser may not support this site. You may be shown an incorrect display.")</script>';
	}
?>
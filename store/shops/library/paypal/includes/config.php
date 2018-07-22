<?php
// Enable sessions
if(!session_id()) session_start();

// Set Timezone
date_default_timezone_set('America/Chicago');

// Set testing server (sandbox) and domain values.
$sandbox = FALSE;
$domain = $sandbox ? 'http://mydm.me/shops/' : 'http://mydm.me/store/shops';

if($sandbox)
{
	// Enable error reporting if application is running on the sandbox.
	error_reporting(E_ALL);
	ini_set('display_errors', '1');	
}

// Set PayPal API version and credentials
$api_version = '85.0';
//$api_username = $sandbox ? 'ttoonn_1355563371_biz_api1.gmail.com' : 'ttoonn112_api1.gmail.com';
//$api_password = $sandbox ? '1355563391' : 'TVD8KUZEB2CBRH5F';
//$api_signature = $sandbox ? 'ArhdYbyAiU80jgUnIbVgDh8z8HkhAzveKXlXvW2NiSnB1Tk9uEwMxOVZ' : 'AFcWxV21C7fd0v3bYYYRCpSSRl31AqaZNKpgWAnv0-rEH4ydi8IuR2Bb';

$api_username = $sandbox ? 'ttoonn_1355563371_biz_api1.gmail.com' : 'info_api1.mydm.me';
$api_password = $sandbox ? '1355563391' : '84DWVLAPR357GYRU';
$api_signature = $sandbox ? 'ArhdYbyAiU80jgUnIbVgDh8z8HkhAzveKXlXvW2NiSnB1Tk9uEwMxOVZ' : 'ATPIw5fHUpggS60cy4bmtK-Y1xOMATR8xTvHpezflyxwjASm8Ks2EToF';

?>
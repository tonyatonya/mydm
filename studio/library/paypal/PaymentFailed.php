<?php
// Include required library files.
require_once('includes/config.php');
require_once('includes/paypal.class.php');

// Create PayPal object.
$PayPalConfig = array(
					'Sandbox' => $sandbox,
					'APIUsername' => $api_username,
					'APIPassword' => $api_password,
					'APISignature' => $api_signature
					);

$PayPal = new PayPal($PayPalConfig);
?>
<!DOCTYPE html>
<html>
<head>
<title>Payment Failed</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>
	<h2>ทำรายการไม่สมบูรณ์</h2>
    <p>
	<?php
	if(isset($_SESSION['PayPalErrors']))
	{
		$PayPal->DisplayErrors($_SESSION['PayPalErrors']); 	
	}
	?>
    </p>
</body>
</html>
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

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$_SESSION['PayPalPayerID'] = isset($_GET['PayerID']) ? $_GET['PayerID'] : '';
$PayPalResult = $PayPal->GetExpressCheckoutDetails($_SESSION['PayPalToken']);

// If an error occurs, store the error info in a session and redirect to the failure page.
// Otherwise, redirect the user to PayPal to continue with payment.
if(strtoupper($PayPalResult['ACK']) != 'SUCCESS' && strtoupper($PayPalResult['ACK']) != 'SUCCESSWITHWARNING')
{
	$_SESSION['PayPalErrors'] = $PayPalResult['ERRORS'];
	header('Location: PaymentFailed.php');
	exit();
}
else
{
	// Here we store buyer data returned from PayPal in session variables for use throughout the app.
	$_SESSION['PayPalPhoneNumber'] = isset($PayPalResult['PHONENUM']) ? $PayPalResult['PHONENUM'] : '';
	$_SESSION['PayPalNote'] = isset($PayPalResult['NOTE']) ? $PayPalResult['NOTE'] : '';
	$_SESSION['PayPalEmail'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
	$_SESSION['PayPalPayerStatus'] = isset($PayPalResult['PAYERSTATUS']) ? $PayPalResult['PAYERSTATUS'] : '';
	$_SESSION['PayPalBusiness'] = isset($PayPalResult['BUSINESS']) ? $PayPalResult['BUSINESS'] : '';
	$_SESSION['PayPalFirstName'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
	$_SESSION['PayPalLastName'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';
	
	// Now we redirect to the final call to complete the payment process.
	header('Location: DoExpressCheckoutPayment.php');
	exit();
}
?>
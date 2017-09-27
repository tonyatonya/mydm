<?php
session_start();
if(!empty($_SESSION)) {
// Include required library files.
	require_once('includes/config.php');
	require_once('includes/paypal.class.php');

// Receive data from QR code and store in session variables for use throughout the app
	$_SESSION['ItemID'] = isset($_GET['id']) ? $_GET['id'] : '';
	$_SESSION['ItemName'] = isset($_GET['name']) ? $_GET['name'] : '';
	$_SESSION['ItemDescription'] = isset($_GET['description']) ? $_GET['description'] : '';
	$_SESSION['ItemPrice'] = isset($_GET['price']) ? $_GET['price'] : '';
	$_SESSION['ItemQTY'] = isset($_GET['qty']) ? $_GET['qty'] : '';
	$_SESSION['SalesTax'] = isset($_GET['tax']) ? $_GET['tax'] : '';
	$_SESSION['SubTotal'] = round($_SESSION['ItemPrice'] * $_SESSION['ItemQTY'], 2);
	$_SESSION['GrandTotal'] = $_SESSION['SubTotal'] + $_SESSION['SalesTax'];

// Set other values accordingly.
	$_SESSION['InvoiceNumber'] = strtoupper(uniqid());
	$_SESSION['PaymentAction'] = 'Sale';
	$_SESSION['CurrencyCode'] = 'THB';
	$_SESSION['ReturnURL'] = $domain . '/library/paypal/GetExpressCheckoutDetails.php';
	$_SESSION['CancelURL'] = $domain . '/PaymentCanceled.php';

// Create PayPal object.
	$PayPalConfig = array(
		'Sandbox' => $sandbox,
		'APIUsername' => $api_username,
		'APIPassword' => $api_password,
		'APISignature' => $api_signature
	);

	$PayPal = new PayPal($PayPalConfig);

// Prepare request arrays
	$SECFields = array(
		'returnurl' => $_SESSION['ReturnURL'],                            // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
		'cancelurl' => $_SESSION['CancelURL'],                            // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
		'noshipping' => '1',                        // The value 1 indiciates that on the PayPal pages, no shipping address fields should be displayed.  Maybe 1 or 0.
		'allownote' => '1',                            // The value 1 indiciates that the customer may enter a note to the merchant on the PayPal page during checkout.  The note is returned in the GetExpresscheckoutDetails response and the DoExpressCheckoutPayment response.  Must be 1 or 0.
		'skipdetails' => '1'                        // This is a custom field not included in the PayPal documentation.  It's used to specify whether you want to skip the GetExpressCheckoutDetails part of checkout or not.  See PayPal docs for more info.
	);

	$Payments = array();
	$Payment = array(
		'amt' => $_SESSION['GrandTotal'],                            // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
		'currencycode' => $_SESSION['CurrencyCode'],                    // A three-character currency code.  Default is USD.
		'itemamt' => $_SESSION['SubTotal'],                        // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
		'taxamt' => $_SESSION['SalesTax'],                        // Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
		'invnum' => $_SESSION['InvoiceNumber'],                        // Your own invoice or tracking number.  127 char max.
		'paymentaction' => $_SESSION['PaymentAction']                    // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
	);

	$PaymentOrderItems = array();

	$Item = array(
		'name' => '5555555555', 								// Item name. 127 char max.
		'desc' => $_SESSION['ItemDescription'], 								// Item description. 127 char max.
		'amt' => 58, 								// Cost of item.
		'number' => $_SESSION['ItemID'], 							// Item number.  127 char max.
		'qty' => $_SESSION['ItemQTY'] 								// Item qty on order.  Any positive integer.
	);
	$cart = $_GET['cart'] ;
	$cart = stripslashes($cart);
	$cart = json_decode($cart, true);

	foreach ($cart as $row){
		$Item = array(
			'name' => $row['name'], 								// Item name. 127 char max.
			'desc' => 'MYDM PRODUCT', 								// Item description. 127 char max.
			'amt' => $row['price'], 								// Cost of item.
			'number' => '', 							// Item number.  127 char max.
			'qty' => $row['qty'] 								// Item qty on order.  Any positive integer.
		);
		array_push($PaymentOrderItems, $Item);
	}
//	$Item = array(
//		'name' => '5555555555', 								// Item name. 127 char max.
//		'desc' => $_SESSION['ItemDescription'], 								// Item description. 127 char max.
//		'amt' => 58, 								// Cost of item.
//		'number' => $_SESSION['ItemID'], 							// Item number.  127 char max.
//		'qty' => $_SESSION['ItemQTY'] 								// Item qty on order.  Any positive integer.
//	);
//	array_push($PaymentOrderItems, $Item);

	$Payment['order_items'] = $PaymentOrderItems;
	array_push($Payments, $Payment);
	$PayPalRequestData = array('SECFields' => $SECFields, 'Payments' => $Payments);

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
	$PayPalResult = $PayPal->SetExpressCheckout($PayPalRequestData);
//
//// If an error occurs, store the error info in a session and redirect to the failure page.
//// Otherwise, redirect the user to PayPal to continue with payment.
	if (strtoupper($PayPalResult['ACK']) != 'SUCCESS' && strtoupper($PayPalResult['ACK']) != 'SUCCESSWITHWARNING') {
		$_SESSION['PayPalErrors'] = $PayPalResult['ERRORS'];
		header('Location: PaymentFailed.php');
		exit();
	} else {
		$_SESSION['PayPalToken'] = $PayPalResult['TOKEN'];
		header('Location: ' . $PayPalResult['REDIRECTURL']);
		exit();
	}
}else{

	header('Location: /store/account/login.php');
//

}
?>
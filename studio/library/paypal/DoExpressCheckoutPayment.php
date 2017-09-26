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

// Prepare request arrays
$DECPFields = array(
					'token' => $_SESSION['PayPalToken'], 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
					'payerid' => $_SESSION['PayPalPayerID'], 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
					'returnfmfdetails' => '1' 					// Flag to indiciate whether you want the results returned by Fraud Management Filters or not.  1 or 0.
				);
						
$Payments = array();
$Payment = array(
				'amt' => $_SESSION['GrandTotal'], 							// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
				'currencycode' => $_SESSION['CurrencyCode'], 					// A three-character currency code.  Default is USD.
				'itemamt' => $_SESSION['SubTotal'], 						// Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.  
				'taxamt' => $_SESSION['SalesTax'], 						// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
				'invnum' => $_SESSION['InvoiceNumber'], 						// Your own invoice or tracking number.  127 char max.
				'paymentaction' => $_SESSION['PaymentAction'] 					// How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order. 
				);
				
$PaymentOrderItems = array();
$Item = array(
			'name' => $_SESSION['ItemName'], 								// Item name. 127 char max.
			'desc' => $_SESSION['ItemDescription'], 								// Item description. 127 char max.
			'amt' => $_SESSION['ItemPrice'], 								// Cost of item.
			'number' => $_SESSION['ItemID'], 							// Item number.  127 char max.
			'qty' => $_SESSION['ItemQTY'] 								// Item qty on order.  Any positive integer.
			);
			
array_push($PaymentOrderItems, $Item);
$Payment['order_items'] = $PaymentOrderItems;				
array_push($Payments, $Payment);
							 
$PayPalRequestData = array(
					   'DECPFields' => $DECPFields, 
					   'Payments' => $Payments 
					   );

// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->DoExpressCheckoutPayment($PayPalRequestData);

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
	// Here we store all of the final payment information returned from PayPal into sessions for use throughout the app.
	$_SESSION['PayPalTransactionID'] = isset($PayPalResult['PAYMENTINFO_0_TRANSACTIONID']) ? $PayPalResult['PAYMENTINFO_0_TRANSACTIONID'] : '';
	$_SESSION['PayPalTransactionType'] = isset($PayPalResult['PAYMENTINFO_0_TRANSACTIONTYPE']) ? $PayPalResult['PAYMENTINFO_0_TRANSACTIONTYPE'] : '';
	$_SESSION['PayPalPaymentType'] = isset($PayPalResult['PAYMENTINFO_0_PAYMENTTYPE']) ? $PayPalResult['PAYMENTINFO_0_PAYMENTTYPE'] : '';
	$_SESSION['PayPalFee'] = isset($PayPalResult['PAYMENTINFO_0_FEEAMT']) ? $PayPalResult['PAYMENTINFO_0_FEEAMT'] : '';
	$_SESSION['PayPalPaymentStatus'] = isset($PayPalResult['PAYMENTINFO_0_PAYMENTSTATUS']) ? $PayPalResult['PAYMENTINFO_0_PAYMENTSTATUS'] : '';
	$_SESSION['PayPalPendingReason'] = isset($PayPalResult['PAYMENTINFO_0_PENDINGREASON']) ? $PayPalResult['PAYMENTINFO_0_PENDINGREASON'] : '';
	$_SESSION['PayPalPendingReasonCode'] = isset($PayPalResult['PAYMENTINFO_0_REASONCODE']) ? $PayPalResult['PAYMENTINFO_0_REASONCODE'] : '';
	
	// Now we redirect to the final receipt/thank you page.
	header('Location: '.$domain.'/PaymentComplete.php');
	exit();	
}
?>
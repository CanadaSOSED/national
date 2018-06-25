<?php
require_once('../../../../../portal_db_config.php');
// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment. Please note that direct 
// credit card payment and related features using the 
// REST API is restricted in some countries.
// API used: /v1/payments/payment
require __DIR__ . '/../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\CreditCard;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;

// ### CreditCard
// A resource representing a credit card that can be
// used to fund a payment.





$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$creditcardnumber = $_REQUEST['creditcardnumber'];
$cvv = $_REQUEST['cvv'];
$expirymonth = $_REQUEST['expirymonth'];
$expiryyear = $_REQUEST['expiryyear'];
$cardtype = $_REQUEST['cardtype'];
$country = $_REQUEST['country'];
$address = $_REQUEST['address'];
$state = $_REQUEST['state'];
$city = $_REQUEST['city'];
$pin = $_REQUEST['pin'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$currency = $_REQUEST['currency'];
$amount = $_REQUEST['amount'];
$tripid = $_REQUEST['tripid'];
$userid = $_REQUEST['userid'];




$card = new CreditCard();
$card->setType($cardtype)
    ->setNumber($creditcardnumber)
    ->setExpireMonth($expirymonth)
    ->setExpireYear($expiryyear)
    ->setCvv2($cvv)
    ->setFirstName($firstname)
    ->setLastName($lastname);

// ### FundingInstrument
// A resource representing a Payer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$fi = new FundingInstrument();
$fi->setCreditCard($card);

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$payer = new Payer();
$payer->setPaymentMethod("credit_card")
    ->setFundingInstruments(array($fi));

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName('SOS VOLUNTEER TRIP DONATION')
    ->setDescription('Donation Collection For : Trip ID:'+$tripid+" & User ID:"+ $userid)
    ->setCurrency($currency)
    ->setQuantity(1)
    ->setTax(0)
    ->setPrice(7.50);
//$item2 = new Item();
//$item2->setName('Granola bars')
//    ->setDescription('Granola Bars with Peanuts')
//    ->setCurrency('USD')
//    ->setQuantity(5)
//    ->setTax(0.2)
//    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setShipping(0)
    ->setTax(0)
    ->setSubtotal(7.50);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(7.50)
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("SOS VOLUNTEER TRIP DONATION!")
    ->setInvoiceNumber(uniqid());

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setTransactions(array($transaction));

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
 	ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://ppmts.custhelp.com/app/answers/detail/a_id/750">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
// ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);




return $payment;

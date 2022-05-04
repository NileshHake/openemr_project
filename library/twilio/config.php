<?php
include_once '../../interface/globals.php';
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require $GLOBALS['vendor_dir']. '/twilio/sdk/src/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


// Your Account SID and Auth Token from twilio.com/console
$sid = $GLOBALS['twilio_account_sid'];
$token = $GLOBALS['twilio_auth_token'];
$apiKey = $GLOBALS['twilio_api_key'];
$secretKey = $GLOBALS['twilio_secret_key'];
$twilio = new Client($sid, $token);



?>

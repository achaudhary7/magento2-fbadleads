<?php

use Magento\Framework\App\Bootstrap;
require 'app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$obj = $bootstrap->getObjectManager();

// Set the state (not sure if this is neccessary)
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$quote = $obj->get('Magento\Checkout\Model\Session')->getQuote();

// Use Your page/user access token
// This User/page acess token can be generated from https://developers.facebook.com/tools/accesstoken/'

$ACCESS_TOKEN = 'your access token'; 


$leadgen_id = $argv[1];
$ad_id = 0; $argv[2];
$ad_form_id = $argv[3];

// Send a curl request and get output in a variable -
$cmd = "curl -G -d 'access_token=".$ACCESS_TOKEN."' https://graph.facebook.com/v2.5/".$leadgen_id;
// Parse the variable to get - email , phone , name
$output = shell_exec($cmd);

$o1 = json_decode($output,true);
$fields = $o1['field_data'];
$name = "";
$email = "";
$phone = "";
foreach($fields as $field){
	if($field['name'] == 'phone_number'){
		$phone = $field['values'][0];
	}
	if($field['name'] == 'full_name'){
		$name = $field['values'][0];
	}
	if($field['name'] == 'email'){
		$email = $field['values'][0];
	}
}

// Place your app address, and path magento2 is my magento's installation folder name

$url = 'http://your-ip-address/magento2/fblead/index/post/';
$fields = array(
	'fb_leads_name' => urlencode($name),
	'fb_leads_phone' => urlencode($phone),
	'fb_leads_email' => urlencode($email),
	'fb_leads_leadgen_id' => urlencode($leadgen_id),
	'fb_leads_ad_id' => urlencode($ad_id),
	'fb_leads_form_id' => urlencode($ad_form_id)
);

//url-ify the data for the POST
$fields_string = "";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//execute post
$result = curl_exec($ch);
//close connection
curl_close($ch);
?>

<?php
$challenge = $_REQUEST['hub_challenge'];
$security_token = $_REQUEST['hub_verify_token'];
if($security_token == 'Mplex1234511') //use your security token
{
	echo $challenge;
}
$input = json_decode(file_get_contents('php://input'),true);

error_log(print_r($input,true));
//file_put_contents('/tmp/filename.txt', print_r($input, true));
$entry_arr = $input['entry'][0]['changes'];
$i =0;
foreach($entry_arr as $entry){
	$i++;
	$leadgen_id = $entry['value']['leadgen_id'];
	$ad_id = $entry['value']['ad_id'];
	$form_id = $entry['value']['form_id'];
	
	// use can use another path
	exec("php /var/www/html/magento2/get_leadgen_data.php ".$leadgen_id." ".$ad_id." ".$form_id." > /dev/null &");
	
}

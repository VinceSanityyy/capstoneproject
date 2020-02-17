<?php

header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Accept, X-Requested-With, x-xsrf-token");
header("Content-Type: application/json; charset=utf-8");



require_once "vendor/autoload.php";


$basic  = new \Nexmo\Client\Credentials\Basic('c78fec6c', 'MEb5g5bMPsaBe0KV');
$client = new \Nexmo\Client($basic);

$postjson = json_decode(file_get_contents('php://input'), true);






try {
    $message = $client->message()->send([
        'to' => $postjson['number'],
        'from' => 'Acme Inc',
        'text' => $postjson['message']
    ]);
    $response = $message->getResponseData();

    if($response['messages'][0]['status'] == 0) {
        
		  $result = json_encode(array('success'=>true,'msg'=>'The message was sent successfully'));
    } else {
        $s =  "The message failed with status: " . $response['messages'][0]['status'] . "\n";
		  $result = json_encode(array('success'=>false,'msg'=>$s));
    }
	echo $result;
} catch (Exception $e) {
    $s = "The message was not sent. Error: " . $e->getMessage() . "\n";
	  $result = json_encode(array('success'=>false,'msg'=> $s));
	  echo $result;
}



?>
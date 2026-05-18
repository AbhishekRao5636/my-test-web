<?php 
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Allow-Origin: https://selimxpro.com');
	header('Content-Type: application/json; charset=utf-8');
	header('Strict-Transport-Security: max-age=31536000');
	header('vary: Origin');
	
	date_default_timezone_set("Asia/Kolkata");
	$shnunc = date("Y-m-d H:i:s");
	$res = [
		'code' => 11,
		'msg' => 'Url is not exist',
		'msgCode' => 5,
		'ServiceNowTime' => $shnunc,
	];
	
	http_response_code(404);
	echo json_encode($res);
?>
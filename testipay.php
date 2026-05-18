<?php
	header('Content-type: text/plain; charset=utf-8');
	
	$date = date("Ymd");
	$time = time();

	$url = 'https://indianpay.co.in/admin/paynow';
	
	$merchantid = 'INDIANPAY10045';
	$orderid = 'sdfgfg48648536';
	
	$amount = 100;
	
	$name = 'Anurag';
	$email = 'anurag@gmail.com';
	$mobile = 1234567890;
	$remark = 'remark';
	$type = 2;
	$redirect_url = 'https://google.com';		
	
	//echo $sign;
	
	$data = array(
		'merchantid' => $merchantid,
		'orderid' => $orderid,
		'amount' => $amount,
		'name' => $name,
		'email' => $email,
		'mobile' => $mobile,
		'remark' => $remark,
		'type' => $type,
		'redirect_url' => $redirect_url
	);
	
	$jsonData = json_encode($data);
	
	$ch = curl_init($url);
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Content-Length: ' . strlen($jsonData)
	]);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
	
	$response = curl_exec($ch);
	
	if (curl_errno($ch)) {
		echo 'cURL error: ' . curl_error($ch);
	} else {		
		$responseData = json_decode($response, true);
			
		print_r($responseData);
	}

	curl_close($ch);
?>
<?php
	header('Content-type: text/plain; charset=utf-8');
	
	$date = date("Ymd");
	$time = time();

	$url = 'https://indianpay.co.in/admin/single_transaction';
	
	$salt = '';
	
	$merchant_id = 'INDIANPAY10045';
	$merchant_token = 'KFDZW5BHD2y8kzj8cW3t6yFV3jAX3iNS';
	$account_no = '8708186610';
	$ifsccode = 'AIRP0000001';
	$amount = 10;
	$bankname = 'Airtel payments Bank';
	$remark = 'remark';
	$orderid = 'sdfgfg48648klk';	
	$name = 'Surender';
	$contact = 8708186610;
	$email = 'anurag@gmail.com';			
	
	//echo $sign;
	
	$data_enc = array(
		'merchant_id' => $merchant_id,
		'merchant_token' => $merchant_token,
		'account_no' => $account_no,
		'ifsccode' => $ifsccode,
		'amount' => $amount,
		'bankname' => $bankname,
		'remark' => $remark,
		'orderid' => $orderid,
		'name' => $name,
		'contact' => $contact,
		'email' => $email
	);
	
	$jsonData_enc = json_encode($data_enc);
	$encoded = base64_encode($jsonData_enc);
	
	$data = array(
		'salt' => $encoded,
		'merchant_id' => $merchant_id,
		'merchant_token' => $merchant_token,
		'account_no' => $account_no,
		'ifsccode' => $ifsccode,
		'amount' => $amount,
		'bankname' => $bankname,
		'remark' => $remark,
		'orderid' => $orderid,
		'name' => $name,
		'contact' => $contact,
		'email' => $email
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
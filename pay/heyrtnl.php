<?php include ("../serive/samparka.php");?>
<?php
	$file = 'data_capture.txt';

	$rawData = file_get_contents("php://input");

	$getData = $_GET;

	$formattedData = "Date: " . date('Y-m-d H:i:s') . "\n";
	$formattedData .= "Raw Data: " . $rawData . "\n";
	$formattedData .= "GET Data: " . print_r($getData, true) . "\n";
	$formattedData .= "------------------------\n";
	
	file_put_contents($file, $formattedData, FILE_APPEND);

	//$shonupost = json_decode($rawData, true);
	
	$order_id = $_GET['order_id'];
	//$order_id = '150Rupya2024100117277847734032';
	
	$url = 'https://indianpay.co.in/admin/payinstatus?order_id='.$order_id;
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	$shonupost = json_decode($response, true);
	
	if($shonupost['status'] == 'success'){
		$mchOrderNo = $shonupost['transactionid'];
		
		$checkamt = mysqli_query($conn,"SELECT `motta`, `balakedara` from `thevani` where `dharavahi`='".$mchOrderNo."' AND `sthiti` = '0'");
		$checkamtrow = mysqli_num_rows($checkamt);
		if($checkamtrow >= 1){
			$checkamtar = mysqli_fetch_array($checkamt);
			$motta = $checkamtar['motta'];
			$shonuid = $checkamtar['balakedara'];
			$nabikarana = "UPDATE shonu_kaichila
			SET motta = ROUND(motta + '".$motta."', 2)
			WHERE balakedara = '".$shonuid."'";
			$conn->query($nabikarana);
			$sql2= mysqli_query($conn,"UPDATE `thevani` SET `sthiti` = '1' WHERE `dharavahi`='".$mchOrderNo."'");
		}
	}
	
	header('Location: https://selimxpro.com/#/wallet/RechargeHistory');
?>
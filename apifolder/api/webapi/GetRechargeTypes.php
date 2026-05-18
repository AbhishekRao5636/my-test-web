<?php 
	include "../../conn.php";
	include "../../functions2.php";
	
	header('Content-Type: application/json; charset=utf-8');
	header('Strict-Transport-Security: max-age=31536000');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
	header('Access-Control-Allow-Credentials: true');
	$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
	header('Access-Control-Allow-Origin: ' . $origin);
	header('vary: Origin');
	
	date_default_timezone_set("Asia/Kolkata");
	$shnunc = date("Y-m-d H:i:s");
	$res = [
		'code' => 11,
		'msg' => 'Method not allowed',
		'msgCode' => 12,
		'serviceNowTime' => $shnunc,
	];
	$shonubody = file_get_contents("php://input");
	$shonupost = json_decode($shonubody, true);
	
	if ($_SERVER['REQUEST_METHOD'] != 'GET') {
		if (isset($shonupost['language']) || isset($shonupost['payTypeId']) || isset($shonupost['payid']) || isset($shonupost['random']) || isset($shonupost['signature']) || isset($shonupost['timestamp'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$payTypeId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['payTypeId']));
			$payid = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['payid']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"language":'.$language.',"payTypeId":'.$payTypeId.',"payid":'.$payid.',"random":"'.$random.'"}';
			$shonusign = strtoupper(md5($shonustr));
			if($shonusign){
				$bearer = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);
				$author = $bearer[1];				
				$is_jwt_valid = is_jwt_valid($author);
				$data_auth = json_decode($is_jwt_valid, 1);
				if($data_auth['status'] === 'Success') {
					$sesquery = "SELECT akshinak
					  FROM shonu_subjects
					  WHERE akshinak = '$author'";
					$sesresult=$conn->query($sesquery);
					$sesnum = mysqli_num_rows($sesresult);
					if($sesnum == 1){
						$sites = 'https://selimxpro.com';
						
						if ($payid == 2) {
                            $data["rechargetypelist"]["0"]["payTypeID"] = (int)"1023";
                            $data["rechargetypelist"]["0"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["0"]["payName"] = "SG-pay";
                            $data["rechargetypelist"]["0"]["paySysName"] = "923";
                            $data["rechargetypelist"]["0"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["0"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["0"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["0"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["0"]["parameters"] = '';
                            $data["rechargetypelist"]["0"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["0"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["0"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["0"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["0"]["quickConfig"] = "";
                            $data["rechargetypelist"]["0"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 30000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                                
                            ];
                            $data["rechargetypelist"]["0"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["0"]["sort"] = 90000;
                           
                            $data["rechargetypelist"]["1"]["payTypeID"] = (int)"1124";
                            $data["rechargetypelist"]["1"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["1"]["payName"] = "TB-pay";
                            $data["rechargetypelist"]["1"]["paySysName"] = "923";
                            $data["rechargetypelist"]["1"]["miniPrice"] = (int)"300";
                            $data["rechargetypelist"]["1"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["1"]["scope"] = "500|800|1000|5000|10000|500000";
                            $data["rechargetypelist"]["1"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["1"]["parameters"] = '';
                            $data["rechargetypelist"]["1"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["1"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["1"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["1"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["1"]["quickConfig"] = "";
                            $data["rechargetypelist"]["1"]["quickConfigList"] = [
                                ["rechargeAmount" => 300.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 30000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["1"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["1"]["sort"] = 90000;  
                             
                            $data["rechargetypelist"]["2"]["payTypeID"] = (int)"1030";
                            $data["rechargetypelist"]["2"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["2"]["payName"] = "LG-pay";
                            $data["rechargetypelist"]["2"]["paySysName"] = "923";
                            $data["rechargetypelist"]["2"]["miniPrice"] = (int)"400";
                            $data["rechargetypelist"]["2"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["2"]["scope"] = "400|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["2"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["2"]["parameters"] = '';
                            $data["rechargetypelist"]["2"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["2"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["2"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["2"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["2"]["quickConfig"] = "";
                            $data["rechargetypelist"]["2"]["quickConfigList"] = [
                                ["rechargeAmount" => 400.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 1500.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 2000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["2"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["2"]["sort"] = 90000;  
                           
                        
                           $data["rechargetypelist"]["3"]["payTypeID"] = (int)"1029";
                            $data["rechargetypelist"]["3"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["3"]["payName"] = "FAST-UPIPay";
                            $data["rechargetypelist"]["3"]["paySysName"] = "923";
                            $data["rechargetypelist"]["3"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["3"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["3"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["3"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["3"]["parameters"] = '';
                            $data["rechargetypelist"]["3"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["3"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["3"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["3"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["3"]["quickConfig"] = "";
                            $data["rechargetypelist"]["3"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 15000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["3"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["3"]["sort"] = 90000;
                        
                            $data["rechargetypelist"]["4"]["payTypeID"] = (int)"1021";
                            $data["rechargetypelist"]["4"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["4"]["payName"] = "YaYa-APPpay";
                            $data["rechargetypelist"]["4"]["paySysName"] = "923";
                            $data["rechargetypelist"]["4"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["4"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["4"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["4"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["4"]["parameters"] = '';
                            $data["rechargetypelist"]["4"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["4"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["4"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["4"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["4"]["quickConfig"] = "";
                            $data["rechargetypelist"]["4"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 1500.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 2000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["4"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["4"]["sort"] = 90000;
                        
                                         }	
                                         if ($payid == 1) {
                            $data["rechargetypelist"]["0"]["payTypeID"] = (int)"1010";
                            $data["rechargetypelist"]["0"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["0"]["payName"] = "FAST-UPIpay";
                            $data["rechargetypelist"]["0"]["paySysName"] = "923";
                            $data["rechargetypelist"]["0"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["0"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["0"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["0"]["paySendUrl"] = $sites."/pay/wepay";  //$sites."/#/wallet/OtherPay?type=upi";
                            $data["rechargetypelist"]["0"]["parameters"] = '';
                            $data["rechargetypelist"]["0"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["0"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["0"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["0"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["0"]["quickConfig"] = "";
                            $data["rechargetypelist"]["0"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 5000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["0"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["0"]["sort"] = 90000;
                                           
                             $data["rechargetypelist"]["1"]["payTypeID"] = (int)"1012";
                            $data["rechargetypelist"]["1"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["1"]["payName"] = "Super-ORpay";
                            $data["rechargetypelist"]["1"]["paySysName"] = "923";
                            $data["rechargetypelist"]["1"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["1"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["1"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["1"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["1"]["parameters"] = '';
                            $data["rechargetypelist"]["1"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["1"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["1"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["1"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["1"]["quickConfig"] = "";
                            $data["rechargetypelist"]["1"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 15000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["1"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["1"]["sort"] = 90000;
                          
                            $data["rechargetypelist"]["2"]["payTypeID"] = (int)"1013";
                            $data["rechargetypelist"]["2"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["2"]["payName"] = "YaYa-ORpay";
                            $data["rechargetypelist"]["2"]["paySysName"] = "923";
                            $data["rechargetypelist"]["2"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["2"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["2"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["2"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["2"]["parameters"] = '';
                            $data["rechargetypelist"]["2"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["2"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["2"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["2"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["2"]["quickConfig"] = "";
                            $data["rechargetypelist"]["2"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 30000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["2"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["2"]["sort"] = 90000;
                        
                            $data["rechargetypelist"]["3"]["payTypeID"] = (int)"1014";
                            $data["rechargetypelist"]["3"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["3"]["payName"] = "UPI x QR";
                            $data["rechargetypelist"]["3"]["paySysName"] = "923";
                            $data["rechargetypelist"]["3"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["3"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["3"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["3"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["3"]["parameters"] = '';
                            $data["rechargetypelist"]["3"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["3"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["3"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["3"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["3"]["quickConfig"] = "";
                            $data["rechargetypelist"]["3"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 30000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["3"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["3"]["sort"] = 90000;
                            
                            $data["rechargetypelist"]["4"]["payTypeID"] = (int)"1015";
                            $data["rechargetypelist"]["4"]["payID"] = (int)"2";
                            $data["rechargetypelist"]["4"]["payName"] = "SunPay";
                            $data["rechargetypelist"]["4"]["paySysName"] = "923";
                            $data["rechargetypelist"]["4"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["4"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["4"]["scope"] = "200|500|1000|5000|10000|500000";
                            $data["rechargetypelist"]["4"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["4"]["parameters"] = '';
                            $data["rechargetypelist"]["4"]["startTime"] = "00:00";
                            $data["rechargetypelist"]["4"]["endTime"] = "24:00";
                            $data["rechargetypelist"]["4"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["4"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["4"]["quickConfig"] = "";
                            $data["rechargetypelist"]["4"]["quickConfigList"] = [
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 30000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                            ];
                            $data["rechargetypelist"]["4"]["random"] = 0.8192269882695508;
                            $data["rechargetypelist"]["4"]["sort"] = 90000;
                           
                                 }elseif ($payid == 11) {
                            $data["rechargetypelist"]["0"]["payTypeID"] = (int)"2123";
                            $data["rechargetypelist"]["0"]["payID"] = (int)"11";
                            $data["rechargetypelist"]["0"]["payName"] = "UPAY-USDT";
                            $data["rechargetypelist"]["0"]["paySysName"] = "825";
                            $data["rechargetypelist"]["0"]["miniPrice"] = (int)"10";
                            $data["rechargetypelist"]["0"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["0"]["scope"] = "500|1000|2500|5000|10000";
                            $data["rechargetypelist"]["0"]["paySendUrl"] = $sites."/pay/usdt";
                            $data["rechargetypelist"]["0"]["parameters"] = '';
                            $data["rechargetypelist"]["0"]["startTime"] = "01:00";
                            $data["rechargetypelist"]["0"]["endTime"] = "23:00";
                            $data["rechargetypelist"]["0"]["rechargeRifts"] = (float)"0.02";
                            $data["rechargetypelist"]["0"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["0"]["quickConfig"] = "";
                            $data["rechargetypelist"]["0"]["quickConfigList"] = [
                                ["rechargeAmount" => 10.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 20.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 200.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                             ];
                            $data["rechargetypelist"]["0"]["random"] = 0.758493;
                            $data["rechargetypelist"]["0"]["sort"] = 95000;
                                           
                            $data["rechargetypelist"]["1"]["payTypeID"] = (int)"2190";
                            $data["rechargetypelist"]["1"]["payID"] = (int)"11";
                            $data["rechargetypelist"]["1"]["payName"] = "UU-USDT";
                            $data["rechargetypelist"]["1"]["paySysName"] = "825";
                            $data["rechargetypelist"]["1"]["miniPrice"] = (int)"10";
                            $data["rechargetypelist"]["1"]["maxPrice"] = (int)"1000000";
                            $data["rechargetypelist"]["1"]["scope"] = "500|1000|2500|5000|10000";
                            $data["rechargetypelist"]["1"]["paySendUrl"] = $sites."/pay/usdt";
                            $data["rechargetypelist"]["1"]["parameters"] = '';
                            $data["rechargetypelist"]["1"]["startTime"] = "01:00";
                            $data["rechargetypelist"]["1"]["endTime"] = "23:00";
                            $data["rechargetypelist"]["1"]["rechargeRifts"] = (float)"0.02";
                            $data["rechargetypelist"]["1"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["1"]["quickConfig"] = "";
                            $data["rechargetypelist"]["1"]["quickConfigList"] = [
                                ["rechargeAmount" => 10.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 20.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 200.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                             ];
                            $data["rechargetypelist"]["1"]["random"] = 0.758493;
                            $data["rechargetypelist"]["1"]["sort"] = 95000;
                        
                        }elseif ($payid == 13) {
                            $data["rechargetypelist"]["0"]["payTypeID"] = (int)"2191";
                            $data["rechargetypelist"]["0"]["payID"] = (int)"11";
                            $data["rechargetypelist"]["0"]["payName"] = "7Day-PayTM";
                            $data["rechargetypelist"]["0"]["paySysName"] = "825";
                            $data["rechargetypelist"]["0"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["0"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["0"]["scope"] = "500|1000|2500|5000|10000";
                            $data["rechargetypelist"]["0"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["0"]["parameters"] = '';
                            $data["rechargetypelist"]["0"]["startTime"] = "01:00";
                            $data["rechargetypelist"]["0"]["endTime"] = "23:00";
                            $data["rechargetypelist"]["0"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["0"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["0"]["quickConfig"] = "";
                            $data["rechargetypelist"]["0"]["quickConfigList"] = [
                                 ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 30000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 0.0],
                             ];
                            $data["rechargetypelist"]["0"]["random"] = 0.758493;
                            $data["rechargetypelist"]["0"]["sort"] = 95000;
                                           
                            $data["rechargetypelist"]["1"]["payTypeID"] = (int)"2192";
                            $data["rechargetypelist"]["1"]["payID"] = (int)"11";
                            $data["rechargetypelist"]["1"]["payName"] = "UPI-PayTM";
                            $data["rechargetypelist"]["1"]["paySysName"] = "825";
                            $data["rechargetypelist"]["1"]["miniPrice"] = (int)"200";
                            $data["rechargetypelist"]["1"]["maxPrice"] = (int)"50000";
                            $data["rechargetypelist"]["1"]["scope"] = "500|1000|2500|5000|10000";
                            $data["rechargetypelist"]["1"]["paySendUrl"] = $sites."/pay/wepay";
                            $data["rechargetypelist"]["1"]["parameters"] = '';
                            $data["rechargetypelist"]["1"]["startTime"] = "01:00";
                            $data["rechargetypelist"]["1"]["endTime"] = "23:00";
                            $data["rechargetypelist"]["1"]["rechargeRifts"] = (float)"0.00";
                            $data["rechargetypelist"]["1"]["c2cUnitAmount"] = null;
                        
                            $data["rechargetypelist"]["1"]["quickConfig"] = "";
                            $data["rechargetypelist"]["1"]["quickConfigList"] = [
                                 ["rechargeAmount" => 200.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 500.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 1000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 10000.0, "giftAmount" => 00.0],
                                ["rechargeAmount" => 30000.0, "giftAmount" => 0.0],
                                ["rechargeAmount" => 50000.0, "giftAmount" => 00.0],
                             ];
                            $data["rechargetypelist"]["1"]["random"] = 0.758493;
                            $data["rechargetypelist"]["1"]["sort"] = 95000;
                        
                        }
						$data['banklist'] = null;
						$data['localUsdtlist'] = null;
						$data['thirdPayBankList'] = null;
												
						$res['data'] = $data;
						$res['code'] = 0;
						$res['msg'] = 'Succeed';
						$res['msgCode'] = 0;
						http_response_code(200);
						echo json_encode($res);					
					}
					else{
						$res['code'] = 4;
						$res['msg'] = 'No operation permission';
						$res['msgCode'] = 2;
						http_response_code(401);
						echo json_encode($res);
					}					
				}
				else{					
					$res['code'] = 4;
					$res['msg'] = 'No operation permission';
					$res['msgCode'] = 2;
					http_response_code(401);
					echo json_encode($res);					
				}
			}
			else{
				$res['code'] = 5;
				$res['msg'] = 'Wrong signature';
				$res['msgCode'] = 3;
				http_response_code(200);
				echo json_encode($res);				
			}
		}
		else{
			$res['code'] = 7;
			$res['msg'] = 'Param is Invalid';
			$res['msgCode'] = 6;
			http_response_code(200);
			echo json_encode($res);			
		}		
	} else {		
		http_response_code(405);
		echo json_encode($res);
	}
?>
<?php 
	include "../../conn.php";

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
		if (isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'"}';
			$shonusign = strtoupper(md5($shonustr));
			if($shonusign == $signature){
				http_response_code(200);
				echo '{
				  "data": [
					{
					  "playType": 1,
					  "playBet": "3",
					  "playRate": 207.36,
					  "playRate_Original": 207.36,
					  "playResult": "3"
					},
					{
					  "playType": 1,
					  "playBet": "4",
					  "playRate": 69.12,
					  "playRate_Original": 69.12,
					  "playResult": "4"
					},
					{
					  "playType": 1,
					  "playBet": "5",
					  "playRate": 34.56,
					  "playRate_Original": 34.56,
					  "playResult": "5"
					},
					{
					  "playType": 1,
					  "playBet": "6",
					  "playRate": 20.74,
					  "playRate_Original": 20.74,
					  "playResult": "6"
					},
					{
					  "playType": 1,
					  "playBet": "7",
					  "playRate": 13.83,
					  "playRate_Original": 13.83,
					  "playResult": "7"
					},
					{
					  "playType": 1,
					  "playBet": "8",
					  "playRate": 9.88,
					  "playRate_Original": 9.88,
					  "playResult": "8"
					},
					{
					  "playType": 1,
					  "playBet": "9",
					  "playRate": 8.3,
					  "playRate_Original": 8.3,
					  "playResult": "9"
					},
					{
					  "playType": 1,
					  "playBet": "10",
					  "playRate": 7.68,
					  "playRate_Original": 7.68,
					  "playResult": "10"
					},
					{
					  "playType": 1,
					  "playBet": "11",
					  "playRate": 7.68,
					  "playRate_Original": 7.68,
					  "playResult": "11"
					},
					{
					  "playType": 1,
					  "playBet": "12",
					  "playRate": 8.3,
					  "playRate_Original": 8.3,
					  "playResult": "12"
					},
					{
					  "playType": 1,
					  "playBet": "13",
					  "playRate": 9.88,
					  "playRate_Original": 9.88,
					  "playResult": "13"
					},
					{
					  "playType": 1,
					  "playBet": "14",
					  "playRate": 13.83,
					  "playRate_Original": 13.83,
					  "playResult": "14"
					},
					{
					  "playType": 1,
					  "playBet": "15",
					  "playRate": 20.74,
					  "playRate_Original": 20.74,
					  "playResult": "15"
					},
					{
					  "playType": 1,
					  "playBet": "16",
					  "playRate": 34.56,
					  "playRate_Original": 34.56,
					  "playResult": "16"
					},
					{
					  "playType": 1,
					  "playBet": "17",
					  "playRate": 69.12,
					  "playRate_Original": 69.12,
					  "playResult": "17"
					},
					{
					  "playType": 1,
					  "playBet": "18",
					  "playRate": 207.36,
					  "playRate_Original": 207.36,
					  "playResult": "18"
					},
					{
					  "playType": 2,
					  "playBet": "HL",
					  "playRate": 1.92,
					  "playRate_Original": 1.92,
					  "playResult": "HL"
					},
					{
					  "playType": 3,
					  "playBet": "OE",
					  "playRate": 1.92,
					  "playRate_Original": 1.92,
					  "playResult": "OE"
					},
					{
					  "playType": 4,
					  "playBet": "2BT",
					  "playRate": 6.91,
					  "playRate_Original": 6.91,
					  "playResult": "2BT"
					},
					{
					  "playType": 5,
					  "playBet": "2TD",
					  "playRate": 69.12,
					  "playRate_Original": 69.12,
					  "playResult": "2TD"
					},
					{
					  "playType": 6,
					  "playBet": "2TF",
					  "playRate": 13.83,
					  "playRate_Original": 13.83,
					  "playResult": "2TF"
					},
					{
					  "playType": 7,
					  "playBet": "3TD",
					  "playRate": 207.36,
					  "playRate_Original": 207.36,
					  "playResult": "3TD"
					},
					{
					  "playType": 8,
					  "playBet": "3TT",
					  "playRate": 34.56,
					  "playRate_Original": 34.56,
					  "playResult": "3TT"
					},
					{
					  "playType": 9,
					  "playBet": "3BT",
					  "playRate": 34.56,
					  "playRate_Original": 34.56,
					  "playResult": "3BT"
					},
					{
					  "playType": 10,
					  "playBet": "3LT",
					  "playRate": 8.64,
					  "playRate_Original": 8.64,
					  "playResult": "3LT"
					}
				  ],					
				  "code": 0,
				  "msg": "Succeed",
				  "msgCode": 0,
				  "serviceNowTime": "$shnunc"
				}';
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
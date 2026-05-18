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
					  "playID": 1,
					  "playType": 1,
					  "playBet": "0-9",
					  "playResult": "0-9",
					  "playRate": 9,
					  "playRate_Original": 9
					},
					{
					  "playID": 2,
					  "playType": 2,
					  "playBet": "H",
					  "playResult": "H",
					  "playRate": 1.98,
					  "playRate_Original": 2
					},
					{
					  "playID": 3,
					  "playType": 2,
					  "playBet": "L",
					  "playResult": "L",
					  "playRate": 1.98,
					  "playRate_Original": 2
					},
					{
					  "playID": 4,
					  "playType": 3,
					  "playBet": "O",
					  "playResult": "O",
					  "playRate": 1.98,
					  "playRate_Original": 2
					},
					{
					  "playID": 5,
					  "playType": 3,
					  "playBet": "E",
					  "playResult": "E",
					  "playRate": 1.98,
					  "playRate_Original": 2
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
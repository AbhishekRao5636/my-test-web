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
		if (isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'"}';
			$shonusign = strtoupper(md5($shonustr));
			if($shonusign == $signature){
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
						http_response_code(200);
						echo '{
							  "data": [
								{
								  "lv": 0,
								  "lvCount": 0,
								  "rechargeAmount": 0,
								  "lotteryAmount": 0,
								  "remark": "0 Agent"
								},
								{
								  "lv": 1,
								  "lvCount": 5,
								  "rechargeAmount": 100000,
								  "lotteryAmount": 500000,
								  "remark": "1 Agent"
								},
								{
								  "lv": 2,
								  "lvCount": 10,
								  "rechargeAmount": 200000,
								  "lotteryAmount": 1000000,
								  "remark": "2 Agent"
								},
								{
								  "lv": 3,
								  "lvCount": 15,
								  "rechargeAmount": 500000,
								  "lotteryAmount": 2500000,
								  "remark": "3 Agent"
								},
								{
								  "lv": 4,
								  "lvCount": 20,
								  "rechargeAmount": 700000,
								  "lotteryAmount": 3500000,
								  "remark": "4 Agent"
								},
								{
								  "lv": 5,
								  "lvCount": 25,
								  "rechargeAmount": 1000000,
								  "lotteryAmount": 5000000,
								  "remark": "5 Agent"
								},
								{
								  "lv": 6,
								  "lvCount": 30,
								  "rechargeAmount": 2000000,
								  "lotteryAmount": 10000000,
								  "remark": "6 Agent"
								},
								{
								  "lv": 7,
								  "lvCount": 100,
								  "rechargeAmount": 20000000,
								  "lotteryAmount": 100000000,
								  "remark": "7 Agent"
								},
								{
								  "lv": 8,
								  "lvCount": 500,
								  "rechargeAmount": 100000000,
								  "lotteryAmount": 500000000,
								  "remark": "8 Agent"
								},
								{
								  "lv": 9,
								  "lvCount": 1000,
								  "rechargeAmount": 200000000,
								  "lotteryAmount": 1000000000,
								  "remark": "9 Agent"
								},
								{
								  "lv": 10,
								  "lvCount": 5000,
								  "rechargeAmount": 300000000,
								  "lotteryAmount": 1500000000,
								  "remark": "10 Agent"
								}
							  ],
							  "code": 0,
							  "msg": "Succeed",
							  "msgCode": 0,
							  "serviceNowTime": "$shnunc"
							}
						';
					}
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
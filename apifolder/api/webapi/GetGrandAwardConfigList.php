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
						echo '
							{
							  "data": [
								{
								  "id": 1,
								  "multipleName": "10-19.99",
								  "betAmountName": "30-99",
								  "awardAmount": 20,
								  "sort": 99
								},
								{
								  "id": 2,
								  "multipleName": "20-29.99",
								  "betAmountName": "30-99",
								  "awardAmount": 50,
								  "sort": 98
								},
								{
								  "id": 3,
								  "multipleName": "30-39.99",
								  "betAmountName": "30-99",
								  "awardAmount": 100,
								  "sort": 97
								},
								{
								  "id": 4,
								  "multipleName": "40-59.99",
								  "betAmountName": "30-99",
								  "awardAmount": 150,
								  "sort": 96
								},
								{
								  "id": 5,
								  "multipleName": "60-99999",
								  "betAmountName": "30-99",
								  "awardAmount": 250,
								  "sort": 95
								},
								{
								  "id": 6,
								  "multipleName": "10-19.99",
								  "betAmountName": "100-99999",
								  "awardAmount": 50,
								  "sort": 94
								},
								{
								  "id": 7,
								  "multipleName": "20-29.99",
								  "betAmountName": "100-99999",
								  "awardAmount": 100,
								  "sort": 93
								},
								{
								  "id": 8,
								  "multipleName": "30-39.99",
								  "betAmountName": "100-99999",
								  "awardAmount": 200,
								  "sort": 92
								},
								{
								  "id": 9,
								  "multipleName": "40-59.99",
								  "betAmountName": "100-99999",
								  "awardAmount": 300,
								  "sort": 91
								},
								{
								  "id": 10,
								  "multipleName": "60-99999.99",
								  "betAmountName": "100-99999",
								  "awardAmount": 500,
								  "sort": 90
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
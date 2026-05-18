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
		if (isset($shonupost['isAll']) && isset($shonupost['language']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$isAll = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['isAll']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"isAll":true,"language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'"}';
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
							  "data": {
								"list": [
								  {
									"orderId": 1663621,
									"userId": 117891,
									"userPhoto": "1",
									"userName": "919648710900",
									"gameName": "Mines",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 13.52,
									"bonusAmount": 50,
									"multipleName": "10-19.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663620,
									"userId": 2509981,
									"userPhoto": "5",
									"userName": "918415059140",
									"gameName": "Fortune Gems 2",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 12,
									"bonusAmount": 20,
									"multipleName": "10-19.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663619,
									"userId": 2950261,
									"userPhoto": "2",
									"userName": "918415812437",
									"gameName": "Fortune Gems 2",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 10,
									"bonusAmount": 20,
									"multipleName": "10-19.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663618,
									"userId": 4802109,
									"userPhoto": "9",
									"userName": "919230083470",
									"gameName": "Money Coming",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 20.2,
									"bonusAmount": 50,
									"multipleName": "20-29.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663617,
									"userId": 3770584,
									"userPhoto": "1",
									"userName": "917320035635",
									"gameName": "Fortune Gems 2",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 33.33,
									"bonusAmount": 100,
									"multipleName": "30-39.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663616,
									"userId": 1829874,
									"userPhoto": "1",
									"userName": "9173828313007",
									"gameName": "Money Coming",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 10,
									"bonusAmount": 20,
									"multipleName": "10-19.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663615,
									"userId": 1750778,
									"userPhoto": "1",
									"userName": "919896366746",
									"gameName": "Money Coming",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 11.01,
									"bonusAmount": 50,
									"multipleName": "10-19.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663614,
									"userId": 3337945,
									"userPhoto": "1",
									"userName": "919001416034",
									"gameName": "Super Ace",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 11.75,
									"bonusAmount": 20,
									"multipleName": "10-19.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663613,
									"userId": 1941766,
									"userPhoto": "2",
									"userName": "919450908200",
									"gameName": "Fortune Gems 2",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 18,
									"bonusAmount": 20,
									"multipleName": "10-19.99",
									"createTime": "2024-08-02 14:15:02"
								  },
								  {
									"orderId": 1663612,
									"userId": 1750778,
									"userPhoto": "1",
									"userName": "919896366746",
									"gameName": "Money Coming",
									"imgUrl": null,
									"imgUrl2": null,
									"multiple": 20,
									"bonusAmount": 100,
									"multipleName": "20-29.99",
									"createTime": "2024-08-02 14:15:02"
								  }
								],
								"pageNo": 1,
								"totalPage": 1,
								"totalCount": 10
							  },
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
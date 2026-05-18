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
						  "data": {
							"typeList": [
							  {
								"type": 0,
								"typeName": "Bet amount reduced",
								"typeNameCode": "8000"
							  },
							  {
								"type": 1,
								"typeName": "Salary",
								"typeNameCode": "8001"
							  },
							  {
								"type": 2,
								"typeName": "Jackpot increase",
								"typeNameCode": "8002"
							  },
							  {
								"type": 3,
								"typeName": "Red envelope",
								"typeNameCode": "8003"
							  },
							  {
								"type": 4,
								"typeName": "Recharge increase",
								"typeNameCode": "8004"
							  },
							  {
								"type": 5,
								"typeName": "Withdrawal reduction",
								"typeNameCode": "8005"
							  },
							  {
								"type": 6,
								"typeName": "Cash back",
								"typeNameCode": "8006"
							  },
							  {
								"type": 7,
								"typeName": "Daily check-in",
								"typeNameCode": "8007"
							  },
							  {
								"type": 8,
								"typeName": "Agent red envelope recharge",
								"typeNameCode": "8008"
							  },
							  {
								"type": 9,
								"typeName": "Withdrawal rejected",
								"typeNameCode": "8009"
							  },
							  {
								"type": 10,
								"typeName": "Recharge gift",
								"typeNameCode": "8010"
							  },
							  {
								"type": 11,
								"typeName": "Manual recharge",
								"typeNameCode": "8011"
							  },
							  {
								"type": 12,
								"typeName": "Sign up to send money",
								"typeNameCode": "8012"
							  },
							  {
								"type": 13,
								"typeName": "Bonus recharge",
								"typeNameCode": "8013"
							  },
							  {
								"type": 14,
								"typeName": "First full gift",
								"typeNameCode": "8014"
							  },
							  {
								"type": 15,
								"typeName": "First charge rebate",
								"typeNameCode": "8015"
							  },
							  {
								"type": 16,
								"typeName": "Investment and financial management",
								"typeNameCode": "8016"
							  },
							  {
								"type": 17,
								"typeName": "Financial income",
								"typeNameCode": "8017"
							  },
							  {
								"type": 18,
								"typeName": "Financial principal",
								"typeNameCode": "8018"
							  },
							  {
								"type": 19,
								"typeName": "Redemption principal",
								"typeNameCode": "8019"
							  },
							  {
								"type": 20,
								"typeName": "Invite bonus",
								"typeNameCode": "8020"
							  },
							  {
								"type": 21,
								"typeName": "Game transfer in",
								"typeNameCode": "8021"
							  },
							  {
								"type": 22,
								"typeName": "Game transfer out",
								"typeNameCode": "8022"
							  },
							  {
								"type": 24,
								"typeName": "Jackpot increase",
								"typeNameCode": "8024"
							  },
							  {
								"type": 25,
								"typeName": "Card binding gift",
								"typeNameCode": "8025"
							  },
							  {
								"type": 26,
								"typeName": "Game money refund",
								"typeNameCode": "8026"
							  },
							  {
								"type": 27,
								"typeName": "Usdt recharge",
								"typeNameCode": "8027"
							  },
							  {
								"type": 28,
								"typeName": "Betting rebate",
								"typeNameCode": "8028"
							  },
							  {
								"type": 29,
								"typeName": "Vip member upgrade package",
								"typeNameCode": "8029"
							  },
							  {
								"type": 30,
								"typeName": "Monthly rewards for VIP members",
								"typeNameCode": "8030"
							  },
							  {
								"type": 31,
								"typeName": "Recharge Rewards for VIP Members",
								"typeNameCode": "8031"
							  },
							  {
								"type": 100,
								"typeName": "Bonus deduction",
								"typeNameCode": "8100"
							  },
							  {
								"type": 101,
								"typeName": "Manual withdrawal",
								"typeNameCode": "8101"
							  },
							  {
								"type": 102,
								"typeName": "One key wash code reverse water",
								"typeNameCode": "8102"
							  },
							  {
								"type": 103,
								"typeName": "Electronic Awards",
								"typeNameCode": "8103"
							  },
							  {
								"type": 104,
								"typeName": "Bind Mobile Awards",
								"typeNameCode": "8104"
							  },
							  {
								"type": 105,
								"typeName": "XOSO Issue Canceled",
								"typeNameCode": "8105"
							  },
							  {
								"type": 106,
								"typeName": "Bind Email Awards",
								"typeNameCode": "8106"
							  },
							  {
								"type": 107,
								"typeName": "Weekly Awards",
								"typeNameCode": "8107"
							  },
							  {
								"type": 108,
								"typeName": "C2C Withdraw Awards",
								"typeNameCode": "8108"
							  },
							  {
								"type": 109,
								"typeName": "C2C Withdraw",
								"typeNameCode": "8109"
							  },
							  {
								"type": 110,
								"typeName": "C2C Withdraw Back",
								"typeNameCode": "8110"
							  },
							  {
								"type": 111,
								"typeName": "C2C Recharge",
								"typeNameCode": "8111"
							  },
							  {
								"type": 112,
								"typeName": "C2C Recharge Awards",
								"typeNameCode": "8112"
							  },
							  {
								"type": 113,
								"typeName": "Newbie gift pack",
								"typeNameCode": "8113"
							  },
							  {
								"type": 114,
								"typeName": "Tournament Rewards",
								"typeNameCode": "8114"
							  },
							  {
								"type": 115,
								"typeName": "Return Awards",
								"typeNameCode": "8115"
							  },
							  {
								"type": 116,
								"typeName": "新会员首充负盈利送彩金",
								"typeNameCode": "8116"
							  },
							  {
								"type": 117,
								"typeName": "New members get bonuses by playing games",
								"typeNameCode": "8117"
							  },
							  {
								"type": 118,
								"typeName": "Daily Awards",
								"typeNameCode": "8118"
							  },
							  {
								"type": 119,
								"typeName": "Turntable Awards",
								"typeNameCode": "8119"
							  },
							  {
								"type": 122,
								"typeName": "Partner Rewards",
								"typeNameCode": "8122"
							  },
							  {
								"type": 123,
								"typeName": "Issue Canceled",
								"typeNameCode": "8123"
							  }
							]
						  },
						  "code": 0,
						  "msg": "Succeed",
						  "msgCode": 0,
						  "serviceNowTime": "$shnunc"
						}';

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
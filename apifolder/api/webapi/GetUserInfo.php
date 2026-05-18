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
						$data['userId'] = (int)$data_auth['payload']['id'];
						$data['userPhoto'] = '1';
						$data['userName'] = '91'.$data_auth['payload']['mobile'];
						$data['nickName'] = $data_auth['payload']['codechorkamukala'];
						
						$balquery = "SELECT motta
						  FROM shonu_kaichila
						  WHERE balakedara = ".$data_auth['payload']['id'];
						$balresult = $conn->query($balquery);
						$balarr = mysqli_fetch_array($balresult);
						
						$data['amount'] = $balarr['motta'];
						
						$creaquery = "SELECT createdate, shonullgnt
						  FROM shonu_subjects
						  WHERE id = ".$data_auth['payload']['id'];
						$crearesult = $conn->query($creaquery);
						if ($crearesult && $crearesult->num_rows > 0) {
							$creaarr = $crearesult->fetch_assoc();
							
							// Update userLoginDate from shonullgnt
							$data['userLoginDate'] = $creaarr['shonullgnt'] ?: 'N/A'; // Default to 'N/A' if empty
							
							$knbdstr = '{"userId":'.$data['userId'].',"userPhoto":"'.$data['userPhoto'].'","userName":'.$data['userName'].',"nickName":"'.$data['nickName'].'","createdate":"'.$creaarr['createdate'].'"}';
							
							$data['sign'] = strtoupper(hash('sha256', $knbdstr));
						} else {
							$res['code'] = 5;
							$res['msg'] = 'Failed to fetch user data';
							$res['msgCode'] = 3;
							http_response_code(400);
							echo json_encode($res);
							exit;
						}
						
						$data['amountofCode'] = 0.00;
						$data['isWithdraw'] = null;
						$data['message'] = null;
						$data['withdrawCount'] = 0;
						
						$data['addTime'] = '2024-04-17 14:10:50';
						$data['startTime'] = null;
						$data['endTime'] = null;
						$data['fee'] = 0.0;
						$data['unRead'] = 18;
						$data['facebookAppID'] = null;
						$data['googleAppID'] = null;
						$data['twitterAppID'] = null;
						$data['keyCode'] = null;
						$data['uRate'] = 93.0;
						$data['trxRate'] = 10.0;
						$data['uGold'] = 0.00;
						$data['googleVerify'] = 0;
						$data['isvalidator'] = 0;
						$data['isRePwd'] = '1';
						$data['integral'] = 0;
						$data['isOpenPointMall'] = '0';
						$data['isOpenAmountOfCode'] = '1';
						$data['isOpenOfficialRechargeInputDialog'] = '0';
						$data['isAllowUserAddUSDT'] = '1';
						$data['isShowWalletTotalCT'] = '0';
						$data['isShowRechargeBankList'] = '0';
						$data['isPopupCommissionSwitch'] = '0';
						
						$data['groupDataShowAuth'][0]['id'] = 11;
						$data['groupDataShowAuth'][0]['isShow'] = true;
						$data['groupDataShowAuth'][1]['id'] = 12;
						$data['groupDataShowAuth'][1]['isShow'] = true;
						$data['groupDataShowAuth'][2]['id'] = 15;
						$data['groupDataShowAuth'][2]['isShow'] = true;
						$data['groupDataShowAuth'][3]['id'] = 16;
						$data['groupDataShowAuth'][3]['isShow'] = true;
						$data['groupDataShowAuth'][4]['id'] = 17;
						$data['groupDataShowAuth'][4]['isShow'] = true;
						$data['groupDataShowAuth'][5]['id'] = 18;
						$data['groupDataShowAuth'][5]['isShow'] = true;
						$data['groupDataShowAuth'][6]['id'] = 19;
						$data['groupDataShowAuth'][6]['isShow'] = true;
						$data['groupDataShowAuth'][7]['id'] = 20;
						$data['groupDataShowAuth'][7]['isShow'] = true;
						
						$data['verifyMethods']['mobile'] = '91'.$data_auth['payload']['mobile'];
						$data['verifyMethods']['email'] = '';
						$data['verifyMethods']['google'] = '0';
						
						$data['regType'] = 1;

						$data['userGroupAuth'][0] = '0';
						$data['userGroupAuth'][1] = '1';
						$data['userGroupAuth'][2] = '2';
						$data['userGroupAuth'][3] = '3';
						$data['userGroupAuth'][4] = '4';
						$data['userGroupAuth'][5] = '5';
						$data['userGroupAuth'][6] = '6';
						$data['userGroupAuth'][7] = '7';
						$data['userGroupAuth'][8] = '8';
						$data['userGroupAuth'][9] = '9';
						
						$data['bindReward'] = 0.0;
						$data['isGoogle'] = '0';
						$data['isOpenChampion'] = '0';
						$data['isAllowWithdraw'] = 1;
						
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

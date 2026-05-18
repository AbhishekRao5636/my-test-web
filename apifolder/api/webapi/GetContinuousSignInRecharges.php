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
						$shonuid = $data_auth['payload']['id'];
						
						$existance = mysqli_query($conn,"SELECT `daysonearth`, `totalblessings` FROM `cihne` WHERE `identity`='".$shonuid."' ORDER BY `dearlord` DESC LIMIT 1");
						$existance_ar = mysqli_fetch_array($existance);
						$data['signIn']['signCount'] = $existance_ar['daysonearth'];
						$data['signIn']['isCycle'] = $existance_ar['daysonearth'];
						$data['signIn']['signInSum'] = $existance_ar['totalblessings'];
						
						$data['signInRechargesList'][0]['rechargesID'] = 1;
						$data['signInRechargesList'][0]['amount'] = 300;
						$data['signInRechargesList'][0]['day'] = 1;
						$data['signInRechargesList'][0]['bouns'] = 7;
						$existance_ar['daysonearth'] >= 1 ? $data['signInRechargesList'][0]['isReceive'] = 1 : $data['signInRechargesList'][0]['isReceive'] = 0;
						
						$data['signInRechargesList'][1]['rechargesID'] = 2;
						$data['signInRechargesList'][1]['amount'] = 1000;
						$data['signInRechargesList'][1]['day'] = 2;
						$data['signInRechargesList'][1]['bouns'] = 20;
						$existance_ar['daysonearth'] >= 2 ? $data['signInRechargesList'][1]['isReceive'] = 1 : $data['signInRechargesList'][1]['isReceive'] = 0;
						
						$data['signInRechargesList'][2]['rechargesID'] = 3;
						$data['signInRechargesList'][2]['amount'] = 3000;
						$data['signInRechargesList'][2]['day'] = 3;
						$data['signInRechargesList'][2]['bouns'] = 100;
						$existance_ar['daysonearth'] >= 3 ? $data['signInRechargesList'][2]['isReceive'] = 1 : $data['signInRechargesList'][2]['isReceive'] = 0;
						
						$data['signInRechargesList'][3]['rechargesID'] = 4;
						$data['signInRechargesList'][3]['amount'] = 8000;
						$data['signInRechargesList'][3]['day'] = 4;
						$data['signInRechargesList'][3]['bouns'] = 200;
						$existance_ar['daysonearth'] >= 4 ? $data['signInRechargesList'][3]['isReceive'] = 1 : $data['signInRechargesList'][3]['isReceive'] = 0;
						
						$data['signInRechargesList'][4]['rechargesID'] = 5;
						$data['signInRechargesList'][4]['amount'] = 20000;
						$data['signInRechargesList'][4]['day'] = 5;
						$data['signInRechargesList'][4]['bouns'] = 450;
						$existance_ar['daysonearth'] >= 5 ? $data['signInRechargesList'][4]['isReceive'] = 1 : $data['signInRechargesList'][4]['isReceive'] = 0;
						
						$data['signInRechargesList'][5]['rechargesID'] = 6;
						$data['signInRechargesList'][5]['amount'] = 80000;
						$data['signInRechargesList'][5]['day'] = 6;
						$data['signInRechargesList'][5]['bouns'] = 2400;
						$existance_ar['daysonearth'] >= 6 ? $data['signInRechargesList'][5]['isReceive'] = 1 : $data['signInRechargesList'][5]['isReceive'] = 0;
						
						$data['signInRechargesList'][6]['rechargesID'] = 7;
						$data['signInRechargesList'][6]['amount'] = 200000;
						$data['signInRechargesList'][6]['day'] = 7;
						$data['signInRechargesList'][6]['bouns'] = 6400;
						$existance_ar['daysonearth'] >= 7 ? $data['signInRechargesList'][6]['isReceive'] = 1 : $data['signInRechargesList'][6]['isReceive'] = 0;
						
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
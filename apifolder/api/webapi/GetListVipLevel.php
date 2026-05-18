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
			$vipLevel = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['vipLevel']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'","vipLevel":'.$vipLevel.'}';
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
						if($vipLevel == 1){														
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 60;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 30;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.05;
						}
						else if($vipLevel == 2){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 180;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 90;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.05;			
						}
						else if($vipLevel == 3){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 690;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 290;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.1;			
						}
						else if($vipLevel == 4){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 1890;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 890;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.1;																	
						}
						else if($vipLevel == 5){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 6900;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 1890;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.1;																	
						}
						else if($vipLevel == 6){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 16900;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 6900;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.15;																	
						}
						else if($vipLevel == 7){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 69000;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 16900;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.15;																	
						}
						else if($vipLevel == 8){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 169000;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 69000;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.15;																	
						}
						else if($vipLevel == 9){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 690000;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 169000;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.2;																	
						}
						else if($vipLevel == 10){
							$data[0]['id'] = 1;
							$data[0]['name'] = '升级礼包';
							$data[0]['description'] = '每个账号只能领取一次';
							$data[0]['integral'] = 0;
							$data[0]['balance'] = 1690000;
							$data[0]['rate'] = 0;
							
							$data[1]['id'] = 2;
							$data[1]['name'] = '每月奖励';
							$data[1]['description'] = '每个账号每月只能领取一次';
							$data[1]['integral'] = 0;
							$data[1]['balance'] = 690000;
							$data[1]['rate'] = 0;
							
							$data[2]['id'] = 3;
							$data[2]['name'] = '充值奖励';
							$data[2]['description'] = '每次充值都可以获得奖励';
							$data[2]['integral'] = 0;
							$data[2]['balance'] = 0;
							$data[2]['rate'] = 0;
							
							$data[3]['id'] = 4;
							$data[3]['name'] = '保险箱';
							$data[3]['description'] = '增加保险箱的额外收益';
							$data[3]['integral'] = 0;
							$data[3]['balance'] = 0;
							$data[3]['rate'] = 0;
							
							$data[4]['id'] = 5;
							$data[4]['name'] = '洗码率';
							$data[4]['description'] = '增加洗码反水的额外收益';
							$data[4]['integral'] = 0;
							$data[4]['balance'] = 0;
							$data[4]['rate'] = 0.3;																	
						}
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
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
		if (isset($shonupost['getAll']) && isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$getAll = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['getAll']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			if(empty($getAll)){
				$shonustr = '{"getAll":false,"language":'.$language.',"random":"'.$random.'"}';
			}
			else{
				$shonustr = '{"getAll":true,"language":'.$language.',"random":"'.$random.'"}';
			}
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
						
						$tiramisu = "SELECT `motta` 
						FROM `thevani` 
						WHERE `balakedara` = '$shonuid' AND `sthiti` = 1 ORDER BY shonu ASC LIMIT 1";
						$mascarpone = $conn->query($tiramisu);
						$pannacotta = mysqli_fetch_array($mascarpone);
						$mamashri = !empty($pannacotta['motta']) ? $pannacotta['motta'] : 0;
						
						$cannoli = "SELECT id FROM egrahcer_sonub WHERE dr = '".$shonuid."' AND status = 1";
						$cassata = $conn->query($cannoli);
						$risotto = mysqli_num_rows($cassata);
						
						$data[0]['id'] = 8;
						$data[0]['rewardAmount'] = 10000;
						$data[0]['rechargeAmount'] = 200000;
						$data[0]['order'] = 9;
						$data[0]['state'] = 1;
						$data[0]['createTime'] = '2024-04-05 15:24:22';
						$data[0]['lastUpdateTime'] = '2024-04-05 15:24:26';
						$data[0]['canReceive'] = $mamashri >= 200000 ? true : false;
						$data[0]['isFinshed'] = $risotto > 0 ? true : false;
						
						$data[1]['id'] = 7;
						$data[1]['rewardAmount'] = 5000;
						$data[1]['rechargeAmount'] = 100000;
						$data[1]['order'] = 8;
						$data[1]['state'] = 1;
						$data[1]['createTime'] = '2024-04-05 15:24:11';
						$data[1]['lastUpdateTime'] = '2024-04-05 15:24:27';
						$data[1]['canReceive'] = $mamashri >= 100000 ? true : false;
						$data[1]['isFinshed'] = $risotto > 0 ? true : false;
						
						$data[2]['id'] = 6;
						$data[2]['rewardAmount'] = 2000;
						$data[2]['rechargeAmount'] = 30000;
						$data[2]['order'] = 7;
						$data[2]['state'] = 1;
						$data[2]['createTime'] = '2024-04-05 15:23:59';
						$data[2]['lastUpdateTime'] = '2024-04-05 15:24:25';
						$data[2]['canReceive'] = $mamashri >= 30000 ? true : false;
						$data[2]['isFinshed'] = $risotto > 0 ? true : false;
						
						$data[3]['id'] = 5;
						$data[3]['rewardAmount'] = 600;
						$data[3]['rechargeAmount'] = 10000;
						$data[3]['order'] = 6;
						$data[3]['state'] = 1;
						$data[3]['createTime'] = '2024-04-05 15:23:44';
						$data[3]['lastUpdateTime'] = '2024-04-05 15:24:24';
						$data[3]['canReceive'] = $mamashri >= 10000 ? true : false;
						$data[3]['isFinshed'] = $risotto > 0 ? true : false;
						
						$data[4]['id'] = 4;
						$data[4]['rewardAmount'] = 300;
						$data[4]['rechargeAmount'] = 3000;
						$data[4]['order'] = 5;
						$data[4]['state'] = 1;
						$data[4]['createTime'] = '2024-03-22 17:30:32';
						$data[4]['lastUpdateTime'] = '2024-04-05 15:23:33';
						$data[4]['canReceive'] = $mamashri >= 3000 ? true : false;
						$data[4]['isFinshed'] = $risotto > 0 ? true : false;
						
						$data[5]['id'] = 3;
						$data[5]['rewardAmount'] = 150;
						$data[5]['rechargeAmount'] = 1000;
						$data[5]['order'] = 4;
						$data[5]['state'] = 1;
						$data[5]['createTime'] = '2024-03-22 17:30:17';
						$data[5]['lastUpdateTime'] = '2024-04-05 15:23:11';
						$data[5]['canReceive'] = $mamashri >= 1000 ? true : false;
						$data[5]['isFinshed'] = $risotto > 0 ? true : false;
						
						$data[6]['id'] = 1;
						$data[6]['rewardAmount'] = 60;
						$data[6]['rechargeAmount'] = 300;
						$data[6]['order'] = 2;
						$data[6]['state'] = 1;
						$data[6]['createTime'] = '2024-03-22 17:29:40';
						$data[6]['lastUpdateTime'] = '2024-04-05 15:22:38';
						$data[6]['canReceive'] = $mamashri >= 300 ? true : false;
						$data[6]['isFinshed'] = $risotto > 0 ? true : false;
						
						$data[7]['id'] = 2;
						$data[7]['rewardAmount'] = 20;
						$data[7]['rechargeAmount'] = 100;
						$data[7]['order'] = 1;
						$data[7]['state'] = 1;
						$data[7]['createTime'] = '2024-03-22 17:29:51';
						$data[7]['lastUpdateTime'] = '2024-04-05 15:22:29';
						$data[7]['canReceive'] = $mamashri >= 100 ? true : false;
						$data[7]['isFinshed'] = $risotto > 0 ? true : false;
						
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
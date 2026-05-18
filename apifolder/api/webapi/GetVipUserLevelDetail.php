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
						$vipquery = "SELECT expe, lvl
						  FROM vip
						  WHERE userid = ".$data_auth['payload']['id'];
						$vipresult = $conn->query($vipquery);
						$viparr = mysqli_fetch_array($vipresult);
						
						$data[0]['id'] = 1;
						$data[0]['vipName'] = 'VIP1';
						$data[0]['status'] = 1;
						$data[0]['currentExp'] = (int)$viparr['expe'];
						$data[0]['upgrade'] = 3000;
						$data[0]['relegationExp'] = (int)$viparr['expe'];
						$data[0]['relegation'] = 1000;
						$data[0]['deductExp'] = 1500;
						$data[0]['amount'] = 1;
						if($viparr['lvl'] >= 1){
							$data[0]['upgradeStatus'] = 1;
						}
						else{
							$data[0]['upgradeStatus'] = 0;
						}						
						
						$data[1]['id'] = 2;
						$data[1]['vipName'] = 'VIP2';
						$data[1]['status'] = 1;
						$data[1]['currentExp'] = (int)$viparr['expe'];
						$data[1]['upgrade'] = 30000;
						$data[1]['relegationExp'] = (int)$viparr['expe'];
						$data[1]['relegation'] = 10000;
						$data[1]['deductExp'] = 15000;
						$data[1]['amount'] = 1;
						if($viparr['lvl'] >= 2){
							$data[1]['upgradeStatus'] = 1;
						}
						else{
							$data[1]['upgradeStatus'] = 0;
						}	
						
						$data[2]['id'] = 3;
						$data[2]['vipName'] = 'VIP3';
						$data[2]['status'] = 1;
						$data[2]['currentExp'] = (int)$viparr['expe'];
						$data[2]['upgrade'] = 400000;
						$data[2]['relegationExp'] = (int)$viparr['expe'];
						$data[2]['relegation'] = 100000;
						$data[2]['deductExp'] = 200000;
						$data[2]['amount'] = 1;
						if($viparr['lvl'] >= 3){
							$data[2]['upgradeStatus'] = 1;
						}
						else{
							$data[2]['upgradeStatus'] = 0;
						}	
						
						$data[3]['id'] = 4;
						$data[3]['vipName'] = 'VIP4';
						$data[3]['status'] = 1;
						$data[3]['currentExp'] = (int)$viparr['expe'];
						$data[3]['upgrade'] = 4000000;
						$data[3]['relegationExp'] = (int)$viparr['expe'];
						$data[3]['relegation'] = 1000000;
						$data[3]['deductExp'] = 2000000;
						$data[3]['amount'] = 1;
						if($viparr['lvl'] >= 4){
							$data[3]['upgradeStatus'] = 1;
						}
						else{
							$data[3]['upgradeStatus'] = 0;
						}	
						
						$data[4]['id'] = 5;
						$data[4]['vipName'] = 'VIP5';
						$data[4]['status'] = 1;
						$data[4]['currentExp'] = (int)$viparr['expe'];
						$data[4]['upgrade'] = 20000000;
						$data[4]['relegationExp'] = (int)$viparr['expe'];
						$data[4]['relegation'] = 10000000;
						$data[4]['deductExp'] = 10000000;
						$data[4]['amount'] = 1;
						if($viparr['lvl'] >= 5){
							$data[4]['upgradeStatus'] = 1;
						}
						else{
							$data[4]['upgradeStatus'] = 0;
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
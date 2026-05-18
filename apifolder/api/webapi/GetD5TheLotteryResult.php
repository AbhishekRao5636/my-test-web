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
		if (isset($shonupost['issueNumber']) && isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$issueNumber = mysqli_real_escape_string($conn, $shonupost['issueNumber']);
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"issueNumber":"'.$issueNumber.'","language":'.$language.',"random":"'.$random.'"}';
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
						$typeId = $issueNumber[9];
						$shonuid = $data_auth['payload']['id'];
						
						if($typeId == 5){
							$oedajnahb = 'bajikattuttate_aidudi';
						}
						else if($typeId == 6){
							$oedajnahb = 'bajikattuttate_aidudi_drei';
						}
						else if($typeId == 7){
							$oedajnahb = 'bajikattuttate_aidudi_funf';
						}
						else if($typeId == 8){
							$oedajnahb = 'bajikattuttate_aidudi_zehn';
						}
						
						$samasye = "SELECT phalaphala, sesabida, ergebnis, zufallig
						  FROM ".$oedajnahb." WHERE kalaparichaya = $issueNumber AND byabaharkarta = $shonuid
						  ORDER BY parichaya DESC LIMIT 1";
						$samasyephalitansa = $conn->query($samasye);
						$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
						
						$data['issueNumber'] = $issueNumber;
						$data['typeID'] = 5;																						
						
						$data['typeName'] = '5D 1 Minute';
						if($samasyephalitansa_sreni['phalaphala'] == 'perte'){
							$state = 0;
							$data['winAmount'] = 0;		
						}
						else if($samasyephalitansa_sreni['phalaphala'] == 'gagner'){
							$state = 1;
							$data['winAmount'] = $samasyephalitansa_sreni['sesabida'];		
						}
						$data['state'] = $state;
						
						$data['premium'] = $samasyephalitansa_sreni['zufallig'];
						$data['sumCount'] = $samasyephalitansa_sreni['ergebnis'];	
						
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
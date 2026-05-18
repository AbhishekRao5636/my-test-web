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
						$typeId = $issueNumber[8].$issueNumber[9];
						$shonuid = $data_auth['payload']['id'];
						
						if($typeId == '09'){
							$mothermary = 'bajikattuttate_kemuru';
						}
						else if($typeId == '10'){
							$mothermary = 'bajikattuttate_kemuru_drei';
						}
						else if($typeId == '11'){
							$mothermary = 'bajikattuttate_kemuru_funf';
						}
						else if($typeId == '12'){
							$mothermary = 'bajikattuttate_kemuru_zehn';
						}
						
						$samasye = "SELECT phalaphala, sesabida, ergebnis, zufallig
						  FROM ".$mothermary." WHERE kalaparichaya = $issueNumber AND byabaharkarta = $shonuid
						  ORDER BY parichaya DESC LIMIT 1";
						$samasyephalitansa = $conn->query($samasye);
						$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
						
						$data['issueNumber'] = $issueNumber;
						$data['number'] = $samasyephalitansa_sreni['ergebnis'];
						
						$data['winAmount'] = $samasyephalitansa_sreni['sesabida'];
						
						function checkThreeDigitNumber($number) {
							if (preg_match('/^[1-6]{3}$/', $number)) {
								$digits = str_split($number);
								$d1 = (int)$digits[0];
								$d2 = (int)$digits[1];
								$d3 = (int)$digits[2];
								$output['allDifferent'] = ($d1 !== $d2 && $d1 !== $d3 && $d2 !== $d3);
								$output['consecutive'] = (max($d1, $d2, $d3) - min($d1, $d2, $d3) == 2) &&
														 (abs($d1 - $d2) == 1 || abs($d1 - $d3) == 1 || abs($d2 - $d3) == 1);
								$output['anyTwoSame'] = ($d1 === $d2 || $d1 === $d3 || $d2 === $d3);
								$output['allSame'] = ($d1 === $d2 && $d2 === $d3);
								return $output;
							}
						}
						$checkbele = checkThreeDigitNumber($samasyephalitansa_sreni['zufallig']);
						if($checkbele['allSame']){
							$gameType = 3;
						}
						else if($checkbele['anyTwoSame']){
							$gameType = 2;
						}
						else if($checkbele['consecutive']){
							$gameType = 1;
						}
						else if($checkbele['allDifferent']){
							$gameType = 0;
						}
						
						$data['typeName'] = $typeId;
						if($samasyephalitansa_sreni['phalaphala'] == 'perte'){
							$state = 0;
						}
						else if($samasyephalitansa_sreni['phalaphala'] == 'gagner'){
							$state = 1;
						}
						$data['state'] = $state;
						
						$data['premium'] = $samasyephalitansa_sreni['zufallig'];																		
						
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
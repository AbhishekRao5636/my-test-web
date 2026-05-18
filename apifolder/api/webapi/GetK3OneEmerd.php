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
		if (isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp']) && isset($shonupost['typeId'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$typeId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['typeId']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'","typeId":'.$typeId.'}';
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
						if($typeId == 9){
							$oedajnahb = 'gellaluhogiondu_kemeru_phalitansa';
						}
						else if($typeId == 10){
							$oedajnahb = 'gellaluhogiondu_kemeru_phalitansa_drei';
						}
						else if($typeId == 11){
							$oedajnahb = 'gellaluhogiondu_kemeru_phalitansa_funf';
						}
						else if($typeId == 12){
							$oedajnahb = 'gellaluhogiondu_kemeru_phalitansa_zehn';
						}
						$samasye = "SELECT kalaparichaya, phalitansa, bele
						  FROM ".$oedajnahb."
						  ORDER BY shonu DESC LIMIT 1";
						$samasyephalitansa = $conn->query($samasye);
						$salu = mysqli_fetch_array($samasyephalitansa);
						
						$data['issueNumber'] = $salu['kalaparichaya'];
						
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
						
						$checkbele = checkThreeDigitNumber($salu['bele']);
						if($checkbele['allSame']){
							$data['gameType'] = 3;
						}
						else if($checkbele['anyTwoSame']){
							$data['gameType'] = 2;
						}
						else if($checkbele['consecutive']){
							$data['gameType'] = 1;
						}
						else if($checkbele['allDifferent']){
							$data['gameType'] = 0;
						}
						
						$data['sumCount'] = (int)$salu['phalitansa'];
						$data['premium'] = $salu['bele'];
						
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
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
		if (isset($shonupost['codeType']) && isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$codeType = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['codeType']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"codeType":'.$codeType.',"language":'.$language.',"random":"'.$random.'"}';
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
						if($codeType == -1 || $codeType == 3){
							$shonuid = $data_auth['payload']['id'];
							
							$data['codeWashAmount'] = 0;
							
							$shonuid = $data_auth['payload']['id']; 
							$samasye = "SELECT SUM(ayoga) as tot_a
							  FROM vyavahara WHERE balakedara = $shonuid
							  AND DATE(tiarikala) = DATE('".$shnunc."')
							  AND (prakara = 'LVLCOMM1')";
							$samasyephalitansa = $conn->query($samasye);
							$samasyesreni = mysqli_fetch_array($samasyephalitansa);
							$samasyesreni['tot_a'] == null ? $data['dayRebate'] = 0 : $data['dayRebate'] = (float)number_format($samasyesreni['tot_a'],2);
							
							$samasye = "SELECT SUM(ayoga) as tot_a
							  FROM vyavahara WHERE balakedara = $shonuid
							  AND (prakara = 'LVLCOMM1')";
							$samasyephalitansa = $conn->query($samasye);
							$samasyesreni = mysqli_fetch_array($samasyephalitansa);
							$samasyesreni['tot_a'] == null ? $data['totalRebate'] = 0 : $data['totalRebate'] = (float)number_format($samasyesreni['tot_a'],2);
							
							$data['washRate'] = 0.85;
							
							$samasye = "SELECT ketebida, ayoga
							  FROM vyavahara WHERE balakedara = $shonuid
							  AND (prakara = 'LVLCOMM1') ORDER BY shonu DESC LIMIT 3";
							$samasyephalitansa = $conn->query($samasye);
							$ablabablaba = mysqli_num_rows($samasyephalitansa);
							$kapala = 0;
							if($ablabablaba > 0){
								while($kapala < $ablabablaba){
									$kekdaman = mysqli_fetch_array($samasyephalitansa);
									$data['washList'][$kapala]['washVolume'] = (int)$kekdaman['ketebida'];
									$data['washList'][$kapala]['washRate'] = 0.85;
									$data['washList'][$kapala]['rebateAmount'] = (float)number_format($kekdaman['ayoga'],2);
									$kapala++;
								}	
							}
							else{
								$data['codeWashAmount'] = 0;
								$data['dayRebate'] = 0;
								$data['totalRebate'] = 0;
								$data['washRate'] = 0;
								$data['washList'] = null;
							}											
						}
						else{
							$data['codeWashAmount'] = 0;
							$data['dayRebate'] = 0;
							$data['totalRebate'] = 0;
							$data['washRate'] = 0;
							$data['washList'] = null;
						}
						
						$res['data'] = $data;
						$res['code'] = 0;
						$res['msg'] = 'Succeed';
						$res['msgCode'] = 0;
						http_response_code(200);
						echo json_encode($res);			
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
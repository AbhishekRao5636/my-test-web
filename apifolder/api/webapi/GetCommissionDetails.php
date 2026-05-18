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
		if (isset($shonupost['date']) && isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$date = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['date']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));		
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"date":"'.$date.'","language":'.$language.',"random":"'.$random.'"}';							
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
												
						$samasye = "SELECT DISTINCT koduvavanu
						  FROM vyavahara WHERE balakedara = $shonuid
						  AND DATE(tiarikala) = DATE('".$date."')
						  AND (prakara = 'LVLCOMM1' OR prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
						$samasyephalitansa = $conn->query($samasye);
						$samasyedhadi = mysqli_num_rows($samasyephalitansa);
						
						if($samasyedhadi == 0){
							$data = null;
						}
						else{
							$strdt = strtotime($date);
							$ydtime = $strdt + 24*60*60;
							$yddt = date("Y-m-d H-i-s", $ydtime);
							$data['settlementTime'] = $yddt;
							
							$data['children_LotteryAmount_Users'] = $samasyedhadi;
							
							$samasye = "SELECT SUM(ketebida) as tot_k, SUM(ayoga) as tot_a
							  FROM vyavahara WHERE balakedara = $shonuid
							  AND DATE(tiarikala) = DATE('".$date."')
							  AND (prakara = 'LVLCOMM1' OR prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
							$samasyephalitansa = $conn->query($samasye);
							$samasyesreni = mysqli_fetch_array($samasyephalitansa);
							$samasyesreni['tot_k'] == null ? $data['children_LotteryAmount'] = 0 : $data['children_LotteryAmount'] = $samasyesreni['tot_k'];
							$samasyesreni['tot_a'] == null ? $data['rebateAmount_Last'] = 0 : $data['rebateAmount_Last'] = $samasyesreni['tot_a'];
							
							$data['time'] = $date;
							
							//Add Rest of data
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
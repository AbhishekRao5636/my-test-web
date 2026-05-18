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
			$endDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['endDate']));
			$startDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['startDate']));
			$shonustr = '{"endDate":"'.$endDate.'","language":'.$language.',"random":"'.$random.'","startDate":"'.$startDate.'"}';
			
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
						$samasye = "SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 1 as gameType
									FROM bajikattuttate WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 2 as gameType
									FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 3 as gameType
									FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 4 as gameType
									FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 5 as gameType
									FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 6 as gameType
									FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 7 as gameType
									FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 8 as gameType
									FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 9 as gameType
									FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 10 as gameType
									FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 11 as gameType
									FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									UNION ALL
									SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala, 12 as gameType
									FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) >= date('".$startDate."') AND date(tiarikala) <= date('".$endDate."')
									ORDER BY parichaya DESC";
									
						$samasyephalitansa = $conn->query($samasye);
						$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa);
						
						if ($samasyephalitansa->num_rows > 0) {
							$i = 0;
							while ($row = $samasyephalitansa->fetch_assoc()) {
								$data['gameStatis'][$i]['gameType'] = $row['gameType'];
								if($row['gameType'] == 1 || $row['gameType'] == 4 || $row['gameType'] == 7 || $row['gameType'] == 10){
									$data['gameStatis'][$i]['gameTypeName'] = 'lottery';
								}
								else if($row['gameType'] == 2 || $row['gameType'] == 5 || $row['gameType'] == 8 || $row['gameType'] == 11){
									$data['gameStatis'][$i]['gameTypeName'] = 'lottery';
								}
								else if($row['gameType'] == 3 || $row['gameType'] == 6 || $row['gameType'] == 9 || $row['gameType'] == 12){
									$data['gameStatis'][$i]['gameTypeName'] = 'lottery';
								}
								$data['gameStatis'][$i]['betAmount'] = $row['ketebida'];
								$fnbetamt = $fnbetamt + $row['ketebida'];
								$data['gameStatis'][$i]['betCount'] = 1;
								$data['gameStatis'][$i]['betWinLossAmount'] = $row['sesabida'];
							$i++;
							}
							$data['sumBetAmount'] = $fnbetamt;
						}
						else{
							$data['gameStatis'] = [];
							$data['sumBetAmount'] = 0;
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
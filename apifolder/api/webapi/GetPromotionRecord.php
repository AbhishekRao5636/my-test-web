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
		if (isset($shonupost['endDate']) && isset($shonupost['language']) && isset($shonupost['level']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['startDate']) && isset($shonupost['timestamp'])) {
			$endDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['endDate']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$level = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['level']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$startDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['startDate']));
			if($endDate == '' && $startDate == ''){
				$shonustr = '{"language":'.$language.',"level":'.$level.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'"}';	
			}
			else{
				$shonustr = '{"endDate":"'.$endDate.'","language":'.$language.',"level":'.$level.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'","startDate":"'.$startDate.'"}';	
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
						$samatolana = ($pageNo - 1) * 10;
						$shonuid = $data_auth['payload']['id'];
												
						$samasye = "SELECT owncode
						  FROM shonu_subjects WHERE id = $shonuid";
						$samasyephalitansa = $conn->query($samasye);
						$samasyesreni = mysqli_fetch_array($samasyephalitansa);
						$shnucode = $samasyesreni['owncode'];
						
						$samasye_ondu = "SELECT id, mobile, createdate
						  FROM shonu_subjects WHERE code = $shnucode AND DATE(createdate) >= DATE('".$startDate."') AND DATE(createdate) <= DATE('".$endDate."')
						  ORDER BY id DESC LIMIT $pageSize OFFSET $samatolana";
						$samasyephalitansa_ondu = $conn->query($samasye_ondu);
						$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);

						
						$samasye_ondu_1 = "SELECT id, mobile, createdate
						  FROM shonu_subjects WHERE code = $shnucode AND DATE(createdate) >= DATE('".$startDate."') AND DATE(createdate) <= DATE('".$endDate."')
						  ";
						$samasyephalitansa_ondu_1 = $conn->query($samasye_ondu_1);
						$samasyephalitansa_sankhye_1 = mysqli_num_rows($samasyephalitansa_ondu_1);
						
						if ($samasyephalitansa_ondu->num_rows > 0) {
							$i = 0;
							while ($row = $samasyephalitansa_ondu->fetch_assoc()) {
								$data['list'][$i]['bindUserID'] = $row['id'];
								
								$firstPart = substr($row['mobile'], 0, 3);
								$middlePart = substr($row['mobile'], 3, 4);
								$lastPart = substr($row['mobile'], 7, 4);
								$middlePart = str_repeat('*', strlen($middlePart));
								$maskedMobile = $firstPart . $middlePart . $lastPart;
								
								$data['list'][$i]['bindUserName'] = $maskedMobile;
								$data['list'][$i]['bindTime'] = $row['createdate'];
								$data['list'][$i]['bindInviteCode'] = $shnucode;
								$i++;
							}
							$data['pageNo'] = (int)$pageNo;
							$data['totalPage'] = ceil($samasyephalitansa_sankhye_1/10);
							$data['totalCount'] = $samasyephalitansa_sankhye_1;							
						}
						else{
							$data['list'] = [];
							$data['pageNo'] = (int)$pageNo;
							$data['totalPage'] = 0;
							$data['totalCount'] = 0;
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
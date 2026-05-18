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
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));
			$shonustr = '{"language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'"}';
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
						$samasye = "SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid
						  UNION ALL
						  SELECT parichaya, ketebida, tiarikala
						  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid
						  ORDER BY parichaya DESC LIMIT $pageSize OFFSET $samatolana";
						$samasyephalitansa = $conn->query($samasye);
						
						if ($samasyephalitansa->num_rows > 0) {
							$i = 0;
							while ($row = $samasyephalitansa->fetch_assoc()) {
								$data['list'][$i]['orderNo'] = 'VIP2024070506105405944';
								$data['list'][$i]['type'] = 6;
								$data['list'][$i]['typeStr'] = '经验奖励';
								$data['list'][$i]['awardAmount'] = 0;
								$data['list'][$i]['bonusPoints'] = 0;
								$data['list'][$i]['experience'] = $row['ketebida'];
								$data['list'][$i]['remark'] = '投注EXP';
								$data['list'][$i]['createTime'] = $row['tiarikala'];
								$i++;
							}
						}
						else{
							$data['list'] = [];
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
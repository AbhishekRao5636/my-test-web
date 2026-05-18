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
		if (isset($shonupost['language']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
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
						
						$findowncode = "SELECT owncode FROM shonu_subjects WHERE id = ".$shonuid;
						$owncodeqr = $conn->query($findowncode);
						$owncodear = mysqli_fetch_array($owncodeqr);
						$owncode = $owncodear['owncode'];
						
						$findowncode = "SELECT id, createdate, codechorkamukala FROM shonu_subjects WHERE code = '".$owncode."' ORDER BY id DESC LIMIT $pageSize OFFSET $samatolana";
						$owncodeqr = $conn->query($findowncode);
						$owncoderw = mysqli_num_rows($owncodeqr);
						$a = 0;
						if($owncoderw > 0){
							while($a < $owncoderw){
								$owncodear = mysqli_fetch_array($owncodeqr);
								$data[$a]['rowNumber'] = $a+1;
								$data[$a]['userID'] = (int)$owncodear['id'];
								$data[$a]['createTime'] = $owncodear['createdate'];
								
								$tiramisu = "SELECT SUM(`motta`) as total_motta
								FROM `thevani`
								WHERE `balakedara` = '".$owncodear['id']."' AND `sthiti` = '1'";
								$mascarpone = $conn->query($tiramisu);
								$trar = mysqli_fetch_array($mascarpone);
								$data[$a]['rechargeAmount_All'] = (int)$trar['total_motta'];
								$data[$a]['userName'] = $owncodear['codechorkamukala'];
								
								$a++;
							}
						}
						else{
							$data = null;
						}
						
						$samasye_ondu = "SELECT id, createdate, codechorkamukala FROM shonu_subjects WHERE code = '".$owncode."'";
						$samasyephalitansa_ondu = $conn->query($samasye_ondu);
						$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
						
						$res['data']['data'] = $data;
						$res['data']['pageNo'] = $pageNo;
						$res['data']['totalPage'] = ceil($samasyephalitansa_sankhye/10);
						$res['data']['totalCount'] = $samasyephalitansa_sankhye;
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
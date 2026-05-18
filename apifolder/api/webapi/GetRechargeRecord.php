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
		if (isset($shonupost['endDate']) && isset($shonupost['language']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) && isset($shonupost['payId']) && isset($shonupost['payTypeId']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['startDate']) && isset($shonupost['state']) && isset($shonupost['timestamp'])) {
			$endDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['endDate']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));
			$payId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['payId']));
			$payTypeId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['payTypeId']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$startDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['startDate']));
			$state = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['state']));
			if($endDate == '' && $startDate == ''){
				$shonustr = '{"language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"payId":'.$payId.',"payTypeId":'.$payTypeId.',"random":"'.$random.'","state":'.$state.'}';	
			}
			else{
				$shonustr = '{"endDate":"'.$endDate.'","language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"payId":'.$payId.',"payTypeId":'.$payTypeId.',"random":"'.$random.'","startDate":"'.$startDate.'","state":'.$state.'}';	
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
						
						if($endDate == '' && $startDate == ''){
							if($state == -1){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($state == 0){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($state == 1){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($state == 2){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
						}
						else{
							if($state == -1){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($state == 0){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($state == 1){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($state == 2){
								$samasye = "SELECT dharavahi, dinankavannuracisi, madari, motta, sthiti, pavatiaidi, mula
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = $state AND date(dinankavannuracisi) >= date('".$startDate."') AND date(dinankavannuracisi) <= date('".$endDate."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
						}						
						
						if ($samasyephalitansa->num_rows > 0) {
							$i = 0;
							while ($row = $samasyephalitansa->fetch_assoc()) {
								$data['list'][$i]['rechargeNumber'] = $row['dharavahi'];
								$data['list'][$i]['addTime'] = $row['dinankavannuracisi'];
								$data['list'][$i]['type'] = (int)$row['madari'];
								$data['list'][$i]['price'] = $row['motta'];
								$data['list'][$i]['state'] = (int)$row['sthiti'];
								$data['list'][$i]['uRate'] = null;
								$data['list'][$i]['uGold'] = 0;
								$data['list'][$i]['payID'] = (int)$row['pavatiaidi'];
								$data['list'][$i]['payName'] = $row['mula'];
								$i++;
							}
							$data['pageNo'] = (int)$pageNo;
							$data['totalPage'] = ceil($samasyephalitansa_sankhye/10);
							$data['totalCount'] = $samasyephalitansa_sankhye;							
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
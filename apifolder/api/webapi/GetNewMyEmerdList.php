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
		if (isset($shonupost['endDate']) && isset($shonupost['gameType']) && isset($shonupost['language']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['startDate']) && isset($shonupost['timestamp']) && isset($shonupost['type'])) {
			$endDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['endDate']));
			$gameType = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['gameType']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$startDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['startDate']));
			$type = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['type']));
			if($endDate == '' && $startDate == ''){
				$shonustr = '{"gameType":"'.$gameType.'","language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'","type":'.$type.'}';	
			}
			else{
				$shonustr = '{"endDate":"'.$endDate.'","gameType":"'.$gameType.'","language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'","startDate":"'.$startDate.'","type":'.$type.'}';	
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
							if ($gameType == '1') {
    // Combine data from multiple tables using UNION, adding game_id for each table
    $samasye = "SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 3 AS game_id
                FROM bajikattuttate_drei
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 5 AS game_id
                FROM bajikattuttate_funf
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 1 AS game_id
                FROM bajikattuttate
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 30 AS game_id
                FROM bajikattuttate_zehn
                WHERE byabaharkarta = $shonuid
                ORDER BY parichaya DESC
                LIMIT $pageSize OFFSET $samatolana";
    
    $samasyephalitansa = $conn->query($samasye);

    // Count total rows across multiple tables with game_id
    $samasye_ondu = "SELECT COUNT(*) as total_count
                     FROM (
                        SELECT parichaya, 3 AS game_id
                        FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid
                        UNION ALL
                        SELECT parichaya, 5 AS game_id
                        FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid
                        UNION ALL
                        SELECT parichaya, 4 AS game_id
                        FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid
                        UNION ALL
                        SELECT parichaya, 1 AS game_id
                        FROM bajikattuttate WHERE byabaharkarta = $shonuid
                     ) AS total_combined";
    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = $samasyephalitansa_ondu->fetch_assoc()['total_count'];
}
                          
                              if ($gameType == '13') {
    // Combine data from multiple tables using UNION, adding game_id for each table
    $samasye = "SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 13 AS game_id
                FROM bajikattuttate_trx
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 14 AS game_id
                FROM bajikattuttate_trx3
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 15 AS game_id
                FROM bajikattuttate_trx5
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 16 AS game_id
                FROM bajikattuttate_trx10
                WHERE byabaharkarta = $shonuid
                ORDER BY parichaya DESC
                LIMIT $pageSize OFFSET $samatolana";
    
    $samasyephalitansa = $conn->query($samasye);

    // Count total rows across multiple tables with game_id
    $samasye_ondu = "SELECT COUNT(*) as total_count
                     FROM (
                        SELECT parichaya, 13 AS game_id
                        FROM bajikattuttate_trx WHERE byabaharkarta = $shonuid
                        UNION ALL
                        SELECT parichaya, 14 AS game_id
                        FROM bajikattuttate_trx3 WHERE byabaharkarta = $shonuid
                        UNION ALL
                        SELECT parichaya, 15 AS game_id
                        FROM bajikattuttate_trx5 WHERE byabaharkarta = $shonuid
                        UNION ALL
                        SELECT parichaya, 16 AS game_id
                        FROM bajikattuttate_trx10 WHERE byabaharkarta = $shonuid
                     ) AS total_combined";
    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = $samasyephalitansa_ondu->fetch_assoc()['total_count'];
}
							else if ($gameType == '5') {
    // Query for GameType 5 (using multiple tables)
    $samasye = "SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 5 AS game_id
                FROM bajikattuttate_aidudi
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 6 AS game_id
                FROM bajikattuttate_aidudi_drei
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 7 AS game_id
                FROM bajikattuttate_aidudi_funf
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 8 AS game_id
                FROM bajikattuttate_aidudi_zehn
                WHERE byabaharkarta = $shonuid
                ORDER BY parichaya DESC
                LIMIT $pageSize OFFSET $samatolana";
    
    $samasyephalitansa = $conn->query($samasye);

    // Count total rows from all tables
    $samasye_ondu = "SELECT COUNT(*) AS total_count
                     FROM (
                         SELECT parichaya, 5 AS game_id
                         FROM bajikattuttate_aidudi
                         WHERE byabaharkarta = $shonuid
                         UNION ALL
                         SELECT parichaya, 6 AS game_id
                         FROM bajikattuttate_aidudi_drei
                         WHERE byabaharkarta = $shonuid
                         UNION ALL
                         SELECT parichaya, 7 AS game_id
                         FROM bajikattuttate_aidudi_funf
                         WHERE byabaharkarta = $shonuid
                         UNION ALL
                         SELECT parichaya, 8 AS game_id
                         FROM bajikattuttate_aidudi_zehn
                         WHERE byabaharkarta = $shonuid
                     ) AS total_combined";

    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = $samasyephalitansa_ondu->fetch_assoc()['total_count'];
}

						else if ($gameType == '9') {
    // Query for GameType 9 (using multiple tables)
    $samasye = "SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 9 AS game_id
                FROM bajikattuttate_kemuru
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 10 AS game_id
                FROM bajikattuttate_kemuru_drei
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 11 AS game_id
                FROM bajikattuttate_kemuru_funf
                WHERE byabaharkarta = $shonuid
                UNION ALL
                SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 12 AS game_id
                FROM bajikattuttate_kemuru_zehn
                WHERE byabaharkarta = $shonuid
                ORDER BY parichaya DESC
                LIMIT $pageSize OFFSET $samatolana";
    
    $samasyephalitansa = $conn->query($samasye);

    // Count total rows from all tables
    $samasye_ondu = "SELECT COUNT(*) AS total_count
                     FROM (
                         SELECT parichaya, 9 AS game_id
                         FROM bajikattuttate_kemuru
                         WHERE byabaharkarta = $shonuid
                         UNION ALL
                         SELECT parichaya, 10 AS game_id
                         FROM bajikattuttate_kemuru_drei
                         WHERE byabaharkarta = $shonuid
                         UNION ALL
                         SELECT parichaya, 11 AS game_id
                         FROM bajikattuttate_kemuru_funf
                         WHERE byabaharkarta = $shonuid
                         UNION ALL
                         SELECT parichaya, 12 AS game_id
                         FROM bajikattuttate_kemuru_zehn
                         WHERE byabaharkarta = $shonuid
                     ) AS total_combined";

    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = $samasyephalitansa_ondu->fetch_assoc()['total_count'];
}


						}
						else{
							if ($gameType == '1') {
    // Combine data from multiple tables using UNION, adding game_id for each table and applying date filters
    $samasye = "SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 3 AS game_id
                FROM bajikattuttate_drei
                WHERE byabaharkarta = $shonuid 
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 5 AS game_id
                FROM bajikattuttate_funf
                WHERE byabaharkarta = $shonuid
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 1 AS game_id
                FROM bajikattuttate
                WHERE byabaharkarta = $shonuid
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 30 AS game_id
                FROM bajikattuttate_zehn
                WHERE byabaharkarta = $shonuid
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                ORDER BY parichaya DESC
                LIMIT $pageSize OFFSET $samatolana";

    $samasyephalitansa = $conn->query($samasye);

    // Count total rows across multiple tables with game_id and date filters
    $samasye_ondu = "SELECT COUNT(*) as total_count
                     FROM (
                        SELECT parichaya, 3 AS game_id
                        FROM bajikattuttate_drei 
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                        UNION ALL
                        SELECT parichaya, 5 AS game_id
                        FROM bajikattuttate_funf 
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                        UNION ALL
                        SELECT parichaya, 4 AS game_id
                        FROM bajikattuttate_zehn 
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                        UNION ALL
                        SELECT parichaya, 1 AS game_id
                        FROM bajikattuttate 
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                     ) AS total_combined";

    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = $samasyephalitansa_ondu->fetch_assoc()['total_count'];
}                        
                           if ($gameType == '13') {
    // Combine data from multiple tables using UNION, adding game_id for each table and applying date filters
    $samasye = "SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 13 AS game_id
                FROM bajikattuttate_trx
                WHERE byabaharkarta = $shonuid 
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 14 AS game_id
                FROM bajikattuttate_trx3
                WHERE byabaharkarta = $shonuid
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 15 AS game_id
                FROM bajikattuttate_trx5
                WHERE byabaharkarta = $shonuid
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                UNION ALL
                SELECT parichaya, kalaparichaya, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala, 16 AS game_id
                FROM bajikattuttate_trx10
                WHERE byabaharkarta = $shonuid
                  AND date(tiarikala) >= date('".$startDate."') 
                  AND date(tiarikala) <= date('".$endDate."')
                ORDER BY parichaya DESC
                LIMIT $pageSize OFFSET $samatolana";

    $samasyephalitansa = $conn->query($samasye);

    // Count total rows across multiple tables with game_id and date filters
    $samasye_ondu = "SELECT COUNT(*) as total_count
                     FROM (
                        SELECT parichaya, 13 AS game_id
                        FROM bajikattuttate_trx 
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                        UNION ALL
                        SELECT parichaya, 14 AS game_id
                        FROM bajikattuttate_trx3
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                        UNION ALL
                        SELECT parichaya, 15 AS game_id
                        FROM bajikattuttate_trx5 
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                        UNION ALL
                        SELECT parichaya, 16 AS game_id
                        FROM bajikattuttate_trx10 
                        WHERE byabaharkarta = $shonuid
                          AND date(tiarikala) >= date('".$startDate."') 
                          AND date(tiarikala) <= date('".$endDate."')
                     ) AS total_combined";

    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = $samasyephalitansa_ondu->fetch_assoc()['total_count'];
}

							else if ($gameType == '5') {
    $samasye = "SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala
                FROM bajikattuttate_aidudi
                WHERE byabaharkarta = $shonuid 
                  AND DATE(tiarikala) >= DATE('$startDate') 
                  AND DATE(tiarikala) <= DATE('$endDate')
                ORDER BY parichaya DESC 
                LIMIT $pageSize OFFSET $samatolana";
    $samasyephalitansa = $conn->query($samasye);

    $samasye_ondu = "SELECT parichaya
                     FROM bajikattuttate_aidudi
                     WHERE byabaharkarta = $shonuid 
                       AND DATE(tiarikala) >= DATE('$startDate') 
                       AND DATE(tiarikala) <= DATE('$endDate')";
    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
}
else if ($gameType == '9') {
    $samasye = "SELECT parichaya, kalaparichaya, prakar, ojana, menge, wettanzahl, ketebida, phalaphala, sesabida, ergebnis, zufallig, tiarikala
                FROM bajikattuttate_kemuru
                WHERE byabaharkarta = $shonuid 
                  AND DATE(tiarikala) >= DATE('$startDate') 
                  AND DATE(tiarikala) <= DATE('$endDate')
                ORDER BY parichaya DESC 
                LIMIT $pageSize OFFSET $samatolana";
    $samasyephalitansa = $conn->query($samasye);

    $samasye_ondu = "SELECT parichaya
                     FROM bajikattuttate_kemuru
                     WHERE byabaharkarta = $shonuid 
                       AND DATE(tiarikala) >= DATE('$startDate') 
                       AND DATE(tiarikala) <= DATE('$endDate')";
    $samasyephalitansa_ondu = $conn->query($samasye_ondu);
    $samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
}

						}						
						
						if ($samasyephalitansa->num_rows > 0) {
							$i = 0;
							while ($row = $samasyephalitansa->fetch_assoc()) {
								$data['list'][$i]['betID'] = null;
								$data['list'][$i]['orderNumber'] = $row['parichaya'];
								$data['list'][$i]['userID'] = null;
								$data['list'][$i]['issueNumber'] = $row['kalaparichaya'];
								$data['list'][$i]['typeID'] = (int)$row['game_id'];
								$data['list'][$i]['amount'] = (int)$row['menge'];
								$data['list'][$i]['betCount'] = (int)$row['wettanzahl'];
								$data['list'][$i]['gameType'] = (int)$row['prakar'];
								if($gameType == '1'){
									if($row['ojana'] == 10){
										$ojana = 'red';
									}
									else if($row['ojana'] == 11){
										$ojana = 'green';
									}
									else if($row['ojana'] == 12){
										$ojana = 'violet';
									}
									else if($row['ojana'] == 13){
										$ojana = 'big';
									}
									else if($row['ojana'] == 14){
										$ojana = 'small';
									}
									else{
										$ojana = $row['ojana'];
									}
									$data['list'][$i]['selectType'] = $ojana;
								}
								else{
									$data['list'][$i]['selectType'] = $row['ojana'];
								}								
								$data['list'][$i]['realAmount'] = (float)$row['ketebida'] - ($row['ketebida']*2/100);
								$data['list'][$i]['serviceCharge'] = (float)($row['ketebida']*2/100);
								$data['list'][$i]['figure'] = (int)$row['ketebida'];
								if($row['phalaphala'] == 'gagner'){
									$data['list'][$i]['state'] = 1;
									$data['list'][$i]['profitAmount'] = (int)($row['sesabida'] - $row['ketebida']);
									$data['list'][$i]['winAmount'] = (int)($row['sesabida']);
								}
								else{
									$data['list'][$i]['state'] = 0;
									$data['list'][$i]['profitAmount'] = null;
									$data['list'][$i]['winAmount'] = 0;
								}
								$data['list'][$i]['addTime'] = $row['tiarikala'];
								$data['list'][$i]['settlementTime'] = null;
								$data['list'][$i]['fee'] = (float)($row['ketebida']*2/100);
								$data['list'][$i]['premium'] = $row['zufallig'];
								if($gameType == '1'){
									$data['list'][$i]['number'] = $row['ergebnis'];
									$data['list'][$i]['colour'] = ($row['ergebnis']/2 == 0 ? 'red' : 'green');
								}
								else{
									$data['list'][$i]['sumCount'] = $row['ergebnis'];
								}								
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
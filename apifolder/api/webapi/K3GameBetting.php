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
		if (isset($shonupost['amount']) && isset($shonupost['betCount']) && isset($shonupost['gameType']) && isset($shonupost['issuenumber']) && 
			isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['selectType']) && isset($shonupost['signature']) && 
			isset($shonupost['timestamp']) && isset($shonupost['typeId'])) {
			$amount = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['amount']));
			$betCount = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['betCount']));
			$gameType = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['gameType']));
			$issuenumber = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['issuenumber']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$selectType = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['selectType']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$typeId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['typeId']));
			$shonustr = '{"amount":'.$amount.',"betCount":'.$betCount.',"gameType":"'.$gameType.'","issuenumber":"'.$issuenumber.'","language":'.$language.',"random":"'.$random.'","selectType":"'.$selectType.'","typeId":'.$typeId.'}';
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
							$oedajnahb = 'gelluonduhogu_kemuru';
							$mothermary = 'bajikattuttate_kemuru';
						}
						else if($typeId == 10){
							$oedajnahb = 'gelluonduhogu_kemuru_drei';
							$mothermary = 'bajikattuttate_kemuru_drei';
						}
						else if($typeId == 11){
							$oedajnahb = 'gelluonduhogu_kemuru_funf';
							$mothermary = 'bajikattuttate_kemuru_funf';
						}
						else if($typeId == 12){
							$oedajnahb = 'gelluonduhogu_kemuru_zehn';
							$mothermary = 'bajikattuttate_kemuru_zehn';
						}
						if($betCount >= 1){
							if($amount >= 1){
								$samasye = "SELECT atadaaidi
								  FROM ".$oedajnahb."
								  ORDER BY kramasankhye DESC LIMIT 1";
								$samasyephalitansa=$conn->query($samasye);
								$samasyesreni = mysqli_fetch_array($samasyephalitansa);
								if($samasyesreni['atadaaidi'] == $issuenumber){
									$gtplode = explode(",",$gameType);
									$gtcnt = count($gtplode);
									if($gtcnt == 1){
										if($gameType == '1' || $gameType == '2' || $gameType == '3' || $gameType == '6' || $gameType == '7' || $gameType == '8' || $gameType == '10'){
											$stplode = explode(",",$selectType);
											$stcnt = count($stplode);
											$totalamount = $amount * $betCount * $stcnt;
										}
										else if($gameType == '4'){
											$stplode = explode(",",$selectType);
											$stcnt = count($stplode);
											if($stcnt == 3){
												$totalamount = $amount * $betCount * 3;
											}
											else if($stcnt == 4){
												$totalamount = $amount * $betCount * 6;
											}
											else if($stcnt == 5){
												$totalamount = $amount * $betCount * 10;
											}
											else if($stcnt == 6){
												$totalamount = $amount * $betCount * 15;
											}
											else{
												$totalamount = $amount * $betCount;
											}
										}
										else if($gameType == '5'){
											$stplode = explode(",",$selectType);
											$stcnt = count($stplode) - 1;
											$totalamount = $amount * $betCount * $stcnt;
											function countSingleDigits(array $arr): int
											{
											  $count = 0;
											  foreach ($arr as $item) {
												if (is_string($item) && strlen($item) === 3 && $item[0] === ':' && is_numeric($item[1]) && $item[1] >= 0 && $item[1] <= 9 && $item[2] === ':') {
												  $count++;
												}
											  }
											  return $count;
											}
											$singleDigitCount = countSingleDigits($stplode);
											if($singleDigitCount > 1){
												$totalamount = ($amount * $betCount * (count($stplode)-$singleDigitCount))*$singleDigitCount;
											}
										}
										else if($gameType == '9'){
											$stplode = explode(",",$selectType);
											$stcnt = count($stplode);
											if($stcnt == 4){
												$totalamount = $amount * $betCount * 4;
											}
											else if($stcnt == 5){
												$totalamount = $amount * $betCount * 10;
											}
											else if($stcnt == 6){
												$totalamount = $amount * $betCount * 20;
											}
											else{
												$totalamount = $amount * $betCount;
											}
										}
										else{
											$stplode = explode(",",$selectType);
											$stcnt = count($stplode);
											$totalamount = $amount * $betCount * $stcnt;
										}
									}
									else{
										if($gameType == '5,6'){
											$fsboom = explode(":,|",$selectType);
											$part2 = $fsboom[0];
											$part1 = $fsboom[1];
											$stplode1 = explode(",",$part1);
											$stcnt1 = count($stplode1);
											$totalamount1 = $amount * $betCount * $stcnt1;
											$stplode2 = explode(",",$part2);
											$stcnt2 = count($stplode2) - 1;
											$totalamount2 = $amount * $betCount * $stcnt2;
											function countSingleDigits(array $arr): int
											{
											  $count = 0;
											  foreach ($arr as $item) {
												if (is_string($item) && strlen($item) === 3 && $item[0] === ':' && is_numeric($item[1]) && $item[1] >= 0 && $item[1] <= 9 && $item[2] === ':') {
												  $count++;
												}
											  }
											  return $count;
											}
											$singleDigitCount = countSingleDigits($stplode2)+1;
											if($singleDigitCount > 1){
												$totalamount2 = ($amount * $betCount * (count($stplode2)-$singleDigitCount))*$singleDigitCount;
											}
											$totalamount = $totalamount1 + $totalamount2;
										}
										else if($gameType == '4,9'){
											$fsboom = explode(".,|",$selectType);
											$part1 = $fsboom[0];
											$part2 = $fsboom[1];
											$stplode1 = explode(",",$part1);
											$stcnt1 = count($stplode1);
											if($stcnt1 == 3){
												$totalamount1 = $amount * $betCount * 3;
											}
											else if($stcnt1 == 4){
												$totalamount1 = $amount * $betCount * 6;
											}
											else if($stcnt1 == 5){
												$totalamount1 = $amount * $betCount * 10;
											}
											else if($stcnt1 == 6){
												$totalamount1 = $amount * $betCount * 15;
											}
											else{
												$totalamount1 = $amount * $betCount;
											}
											$stplode2 = explode(",",$part2);
											$stcnt2 = count($stplode2);
											if($stcnt2 == 4){
												$totalamount2 = $amount * $betCount * 4;
											}
											else if($stcnt2 == 5){
												$totalamount2 = $amount * $betCount * 10;
											}
											else if($stcnt2 == 6){
												$totalamount2 = $amount * $betCount * 20;
											}
											else{
												$totalamount2 = $amount * $betCount;
											}
											$totalamount = $totalamount1 + $totalamount2;
										}
										else if($gameType == '4,10'){
											$fsboom = explode(".,|",$selectType);
											$part1 = $fsboom[0];
											$part2 = $fsboom[1];
											$stplode1 = explode(",",$part1);
											$stcnt1 = count($stplode1);
											if($stcnt1 == 3){
												$totalamount1 = $amount * $betCount * 3;
											}
											else if($stcnt1 == 4){
												$totalamount1 = $amount * $betCount * 6;
											}
											else if($stcnt1 == 5){
												$totalamount1 = $amount * $betCount * 10;
											}
											else if($stcnt1 == 6){
												$totalamount1 = $amount * $betCount * 15;
											}
											else{
												$totalamount1 = $amount * $betCount;
											}
											$stplode2 = explode(",",$part2);
											$stcnt2 = count($stplode2);
											if($stcnt2 == 4){
												$totalamount2 = $amount * $betCount * 4;
											}
											else if($stcnt2 == 5){
												$totalamount2 = $amount * $betCount * 10;
											}
											else if($stcnt2 == 6){
												$totalamount2 = $amount * $betCount * 20;
											}
											else{
												$totalamount2 = $amount * $betCount;
											}
											$totalamount = $totalamount1 + $totalamount2;
										}
										else if($gameType == '9,10'){
											$fsboom = explode(",",$selectType);
											$stcnt1 = count($fsboom) - 1;
											if($stcnt1 == 4){
												$totalamount1 = $amount * $betCount * 4;
											}
											else if($stcnt1 == 5){
												$totalamount1 = $amount * $betCount * 10;
											}
											else if($stcnt1 == 6){
												$totalamount1 = $amount * $betCount * 20;
											}
											else{
												$totalamount1 = $amount * $betCount;
											}
											$totalamount = $totalamount1 + ($amount * $betCount);
										}
										else if($gameType == '4,9,10'){
											$fsboom = explode(".,|",$selectType);
											$part1 = $fsboom[0];
											$part2 = $fsboom[1];
											$stplode1 = explode(",",$part1);
											$stcnt1 = count($stplode1);
											if($stcnt1 == 3){
												$totalamount1 = $amount * $betCount * 3;
											}
											else if($stcnt1 == 4){
												$totalamount1 = $amount * $betCount * 6;
											}
											else if($stcnt1 == 5){
												$totalamount1 = $amount * $betCount * 10;
											}
											else if($stcnt1 == 6){
												$totalamount1 = $amount * $betCount * 15;
											}
											else{
												$totalamount1 = $amount * $betCount;
											}
											$stplode2 = explode(",",$part2);
											$stcnt2 = count($stplode2) - 1;
											if($stcnt2 == 4){
												$totalamount2 = $amount * $betCount * 4;
											}
											else if($stcnt2 == 5){
												$totalamount2 = $amount * $betCount * 10;
											}
											else if($stcnt2 == 6){
												$totalamount2 = $amount * $betCount * 20;
											}
											else{
												$totalamount2 = $amount * $betCount;
											}
											$totalamount = $totalamount1 + $totalamount2 + ($amount * $betCount);
										}
										else{
											$stplode = explode(",",$selectType);
											$stcnt = count($stplode);
											$totalamount = $amount * $betCount * $stcnt;
										}
									}
									
									$balquery = "SELECT motta
									  FROM shonu_kaichila
									  WHERE balakedara = ".$data_auth['payload']['id'];
									$balresult = $conn->query($balquery);
									$balarr = mysqli_fetch_array($balresult);									
									$shonubalance = $balarr['motta'];								
									if($shonubalance >= $totalamount){
										$byabaharkarta = $data_auth['payload']['id'];
										$sesabida = sprintf("%.2f", $totalamount * 0.98);
										$tathya = mysqli_query($conn,"INSERT INTO `".$mothermary."` (`byabaharkarta`,`kalaparichaya`,`prakar`,`ojana`,`menge`,`wettanzahl`,`ketebida`,`phalaphala`,`sesabida`,`tiarikala`) VALUES ('".$byabaharkarta."','".$issuenumber."','".$gameType."','".$selectType."','".$amount."','".$betCount."','".$totalamount."','perte','".$sesabida."','".$shnunc."')");
										$mottanutan = $shonubalance - $totalamount;
										$nabikarana = "UPDATE shonu_kaichila set motta='$mottanutan' where balakedara='$byabaharkarta'";
										$conn->query($nabikarana);
										include "commission.php";
										include "vip.php";
										//$res['data'] = $data;
										$res['data'] = null;
										$res['code'] = 0;
										$res['msg'] = 'Succeed';
										$res['msgCode'] = 0;
										http_response_code(200);
										echo json_encode($res);	
									}
									else{
										$res['code'] = 1;
										$res['msg'] = 'Balance is not enough';
										$res['msgCode'] = 142;
										http_response_code(200);
										echo json_encode($res);	
									}
								}
								else{
									$res['code'] = 1;
									$res['msg'] = 'The current period is settled';
									$res['msgCode'] = 404;
									http_response_code(200);
									echo json_encode($res);
								}																																				
							}
							else{
								$res['code'] = 7;
								$res['msg'] = "Invalid value for parameter 'Amount'";
								unset($res['msgCode']);
								unset($res['serviceNowTime']);
								http_response_code(200);
								echo json_encode($res);
							}
						}
						else{
							$res['code'] = 7;
							$res['msg'] = "Invalid value for parameter 'BetCount'";
							unset($res['msgCode']);
							unset($res['serviceNowTime']);
							http_response_code(200);
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
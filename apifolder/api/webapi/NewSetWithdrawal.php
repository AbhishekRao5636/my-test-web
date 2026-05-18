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
		if (isset($shonupost['amount']) && isset($shonupost['bid']) && isset($shonupost['language']) && isset($shonupost['pwd']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp']) && isset($shonupost['type'])) {
			$amount = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['amount']));
			$bid = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['bid']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));			
			$pwd = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pwd']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$type = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['type']));
			if($pwd == ''){
				$shonustr = '{"amount":'.$amount.',"bid":"'.$bid.'","language":'.$language.',"random":"'.$random.'","type":'.$type.'}';	
			}
			else if($type == 3){
				$shonustr = '{"amount":'.$amount.',"bid":"'.$bid.'","language":'.$language.',"pwd":"'.$pwd.'","random":"'.$random.'","type":'.$type.'}';
			}
			else{
				$shonustr = '{"amount":'.$amount.',"bid":"'.$bid.'","language":'.$language.',"pwd":"'.$pwd.'","random":"'.$random.'","type":'.$type.'}';	
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
						if($amount >= 110 && $amount <= 50000){
							$shonuid = $data_auth['payload']['id'];
							$shonusql="Select password from shonu_subjects where id='$shonuid'";
							$shonuresult=$conn->query($shonusql);
							$shonurow = mysqli_fetch_array($shonuresult);
							$password = $shonurow['password'];
							if($password == md5($pwd)){
								$balquery = "SELECT motta
								  FROM shonu_kaichila
								  WHERE balakedara = ".$data_auth['payload']['id'];
								$balresult = $conn->query($balquery);
								$balarr = mysqli_fetch_array($balresult);
								if($amount <= $balarr['motta']){
									$mottanutan = $balarr['motta'] - $amount;
									$nabikarana = "UPDATE shonu_kaichila set motta='$mottanutan' where balakedara='$shonuid'";
									$conn->query($nabikarana);
									$date = date("Ymd");
									$time = time();
									$serial = 'W' . $date . $time . rand(1000,9999);
									$tathya = mysqli_query($conn,"INSERT INTO `hintegedukolli` (`balakedara`,`motta`,`dharavahi`,`khateshonu`,`dinankavannuracisi`,`madari`,`tike`,`sthiti`) VALUES ('".$shonuid."','".$amount."','".$serial."','".$bid."','".$shnunc."','".$type."','Applied','0')");
									
									$res['data'] = $data;
									$res['code'] = 0;
									$res['msg'] = 'Succeed';
									$res['msgCode'] = 0;
									http_response_code(200);
									echo json_encode($res);	
								}
								else{
									$res['code'] = 1;
									$res['msg'] = 'Insufficient balance';
									$res['msgCode'] = 142;
									http_response_code(200);
									echo json_encode($res);
								}																
							}
							else{
								$res['code'] = 1;
								$res['msg'] = 'Password does not correct';
								$res['msgCode'] = 119;
								http_response_code(200);
								echo json_encode($res);
							}														
						}
						else{
							$res['code'] = 1;
							$res['msg'] = 'Please request within the specified withdrawal amount range';
							$res['msgCode'] = 221;
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
	
	mysqli_close($conn);
?>
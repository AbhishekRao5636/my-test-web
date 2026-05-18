<?php 
	include "../../conn.php";
	include "../../functions2.php";
	
	header('Content-Type: application/json; charset=utf-8');
	header('Strict-Transport-Security: max-age=31536000');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, AR-REAL-IP');
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
		if (isset($shonupost['domainurl']) && isset($shonupost['invitecode']) && isset($shonupost['language']) && isset($shonupost['phonetype']) && isset($shonupost['pwd']) && isset($shonupost['random']) && isset($shonupost['registerType']) && isset($shonupost['signature']) && isset($shonupost['timestamp']) && isset($shonupost['username'])) {
			$domainurl = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['domainurl']));
			$invitecode = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['invitecode']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$phonetype = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['phonetype']));
			$pwd = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pwd']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$registerType = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['registerType']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$username = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['username']));
			$shonustr = '{"domainurl":"'.$domainurl.'","invitecode":"'.$invitecode.'","language":'.$language.',"phonetype":'.$phonetype.',"pwd":"'.$pwd.'","random":"'.$random.'","registerType":"'.$registerType.'","username":"'.$username.'"}';
			$shonusign = strtoupper(md5($shonustr));
			if(1 == 1){
				if(substr($username, 0, 2) == "91") {
					$username = substr($username, 2);
				}
				$samasye = "SELECT id
				  FROM shonu_subjects WHERE owncode = '".$invitecode."'";
				$samasyephalitansa = $conn->query($samasye);
				$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
				if($samasyephalitansa_dhadi == 1){
					$samasye = "SELECT id
					  FROM shonu_subjects WHERE mobile = $username";
					$samasyephalitansa = $conn->query($samasye);
					$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
					if($samasyephalitansa_dhadi == 0){
						$samasye = "SELECT code
						  FROM shonu_subjects WHERE owncode = '".$invitecode."'";
						$samasyephalitansa = $conn->query($samasye);
						$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
						if($samasyephalitansa_dhadi == 1){
							$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
							$code1 = $samasyephalitansa_sreni['code'];
							$samasye = "SELECT code
							  FROM shonu_subjects WHERE owncode = '".$code1."'";
							$samasyephalitansa = $conn->query($samasye);
							$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
							if($samasyephalitansa_dhadi == 1){
								$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
								$code2 = $samasyephalitansa_sreni['code'];
								$samasye = "SELECT code
								  FROM shonu_subjects WHERE owncode = '".$code2."'";
								$samasyephalitansa = $conn->query($samasye);
								$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
								if($samasyephalitansa_dhadi == 1){
									$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
									$code3 = $samasyephalitansa_sreni['code'];
									$samasye = "SELECT code
									  FROM shonu_subjects WHERE owncode = '".$code3."'";
									$samasyephalitansa = $conn->query($samasye);
									$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
									if($samasyephalitansa_dhadi == 1){
										$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
										$code4 = $samasyephalitansa_sreni['code'];
										$samasye = "SELECT code
										  FROM shonu_subjects WHERE owncode = '".$code4."'";
										$samasyephalitansa = $conn->query($samasye);
										$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
										if($samasyephalitansa_dhadi == 1){
											$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
											$code5 = $samasyephalitansa_sreni['code'];
										}
										else{
											$code5 = null;
										}
									}
									else{
										$code4 = null;
										$code5 = null;
									}
								}
								else{
									$code3 = null;
									$code4 = null;
									$code5 = null;
								}
							}
							else{
								$code2 = null;
								$code3 = null;
								$code4 = null;
								$code5 = null;
							}
						}
						else{
							$code1 = null;
							$code2 = null;
							$code3 = null;
							$code4 = null;
							$code5 = null;
						}
												
						function generateRandomNumber() {
							$codethieffu = mt_rand(100000000000, 999999999999);
							return $codethieffu;
						}
						function checkNumberExists($conn, $number) {
							$stmt = $conn->prepare("SELECT COUNT(*) FROM shonu_subjects WHERE owncode = ?");
							$stmt->bind_param("s", $number);
							$stmt->execute();
							$stmt->bind_result($count);
							$stmt->fetch();
							$stmt->close();
							return $count > 0;
						}
						do {
							$codethiefstfu = generateRandomNumber();
						} while (checkNumberExists($conn, $codethiefstfu));
						$owncode = $codethiefstfu;
						
						$shnunc = date("Y-m-d H:i:s");
						$ipaddress = '';
						if (isset($_SERVER['HTTP_CLIENT_IP']))
							$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
						else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
							$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
						else if(isset($_SERVER['HTTP_X_FORWARDED']))
							$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
						else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
							$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
						else if(isset($_SERVER['HTTP_FORWARDED']))
							$ipaddress = $_SERVER['HTTP_FORWARDED'];
						else if(isset($_SERVER['REMOTE_ADDR']))
							$ipaddress = $_SERVER['REMOTE_ADDR'];
						else
							$ipaddress = 'UNKNOWN';	
						$user_agent = $_SERVER['HTTP_USER_AGENT'];
						
						function generateUniqueString($length = 8) {
							$letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
							$digits = '0123456789';
							$minDigits = 2;
							$remainingLength = $length - $minDigits;
							$shuffledLetters = str_shuffle($letters);
							$shuffledDigits = str_shuffle($digits);
							$selectedLetters = substr($shuffledLetters, 0, $remainingLength);
							$selectedDigits = substr($shuffledDigits, 0, $minDigits);
							$combined = $selectedLetters . $selectedDigits;
							$uniqueString = 'Member'.str_shuffle($combined);
							return $uniqueString;
						}
						$codechorkamukala = generateUniqueString();
						$password = md5($pwd);
						
						$tathya = mysqli_query($conn,"INSERT INTO `shonu_subjects` (`mobile`,`email`,`password`,`code`,`code1`,`code2`,`code3`,`code4`,`code5`,`owncode`,`privacy`,`status`,`createdate`,`ip`,`ishonup`,`pwd`,`shonullgnt`,`tnegaresunohs`,`codechorkamukala`) VALUES ('".$username."','','".$password."','".$invitecode."','".$code1."','".$code2."','".$code3."','".$code4."','".$code5."','".$owncode."','on','1','".$shnunc."','".$ipaddress."','".$ipaddress."','".$pwd."','".$shnunc."','".$user_agent."','".$codechorkamukala."')");
						$last_id = $conn->insert_id;
						
						$status = 1;
						$expiresIn = time() + 86400;
						$shnutkn_head = array('alg'=>'HS256','typ'=>'JWT');
						$shnutkn_load = array('id'=>$last_id,'mobile'=>$username, 'status'=>$status, 'expire'=>$expiresIn, 'ishonup'=>$ipaddress, 'codechorkamukala'=>$codechorkamukala);
						$akshinak = generate_jwt($shnutkn_head, $shnutkn_load);
						
						$pwderrsql="UPDATE shonu_subjects set akshinak='".$akshinak."' where id='$last_id'";
						$conn->query($pwderrsql);
						
						$tathya = mysqli_query($conn,"INSERT INTO `shonu_kaichila` (`balakedara`,`motta`,`dinankavannuracisi`) VALUES ('".$last_id."','20','".$shnunc."')");
						
						$notificationSql = "INSERT INTO notification (username, title, messages, notification_time, is_read) 
                                VALUES ('$username', 'New Member', 'Thank you for becoming a beloved member of this platform. We provide many industry leading games. This is the world''s leading gaming platform. Try the lottery game developed by us. While enjoying the best gaming experience, you can also join unlimited agents and stay at home to earn money. " . date('Y-m-d H:i:s', time()) . "', '" . date('Y-m-d H:i:s', time()) . "', 'yes')";
                        $conn->query($notificationSql);
						
						$res['data']['tokenHeader'] = 'Bearer ';
						$res['data']['token'] = $akshinak;
						$res['code'] = 0;
						$res['msg'] = 'Succeed';
						$res['msgCode'] = 0;
						http_response_code(200);
						echo json_encode($res);	
					}
					else{
						$res['code'] = 1;
						$res['msg'] = 'Phone number have been registered';
						$res['msgCode'] = 111;
						http_response_code(200);
						echo json_encode($res);
					}			
				}
				else{
					$res['code'] = 8;
					$res['msg'] = 'Invitor Not Existed';
					$res['msgCode'] = 110;
					http_response_code(200);
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
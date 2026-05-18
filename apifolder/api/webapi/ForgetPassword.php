<?php
	include "../../conn.php";
			
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
		if (isset($shonupost['language']) && isset($shonupost['password']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['smsvcode']) && isset($shonupost['timestamp']) && isset($shonupost['type']) && isset($shonupost['username'])) {			
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$password = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['password']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$smsvcode = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['smsvcode']));
			$type = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['type']));
			$username = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['username']));
			$shonustr = '{"language":'.$language.',"password":"'.$password.'","random":"'.$random.'","smsvcode":"'.$smsvcode.'","type":"'.$type.'","username":"'.$username.'"}';
			$shonusign = strtoupper(md5($shonustr));
			if($shonusign == $signature){
				if(substr($username, 0, 2) == "91") {
					$mobile = substr($username, 2);
				}
				else{
					$mobile = $username;
				}
				
				$samasye = "SELECT id
				  FROM shonu_subjects WHERE mobile = $mobile";
				$samasyephalitansa = $conn->query($samasye);
				$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
				
				if($samasyephalitansa_dhadi == 1){
					$samasye = "SELECT otp
					  FROM otp_record WHERE mobile = $mobile AND type = 'Reset PSWD' ORDER BY id DESC LIMIT 1";
					$samasyephalitansa = $conn->query($samasye);
					$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);
					if($samasyephalitansa_dhadi == 1){
						$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);
						$otp = $samasyephalitansa_sreni['otp'];
						if($otp == $smsvcode){
							$md5_password = md5($password);
							$pwderrsql="UPDATE shonu_subjects set password='".$md5_password."', pwd='".$password."' where mobile = '$mobile'";
							$conn->query($pwderrsql);
							
							$res['code'] = 0;
							$res['msg'] = 'Succeed';
							$res['msgCode'] = 0;
							http_response_code(200);
							echo json_encode($res);	
						}
						else{
							$res['code'] = 1;
							$res['msg'] = 'Verification code error';
							$res['msgCode'] = 107;
							http_response_code(200);
							echo json_encode($res);
						}
					}
					else{
						$res['code'] = 1;
						$res['msg'] = 'SMS reset password is not available';
						$res['msgCode'] = 173;
						http_response_code(200);
						echo json_encode($res);
					}
				}
				else{
					$res['code'] = 1;
					$res['msg'] = 'User does not exist';
					$res['msgCode'] = 101;
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
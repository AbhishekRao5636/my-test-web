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
		if (isset($shonupost['language']) && isset($shonupost['logintype']) && isset($shonupost['phonetype']) && isset($shonupost['pwd'])
			&& isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp']) && isset($shonupost['username'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$logintype = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['logintype']));
			$phonetype = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['phonetype']));
			$pwd = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pwd']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$username = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['username']));
			$shonustr = '{"language":'.$language.',"logintype":"'.$logintype.'","phonetype":'.$phonetype.',"pwd":"'.$pwd.'","random":"'.$random.'","username":"'.$username.'"}';
			$shonusign = strtoupper(md5($shonustr));
			if($shonusign == $signature){
				if(substr($username, 0, 2) == "91") {
					$username = substr($username, 2);
				}
						
				if($logintype == 'mobile'){
					$shonusql="Select id, password, status, ishonup, codechorkamukala from shonu_subjects where mobile='$username'";
				}
				else if($logintype == 'email'){
					$shonusql="Select id, password, status, ishonup, codechorkamukala from shonu_subjects where email='$username'";
				}
				else{
					$shonusql="Select id, password, status, ishonup, codechorkamukala from shonu_subjects where mobile='$username'";
				}
				$shonuresult=$conn->query($shonusql);
				$shonunum = mysqli_num_rows($shonuresult);
				if($shonunum == 1){
					$shonurow = mysqli_fetch_array($shonuresult);
					$password = $shonurow['password'];
					if($password == md5($pwd)){
						if($shonurow['status'] == 1){
							$data['expiresIn'] = time() + 86400;
							$shnutkn_head = array('alg'=>'HS256','typ'=>'JWT');
							$shnutkn_load = array('id'=>$shonurow['id'],'mobile'=>$username, 'status'=>$shonurow['status'], 'expire'=>$data['expiresIn'], 'ishonup'=>$shonurow['ishonup'], 'codechorkamukala'=>$shonurow['codechorkamukala']);
							$data['tokenHeader'] = 'Bearer ';
							$data['token'] = generate_jwt($shnutkn_head, $shnutkn_load);							
							$shnutkn_head_rfsh = array('alg'=>'HS256','typ'=>'JWT');
							$shnutkn_load_rfsh = array('id'=>$shonurow['id'],'mobile'=>$username, 'status'=>$shonurow['status'], 'expire'=>$data['expiresIn']);
							$data['refreshToken'] = generate_jwt($shnutkn_head_rfsh, $shnutkn_load_rfsh);
							$data['passwordErrorNum'] = 0;
							$data['passwordErrorMaxNum'] = 30;
							
							//shonullgnt - last login time ishonup - last login ip no multiple login
							//ar-real-ip doesn't match last login ip
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
							
							$pwderrsql="UPDATE shonu_subjects set shonupwderr=0, ishonup='$ipaddress', shonullgnt='$shnunc', akshinak='".$data['token']."', tnegaresunohs='$user_agent' where mobile='$username'";
							$conn->query($pwderrsql);
							
							$idQuery = "SELECT id FROM shonu_subjects WHERE mobile = '$username'";
                            $idResult = $conn->query($idQuery);

                                if ($idResult && $idResult->num_rows > 0) {
                            $row = $idResult->fetch_assoc();
                            $id = $row['id'];
                            $title = "Login Notification";
                            $state = 0;
                            $insertNotificationQuery = "INSERT INTO notification (state, title, user_id, created_at) VALUES ($state, '$title', $id, '$shnunc')";
                            $insertNotificationQuery = "INSERT INTO notification (state, title, user_id, created_at) VALUES ($state, '$title', $id, '$shnunc')";
    
                            $conn->query($insertNotificationQuery);
                             }


							
							$res['data'] = $data;
							$res['code'] = 0;
							$res['msg'] = 'Succeed';
							$res['msgCode'] = 0;
							http_response_code(200);
							echo json_encode($res);
						}
						else{
							$res['data'] = null;
							$res['code'] = 1;
							$res['msg'] = 'User suspended';
							$res['msgCode'] = 116;
							http_response_code(200);
							echo json_encode($res);
						}						
					}
					else{
						$pwderrsql="UPDATE shonu_subjects set shonupwderr=shonupwderr+1 where mobile='$username'";
						$conn->query($pwderrsql);
						$pwderr="Select shonupwderr from shonu_subjects where mobile='$username'";
						$pwderrresult=$conn->query($pwderr);
						$pwderrrow = mysqli_fetch_array($pwderrresult);
						$pwderrvalue = $pwderrrow['shonupwderr'];
						
						$data['tokenHeader'] = 'Bearer ';
						$data['token'] = null;
						$data['expiresIn'] = 0;
						$data['refreshToken'] = null;
						$data['passwordErrorNum'] = $pwderrvalue;
						$data['passwordErrorMaxNum'] = 30;
						
						$res['data'] = $data;
						$res['code'] = 1;
						$res['msg'] = 'Password does not correct';
						$res['msgCode'] = 117;
						http_response_code(200);
						echo json_encode($res);
					}										
				}
				else{
					$res['data'] = null;
					$res['code'] = 1;
					$res['msg'] = 'User not exists';
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
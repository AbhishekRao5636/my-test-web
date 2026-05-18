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
			$shonustr = '{"language":'.$language.',"random":"'.$random.'"}';	
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
						$shonuid = $data_auth['payload']['id'];
						
						$recharge = mysqli_query($conn,"SELECT SUM(`motta`) as allrech FROM `thevani` WHERE `balakedara`='".$shonuid."' AND `sthiti`='1'");
						$rechargear = mysqli_fetch_array($recharge);
						$allrech = $rechargear['allrech'];
						
						$existance = mysqli_query($conn,"SELECT `dearlord` FROM `cihne` WHERE `identity`='".$shonuid."'");
						$existanceno = mysqli_num_rows($existance);
						if($existanceno == 0){
							if($allrech >= 300){
								$crdt = date("Y-m-d H:i:m");
								$sql= mysqli_query($conn,"INSERT INTO `cihne` (`identity`, `daysonearth`, `todayblessings`, `totalblessings`, `amen`) VALUES ('".$shonuid."','1','7','7','".$crdt."')");
								$data = null;
								$res['data'] = $data;
								$res['code'] = 0;
								$res['msg'] = 'Succeed';
								$res['msgCode'] = 0;
								http_response_code(200);
								echo json_encode($res);	
							}
							else{
								$data = null;
								$res['data'] = $data;
								$res['code'] = 1;
								$res['msg'] = 'The recharge amount is not up to the standard';
								$res['msgCode'] = 502;
								http_response_code(200);
								echo json_encode($res);	
							}
						}
						else if($existanceno > 0 && $existanceno < 7){
							$crdt = date("Y-m-d H:i:m");
							$existance = mysqli_query($conn,"SELECT `dearlord` FROM `cihne` WHERE `identity`='".$shonuid."' AND DATE(`amen`) = DATE('".$crdt."')");
							$existanceno = mysqli_num_rows($existance);
							if($existanceno == 0){
								$existance = mysqli_query($conn,"SELECT `dearlord`, `amen` FROM `cihne` WHERE `identity`='".$shonuid."'");
								$existanceno = mysqli_num_rows($existance);
								$daysonearth = $existanceno + 1;
								if($daysonearth == 2){
									$todayblessings = 20;
									$totalblessings = 27;
									$rechtobe = 1000;
								}
								else if($daysonearth == 3){
									$todayblessings = 100;
									$totalblessings = 127;
									$rechtobe = 3000;
								}
								else if($daysonearth == 4){
									$todayblessings = 200;
									$totalblessings = 327;
									$rechtobe = 8000;
								}
								else if($daysonearth == 5){
									$todayblessings = 450;
									$totalblessings = 777;
									$rechtobe = 20000;
								}
								else if($daysonearth == 6){
									$todayblessings = 2400;
									$totalblessings = 3177;
									$rechtobe = 80000;
								}
								else if($daysonearth == 7){
									$todayblessings = 6400;
									$totalblessings = 9577;
									$rechtobe = 200000;
								}
								
								if($allrech >= $rechtobe){
									$sql= mysqli_query($conn,"INSERT INTO `cihne` (`identity`, `daysonearth`, `todayblessings`, `totalblessings`, `amen`) VALUES ('".$shonuid."','".$daysonearth."','".$todayblessings."','".$totalblessings."','".$crdt."')");
									$data = null;
									$res['data'] = $data;
									$res['code'] = 0;
									$res['msg'] = 'Succeed';
									$res['msgCode'] = 0;
									http_response_code(200);
									echo json_encode($res);
								}
								else{
									$data = null;
									$res['data'] = $data;
									$res['code'] = 1;
									$res['msg'] = 'The recharge amount is not up to the standard';
									$res['msgCode'] = 502;
									http_response_code(200);
									echo json_encode($res);
								}								
							}
							else{
								$data = null;
								$res['data'] = $data;
								$res['code'] = 1;
								$res['msg'] = 'Received Today';
								$res['msgCode'] = 501;
								http_response_code(200);
								echo json_encode($res);	
							}
						}
						else{
							$data = null;
							$res['data'] = $data;
							$res['code'] = 1;
							$res['msg'] = 'The recharge amount is not up to the standard';
							$res['msgCode'] = 502;
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
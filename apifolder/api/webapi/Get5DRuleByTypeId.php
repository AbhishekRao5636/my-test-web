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
			$typeId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['typeId']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'","typeId":'.$typeId.'}';
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
						$data['typeID'] = $typeId;
						
						$data['gamePresentation'] = '
							<div><span style="font-size: 14px;"><font color="#ffffff">5D lottery game rules</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Draw instructions</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">5-digit number (00000-99999) will be drawn randomly in each period</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">for example：</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">The draw number for this Period is 12345</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">A=1</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">B=2</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">C=3</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">D=4</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">E=5</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">SUM=A+B+C+D+E=15</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">How to play</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Players can specify six outcomes of betting A, B, C, D, E and the sum</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">A, B, C, D, E can be purchased</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Number (0 1 2 3 4 5 6 7 8 9)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Low (0 1 2 3 4)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">High (5 6 7 8 9)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Odd (1 3 5 7 9)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Even (0 2 4 6 8)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Sum = A+B+C+D+E can be purchased</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Low (0-22)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">High (23-45)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Odd (1 3 ···43 45)</font></span></div><div><span style="font-size: 14px;"><font color="#ffffff"><br></font></span></div><div><span style="font-size: 14px;"><font color="#ffffff">Even (0 2 ···42 44)</font></span></div><p<br><p></p></p<br>
						';
						
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
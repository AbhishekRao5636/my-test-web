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
			$vipLevel = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['vipLevel']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'","vipLevel":'.$vipLevel.'}';
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
						$data[0]["\x69\x64"] = (int)"\x37\x36\x33\x37\x35";
						$data[0]["\x72\x65\x77\x61\x72\x64\x54\x79\x70\x65"] = (int)"\x31";
						$data[0]["\x69\x6e\x74\x65\x67\x72\x61\x6c"] = (int)"\x30";
						$data[0]["\x62\x61\x6c\x61\x6e\x63\x65"] = (int)"\x36\x30";
						$data[0]["\x73\x74\x61\x74\x75\x73"] = (int)"\x31";
						$data[0]["\x72\x61\x74\x65"] = (int)"\x30";
						
						$data[1]["\x69\x64"] = (int)"\x37\x36\x33\x37\x36";
						$data[1]["\x72\x65\x77\x61\x72\x64\x54\x79\x70\x65"] = (int)"\x32";
						$data[1]["\x69\x6e\x74\x65\x67\x72\x61\x6c"] = (int)"\x30";
						$data[1]["\x62\x61\x6c\x61\x6e\x63\x65"] = (int)"\x33\x30";
						$data[1]["\x73\x74\x61\x74\x75\x73"] = (int)"\x31";
						$data[1]["\x72\x61\x74\x65"] = (int)"\x30";
						
						$data[2]["\x69\x64"] = (int)"\x30";
						$data[2]["\x72\x65\x77\x61\x72\x64\x54\x79\x70\x65"] = (int)"\x33";
						$data[2]["\x69\x6e\x74\x65\x67\x72\x61\x6c"] = (int)"\x30";
						$data[2]["\x62\x61\x6c\x61\x6e\x63\x65"] = (int)"\x30";
						$data[2]["\x73\x74\x61\x74\x75\x73"] = (int)"\x30";
						$data[2]["\x72\x61\x74\x65"] = (int)"\x30";
						
						$data[3]["\x69\x64"] = (int)"\x30";
						$data[3]["\x72\x65\x77\x61\x72\x64\x54\x79\x70\x65"] = (int)"\x34";
						$data[3]["\x69\x6e\x74\x65\x67\x72\x61\x6c"] = (int)"\x30";
						$data[3]["\x62\x61\x6c\x61\x6e\x63\x65"] = (int)"\x30";
						$data[3]["\x73\x74\x61\x74\x75\x73"] = (int)"\x30";
						$data[3]["\x72\x61\x74\x65"] = (int)"\x30";
						
						$data[4]["\x69\x64"] = (int)"\x30";
						$data[4]["\x72\x65\x77\x61\x72\x64\x54\x79\x70\x65"] = (int)"\x35";
						$data[4]["\x69\x6e\x74\x65\x67\x72\x61\x6c"] = (int)"\x30";
						$data[4]["\x62\x61\x6c\x61\x6e\x63\x65"] = (int)"\x30";
						$data[4]["\x73\x74\x61\x74\x75\x73"] = (int)"\x30";
						$data[4]["\x72\x61\x74\x65"] = (float)"\x30\x2e\x30\x35";
						
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
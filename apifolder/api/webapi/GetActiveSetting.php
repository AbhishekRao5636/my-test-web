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
						$data["\x69\x73\x54\x61\x73\x6b\x53\x74\x61\x74\x65"] = "\x31";
						$data["\x69\x73\x4f\x70\x65\x6e\x4a\x61\x63\x6b\x70\x6f\x74\x52\x65\x77\x61\x72\x64"] = "\x31";
						$data["\x69\x73\x4f\x70\x65\x6e\x57\x61\x73\x68\x43\x6f\x64\x65"] = "\x31";
						$data["\x75\x6e\x4a\x61\x63\x6b\x70\x6f\x74\x43\x6f\x75\x6e\x74"] = (int)"\x30";
						$data["\x69\x73\x4f\x70\x65\x6e\x41\x63\x74\x69\x76\x69\x74\x79\x41\x77\x61\x72\x64"] = "\x30";
						$data["\x75\x6e\x57\x65\x65\x6b\x6c\x79\x41\x77\x61\x72\x64\x43\x6f\x75\x6e\x74"] = (int)"\x30";
						$data["\x69\x73\x46\x69\x6e\x69\x73\x68\x55\x73\x65\x72\x47\x75\x69\x64\x65\x6c\x69\x6e\x65\x73"] = false;
						$data["\x69\x73\x46\x69\x72\x73\x74\x55\x73\x65\x72\x44\x61\x79\x52\x65\x71\x75\x65\x73\x74"] = false;
						$data["\x69\x73\x4f\x70\x65\x6e\x43\x68\x61\x6d\x70\x69\x6f\x6e"] = "\x30";
						$data["\x6e\x65\x77\x62\x69\x65\x47\x69\x66\x74\x50\x61\x63\x6b\x43\x6f\x75\x6e\x74"] = (int)"\x30";
						$data["\x6e\x65\x77\x4d\x65\x6d\x62\x65\x72\x47\x69\x66\x74\x50\x61\x63\x6b\x61\x67\x65\x53\x77\x69\x74\x63\x68"] = (int)"\x30";
						
						$res['data'] = $data;
						$res['code'] = 0;
						$res['msg'] = 'Succeed';
						$res['msgCode'] = 0;
						http_response_code(200);
						echo json_encode($res);			
					}
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
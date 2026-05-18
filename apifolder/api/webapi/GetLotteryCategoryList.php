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
						$data[0]['id'] = 1;
						$data[0]['categoryCode'] = 'Win Go';
						$data[0]['categoryName'] = 'WinGo彩票';
						$data[0]['state'] = 1;
						$data[0]['sort'] = 0;
						$data[0]['categoryImg'] = 'https://selimxpro.com/apiimages/BDGWin/lotterycategory/lotterycategory_20240321194458iceq.png';
						$data[0]['wingoAmount'] = null;
						$data[0]['k3Amount'] = null;
						$data[0]['fiveDAmount'] = null;
						$data[0]['trxWingoAmount'] = null;
						
						$data[1]['id'] = 2;
						$data[1]['categoryCode'] = 'K3';
						$data[1]['categoryName'] = 'K3彩票';
						$data[1]['state'] = 1;
						$data[1]['sort'] = 0;
						$data[1]['categoryImg'] = 'https://selimxpro.com/apiimages/BDGWin/lotterycategory/lotterycategory_20240321194451en5o.png';
						$data[1]['wingoAmount'] = null;
						$data[1]['k3Amount'] = null;
						$data[1]['fiveDAmount'] = null;
						$data[1]['trxWingoAmount'] = null;
						
						$data[2]['id'] = 3;
						$data[2]['categoryCode'] = '5D';
						$data[2]['categoryName'] = '5D彩票';
						$data[2]['state'] = 1;
						$data[2]['sort'] = 0;
						$data[2]['categoryImg'] = 'https://selimxpro.com/apiimages/BDGWin/lotterycategory/lotterycategory_20240321194510h9i1.png';
						$data[2]['wingoAmount'] = null;
						$data[2]['k3Amount'] = null;
						$data[2]['fiveDAmount'] = null;
						$data[2]['trxWingoAmount'] = null;
						
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
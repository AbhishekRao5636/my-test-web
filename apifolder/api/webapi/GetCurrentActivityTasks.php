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
						$data['totalPeople'] = 0;
						$data['totalAmount'] = 0;												
						
						$data['taskList'][0]['taskID'] = 0;
						$data['taskList'][0]['taskAmount'] = 55;
						$data['taskList'][0]['rechargeAmount'] = 300;
						$data['taskList'][0]['rechargeAmount_All'] = null;
						$data['taskList'][0]['taskPeople'] = 1;
						$data['taskList'][0]['rechargePeople'] = 0;
						$data['taskList'][0]['taskRechargePeople'] = 0;
						$data['taskList'][0]['efficientPeople'] = 0;
						$data['taskList'][0]['title'] = null;
						$data['taskList'][0]['title2'] = null;						
						$data['taskList'][0]['isReceive'] = 0;
						$data['taskList'][0]['isFinshed'] = false;
						$data['taskList'][0]['beginDate'] = null;
						$data['taskList'][0]['endDate'] = null;
						
						$data['taskList'][1]['taskID'] = 2;
						$data['taskList'][1]['taskAmount'] = 155;
						$data['taskList'][1]['rechargeAmount'] = 300;
						$data['taskList'][1]['rechargeAmount_All'] = null;
						$data['taskList'][1]['taskPeople'] = 3;
						$data['taskList'][1]['rechargePeople'] = 0;
						$data['taskList'][1]['taskRechargePeople'] = 0;
						$data['taskList'][1]['efficientPeople'] = 0;
						$data['taskList'][1]['title'] = null;
						$data['taskList'][1]['title2'] = null;
						$data['taskList'][1]['isReceive'] = 0;
						$data['taskList'][1]['isFinshed'] = false;
						$data['taskList'][1]['beginDate'] = null;
						$data['taskList'][1]['endDate'] = null;
						
						$data['taskList'][2]['taskID'] = 3;
						$data['taskList'][2]['taskAmount'] = 555;
						$data['taskList'][2]['rechargeAmount'] = 300;
						$data['taskList'][2]['rechargeAmount_All'] = null;
						$data['taskList'][2]['taskPeople'] = 10;
						$data['taskList'][2]['rechargePeople'] = 0;
						$data['taskList'][2]['taskRechargePeople'] = 0;
						$data['taskList'][2]['efficientPeople'] = 0;
						$data['taskList'][2]['title'] = null;
						$data['taskList'][2]['title2'] = null;
						$data['taskList'][2]['isReceive'] = 0;
						$data['taskList'][2]['isFinshed'] = false;
						$data['taskList'][2]['beginDate'] = null;
						$data['taskList'][2]['endDate'] = null;
						
						$data['taskList'][3]['taskID'] = 4;
						$data['taskList'][3]['taskAmount'] = 1555;
						$data['taskList'][3]['rechargeAmount'] = 300;
						$data['taskList'][3]['rechargeAmount_All'] = null;
						$data['taskList'][3]['taskPeople'] = 30;
						$data['taskList'][3]['rechargePeople'] = 0;
						$data['taskList'][3]['taskRechargePeople'] = 0;
						$data['taskList'][3]['efficientPeople'] = 0;
						$data['taskList'][3]['title'] = null;
						$data['taskList'][3]['title2'] = null;
						$data['taskList'][3]['isReceive'] = 0;
						$data['taskList'][3]['isFinshed'] = false;
						$data['taskList'][3]['beginDate'] = null;
						$data['taskList'][3]['endDate'] = null;
						
						$data['taskList'][4]['taskID'] = 5;
						$data['taskList'][4]['taskAmount'] = 2955;
						$data['taskList'][4]['rechargeAmount'] = 300;
						$data['taskList'][4]['rechargeAmount_All'] = null;
						$data['taskList'][4]['taskPeople'] = 60;
						$data['taskList'][4]['rechargePeople'] = 0;
						$data['taskList'][4]['taskRechargePeople'] = 0;
						$data['taskList'][4]['efficientPeople'] = 0;
						$data['taskList'][4]['title'] = null;
						$data['taskList'][4]['title2'] = null;
						$data['taskList'][4]['isReceive'] = 0;
						$data['taskList'][4]['isFinshed'] = false;
						$data['taskList'][4]['beginDate'] = null;
						$data['taskList'][4]['endDate'] = null;
						
						$data['taskList'][5]['taskID'] = 6;
						$data['taskList'][5]['taskAmount'] = 5655;
						$data['taskList'][5]['rechargeAmount'] = 300;
						$data['taskList'][5]['rechargeAmount_All'] = null;
						$data['taskList'][5]['taskPeople'] = 100;
						$data['taskList'][5]['rechargePeople'] = 0;
						$data['taskList'][5]['taskRechargePeople'] = 0;
						$data['taskList'][5]['efficientPeople'] = 0;
						$data['taskList'][5]['title'] = null;
						$data['taskList'][5]['title2'] = null;
						$data['taskList'][5]['isReceive'] = 0;
						$data['taskList'][5]['isFinshed'] = false;
						$data['taskList'][5]['beginDate'] = null;
						$data['taskList'][5]['endDate'] = null;
						
						$data['taskList'][6]['taskID'] = 7;
						$data['taskList'][6]['taskAmount'] = 11555;
						$data['taskList'][6]['rechargeAmount'] = 300;
						$data['taskList'][6]['rechargeAmount_All'] = null;
						$data['taskList'][6]['taskPeople'] = 200;
						$data['taskList'][6]['rechargePeople'] = 0;
						$data['taskList'][6]['taskRechargePeople'] = 0;
						$data['taskList'][6]['efficientPeople'] = 0;
						$data['taskList'][6]['title'] = null;
						$data['taskList'][6]['title2'] = null;
						$data['taskList'][6]['isReceive'] = 0;
						$data['taskList'][6]['isFinshed'] = false;
						$data['taskList'][6]['beginDate'] = null;
						$data['taskList'][6]['endDate'] = null;
						
						$data['taskList'][7]['taskID'] = 8;
						$data['taskList'][7]['taskAmount'] = 28555;
						$data['taskList'][7]['rechargeAmount'] = 300;
						$data['taskList'][7]['rechargeAmount_All'] = null;
						$data['taskList'][7]['taskPeople'] = 500;
						$data['taskList'][7]['rechargePeople'] = 0;
						$data['taskList'][7]['taskRechargePeople'] = 0;
						$data['taskList'][7]['efficientPeople'] = 0;
						$data['taskList'][7]['title'] = null;
						$data['taskList'][7]['title2'] = null;
						$data['taskList'][7]['isReceive'] = 0;
						$data['taskList'][7]['isFinshed'] = false;
						$data['taskList'][7]['beginDate'] = null;
						$data['taskList'][7]['endDate'] = null;
						
						$data['taskList'][8]['taskID'] = 9;
						$data['taskList'][8]['taskAmount'] = 58555;
						$data['taskList'][8]['rechargeAmount'] = 300;
						$data['taskList'][8]['rechargeAmount_All'] = null;
						$data['taskList'][8]['taskPeople'] = 1000;
						$data['taskList'][8]['rechargePeople'] = 0;
						$data['taskList'][8]['taskRechargePeople'] = 0;
						$data['taskList'][8]['efficientPeople'] = 0;
						$data['taskList'][8]['title'] = null;
						$data['taskList'][8]['title2'] = null;
						$data['taskList'][8]['isReceive'] = 0;
						$data['taskList'][8]['isFinshed'] = false;
						$data['taskList'][8]['beginDate'] = null;
						$data['taskList'][8]['endDate'] = null;
						
						$data['taskList'][9]['taskID'] = 10;
						$data['taskList'][9]['taskAmount'] = 365555;
						$data['taskList'][9]['rechargeAmount'] = 300;
						$data['taskList'][9]['rechargeAmount_All'] = null;
						$data['taskList'][9]['taskPeople'] = 5000;
						$data['taskList'][9]['rechargePeople'] = 0;
						$data['taskList'][9]['taskRechargePeople'] = 0;
						$data['taskList'][9]['efficientPeople'] = 0;
						$data['taskList'][9]['title'] = null;
						$data['taskList'][9]['title2'] = null;
						$data['taskList'][9]['isReceive'] = 0;
						$data['taskList'][9]['isFinshed'] = false;
						$data['taskList'][9]['beginDate'] = null;
						$data['taskList'][9]['endDate'] = null;
						
						$data['taskList'][10]['taskID'] = 11;
						$data['taskList'][10]['taskAmount'] = 765555;
						$data['taskList'][10]['rechargeAmount'] = 300;
						$data['taskList'][10]['rechargeAmount_All'] = null;
						$data['taskList'][10]['taskPeople'] = 10000;
						$data['taskList'][10]['rechargePeople'] = 0;
						$data['taskList'][10]['taskRechargePeople'] = 0;
						$data['taskList'][10]['efficientPeople'] = 0;
						$data['taskList'][10]['title'] = null;
						$data['taskList'][10]['title2'] = null;
						$data['taskList'][10]['isReceive'] = 0;
						$data['taskList'][10]['isFinshed'] = false;
						$data['taskList'][10]['beginDate'] = null;
						$data['taskList'][10]['endDate'] = null;
						
						$data['taskList'][11]['taskID'] = 12;
						$data['taskList'][11]['taskAmount'] = 1655555;
						$data['taskList'][11]['rechargeAmount'] = 300;
						$data['taskList'][11]['rechargeAmount_All'] = null;
						$data['taskList'][11]['taskPeople'] = 20000;
						$data['taskList'][11]['rechargePeople'] = 0;
						$data['taskList'][11]['taskRechargePeople'] = 0;
						$data['taskList'][11]['efficientPeople'] = 0;
						$data['taskList'][11]['title'] = null;
						$data['taskList'][11]['title2'] = null;
						$data['taskList'][11]['isReceive'] = 0;
						$data['taskList'][11]['isFinshed'] = false;
						$data['taskList'][11]['beginDate'] = null;
						$data['taskList'][11]['endDate'] = null;
						
						$data['taskList'][12]['taskID'] = 13;
						$data['taskList'][12]['taskAmount'] = 3655555;
						$data['taskList'][12]['rechargeAmount'] = 300;
						$data['taskList'][12]['rechargeAmount_All'] = null;
						$data['taskList'][12]['taskPeople'] = 50000;
						$data['taskList'][12]['rechargePeople'] = 0;
						$data['taskList'][12]['taskRechargePeople'] = 0;
						$data['taskList'][12]['efficientPeople'] = 0;
						$data['taskList'][12]['title'] = null;
						$data['taskList'][12]['title2'] = null;
						$data['taskList'][12]['isReceive'] = 0;
						$data['taskList'][12]['isFinshed'] = false;
						$data['taskList'][12]['beginDate'] = null;
						$data['taskList'][12]['endDate'] = null;
						
						
						$data['chirldrenListDataList'] = null;
						
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
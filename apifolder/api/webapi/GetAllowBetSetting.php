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
				// Match user ID from shonu_subjects
				$sesquery = "SELECT akshinak FROM shonu_subjects WHERE akshinak = '$author'";
				$sesresult = $conn->query($sesquery);
				if ($sesresult && $sesresult->num_rows > 0) {
					$sesrow = $sesresult->fetch_assoc();
					$userId = $data_auth['payload']['id'];
					
					// Fetch recharge details from thevani table
					$balquery = "SELECT COUNT(*) as rechargeTimes, SUM(motta) as totalRechargeAmount FROM thevani WHERE balakedara = '$userId'";
					$balresult = $conn->query($balquery);
					if ($balresult && $balresult->num_rows > 0) {
						$balrow = $balresult->fetch_assoc();
						$userRechargeTimes = (int)$balrow['rechargeTimes'];
						$userRechargeAmount = (float)$balrow['totalRechargeAmount'];

						// Prepare response data
						$data = [
							'canDirectToGame' => $userRechargeTimes > 0,
							'userRechargeTimes' => $userRechargeTimes,
							'allowNoRechargeGame' => "0",
							'userRechargeAmount' => $userRechargeAmount,
							'lowestRechargeAmountToGame' => "100"
						];

						$res['data'] = $data;
						$res['code'] = 0;
						$res['msg'] = 'Succeed';
						$res['msgCode'] = 0;
						http_response_code(200);
						echo json_encode($res);
					} else {
						$res['code'] = 6;
						$res['msg'] = 'No recharge data found';
						$res['msgCode'] = 3;
						http_response_code(404);
						echo json_encode($res);
					}
				} else {
					$res['code'] = 4;
					$res['msg'] = 'No operation permission';
					$res['msgCode'] = 2;
					http_response_code(401);
					echo json_encode($res);
				}
			} else {
				$res['code'] = 4;
				$res['msg'] = 'No operation permission';
				$res['msgCode'] = 2;
				http_response_code(401);
				echo json_encode($res);
			}
		} else {
			$res['code'] = 5;
			$res['msg'] = 'Wrong signature';
			$res['msgCode'] = 3;
			http_response_code(200);
			echo json_encode($res);
		}
	} else {
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

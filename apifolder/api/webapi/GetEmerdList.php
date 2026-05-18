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
						if($typeId == 1){
							$jayshriram = 'gellaluhogiondu_phalitansa';
						}
						else if($typeId == 2){
							$jayshriram = 'gellaluhogiondu_phalitansa_drei';
						}
						else if($typeId == 3){
							$jayshriram = 'gellaluhogiondu_phalitansa_funf';
						}
						else if($typeId == 4){
							$jayshriram = 'gellaluhogiondu_phalitansa_zehn';
						}
						
						$samasye = "SELECT phalitansa
						  FROM ".$jayshriram."
						  ORDER BY shonu DESC LIMIT 100";
						$samasyephalitansa = $conn->query($samasye);
						while($salu = mysqli_fetch_array($samasyephalitansa)){
							$samasyephalitansa_sreni[] = $salu['phalitansa'];
						}
						
						function createRandomArray($length = 10, $min = 5, $max = 25) {
							$arr = [];
							for ($i = 0; $i < $length; $i++) {
								$randomNumber = rand($min, $max);
								$arr[] = $randomNumber;
							}
							return $arr;
						}
						
						$IntervalNumber = createRandomArray();
						
						$data[0]['type'] = 5;
						$data[0]['typeName'] = 'Interval Number';
						$data[0]['type_Number'] = 0;
						$data[0]['number_0'] = $IntervalNumber[0];
						$data[0]['number_1'] = $IntervalNumber[1];
						$data[0]['number_2'] = $IntervalNumber[2];
						$data[0]['number_3'] = $IntervalNumber[3];
						$data[0]['number_4'] = $IntervalNumber[4];
						$data[0]['number_5'] = $IntervalNumber[5];
						$data[0]['number_6'] = $IntervalNumber[6];
						$data[0]['number_7'] = $IntervalNumber[7];
						$data[0]['number_8'] = $IntervalNumber[8];
						$data[0]['number_9'] = $IntervalNumber[9];
						
						$AvgMissing = createRandomArray();
						
						$data[1]['type'] = 4;
						$data[1]['typeName'] = 'Avg Missing';
						$data[1]['type_Number'] = 0;
						$data[1]['number_0'] = $AvgMissing[0];
						$data[1]['number_1'] = $AvgMissing[1];
						$data[1]['number_2'] = $AvgMissing[2];
						$data[1]['number_3'] = $AvgMissing[3];
						$data[1]['number_4'] = $AvgMissing[4];
						$data[1]['number_5'] = $AvgMissing[5];
						$data[1]['number_6'] = $AvgMissing[6];
						$data[1]['number_7'] = $AvgMissing[7];
						$data[1]['number_8'] = $AvgMissing[8];
						$data[1]['number_9'] = $AvgMissing[9];
						
						function findConsecutiveRepetitions($arr) {
							$maxRepetitions = array_fill(0, 10, 0);
							
							for ($i = 0; $i < count($arr); $i++) {
								$currentDigit = $arr[$i];
								$currentCount = 1;
								while ($i + 1 < count($arr) && $arr[$i + 1] == $currentDigit) {
									$currentCount++;
									$i++;
								}
								if ($currentCount > $maxRepetitions[$currentDigit]) {
									$maxRepetitions[$currentDigit] = $currentCount;
								}
							}
							 return $maxRepetitions;
						}	
						$maxRepetitions = findConsecutiveRepetitions($samasyephalitansa_sreni);
						
						$data[2]['type'] = 3;
						$data[2]['typeName'] = 'Max Continued';
						$data[2]['type_Number'] = 0;
						$data[2]['number_0'] = $maxRepetitions[0];
						$data[2]['number_1'] = $maxRepetitions[1];
						$data[2]['number_2'] = $maxRepetitions[2];
						$data[2]['number_3'] = $maxRepetitions[3];
						$data[2]['number_4'] = $maxRepetitions[4];
						$data[2]['number_5'] = $maxRepetitions[5];
						$data[2]['number_6'] = $maxRepetitions[6];
						$data[2]['number_7'] = $maxRepetitions[7];
						$data[2]['number_8'] = $maxRepetitions[8];
						$data[2]['number_9'] = $maxRepetitions[9];
						
						function findFirstIndexes($arr) {
							$firstIndexes = array_fill(0, 10, -1);
							for ($i = 0; $i < 100; $i++) {
								$digit = $arr[$i];
								if ($firstIndexes[$digit] === -1) {
									$firstIndexes[$digit] = $i; 
								}
							}
							return $firstIndexes;
						}
						$firstIndexes = findFirstIndexes($samasyephalitansa_sreni);
						
						$data[3]['type'] = 2;
						$data[3]['typeName'] = 'Missing';
						$data[3]['type_Number'] = 0;
						$data[3]['number_0'] = $firstIndexes[0];
						$data[3]['number_1'] = $firstIndexes[1];
						$data[3]['number_2'] = $firstIndexes[2];
						$data[3]['number_3'] = $firstIndexes[3];
						$data[3]['number_4'] = $firstIndexes[4];
						$data[3]['number_5'] = $firstIndexes[5];
						$data[3]['number_6'] = $firstIndexes[6];
						$data[3]['number_7'] = $firstIndexes[7];
						$data[3]['number_8'] = $firstIndexes[8];
						$data[3]['number_9'] = $firstIndexes[9];
						
						function countRepetitions($arr) {
							$digitCounts = array_fill(0, 10, 0);							
							foreach ($arr as $digit) {
								$digitCounts[$digit]++;
							}
							return $digitCounts;
						}
						$digitCounts = countRepetitions($samasyephalitansa_sreni);
						
						$data[4]['type'] = 1;
						$data[4]['typeName'] = 'Frequency';
						$data[4]['type_Number'] = 0;
						$data[4]['number_0'] = $digitCounts[0];
						$data[4]['number_1'] = $digitCounts[1];
						$data[4]['number_2'] = $digitCounts[2];
						$data[4]['number_3'] = $digitCounts[3];
						$data[4]['number_4'] = $digitCounts[4];
						$data[4]['number_5'] = $digitCounts[5];
						$data[4]['number_6'] = $digitCounts[6];
						$data[4]['number_7'] = $digitCounts[7];
						$data[4]['number_8'] = $digitCounts[8];
						$data[4]['number_9'] = $digitCounts[9];
						
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
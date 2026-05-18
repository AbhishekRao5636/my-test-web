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
		if (isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['taskId']) && isset($shonupost['timestamp'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$taskId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['taskId']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'","taskId":'.$taskId.'}';
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
						
						if($taskId == 1){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','1','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 55 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 2){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','2','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 155 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 3){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','3','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 4){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','4','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 1555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 5){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','5','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 2955 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 6){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','6','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 5655 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 7){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','7','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 11555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 8){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','8','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 28555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 9){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','9','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 58555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 10){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','10','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 365555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 11){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','11','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 765555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 12){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','12','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 1655555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
						else if($taskId == 13){
							$tathya = mysqli_query($conn,"INSERT INTO `noitativni_sonub` (`arthur`,`fleck`,`status`,`time`) VALUES ('".$shonuid."','13','1','".$shnunc."')");
							
							$nabikarana = "UPDATE shonu_kaichila set motta = motta + 3655555 where balakedara='$shonuid'";
							$conn->query($nabikarana);
						}
								
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
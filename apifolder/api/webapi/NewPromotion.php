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
					$sesquery = "SELECT akshinak, owncode
					  FROM shonu_subjects
					  WHERE akshinak = '$author'";
					$sesresult=$conn->query($sesquery);
					$sesnum = mysqli_num_rows($sesresult);
					if($sesnum == 1){
						$sesarr = mysqli_fetch_array($sesresult);
						$data['mylink'] = 'https://selimxpro.com/#/register?r_code='.$sesarr['owncode'];
						$data['aglink'] = '5adc48b72e661453d9560fdb783efbd24384fdca61caad1d4f038a0ffc692a6e';
						$data['mycode'] = $sesarr['owncode'];
						
						$lv1query = "SELECT code1
						  FROM shonu_subjects
						  WHERE code = '".$sesarr['owncode']."'";
						$lv1result = $conn->query($lv1query);
						$data['children_Lv_1_Count'] = mysqli_num_rows($lv1result);
						
						$lvxquery = "SELECT code2
						  FROM shonu_subjects
						  WHERE code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."'";
						$lvxresult = $conn->query($lvxquery);
						$data['children_Lv_Count_X'] = mysqli_num_rows($lvxresult);
						
						$tdtime = time();
						$ydtime = $tdtime - 24*60*60;
						$wktime = $tdtime - 7*24*60*60;
						$yddt = date("Y-m-d H-i-s", $ydtime);
						$tddt = date("Y-m-d H-i-s", $tdtime);
						$wkdt = date("Y-m-d H-i-s", $wktime);
						
						
						$data['children_Lv_1_Count_Add'] = 0;
						$data['children_Lv_Count_X_Add'] = 0;
						
						$lv1addquery = "SELECT id FROM shonu_subjects WHERE DATE(createdate) = DATE('".$yddt."') AND code = '".$sesarr['owncode']."'";
						$lv1addresult = $conn->query($lv1addquery);
						$data['children_Lv_1_Count_Add_Yesterday'] = mysqli_num_rows($lv1addresult);
						
						$lvxaddquery = "SELECT id FROM shonu_subjects WHERE DATE(createdate) = DATE('".$yddt."') AND (code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')";
						$lvxaddresult = $conn->query($lvxaddquery);
						$data['children_Lv_Count_X_Add_Yesterday'] = mysqli_num_rows($lvxaddresult);
						
						$lv1rchquery = "SELECT motta
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')";
						$lv1rchresult = $conn->query($lv1rchquery);
						$data['children_Lv_1_RechargesSumCount'] = mysqli_num_rows($lv1rchresult);
						
						$lvxrchquery = "SELECT motta
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND 
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')";
						$lvxrchresult = $conn->query($lvxrchquery);
						$data['children_Lv_RechargesSumCount'] = mysqli_num_rows($lvxrchresult);
						
						$lv1frtrchquery = "SELECT motta
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND 
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')
						  AND 
						  (
						  SELECT count(shonu)
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND 
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')
						  ) = 1";
						$lv1frtrchresult = $conn->query($lv1frtrchquery);
						$data['children_Lv_1_FirstRechargesCount'] = mysqli_num_rows($lv1frtrchresult);
						
						$lvxfrtrchquery = "SELECT motta
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND 
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')
						  AND 
						  (
						  SELECT count(shonu)
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND 
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')
						  ) = 1";
						$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
						$data['children_Lv_FirstRechargesCount'] = mysqli_num_rows($lvxfrtrchresult);
						
						$lv1rchquery_sm = "SELECT SUM(motta) as sumotta
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND 
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')";
						$lv1rchresult_sm = $conn->query($lv1rchquery_sm);
						$lv1rchresult_ar = mysqli_fetch_array($lv1rchresult_sm);
						$sumotta = $lv1rchresult_ar['sumotta'];
						$sumotta == null ? $data['children_Lv_1_RechargesSumAmount'] = 0 : $data['children_Lv_1_RechargesSumAmount'] = $sumotta;
						
						$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
						  FROM thevani
						  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$yddt."') AND 
						  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')";
						$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
						$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
						$sumotta_x = $lvxrchresult_ar['sumotta'];
						$sumotta_x == null ? $data['children_Lv_RechargesSumAmount'] = 0 : $data['children_Lv_RechargesSumAmount'] = $sumotta_x;
						
						$shonuid = $data_auth['payload']['id'];
						$rbxquery = "SELECT SUM(ayoga) as sumayoga
						  FROM vyavahara
						  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$yddt."') AND (prakara = 'LVLCOMM1' OR prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
						$rbxresult = $conn->query($rbxquery);
						$rbxar = mysqli_fetch_array($rbxresult);
						$sumayoga = (float)$rbxar['sumayoga'];
						$sumayoga == null ? $data['children_Lv_RebateAmount_Yesterday'] = 0 : $data['children_Lv_RebateAmount_Yesterday'] = number_format($sumayoga, 2, '.', '');

						$rbxquery = "SELECT SUM(ayoga) as sumayoga
						  FROM vyavahara
						  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$yddt."') AND (prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
						$rbxresult = $conn->query($rbxquery);
						$rbxar = mysqli_fetch_array($rbxresult);
						$sumayoga = (float)$rbxar['sumayoga'];
						$sumayoga == null ? $data['children_Lv_1_RebateAmount_Yesterday'] = 0 : $data['children_Lv_1_RebateAmount_Yesterday'] = number_format($sumayoga, 2, '.', '');
						
						$rbxquery = "SELECT SUM(ayoga) as sumayoga
						  FROM vyavahara
						  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) >= DATE('".$wkdt."') AND (prakara = 'LVLCOMM1' OR prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
						$rbxresult = $conn->query($rbxquery);
						$rbxar = mysqli_fetch_array($rbxresult);
						$sumayoga = (float)$rbxar['sumayoga'];
						$sumayoga == null ? $data['children_Lv_RebateAmount_Week'] = 0 : $data['children_Lv_RebateAmount_Week'] = number_format($sumayoga, 2, '.', '');
						
						$rbxquery = "SELECT SUM(ayoga) as sumayoga
						  FROM vyavahara
						  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) >= DATE('".$wkdt."') AND (prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
						$rbxresult = $conn->query($rbxquery);
						$rbxar = mysqli_fetch_array($rbxresult);
						$sumayoga = (float)$rbxar['sumayoga'];
						$sumayoga == null ? $data['children_Lv_1_RebateAmount_X_Yesterday'] = 0 : $data['children_Lv_1_RebateAmount_X_Yesterday'] = number_format($sumayoga, 2, '.', '');
						
						$rbxquery = "SELECT SUM(ayoga) as sumayoga
						  FROM vyavahara
						  WHERE balakedara = '".$shonuid."' AND (prakara = 'LVLCOMM1' OR prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
						$rbxresult = $conn->query($rbxquery);
						$rbxar = mysqli_fetch_array($rbxresult);
						$sumayoga = (float)$rbxar['sumayoga'];
						$sumayoga == null ? $data['children_Lv_RebateAmount'] = 0 : $data['children_Lv_RebateAmount'] = number_format($sumayoga, 2, '.', '');
						
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
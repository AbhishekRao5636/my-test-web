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
		if (isset($shonupost['day']) && isset($shonupost['language']) && isset($shonupost['lv']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp'])) {
			$day = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['day']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$lv = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['lv']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));			
			if($shonupost['userId'] == ''){
				$shonustr = '{"day":"'.$day.'","language":'.$language.',"lv":'.$lv.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'"}';	
			}
			else{
				$userId = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['userId']));
				$shonustr = '{"day":"'.$day.'","language":'.$language.',"lv":'.$lv.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'","userId":'.$userId.'}';					
			}						
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
						$samatolana = ($pageNo - 1) * 10;
						$shonuid = $data_auth['payload']['id'];

						$sesarr = mysqli_fetch_array($sesresult);
						
						if($shonupost['userId'] == ''){
							if($lv == -1){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(DISTINCT koduvavanu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')
								  AND (prakara = 'LVLCOMM1' OR prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."' OR code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."' OR code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."' OR code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."' OR code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."' OR code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."' OR code1 = '".$sesarr['owncode']."' OR code2 = '".$sesarr['owncode']."' OR code3 = '".$sesarr['owncode']."' OR code4 = '".$sesarr['owncode']."' OR code5 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;

								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code = '".$sesarr['owncode']."' THEN '1'
											   WHEN code1 = '".$sesarr['owncode']."' THEN '2'
											   WHEN code2 = '".$sesarr['owncode']."' THEN '3'
											   WHEN code3 = '".$sesarr['owncode']."' THEN '4'
											   WHEN code4 = '".$sesarr['owncode']."' THEN '5'
											   WHEN code5 = '".$sesarr['owncode']."' THEN '6'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE code = '".$sesarr['owncode']."'
											  OR code1 = '".$sesarr['owncode']."'
											  OR code2 = '".$sesarr['owncode']."'
											  OR code3 = '".$sesarr['owncode']."'
											  OR code4 = '".$sesarr['owncode']."'
											  OR code5 = '".$sesarr['owncode']."'";
								$lstqryresult = $conn->query($lstqry);	
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 1){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')
								  AND (prakara = 'LVLCOMM1')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;

								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code = '".$sesarr['owncode']."' THEN '1'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE code = '".$sesarr['owncode']."'";
								$lstqryresult = $conn->query($lstqry);	
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 2){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')
								  AND (prakara = 'LVLCOMM2')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."')";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."')";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code1 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;

								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code1 = '".$sesarr['owncode']."' THEN '2'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE code1 = '".$sesarr['owncode']."'";
								$lstqryresult = $conn->query($lstqry);	
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 3){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')
								  AND (prakara = 'LVLCOMM3')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code2 = '".$sesarr['owncode']."')";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code2 = '".$sesarr['owncode']."')";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code2 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code2 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code2 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code2 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;

								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code2 = '".$sesarr['owncode']."' THEN '3'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE code2 = '".$sesarr['owncode']."'";
								$lstqryresult = $conn->query($lstqry);	
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 4){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')
								  AND (prakara = 'LVLCOMM4')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code3 = '".$sesarr['owncode']."')";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code3 = '".$sesarr['owncode']."')";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code3 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code3 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code3 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code3 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;

								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code3 = '".$sesarr['owncode']."' THEN '4'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE code3 = '".$sesarr['owncode']."'";
								$lstqryresult = $conn->query($lstqry);	
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 5){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')
								  AND (prakara = 'LVLCOMM5')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code4 = '".$sesarr['owncode']."')";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code4 = '".$sesarr['owncode']."')";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code4 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code4 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code4 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code4 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;

								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code4 = '".$sesarr['owncode']."' THEN '5'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE code4 = '".$sesarr['owncode']."'";
								$lstqryresult = $conn->query($lstqry);	
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 6){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')
								  AND (prakara = 'LVLCOMM6')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code5 = '".$sesarr['owncode']."')";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code5 = '".$sesarr['owncode']."')";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code5 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code5 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code5 = '".$sesarr['owncode']."')
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara IN (SELECT id FROM shonu_subjects WHERE code5 = '".$sesarr['owncode']."')
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;

								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code5 = '".$sesarr['owncode']."' THEN '6'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE code5 = '".$sesarr['owncode']."'";
								$lstqryresult = $conn->query($lstqry);	
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
						}
						else{
							if($lv == -1){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."') AND koduvavanu = '".$userId."'
								  AND (prakara = 'LVLCOMM1' OR prakara = 'LVLCOMM2' OR prakara = 'LVLCOMM3' OR prakara = 'LVLCOMM4' OR prakara = 'LVLCOMM5' OR prakara = 'LVLCOMM6')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;
								
								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code = '".$sesarr['owncode']."' THEN '1'
											   WHEN code1 = '".$sesarr['owncode']."' THEN '2'
											   WHEN code2 = '".$sesarr['owncode']."' THEN '3'
											   WHEN code3 = '".$sesarr['owncode']."' THEN '4'
											   WHEN code4 = '".$sesarr['owncode']."' THEN '5'
											   WHEN code5 = '".$sesarr['owncode']."' THEN '6'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE id = '".$userId."'";
								$lstqryresult = $conn->query($lstqry);
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 1){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."') AND koduvavanu = '".$userId."'
								  AND (prakara = 'LVLCOMM1')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;
								
								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code = '".$sesarr['owncode']."' THEN '1'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE id = '".$userId."'";
								$lstqryresult = $conn->query($lstqry);
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0 || $data['list'][0]['lv'] == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 2){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."') AND koduvavanu = '".$userId."'
								  AND (prakara = 'LVLCOMM2')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;
								
								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code1 = '".$sesarr['owncode']."' THEN '2'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE id = '".$userId."'";
								$lstqryresult = $conn->query($lstqry);
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0 || $data['list'][0]['lv'] == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 3){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."') AND koduvavanu = '".$userId."'
								  AND (prakara = 'LVLCOMM3')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;
								
								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code2 = '".$sesarr['owncode']."' THEN '3'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE id = '".$userId."'";
								$lstqryresult = $conn->query($lstqry);
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0 || $data['list'][0]['lv'] == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 4){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."') AND koduvavanu = '".$userId."'
								  AND (prakara = 'LVLCOMM4')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;
								
								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code3 = '".$sesarr['owncode']."' THEN '4'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE id = '".$userId."'";
								$lstqryresult = $conn->query($lstqry);
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0 || $data['list'][0]['lv'] == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 5){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."') AND koduvavanu = '".$userId."'
								  AND (prakara = 'LVLCOMM5')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;
								
								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code4 = '".$sesarr['owncode']."' THEN '5'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE id = '".$userId."'";
								$lstqryresult = $conn->query($lstqry);
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0 || $data['list'][0]['lv'] == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
							if($lv == 6){
								$rbxquery = "SELECT SUM(ayoga) as sumayoga, count(shonu) as bcs, SUM(ketebida) as bas
								  FROM vyavahara
								  WHERE balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."') AND koduvavanu = '".$userId."'
								  AND (prakara = 'LVLCOMM6')";
								$rbxresult = $conn->query($rbxquery);
								$rbxar = mysqli_fetch_array($rbxresult);
								$sumayoga = (float)$rbxar['sumayoga'];
								$sumayoga == null ? $data['data']['rebateAmountSum'] = 0 : $data['data']['rebateAmountSum'] = $sumayoga;
								
								$bcs = (int)$rbxar['bcs'];
								$bcs == null ? $data['data']['betCountSum'] = 0 : $data['data']['betCountSum'] = $bcs;
								
								$bas = (float)$rbxar['bas'];
								$bas == null ? $data['data']['betAmountSum'] = 0 : $data['data']['betAmountSum'] = $bas;
								
								$lvxrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult = $conn->query($lvxrchquery);
								$data['data']['recahrgeCount'] = mysqli_num_rows($lvxrchresult);
								
								$lvxrchquery_sm = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'";
								$lvxrchresult_sm = $conn->query($lvxrchquery_sm);
								$lvxrchresult_ar = mysqli_fetch_array($lvxrchresult_sm);
								$sumotta_x = $lvxrchresult_ar['sumotta'];
								$sumotta_x == null ? $data['data']['recahrgeAmountSum'] = 0 : $data['data']['recahrgeAmountSum'] = $sumotta_x;
								
								$lvxfrtrchquery = "SELECT motta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$data['data']['firstRecahrgeCount'] = mysqli_num_rows($lvxfrtrchresult);
								
								$lvxfrtrchquery = "SELECT SUM(motta) as sumotta
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  AND 
								  (
								  SELECT count(shonu)
								  FROM thevani
								  WHERE sthiti = '1' AND DATE(dinankavannuracisi) = DATE('".$day."') AND 
								  balakedara = '".$userId."'
								  ) = 1";
								$lvxfrtrchresult = $conn->query($lvxfrtrchquery);
								$lvxfrtrchresult_ar = mysqli_fetch_array($lvxfrtrchresult);
								$sumotta_y = $lvxfrtrchresult_ar['sumotta'];
								$sumotta_y == null ? $data['data']['firstRecahrgeAmountSum'] = 0 : $data['data']['firstRecahrgeAmountSum'] = $sumotta_y;
								
								$lstqry = "SELECT id, codechorkamukala, status,
										   CASE
											   WHEN code5 = '".$sesarr['owncode']."' THEN '6'
											   ELSE 'unknown'
										   END AS selected_by
										   FROM shonu_subjects
										   WHERE id = '".$userId."'";
								$lstqryresult = $conn->query($lstqry);
								$i = 0;
								while($lstqryresult_ar = mysqli_fetch_array($lstqryresult)){									
									$data['list'][$i]['userID'] = (int)$lstqryresult_ar['id'];
									$data['list'][$i]['lv'] = (int)$lstqryresult_ar['selected_by'];
									$data['list'][$i]['nickName'] = $lstqryresult_ar['codechorkamukala'];
									$data['list'][$i]['userState'] = (int)$lstqryresult_ar['status'];
									$data['list'][$i]['searchTime'] = date('Y-m-d', strtotime($day));
									
									$ltatqr = "SELECT SUM(ketebida) AS total_ketebida FROM 
									( 	
										SELECT ketebida FROM bajikattuttate WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."')
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_aidudi WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
										UNION ALL 
										SELECT ketebida FROM bajikattuttate_kemuru WHERE byabaharkarta = '".$lstqryresult_ar['id']."' AND DATE(tiarikala) = DATE('".$day."') 
									) AS combined_tables";
									$ltatqrresult = $conn->query($ltatqr);
									$ltatqr_ar = mysqli_fetch_array($ltatqrresult);
									$ltatqr_ar['total_ketebida'] == null ? $data['list'][$i]['lotteryAmount'] = 0 : $data['list'][$i]['lotteryAmount'] = (int)$ltatqr_ar['total_ketebida'];
									
									$rtatqr = "SELECT SUM(motta) AS total_motta 
											  FROM thevani
											  WHERE balakedara = '".$lstqryresult_ar['id']."' AND DATE(dinankavannuracisi) = DATE('".$day."') AND sthiti = '1'";
									$rtatresult = $conn->query($rtatqr);
									$rtat_ar = mysqli_fetch_array($rtatresult);
									$rtat_ar['total_motta'] == null ? $data['list'][$i]['rechargeAmount'] = 0 : $data['list'][$i]['rechargeAmount'] = (int)$rtat_ar['total_motta'];
									
									$rbatqr = "SELECT SUM(ayoga) AS total_ketebida 
											FROM vyavahara
											WHERE koduvavanu = '".$lstqryresult_ar['id']."' AND balakedara = '".$shonuid."' AND DATE(tiarikala) = DATE('".$day."')";
									$rbatresult = $conn->query($rbatqr);
									$rbat_ar = mysqli_fetch_array($rbatresult);
									$rbat_ar['total_ketebida'] == null ? $data['list'][$i]['rebateAmount'] = 0 : $data['list'][$i]['rebateAmount'] = (int)$rbat_ar['total_ketebida'];
									
									$i++;
								}
								$lstqryresult_rw = mysqli_num_rows($lstqryresult);
								if($lstqryresult_rw == 0 || $data['list'][0]['lv'] == 0){
									$data['list'] = [];
									$data['pageNo'] = 1;
									$data['totalCount'] = 0;
									$data['totalPage'] = 0;
								}
								else{
									$data['pageNo'] = 1;
									$data['totalCount'] = $lstqryresult_rw;
									$data['totalPage'] = ceil($lstqryresult_rw/$pageSize);
								}
							}
						}
																														
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
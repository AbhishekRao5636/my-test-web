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
	
	function replaceWithAsterisks($inputString) {
		if (strlen($inputString) < 10) {
			return $inputString;
		}
		$before = substr($inputString, 0, 6);
		$toReplace = substr($inputString, 6, 4);
		$after = substr($inputString, 10);
		$replaced = str_repeat('*', strlen($toReplace));
		$resultString = $before . $replaced . $after;
		return $resultString;
	}
	
	
	if ($_SERVER['REQUEST_METHOD'] != 'GET') {
		if (isset($shonupost['language']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp']) && isset($shonupost['withdrawid'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$withdrawid = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['withdrawid']));
			$shonustr = '{"language":'.$language.',"random":"'.$random.'","withdrawid":'.$withdrawid.'}';
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
						if($withdrawid == 1){
							$samasye = "SELECT phalanubhavi
							  FROM khate WHERE byabaharkarta = $shonuid AND khatehesaru != 'TRC'
							  ORDER BY shonu DESC LIMIT 1";
							$samasyephalitansa = $conn->query($samasye);
							$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);	
							if($samasyephalitansa_dhadi >= 1){
								$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);						
								$data['lastBandCarkName'] = $samasyephalitansa_sreni['phalanubhavi'];
								
								$samasye = "SELECT shonu, khatehesaru, khatesankhye, kod, duravani
								  FROM khate WHERE byabaharkarta = $shonuid AND khatehesaru != 'TRC'
								  ORDER BY shonu DESC";
								$samasyephalitansa = $conn->query($samasye);
								$i = 0;
								while($row = mysqli_fetch_array($samasyephalitansa)){
									$data['withdrawalslist'][$i]['bid'] = $row['shonu'];
									$data['withdrawalslist'][$i]['bankName'] = $row['khatehesaru'];
									$data['withdrawalslist'][$i]['beneficiaryName'] = '';
									
									$data['withdrawalslist'][$i]['accountNo'] = replaceWithAsterisks($row['khatesankhye']);
									$data['withdrawalslist'][$i]['ifsCode'] = $row['kod'];
									$data['withdrawalslist'][$i]['withType'] = 1;
									$data['withdrawalslist'][$i]['mobileNo'] = replaceWithAsterisks($row['duravani']);
									$data['withdrawalslist'][$i]['bankProvince'] = '';
									$data['withdrawalslist'][$i]['bankCity'] = '';
									$data['withdrawalslist'][$i]['bankAddress'] = '';
									$i++;
								}
							}
							else{
								$data['lastBandCarkName'] = null;
								$data['withdrawalslist'] = [];
							}
						}
						elseif($withdrawid == 3){
							$samasye = "SELECT phalanubhavi
							  FROM khate WHERE byabaharkarta = $shonuid AND khatehesaru = 'TRC'
							  ORDER BY shonu DESC LIMIT 1";
							$samasyephalitansa = $conn->query($samasye);
							$samasyephalitansa_dhadi = mysqli_num_rows($samasyephalitansa);	
							if($samasyephalitansa_dhadi >= 1){
								$samasyephalitansa_sreni = mysqli_fetch_array($samasyephalitansa);						
								$data['lastBandCarkName'] = $samasyephalitansa_sreni['phalanubhavi'];
								
								$samasye = "SELECT shonu, khatehesaru, khatesankhye, kod, duravani
								  FROM khate WHERE byabaharkarta = $shonuid AND khatehesaru = 'TRC'
								  ORDER BY shonu DESC";
								$samasyephalitansa = $conn->query($samasye);
								$i = 0;
								while($row = mysqli_fetch_array($samasyephalitansa)){
									$data['withdrawalslist'][$i]['bid'] = $row['shonu'];
									$data['withdrawalslist'][$i]['bankName'] = $row['khatehesaru'];
									$data['withdrawalslist'][$i]['beneficiaryName'] = '';
									
									$data['withdrawalslist'][$i]['accountNo'] = replaceWithAsterisks($row['khatesankhye']);
									$data['withdrawalslist'][$i]['ifsCode'] = $row['kod'];
									$data['withdrawalslist'][$i]['withType'] = 1;
									$data['withdrawalslist'][$i]['mobileNo'] = replaceWithAsterisks($row['duravani']);
									$data['withdrawalslist'][$i]['bankProvince'] = '';
									$data['withdrawalslist'][$i]['bankCity'] = '';
									$data['withdrawalslist'][$i]['bankAddress'] = '';
									$i++;
								}
							}
							else{
								$data['lastBandCarkName'] = null;
								$data['withdrawalslist'] = [];
							}
						}
						
						$samasye_1 = "\x53\x45\x4c\x45\x43\x54\x20\x73\x68\x6f\x6e\x75\xd\xa\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x68\x69\x6e\x74\x65\x67\x65\x64\x75\x6b\x6f\x6c\x6c\x69\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20\x27".$shonuid."\x27\xd\xa\x9\x9\x9\x9\x9\x9\x9\x20\x20\x41\x4e\x44\x20\x44\x41\x54\x45\x28\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\x29\x20\x3d\x20\x64\x61\x74\x65\x28\x27".$shnunc."')";
						$samasyephalitansa_1 = $conn->query($samasye_1);
						$shelly = mysqli_num_rows($samasyephalitansa_1);
						$shelly_1 = 3 - $shelly;
											
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x77\x69\x74\x68\x64\x72\x61\x77\x43\x6f\x75\x6e\x74"] = $shelly;
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x77\x69\x74\x68\x64\x72\x61\x77\x52\x65\x6d\x61\x69\x6e\x69\x6e\x67\x43\x6f\x75\x6e\x74"] = $shelly_1;
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x73\x74\x61\x72\x74\x54\x69\x6d\x65"] = "\x30\x30\x3a\x30\x30";
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x65\x6e\x64\x54\x69\x6d\x65"] = "\x32\x33\x3a\x35\x39";
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x66\x65\x65"] = (int)"\x30";
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x6d\x69\x6e\x50\x72\x69\x63\x65"] = (int)"\x31\x31\x30";
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x6d\x61\x78\x50\x72\x69\x63\x65"] = (int)"\x35\x30\x30\x30\x30";
						
						$balquery = "\x53\x45\x4c\x45\x43\x54\x20\x6d\x6f\x74\x74\x61\xd\xa\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x73\x68\x6f\x6e\x75\x5f\x6b\x61\x69\x63\x68\x69\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x20\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20".$data_auth['payload']['id'];
						$balresult = $conn->query($balquery);
						$balarr = mysqli_fetch_array($balresult);
						
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x61\x6d\x6f\x75\x6e\x74"] = $balarr["\x6d\x6f\x74\x74\x61"];
						
						$rtatqr = "SELECT SUM(motta) as sote
						  FROM thevani
						  WHERE balakedara = '".$shonuid."' AND sthiti = '1'";
						$rtatresult = $conn->query($rtatqr);
						$rtat_ar = mysqli_fetch_array($rtatresult);
						
						$rtatqr_a = "SELECT SUM(price) as sote
						  FROM hodike_balakedara
						  WHERE userkani = '".$shonuid."'";
						$rtatresult_a = $conn->query($rtatqr_a);
						$rtat_ar_a = mysqli_fetch_array($rtatresult_a);
						
						$sotek = $rtat_ar['sote'] + $rtat_ar_a['sote'] + 20;						
						
						$bet_wingo_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate` where byabaharkarta = '".$shonuid."'"));
						$bet_wingo_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_drei` where byabaharkarta = '".$shonuid."'"));
						$bet_wingo_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_funf` where byabaharkarta = '".$shonuid."'"));
						$bet_wingo_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_zehn` where byabaharkarta = '".$shonuid."'"));
						$bet_k3_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru` where byabaharkarta = '".$shonuid."'"));
						$bet_k3_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru_drei` where byabaharkarta = '".$shonuid."'"));
						$bet_k3_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru_funf` where byabaharkarta = '".$shonuid."'"));
						$bet_k3_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru_zehn` where byabaharkarta = '".$shonuid."'"));
						$bet_5d_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi` where byabaharkarta = '".$shonuid."'"));
						$bet_5d_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi_drei` where byabaharkarta = '".$shonuid."'"));
						$bet_5d_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi_funf` where byabaharkarta = '".$shonuid."'"));
						$bet_5d_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi_zehn` where byabaharkarta = '".$shonuid."'"));
						$total_bet = $bet_wingo_1['total'] + $bet_wingo_3['total'] + $bet_wingo_5['total'] + $bet_wingo_10['total'] + $bet_k3_1['total'] + $bet_k3_3['total'] + $bet_k3_5['total'] + $bet_k3_10['total'] + $bet_5d_1['total'] + $bet_5d_3['total'] + $bet_5d_5['total'] + $bet_5d_10['total'];												
						
						if($sotek > $total_bet){
							$wiwo = 0;
							$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x61\x6d\x6f\x75\x6e\x74\x6f\x66\x43\x6f\x64\x65"] = 0;
						}
						else if($sotek <= $total_bet){
							if($rtat_ar['sote'] == null || $rtat_ar['sote'] == ''){
								$wiwo = 0;
							}
							else{
								$wiwo = $balarr["\x6d\x6f\x74\x74\x61"];
							}
							$wiwo = $balarr["\x6d\x6f\x74\x74\x61"];
							$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x61\x6d\x6f\x75\x6e\x74\x6f\x66\x43\x6f\x64\x65"] = (int)"\x30";
						}
						
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x63\x61\x6e\x57\x69\x74\x68\x64\x72\x61\x77\x41\x6d\x6f\x75\x6e\x74"] = $wiwo;
						
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x63\x32\x63\x55\x6e\x69\x74\x41\x6d\x6f\x75\x6e\x74"] = 0;
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x75\x52\x61\x74\x65"] = 93;
						$data["\x77\x69\x74\x68\x64\x72\x61\x77\x61\x6c\x73\x72\x75\x6c\x65"]["\x75\x47\x6f\x6c\x64"] = 0;
						
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
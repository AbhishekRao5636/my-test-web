<?php 
	include "\x2e\x2e\x2f\x2e\x2e\x2f\x63\x6f\x6e\x6e\x2e\x70\x68\x70";
	include "\x2e\x2e\x2f\x2e\x2e\x2f\x66\x75\x6e\x63\x74\x69\x6f\x6e\x73\x32\x2e\x70\x68\x70";
	
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
		if (isset($shonupost['date']) && isset($shonupost['language']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) && isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['timestamp']) && isset($shonupost['type'])) {
			$date = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['date']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));			
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			//$startDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['startDate']));
			$type = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['type']));
			if($date == ''){
				$shonustr = '{"language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'","type":'.$type.'}';	
			}
			else{
				$shonustr = '{"date":"'.$date.'","language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'","type":'.$type.'}';	
			}						
			$shonusign = strtoupper(md5($shonustr));
			if($shonusign == $signature){
				$bearer = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);
				$author = $bearer[1];				
				$is_jwt_valid = is_jwt_valid($author);
				$data_auth = json_decode($is_jwt_valid, 1);
				if($data_auth['status'] === 'Success') {
					$sesquery = "\x53\x45\x4c\x45\x43\x54\x20\x61\x6b\x73\x68\x69\x6e\x61\x6b\xa\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x73\x68\x6f\x6e\x75\x5f\x73\x75\x62\x6a\x65\x63\x74\x73\xa\x9\x9\x9\x9\x9\x20\x20\x57\x48\x45\x52\x45\x20\x61\x6b\x73\x68\x69\x6e\x61\x6b\x20\x3d\x20\x27$author\x27";
					$sesresult=$conn->query($sesquery);
					$sesnum = mysqli_num_rows($sesresult);
					if($sesnum == 1){
						$samatolana = ($pageNo - 1) * 10;
						$shonuid = $data_auth['payload']['id'];
						
						if($date == ''){
							if($type == -1){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  UNION ALL
								  SELECT macau as parichaya, salary as ketebida, 'ds' as phalaphala, salary as sesabida, createdate as tiarikala 
								  FROM dailysalary WHERE userid = $shonuid
								  UNION ALL
								  SELECT shonu as parichaya, motta as ketebida, 'rc' as phalaphala, motta as sesabida, dinankavannuracisi as tiarikala 
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = 1
								  UNION ALL
								  SELECT shonu as parichaya, motta as ketebida, 'wd' as phalaphala, motta as sesabida, dinankavannuracisi as tiarikala 
								  FROM hintegedukolli WHERE balakedara = $shonuid AND sthiti = 1 
								  UNION ALL
								  SELECT kani as parichaya, price as ketebida, 're' as phalaphala, price as sesabida, shonu as tiarikala 
								  FROM hodike_balakedara WHERE userkani = $shonuid 
								  \x4f\x52\x44\x45\x52\x20\x42\x59\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT parichaya
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT macau as parichaya
								  FROM dailysalary WHERE userid = $shonuid
								  UNION ALL
								  SELECT shonu as parichaya
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = 1
								  UNION ALL
								  SELECT shonu as parichaya
								  FROM hintegedukolli WHERE balakedara = $shonuid AND sthiti = 1
								  UNION ALL
								  SELECT kani as parichaya
								  FROM hodike_balakedara WHERE userkani = $shonuid";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 0){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x55\x4e\x49\x4f\x4e\x20\x41\x4c\x4c\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid
								  \x4f\x52\x44\x45\x52\x20\x42\x59\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT parichaya
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 1){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x6d\x61\x63\x61\x75\x2c\x20\x73\x61\x6c\x61\x72\x79\x2c\x20\x63\x72\x65\x61\x74\x65\x64\x61\x74\x65\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x64\x61\x69\x6c\x79\x73\x61\x6c\x61\x72\x79\x20\x57\x48\x45\x52\x45\x20\x75\x73\x65\x72\x69\x64\x20\x3d\x20$shonuid								  
								  \x4f\x52\x44\x45\x52\x20\x42\x59\x20\x6d\x61\x63\x61\x75\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x6d\x61\x63\x61\x75\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x64\x61\x69\x6c\x79\x73\x61\x6c\x61\x72\x79\x20\x57\x48\x45\x52\x45\x20\x75\x73\x65\x72\x69\x64\x20\x3d\x20$shonuid";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 4){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x73\x68\x6f\x6e\x75\x2c\x20\x6d\x6f\x74\x74\x61\x2c\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x74\x68\x65\x76\x61\x6e\x69\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x73\x74\x68\x69\x74\x69\x20\x3d\x20\x31
								  \x4f\x52\x44\x45\x52\x20\x42\x59\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x73\x68\x6f\x6e\x75\x2c\x20\x6d\x6f\x74\x74\x61\x2c\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x74\x68\x65\x76\x61\x6e\x69\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x73\x74\x68\x69\x74\x69\x20\x3d\x20\x31";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 5){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x73\x68\x6f\x6e\x75\x2c\x20\x6d\x6f\x74\x74\x61\x2c\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x68\x69\x6e\x74\x65\x67\x65\x64\x75\x6b\x6f\x6c\x6c\x69\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x73\x74\x68\x69\x74\x69\x20\x3d\x20\x31
								 \x20\x4f\x52\x44\x45\x52\x20\x42\x59\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x73\x68\x6f\x6e\x75\x2c\x20\x6d\x6f\x74\x74\x61\x2c\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x68\x69\x6e\x74\x65\x67\x65\x64\x75\x6b\x6f\x6c\x6c\x69\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x73\x74\x68\x69\x74\x69\x20\x3d\x20\x31";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 2){
								$samasye = "SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  ORDER BY tiarikala DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT parichaya
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner'";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 3){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x6b\x61\x6e\x69\x2c\x20\x70\x72\x69\x63\x65\x2c\x20\x73\x68\x6f\x6e\x75\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x68\x6f\x64\x69\x6b\x65\x5f\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x57\x48\x45\x52\x45\x20\x75\x73\x65\x72\x6b\x61\x6e\x69\x20\x3d\x20$shonuid
								 \x20\x4f\x52\x44\x45\x52\x20\x42\x59\x20\x73\x68\x6f\x6e\x75\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x6b\x61\x6e\x69\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x68\x6f\x64\x69\x6b\x65\x5f\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x57\x48\x45\x52\x45\x20\x75\x73\x65\x72\x6b\x61\x6e\x69\x20\x3d\x20$shonuid";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 14){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x69\x64\x2c\x20\x73\x74\x75\x72\x67\x69\x73\x2c\x20\x74\x69\x6d\x65\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x65\x67\x72\x61\x68\x63\x65\x72\x5f\x73\x6f\x6e\x75\x62\x20\x57\x48\x45\x52\x45\x20\x64\x72\x20\x3d\x20$shonuid
								 \x20\x4f\x52\x44\x45\x52\x20\x42\x59\x20\x74\x69\x6d\x65\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x69\x64\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x65\x67\x72\x61\x68\x63\x65\x72\x5f\x73\x6f\x6e\x75\x62\x20\x57\x48\x45\x52\x45\x20\x64\x72\x20\x3d\x20$shonuid";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
						}
						else{
							if($type == -1){
								$samasye = "SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  \x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\x29\x20\x3d\x20date('".$date."')
								  UNION ALL
								  \x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\x29\x20\x3d\x20date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  \x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x64\x72\x65\x69\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\x29\x20\x3d\x20date('".$date."')
								  UNION ALL
								  \x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x61\x69\x64\x75\x64\x69\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\x29\x20\x3d\x20date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."') 
								  UNION ALL
								  SELECT macau as parichaya, salary as ketebida, 'ds' as phalaphala, salary as sesabida, createdate as tiarikala 
								  FROM dailysalary WHERE userid = $shonuid AND date(createdate) = date('".$date."') 
								  UNION ALL
								  SELECT shonu as parichaya, motta as ketebida, 'rc' as phalaphala, motta as sesabida, dinankavannuracisi as tiarikala 
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = 1 AND date(dinankavannuracisi) = date('".$date."') 
								  UNION ALL
								  SELECT shonu as parichaya, motta as ketebida, 'wd' as phalaphala, motta as sesabida, dinankavannuracisi as tiarikala 
								  FROM hintegedukolli WHERE balakedara = $shonuid AND sthiti = 1 AND date(dinankavannuracisi) = date('".$date."') 
								  UNION ALL
								  SELECT kani as parichaya, price as ketebida, 're' as phalaphala, price as sesabida, shonu as tiarikala 
								  FROM hodike_balakedara WHERE userkani = $shonuid AND date(shonu) = date('".$date."') 
								  ORDER BY tiarikala DESC LIMIT $pageSize OFFSET $samatolana";							
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT parichaya
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT macau as parichaya
								  FROM dailysalary WHERE userid = $shonuid AND date(createdate) = date('".$date."')
								  UNION ALL
								  SELECT shonu as parichaya
								  FROM thevani WHERE balakedara = $shonuid AND sthiti = 1 AND date(dinankavannuracisi) = date('".$date."')
								  UNION ALL
								  SELECT shonu as parichaya
								  FROM hintegedukolli WHERE balakedara = $shonuid AND sthiti = 1 AND date(dinankavannuracisi) = date('".$date."')
								  UNION ALL
								  SELECT kani as parichaya
								  FROM hodike_balakedara WHERE userkani = $shonuid AND date(shonu) = date('".$date."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 0){
								$samasye = "SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  \x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x66\x75\x6e\x66\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  \x53\x45\x4c\x45\x43\x54\x20\x70\x61\x72\x69\x63\x68\x61\x79\x61\x2c\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x2c\x20\x70\x68\x61\x6c\x61\x70\x68\x61\x6c\x61\x2c\x20\x73\x65\x73\x61\x62\x69\x64\x61\x2c\x20\x74\x69\x61\x72\x69\x6b\x61\x6c\x61\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x3d\x20$shonuid AND date(tiarikala) = date('".$date."')
								  ORDER BY tiarikala DESC LIMIT $pageSize OFFSET $samatolana";							
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT parichaya
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND date(tiarikala) = date('".$date."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 1){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x6d\x61\x63\x61\x75\x2c\x20\x73\x61\x6c\x61\x72\x79\x2c\x20\x63\x72\x65\x61\x74\x65\x64\x61\x74\x65\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x64\x61\x69\x6c\x79\x73\x61\x6c\x61\x72\x79\x20\x57\x48\x45\x52\x45\x20\x75\x73\x65\x72\x69\x64\x20\x3d\x20$shonuid\x9\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x63\x72\x65\x61\x74\x65\x64\x61\x74\x65\x29\x20\x3d\x20\x64\x61\x74\x65\x28\x27".$date."\x27\x29\x9\x9\x9\x9\x9\x9\x9\x20\x20\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x4f\x52\x44\x45\x52\x20\x42\x59\x20\x6d\x61\x63\x61\x75\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x6d\x61\x63\x61\x75\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x64\x61\x69\x6c\x79\x73\x61\x6c\x61\x72\x79\x20\x57\x48\x45\x52\x45\x20\x75\x73\x65\x72\x69\x64\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x63\x72\x65\x61\x74\x65\x64\x61\x74\x65\x29\x20\x3d\x20\x64\x61\x74\x65\x28\x27".$date."\x27\x29";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 4){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x73\x68\x6f\x6e\x75\x2c\x20\x6d\x6f\x74\x74\x61\x2c\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x74\x68\x65\x76\x61\x6e\x69\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x73\x74\x68\x69\x74\x69\x20\x3d\x20\x31\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\x29\x20\x3d\x20date('".$date."')
								 \x20\x4f\x52\x44\x45\x52\x20\x42\x59\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x73\x68\x6f\x6e\x75\x2c\x20\x6d\x6f\x74\x74\x61\x2c\x20\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x74\x68\x65\x76\x61\x6e\x69\x20\x57\x48\x45\x52\x45\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x73\x74\x68\x69\x74\x69\x20\x3d\x20\x31\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x64\x69\x6e\x61\x6e\x6b\x61\x76\x61\x6e\x6e\x75\x72\x61\x63\x69\x73\x69\x29\x20\x3d\x20date('".$date."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 5){
								$samasye = "SELECT shonu, motta, dinankavannuracisi
								  FROM hintegedukolli WHERE balakedara = $shonuid AND sthiti = 1 AND date(dinankavannuracisi) = date('".$date."')
								  ORDER BY dinankavannuracisi DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT shonu, motta, dinankavannuracisi
								  FROM hintegedukolli WHERE balakedara = $shonuid AND sthiti = 1 AND date(dinankavannuracisi) = date('".$date."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 2){
								$samasye = "SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya, ketebida, phalaphala, sesabida, tiarikala
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  ORDER BY tiarikala DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT parichaya
								  FROM bajikattuttate WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_aidudi_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_drei WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_funf WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')
								  UNION ALL
								  SELECT parichaya
								  FROM bajikattuttate_kemuru_zehn WHERE byabaharkarta = $shonuid AND phalaphala = 'gagner' AND date(tiarikala) = date('".$date."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 3){
								$samasye = "SELECT kani, price, shonu
								  FROM hodike_balakedara WHERE userkani = $shonuid AND date(shonu) = date('".$date."')
								  ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "SELECT kani
								  FROM hodike_balakedara WHERE userkani = $shonuid AND date(shonu) = date('".$date."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
							else if($type == 14){
								$samasye = "\x53\x45\x4c\x45\x43\x54\x20\x69\x64\x2c\x20\x73\x74\x75\x72\x67\x69\x73\x2c\x20\x74\x69\x6d\x65\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x65\x67\x72\x61\x68\x63\x65\x72\x5f\x73\x6f\x6e\x75\x62\x20\x57\x48\x45\x52\x45\x20\x64\x72\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x74\x69\x6d\x65\x29\x20\x3d\x20date('".$date."')
								 \x20\x4f\x52\x44\x45\x52\x20\x42\x59\x20\x74\x69\x6d\x65\x20\x44\x45\x53\x43\x20\x4c\x49\x4d\x49\x54\x20$pageSize\x20\x4f\x46\x46\x53\x45\x54\x20$samatolana";
								$samasyephalitansa = $conn->query($samasye);
								
								$samasye_ondu = "\x53\x45\x4c\x45\x43\x54\x20\x69\x64\xd\xa\x9\x9\x9\x9\x9\x9\x9\x9\x20\x20\x46\x52\x4f\x4d\x20\x65\x67\x72\x61\x68\x63\x65\x72\x5f\x73\x6f\x6e\x75\x62\x20\x57\x48\x45\x52\x45\x20\x64\x72\x20\x3d\x20$shonuid\x20\x41\x4e\x44\x20\x64\x61\x74\x65\x28\x74\x69\x6d\x65\x29\x20\x3d\x20date('".$date."')";
								$samasyephalitansa_ondu = $conn->query($samasye_ondu);
								$samasyephalitansa_sankhye = mysqli_num_rows($samasyephalitansa_ondu);
							}
						}						
						
						if($type == -1 || $type == 0 || $type == 1 || $type == 4 || $type == 5 || $type == 2 || $type == 3 || $type == 14){
							if ($samasyephalitansa->num_rows > 0) {
								$i = 0;
								while ($row = $samasyephalitansa->fetch_assoc()) {
									if($type == 1){
										$data['list'][$i]['amount'] = $row['salary'];
										$data['list'][$i]['type'] = 1;
										$data['list'][$i]['typeName'] = 'Salary';
										$data['list'][$i]['typeNameCode'] = '8001';
										$data['list'][$i]['orderNum'] = $row['macau'];
										$data['list'][$i]['addTime'] = $row['createdate'];
										$data['list'][$i]['remark'] = '';
									}
									else if($type == 4){
										$data['list'][$i]['amount'] = $row['motta'];
										$data['list'][$i]['type'] = 4;
										$data['list'][$i]['typeName'] = 'Deposit';
										$data['list'][$i]['typeNameCode'] = '8004';
										$data['list'][$i]['orderNum'] = $row['shonu'];
										$data['list'][$i]['addTime'] = $row['dinankavannuracisi'];
										$data['list'][$i]['remark'] = '';
									}
									else if($type == 5){
										$data['list'][$i]['amount'] = $row['motta'];
										$data['list'][$i]['type'] = 5;
										$data['list'][$i]['typeName'] = 'Withdraw';
										$data['list'][$i]['typeNameCode'] = '8005';
										$data['list'][$i]['orderNum'] = $row['shonu'];
										$data['list'][$i]['addTime'] = $row['dinankavannuracisi'];
										$data['list'][$i]['remark'] = '';
									}
									else if($type == 2){
										$data['list'][$i]['amount'] = $row['sesabida'];
										$data['list'][$i]['type'] = 2;
										$data['list'][$i]['typeName'] = 'Jackpot increase';
										$data['list'][$i]['typeNameCode'] = '8002';
										$data['list'][$i]['orderNum'] = $row['parichaya'];
										$data['list'][$i]['addTime'] = $row['tiarikala'];
										$data['list'][$i]['remark'] = '';
									}
									else if($type == 3){
										$data['list'][$i]['amount'] = $row['price'];
										$data['list'][$i]['type'] = 3;
										$data['list'][$i]['typeName'] = 'Red Envelope';
										$data['list'][$i]['typeNameCode'] = '8003';
										$data['list'][$i]['orderNum'] = $row['kani'];
										$data['list'][$i]['addTime'] = $row['shonu'];
										$data['list'][$i]['remark'] = '';
									}
									else if($type == 14){
										$data['list'][$i]['amount'] = $row['sturgis'] == 1 ? 60 : ($row['sturgis'] == 2 ? 20 : ($row['sturgis'] == 3 ? 150 : ($row['sturgis'] == 4 ? 300 : 0)));
										$data['list'][$i]['amount'] = $row['sturgis'] == 5 ? 600 : ($row['sturgis'] == 6 ? 2000 : ($row['sturgis'] == 7 ? 5000 : ($row['sturgis'] == 8 ? 10000 : $data['list'][$i]['amount']))); 
										$data['list'][$i]['type'] = 14;
										$data['list'][$i]['typeName'] = 'First deposit bonus';
										$data['list'][$i]['typeNameCode'] = '8014';
										$data['list'][$i]['orderNum'] = $row['id'];
										$data['list'][$i]['addTime'] = $row['time'];
										$data['list'][$i]['remark'] = '';
									}
									else{
										if($row['phalaphala'] == 'gagner'){
											$data['list'][$i]['amount'] = $row['sesabida'];
											$data['list'][$i]['type'] = 2;
											$data['list'][$i]['typeName'] = 'Jackpot increase';
											$data['list'][$i]['typeNameCode'] = '8002';
											$data['list'][$i]['orderNum'] = $row['parichaya'];
											$data['list'][$i]['addTime'] = $row['tiarikala'];
											$data['list'][$i]['remark'] = '';
										}
										else if($row['phalaphala'] == 'ds'){
											$data['list'][$i]['amount'] = $row['ketebida'];
											$data['list'][$i]['type'] = 1;
											$data['list'][$i]['typeName'] = 'Salary';
											$data['list'][$i]['typeNameCode'] = '8001';
											$data['list'][$i]['orderNum'] = $row['parichaya'];
											$data['list'][$i]['addTime'] = $row['tiarikala'];
											$data['list'][$i]['remark'] = '';
										}
										else if($row['phalaphala'] == 'rc'){
											$data['list'][$i]['amount'] = $row['ketebida'];
											$data['list'][$i]['type'] = 4;
											$data['list'][$i]['typeName'] = 'Deposit';
											$data['list'][$i]['typeNameCode'] = '8004';
											$data['list'][$i]['orderNum'] = $row['parichaya'];
											$data['list'][$i]['addTime'] = $row['tiarikala'];
											$data['list'][$i]['remark'] = '';
										}
										else if($row['phalaphala'] == 'wd'){
											$data['list'][$i]['amount'] = $row['ketebida'];
											$data['list'][$i]['type'] = 5;
											$data['list'][$i]['typeName'] = 'Withdraw';
											$data['list'][$i]['typeNameCode'] = '8005';
											$data['list'][$i]['orderNum'] = $row['parichaya'];
											$data['list'][$i]['addTime'] = $row['tiarikala'];
											$data['list'][$i]['remark'] = '';
										}
										else if($row['phalaphala'] == 're'){
											$data['list'][$i]['amount'] = $row['ketebida'];
											$data['list'][$i]['type'] = 3;
											$data['list'][$i]['typeName'] = 'Red Envelope';
											$data['list'][$i]['typeNameCode'] = '8003';
											$data['list'][$i]['orderNum'] = $row['parichaya'];
											$data['list'][$i]['addTime'] = $row['tiarikala'];
											$data['list'][$i]['remark'] = '';
										}
										else{
											$data['list'][$i]['amount'] = $row['ketebida'];
											$data['list'][$i]['type'] = 0;
											$data['list'][$i]['typeName'] = 'Bet amount reduced';
											$data['list'][$i]['typeNameCode'] = '8000';
											$data['list'][$i]['orderNum'] = $row['parichaya'];
											$data['list'][$i]['addTime'] = $row['tiarikala'];
											$data['list'][$i]['remark'] = '0';
										}
									}								
									$i++;
								}
								$data['pageNo'] = (int)$pageNo;
								$data['totalPage'] = ceil($samasyephalitansa_sankhye/10);
								$data['totalCount'] = $samasyephalitansa_sankhye;							
							}
							else{
								$data['list'] = [];
								$data['pageNo'] = (int)$pageNo;
								$data['totalPage'] = 0;
								$data['totalCount'] = 0;
							}
						}
						else{
							$data['list'] = [];
							$data['pageNo'] = (int)$pageNo;
							$data['totalPage'] = 0;
							$data['totalCount'] = 0;
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
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
						http_response_code(200);
						echo '{
						  "data": {
							"rebateratelist": [
							  {
								"type": 1,
								"rebate_Lv": 0,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.600000"
								  },
								  {
									"levelId": 2,
									"amount": "0.180000"
								  },
								  {
									"levelId": 3,
									"amount": "0.054000"
								  },
								  {
									"levelId": 4,
									"amount": "0.016200"
								  },
								  {
									"levelId": 5,
									"amount": "0.004860"
								  },
								  {
									"levelId": 6,
									"amount": "0.001458"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 1,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.700000"
								  },
								  {
									"levelId": 2,
									"amount": "0.245000"
								  },
								  {
									"levelId": 3,
									"amount": "0.085750"
								  },
								  {
									"levelId": 4,
									"amount": "0.030012"
								  },
								  {
									"levelId": 5,
									"amount": "0.010504"
								  },
								  {
									"levelId": 6,
									"amount": "0.003677"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 2,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.750000"
								  },
								  {
									"levelId": 2,
									"amount": "0.281250"
								  },
								  {
									"levelId": 3,
									"amount": "0.105469"
								  },
								  {
									"levelId": 4,
									"amount": "0.039551"
								  },
								  {
									"levelId": 5,
									"amount": "0.014832"
								  },
								  {
									"levelId": 6,
									"amount": "0.005562"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 3,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.800000"
								  },
								  {
									"levelId": 2,
									"amount": "0.320000"
								  },
								  {
									"levelId": 3,
									"amount": "0.128000"
								  },
								  {
									"levelId": 4,
									"amount": "0.051200"
								  },
								  {
									"levelId": 5,
									"amount": "0.020480"
								  },
								  {
									"levelId": 6,
									"amount": "0.008192"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 4,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.850000"
								  },
								  {
									"levelId": 2,
									"amount": "0.361250"
								  },
								  {
									"levelId": 3,
									"amount": "0.153531"
								  },
								  {
									"levelId": 4,
									"amount": "0.065251"
								  },
								  {
									"levelId": 5,
									"amount": "0.027732"
								  },
								  {
									"levelId": 6,
									"amount": "0.011786"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 5,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.900000"
								  },
								  {
									"levelId": 2,
									"amount": "0.405000"
								  },
								  {
									"levelId": 3,
									"amount": "0.182250"
								  },
								  {
									"levelId": 4,
									"amount": "0.082012"
								  },
								  {
									"levelId": 5,
									"amount": "0.036906"
								  },
								  {
									"levelId": 6,
									"amount": "0.016608"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 6,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "1.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.500000"
								  },
								  {
									"levelId": 3,
									"amount": "0.250000"
								  },
								  {
									"levelId": 4,
									"amount": "0.125000"
								  },
								  {
									"levelId": 5,
									"amount": "0.062500"
								  },
								  {
									"levelId": 6,
									"amount": "0.031250"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 7,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "1.100000"
								  },
								  {
									"levelId": 2,
									"amount": "0.605000"
								  },
								  {
									"levelId": 3,
									"amount": "0.332750"
								  },
								  {
									"levelId": 4,
									"amount": "0.183013"
								  },
								  {
									"levelId": 5,
									"amount": "0.100657"
								  },
								  {
									"levelId": 6,
									"amount": "0.055361"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 8,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "1.200000"
								  },
								  {
									"levelId": 2,
									"amount": "0.720000"
								  },
								  {
									"levelId": 3,
									"amount": "0.432000"
								  },
								  {
									"levelId": 4,
									"amount": "0.259200"
								  },
								  {
									"levelId": 5,
									"amount": "0.155520"
								  },
								  {
									"levelId": 6,
									"amount": "0.093312"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 9,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "1.300000"
								  },
								  {
									"levelId": 2,
									"amount": "0.845000"
								  },
								  {
									"levelId": 3,
									"amount": "0.549250"
								  },
								  {
									"levelId": 4,
									"amount": "0.357013"
								  },
								  {
									"levelId": 5,
									"amount": "0.232058"
								  },
								  {
									"levelId": 6,
									"amount": "0.150838"
								  }
								]
							  },
							  {
								"type": 1,
								"rebate_Lv": 10,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "1.400000"
								  },
								  {
									"levelId": 2,
									"amount": "0.980000"
								  },
								  {
									"levelId": 3,
									"amount": "0.686000"
								  },
								  {
									"levelId": 4,
									"amount": "0.480200"
								  },
								  {
									"levelId": 5,
									"amount": "0.336140"
								  },
								  {
									"levelId": 6,
									"amount": "0.235298"
								  }
								]
							  }
							],
							"dianzilist": [
							  {
								"type": 2,
								"rebate_Lv": 0,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.300000"
								  },
								  {
									"levelId": 2,
									"amount": "0.090000"
								  },
								  {
									"levelId": 3,
									"amount": "0.027000"
								  },
								  {
									"levelId": 4,
									"amount": "0.008100"
								  },
								  {
									"levelId": 5,
									"amount": "0.002430"
								  },
								  {
									"levelId": 6,
									"amount": "0.000729"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 1,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.350000"
								  },
								  {
									"levelId": 2,
									"amount": "0.122500"
								  },
								  {
									"levelId": 3,
									"amount": "0.042875"
								  },
								  {
									"levelId": 4,
									"amount": "0.015006"
								  },
								  {
									"levelId": 5,
									"amount": "0.005252"
								  },
								  {
									"levelId": 6,
									"amount": "0.001838"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 2,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.375000"
								  },
								  {
									"levelId": 2,
									"amount": "0.140625"
								  },
								  {
									"levelId": 3,
									"amount": "0.052734"
								  },
								  {
									"levelId": 4,
									"amount": "0.019775"
								  },
								  {
									"levelId": 5,
									"amount": "0.007416"
								  },
								  {
									"levelId": 6,
									"amount": "0.002781"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 3,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.400000"
								  },
								  {
									"levelId": 2,
									"amount": "0.160000"
								  },
								  {
									"levelId": 3,
									"amount": "0.064000"
								  },
								  {
									"levelId": 4,
									"amount": "0.025600"
								  },
								  {
									"levelId": 5,
									"amount": "0.010240"
								  },
								  {
									"levelId": 6,
									"amount": "0.004096"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 4,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.425000"
								  },
								  {
									"levelId": 2,
									"amount": "0.180625"
								  },
								  {
									"levelId": 3,
									"amount": "0.076766"
								  },
								  {
									"levelId": 4,
									"amount": "0.032625"
								  },
								  {
									"levelId": 5,
									"amount": "0.013866"
								  },
								  {
									"levelId": 6,
									"amount": "0.005893"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 5,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.450000"
								  },
								  {
									"levelId": 2,
									"amount": "0.202500"
								  },
								  {
									"levelId": 3,
									"amount": "0.091125"
								  },
								  {
									"levelId": 4,
									"amount": "0.041006"
								  },
								  {
									"levelId": 5,
									"amount": "0.018453"
								  },
								  {
									"levelId": 6,
									"amount": "0.008304"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 6,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.500000"
								  },
								  {
									"levelId": 2,
									"amount": "0.250000"
								  },
								  {
									"levelId": 3,
									"amount": "0.125000"
								  },
								  {
									"levelId": 4,
									"amount": "0.062500"
								  },
								  {
									"levelId": 5,
									"amount": "0.031250"
								  },
								  {
									"levelId": 6,
									"amount": "0.015625"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 7,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.550000"
								  },
								  {
									"levelId": 2,
									"amount": "0.302500"
								  },
								  {
									"levelId": 3,
									"amount": "0.166375"
								  },
								  {
									"levelId": 4,
									"amount": "0.091506"
								  },
								  {
									"levelId": 5,
									"amount": "0.050328"
								  },
								  {
									"levelId": 6,
									"amount": "0.027681"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 8,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.600000"
								  },
								  {
									"levelId": 2,
									"amount": "0.360000"
								  },
								  {
									"levelId": 3,
									"amount": "0.216000"
								  },
								  {
									"levelId": 4,
									"amount": "0.129600"
								  },
								  {
									"levelId": 5,
									"amount": "0.077760"
								  },
								  {
									"levelId": 6,
									"amount": "0.046656"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 9,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.650000"
								  },
								  {
									"levelId": 2,
									"amount": "0.422500"
								  },
								  {
									"levelId": 3,
									"amount": "0.274625"
								  },
								  {
									"levelId": 4,
									"amount": "0.178506"
								  },
								  {
									"levelId": 5,
									"amount": "0.116029"
								  },
								  {
									"levelId": 6,
									"amount": "0.075419"
								  }
								]
							  },
							  {
								"type": 2,
								"rebate_Lv": 10,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.700000"
								  },
								  {
									"levelId": 2,
									"amount": "0.490000"
								  },
								  {
									"levelId": 3,
									"amount": "0.343000"
								  },
								  {
									"levelId": 4,
									"amount": "0.240100"
								  },
								  {
									"levelId": 5,
									"amount": "0.168070"
								  },
								  {
									"levelId": 6,
									"amount": "0.117649"
								  }
								]
							  }
							],
							"shixunlist": [
							  {
								"type": 3,
								"rebate_Lv": 0,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.300000"
								  },
								  {
									"levelId": 2,
									"amount": "0.090000"
								  },
								  {
									"levelId": 3,
									"amount": "0.027000"
								  },
								  {
									"levelId": 4,
									"amount": "0.008100"
								  },
								  {
									"levelId": 5,
									"amount": "0.002430"
								  },
								  {
									"levelId": 6,
									"amount": "0.000729"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 1,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.350000"
								  },
								  {
									"levelId": 2,
									"amount": "0.122500"
								  },
								  {
									"levelId": 3,
									"amount": "0.042875"
								  },
								  {
									"levelId": 4,
									"amount": "0.015006"
								  },
								  {
									"levelId": 5,
									"amount": "0.005252"
								  },
								  {
									"levelId": 6,
									"amount": "0.001838"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 2,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.375000"
								  },
								  {
									"levelId": 2,
									"amount": "0.140625"
								  },
								  {
									"levelId": 3,
									"amount": "0.052734"
								  },
								  {
									"levelId": 4,
									"amount": "0.019775"
								  },
								  {
									"levelId": 5,
									"amount": "0.007416"
								  },
								  {
									"levelId": 6,
									"amount": "0.002781"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 3,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.400000"
								  },
								  {
									"levelId": 2,
									"amount": "0.160000"
								  },
								  {
									"levelId": 3,
									"amount": "0.064000"
								  },
								  {
									"levelId": 4,
									"amount": "0.025600"
								  },
								  {
									"levelId": 5,
									"amount": "0.010240"
								  },
								  {
									"levelId": 6,
									"amount": "0.004096"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 4,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.425000"
								  },
								  {
									"levelId": 2,
									"amount": "0.180625"
								  },
								  {
									"levelId": 3,
									"amount": "0.076766"
								  },
								  {
									"levelId": 4,
									"amount": "0.032625"
								  },
								  {
									"levelId": 5,
									"amount": "0.013866"
								  },
								  {
									"levelId": 6,
									"amount": "0.005893"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 5,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.450000"
								  },
								  {
									"levelId": 2,
									"amount": "0.202500"
								  },
								  {
									"levelId": 3,
									"amount": "0.091125"
								  },
								  {
									"levelId": 4,
									"amount": "0.041006"
								  },
								  {
									"levelId": 5,
									"amount": "0.018453"
								  },
								  {
									"levelId": 6,
									"amount": "0.008304"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 6,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.500000"
								  },
								  {
									"levelId": 2,
									"amount": "0.250000"
								  },
								  {
									"levelId": 3,
									"amount": "0.125000"
								  },
								  {
									"levelId": 4,
									"amount": "0.062500"
								  },
								  {
									"levelId": 5,
									"amount": "0.031250"
								  },
								  {
									"levelId": 6,
									"amount": "0.015625"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 7,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.550000"
								  },
								  {
									"levelId": 2,
									"amount": "0.302500"
								  },
								  {
									"levelId": 3,
									"amount": "0.166375"
								  },
								  {
									"levelId": 4,
									"amount": "0.091506"
								  },
								  {
									"levelId": 5,
									"amount": "0.050328"
								  },
								  {
									"levelId": 6,
									"amount": "0.027681"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 8,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.600000"
								  },
								  {
									"levelId": 2,
									"amount": "0.360000"
								  },
								  {
									"levelId": 3,
									"amount": "0.216000"
								  },
								  {
									"levelId": 4,
									"amount": "0.129600"
								  },
								  {
									"levelId": 5,
									"amount": "0.077760"
								  },
								  {
									"levelId": 6,
									"amount": "0.046656"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 9,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.650000"
								  },
								  {
									"levelId": 2,
									"amount": "0.422500"
								  },
								  {
									"levelId": 3,
									"amount": "0.274625"
								  },
								  {
									"levelId": 4,
									"amount": "0.178506"
								  },
								  {
									"levelId": 5,
									"amount": "0.116029"
								  },
								  {
									"levelId": 6,
									"amount": "0.075419"
								  }
								]
							  },
							  {
								"type": 3,
								"rebate_Lv": 10,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.700000"
								  },
								  {
									"levelId": 2,
									"amount": "0.490000"
								  },
								  {
									"levelId": 3,
									"amount": "0.343000"
								  },
								  {
									"levelId": 4,
									"amount": "0.240100"
								  },
								  {
									"levelId": 5,
									"amount": "0.168070"
								  },
								  {
									"levelId": 6,
									"amount": "0.117649"
								  }
								]
							  }
							],
							"tiyulist": [
							  {
								"type": 4,
								"rebate_Lv": 0,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.300000"
								  },
								  {
									"levelId": 2,
									"amount": "0.090000"
								  },
								  {
									"levelId": 3,
									"amount": "0.027000"
								  },
								  {
									"levelId": 4,
									"amount": "0.008100"
								  },
								  {
									"levelId": 5,
									"amount": "0.002430"
								  },
								  {
									"levelId": 6,
									"amount": "0.000729"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 1,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.350000"
								  },
								  {
									"levelId": 2,
									"amount": "0.122500"
								  },
								  {
									"levelId": 3,
									"amount": "0.042875"
								  },
								  {
									"levelId": 4,
									"amount": "0.015006"
								  },
								  {
									"levelId": 5,
									"amount": "0.005252"
								  },
								  {
									"levelId": 6,
									"amount": "0.001838"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 2,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.375000"
								  },
								  {
									"levelId": 2,
									"amount": "0.140625"
								  },
								  {
									"levelId": 3,
									"amount": "0.052734"
								  },
								  {
									"levelId": 4,
									"amount": "0.019775"
								  },
								  {
									"levelId": 5,
									"amount": "0.007416"
								  },
								  {
									"levelId": 6,
									"amount": "0.002781"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 3,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.400000"
								  },
								  {
									"levelId": 2,
									"amount": "0.160000"
								  },
								  {
									"levelId": 3,
									"amount": "0.064000"
								  },
								  {
									"levelId": 4,
									"amount": "0.025600"
								  },
								  {
									"levelId": 5,
									"amount": "0.010240"
								  },
								  {
									"levelId": 6,
									"amount": "0.004096"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 4,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.425000"
								  },
								  {
									"levelId": 2,
									"amount": "0.180625"
								  },
								  {
									"levelId": 3,
									"amount": "0.076766"
								  },
								  {
									"levelId": 4,
									"amount": "0.032625"
								  },
								  {
									"levelId": 5,
									"amount": "0.013866"
								  },
								  {
									"levelId": 6,
									"amount": "0.005893"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 5,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.450000"
								  },
								  {
									"levelId": 2,
									"amount": "0.202500"
								  },
								  {
									"levelId": 3,
									"amount": "0.091125"
								  },
								  {
									"levelId": 4,
									"amount": "0.041006"
								  },
								  {
									"levelId": 5,
									"amount": "0.018453"
								  },
								  {
									"levelId": 6,
									"amount": "0.008304"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 6,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.500000"
								  },
								  {
									"levelId": 2,
									"amount": "0.250000"
								  },
								  {
									"levelId": 3,
									"amount": "0.125000"
								  },
								  {
									"levelId": 4,
									"amount": "0.062500"
								  },
								  {
									"levelId": 5,
									"amount": "0.031250"
								  },
								  {
									"levelId": 6,
									"amount": "0.015625"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 7,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.550000"
								  },
								  {
									"levelId": 2,
									"amount": "0.302500"
								  },
								  {
									"levelId": 3,
									"amount": "0.166375"
								  },
								  {
									"levelId": 4,
									"amount": "0.091506"
								  },
								  {
									"levelId": 5,
									"amount": "0.050328"
								  },
								  {
									"levelId": 6,
									"amount": "0.027681"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 8,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.600000"
								  },
								  {
									"levelId": 2,
									"amount": "0.360000"
								  },
								  {
									"levelId": 3,
									"amount": "0.216000"
								  },
								  {
									"levelId": 4,
									"amount": "0.129600"
								  },
								  {
									"levelId": 5,
									"amount": "0.077760"
								  },
								  {
									"levelId": 6,
									"amount": "0.046656"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 9,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.650000"
								  },
								  {
									"levelId": 2,
									"amount": "0.422500"
								  },
								  {
									"levelId": 3,
									"amount": "0.274625"
								  },
								  {
									"levelId": 4,
									"amount": "0.178506"
								  },
								  {
									"levelId": 5,
									"amount": "0.116029"
								  },
								  {
									"levelId": 6,
									"amount": "0.075419"
								  }
								]
							  },
							  {
								"type": 4,
								"rebate_Lv": 10,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.700000"
								  },
								  {
									"levelId": 2,
									"amount": "0.490000"
								  },
								  {
									"levelId": 3,
									"amount": "0.343000"
								  },
								  {
									"levelId": 4,
									"amount": "0.240100"
								  },
								  {
									"levelId": 5,
									"amount": "0.168070"
								  },
								  {
									"levelId": 6,
									"amount": "0.117649"
								  }
								]
							  }
							],
							"xiaoyouxilist": [
							  {
								"type": 5,
								"rebate_Lv": 0,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 1,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 2,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 3,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 4,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 5,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 6,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 7,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 8,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 9,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  },
							  {
								"type": 5,
								"rebate_Lv": 10,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.000000"
								  },
								  {
									"levelId": 2,
									"amount": "0.000000"
								  },
								  {
									"levelId": 3,
									"amount": "0.000000"
								  },
								  {
									"levelId": 4,
									"amount": "0.000000"
								  },
								  {
									"levelId": 5,
									"amount": "0.000000"
								  },
								  {
									"levelId": 6,
									"amount": "0.000000"
								  }
								]
							  }
							],
							"chesslist": [
							  {
								"type": 6,
								"rebate_Lv": 0,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.300000"
								  },
								  {
									"levelId": 2,
									"amount": "0.090000"
								  },
								  {
									"levelId": 3,
									"amount": "0.027000"
								  },
								  {
									"levelId": 4,
									"amount": "0.008100"
								  },
								  {
									"levelId": 5,
									"amount": "0.002430"
								  },
								  {
									"levelId": 6,
									"amount": "0.000729"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 1,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.350000"
								  },
								  {
									"levelId": 2,
									"amount": "0.122500"
								  },
								  {
									"levelId": 3,
									"amount": "0.042875"
								  },
								  {
									"levelId": 4,
									"amount": "0.015006"
								  },
								  {
									"levelId": 5,
									"amount": "0.005252"
								  },
								  {
									"levelId": 6,
									"amount": "0.001838"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 2,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.375000"
								  },
								  {
									"levelId": 2,
									"amount": "0.140625"
								  },
								  {
									"levelId": 3,
									"amount": "0.052734"
								  },
								  {
									"levelId": 4,
									"amount": "0.019775"
								  },
								  {
									"levelId": 5,
									"amount": "0.007416"
								  },
								  {
									"levelId": 6,
									"amount": "0.002781"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 3,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.400000"
								  },
								  {
									"levelId": 2,
									"amount": "0.160000"
								  },
								  {
									"levelId": 3,
									"amount": "0.064000"
								  },
								  {
									"levelId": 4,
									"amount": "0.025600"
								  },
								  {
									"levelId": 5,
									"amount": "0.010240"
								  },
								  {
									"levelId": 6,
									"amount": "0.004096"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 4,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.425000"
								  },
								  {
									"levelId": 2,
									"amount": "0.180625"
								  },
								  {
									"levelId": 3,
									"amount": "0.076766"
								  },
								  {
									"levelId": 4,
									"amount": "0.032625"
								  },
								  {
									"levelId": 5,
									"amount": "0.013866"
								  },
								  {
									"levelId": 6,
									"amount": "0.005893"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 5,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.450000"
								  },
								  {
									"levelId": 2,
									"amount": "0.202500"
								  },
								  {
									"levelId": 3,
									"amount": "0.091125"
								  },
								  {
									"levelId": 4,
									"amount": "0.041006"
								  },
								  {
									"levelId": 5,
									"amount": "0.018453"
								  },
								  {
									"levelId": 6,
									"amount": "0.008304"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 6,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.500000"
								  },
								  {
									"levelId": 2,
									"amount": "0.250000"
								  },
								  {
									"levelId": 3,
									"amount": "0.125000"
								  },
								  {
									"levelId": 4,
									"amount": "0.062500"
								  },
								  {
									"levelId": 5,
									"amount": "0.031250"
								  },
								  {
									"levelId": 6,
									"amount": "0.015625"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 7,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.550000"
								  },
								  {
									"levelId": 2,
									"amount": "0.302500"
								  },
								  {
									"levelId": 3,
									"amount": "0.166375"
								  },
								  {
									"levelId": 4,
									"amount": "0.091506"
								  },
								  {
									"levelId": 5,
									"amount": "0.050328"
								  },
								  {
									"levelId": 6,
									"amount": "0.027681"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 8,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.600000"
								  },
								  {
									"levelId": 2,
									"amount": "0.360000"
								  },
								  {
									"levelId": 3,
									"amount": "0.216000"
								  },
								  {
									"levelId": 4,
									"amount": "0.129600"
								  },
								  {
									"levelId": 5,
									"amount": "0.077760"
								  },
								  {
									"levelId": 6,
									"amount": "0.046656"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 9,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.650000"
								  },
								  {
									"levelId": 2,
									"amount": "0.422500"
								  },
								  {
									"levelId": 3,
									"amount": "0.274625"
								  },
								  {
									"levelId": 4,
									"amount": "0.178506"
								  },
								  {
									"levelId": 5,
									"amount": "0.116029"
								  },
								  {
									"levelId": 6,
									"amount": "0.075419"
								  }
								]
							  },
							  {
								"type": 6,
								"rebate_Lv": 10,
								"rebateLevels": [
								  {
									"levelId": 1,
									"amount": "0.700000"
								  },
								  {
									"levelId": 2,
									"amount": "0.490000"
								  },
								  {
									"levelId": 3,
									"amount": "0.343000"
								  },
								  {
									"levelId": 4,
									"amount": "0.240100"
								  },
								  {
									"levelId": 5,
									"amount": "0.168070"
								  },
								  {
									"levelId": 6,
									"amount": "0.117649"
								  }
								]
							  }
							]
						  },
						  "code": 0,
						  "msg": "Succeed",
						  "msgCode": 0,
						  "serviceNowTime": "$shnunc"
						}';

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
<?php 
	include "../../conn.php";

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
				http_response_code(200);
				echo '{
				  "data": {
					"dataList": [
					  {
						"type": "WM_Video",
						"userPhoto": "4",
						"nickName": "MemberCZPSDOJU",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 20:54:25",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306234023867q.png"
					  },
					  {
						"type": "WM_Video",
						"userPhoto": "5",
						"nickName": "MemberDMRTJKJR",
						"betAmount": 1000,
						"amount": 2000,
						"winTime": "2024-05-07 20:23:56",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306234023867q.png"
					  },
					  {
						"type": "WM_Video",
						"userPhoto": "10",
						"nickName": "MemberZSQIBPLJ",
						"betAmount": 200,
						"amount": 400,
						"winTime": "2024-05-07 19:26:33",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306234023867q.png"
					  },
					  {
						"type": "WM_Video",
						"userPhoto": "2",
						"nickName": "MemberSOGTRHXM",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 19:25:03",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306234023867q.png"
					  },
					  {
						"type": "WM_Video",
						"userPhoto": "5",
						"nickName": "MemberWWROOCNX",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 19:23:32",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306234023867q.png"
					  },
					  {
						"type": "WM_Video",
						"userPhoto": "11",
						"nickName": "MemberXHKGDDOP",
						"betAmount": 400,
						"amount": 800,
						"winTime": "2024-05-07 19:18:01",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306234023867q.png"
					  },
					  {
						"type": "WM_Video",
						"userPhoto": "6",
						"nickName": "MemberQWWBUWIL",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 19:14:53",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306234023867q.png"
					  },
					  {
						"type": "1",
						"userPhoto": "16",
						"nickName": "MemberTMNDPGTO",
						"betAmount": 150,
						"amount": 294,
						"winTime": "2024-05-07 18:31:59",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "19",
						"nickName": "MemberTFCJNLQO",
						"betAmount": 500,
						"amount": 980,
						"winTime": "2024-05-07 18:31:59",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "16",
						"nickName": "MemberURBVAAZK",
						"betAmount": 200,
						"amount": 392,
						"winTime": "2024-05-07 18:31:59",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "14",
						"nickName": "MemberGVVPBLYE",
						"betAmount": 100,
						"amount": 196,
						"winTime": "2024-05-07 18:31:59",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "19",
						"nickName": "MemberIRXZYVFF",
						"betAmount": 100,
						"amount": 196,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "10",
						"nickName": "MemberGXCMABJS",
						"betAmount": 200,
						"amount": 392,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "2",
						"nickName": "MemberTEFCRQFH",
						"betAmount": 1000,
						"amount": 1960,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "8",
						"nickName": "MemberGBKSMAKA",
						"betAmount": 300,
						"amount": 588,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "8",
						"nickName": "MemberWGICDWJK",
						"betAmount": 500,
						"amount": 980,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "7",
						"nickName": "MemberQMIUZJZX",
						"betAmount": 2000,
						"amount": 3920,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "17",
						"nickName": "MemberWEDKQWVF",
						"betAmount": 200,
						"amount": 392,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "16",
						"nickName": "MemberSHEXZIXO",
						"betAmount": 120,
						"amount": 235.2,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "15",
						"nickName": "MemberHRTVBWJN",
						"betAmount": 100,
						"amount": 882,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "18",
						"nickName": "MemberWDYRVUAI",
						"betAmount": 200,
						"amount": 392,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "12",
						"nickName": "MemberWXFFDYBR",
						"betAmount": 1000,
						"amount": 1960,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "13",
						"nickName": "MemberAZWNYQZS",
						"betAmount": 1000,
						"amount": 1960,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "3",
						"nickName": "MemberIISRJGXA",
						"betAmount": 6000,
						"amount": 11760,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "11",
						"nickName": "MemberDRLCIXBQ",
						"betAmount": 200,
						"amount": 392,
						"winTime": "2024-05-07 18:31:58",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "12",
						"nickName": "MemberWEWIXEVH",
						"betAmount": 200,
						"amount": 392,
						"winTime": "2024-05-07 18:31:57",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "1",
						"userPhoto": "17",
						"nickName": "MemberRQKZMNZN",
						"betAmount": 100,
						"amount": 196,
						"winTime": "2024-05-07 18:31:57",
						"showType": 11,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194458iceq.png"
					  },
					  {
						"type": "9",
						"userPhoto": "4",
						"nickName": "MemberXHUYLLBS",
						"betAmount": 490,
						"amount": 940.8,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "10",
						"nickName": "MemberKSJUPUSC",
						"betAmount": 29.4,
						"amount": 169.34,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "10",
						"nickName": "MemberOPVRDDDZ",
						"betAmount": 245,
						"amount": 470.4,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "10",
						"nickName": "MemberGJWACTCM",
						"betAmount": 58.8,
						"amount": 112.9,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "13",
						"nickName": "MemberHIHJNWUT",
						"betAmount": 4.9,
						"amount": 169.34,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "5",
						"nickName": "MemberJRWXDBJT",
						"betAmount": 98,
						"amount": 188.16,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "5",
						"userPhoto": "14",
						"nickName": "MemberGNEMLHYU",
						"betAmount": 60,
						"amount": 116.42,
						"winTime": "2024-05-07 18:31:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "9",
						"userPhoto": "14",
						"nickName": "MemberQSWNXQJV",
						"betAmount": 4.9,
						"amount": 169.34,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "16",
						"nickName": "MemberAZZRKVGZ",
						"betAmount": 98,
						"amount": 188.16,
						"winTime": "2024-05-07 18:31:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "5",
						"userPhoto": "8",
						"nickName": "MemberFOEYEZLT",
						"betAmount": 170,
						"amount": 329.87,
						"winTime": "2024-05-07 18:31:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "4",
						"nickName": "MemberPKLNLYZK",
						"betAmount": 500,
						"amount": 606.25,
						"winTime": "2024-05-07 18:31:51",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "8",
						"nickName": "MemberXRCMCUCV",
						"betAmount": 500,
						"amount": 606.25,
						"winTime": "2024-05-07 18:31:49",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "8",
						"nickName": "MemberIJMTIOPD",
						"betAmount": 500,
						"amount": 765.78,
						"winTime": "2024-05-07 18:31:43",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "14",
						"nickName": "MemberQUELYIVX",
						"betAmount": 300,
						"amount": 390,
						"winTime": "2024-05-07 18:31:38",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "3",
						"nickName": "MemberTJBCJITE",
						"betAmount": 120,
						"amount": 162,
						"winTime": "2024-05-07 18:31:38",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "4",
						"nickName": "MemberOEJHWIIQ",
						"betAmount": 100,
						"amount": 124,
						"winTime": "2024-05-07 18:31:37",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "11",
						"nickName": "MemberNRDQBXQR",
						"betAmount": 250,
						"amount": 312.5,
						"winTime": "2024-05-07 18:31:37",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "18",
						"nickName": "MemberUGOOZYZQ",
						"betAmount": 300,
						"amount": 369,
						"winTime": "2024-05-07 18:31:37",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "4",
						"nickName": "MemberBHDJODUH",
						"betAmount": 100,
						"amount": 127,
						"winTime": "2024-05-07 18:31:37",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "8",
						"nickName": "MemberODCUNVDI",
						"betAmount": 200,
						"amount": 244,
						"winTime": "2024-05-07 18:31:37",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "10",
						"nickName": "MemberVUTWYZPO",
						"betAmount": 100,
						"amount": 127,
						"winTime": "2024-05-07 18:31:37",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "14",
						"nickName": "MemberMXGOQEJM",
						"betAmount": 100,
						"amount": 108,
						"winTime": "2024-05-07 18:31:36",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "19",
						"nickName": "MemberSCTZWMZQ",
						"betAmount": 100,
						"amount": 110,
						"winTime": "2024-05-07 18:31:36",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "3",
						"nickName": "MemberYELPIZQS",
						"betAmount": 500,
						"amount": 970,
						"winTime": "2024-05-07 18:31:34",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "17",
						"nickName": "MemberLGNTFCSK",
						"betAmount": 50,
						"amount": 106.98,
						"winTime": "2024-05-07 18:31:33",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "12",
						"nickName": "MemberKPMFFKIP",
						"betAmount": 50,
						"amount": 166.2,
						"winTime": "2024-05-07 18:31:31",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "12",
						"nickName": "MemberOXXKINBI",
						"betAmount": 50,
						"amount": 166.2,
						"winTime": "2024-05-07 18:31:29",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "16",
						"nickName": "MemberAVRPCRVS",
						"betAmount": 50,
						"amount": 166.2,
						"winTime": "2024-05-07 18:31:27",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "3",
						"nickName": "MemberUFOHVZJX",
						"betAmount": 100,
						"amount": 194,
						"winTime": "2024-05-07 18:31:24",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "TB_Chess",
						"userPhoto": "9",
						"nickName": "MemberLWEKFYZG",
						"betAmount": 200,
						"amount": 400,
						"winTime": "2024-05-07 18:31:23",
						"showType": 6,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183718x4pi"
					  },
					  {
						"type": "9",
						"userPhoto": "12",
						"nickName": "MemberPSKOTTMV",
						"betAmount": 294,
						"amount": 564.48,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "6",
						"nickName": "MemberVYGKDJYN",
						"betAmount": 14.7,
						"amount": 145.24,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "14",
						"nickName": "MemberYMFVOVLD",
						"betAmount": 14.7,
						"amount": 145.24,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "6",
						"nickName": "MemberUUGTPPID",
						"betAmount": 98,
						"amount": 188.16,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "8",
						"nickName": "MemberBKQVJARR",
						"betAmount": 24.5,
						"amount": 242.06,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "16",
						"nickName": "MemberHOUGVQTX",
						"betAmount": 196,
						"amount": 376.32,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "2",
						"nickName": "MemberXOETNELI",
						"betAmount": 98,
						"amount": 188.16,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "17",
						"nickName": "MemberGNKTBYSD",
						"betAmount": 137.2,
						"amount": 263.42,
						"winTime": "2024-05-07 18:30:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "DG",
						"userPhoto": "19",
						"nickName": "MemberVNKDZNZC",
						"betAmount": 190,
						"amount": 390,
						"winTime": "2024-05-07 18:30:25",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_202404121129431pg2.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "6",
						"nickName": "MemberHPZNTVSG",
						"betAmount": 7.5,
						"amount": 150,
						"winTime": "2024-05-07 18:30:19",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "18",
						"nickName": "MemberUOBVVMJG",
						"betAmount": 10,
						"amount": 200,
						"winTime": "2024-05-07 18:30:19",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "12",
						"nickName": "MemberTCRBTFGF",
						"betAmount": 5,
						"amount": 250,
						"winTime": "2024-05-07 18:30:18",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "8",
						"nickName": "MemberZSHGFGOF",
						"betAmount": 10,
						"amount": 210,
						"winTime": "2024-05-07 18:30:16",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "9",
						"nickName": "MemberCQJQHJQV",
						"betAmount": 50,
						"amount": 260,
						"winTime": "2024-05-07 18:30:15",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "2",
						"nickName": "MemberRJPSLESE",
						"betAmount": 7.5,
						"amount": 671,
						"winTime": "2024-05-07 18:30:15",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "5",
						"nickName": "MemberMEMWHGVO",
						"betAmount": 5,
						"amount": 111,
						"winTime": "2024-05-07 18:30:14",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "14",
						"nickName": "MemberBMQKNAHH",
						"betAmount": 5,
						"amount": 101,
						"winTime": "2024-05-07 18:30:13",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "1",
						"nickName": "MemberXFPSIHHB",
						"betAmount": 120,
						"amount": 420,
						"winTime": "2024-05-07 18:30:12",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "13",
						"nickName": "MemberNYXYAZYT",
						"betAmount": 5,
						"amount": 250,
						"winTime": "2024-05-07 18:30:10",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "5",
						"nickName": "MemberRXRDMRXW",
						"betAmount": 3,
						"amount": 144,
						"winTime": "2024-05-07 18:30:09",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "14",
						"nickName": "MemberBRFJQQTP",
						"betAmount": 5,
						"amount": 101,
						"winTime": "2024-05-07 18:30:07",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "16",
						"nickName": "MemberPLSKWNWL",
						"betAmount": 50,
						"amount": 1500,
						"winTime": "2024-05-07 18:30:04",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "18",
						"nickName": "MemberBDAFSNOR",
						"betAmount": 31,
						"amount": 150,
						"winTime": "2024-05-07 18:30:04",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "12",
						"nickName": "MemberHVRYTKVP",
						"betAmount": 15,
						"amount": 270,
						"winTime": "2024-05-07 18:30:03",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "5",
						"nickName": "MemberWMATQEAV",
						"betAmount": 10,
						"amount": 160,
						"winTime": "2024-05-07 18:30:02",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "15",
						"nickName": "MemberYGWQFMHH",
						"betAmount": 50,
						"amount": 1000,
						"winTime": "2024-05-07 18:30:01",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "7",
						"nickName": "MemberLXMMVTAK",
						"betAmount": 5,
						"amount": 101,
						"winTime": "2024-05-07 18:30:00",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "9",
						"userPhoto": "2",
						"nickName": "MemberWUZOQSGR",
						"betAmount": 24.5,
						"amount": 242.06,
						"winTime": "2024-05-07 18:29:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "1",
						"nickName": "MemberPFMLFUFB",
						"betAmount": 98,
						"amount": 188.16,
						"winTime": "2024-05-07 18:29:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "8",
						"nickName": "MemberPRKSVETH",
						"betAmount": 1274,
						"amount": 2446.08,
						"winTime": "2024-05-07 18:29:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "9",
						"userPhoto": "13",
						"nickName": "MemberUATRHQBU",
						"betAmount": 68.6,
						"amount": 131.71,
						"winTime": "2024-05-07 18:29:57",
						"showType": 9,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194451en5o.png"
					  },
					  {
						"type": "5",
						"userPhoto": "13",
						"nickName": "MemberGDVKJFGD",
						"betAmount": 103,
						"amount": 199.86,
						"winTime": "2024-05-07 18:29:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "11",
						"nickName": "MemberRCYPIAVW",
						"betAmount": 60,
						"amount": 116.42,
						"winTime": "2024-05-07 18:29:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "10",
						"nickName": "MemberFECBUVTH",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:29:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "5",
						"nickName": "MemberLYXGLUZX",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:29:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "10",
						"nickName": "MemberBYQIMKGW",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:29:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "2",
						"nickName": "MemberIBHDXAXB",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:29:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "TB",
						"userPhoto": "11",
						"nickName": "MemberTXGTSGSY",
						"betAmount": 10,
						"amount": 111,
						"winTime": "2024-05-07 18:29:42",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240322155135ilqv.png"
					  },
					  {
						"type": "5",
						"userPhoto": "14",
						"nickName": "MemberKIJOSSOD",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:28:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "2",
						"nickName": "MemberCXGZCGEC",
						"betAmount": 294,
						"amount": 245,
						"winTime": "2024-05-07 18:28:55",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "11",
						"nickName": "MemberRUNIENNR",
						"betAmount": 10,
						"amount": 180,
						"winTime": "2024-05-07 18:28:47",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "13",
						"nickName": "MemberBORLRNWM",
						"betAmount": 336,
						"amount": 1145,
						"winTime": "2024-05-07 18:28:47",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "18",
						"nickName": "MemberEGUQNVON",
						"betAmount": 5,
						"amount": 336,
						"winTime": "2024-05-07 18:28:43",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "14",
						"nickName": "MemberJNKUXFFB",
						"betAmount": 204,
						"amount": 281,
						"winTime": "2024-05-07 18:28:26",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "8",
						"nickName": "MemberRVULBSHI",
						"betAmount": 10,
						"amount": 150.5,
						"winTime": "2024-05-07 18:28:14",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "4",
						"nickName": "MemberYLQEJPQJ",
						"betAmount": 320,
						"amount": 127,
						"winTime": "2024-05-07 18:28:14",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "14",
						"nickName": "MemberYNNJPYTC",
						"betAmount": 49,
						"amount": 185,
						"winTime": "2024-05-07 18:28:00",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "5",
						"userPhoto": "15",
						"nickName": "MemberKFHFIBBW",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:27:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "6",
						"nickName": "MemberGIHCLHCL",
						"betAmount": 200,
						"amount": 388.08,
						"winTime": "2024-05-07 18:27:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "8",
						"nickName": "MemberCINMNVFE",
						"betAmount": 8.8,
						"amount": 192.8,
						"winTime": "2024-05-07 18:27:57",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "11",
						"nickName": "MemberPHPMJXRV",
						"betAmount": 90,
						"amount": 120,
						"winTime": "2024-05-07 18:27:56",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "11",
						"nickName": "MemberKLYWHORE",
						"betAmount": 306,
						"amount": 180,
						"winTime": "2024-05-07 18:27:47",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "6",
						"nickName": "MemberJAFPXTIR",
						"betAmount": 4.5,
						"amount": 122,
						"winTime": "2024-05-07 18:27:39",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "12",
						"nickName": "MemberOCXVMMKN",
						"betAmount": 120,
						"amount": 234,
						"winTime": "2024-05-07 18:27:32",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "2",
						"nickName": "MemberBBAPZZFZ",
						"betAmount": 10,
						"amount": 200,
						"winTime": "2024-05-07 18:27:21",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "14",
						"nickName": "MemberOZJPZDVF",
						"betAmount": 299,
						"amount": 176,
						"winTime": "2024-05-07 18:27:14",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "SEXY_Video",
						"userPhoto": "15",
						"nickName": "MemberGBQWODDM",
						"betAmount": 150,
						"amount": 300,
						"winTime": "2024-05-07 18:27:12",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240316123435brno.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "14",
						"nickName": "MemberAORGALKS",
						"betAmount": 5,
						"amount": 140,
						"winTime": "2024-05-07 18:27:10",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "14",
						"nickName": "MemberILZFORPL",
						"betAmount": 5,
						"amount": 145,
						"winTime": "2024-05-07 18:27:05",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "16",
						"nickName": "MemberHGJIEWPQ",
						"betAmount": 146,
						"amount": 244,
						"winTime": "2024-05-07 18:27:04",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "5",
						"userPhoto": "10",
						"nickName": "MemberPEHTYRUM",
						"betAmount": 200,
						"amount": 388.08,
						"winTime": "2024-05-07 18:26:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "17",
						"nickName": "MemberDWLHUSLV",
						"betAmount": 486,
						"amount": 735,
						"winTime": "2024-05-07 18:26:47",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "11",
						"nickName": "MemberUHDXAMNQ",
						"betAmount": 800,
						"amount": 1560,
						"winTime": "2024-05-07 18:26:38",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "DG",
						"userPhoto": "8",
						"nickName": "MemberPMHDJEDI",
						"betAmount": 230,
						"amount": 460,
						"winTime": "2024-05-07 18:26:31",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_202404121129431pg2.png"
					  },
					  {
						"type": "SEXY_Video",
						"userPhoto": "17",
						"nickName": "MemberGPTLIUZK",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 18:26:31",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240316123435brno.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "11",
						"nickName": "MemberVARUBWMP",
						"betAmount": 40,
						"amount": 110,
						"winTime": "2024-05-07 18:26:19",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "3",
						"nickName": "MemberHFUINYRN",
						"betAmount": 401,
						"amount": 107,
						"winTime": "2024-05-07 18:26:14",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "4",
						"nickName": "MemberKTOJFBMY",
						"betAmount": 120,
						"amount": 321,
						"winTime": "2024-05-07 18:26:04",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "5",
						"userPhoto": "5",
						"nickName": "MemberSBYCMYFH",
						"betAmount": 70,
						"amount": 135.83,
						"winTime": "2024-05-07 18:25:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "2",
						"nickName": "MemberUTYMXGXN",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:25:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "3",
						"nickName": "MemberIGQRDERG",
						"betAmount": 60,
						"amount": 280,
						"winTime": "2024-05-07 18:25:47",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "7",
						"nickName": "MemberAEZIQTKL",
						"betAmount": 9,
						"amount": 123,
						"winTime": "2024-05-07 18:25:46",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "12",
						"nickName": "MemberCITWGKJO",
						"betAmount": 401,
						"amount": 241,
						"winTime": "2024-05-07 18:25:34",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "7",
						"nickName": "MemberYJZGUMHY",
						"betAmount": 60,
						"amount": 117,
						"winTime": "2024-05-07 18:25:26",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "17",
						"nickName": "MemberQQHQFZOH",
						"betAmount": 249,
						"amount": 155,
						"winTime": "2024-05-07 18:25:14",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "5",
						"userPhoto": "14",
						"nickName": "MemberKLTJAZWQ",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:24:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "9",
						"nickName": "MemberIXJLDJNE",
						"betAmount": 300,
						"amount": 582.12,
						"winTime": "2024-05-07 18:24:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "1",
						"nickName": "MemberQTFLSWMX",
						"betAmount": 196,
						"amount": 189,
						"winTime": "2024-05-07 18:24:49",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "11",
						"nickName": "MemberYRXFTMGI",
						"betAmount": 408,
						"amount": 565,
						"winTime": "2024-05-07 18:24:47",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "11",
						"nickName": "MemberTHUWAMGG",
						"betAmount": 229,
						"amount": 259,
						"winTime": "2024-05-07 18:24:43",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "13",
						"nickName": "MemberQXIRIIPQ",
						"betAmount": 80,
						"amount": 120,
						"winTime": "2024-05-07 18:24:32",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "JDB",
						"userPhoto": "2",
						"nickName": "MemberSNINHHSY",
						"betAmount": 229,
						"amount": 533,
						"winTime": "2024-05-07 18:24:14",
						"showType": 5,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183450ph8e.png"
					  },
					  {
						"type": "5",
						"userPhoto": "8",
						"nickName": "MemberMCUJNOMM",
						"betAmount": 2359,
						"amount": 4577.4,
						"winTime": "2024-05-07 18:23:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "18",
						"nickName": "MemberWRWGAERL",
						"betAmount": 60,
						"amount": 117,
						"winTime": "2024-05-07 18:23:37",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "10",
						"nickName": "MemberGFGSSSEF",
						"betAmount": 120,
						"amount": 234,
						"winTime": "2024-05-07 18:23:03",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "5",
						"userPhoto": "14",
						"nickName": "MemberNXLNVVYS",
						"betAmount": 100,
						"amount": 194.04,
						"winTime": "2024-05-07 18:22:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "5",
						"userPhoto": "15",
						"nickName": "MemberTNMHBBGF",
						"betAmount": 210,
						"amount": 407.48,
						"winTime": "2024-05-07 18:22:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "3",
						"nickName": "MemberIHBYLKCU",
						"betAmount": 80,
						"amount": 110,
						"winTime": "2024-05-07 18:22:18",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "TB",
						"userPhoto": "3",
						"nickName": "MemberMRDBARHT",
						"betAmount": 0,
						"amount": 115.2,
						"winTime": "2024-05-07 18:22:03",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240322155135ilqv.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "5",
						"nickName": "MemberSMDGIWST",
						"betAmount": 5,
						"amount": 111,
						"winTime": "2024-05-07 18:21:58",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "5",
						"userPhoto": "18",
						"nickName": "MemberRKSAIWAY",
						"betAmount": 500,
						"amount": 970.2,
						"winTime": "2024-05-07 18:21:57",
						"showType": 7,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/lotterycategory_20240321194510h9i1.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "9",
						"nickName": "MemberGYNWIURU",
						"betAmount": 15,
						"amount": 120,
						"winTime": "2024-05-07 18:21:53",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "TB",
						"userPhoto": "16",
						"nickName": "MemberECOBVIZG",
						"betAmount": 0,
						"amount": 124.2,
						"winTime": "2024-05-07 18:21:52",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240322155135ilqv.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "18",
						"nickName": "MemberMERJUOBF",
						"betAmount": 20,
						"amount": 1000,
						"winTime": "2024-05-07 18:21:51",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "19",
						"nickName": "MemberGLPTUQLW",
						"betAmount": 100,
						"amount": 600,
						"winTime": "2024-05-07 18:21:46",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "6",
						"nickName": "MemberAWINUGYD",
						"betAmount": 50,
						"amount": 1500,
						"winTime": "2024-05-07 18:21:46",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "15",
						"nickName": "MemberKTSGSWOU",
						"betAmount": 5,
						"amount": 250,
						"winTime": "2024-05-07 18:21:44",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "5",
						"nickName": "MemberHPPQCOHP",
						"betAmount": 3,
						"amount": 108,
						"winTime": "2024-05-07 18:21:43",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "18",
						"nickName": "MemberFEMEWUDJ",
						"betAmount": 10,
						"amount": 115,
						"winTime": "2024-05-07 18:21:40",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "CQ9",
						"userPhoto": "9",
						"nickName": "MemberIVMCYLRK",
						"betAmount": 180,
						"amount": 360,
						"winTime": "2024-05-07 18:21:39",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183506uo8v.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "15",
						"nickName": "MemberZYLRLDWT",
						"betAmount": 5,
						"amount": 101,
						"winTime": "2024-05-07 18:21:35",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "10",
						"nickName": "MemberQFSUUOUR",
						"betAmount": 5,
						"amount": 138.5,
						"winTime": "2024-05-07 18:21:31",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "5",
						"nickName": "MemberTLKCMYOJ",
						"betAmount": 3,
						"amount": 120,
						"winTime": "2024-05-07 18:21:23",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "7",
						"nickName": "MemberMANQCCMC",
						"betAmount": 50,
						"amount": 250,
						"winTime": "2024-05-07 18:21:23",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "5",
						"nickName": "MemberHUMMOQXW",
						"betAmount": 5,
						"amount": 130,
						"winTime": "2024-05-07 18:21:23",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "13",
						"nickName": "MemberYGHBNGSV",
						"betAmount": 100,
						"amount": 1440,
						"winTime": "2024-05-07 18:21:21",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "16",
						"nickName": "MemberWDVOPPXP",
						"betAmount": 3,
						"amount": 120,
						"winTime": "2024-05-07 18:21:20",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "15",
						"nickName": "MemberUNOUBIUM",
						"betAmount": 5,
						"amount": 120,
						"winTime": "2024-05-07 18:21:17",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "JILI",
						"userPhoto": "10",
						"nickName": "MemberRADGUHVV",
						"betAmount": 10,
						"amount": 300,
						"winTime": "2024-05-07 18:21:15",
						"showType": 4,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240321183353rwkf.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "1",
						"nickName": "MemberTUNGZEFK",
						"betAmount": 100,
						"amount": 308,
						"winTime": "2024-05-07 18:19:56",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "9",
						"nickName": "MemberBVYRLMDB",
						"betAmount": 200,
						"amount": 385,
						"winTime": "2024-05-07 18:19:56",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "5",
						"nickName": "MemberCEGQBUSD",
						"betAmount": 480,
						"amount": 1240,
						"winTime": "2024-05-07 18:19:48",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "14",
						"nickName": "MemberLSSUHGNX",
						"betAmount": 80,
						"amount": 450,
						"winTime": "2024-05-07 18:19:36",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "11",
						"nickName": "MemberMMGOGJOC",
						"betAmount": 200,
						"amount": 400,
						"winTime": "2024-05-07 18:19:28",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "18",
						"nickName": "MemberHGMRURGP",
						"betAmount": 120,
						"amount": 234,
						"winTime": "2024-05-07 18:19:25",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "14",
						"nickName": "MemberEYVFYKQA",
						"betAmount": 500,
						"amount": 1000,
						"winTime": "2024-05-07 18:19:11",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "19",
						"nickName": "MemberOZFGMPRF",
						"betAmount": 1000,
						"amount": 1060,
						"winTime": "2024-05-07 18:19:06",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "17",
						"nickName": "MemberRPYQTKFB",
						"betAmount": 40,
						"amount": 120,
						"winTime": "2024-05-07 18:18:53",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "15",
						"nickName": "MemberTJXTCBEG",
						"betAmount": 180,
						"amount": 351,
						"winTime": "2024-05-07 18:18:46",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "EVO_Video",
						"userPhoto": "1",
						"nickName": "MemberBRCRMUHB",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 18:18:17",
						"showType": 1,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233708h2lc.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "19",
						"nickName": "MemberOALDZRHE",
						"betAmount": 240,
						"amount": 468,
						"winTime": "2024-05-07 18:18:09",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "7",
						"nickName": "MemberZWTFWADR",
						"betAmount": 60,
						"amount": 117,
						"winTime": "2024-05-07 18:16:55",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "14",
						"nickName": "MemberBBVIRKIL",
						"betAmount": 200,
						"amount": 400,
						"winTime": "2024-05-07 18:16:34",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "8",
						"nickName": "MemberDCHRBYXB",
						"betAmount": 80,
						"amount": 156,
						"winTime": "2024-05-07 18:16:17",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "16",
						"nickName": "MemberVBKPGJKA",
						"betAmount": 80,
						"amount": 240,
						"winTime": "2024-05-07 18:16:06",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "2",
						"nickName": "MemberIKMYBQMF",
						"betAmount": 100,
						"amount": 195,
						"winTime": "2024-05-07 18:11:25",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "17",
						"nickName": "MemberHDRGBJZT",
						"betAmount": 80,
						"amount": 160,
						"winTime": "2024-05-07 18:10:30",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "11",
						"nickName": "MemberSQTNEQEX",
						"betAmount": 60,
						"amount": 117,
						"winTime": "2024-05-07 18:10:28",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "6",
						"nickName": "MemberKCMTXGII",
						"betAmount": 80,
						"amount": 156,
						"winTime": "2024-05-07 18:09:51",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "SaBa",
						"userPhoto": "15",
						"nickName": "MemberDUWGUVBY",
						"betAmount": 80,
						"amount": 4080,
						"winTime": "2024-05-07 18:09:24",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240411191851up8s.png"
					  },
					  {
						"type": "SaBa",
						"userPhoto": "8",
						"nickName": "MemberJTTTCFEE",
						"betAmount": 21,
						"amount": 321,
						"winTime": "2024-05-07 18:09:24",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240411191851up8s.png"
					  },
					  {
						"type": "SaBa",
						"userPhoto": "16",
						"nickName": "MemberCXHHFJJZ",
						"betAmount": 40,
						"amount": 240,
						"winTime": "2024-05-07 18:09:24",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240411191851up8s.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "13",
						"nickName": "MemberGCWELTKA",
						"betAmount": 150,
						"amount": 300,
						"winTime": "2024-05-07 18:09:13",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "15",
						"nickName": "MemberRUGIZWXR",
						"betAmount": 1000,
						"amount": 2000,
						"winTime": "2024-05-07 18:09:03",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "15",
						"nickName": "MemberUJLWLXBQ",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 18:08:51",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "9",
						"nickName": "MemberLEKCERAE",
						"betAmount": 70,
						"amount": 430,
						"winTime": "2024-05-07 18:08:30",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "11",
						"nickName": "MemberUAEIYSGO",
						"betAmount": 125,
						"amount": 375,
						"winTime": "2024-05-07 18:08:30",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "4",
						"nickName": "MemberSEEQHKVJ",
						"betAmount": 520,
						"amount": 1480,
						"winTime": "2024-05-07 18:08:30",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "9",
						"nickName": "MemberZHZMLAYS",
						"betAmount": 267.54,
						"amount": 761.46,
						"winTime": "2024-05-07 18:08:30",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "15",
						"nickName": "MemberXYXPMFCH",
						"betAmount": 120,
						"amount": 234,
						"winTime": "2024-05-07 18:07:54",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "11",
						"nickName": "MemberMQJXPZXF",
						"betAmount": 100,
						"amount": 195,
						"winTime": "2024-05-07 18:07:38",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "2",
						"nickName": "MemberVLPSVALV",
						"betAmount": 60,
						"amount": 117,
						"winTime": "2024-05-07 18:07:18",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "V8Card",
						"userPhoto": "2",
						"nickName": "MemberKDWCKGOP",
						"betAmount": 480,
						"amount": 936,
						"winTime": "2024-05-07 18:05:14",
						"showType": 3,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240306233853vhdr.png"
					  },
					  {
						"type": "SaBa",
						"userPhoto": "9",
						"nickName": "MemberPDMPCVMI",
						"betAmount": 1530,
						"amount": 3330,
						"winTime": "2024-05-07 17:48:05",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240411191851up8s.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "10",
						"nickName": "MemberSZIKHHQU",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 17:42:02",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "17",
						"nickName": "MemberPBWJKSZM",
						"betAmount": 160,
						"amount": 360,
						"winTime": "2024-05-07 17:40:29",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "19",
						"nickName": "MemberFMKAJKQJ",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 17:13:43",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "19",
						"nickName": "MemberNZRERORX",
						"betAmount": 2000,
						"amount": 4000,
						"winTime": "2024-05-07 17:13:32",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "16",
						"nickName": "MemberSMSWTMNX",
						"betAmount": 101,
						"amount": 202,
						"winTime": "2024-05-07 17:12:26",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  },
					  {
						"type": "SaBa",
						"userPhoto": "2",
						"nickName": "MemberYMISYQSH",
						"betAmount": 154,
						"amount": 354,
						"winTime": "2024-05-07 17:08:20",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240411191851up8s.png"
					  },
					  {
						"type": "SaBa",
						"userPhoto": "4",
						"nickName": "MemberOZTKMAGI",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 17:04:27",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240411191851up8s.png"
					  },
					  {
						"type": "SaBa",
						"userPhoto": "7",
						"nickName": "MemberMQWUIKDX",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 17:03:52",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/apigameimages/vendorlogo_20240411191851up8s.png"
					  },
					  {
						"type": "Wickets9",
						"userPhoto": "13",
						"nickName": "MemberEDQVFIWK",
						"betAmount": 100,
						"amount": 200,
						"winTime": "2024-05-07 16:53:49",
						"showType": 2,
						"imgUrl": "https://selimxpro.com/apiimages/BDGWin/vendorlogo/vendorlogo_20240411190844d133.png"
					  }
					],
					"penarikanList": [
					  {
						"userPhoto": "14",
						"nickName": "MemberFDJPDKTS",
						"price": 5591121480,
						"time": "2024-05-07",
						"typeName": "Penarikan",
						"winTime": "5/7/2024 12:00:00 AM"
					  },
					  {
						"userPhoto": "7",
						"nickName": "MemberLKYYNMEE",
						"price": 4208908308.08,
						"time": "2024-05-07",
						"typeName": "Penarikan",
						"winTime": "5/7/2024 12:00:00 AM"
					  },
					  {
						"userPhoto": "3",
						"nickName": "MemberMQKQDSXZ",
						"price": 1697295314.12,
						"time": "2024-05-07",
						"typeName": "Penarikan",
						"winTime": "5/7/2024 12:00:00 AM"
					  },
					  {
						"userPhoto": "8",
						"nickName": "MemberZMKFGFTD",
						"price": 1652492170,
						"time": "2024-05-07",
						"typeName": "Penarikan",
						"winTime": "5/7/2024 12:00:00 AM"
					  },
					  {
						"userPhoto": "13",
						"nickName": "MemberFTKMDCVL",
						"price": 1257358919.88,
						"time": "2024-05-07",
						"typeName": "Penarikan",
						"winTime": "5/7/2024 12:00:00 AM"
					  }
					]
				  },
				  "code": 0,
				  "msg": "Succeed",
				  "msgCode": 0,
				  "serviceNowTime": "$shnunc"
				}';
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
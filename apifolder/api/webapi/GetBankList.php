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
						http_response_code(200);
						if($withdrawid == 1){
							echo '
								{
								  "data": {
									"banklist": [
									  {
										"bankID": 16,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Bank of Baroda",
										"reserved": "1"
									  },
									  {
										"bankID": 15,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Union Bank of India",
										"reserved": "1"
									  },
									  {
										"bankID": 14,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Central Bank of India",
										"reserved": "1"
									  },
									  {
										"bankID": 13,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Yes Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 12,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "HDFC Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 11,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Karnataka Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 10,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Standard Chartered Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 9,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "IDBI Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 8,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Bank of India",
										"reserved": "1"
									  },
									  {
										"bankID": 7,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Punjab National Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 6,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "ICICI Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 5,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Canara Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 4,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Kotak Mahindra Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 3,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "State Bank of India",
										"reserved": "1"
									  },
									  {
										"bankID": 2,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Indian Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 1,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Axis Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 17,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "FEDERAL BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 18,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Syndicate Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 22,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Citibank India",
										"reserved": "1"
									  },
									  {
										"bankID": 23,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Indian Overseas Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 24,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "IDFC Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 25,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Bandhan Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 26,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Indusind Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 29,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Equitas Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 30,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "India Post Payments Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 31,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Corporation Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 27,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Jammu & Kashmir Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 32,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "City Union Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 28,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "PYTM PAYMENTS BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 33,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Karur Vysya Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 34,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Tamilnad Mercantile Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 35,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Allahabad Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 36,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "varachha co-operative bank",
										"reserved": "1"
									  },
									  {
										"bankID": 37,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Meghalaya Rural Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 38,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "AU Small Finance Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 39,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Lakshmi Vilas Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 40,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "South Indian Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 41,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Bassein catholic co-operative Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 42,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Airtel Payment Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 43,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "State Bank of Hyderabad",
										"reserved": "1"
									  },
									  {
										"bankID": 44,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Gp parsik bank",
										"reserved": "1"
									  },
									  {
										"bankID": 45,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Kerala Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 46,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "RBL Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 47,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Dhanlaxmi Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 48,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "TJSB Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 49,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Punjab & Sind Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 50,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Purvanchal bank",
										"reserved": "1"
									  },
									  {
										"bankID": 51,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Sarva Haryana Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 52,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Ahmedabad District Co-Operative Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 53,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Fino Payments Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 54,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Saraswat Cooperative Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 62,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Dhanlaxmi bank",
										"reserved": "1"
									  },
									  {
										"bankID": 63,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Telangana Grameena Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 57,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "andhra pragathi grameena bank",
										"reserved": "1"
									  },
									  {
										"bankID": 58,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "rajasthan marudhara gramin bank",
										"reserved": "1"
									  },
									  {
										"bankID": 59,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Abhyudaya bank",
										"reserved": "1"
									  },
									  {
										"bankID": 60,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "ujjivan small finance bank",
										"reserved": "1"
									  },
									  {
										"bankID": 61,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Pragathi Krishna Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 64,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "capital small finance bank",
										"reserved": "1"
									  },
									  {
										"bankID": 65,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Mizoram Rural Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 66,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Andhra Pradesh Grameena Vikas Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 67,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Karnataka Vikas Grameena Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 68,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "The Ahmedabad merchantile co-op bank Ltd",
										"reserved": "1"
									  },
									  {
										"bankID": 69,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Madhya Bihar Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 70,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "NSDL Payments Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 71,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "ESAF Small Finance Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 72,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Himachal Pradesh state cooperative bank",
										"reserved": "1"
									  },
									  {
										"bankID": 73,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Maharashtra state cooperative bank",
										"reserved": "1"
									  },
									  {
										"bankID": 74,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "ORIENTAL BANK OF COMMERCE",
										"reserved": "1"
									  },
									  {
										"bankID": 75,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "nainital bank",
										"reserved": "1"
									  },
									  {
										"bankID": 76,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Telangana grameena bank",
										"reserved": "1"
									  },
									  {
										"bankID": 77,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Jharkhand Rajya Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 78,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "jio payments bank",
										"reserved": "1"
									  },
									  {
										"bankID": 79,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "MAHARASHTRA GRAMIN BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 80,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "AIRTEL PAYMENTS BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 81,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Uttarakhand Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 82,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "DBS BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 83,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Equitas Small Finance Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 84,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Himachal Pradesh Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 85,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Krishna District Co-Operative Central Bank Ltd.",
										"reserved": "1"
									  },
									  {
										"bankID": 86,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "RAJKOT NAGARIK SAHAKARI BANK LTD",
										"reserved": "1"
									  },
									  {
										"bankID": 87,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "North East small financial bank",
										"reserved": "1"
									  },
									  {
										"bankID": 88,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Catholic syrian bank",
										"reserved": "1"
									  },
									  {
										"bankID": 89,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Fincare small finance bank",
										"reserved": "1"
									  },
									  {
										"bankID": 90,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Baroda Uttar Pradesh Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 91,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Dhanalakshmi bank",
										"reserved": "1"
									  },
									  {
										"bankID": 92,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Cosmos Co-operative Bank Ltd",
										"reserved": "1"
									  },
									  {
										"bankID": 93,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Saurashtra gramin bank",
										"reserved": "1"
									  },
									  {
										"bankID": 94,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Baroda Rajasthan kshetriya gramin bank",
										"reserved": "1"
									  },
									  {
										"bankID": 95,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Suco Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 96,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Jana small finance bank",
										"reserved": "1"
									  },
									  {
										"bankID": 97,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "",
										"reserved": "1"
									  },
									  {
										"bankID": 98,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Dena Gujarat Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 99,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Chaitanya Godavari Grameena Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 100,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "SVC BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 101,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Bharat cooperative bank",
										"reserved": "1"
									  },
									  {
										"bankID": 102,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "The Surat District Co-Op. Bank Ltd.",
										"reserved": "1"
									  },
									  {
										"bankID": 103,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "USDT",
										"reserved": "1"
									  },
									  {
										"bankID": 104,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "The Kalupur Commercial Co-operative Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 105,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "India Post Payments Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 106,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Prime co-operative Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 107,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Tripura Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 108,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Zila Sahakari Bank Ltd Bareilly",
										"reserved": "1"
									  },
									  {
										"bankID": 109,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "ARYAVART Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 110,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Development credit Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 111,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Ujjivan Small Finance Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 112,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Sarva UP Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 113,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "New India Co-Operative Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 114,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "NKGSB Co-operative Bank Ltd.",
										"reserved": "1"
									  },
									  {
										"bankID": 115,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Vijaya Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 116,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "United Bank of India",
										"reserved": "1"
									  },
									  {
										"bankID": 117,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "State Bank of Bikaner And Jaipur",
										"reserved": "1"
									  },
									  {
										"bankID": 118,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Shri Janata Sahakari Bank LTD",
										"reserved": "1"
									  },
									  {
										"bankID": 119,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Rajgurunagar Sahakari Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 120,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "FEDERAL NEO BANK JUPITER",
										"reserved": "1"
									  },
									  {
										"bankID": 121,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "CHHATTISGARH RAJYA GRAMIN BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 122,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Apna Sahakari Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 123,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "GS Mahanagar Co-Op Bank Ltd",
										"reserved": "1"
									  },
									  {
										"bankID": 124,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Bangiya Gramin Vikash Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 125,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Assam Gramin Vikash Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 126,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Saurashtra Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 127,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Kangra Central Co-operative Bank Ltd",
										"reserved": "1"
									  },
									  {
										"bankID": 128,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Punjab Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 129,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Assam gramin bikash bank",
										"reserved": "1"
									  },
									  {
										"bankID": 130,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Karnataka Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 131,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "SURYODAY SMALL FINANCE BANK LIMITED",
										"reserved": "1"
									  },
									  {
										"bankID": 132,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Utkarsh Small Finance Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 133,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "The Meghalaya Co-operative Apex Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 134,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "UTTAR BIHAR GRAMIN BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 135,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "STATE BANK OF TRAVANCORE",
										"reserved": "1"
									  },
									  {
										"bankID": 136,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "SHIVALIK SMALL FIHANCE BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 137,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "DAKSHIN BIHIR GRAMIN BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 138,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "DBS Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 139,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "State Bank of Hyderabad",
										"reserved": "1"
									  },
									  {
										"bankID": 140,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "manipur rural bank",
										"reserved": "1"
									  },
									  {
										"bankID": 141,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "State bank of patiala",
										"reserved": "1"
									  },
									  {
										"bankID": 142,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "BARODA GUJARAT GRAMIN BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 143,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "The Gujarat State Co-operative Bank Limited",
										"reserved": "1"
									  },
									  {
										"bankID": 144,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "vasai vikas sahakari",
										"reserved": "1"
									  },
									  {
										"bankID": 145,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "paschim banga gramin bank",
										"reserved": "1"
									  },
									  {
										"bankID": 146,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "PRAGATHI KRISHNA GRAMIN BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 147,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "VISHAPATNAM co-operative bank",
										"reserved": "1"
									  },
									  {
										"bankID": 148,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Samarth Sahakari Bank Ltd",
										"reserved": "1"
									  },
									  {
										"bankID": 149,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "uttarbanga kshetriya gramin bank",
										"reserved": "1"
									  },
									  {
										"bankID": 150,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "janata sahakari bank ltd",
										"reserved": "1"
									  },
									  {
										"bankID": 152,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "the gayatri co-operative urban bank",
										"reserved": "1"
									  },
									  {
										"bankID": 153,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Jupiter Federal Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 154,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "ABHYUDAYA CO-OP. BANK LTD.",
										"reserved": "1"
									  },
									  {
										"bankID": 155,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "J&K Grameen Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 156,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Post Office Savings Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 157,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "SBM Bank India",
										"reserved": "1"
									  },
									  {
										"bankID": 20,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Bank of maharashtra",
										"reserved": "1"
									  },
									  {
										"bankID": 158,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "DAMAN",
										"reserved": "1"
									  },
									  {
										"bankID": 159,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Jind central Co-OP Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 151,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "PRATHAMA Up Gramin Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 160,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "The Jalgaon Peoples Co-Op Bank",
										"reserved": "1"
									  },
									  {
										"bankID": 161,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Associated Co-operative Bank limited",
										"reserved": "1"
									  },
									  {
										"bankID": 162,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "Mizoram Co-operative Apex Bank Ltd.",
										"reserved": "1"
									  },
									  {
										"bankID": 163,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "The Muslim Co-operative bank",
										"reserved": "1"
									  },
									  {
										"bankID": 164,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "PRATHAMA BANK",
										"reserved": "1"
									  },
									  {
										"bankID": 165,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "KASIKORNBANK",
										"reserved": "1"
									  }
									]
								  },
								  "code": 0,
								  "msg": "Succeed",
								  "msgCode": 0,
								  "serviceNowTime": "$shnunc"
								}
							';				
						}
						else if($withdrawid == 3){
							echo '
								{
								  "data": {
									"banklist": [
									  {
										"bankID": 55,
										"bankLogo": "https://selimxpro.com/apiimages/BDGWin",
										"bankName": "TRC",
										"reserved": "3"
									  }
									]
								  },
								  "code": 0,
								  "msg": "Succeed",
								  "msgCode": 0,
								  "serviceNowTime": "$shnunc"
								}
							';	
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
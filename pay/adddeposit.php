<?php include ("../serive/samparka.php");?>
<?php
	$res = [
		'code' => 405,
		'message' => 'Illegal access!',
	];
	if ($_SERVER['REQUEST_METHOD'] != 'GET') {
		date_default_timezone_set('Asia/Kolkata');
		$shnunc = date("Y-m-d H:i:s");
		
		$userId = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['userId']));
		$token = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['token']));
		$userPhoto = '1';
		
		$numquery = "SELECT mobile, codechorkamukala
		  FROM shonu_subjects
		  WHERE id = ".$userId;
		$numresult = $conn->query($numquery);
		$numarr = mysqli_fetch_array($numresult);
		
		$userName = '91'.$numarr['mobile'];
		$nickName = $numarr['codechorkamukala'];
		
		$creaquery = "SELECT createdate
		  FROM shonu_subjects
		  WHERE id = ".$userId;
		$crearesult = $conn->query($creaquery);
		$creaarr = mysqli_fetch_array($crearesult);
		
		$knbdstr = '{"userId":'.$userId.',"userPhoto":"'.$userPhoto.'","userName":'.$userName.',"nickName":"'.$nickName.'","createdate":"'.$creaarr['createdate'].'"}';
		$shonusign = strtoupper(hash('sha256', $knbdstr));
		
		if($shonusign == $token){
			$amt = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['amt']));
			$ref_num = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['refnum']));
			$refchk = mysqli_query($conn , "SELECT shonu FROM `thevani` WHERE `ullekha` = '".$ref_num."'");
			if(mysqli_num_rows($refchk)>=1){
				echo 2;
				exit;
			}
			if(isset($_POST['srl'])){
				$srl = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['srl']));
			}
			else{
				$srl = 0;
			}
			if(isset($_POST['source'])){
				$source = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['source']));
			}
			else{
				$source = null;
			}
			if(isset($_POST['upi'])){
				$upi = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['upi']));
			}
			else{
				$upi = null;
			}
			$uid = $userId;
			
			$datequery = mysqli_query($conn , "SELECT dinankavannuracisi FROM `thevani` WHERE `balakedara` = '".$uid."' ORDER BY shonu DESC LIMIT 1");
			$datearray = mysqli_fetch_array($datequery);
			$compdate = strtotime($datearray['dinankavannuracisi']) + 60;
			if($compdate>=time()){
				echo 3;
				exit;
			}
			
			$statusquery = mysqli_query($conn , "SELECT kramasankhye FROM `amanatugolisu` WHERE `byabaharkarta` = '".$uid."' AND `sthiti` = '1'");
			if(mysqli_num_rows($statusquery)>=1){
				echo 4;
				exit;
			}
			
			$sql="Select status from shonu_subjects where id='$uid'";
			$result=$conn->query($sql);
			$row1 = mysqli_fetch_array($result);
			$status = $row1['status'];
			if($status!=1){
				echo 4;		
				exit;
			}
			
			$emailQ = mysqli_query($conn , "SELECT mobile FROM `shonu_subjects` WHERE `id` = '".$uid."'");
			$emailA = mysqli_fetch_array($emailQ);
			$email = $emailA['mobile'];
				
			$createdate = date("Y-m-d H:i:s");
			
			if($source == 'usdt'){
				$amt = $amt * 93;
			}
			
			$deposit1 = mysqli_query($conn, "INSERT INTO `thevani`(`payid`,`balakedara`, `motta`, `dharavahi`, `mula`, `ullekha`, `duravani`, `ekikrtapavati`, `dinankavannuracisi`, `madari`, `pavatiaidi`, `sthiti`) VALUES('11','$uid', '$amt', '$srl', '$source','$ref_num', '$email', '$upi', '$createdate', '1004', '2', '0')");
			
			if($deposit1){
			  
				  $fields = array(
					"variables_values" => "173214",
					"route" => "otp",
					"numbers" => "8917626217",
				);

				 $curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_SSL_VERIFYHOST => 0,
				  CURLOPT_SSL_VERIFYPEER => 0,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => json_encode($fields),
				  CURLOPT_HTTPHEADER => array(
					"authorization: d57hfbr8ufco8KQcFhnS8JF0ZOQgLJp1x2p",
					"accept: */*",
					"cache-control: no-cache",
					"content-type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  $erO = 0;
				} else {
				  $erO = 1;
				} 
			  
				echo 1;
			}else{
				echo 0; 
			}
		}
		else{
			$res['code'] = 10000;
			$res['success'] = 'false';
			$res['message'] = 'Sorry, The system is busy, please try again later!';
			
			header('Content-Type: text/html; charset=utf-8');
			http_response_code(200);
			echo json_encode($res);	
		}
	}
	else{
		header('Content-Type: application/json; charset=utf-8');
		http_response_code(200);
		echo json_encode($res);
	}
?>
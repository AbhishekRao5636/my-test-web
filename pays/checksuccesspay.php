<?php 
	include ("../serive/samparka.php");
	
	$res = [
		'code' => 405,
		'message' => 'Illegal access!',
	];
	
	if (isset($_GET['userId']) && isset($_GET['token'])) {	
		$refnum = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['refnum']));
		$uid = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['userId']));
		
		$userId = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['userId']));
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
		
		$token = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['token']));
		
		if($shonusign == $token){
		
			$refchk = mysqli_query($conn , "SELECT sthiti FROM `thevani` WHERE `ullekha` = '".$refnum."' AND `balakedara` = '".$uid."'");
			$refrow = mysqli_num_rows($refchk);
			if($refrow == 1){
				$refarr = mysqli_fetch_array($refchk);
				echo $refarr['sthiti'];
			}
			else{
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
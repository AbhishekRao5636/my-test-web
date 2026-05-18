<?php 
	include("serive/samparka.php");
	
	$data = json_decode(file_get_contents("php://input"), true);
	$userName = $data['userName'];
	$userName = substr($userName, 2);
	
	$chkserial_ad = mysqli_query($conn,"select * from `tb_agent` where `mobile`='".$userName."' AND `status`='1'");
	$chkserialrow_ad = mysqli_num_rows($chkserial_ad);
	
	if($chkserialrow_ad == 1){
		$response = array("res" => "1");
	}
	else{
		$response = array("res" => "0");
	}
	
	header('Content-Type: application/json');
	echo json_encode($response);
?>
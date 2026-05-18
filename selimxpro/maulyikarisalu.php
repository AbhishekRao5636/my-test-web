<?php 
	session_start();
	include("conn.php");
	
	$adid = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
	$psad = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password']));
	$samasye = "SELECT * FROM `nirvahaka_shonu` WHERE `nirvahaka_hesaru`='".$adid."' AND `guptapada`='".md5($psad)."' AND `sthiti`='1'";
	$phalitansa = mysqli_query($conn,$samasye);
	$sankhye = mysqli_num_rows($phalitansa);
	$salu = mysqli_fetch_assoc($phalitansa);
	
	if($sankhye >= 1){
		$_SESSION['unohs'] = $salu['unohs'];
		$_SESSION['nirvahaka_hesaru'] = $salu['nirvahaka_hesaru'];
		
		header("location:dashboard.php");
		exit;
	}
	else{
		header("location:index.php?err=ture");
		exit;
	}
?>
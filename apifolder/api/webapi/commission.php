<?php
	$level1commission = 0.85;
    $level2commission = 0.75;
    $level3commission = 0.50;
    $level4commission = 0.35;
    $level5commission = 0.20;
    $level6commission = 0.15;
	
	$level1 = (floatval($totalamount) * floatval($level1commission) / 100);
    $level2 = (floatval($totalamount) * floatval($level2commission) / 100);
    $level3 = (floatval($totalamount) * floatval($level3commission) / 100);
    $level4 = (floatval($totalamount) * floatval($level4commission) / 100);
    $level5 = (floatval($totalamount) * floatval($level5commission) / 100);
    $level6 = (floatval($totalamount) * floatval($level6commission) / 100);
	
	$codesquery = "SELECT code, code1, code2, code3, code4, code5 FROM shonu_subjects WHERE id = '".$byabaharkarta."'";//Add ID
	$codesresult = $conn->query($codesquery);
	$codesarr = mysqli_fetch_array($codesresult);
	$code = $codesarr['code'];
	$code1 = $codesarr['code1'];
	$code2 = $codesarr['code2'];
	$code3 = $codesarr['code3'];
	$code4 = $codesarr['code4'];
	$code5 = $codesarr['code5'];
	
	if($code != null){
		$codeqr = "SELECT id FROM shonu_subjects WHERE owncode = '".$code."'";
		$coders = $conn->query($codeqr);
		$codear = mysqli_fetch_array($coders);
		if(isset($codear['id'])){
			$codeid = $codear['id'];		
			$balquery = "SELECT motta
			  FROM shonu_kaichila
			  WHERE balakedara = '".$codeid."'";
			$balresult = $conn->query($balquery);
			$balarr = mysqli_fetch_array($balresult);
			$motta = round($balarr['motta'], 2);
			$nuamotta = round(($motta + $level1), 2);
			$tathya = mysqli_query($conn,"INSERT INTO `vyavahara` (`balakedara`,`ketebida`,`prakara`,`purba`,`bartaman`,`ayoga`,`koduvavanu`,`tiarikala`) VALUES ('".$codeid."','".$totalamount."','LVLCOMM1','".$motta."','".$nuamotta."','".$level1."','".$byabaharkarta."','".$shnunc."')");
			$nabikarana = "UPDATE shonu_kaichila set motta = '$nuamotta' where balakedara='$codeid'";
			$conn->query($nabikarana);
		}
	}
	
	if($code1 != null){
		$codeqr = "SELECT id FROM shonu_subjects WHERE owncode = '".$code1."'";
		$coders = $conn->query($codeqr);
		$codear = mysqli_fetch_array($coders);
		if(isset($codear['id'])){
			$codeid = $codear['id'];
			$balquery = "SELECT motta
			  FROM shonu_kaichila
			  WHERE balakedara = '".$codeid."'";
			$balresult = $conn->query($balquery);
			$balarr = mysqli_fetch_array($balresult);
			$motta = round($balarr['motta'], 2);
			$nuamotta = round(($motta + $level2), 2);
			$tathya = mysqli_query($conn,"INSERT INTO `vyavahara` (`balakedara`,`ketebida`,`prakara`,`purba`,`bartaman`,`ayoga`,`koduvavanu`,`tiarikala`) VALUES ('".$codeid."','".$totalamount."','LVLCOMM2','".$motta."','".$nuamotta."','".$level2."','".$byabaharkarta."','".$shnunc."')");
			$nabikarana = "UPDATE shonu_kaichila set motta = '$nuamotta' where balakedara='$codeid'";
			$conn->query($nabikarana);
		}		
	}
	
	if($code2 != null){
		$codeqr = "SELECT id FROM shonu_subjects WHERE owncode = '".$code2."'";
		$coders = $conn->query($codeqr);
		$codear = mysqli_fetch_array($coders);
		if(isset($codear['id'])){
			$codeid = $codear['id'];
			$balquery = "SELECT motta
			  FROM shonu_kaichila
			  WHERE balakedara = '".$codeid."'";
			$balresult = $conn->query($balquery);
			$balarr = mysqli_fetch_array($balresult);
			$motta = round($balarr['motta'], 2);
			$nuamotta = round(($motta + $level3), 2);
			$tathya = mysqli_query($conn,"INSERT INTO `vyavahara` (`balakedara`,`ketebida`,`prakara`,`purba`,`bartaman`,`ayoga`,`koduvavanu`,`tiarikala`) VALUES ('".$codeid."','".$totalamount."','LVLCOMM3','".$motta."','".$nuamotta."','".$level3."','".$byabaharkarta."','".$shnunc."')");
			$nabikarana = "UPDATE shonu_kaichila set motta = '$nuamotta' where balakedara='$codeid'";
			$conn->query($nabikarana);
		}		
	}
	
	if($code3 != null){
		$codeqr = "SELECT id FROM shonu_subjects WHERE owncode = '".$code3."'";
		$coders = $conn->query($codeqr);
		$codear = mysqli_fetch_array($coders);
		if(isset($codear['id'])){
			$codeid = $codear['id'];
			$balquery = "SELECT motta
			  FROM shonu_kaichila
			  WHERE balakedara = '".$codeid."'";
			$balresult = $conn->query($balquery);
			$balarr = mysqli_fetch_array($balresult);
			$motta = round($balarr['motta'], 2);
			$nuamotta = round(($motta + $level4), 2);
			$tathya = mysqli_query($conn,"INSERT INTO `vyavahara` (`balakedara`,`ketebida`,`prakara`,`purba`,`bartaman`,`ayoga`,`koduvavanu`,`tiarikala`) VALUES ('".$codeid."','".$totalamount."','LVLCOMM4','".$motta."','".$nuamotta."','".$level4."','".$byabaharkarta."','".$shnunc."')");
			$nabikarana = "UPDATE shonu_kaichila set motta = '$nuamotta' where balakedara='$codeid'";
			$conn->query($nabikarana);
		}		
	}
	
	if($code4 != null){
		$codeqr = "SELECT id FROM shonu_subjects WHERE owncode = '".$code4."'";
		$coders = $conn->query($codeqr);
		$codear = mysqli_fetch_array($coders);
		if(isset($codear['id'])){
			$codeid = $codear['id'];
			$balquery = "SELECT motta
			  FROM shonu_kaichila
			  WHERE balakedara = '".$codeid."'";
			$balresult = $conn->query($balquery);
			$balarr = mysqli_fetch_array($balresult);
			$motta = round($balarr['motta'], 2);
			$nuamotta = round(($motta + $level5), 2);
			$tathya = mysqli_query($conn,"INSERT INTO `vyavahara` (`balakedara`,`ketebida`,`prakara`,`purba`,`bartaman`,`ayoga`,`koduvavanu`,`tiarikala`) VALUES ('".$codeid."','".$totalamount."','LVLCOMM5','".$motta."','".$nuamotta."','".$level5."','".$byabaharkarta."','".$shnunc."')");
			$nabikarana = "UPDATE shonu_kaichila set motta = '$nuamotta' where balakedara='$codeid'";
			$conn->query($nabikarana);
		}		
	}
	
	if($code5 != null){
		$codeqr = "SELECT id FROM shonu_subjects WHERE owncode = '".$code5."'";
		$coders = $conn->query($codeqr);
		$codear = mysqli_fetch_array($coders);
		if(isset($codear['id'])){
			$codeid = $codear['id'];
			$balquery = "SELECT motta
			  FROM shonu_kaichila
			  WHERE balakedara = '".$codeid."'";
			$balresult = $conn->query($balquery);
			$balarr = mysqli_fetch_array($balresult);
			$motta = round($balarr['motta'], 2);
			$nuamotta = round(($motta + $level6), 2);
			$tathya = mysqli_query($conn,"INSERT INTO `vyavahara` (`balakedara`,`ketebida`,`prakara`,`purba`,`bartaman`,`ayoga`,`koduvavanu`,`tiarikala`) VALUES ('".$codeid."','".$totalamount."','LVLCOMM6','".$motta."','".$nuamotta."','".$level6."','".$byabaharkarta."','".$shnunc."')");
			$nabikarana = "UPDATE shonu_kaichila set motta = '$nuamotta' where balakedara='$codeid'";
			$conn->query($nabikarana);
		}		
	}
?>
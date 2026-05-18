<?php 
	include("serive/samparka.php");

	$totalsucrech = 0;
	$totalfailrech = 0;
	$tsruser = [];
	$tfruser = [];
	$totalsucbet = 0;
	$tsbuser = [];
	$totalfailbet = 0;
	$tfbuser = [];
	$salary = 0;
	$ttrech = 0;

	$userquery = "Select id, owncode, mobile from shonu_subjects where status='1'";
	$exeuser = $conn->query($userquery);
	$totaluser = mysqli_num_rows($exeuser);

	$tem = date("Y-m-d H:i:s");
	$timestamp = strtotime($tem);
	$newTimestamp = $timestamp - 60 * 60 * 24;
	$newDate = date("Y-m-d H:i:s", $newTimestamp);

	while($getsingleuser = mysqli_fetch_array($exeuser)){
		$owncode = $getsingleuser['owncode'];
		$userid = $getsingleuser['id'];
		$mobile = $getsingleuser['mobile'];
		echo "User ID : ".$userid."<br>";
		
		$selectreferral = mysqli_query($conn,"select `id`, `mobile` from `shonu_subjects` where `code`='".$owncode."'");
		$totalreferral = mysqli_num_rows($selectreferral);
		echo "Total Referral : ".$totalreferral."<br>";
		
		$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
		$tbet_wg_1 = $selectbettingar_o['tbet'];
		
		$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_drei` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
		$tbet_wg_3 = $selectbettingar_o['tbet'];
		
		$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_funf` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
		$tbet_wg_5 = $selectbettingar_o['tbet'];
		
		$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_zehn` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
		$tbet_wg_10 = $selectbettingar_o['tbet'];

		$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
		$tbet_5d_1 = $selectbettingar_one_o['tbet_one'];
		
		$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_drei` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
		$tbet_5d_3 = $selectbettingar_one_o['tbet_one'];
		
		$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_funf` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
		$tbet_5d_5 = $selectbettingar_one_o['tbet_one'];
		
		$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_zehn` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
		$tbet_5d_10 = $selectbettingar_one_o['tbet_one'];

		$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
		$tbet_k3_1 = $selectbettingar_ten_o['tbet_ten'];
		
		$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_drei` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
		$tbet_k3_3 = $selectbettingar_ten_o['tbet_ten'];
		
		$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_funf` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
		$tbet_k3_5 = $selectbettingar_ten_o['tbet_ten'];
		
		$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_zehn` where `byabaharkarta`='".$userid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
		$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
		$tbet_k3_10 = $selectbettingar_ten_o['tbet_ten'];
		
		$selectbetting_av = mysqli_query($conn,"select SUM(`amount`) as tbet_av from `crashbetrecord` where `username`='".$mobile."' && DATE(`time`)=DATE('".$newDate."')");
		$selectbettingar_av = mysqli_fetch_array($selectbetting_av);
		$tbet_av = $selectbettingar_av['tbet_av'];
		
		$total_tbet_o = $tbet_wg_1 + $tbet_wg_3 + $tbet_wg_5 + $tbet_wg_10 + $tbet_5d_1 + $tbet_5d_3 + $tbet_5d_5 + $tbet_5d_10 + $tbet_k3_1 + $tbet_k3_3 + $tbet_k3_5 + $tbet_k3_10 + $tbet_av;
		
		if($totalreferral >= 3 && $total_tbet_o >= 300){
			while($getreferraldata = mysqli_fetch_array($selectreferral)){
				$referralid = $getreferraldata['id'];
				$referralmob = $getreferraldata['mobile'];
				echo "Referral IDs : ".$referralid."<br>";
				$selectrecharge = mysqli_query($conn,"select `shonu` from `thevani` where `balakedara`='".$referralid."' && `sthiti`='1' LIMIT 1");
				$successrecharge = mysqli_num_rows($selectrecharge);
				if($successrecharge > 0){
					$totalsucrech = $totalsucrech + 1;
					array_push($tsruser, $referralid);
					
					$sumchar = mysqli_query($conn,"select sum(`motta`) as recsum from `thevani` where `balakedara`='".$referralid."' && `sthiti`='1' && DATE(`dinankavannuracisi`)=DATE('".$newDate."')");
					$sumchar_f = mysqli_fetch_array($sumchar);
					$recsum = $sumchar_f['recsum'];
					$ttrech = $ttrech + $recsum;
					
					$selecref_tbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet from `bajikattuttate` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_o = mysqli_fetch_array($selecref_tbetting_o);
					$ref_tbet_wg_1 = $selecref_tbettingar_o['ref_tbet'];
					
					$selecref_tbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet from `bajikattuttate_drei` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_o = mysqli_fetch_array($selecref_tbetting_o);
					$ref_tbet_wg_3 = $selecref_tbettingar_o['ref_tbet'];
					
					$selecref_tbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet from `bajikattuttate_funf` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_o = mysqli_fetch_array($selecref_tbetting_o);
					$ref_tbet_wg_5 = $selecref_tbettingar_o['ref_tbet'];
					
					$selecref_tbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet from `bajikattuttate_zehn` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_o = mysqli_fetch_array($selecref_tbetting_o);
					$ref_tbet_wg_10 = $selecref_tbettingar_o['ref_tbet'];

					$selecref_tbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_one from `bajikattuttate_aidudi` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_one_o = mysqli_fetch_array($selecref_tbetting_one_o);
					$ref_tbet_5d_1 = $selecref_tbettingar_one_o['ref_tbet_one'];
					
					$selecref_tbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_one from `bajikattuttate_aidudi_drei` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_one_o = mysqli_fetch_array($selecref_tbetting_one_o);
					$ref_tbet_5d_3 = $selecref_tbettingar_one_o['ref_tbet_one'];
					
					$selecref_tbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_one from `bajikattuttate_aidudi_funf` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_one_o = mysqli_fetch_array($selecref_tbetting_one_o);
					$ref_tbet_5d_5 = $selecref_tbettingar_one_o['ref_tbet_one'];
					
					$selecref_tbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_one from `bajikattuttate_aidudi_zehn` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_one_o = mysqli_fetch_array($selecref_tbetting_one_o);
					$ref_tbet_5d_10 = $selecref_tbettingar_one_o['ref_tbet_one'];

					$selecref_tbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_ten from `bajikattuttate_kemuru` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_ten_o = mysqli_fetch_array($selecref_tbetting_ten_o);
					$ref_tbet_k3_1 = $selecref_tbettingar_ten_o['ref_tbet_ten'];
					
					$selecref_tbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_ten from `bajikattuttate_kemuru_drei` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_ten_o = mysqli_fetch_array($selecref_tbetting_ten_o);
					$ref_tbet_k3_3 = $selecref_tbettingar_ten_o['ref_tbet_ten'];
					
					$selecref_tbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_ten from `bajikattuttate_kemuru_funf` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_ten_o = mysqli_fetch_array($selecref_tbetting_ten_o);
					$ref_tbet_k3_5 = $selecref_tbettingar_ten_o['ref_tbet_ten'];
					
					$selecref_tbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as ref_tbet_ten from `bajikattuttate_kemuru_zehn` where `byabaharkarta`='".$referralid."' && DATE(`tiarikala`)=DATE('".$newDate."')");
					$selecref_tbettingar_ten_o = mysqli_fetch_array($selecref_tbetting_ten_o);
					$ref_tbet_k3_10 = $selecref_tbettingar_ten_o['ref_tbet_ten'];
					
					$selecref_tbetting_av = mysqli_query($conn,"select SUM(`amount`) as ref_tbet_av from `crashbetrecord` where `username`='".$referralmob."' && DATE(`time`)=DATE('".$newDate."')");
					$selecref_tbettingar_av = mysqli_fetch_array($selecref_tbetting_av);
					$ref_tbet_av = $selecref_tbettingar_av['ref_tbet_av'];

					$total_tbet = $ref_tbet_wg_1 + $ref_tbet_wg_3 + $ref_tbet_wg_5 + $ref_tbet_wg_10 + $ref_tbet_5d_1 + $ref_tbet_5d_3 + $ref_tbet_5d_5 + $ref_tbet_5d_10 + $ref_tbet_k3_1 + $ref_tbet_k3_3 + $ref_tbet_k3_5 + $ref_tbet_k3_10 + $ref_tbet_av;

					if($total_tbet >= 300){
						$totalsucbet = $totalsucbet + 1;
						array_push($tsbuser, $referralid);
					}
					else{
						$totalfailbet = $totalfailbet + 1;
						array_push($tfbuser, $referralid);
					}
				}
				else{
					$totalfailrech = $totalfailrech + 1;
					array_push($tfruser, $referralid);
				}
			}
			echo "Success Recharge : ".json_encode($tsruser);
			echo "<br>";
			echo "Failed Recharge : ".json_encode($tfruser);
			echo "<br>";
			echo "Success Bet : ".json_encode($tsbuser);
			echo "<br>";
			echo "Failed Bet : ".json_encode($tfbuser);
			if($totalsucbet >= 3 && $totalsucbet < 5 && $ttrech >= 300){
				$salary = 100;
			}
			else if($totalsucbet >= 5 && $totalsucbet < 10 && $ttrech >= 300){
				$salary = 300;
			}
			else if($totalsucbet >= 10 && $totalsucbet < 15 && $ttrech >= 300){
				$salary = 700;
			}
			else if($totalsucbet >= 15 && $totalsucbet < 20 && $ttrech >= 10000){
				$salary = 1000;
			}
			else if($totalsucbet >= 20 && $totalsucbet < 30 && $ttrech >= 20000){
				$salary = 2000;
			}
			else if($totalsucbet >= 30 && $totalsucbet < 50 && $ttrech >= 30000){
				$salary = 3000;
			}
			else if($totalsucbet >= 50 && $totalsucbet < 70 && $ttrech >= 50000){
				$salary = 5000;
			}
			else if($totalsucbet >= 70 && $totalsucbet < 150 && $ttrech >= 70000){
				$salary = 7000;
			}
			else if($totalsucbet >= 150 && $totalsucbet < 250 && $ttrech >= 150000){
				$salary = 15000;
			}
			else if($totalsucbet >= 250 && $totalsucbet < 500 && $ttrech >= 250000){
				$salary = 25000;
			}
			else if($totalsucbet >= 500 && $ttrech >= 400000){
				$salary = 40000;
			}
			echo "<br>";
			echo "Total Salary : ".$salary;

			$up = mysqli_query($conn, "SELECT * FROM `shonu_kaichila` WHERE balakedara = $userid");
    		$rup = mysqli_fetch_array($up);

    		$addmoney = $rup['motta'] + $salary;

    		echo "<br>";
			echo "Final Money : ".$addmoney;
			echo "<br>";

    		//$wal = mysqli_query($conn, "UPDATE `shonu_kaichila` SET motta = $addmoney WHERE balakedara = $userid");

    		$sql= mysqli_query($conn,"INSERT INTO `dailysalary`(`userid`,`totalsucrech`,`totalfailrech`,`tsruser`,`tfruser`,`totalsucbet`,`tsbuser`,`totalfailbet`,`tfbuser`,`salary`,`createdate`) VALUES ('".$userid."','".$totalsucrech."','".$totalfailrech."','".json_encode($tsruser)."','".json_encode($tfruser)."','".$totalsucbet."','".json_encode($tsbuser)."','".$totalfailbet."','".json_encode($tfbuser)."','".$salary."','".$tem."')");

    		$totalsucrech = 0;
			$totalfailrech = 0;
			$tsruser = [];
			$tfruser = [];
			$totalsucbet = 0;
			$tsbuser = [];
			$totalfailbet = 0;
			$tfbuser = [];
			$salary = 0;
			$ttrech = 0;
		}
	}
?>
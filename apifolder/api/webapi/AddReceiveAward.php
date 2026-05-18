<?php 
	include "../../conn.php";
	
	$vipquery = "SELECT expe, lvl
	  FROM vip
	  WHERE userid = ".$byabaharkarta;
	$vipresult = $conn->query($vipquery);
	$viprow = mysqli_num_rows($vipresult);
	if($viprow >=1){
		$viparr = mysqli_fetch_array($vipresult);
		$expe = $viparr['expe'] + $totalamount;
		$orlvl = $viparr['lvl'];
		if($expe >= 3000 && $expe < 30000){
			$lvl = 1;
			$diff = $lvl - $orlvl;
			if($diff == 1){
				$giveamt = 60 + 30;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
		}
		else if($expe >= 30000 && $expe < 400000){
			$lvl = 2;
			$diff = $lvl - $orlvl;
			if($diff == 1){
				$giveamt = 180 + 90;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 2){
				$giveamt = 60 + 30 + 180 + 90;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
		}
		else if($expe >= 400000 && $expe < 4000000){
			$lvl = 3;
			$diff = $lvl - $orlvl;
			if($diff == 1){
				$giveamt = 690 + 290;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 2){
				$giveamt = 180 + 90 + 690 + 290;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 3){
				$giveamt = 60 + 30 + 180 + 90 + 690 + 290;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
		}
		else if($expe >= 4000000 && $expe < 20000000){
			$lvl = 4;
			$diff = $lvl - $orlvl;
			if($diff == 1){
				$giveamt = 1890 + 890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 2){
				$giveamt = 690 + 290 + 1890 + 890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 3){
				$giveamt = 180 + 90 + 690 + 290 + 1890 + 890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 4){
				$giveamt = 60 + 30 + 180 + 90 + 690 + 290 + 1890 + 890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
		}
		else if($expe >= 20000000){
			$lvl = 5;
			$diff = $lvl - $orlvl;
			if($diff == 1){
				$giveamt = 6900 + 1890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 2){
				$giveamt = 1890 + 890 + 6900 + 1890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 3){
				$giveamt = 690 + 290 + 1890 + 890 + 6900 + 1890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 4){
				$giveamt = 180 + 90 + 690 + 290 + 1890 + 890 + 6900 + 1890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
			else if($diff == 5){
				$giveamt = 60 + 30 + 180 + 90 + 690 + 290 + 1890 + 890 + 6900 + 1890;
				$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
				$conn->query($nabikarana);
			}
		}
		else{
			$lvl = 0;
			$giveamt = 0;
		}
		$nabikarana = "UPDATE vip set expe = '$expe', lvl = '$lvl', createdate = '$shnunc' where userid='$byabaharkarta'";
		$conn->query($nabikarana);
	}
	else{
		$expe = $totalamount;
		if($expe >= 3000 && $expe < 30000){
			$lvl = 1;
			$giveamt = 60 + 30;
		}
		else if($expe >= 30000 && $expe < 400000){
			$lvl = 2;
			$giveamt = 60 + 30 + 180 + 90;
		}
		else if($expe >= 400000 && $expe < 4000000){
			$lvl = 3;
			$giveamt = 60 + 30 + 180 + 90 + 690 + 290;
		}
		else if($expe >= 4000000 && $expe < 20000000){
			$lvl = 4;
			$giveamt = 60 + 30 + 180 + 90 + 690 + 290 + 1890 + 890;
		}
		else if($expe >= 20000000){
			$lvl = 5;
			$giveamt = 60 + 30 + 180 + 90 + 690 + 290 + 1890 + 890 + 6900 + 1890;
		}
		else{
			$lvl = 0;
			$giveamt = 0;
		}
		$tathya = mysqli_query($conn,"INSERT INTO `vip` (`userid`,`expe`,`lvl`,`createdate`) VALUES ('".$byabaharkarta."','".$expe."','".$lvl."','".$shnunc."')");
		$nabikarana = "UPDATE shonu_kaichila set motta = motta + '$giveamt' where balakedara='$byabaharkarta'";
		$conn->query($nabikarana);
	}
?>
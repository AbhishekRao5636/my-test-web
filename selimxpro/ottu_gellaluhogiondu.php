<?php 
	include("conn.php");
	$getperiod_Query=mysqli_query($conn,"select * from `gelluonduhogu` order by kramasankhye desc limit 1");
	$getperiodRow=mysqli_num_rows($getperiod_Query);
	$getperiodidRow=mysqli_fetch_array($getperiod_Query);
	$periodid=$getperiodidRow['atadaaidi'];	
	$chkResult=mysqli_query($conn,"select * from `gellaluhogiondu_phalitansa` where `kalaparichaya`='".$periodid."'");
	$chkResultRow=mysqli_num_rows($chkResult);	
	if($chkResultRow == null){
		$selectData=mysqli_query($conn,"select * from `bajikattuttate` where `kalaparichaya`='".$periodid."'");
		$selectdataRow=mysqli_num_rows($selectData);
		if($selectdataRow != null){
			$chksapregreenQuery=mysqli_query($conn,"select * from `bajikattuttate` where `kalaparichaya`='".$periodid."'");
			$chksapregreenRow=mysqli_num_rows($chksapregreenQuery);
			if($chksapregreenRow != null){
				$totalgreentabquery=mysqli_query($conn,"SELECT (SUM(ketebida)-(SUM(ketebida)/100*2)) as totalamount
					FROM
					`bajikattuttate` where `kalaparichaya`='$periodid'");
				$totalgreentab=mysqli_fetch_array($totalgreentabquery);
				echo $totalgreentab["totalamount"];
			}else {echo 0;}
		}else {echo "0";}			
	}
	else{echo 0;}
?>
<?php
	include('conn.php');
	if(isset($_POST['editid']))
	{
		$amount = mysqli_real_escape_string($conn, $_POST['amount']);
		$roleid = ($_POST['editid']);
		$date=date( 'Y-m-d h:i:s' );

		$role_query=mysqli_query($conn, "UPDATE `shonu_kaichila` SET `motta`='".$amount."' WHERE `balakedara` ='".$roleid."'");
		if($role_query){	
			echo"1";
		}
		else{ 
			echo"0";
		}				
	}		
?>
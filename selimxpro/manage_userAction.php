<?php
include('conn.php');

if(isset($_POST['type'])){
	if($_POST['type']=='chk'){
		$sqlA = "Update `shonu_subjects` set status = '0' where `id`='".$_POST['id']."' ";
		mysqli_query($conn,$sqlA);
	}
	else if($_POST['type']=='unchk'){
		$time=date( 'Y-m-d H:i:s' );
		$sqlA = "Update `shonu_subjects` set status = '1' where `id`='".$_POST['id']."' ";
		mysqli_query($conn,$sqlA);
	}
	else if($_POST['type']=='delete'){	
		$dellid=$_POST['id'];	
		$sqlDel = "Delete from `shonu_subjects` where `id` in ($dellid) ";
		$querydel=mysqli_query($conn,$sqlDel);
		if($querydel){
			echo "1";
		}
		else{
			echo "0";
		}
	}	
}
?>
<?php 
include("conn.php");
if(isset($_POST['app'])){
    
    $uid = $_POST['uid'];
    $deposit = $_POST['amount'];
	$depositdup = $deposit;
	
	$sid = $_POST['sid'];
	
	$ref_num = $_POST['ref_num'];

    date_default_timezone_set('Asia/Kolkata');
    $today = date("F j, Y, g:i a"); 
	$tday = date("Y-m-d H:i");
	
	$dt = $_POST['date'];//added
	$timestamp = strtotime($dt);
	$dt2 = date("Y-m-d H:i", $timestamp);
	
	//Find referer
	$self = mysqli_query($conn , "SELECT code FROM shonu_subjects WHERE id = '".$uid."'");
	$selfArray = mysqli_fetch_array($self);
	$ref = mysqli_query($conn , "SELECT id FROM shonu_subjects WHERE owncode = '".$selfArray['code']."'");
	$refArray = mysqli_fetch_array($ref);
	$refid = $refArray['id'];
	
	if($depositdup>='500' && $depositdup<'1000'){
		$refbn = 0;
	}
	else if($depositdup>='1000' && $depositdup<'3000'){
		$refbn = 0;
	}
	else if($depositdup>='3000' && $depositdup<'4000'){
		$refbn = 0;
	}
	else if($depositdup>='4000' && $depositdup<'5000'){
		$refbn = 0;
	}
	else if($depositdup>='5000' && $depositdup<'10000'){
		$refbn = 0;
	}
	else if($depositdup>='10000' && $depositdup<'50000'){
		$refbn = 0;
	}
	else if($depositdup>='50000' && $depositdup<'100000'){
		$refbn = 0;
	}
	else if($depositdup>='100000'){
		$refbn = 0;
	}
	else{
		$refbn = 0;
	}
	
	$refbnthr = 0;
	$refwal = mysqli_query($conn , "SELECT motta FROM shonu_kaichila WHERE balakedara = '".$refid."'");
	$refwalA = mysqli_fetch_array($refwal);
	$refwalB = $refwalA['motta'];
	$refwalF = intval($refwalB) + intval($refbn);
	$refwalFthr = intval($refwalB) + intval($refbnthr);
	
	//Find 1st Rech
	$up2 = mysqli_query($conn , "SELECT shonu FROM thevani WHERE balakedara = '".$uid."' && sthiti = '1'");
	$up2row = mysqli_num_rows($up2);
	
  	//Bonus
  	$rechqueryaa = mysqli_query($conn, "SELECT rechargebonus FROM parametredepaiement");
    $rechqueryarrayaa = mysqli_fetch_array($rechqueryaa);
    $rechargebonus = $rechqueryarrayaa['rechargebonus'];
  	$bn = '0';
  	if($up2row == 0){
		//$bn = ($rechargebonus*$depositdup)/100;
		$bn = '0';
		} else {$bn = '0';}
  
	
    $up = mysqli_query($conn , "SELECT motta FROM shonu_kaichila WHERE balakedara = '".$uid."'");
    $rup = mysqli_fetch_array($up);
         
    $addmoney = intval($rup['motta']) + intval($deposit) + intval($bn);

     $wal = mysqli_query($conn, "UPDATE shonu_kaichila SET motta = '".$addmoney."' WHERE balakedara = '".$uid."'");
    
    if($wal){
        $succes = mysqli_query($conn, "UPDATE thevani SET sthiti = '1' WHERE balakedara = '".$uid."' && motta = '$deposit' && dinankavannuracisi = '".$dt."' && shonu = '".$sid."'");//dt added
		
		if($up2row == 0){
			$refwll = mysqli_query($conn, "UPDATE shonu_kaichila SET motta = '".$refwalF."' WHERE balakedara = '".$refid."'");
		}
		else if($up2row== 2){
			$refwll = mysqli_query($conn, "UPDATE shonu_kaichila SET motta = '".$refwalFthr."' WHERE balakedara = '".$refid."'");
		}              				
		
		echo "1~".$sid;
	}else{
        echo "2"; 
    }
}

?>
<?php 
if(isset($_POST['rej'])){
	
	$sid = $_POST['sid'];
	$ref_num = $_POST['ref_num'];
	$dt = $_POST['date'];//added
	$timestamp = strtotime($dt);
	$dt2 = date("Y-m-d H:i", $timestamp);
	
	date_default_timezone_set('Asia/Kolkata');
	$tdayy = date("Y-m-d H:i");
    
    $uid = $_POST['uid'];
    $deposit = $_POST['amount'];
    
    $reject = mysqli_query($conn, "UPDATE thevani SET sthiti = '2' WHERE balakedara = '".$uid."' && motta = '$deposit' && dinankavannuracisi = '".$dt."' && shonu = '".$sid."'");//dt added
	
	/*$susquery = "SELECT status FROM deposits WHERE uid = '".$uid."' ORDER BY id DESC LIMIT 3";
	$susresult = mysqli_query($conn, $susquery);
	if ($susresult) {
		$statuses = array();
		while ($susrow = mysqli_fetch_assoc($susresult)) {
			$statuses[] = $susrow['status'];
		}

		if (count(array_unique($statuses)) == 1 && reset($statuses) == 3) {
			$rchsus = mysqli_query($conn , "SELECT status FROM tb_rchsus WHERE userid = '".$uid."'");
			$rchsusrow = mysqli_num_rows($rchsus);
			if($rchsusrow < 1){
				$sql5= mysqli_query($conn,"INSERT INTO tb_rchsus(userid,createdate,status) VALUES ('".$uid."','".$tdayy."','1')");
			}
			else{
				$sql6 = mysqli_query($conn, "UPDATE tb_rchsus SET status = '1' WHERE userid = '".$uid."'");
			}
		}

		mysqli_free_result($susresult);
	}*/
	
	if($reject){
		echo "1~".$sid;
	}
	else{
		echo"2";
	}
}
?>
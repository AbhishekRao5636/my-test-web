<?php
include "./conn.php";
$connect = new PDO("mysql:host=localhost;dbname=selimx_pro", "selimx_pro", "selimx_pro");
if (isset($_SERVER['HTTP_ORIGIN'])) {
	// Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
	// you want to allow, and if so:
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Max-Age: 1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
		// may also be using PUT, PATCH, HEAD etc
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
	}

	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
		header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
	}
	exit(0);
}

$res = array('error' => false);
$action = '';
$user = '';

if (isset($_GET['action'])) {

	$action = $_GET['action'];
}
if ($action == 'info') {
	$data = array();
	$user = $_GET['user'];
	//$per = $_GET['per'];
	$per = 'crashbt';
	
	$sql_u = "SELECT id FROM shonu_subjects WHERE mobile='$user'";
	$result_u = $conn->query($sql_u);
	$row_u = mysqli_fetch_array($result_u);
	$userid = $row_u['id'];
	
	$sql1 = "SELECT motta FROM shonu_kaichila WHERE balakedara='$userid'";
	$result1 = $conn->query($sql1);
	$row1 = mysqli_fetch_array($result1);
	$balance = (int)$row1['motta'];
	if($per=="FastParity"){
	    $sql2 = "SELECT period FROM period WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	}else if($per=="Sapre"){
	    $sql2 = "SELECT period FROM sapreperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	}else if($per=="Parity"){
	    $sql2 = "SELECT period FROM emredperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	}else if($per=="Dice"){
	    $sql2 = "SELECT period FROM beconeperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	}else if($per=="Wheelocity"){
	    $sql2 = "SELECT period FROM vipperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	}else if($per=="AndharBahar"){
	    $sql2 = "SELECT period,num FROM abperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	$startnum = $row2['num'];
	}
	

	$opt9 = "SELECT COUNT(*) as total9 FROM `betrec` ";
	$optres9 = $conn->query($opt9);
	$sum9 = mysqli_fetch_assoc($optres9);
	$total = $sum9['total9'];

	/*$opt22= "SELECT COUNT(*) as total22 FROM `deposits` WHERE uid='$userid' ";
	$optres222 = $conn->query($opt22);
	$sum2 = mysqli_fetch_assoc($optres222);
	$total2 = $sum2['total22'];
	$opt220= "SELECT COUNT(*) as total220 FROM `tbl_betting` WHERE userid='$userid' ";
	$optres2220 = $conn->query($opt220);
	$sum20 = mysqli_fetch_assoc($optres2220);
	$total20 = $sum20['total220'];


	$opt = "SELECT COUNT(*) as total FROM `tbl_betting` WHERE userid='$userid' ";
	$optres = $conn->query($opt);
	$sum = mysqli_fetch_assoc($optres);
	$total1 = $sum['total'];*/
	
	$period = 123456;
	$total1 = 0;
	$total2 = 23;
	$total20 = 40;
	
	if($per=="AndharBahar"){
	    array_push($data, ['balance' => $balance], ['total' => $total], ['period' => $period],['total1' => $total1],['startnum' => $startnum]);}else{
    array_push($data, ['balance' => $balance], ['total' => $total], ['period' => $period],['total1' => $total1],['rech' => $total2],['trans' => $total20]);
}
	
	
		
	echo json_encode($data);
} else if ($action =='crashgamedata') {
		$usrs = $_GET['user'];
      	$end = 20;

	$query = "SELECT id,crashpoint FROM crashgamerecord WHERE username='$usrs' ORDER BY id DESC LIMIT " .$end;
	$statement = $connect->prepare($query);
	$statement->execute(); 
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data[] = $row;
	}

	echo json_encode($data);
} else if ($action == 'resultrecord') {
    $server= $_GET['server'];
    if($server=="FastParity"){
      	$end = 300;
	$st = 0;
	$query = "SELECT * FROM betrec ORDER BY id DESC LIMIT " . $st . ',' . $end;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Parity"){
      	$end = 300;
	$st = 0;
	$query = "SELECT * FROM emredbetrec ORDER BY id DESC LIMIT " . $st . ',' . $end;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Sapre"){
      	$end = 300;
	$st = 0;
	$query = "SELECT * FROM saprebetrec ORDER BY id DESC LIMIT " . $st . ',' . $end;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Dice"){
      	$end = 300;
	$st = 0;
	$query = "SELECT * FROM beconebetrec ORDER BY id DESC LIMIT " . $st . ',' . $end;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Wheelocity"){
      	$end = 300;
	$st = 0;
	$query = "SELECT * FROM vipbetrec ORDER BY id DESC LIMIT " . $st . ',' . $end;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="AndharBahar"){
      	$end = 300;
	$st = 0;
	$query = "SELECT * FROM abbetrec ORDER BY id DESC LIMIT " . $st . ',' . $end;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }

	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data[] = $row;
	}

	echo json_encode($data);
}else if ($action =='transrecord') {

   $user= $_GET['user'];
   $sql1 = "SELECT usercode FROM users WHERE username='$user'";
	$result1 = $conn->query($sql1);
	$row1 = mysqli_fetch_array($result1);
	$user_code= $row1['usercode'];
      	$end = 300;
	$st = 0;
	$query = "SELECT * FROM trans WHERE username='$user' OR username ='$user_code' ORDER BY id DESC LIMIT " . $st . ',' . $end;
	$statement = $connect->prepare($query);
	$statement->execute();  
    

	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data[] = $row;
	}

	echo json_encode($data);
}else if ($action == 'result') {
    $server= $_GET['server'];
    if($server=="FastParity"){
    $sql2 = "SELECT period FROM period WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	$cal=$period % 10;
    $limit=19+$cal;
	$query = "SELECT * FROM betrec ORDER BY id DESC LIMIT " . $limit ;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Parity"){
    $sql2 = "SELECT period FROM emredperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	$cal=$period % 10;
    $limit=19+$cal;
	$query = "SELECT * FROM emredbetrec ORDER BY id DESC LIMIT " . $limit ;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Sapre"){
    $sql2 = "SELECT period FROM sapreperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	$cal=$period % 10;
    $limit=19+$cal;
	$query = "SELECT * FROM saprebetrec ORDER BY id DESC LIMIT " . $limit ;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Dice"){
    $sql2 = "SELECT period FROM beconeperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	$cal=$period % 10;
    $limit=19+$cal;
	$query = "SELECT * FROM beconebetrec ORDER BY id DESC LIMIT " . $limit ;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="Wheelocity"){
    $sql2 = "SELECT period FROM vipperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
    $limit=9;
	$query = "SELECT * FROM vipbetrec ORDER BY id DESC LIMIT " . $limit ;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }else if($server=="AndharBahar"){
    $sql2 = "SELECT period FROM abperiod WHERE id=1";
	$result2 = $conn->query($sql2);
	$row2 = mysqli_fetch_array($result2);
	$period = $row2['period'];
	$cal=$period % 10;
    $limit=19+$cal;
	$query = "SELECT * FROM abbetrec ORDER BY id DESC LIMIT " . $limit ;
	$statement = $connect->prepare($query);
	$statement->execute();  
    }

	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data[] = $row;
	}
    $data=array_reverse($data);
	echo json_encode($data);
}else if ($action == 'reset') {
	$user = $_POST['username'];
	$otp=$_POST["code"];

	$query0 =  "SELECT  username FROM verify  WHERE otp='$otp' ORDER BY id DESC";
	$result3 =$conn->query($query0);
	$row3 = mysqli_fetch_assoc($result3);
	if(isset($row3['username'])){
	$verun=$row3['username'];
	}else{
	$verun="none";
	}
	
	if($verun==$user){
		$username=$_POST['username'];
		$password=$_POST['password'];
	
		$data = array();
		$opt9 = "SELECT COUNT(*) as total9 FROM `users` WHERE username = '$username' ";
	   $optres9 = $conn->query($opt9);
	   $sum9 = mysqli_fetch_assoc($optres9);
	   $usernum=$sum9['total9'];
		if($usernum==1){
		
		
			$query="UPDATE users SET password='$password' WHERE username='$username'";
			$statement = $connect->prepare($query);
			$statement->execute();
			$status="success";
			array_push($data, ['status' => $status]);
			echo json_encode($data);
		}else{
			$status="User Does not exists";
		array_push($data, ['status' => $status]);
		echo json_encode($data);
		}
		
		
	}else{
		
	
	
		$data = array();
		$status="Incorrect otp";
		array_push($data, ['status' => $status]);
		echo json_encode($data);
	}
	
	
}elseif($action == 'changenickname'){
    	$username=$_GET['user'];
		$nickname=$_GET['nickname'];
    $query="UPDATE users SET nickname='$nickname' WHERE username='$username'";
			$statement = $connect->prepare($query);
			$statement->execute();
}elseif($action == 'changepassword'){
    	$username=$_GET['user'];
		$password=$_GET['password'];
    $query="UPDATE users SET password='$password' WHERE username='$username'";
			$statement = $connect->prepare($query);
			$statement->execute();
} else if ($action == 'reward') {
	$data1 = array();
	$user = $_GET['user'];
	$sql1 = "SELECT usercode FROM users WHERE username='$user'";
	$result1 = $conn->query($sql1);
	$row1 = mysqli_fetch_array($result1);
	$user_code= $row1['usercode'];
	$end1 = 10;
	$page1 = $_GET['page1'];
	$st1 = ($page1 - 1) * $end1;
	$query = "SELECT * FROM bonus WHERE usercode='$user_code' ORDER BY id DESC LIMIT " . $st1 . ',' . $end1;
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
	}

	echo json_encode($data1);
}else if ($action == 'todaysign') {
	$user=$_GET['username'];
	$sql7 = "INSERT INTO signin (username,amount) VALUES ('$user',0)";
	$conn->query($sql7);
	$sql9="UPDATE users SET  balance = balance WHERE username='$user'" ;
    $conn->query($sql9); 
}
else if ($action == 'dailysign') {
	$data = array();
	$user=$_GET['username'];
	$opt9="SELECT COUNT(*) as total9 FROM `signin` WHERE username='$user' ";
	$optres9=$conn->query($opt9);
	$sum9= mysqli_fetch_assoc($optres9);
	
	if($sum9['total9']==""){
		$days=0;
	   
	}else{
		$days=$sum9['total9'];
	}
	$opt9t="SELECT COUNT(*) as total9 FROM `signin` WHERE username='$user' AND DATE(`created`) >= NOW() - INTERVAL 1 DAY";
	$optres9t=$conn->query($opt9t);
	$sum9t= mysqli_fetch_assoc($optres9t);
	
	if($sum9t['total9']=="" || $sum9t['total9']=="0"){
		$status="Not signed in";
	   
	}else{
		$status="Had signed in";
	}
	$opt90="SELECT sum(amount) as total90 FROM `signin` WHERE username='$user' ";
	$optres90=$conn->query($opt90);
	$sum90= mysqli_fetch_assoc($optres90);
	
	if($sum90['total90']==""){
		$total=0;
	   
	}else{
		$total=$sum90['total90'];
	}
	$opt900="SELECT amount  FROM `signin` WHERE username='$user'  ORDER BY id DESC";
	$optres900=$conn->query($opt900);
	$sum900= mysqli_fetch_assoc($optres900);
	

		$tam=$sum900['amount'];;
	   
	
 
array_push($data, ['status' => $status,'days' => $days,'tam'=>$tam,'total'=>$total]);
	echo json_encode($data);
}else if ($action == 'betrec') {
	$user = $_GET['user'];
	$server = $_GET['server'];

    //$data1[] = null;
	$st1 = 10;
	if($server=="FastParity"){
	  $query = "SELECT * FROM betting WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 ;  
	}else if($server=="Parity"){
	  $query = "SELECT * FROM emredbetting WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 ;  
	}else if($server=="Sapre"){
	  $query = "SELECT * FROM saprebetting WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 ;  
	}else if($server=="Dice"){
	  $query = "SELECT * FROM beconebetting WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 ;  
	}else if($server=="Wheelocity"){
	  $query = "SELECT * FROM vipbetting WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 ;  
	}else if($server=="AndharBahar"){
	  $query = "SELECT * FROM abbetting WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 ;  
	}else if($server=="Crash"){
	  $query = "SELECT * FROM crashbetrecord WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 ;  
	}
	
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
	}
    if(!isset($data1)){
        $data1 = null;
    }
	echo json_encode($data1);
}  else if ($action == 'bet') {
	$data = array();
	$user=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
	$period=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['period']));
	$ans=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['ans']));
	$amount=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['amount']));
	$server=htmlspecialchars(mysqli_real_escape_string($conn, $_GET['server']));$user=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['username']));
	$period=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['period']));
	$ans=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['ans']));
	$amount=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['amount']));
	$server=htmlspecialchars(mysqli_real_escape_string($conn, $_GET['server']));
	if($server=="FastParity"){
	    $sql2 ="INSERT INTO betting (username,period,ans,amount) VALUES ('$user', $period,'$ans',$amount)";
	     $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','FastParity betting',$amount)";
	$conn->query($transquery);
	}else if($server=="Parity"){
	    $sql2 ="INSERT INTO emredbetting (username,period,ans,amount) VALUES ('$user', $period,'$ans',$amount)";
	     $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','Parity betting',$amount)";
	$conn->query($transquery);
	}else if($server=="Sapre"){
	    $sql2 ="INSERT INTO saprebetting (username,period,ans,amount) VALUES ('$user', $period,'$ans',$amount)";
	     $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','Sapre betting',$amount)";
	$conn->query($transquery);
	}else if($server=="Dice"){
	    $sql2 ="INSERT INTO beconebetting (username,period,ans,amount) VALUES ('$user', $period,'$ans',$amount)";
	     $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','Dice betting',$amount)";
	$conn->query($transquery);
	}else if($server=="Wheelocity"){
	    $sql2 ="INSERT INTO vipbetting (username,period,ans,amount) VALUES ('$user', $period,'$ans',$amount)";
	     $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','Circle betting',$amount)";
	$conn->query($transquery);
	}else if($server=="AndharBahar"){
	    $sql2 ="INSERT INTO abbetting (username,period,ans,amount) VALUES ('$user', $period,'$ans',$amount)";
	     $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','AndharBahar betting',$amount)";
	$conn->query($transquery);
	}
    
    $blquery = "SELECT balance FROM users WHERE username='$user'";
	$blresult = $conn->query($blquery);
	$blarray = mysqli_fetch_array($blresult);
	$blbalance = $blarray['balance'];
	if($blbalance>=$amount){
		$sql="UPDATE users SET  balance = balance-$amount WHERE username='$user'" ;
		$conn->query($sql); 
		$result=$conn->query($sql2);
		if($result===true){
			$status="Bet Added Successfully";
		}else{
			$status="Somthing Went Wrong";
		}   
	}
	else{
		$status="Insufficient Balance";
	}
    
    /*$sql="UPDATE users SET  balance = balance-$amount WHERE username='$user'" ;
    $conn->query($sql); 
    $result=$conn->query($sql2);
	if($result===true){
        $status="Bet Added Successfully";
	}else{
        $status="Somthing Went Wrong";
	} */ 
array_push($data, ['status' => $status],['amount' => $amount],['ans' => $ans],['user' => $user]);
	echo json_encode($data);
}
else if ($action == 'withdrawal') {
	$data = array();
	$user=$_GET['user'];
	$upi=$_GET['upi'];
	$amount1=$_GET['amount'];
	
	$sql14 = "SELECT COUNT(*) AS wcount FROM record WHERE username = '$user' AND created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
	$result14 = $conn->query($sql14);
	$row14 = mysqli_fetch_array($result14);
	$wcount = $row14['wcount'];

	$opt22= "SELECT SUM(recharge) as total22 FROM `recharge` WHERE username='$user' AND status='Success' ";
	$optres222 = $conn->query($opt22);
	$sum2 = mysqli_fetch_assoc($optres222);
	$total2 = $sum2['total22'];
	$opt="SELECT SUM(amount) as total FROM `abbetting` WHERE username='$user'";
$optres=$conn->query($opt);
$sum= mysqli_fetch_assoc($optres);
if($sum['total']==""){
    $bonus=0;
    
}else{
    $bonus=round($sum['total'],2);
}
	$opt1="SELECT SUM(amount) as total1 FROM `betting` WHERE username='$user'";
	$optres1=$conn->query($opt1);
	$sum1= mysqli_fetch_assoc($optres1);
	if($sum1['total1']==""){
		$bonus1=0;
		
	}else{
		$bonus1=round($sum1['total1'],2);
	}
	$opt2="SELECT SUM(amount) as total2 FROM `saprebetting` WHERE username='$user'";
	$optres2=$conn->query($opt2);
	$sum2= mysqli_fetch_assoc($optres2);
	if($sum2['total2']==""){
		$bonus2=0;
		
	}else{
		$bonus2=round($sum2['total2'],2);
	}
	$opt3="SELECT SUM(amount) as total3 FROM `emredbetting` WHERE username='$user'";
	$optres3=$conn->query($opt3);
	$sum3= mysqli_fetch_assoc($optres3);
	if($sum3['total3']==""){
		$bonus3=0;
		
	}else{
		$bonus3=round($sum3['total3'],2);
	}
	$opt4="SELECT SUM(amount) as total4 FROM `beconebetting` WHERE username='$user'";
	$optres4=$conn->query($opt4);
	$sum4= mysqli_fetch_assoc($optres4);
	if($sum4['total4']==""){
		$bonus4=0;
		
	}else{
		$bonus4=round($sum4['total4'],2);
	}
	$opt5="SELECT SUM(amount) as total5 FROM `crashbetrecord` WHERE username='$user'";
	$optres5=$conn->query($opt5);
	$sum5= mysqli_fetch_assoc($optres5);
	if($sum5['total5']==""){
		$bonus5=0;
		
	}else{
		$bonus5=round($sum5['total5'],2);
	}

	$brit = $bonus + $bonus1 + $bonus3 + $bonus4 + $bonus5;

	$opt6="SELECT SUM(amount) as total6 FROM `bonus` WHERE usercode=(select usercode FROM `users` WHERE  username='$user')";
	$optres6=$conn->query($opt6);
	$sum6= mysqli_fetch_assoc($optres6);
	if($sum6['total6']==""){
		$bonus6=0;
		
	}else{
		$bonus6=round($sum6['total6'],2);
	}

	if($total2>0){
	if($wcount<=4){
		if($brit >= $bonus6){
			if($_GET['amount']>1500){
				$amount=round((98/100)*$_GET['amount']);
			}else{
				$amount=$_GET['amount']-30;
			}
			
			function random_strings($length_of_string)
			{
		
				// String of all alphanumeric character
				$str_result = '0123456789AXYZ012345678901234567890123456789';
		
				// Shuffle the $str_result and returns substring
				// of specified length
				return substr(
					str_shuffle($str_result),
					0,
					$length_of_string
				);
			}
		
			$r = random_strings(12);
		
		
			$rand =  $r;
		
			$sql2 ="INSERT INTO record (username,withdraw,rand,upi) VALUES ('$user', $amount,'$rand','$upi')"; 
			$sql="UPDATE users SET  balance = balance-$amount1 WHERE username='$user'" ;
			$transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','Withdrawal',$amount)";
			$conn->query($transquery);
			$res1=$conn->query($sql); 
			$result=$conn->query($sql2);
			if($result===true && $res1===true){
				$status="Success";
			}else{
				$status="Somthing Went Wrong";
			}
		}
		else{
			$status="Play more to withdraw bonus";
		}
	    
	}else{
        $status="Daily Withdraw Limit Reached";
	}
	}else{
        $status="Need first recharge to withdraw";
	}
	
	
array_push($data, ['status' => $status]);
	echo json_encode($data);
}else if ($action == 'Invitewithdrawal') {
	$data = array();
	$user=$_GET['user'];
	$upi=$_GET['upi'];
	$amount1=$_GET['amount'];
	
	$sql14 = "SELECT COUNT(*) AS wcount FROM record WHERE username = '$user' AND created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
	$result14 = $conn->query($sql14);
	$row14 = mysqli_fetch_array($result14);
	$wcount = $row14['wcount'];

	$opt22= "SELECT SUM(recharge) as total22 FROM `recharge` WHERE username='$user' AND status='Success' ";
	$optres222 = $conn->query($opt22);
	$sum2 = mysqli_fetch_assoc($optres222);
	$total2 = $sum2['total22'];
	$opt="SELECT SUM(amount) as total FROM `abbetting` WHERE username='$user'";
$optres=$conn->query($opt);
$sum= mysqli_fetch_assoc($optres);
if($sum['total']==""){
    $bonus=0;
    
}else{
    $bonus=round($sum['total'],2);
}
	$opt1="SELECT SUM(amount) as total1 FROM `betting` WHERE username='$user'";
	$optres1=$conn->query($opt1);
	$sum1= mysqli_fetch_assoc($optres1);
	if($sum1['total1']==""){
		$bonus1=0;
		
	}else{
		$bonus1=round($sum1['total1'],2);
	}
	$opt2="SELECT SUM(amount) as total2 FROM `saprebetting` WHERE username='$user'";
	$optres2=$conn->query($opt2);
	$sum2= mysqli_fetch_assoc($optres2);
	if($sum2['total2']==""){
		$bonus2=0;
		
	}else{
		$bonus2=round($sum2['total2'],2);
	}
	$opt3="SELECT SUM(amount) as total3 FROM `emredbetting` WHERE username='$user'";
	$optres3=$conn->query($opt3);
	$sum3= mysqli_fetch_assoc($optres3);
	if($sum3['total3']==""){
		$bonus3=0;
		
	}else{
		$bonus3=round($sum['total3'],2);
	}
	$opt4="SELECT SUM(amount) as total4 FROM `beconebetting` WHERE username='$user'";
	$optres4=$conn->query($opt4);
	$sum4= mysqli_fetch_assoc($optres4);
	if($sum4['total4']==""){
		$bonus4=0;
		
	}else{
		$bonus4=round($sum['total4'],2);
	}
	$opt5="SELECT SUM(amount) as total5 FROM `crashbetrecord` WHERE username='$user'";
	$optres5=$conn->query($opt5);
	$sum5= mysqli_fetch_assoc($optres5);
	if($sum5['total5']==""){
		$bonus5=0;
		
	}else{
		$bonus5=round($sum['total5'],2);
	}

	if($total2>0){
	if($wcount<=4){
	    


	    if($_GET['amount']>1500){
	    $amount=(98/100)*$_GET['amount'];
	}else{
	    $amount=$_GET['amount']-30;
	}
	
	function random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789AXYZ012345678901234567890123456789';

        // Shuffle the $str_result and returns substring
        // of specified length
        return substr(
            str_shuffle($str_result),
            0,
            $length_of_string
        );
    }

    $r = random_strings(12);


    $rand =  $r;

    $sql2 ="INSERT INTO record (username,withdraw,rand,upi) VALUES ('$user', $amount,'$rand','$upi')"; 
    $sql="UPDATE users SET  bonus = bonus-$amount1 WHERE username='$user'" ;
    $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','Invite Withdrawal',$amount)";
	$conn->query($transquery);
    $res1=$conn->query($sql); 
    $result=$conn->query($sql2);
	if($result===true && $res1===true){
        $status="Success";
	}else{
        $status="Somthing Went Wrong";
	}
	}else{
        $status="Daily Withdraw Limit Reached";
	}
	}else{
        $status="Need first recharge to withdraw";
	}
	
	
array_push($data, ['status' => $status]);
	echo json_encode($data);
}else if ($action == 'getcheckinstatus') {
	$data = array();
	$user=$_GET['user'];

  $sql14 = "SELECT COUNT(*) AS wcount FROM signin WHERE username = '$user' AND created >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
	$result14 = $conn->query($sql14);
	$row14 = mysqli_fetch_array($result14);
	$wcount = $row14['wcount'];
	 $sql144 = "SELECT COUNT(*) AS scount FROM signin WHERE username = '$user' ";
	$result144 = $conn->query($sql144);
	$row144 = mysqli_fetch_array($result144);
	
	if($row144['scount']==null){
	    $scount = 0;
	}else{
	    $scount = $row144['scount'];
	}
	if($scount<9){
	  if($wcount==0){
	     $status="true";
	}else{
	   $status="false";
	}  
	}else{
	   $status="false";
	}
	
array_push($data, ['status' => $status,'days'=>$scount]);
	echo json_encode($data);
}else if ($action == 'checkinuser') {
	$data = array();
	$user=$_GET['user'];
	$bon=0;
	
    $sql14 = "SELECT COUNT(*) AS wcount FROM signin WHERE username = '$user' AND created >= DATE_SUB(NOW(), INTERVAL 24 HOUR)";
	$result14 = $conn->query($sql14);
	$row14 = mysqli_fetch_array($result14);
	$wcount = $row14['wcount'];
	 $sql144 = "SELECT COUNT(*) AS scount FROM signin WHERE username = '$user' ";
	$result144 = $conn->query($sql144);
	$row144 = mysqli_fetch_array($result144);
	if($row144['scount']==null){
	    $scount = 0;
	}else{
	    $scount = $row144['scount'];
	}
	
	$opt22= "SELECT COUNT(*) as total22 FROM `recharge` WHERE username='$user' AND status='Success' ";
	$optres222 = $conn->query($opt22);
	$sum2 = mysqli_fetch_assoc($optres222);
	$total2 = $sum2['total22'];
	if($total2!=0){
	if($wcount==0){
	    if($scount==0 || $scount==1 || $scount==3 || $scount==4 || $scount==5){
	       $bon=1; 
	    }elseif($scount==2){
	        $bon=2;
	    }elseif($scount==6){
	        $bon=3;
	    }else{
	        $bon=10;
	    }
	    $sql7 = "INSERT INTO signin (username,amount) VALUES ('$user',$bon)";
	$conn->query($sql7);
	$sql9="UPDATE users SET  balance = balance+$bon WHERE username='$user'" ;
    $conn->query($sql9); 
    $transquery="INSERT INTO trans (username,reason,amount) VALUES ('$user','CheckIn Bonus',$bon)";
	$conn->query($transquery);
	     $status="Success";
	}else{
	   $status="Already Checked In";
	}
	}else{
		$status="Please recharge to check in";
	 }
array_push($data, ['status' => $status]);
	echo json_encode($data);
}  else if ($action == 'rechargerecord') {
	$data1 = array();
	$user = $_GET['user'];
	$end1 = 10;
	$page1 = $_GET['page1'];
	$st1 = ($page1 - 1) * $end1;
	$query = "SELECT * FROM recharge WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 . ',' . $end1;
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
	}

	echo json_encode($data1);
} else if ($action == 'trans') {
	$data1 = array();
	$user = $_GET['user'];
	$end1 = 10;
	$page1 = $_GET['page1'];
	$st1 = ($page1 - 1) * $end1;
	$query = "SELECT * FROM betting WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 . ',' . $end1;
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
	}

	echo json_encode($data1);
}else if ($action == 'invite') {
	$data = array();
	$username = $_GET['usercode'];
	$sql1 = "SELECT usercode,bonus FROM users WHERE username='$username'";
	$result1 = $conn->query($sql1);
	$row1 = mysqli_fetch_array($result1);
	$usercode = $row1['usercode'];
	$agentincome= $row1['bonus'];
	
	$opt99 = "SELECT SUM(amount) as total99 FROM `bonus` WHERE usercode='$usercode' AND ( level = 1 OR level=2)";
	$optres99 = $conn->query($opt99);
	$sum99 = mysqli_fetch_assoc($optres99);
	if($sum99['total99']==null){
	     $totalb =0;
	}else{
	    $totalb = round($sum99['total99'],2);
	}
	
 
  	$opt999 = "SELECT SUM(amount) as total999 FROM `bonus` WHERE usercode='$usercode' AND (level = 1 OR level=2) AND created_at>= NOW() - INTERVAL 1 DAY";
	$optres999 = $conn->query($opt999);
	$sum999 = mysqli_fetch_assoc($optres999);
	if($sum999['total999']==null){
	    $todaytotalb = 0;
	}else{
	    $todaytotalb = round($sum999['total999'],2);
	}
	
 
 
	$opt9 = "SELECT COUNT(*) as total9 FROM `users` WHERE refcode='$usercode' OR refcode1='$usercode' OR refcode2='$usercode'";
	$optres9 = $conn->query($opt9);
	$sum9 = mysqli_fetch_assoc($optres9);
	$total = $sum9['total9'];
	



	$opt = "SELECT COUNT(*) as total FROM `users`  WHERE  refcode='$usercode' OR refcode1='$usercode' OR refcode2='$usercode' AND created_at>= NOW() - INTERVAL 1 DAY";
	$optres = $conn->query($opt);
	$sum = mysqli_fetch_assoc($optres);
	$total1 = $sum['total'];
	
	array_push($data, ['totalbonus' => $totalb,'agentincome'=>$agentincome,'totalinvites'=>$total,'todaybonus'=>$todaytotalb,'todayinvites'=>$total1]);
	echo json_encode($data);
} else if ($action == 'withdrawrecord') {
	$data1 = array();
	$user = $_GET['user'];
	$end1 = 10;
	$page1 = $_GET['page1'];
	$st1 = ($page1 - 1) * $end1;
	$query = "SELECT * FROM record WHERE username='$user' ORDER BY id DESC LIMIT " . $st1 . ',' . $end1;
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
	}

	echo json_encode($data1);
	
} else if ($action == 'inviterecord') {
    $data = array();
	$data1 = array();
	$data2 = array();
	$user = $_GET['user'];
	$level= $_GET['level'];
	$sql3 = "SELECT usercode FROM users WHERE username='$user'";
	$result3 =$conn->query($sql3);
	$row3 = mysqli_fetch_assoc($result3);
	$usercode=$row3['usercode'];		
	if($level=='A'){
		$query = "SELECT * FROM users WHERE refcode='$usercode' OR refcode1='$usercode' OR refcode2='$usercode'   ORDER BY id DESC  ";
	}elseif($level=='B'){
		$query = "SELECT *,'1' AS level FROM users WHERE refcode='$usercode'  ORDER BY id DESC ";
	}elseif($level=='C'){
		$query = "SELECT *,'2' AS level FROM users WHERE refcode1='$usercode'  ORDER BY id DESC  ";
	}elseif($level=='D'){
		$query = "SELECT *,'3' AS level FROM users WHERE refcode2='$usercode'  ORDER BY id DESC  ";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
	}

$opt9 = "SELECT COUNT(*) as total9 FROM `users` WHERE refcode='$usercode' ";
	$optres9 = $conn->query($opt9);
	$sum9 = mysqli_fetch_assoc($optres9);
	$total = $sum9['total9'];

	$opt22= "SELECT COUNT(*) as total22 FROM `users`WHERE refcode2='$usercode'";
	$optres222 = $conn->query($opt22);
	$sum2 = mysqli_fetch_assoc($optres222);
	$total2 = $sum2['total22'];


	$opt = "SELECT COUNT(*) as total FROM `users`  WHERE refcode1='$usercode' ";
	$optres = $conn->query($opt);
	$sum = mysqli_fetch_assoc($optres);
	$total1 = $sum['total'];
	$people=$total+$total1+$total2;
array_push($data2, ['people' => $people,'level1'=>$total,'level2'=>$total2,'level3'=>$total1]);
array_push($data, $data1,$data2);
	
	echo json_encode($data);
}else if ($action == 'invitereward') {
	$data1 = array();
	$user = $_GET['user'];
	$level= $_GET['level'];
	$sql3 = "SELECT usercode FROM users WHERE username='$user'";
	$result3 =$conn->query($sql3);
	$row3 = mysqli_fetch_assoc($result3);
	$usercode=$row3['usercode'];		
	if($level=='A'){
		$query = "SELECT * FROM bonus WHERE usercode='$usercode'  ORDER BY id DESC  ";
	}elseif($level=='B'){
		$query = "SELECT * FROMbonus WHERE usercode='$usercode' AND level=5  ORDER BY id DESC ";
	}elseif($level=='C'){
		$query = "SELECT * FROM bonus WHERE usercode='$usercode' AND level=1 OR level=2  ORDER BY id DESC  ";
	}elseif($level=='D'){
		$query = "SELECT * FROM bonus WHERE usercode='$usercode' AND level=3  ORDER BY id DESC  ";
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
	}


	
	echo json_encode($data1);
}
 else if ($action == 'bankcard') {
	$data1 = array();
	$user = $_GET['user'];

	$query = "SELECT * FROM users WHERE username='$user' ";
	$statement = $connect->prepare($query);
	$statement->execute();
	while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		$data1[] = $row;
		if(($data1[0]['paytm']==null)||($data1[0]['paytm']=='null')||($data1[0]['paytm']=="")){
			$data1[0]['paytm']=$data1[0]['upi'];
		}
	}

	echo json_encode($data1);
}else if ($action == 'deletebankcard') {

	$user = $_GET['user'];

	$query = "UPDATE users SET account='1111111111' WHERE username='$user' ";
	$statement = $connect->prepare($query);
	$statement->execute();
	
}else if ($action == 'register') {
	$user = $_POST['username'];
	$otp=$_POST["code"];
	$ip=getenv("REMOTE_ADDR");
	$query0 =  "SELECT  username FROM verify  WHERE otp='$otp' ORDER BY id DESC";
	$result3 =$conn->query($query0);
	$row3 = mysqli_fetch_assoc($result3);
	if(isset($row3['username'])){
	$verun=$row3['username'];
	}else{
	$verun="none";
	}
	
	if($verun==$user){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$refcode=$_POST['refcode'];
		$data = array();
		$opt9 = "SELECT COUNT(*) as total9 FROM `users` WHERE username = '$username' ";
	   $optres9 = $conn->query($opt9);
	   $sum9 = mysqli_fetch_assoc($optres9);
	   $usernum=$sum9['total9'];
		if($usernum==0){
			function genUserCode(){
				$str="AB1CDE2FG3HI4JK5LM6NO7PQ8RS9TU0VQXYZ".time();
				$str= str_split($str,1);
				$l = count($str);
				$user_code='';
				for($i=0;$i<8;$i++){
				$tn = rand(0,$l);
				$user_code.=$str[$tn];
				}
				
				return $user_code;
				
				}
			$user_code = genUserCode(); 
			$sql3 = "SELECT refcode,refcode1 FROM users WHERE usercode='$refcode'";
			$result3 =$conn->query($sql3);
			$row3 = mysqli_fetch_assoc($result3);
			$refcode1=$row3['refcode'];
			$refcode2=$row3['refcode1'];
			$query="INSERT INTO users (username, password, refcode,usercode,refcode1,refcode2,r_ip) VALUES ('$username','$password','$refcode','$user_code','$refcode1','$refcode2','$ip')";
			$statement = $connect->prepare($query);
			$statement->execute();
			$transquery="INSERT INTO trans (username,reason,amount) VALUES ('$username','Signup bonus',20)";
	$conn->query($transquery);
			$status="success";
			array_push($data, ['status' => $status]);
			echo json_encode($data);
		}else{
			$status="User already exists";
		array_push($data, ['status' => $status]);
		echo json_encode($data);
		}
		
		
	}else{
		
	
	
		$data = array();
		$status="Incorrect otp";
		array_push($data, ['status' => $status]);
		echo json_encode($data);
	}
	
	
}else if ($action == 'addbankcard') {

	$user = $_GET['user'];
	
	

	$name=$_POST['actualname'];
	$upi=$_POST['upi'];
	$email=$_POST['email'];
	$paytm=$_POST['paytm'];
	$query = "UPDATE users SET name='$name',upi='$upi',email='$email',paytm='$paytm' WHERE username='$user' ";
	$statement = $connect->prepare($query);
	$statement->execute();
	$data = array();
	$status="success";
	array_push($data, ['status' => $status]);
	echo json_encode($data);
	
	
	
}else {
	$res['error'] = false;
	$res['message'] = "No Data Found!";
}




$conn->close();
//header("Content-type: application/json");
//echo json_encode($res);
die();

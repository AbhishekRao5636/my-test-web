<?php
	session_start();
	if($_SESSION['unohs'] == null){
		header("location:index.php?msg=unauthorized");
	}	
	date_default_timezone_set("Asia/Kolkata");
?>
<?php 
	include ("conn.php");
	
	$curdate = date('Y-m-d h:i:s');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard</title>
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="dashboard.php"><img src="images/logo.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="images/logo-mini.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>       
        <ul class="navbar-nav navbar-nav-right">           
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>              
              <a class="dropdown-item preview-item" href="logout.php">
                  <i class="icon-inbox"></i> Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="images/faces/face28.png">
          </div>
          <div class="user-name">
              Game
          </div>
          <div class="user-designation">
              Admin
          </div>
        </div>
        <?php include 'compass.php';?>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">Hi, welcome back!</h4>
              <p class="font-weight-normal mb-2 text-muted"><?php echo date("F d, Y"); ?></p>
            </div>
          </div>
		  <?php 
			$chkserial = mysqli_query($conn,"select * from `nirvahaka_shonu` where `unohs`='".$_SESSION['unohs']."'");
			$salu = mysqli_fetch_array($chkserial);
			$dashboard = $salu['dashboard'];
			if($dashboard == 1){
		  ?>
		  <div class="row">
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Today User Join</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT count(*) as 'total_user' FROM shonu_subjects where status = 1 AND id NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(createdate) = DATE('".$curdate."')");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$total_user = $row["total_user"];
							echo $total_user;                  																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Today's Recharge</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT sum(motta) as 'pending' FROM thevani WHERE sthiti = '1' AND balakedara NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(dinankavannuracisi) = DATE('".$curdate."')");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$pending = $row["pending"];
							echo number_format($pending,0);                  																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Today's Withdrawal</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT sum(motta) as 'succ_w' FROM hintegedukolli where sthiti = 1 AND balakedara NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(dinankavannuracisi) = DATE('".$curdate."')");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$succ_w = $row["succ_w"];
							echo number_format($succ_w,0);                  																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">User Balance</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT sum(motta) as 'wallt' FROM shonu_kaichila where balakedara NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND motta > 0");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$zero_bl = $row["wallt"];
							echo number_format($zero_bl,2);                  																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
				<a href="manage_user.php">
                  <div class="panel-footer">
                    <span class="pull-left" style="color: white;">See in Detail</span>
                    <div class="clearfix"></div>
                  </div>
                </a>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Total Users</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT count(*) as 'total_user' FROM shonu_subjects where id NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND status = 1");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$total_user = $row["total_user"];
							echo $total_user;                  																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
				<a href="manage_user.php">
                  <div class="panel-footer">
                    <span class="pull-left" style="color: white;">See in Detail</span>
                    <div class="clearfix"></div>
                  </div>
                </a>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Pending Recharge</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT sum(motta) as '2' FROM thevani where balakedara NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND sthiti = '0'");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$pending = $row["2"];
							echo number_format($pending);                 																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
				<a href="deposit_update.php">
                  <div class="panel-footer">
                    <span class="pull-left" style="color: white;">See in Detail</span>
                    <div class="clearfix"></div>
                  </div>
                </a>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Success Recharge</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT sum(motta) as 'pending' FROM thevani where balakedara NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND sthiti = '1'");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$pending = $row["pending"];
							echo number_format($pending,0);                																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
				<a href="deposit_update.php">
                  <div class="panel-footer">
                    <span class="pull-left" style="color: white;">See in Detail</span>
                    <div class="clearfix"></div>
                  </div>
                </a>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Total Withdrawal</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT sum(motta) as 'pending_w' FROM hintegedukolli where balakedara NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND sthiti = '1'");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$pending_w = $row["pending_w"];
							echo number_format($pending_w);                 																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
				<a href="withdraw_accept_list.php">
                  <div class="panel-footer">
                    <span class="pull-left" style="color: white;">See in Detail</span>
                    <div class="clearfix"></div>
                  </div>
                </a>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Withdrawal Requests</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						  $result = mysqli_query($conn,"SELECT sum(motta) as 'approve_withdrawal' FROM hintegedukolli where balakedara NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND sthiti = '0'");
					?> 
					<?php
						  if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_array($result);							                            							
							$approve_withdrawal = $row["approve_withdrawal"];
							echo number_format($approve_withdrawal);                 																  
						  }
						  else 
						  {
							echo "0";
						  }
					?>
					</h4>
                </div>
				<a href="manage_withdraw.php">
                  <div class="panel-footer">
                    <span class="pull-left" style="color: white;">See in Detail</span>
                    <div class="clearfix"></div>
                  </div>
                </a>
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Today's total bet</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						    $bet_wingo_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_wingo_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_drei` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_wingo_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_funf` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_wingo_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_zehn` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru_drei` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru_funf` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_kemuru_zehn` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi_drei` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi_funf` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(ketebida) as total FROM `bajikattuttate_aidudi_zehn` where byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$total_bet = $bet_wingo_1['total'] + $bet_wingo_3['total'] + $bet_wingo_5['total'] + $bet_wingo_10['total'] + $bet_k3_1['total'] + $bet_k3_3['total'] + $bet_k3_5['total'] + $bet_k3_10['total'] + $bet_5d_1['total'] + $bet_5d_3['total'] + $bet_5d_5['total'] + $bet_5d_10['total'];
					?> 
					<?php
							$asila = $total_bet;
						  echo number_format($total_bet, 2);
					?>
					</h4>
                </div>				
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Today's total win</p>
					<h4 class="text-amount" style="text-align:left">
					<?php
						    $bet_wingo_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_wingo_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_drei` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_wingo_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_funf` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_wingo_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_zehn` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_kemuru` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_kemuru_drei` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_kemuru_funf` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_k3_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_kemuru_zehn` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_aidudi` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_3 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_aidudi_drei` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_5 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_aidudi_funf` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$bet_5d_10 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT sum(sesabida) as total FROM `bajikattuttate_aidudi_zehn` where `phalaphala` = 'gagner' AND byabaharkarta NOT IN (SELECT balakedara FROM `demo` WHERE `sthiti`='1') AND DATE(tiarikala) = DATE('".$curdate."')"));
							$total_bet = $bet_wingo_1['total'] + $bet_wingo_3['total'] + $bet_wingo_5['total'] + $bet_wingo_10['total'] + $bet_k3_1['total'] + $bet_k3_3['total'] + $bet_k3_5['total'] + $bet_k3_10['total'] + $bet_5d_1['total'] + $bet_5d_3['total'] + $bet_5d_5['total'] + $bet_5d_10['total'];
					?> 
					<?php
							$gala = $total_bet;
						  echo number_format($total_bet, 2);
					?>
					</h4>
                </div>				
            </div>
			<div style="background-color: #3362ff; color: white; padding: 20px; margin: 10px;"
              class="dashboard_box blue_bg col-md-3 border-radius">
                <div class="title">
                  <p class="text-title" style="text-align:left">Today's profit</p>
					<h4 class="text-amount" style="text-align:left">					
					<?php
							$amount = $asila - $gala;
							echo round($amount,2);
					?>
					</h4>
                </div>				
            </div>
		  </div>
		  <?php } ?>
		</div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Powered by  Game Admin Admin</span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <script src="js/dashboard.js"></script>
</body>

</html>
<script>
	if (!localStorage.getItem('userInfo')) {
		window.location.href = 'https://selimxpro.com/#/login';
	}
	else{
		let alldet = localStorage.getItem('userInfo');
		let userObject = JSON.parse(alldet);
		let userName = userObject.userName;
		console.log(userName);
		
		fetch('get_agent.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({ userName: userName })
		})
		.then(response => response.json())
		.then(data => {
			if(data.res != '1'){
				window.location.href = 'https://selimxpro.com/';
			}
			else{
				let date = new Date();
				date.setTime(date.getTime() + (24 * 60 * 60 * 1000));
				expires = "; expires=" + date.toGMTString();
				document.cookie = "userName=" + userName + expires;
			}
		})
		.catch(error => {
			window.location.href = 'https://selimxpro.com/';
		});
	}
</script>
<?php
	include ("serive/samparka.php");
	
	$tem = date("Y-m-d H:i:s");
	$timestamp = strtotime($tem);
	$newTimestamp = $timestamp - 60 * 60 * 24;
	$newDate = date("Y-m-d H:i:s", $newTimestamp);
	
	$userName = substr($_COOKIE["userName"], 2);
	
	$chkserial = mysqli_query($conn,"select owncode from `shonu_subjects` where `mobile`='".$userName."'");
	$stdarr = mysqli_fetch_array($chkserial);
	$owncode_og = $stdarr['owncode'];
?>
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
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css">
  <link rel="shortcut icon" href="images/favicon.png" />
  <style>
	.cool-input {
        border: 2px solid #007bff;
        border-radius: 0.25rem;
        padding: 0.5rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    .cool-input:focus {
        border-color: #0056b3;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .cool-input::placeholder {
        color: #6c757d;
        opacity: 1;
    }
	.cool-button {
        padding: 0.5rem 1rem;
        font-size: 1rem;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }
    .cool-button:hover {
        background-color: #0056b3;
        color: #fff;
    }
    .cool-button.btn-secondary:hover {
        background-color: #343a40;
        color: #fff;
    }
	#copied{
		visibility: hidden;
		z-index: 1;
		position: fixed;
		bottom: 50%;
		background-color: #333;
		color: #fff;
		border-radius: 6px;
		padding: 16px;
		max-width: 250px;
		font-size: 17px;
	}	   
	#copied.show {
		visibility: visible;
		-webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
		animation: fadein 0.5s, fadeout 0.5s 2.5s;
	}
  </style>
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper" style="padding-top: 0px;">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="images/faces/face28.png">
          </div>
          <div class="user-name">
              Shonu Uncensored
          </div>
          <div class="user-designation">
              Developer
          </div>
        </div>
        <?php include 'compass.php';?>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
			<div class="row">
				<div class="box-header box-header2 align-middle">
					<div class="col-xs-6 text-right">
					<h3 class="box-title"><?php 
						if(isset($_GET['msg'])=="updt") 
						{ ?>
						<font size="+1" color="#FF0000">Update Successfully...</font>
						<?php  } ?></h3>
					</div>
					<div class="col-sm-6">
						<div class="pull-right">&nbsp;</div>
					</div>		  
				</div>
			</div>
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">Manage User</h4>
            </div>
          </div> 		  		  		  			
		  <div class="row">
            <div class="col-sm-12">
				<form id="formID" name="formID" method="post" action="#" enctype="multipart/form-data">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th id="mob">Mobile</th>
									<th>Direct Deposit</th>
									<th>Team Deposit</th>
									<th>Direct Bet</th>
									<th>Team Bet</th>         
									<th>No. of betters</th>
									<th>Direct Withdraw</th>
									<th>Team Withdraw</th>
									<th>P/L Report</th>
									<th>Salary</th>
									<!--<th>Approve</th>-->
								</tr>
							</thead>
							<tbody>							
								<?php 
									$query=mysqli_query($conn,"SELECT userid, salary FROM `dailysalary` WHERE salary > 0 && DATE(`createdate`)=DATE('".$newDate."') && `userid` IN (SELECT id FROM `shonu_subjects` WHERE code = $owncode_og) ORDER BY macau DESC");
									$i=0; 
									while($row = mysqli_fetch_array($query)){
										$i++;
								?>
									<tr>
										<td>
											<?php 
												$userid = $row['userid'];
												$mob=mysqli_query($conn,"SELECT mobile, owncode FROM `shonu_subjects` WHERE id = $userid");
												$mobrow = mysqli_fetch_array($mob);
												$owncode = $mobrow['owncode'];
												$mobile = $mobrow['mobile'];
												echo $mobile;
											?>
										</td>
										<td>
											<?php
												$mob=mysqli_query($conn,"SELECT SUM(motta) as tomo FROM thevani WHERE balakedara = $userid and `sthiti`='1' && DATE(`dinankavannuracisi`)=DATE('".$newDate."')");
												$mobrow = mysqli_fetch_array($mob);
												if($mobrow['tomo'] == null){
													echo 0;
												}
												else{
													echo $mobrow['tomo'];
												}												
											?>
										</td>
										<td>
											<?php
												$mob=mysqli_query($conn,"SELECT SUM(motta) as tomo FROM thevani WHERE balakedara IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') and `sthiti`='1' && DATE(`dinankavannuracisi`)=DATE('".$newDate."')");
												$mobrow = mysqli_fetch_array($mob);
												if($mobrow['tomo'] == null){
													echo 0;
												}
												else{
													echo $mobrow['tomo'];
												}
											?>
										</td>
										<td>
											<?php
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
												echo $total_tbet_o;
											?>
										</td>
										<td>
											<?php
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_1 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_3 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_5 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_10 = $selectbettingar_o['tbet'];

												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_1 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_3 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_5 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_10 = $selectbettingar_one_o['tbet_one'];

												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_1 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_3 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_5 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_10 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_av = mysqli_query($conn,"select SUM(`amount`) as tbet_av from `crashbetrecord` where `username` IN (SELECT mobile FROM shonu_subjects WHERE code = '$owncode') && DATE(`time`)=DATE('".$newDate."')");
												$selectbettingar_av = mysqli_fetch_array($selectbetting_av);
												$tbet_av = $selectbettingar_av['tbet_av'];
												
												$total_tbet_o_og = $tbet_wg_1 + $tbet_wg_3 + $tbet_wg_5 + $tbet_wg_10 + $tbet_5d_1 + $tbet_5d_3 + $tbet_5d_5 + $tbet_5d_10 + $tbet_k3_1 + $tbet_k3_3 + $tbet_k3_5 + $tbet_k3_10 + $tbet_av;
												echo $total_tbet_o_og;
											?>
										</td>
										<td>
											<?php
												$selectbetting_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet from `bajikattuttate` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_1 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet from `bajikattuttate_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_3 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet from `bajikattuttate_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_5 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet from `bajikattuttate_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_10 = $selectbettingar_o['tbet'];

												$selectbetting_one_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_one from `bajikattuttate_aidudi` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_1 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_one from `bajikattuttate_aidudi_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_3 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_one from `bajikattuttate_aidudi_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_5 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_one from `bajikattuttate_aidudi_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_10 = $selectbettingar_one_o['tbet_one'];

												$selectbetting_ten_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_ten from `bajikattuttate_kemuru` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_1 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_ten from `bajikattuttate_kemuru_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_3 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_ten from `bajikattuttate_kemuru_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_5 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select COUNT(DISTINCT `byabaharkarta`) as tbet_ten from `bajikattuttate_kemuru_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."')");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_10 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_av = mysqli_query($conn,"select COUNT(DISTINCT `username`) as tbet_av from `crashbetrecord` where `username` IN (SELECT mobile FROM shonu_subjects WHERE code = '$owncode') && DATE(`time`)=DATE('".$newDate."')");
												$selectbettingar_av = mysqli_fetch_array($selectbetting_av);
												$tbet_av = $selectbettingar_av['tbet_av'];
												
												$total_tbet_o = $tbet_wg_1 + $tbet_wg_3 + $tbet_wg_5 + $tbet_wg_10 + $tbet_5d_1 + $tbet_5d_3 + $tbet_5d_5 + $tbet_5d_10 + $tbet_k3_1 + $tbet_k3_3 + $tbet_k3_5 + $tbet_k3_10 + $tbet_av;
												echo $total_tbet_o;
											?>
										</td>
										<td>
											<?php
												$mob=mysqli_query($conn,"SELECT SUM(motta) as tomo FROM hintegedukolli WHERE balakedara = $userid and `sthiti`='1' && DATE(`dinankavannuracisi`)=DATE('".$newDate."')");
												$mobrow = mysqli_fetch_array($mob);
												if($mobrow['tomo'] == null){
													echo 0;
												}
												else{
													echo $mobrow['tomo'];
												}
											?>
										</td>
										<td>
											<?php
												$mob=mysqli_query($conn,"SELECT SUM(motta) as tomo FROM hintegedukolli WHERE balakedara IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') and `sthiti`='1' && DATE(`dinankavannuracisi`)=DATE('".$newDate."')");
												$mobrow = mysqli_fetch_array($mob);
												if($mobrow['tomo'] == null){
													echo 0;
												}
												else{
													echo $mobrow['tomo'];
												}
											?>
										</td>
										<td>
											<?php
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_1 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_3 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_5 = $selectbettingar_o['tbet'];
												
												$selectbetting_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet from `bajikattuttate_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_o = mysqli_fetch_array($selectbetting_o);
												$tbet_wg_10 = $selectbettingar_o['tbet'];

												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_1 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_3 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_5 = $selectbettingar_one_o['tbet_one'];
												
												$selectbetting_one_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_one from `bajikattuttate_aidudi_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_one_o = mysqli_fetch_array($selectbetting_one_o);
												$tbet_5d_10 = $selectbettingar_one_o['tbet_one'];

												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_1 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_drei` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_3 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_funf` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_5 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_ten_o = mysqli_query($conn,"select SUM(`ketebida`) as tbet_ten from `bajikattuttate_kemuru_zehn` where `byabaharkarta` IN (SELECT id FROM shonu_subjects WHERE code = '$owncode') && DATE(`tiarikala`)=DATE('".$newDate."') && `phalaphala`='gagner'");
												$selectbettingar_ten_o = mysqli_fetch_array($selectbetting_ten_o);
												$tbet_k3_10 = $selectbettingar_ten_o['tbet_ten'];
												
												$selectbetting_av = mysqli_query($conn,"select SUM(`amount`) as tbet_av from `crashbetrecord` where `username` IN (SELECT mobile FROM shonu_subjects WHERE code = '$owncode') && DATE(`time`)=DATE('".$newDate."') && `status`='success'");
												$selectbettingar_av = mysqli_fetch_array($selectbetting_av);
												$tbet_av = $selectbettingar_av['tbet_av'];
												
												$total_tbet_o_1 = $tbet_wg_1 + $tbet_wg_3 + $tbet_wg_5 + $tbet_wg_10 + $tbet_5d_1 + $tbet_5d_3 + $tbet_5d_5 + $tbet_5d_10 + $tbet_k3_1 + $tbet_k3_3 + $tbet_k3_5 + $tbet_k3_10 + $tbet_av;
												echo $total_tbet_o_og - $total_tbet_o_1;
											?>
										</td>
										<td>
											<?php
												$aid = $userid;
												$motta = $row['salary'];
												//echo $row['salary'].'&nbsp;<a href="javascript:void(0);" onClick="edita('.$aid.','.$mobile.','.$motta.')" class="text-aqua" title="Salary"><i class="fa fa-edit"></i></a>';
												echo $row['salary'];
											?>
										</td>
										<!--<td>
											<?php
												$aid = $userid;
												$motta = $row['salary'];
												echo '<a href="javascript:void(0);" onClick="edit('.$aid.','.$mobile.','.$motta.')" class="text-aqua" title="Approve">Pay</a>';
											?>
										</td>-->
									</tr>
								<?php 
									}
								?>
							</tbody>
						</table>
					</div>
				</form>			  			  
            </div>			
          </div>		  
		</div>
		<div id="excel" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title" id="chn">Change Amount<br>
							<small id="mob"></small>
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form name="type" id="type" enctype="multipart/form-data" action="#" method="post">
						<div class="modal-body">              
							<div class="form-group ">
								<label for="add_item">Amount</label>  
								<input class="form-control" id="amount" name="amount" type="text" value="" onkeypress="return isNumber(event)" required>
								<input class="form-control" id="editid" name="editid"  type="hidden">
								<i id="error"></i>
							</div>           			
						</div>
						<div class="modal-footer">              
							<button type="submit" class="btn btn-danger" id="add_role">Save</button>
						</div>
					</form>
				</div>
			</div>
         
		</div>
		<div id="excela" class="modal fade" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title" id="chn">Change Amount<br>
							<small id="moba"></small>
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form name="type" id="typea" enctype="multipart/form-data" action="#" method="post">
						<div class="modal-body">              
							<div class="form-group ">
								<label for="add_item">Amount</label>  
								<input class="form-control" id="amounta" name="amount" type="text" value="" onkeypress="return isNumber(event)" required>
								<input class="form-control" id="editida" name="editid"  type="hidden">
								<i id="error"></i>
							</div>           			
						</div>
						<div class="modal-footer">              
							<button type="submit" class="btn btn-danger" id="add_role">Save</button>
						</div>
					</form>
				</div>
			</div>
         
		</div>
		<footer class="footer">
			<div class="d-sm-flex justify-content-center justify-content-sm-between">
				<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 91clubold.investment93.site</span>
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
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
	$(function () {
		var table = $('#example1').DataTable({			
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": true,
			"pageLength": 50,
			"dom": 'lrtip'
		});
	 $('#example1 thead th').each(function () {
        var title = $(this).text();
        if (title === 'Mobile' || title === 'Cust ID') {
          $(this).html(title + ' <input type="text" class="col-search-input" placeholder="Search ' + title + '" />');
        }
      });

      // Apply the search
      table.columns().every(function () {
        var column = this;
        $('input', this.header()).on('keyup change', function () {
          if (column.search() !== this.value) {
            column.search(this.value).draw();
          }
        });
      });
    });
	function edita(id,mob,balance) {
		$('#excela').modal({backdrop: 'static', keyboard: false})   
		$('#excela').modal('show');
		document.getElementById('moba').innerHTML = 'Mobile: '+mob;
		document.getElementById('amounta').value = balance;
		document.getElementById('editida').value = id;
	}
	
	$(document).ready(function () {
		$("#typea").on('submit',(function(e) {
			e.preventDefault();
			var quantity = $('input#quantitya').val();
			if ((quantity)== "") {
				$("input#quantitya").focus();
				$('#quantitya').css({'border-color': '#f00'});
				return false;
			}						
			$.ajax({
				type: "POST", 
				url: "updatesalaryNow.php",              
				data: new FormData(this), 
				contentType: false,       
				cache: false,             
				processData:false,       

				success: function(html)   
				{
					if (html == 1) {
						alert("Amount update successfully...");			
						$("#typea")[0].reset();
						$('#excela').modal('hide');
						window.location ='';
					}			
					else if(html==0)
					{ 
						alert("Some Technical Error....");						
					}			
				}
			});	
		}));			
	});
	
	function edit(id,mob,balance) {
		$('#excel').modal({backdrop: 'static', keyboard: false})   
		$('#excel').modal('show');
		document.getElementById('mob').innerHTML = 'Mobile: '+mob;
		document.getElementById('amount').value = balance;
		document.getElementById('editid').value = id;
	}
	
	$(document).ready(function () {
		$("#type").on('submit',(function(e) {
			e.preventDefault();
			var quantity = $('input#quantity').val();
			if ((quantity)== "") {
				$("input#quantity").focus();
				$('#quantity').css({'border-color': '#f00'});
				return false;
			}						
			$.ajax({
				type: "POST", 
				url: "updatewalbalNow.php",              
				data: new FormData(this), 
				contentType: false,       
				cache: false,             
				processData:false,       

				success: function(html)   
				{
					if (html == 1) {
						alert("Amount update successfully...");			
						$("#type")[0].reset();
						$('#excel').modal('hide');
						window.location ='';
					}			
					else if(html==0)
					{ 
						alert("Some Technical Error....");						
					}			
				}
			});	
		}));			
	});
	
	function delete_row(Id) {
		var strconfirm = confirm("Are You Sure You Want To Delete?");
		if (strconfirm == true) {
			$.ajax({
				type: "Post",
				data:"id=" + Id + "& type=" + "delete" ,
				url: "manage_userAction.php",
				success: function (html) { 
					if(html==1){
						alert("Selected Item Deleted Sucessfully....");
						window.location = '';
					}
					else if(html==0){
						alert("Some Technical Problem");							  
					}
				},
				error: function (e) {
				}
			});
		}
	}
	
	function Respond(Id) {
		var strconfirm = confirm("Are you sure you want to Unpublish?");
        if (strconfirm == true) {
            $.ajax({
                type: "Post",
                data:"id=" + Id + "& type=" + "chk" ,
                url: "manage_userAction.php",
                success: function (html) {
                    window.location = '';
                    return false;
                },
                error: function (e) {
                }
            });
        }
    }
	
	function UnRespond(Id) {
	    var strconfirm = confirm("Are you sure you want to Publish?");
        if (strconfirm == true) {
            $.ajax({
                type: "Post",
                data:"id=" + Id + "& type=" + "unchk" ,
                url: "manage_userAction.php",
                success: function (html) {
                    window.location = '';
                    return false;
                },
                error: function (e) {
                }
            });
        }
    }
  </script>
</body>

</html>
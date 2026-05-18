<?php
	session_start();
	if($_SESSION['unohs'] == null){
		header("location:index.php?msg=unauthorized");
	}
?>
<?php
	include ("conn.php");
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
              Game Admin
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
              <h4 class="font-weight-bold text-dark">Deposit Update</h4>
            </div>
          </div> 		  		  		  			
		  <div class="row">
            <div class="col-sm-12"> 
			  <div class="d-flex align-items-center mt-3">	
				<h4>Payment Update</h4>
			  </div>
			  <div class="table-responsive">
				<table id="gameSpots" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>User ID</th>
							<th>Mobile</th>
							<th>Reference Number</th>
							<th>Amount</th>
                          	<th>Order ID</th>
							<th>Date</th>
							<th>Action</th>											 
						</tr>
					</thead>
					<tbody>
						<?php
							$sqq = mysqli_query($conn, "SELECT * FROM `thevani` WHERE `sthiti` = '0' ORDER BY `shonu` DESC");
							$i = 0;
							while ($row = mysqli_fetch_array($sqq)) {
							$i = $i + 1;
						?>
						<tr class="<?php echo $row['shonu'];?>">
							<td><?php echo $i;?></td>
							<td><?php echo $row['balakedara'];?></td>
							<td><?php echo $row['duravani'];?></td>
							<td><?php echo $row['ullekha'];?></td>
							<td><?php echo $row['motta'];?></td>
                          	<td><?php echo $row['dharavahi'];?></td>
							<td><?php echo $row['dinankavannuracisi'];?></td>
							<td>
								<form id="<?php echo 'app'.$row['shonu'];?>" class="approval-form">
									<input type="hidden" name="uid" value="<?php echo $row['balakedara'];?>">
									<input type="hidden" name="amount" value="<?php echo $row['motta'];?>">
									<input type="hidden" name="date" value="<?php echo $row['dinankavannuracisi'];?>"><!--Added-->
									<input type="hidden" name="sid" value="<?php echo $row['shonu'];?>"><!--Added-->
									<input type="hidden" name="ref_num" value="<?php echo $row['ullekha'];?>">
									<input type="hidden" name="app" value="Approve Payment">
									<button class="btn btn-primary" type="submit" name="approve">Approve Payment</button>
								</form> <br>
								<form id="<?php echo 'rej'.$row['shonu'];?>" class="reject-form">
									<input type="hidden" name="uid" value="<?php echo $row['balakedara'];?>">
									<input type="hidden" name="amount" value="<?php echo $row['motta'];?>">
									<input type="hidden" name="date" value="<?php echo $row['dinankavannuracisi'];?>"><!--Added-->
									<input type="hidden" name="sid" value="<?php echo $row['shonu'];?>"><!--Added-->
									<input type="hidden" name="ref_num" value="<?php echo $row['ullekha'];?>">
									<input type="hidden" name="rej" value="Reject Payment">
									<button class="btn btn-danger" type="submit" name="reject">Reject Payment</button>
								</form>
							</td>
						   
						</tr>            
						<?php 
							}
						?>                   
					</tbody>
				</table>
			  </div>			  
            </div>			
          </div>
		  <div class="row">
            <div class="col-sm-12">
				<div class="d-flex align-items-center mt-3">
					<h4>Completed Payment Records</h4> 
				</div>
				<div class="table-responsive">
					<table id="dep_comp" class="table table-striped table-bordered" style="width:100%">
						<thead>
                            <tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Mobile</th>
                                <th>Reference Number</th>
                                <th>Amount</th>
                              	<th>Order ID</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                                              
                        </tbody>
					</table>
				</div>
			</div>
		  </div>
		</div>
		<footer class="footer">
			<div class="d-sm-flex justify-content-center justify-content-sm-between">
				<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 51gameplay.online 2024</span>
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
	document.querySelectorAll('.approval-form').forEach(function(form) {
		form.addEventListener('submit', function(e) {
			e.preventDefault();

			var formData = new FormData(this);
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'admin_deposit_req.php', true);

			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 400) {
					var arr = xhr.responseText.split('~');
					if (arr[0] == 1) {
						document.getElementsByClassName(arr[1])[0].style.display = 'none';
						$('#dep_comp').DataTable().ajax.reload();
					} else if (arr[0] == 2) {
						alert("Error");
					}
				}
			};

			xhr.onerror = function() {
				alert("Error");
			};

			xhr.send(formData);
		});
	});
	
	document.querySelectorAll('.reject-form').forEach(function(form) {
		form.addEventListener('submit', function(e) {
			e.preventDefault();

			var formData = new FormData(this);
			var xhr = new XMLHttpRequest();
			xhr.open('POST', 'admin_deposit_req.php', true);

			xhr.onload = function() {
				if (xhr.status >= 200 && xhr.status < 400) {
					var arr = xhr.responseText.split('~');
					if (arr[0] == 1) {
						document.getElementsByClassName(arr[1])[0].style.display = 'none';
					} else if (arr[0] == 2) {
						alert("Error");
					}
				}
			};

			xhr.onerror = function() {
				alert("Error");
			};

			xhr.send(formData);
		});
	});
	
	$(document).ready(function() {
		$('#gameSpots').DataTable({
			"searching": true
			});
			
		$('#dep_comp').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "deposit_update_approve.php",
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true,
			"pageLength": 10
			});
	} );
	
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
  </script>
</body>

</html>
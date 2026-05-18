<?php
	session_start();
	if($_SESSION['unohs'] == null){
		header("location:index.php?msg=unauthorized");
	}
?>
<?php
	include ("conn.php");
	
	$samasye = "SELECT atadaaidi FROM `gelluonduhogu_aidudi_zehn` ORDER BY kramasankhye DESC LIMIT 1";
	$samasyephalitansa = $conn->query($samasye);
	$samasyephalitansa_dhadi = mysqli_fetch_assoc($samasyephalitansa);
	
	$munde = mysqli_query($conn,"SELECT sankhye FROM `hastacalita_phalitansa_aidudi_zehn` WHERE `sthiti`='1'");
	if(mysqli_num_rows($munde)>0){
		$uhisi = mysqli_fetch_array($munde);
		$uhisisankhye = $uhisi['sankhye'];
	}
	else{
		$uhisisankhye = "NOT SET";			
	}
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
              <h4 class="font-weight-bold text-dark">5D 10 Min</h4>
            </div>
          </div> 
		  <div class="row">
			<div class="col-sm-6 text-left">
              <h5>Count Down : <span id="demo"></span></h5>
			</div>
			<div class="col-sm-6 text-right">
			  <h5>Period Id : <span id="activeperiodid"><?php echo $samasyephalitansa_dhadi['atadaaidi'];?></span></h5>
			  <input type="hidden" name="periodid" id="periodid" value="<?php echo $samasyephalitansa_dhadi['atadaaidi'];?>">	
			</div>
          </div>
		  <div class="row">
            <div class="col-sm-12">
              <h5 style="text-align:center; color:red">Next prediction : <?php echo $uhisisankhye; ?> </h5>
			  <form action="itticina_geluvu_aidudi_zehn" id="pre" method="POST">
				<h6 style="text-align:center; font-weight:bold">Prediction Form</h6>
				<div class="d-flex align-items-center">				
					<input type="text" name="username" id="next" placeholder="Enter a number from 00000-99999" class="flex-grow-1 cool-input" style="height: 40px;">					
				</div>
				<div class="d-flex align-items-center mt-3">
					<button type="button" onclick="sub()" class="btn btn-primary cool-button mr-2">Confirm Next Prediction</button>
					<button type="button" onclick="unsetman()" class="btn btn-secondary cool-button">Unset Prediction</button>
				</div>
			  </form>
            </div>
          </div>		  			
		  <div class="row">
            <div class="col-sm-12"> 
			  <div class="d-flex align-items-center mt-3">	
				<p>
					<span style="color:#333">TOTAL BET AMOUNT : </span><span id = "tobet" style="color:#333">0  </span>
				</p>
			  </div>			  
            </div>			
          </div>
		  <div class="row">
            <div class="col-sm-12">
				<div class="d-flex align-items-center mt-3">
					<h5>Live Bets</h5>
				</div>
				<table id="example2" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>User ID</th>
							<th>Value</th>
							<th>Amount</th>
							<th>Mobile</th>
							<th>Balance</th>
						</tr>
					</thead>
					<tbody>
		 
					</tbody>
				</table>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm-12 offset-sm-4 mt-3">
				<h5 id="copied" style="text-align:center; font-weight:bold">Enter a number from 00000-99999</h5>
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
	$(document).ready(function () {
		var xyz = setInterval(function() { 
		wingoonetotal();
		//getbettingdata('getdata');
		}, 2000);
	});
	function wingoonetotal()
	{
		$.ajax({
		type: "Post",
		url: "ottu_gellaluhogiondu_aidudi_zehn.php",
		success: function (html) {
		 document.getElementById("tobet").innerHTML = html;		 
		  return false;
		  },
		  error: function (e) {}
		  });
	}
	/*function getbettingdata(actiontype)
	{
		var periodid=$("#periodid").val();
			$.ajax({
			type: "Post",
			data:"periodid=" + periodid + "& actiontype=" + actiontype ,
			url: "mottavannupadeyiri_kemuru.php",
			success: function (html) {
			 document.getElementById("betdetail").innerHTML = html;
			  return false;
			  },
			  error: function (e) {}
			  });
	}*/
	function fetchServerTime() {
		return fetch('servertime')
			.then(response => {
				if (!response.ok) {
					throw new Error(`Failed to fetch server time. Status: ${response.status}`);
				}
				return response.json().then(data => data.serverTime);
			});
	}
	function sub(){
		var p=document.getElementById("next").value;
		var p_l = p.length;
		if(p==''){			 
		   var x = document.getElementById("copied");
			x.className = "show";
			setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000); 
		}else if(-1<p && p<100000 && p_l==5){
			console.log(p);
		 document.getElementById("pre").submit();  
		}else{
			 console.log("3");
			var x = document.getElementById("copied");
			x.className = "show";
			setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000); 
		}		
	}
	
	setInterval(function() {
	var table = $('#example2').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "detavannunirvahisi_aidudi_zehn.php",
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": false,
		"info": true,
		"autoWidth": true,
		"pageLength": 50,
		"dom": 'lrtip',
		"bDestroy": true
	});
	}, 2000);
	
	function resetman(){		
		$.ajax({
			type: "Post",
			data:"stat=" + "1",
			url: "maruhondisi_gellalu_aidudi_zehn.php",
			success: function (html) {
			 console.log(html);
			  return false;
			  },
			  error: function (e) {}
		});
	}
	function unsetman(){
		resetman();
		location.reload();
	}
	
	function startTimer(serverTime) {
		var distance = 600 - serverTime % 600;
		var interval = setInterval(function () {			
			var i = distance / 60,
				n = distance % 60,
				o = n / 10,
				s = n % 10;
			var minutes = Math.floor(i);
			var seconds = ('0' + Math.floor(n)).slice(-2);
			var sec1 = (seconds % 100 - seconds % 10) / 10;
			var sec2 = seconds % 10;
			document.getElementById("demo").innerHTML = "<span class='timer'>0"+Math.floor(minutes)+"</span>" + "<span>:</span>" +"<span class='timer'>"+seconds+"</span>";			
			if(distance==590){
			  resetman();
			  //location.reload();
			}
			if(distance==588){
			  location.reload();
			}
			distance--;
			if (distance === 0) {
				clearInterval(interval);
				fetchServerTime()
					.then(serverTime => {
						console.log("Server Time (Unix Epoch):", serverTime);
						startTimer(serverTime);
					})
					.catch(error => {
						console.error('Error:', error);
					});
			}
		}, 1000);
	}

	fetchServerTime()
		.then(serverTime => {
			console.log("Server Time (Unix Epoch):", serverTime);
			startTimer(serverTime);
		})
		.catch(error => {
			console.error('Error:', error);
		});
  </script>
</body>

</html>
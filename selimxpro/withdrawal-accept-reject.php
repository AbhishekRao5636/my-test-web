<?php
	session_start();
	if($_SESSION['unohs'] == null){
		header("location:index.php?msg=unauthorized");
	}
?>
<?php
	include ("conn.php");
	
	if($id=encryptor('decrypt', $_GET['id'])){	
		$Query=mysqli_query($conn,"select shonu_subjects.mobile,shonu_subjects.email,shonu_subjects.owncode,khate.phalanubhavi,khate.kod,khate.khatehesaru,
		khate.khatesankhye,`hintegedukolli`.`shonu`,`hintegedukolli`.`motta`,`hintegedukolli`.`khateshonu`,`hintegedukolli`.`sthiti`,`hintegedukolli`.`dinankavannuracisi` from `hintegedukolli`
		INNER JOIN shonu_subjects ON shonu_subjects.id=`hintegedukolli`.`balakedara`
		INNER JOIN khate ON khate.shonu=`hintegedukolli`.`khateshonu`
		where `hintegedukolli`.`shonu`='".$id."'");
		$Result=mysqli_fetch_array($Query);
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
              selimxpro.com
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
              <h4 class="font-weight-bold text-dark">Withdraw Accept/Reject</h4>
            </div>
          </div> 		  		  		  			
		  <div class="row">
            <div class="col-sm-12">
				<h3 class="box-title text-center text-danger">
					<?php echo 'Bank Withdrawal';?>
				</h3>
				<table class="table">
				  <tbody>
					<tr>
						<td style="color: blue; font-size:25px;" scope="col">Mobile:</td>
						<td style="color: blue; font-size:25px;" scope="col" ><?php echo $Result['mobile'];?></td>					  
					</tr>				  				  
					<tr>					  
						<td style="color: blue; font-size:25px;">Date:</td>
						<td style="color: blue; font-size:25px;"><?php echo $convert=date('d-m-Y',strtotime($Result['dinankavannuracisi']));?></td>					  
					</tr>
					<tr>
						<td style="color: blue; font-size:25px;" scope="col">Amount:</td>
						<td style="color: blue; font-size:25px;" scope="col"><?php echo number_format($Result['motta'],2);?></td>						  
					</tr>
					<tr>
						<td style="color: blue; font-size:25px;" scope="col">Bank Name:</td>
						<td style="color: blue; font-size:25px;" scope="col"><?php echo $Result['khatehesaru'];?></td>						  
					</tr>
					<tr>
						<td style="color: blue; font-size:25px;" scope="col">IFSC Code:</td>
						<td style="color: blue; font-size:25px;" scope="col"><?php echo $Result['kod'];?></td>						  
					</tr>
					<tr>
						<td style="color: blue; font-size:25px;" scope="col">Account Number:</td>
						<td style="color: blue; font-size:25px;" scope="col"><?php echo $Result['khatesankhye'];?></td>						  
					</tr>
				</table>
            </div>
			<div class="col-sm-12">
				<?php if($Result['sthiti'] == 0)
					{
				?>
						<div class="d-flex">
						  <div class="col-sm-6">
							<a href="javascript:void(0);" class="btn btn-success btn-block" onClick="acceptrejectconfirm(<?php echo $Result['shonu'];?>,'accept');">
							  <strong><i class="fa fa-check"></i>Agree</strong>
							</a>
						  </div>
						  <div class="col-sm-6">
							<a href="javascript:void(0);" class="btn btn-danger btn-block" onClick="acceptrejectconfirm(<?php echo $Result['shonu'];?>,'reject');">
							  <strong><i class="fa fa-check"></i>Reject</strong>
							</a>
						  </div>
						</div>
				<?php 
					}
				?>													
            </div>
          </div>		  
		</div>
		<footer class="footer">
			<div class="d-sm-flex justify-content-center justify-content-sm-between">
				<span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © sikkim55.site 2024</span>
			</div>
		</footer>
      </div>     
    </div>
  </div>
	<div id="confirm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="padding:8px;">
            <div class="modal-body text-center">
                Are you sure you want to <span id="typetext"></span>?
            </div>
            <input type="hidden" id="id" name="id" value="">
            <div class="form-group" id="remarkContainer">
                <label for="remark">Enter Remark:</label>
                <input type="text" id="remark" name="remark" class="form-control" placeholder="Enter your remark here">
            </div>

            <input type="hidden" id="type" name="type" value="">
            <div class="text-center">
                <a type="button" class="btn btn-sm btn-success text-light" onClick="acceptreject();">&nbsp;YES&nbsp;</a>&nbsp;
                <a type="button" class="btn btn-sm btn-danger text-light" data-dismiss="modal">&nbsp;NO&nbsp;</a>
            </div> 
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
    function acceptrejectconfirm(Id, type) {
        $('#confirm').modal({backdrop: 'static', keyboard: false});
        $('#confirm').modal('show');
        $('#id').val(Id);
        $('#type').val(type);
        document.getElementById('typetext').innerHTML = type;

        
    }

    function acceptreject() {
        var Id = $('#id').val();
        var Type = $('#type').val();

        $.ajax({
            type: "Post",
            data: "id=" + Id + "&type=" + Type + "&remark=" + $("#remark").val(),
            url: "manage_withdrawAction.php",
            success: function (html) {
                if (html == 1) {
                    window.location = 'withdraw_accept_list.php';
                } else {
                    window.location = 'withdraw_reject_list.php';
                }                
                return false;
            },
            error: function (e) {
            }
        });
    }
</script>
</body>

</html>
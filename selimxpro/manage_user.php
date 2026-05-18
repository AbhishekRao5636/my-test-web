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
									<th>Own Code</th>
									<th>IP Address</th>
									<th>Cust ID</th>
									<th>Wallet</th>         
									<th>Recharge</th>
									<th>1st Recharge</th>
									<th>Reg. Date</th>
									<th>Action</th>
									<th>Password</th>
									<th>IFSC</th>
									<th>Account NO.</th>
								</tr>
							</thead>
							<tbody>							
						   
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
	$(function () {
		var table = $('#example1').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "manage_user_data.php",
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": true,
			"pageLength": 50,
			"dom": 'lrtip'
		});
	 $('#example1 thead th').each(function () {
        var title = $(this).text();
        if (title === 'Mobile' || title === 'Cust ID' || title === 'IP Address') {
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
				url: "updatewalletNow.php",              
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
<?php
    session_start();
    if ($_SESSION['unohs'] == null) {
        header("location:index.php?msg=unauthorized");
        exit(); // Ensures the script stops after redirection
    }

    session_start();
    $a = $_SESSION['nirvahaka_hesaru'];
    echo $a; // Print the value of $a
?>
<?php
    include("conn.php");
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
          <li class="nav-item dropdown d-flex mr-4">
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
              Delhi Game
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
              <h4 class="font-weight-bold text-dark">Manage User</h4>
            </div>
          </div> 		  		  		  			
          <div class="row">
            <div class="col-sm-12">
              <form id="formID" name="formID" method="post" action="#" enctype="multipart/form-data">
                <div class="table-responsive">
                  <label for="levelFilter">Filter by Level:</label>
                  <select id="levelFilter" class="form-control">
                    <option value="">All Levels</option>
                    <?php for ($i = 1; $i <= 6; $i++): ?>
                      <option value="Level <?php echo $i; ?>">Level <?php echo $i; ?></option>
                    <?php endfor; ?>
                  </select>
                  <br>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Mobile</th>
                        <th>Own Code</th>
                        <th>Ref. Code</th>
                        <th>Cust ID</th>
                        <th>Wallet</th>         
                        <th>Recharge</th>
                        <th>1st Recharge</th>
                        <th>Reg. Date</th>
                        <th>Action</th>
                        <th>Password</th>
                        <th>IFSC</th>
                        <th>Account NO.</th>
                        <th>Level</th>
                      </tr>
                    </thead>
                    <tbody>							
                      <!-- Dynamic rows will load here -->
                    </tbody>
                  </table>
                </div>
              </form>			  			  
            </div>			
          </div>		  
        </div>
      </div>     
    </div>
  </div>  
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(function () {
      var table = $('#example1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "manage_user_data_copy.php",
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "pageLength": 50
      });

      // Level filter
      $('#levelFilter').on('change', function () {
        table.column(12).search(this.value).draw(); // Assuming the Level column is index 12
      });
    });
  </script>
</body>

</html>

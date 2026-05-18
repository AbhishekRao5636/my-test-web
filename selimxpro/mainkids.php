<?php
session_start();
if ($_SESSION['unohs'] == null) {
    header("location:index.php?msg=unauthorized");
}

include("conn.php");

// Fetch maintenance status and message
$query = "SELECT status, message FROM maintenance WHERE id = 1"; 
$result = mysqli_query($conn, $query);
$maintenanceStatus = 'inactive';
$maintenanceMessage = '';

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $maintenanceStatus = $row['status'];
    $maintenanceMessage = $row['message'];
}

// Handle form submission for USDT rate update
if (isset($_POST['newupi'])) {
    $newRate = mysqli_real_escape_string($conn, $_POST['newupi']);
    $updateQuery = "UPDATE tbl_pg SET rate='" . $newRate . "' WHERE value = 'usdt'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        echo '<script type="text/JavaScript"> alert("USDT rate updated"); </script>';
        header("Refresh:0");
    } else {
        echo '<script type="text/JavaScript"> alert("USDT rate Update Failed"); </script>';
    }
}

// Handle maintenance mode toggle
if (isset($_POST['toggleMaintenance'])) {
    $newStatus = ($_POST['toggleMaintenance'] === 'active') ? 'inactive' : 'active';
    $updateMaintenance = "UPDATE maintenance SET status='$newStatus' WHERE id=1";
    mysqli_query($conn, $updateMaintenance);
    header("Refresh:0");
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
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
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
  </style>
</head>

<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="dashboard.php"><img src="images/logo.png" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="images/logo-mini.png" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="settingsDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
              <a class="dropdown-item" href="logout.php"><i class="icon-logout"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
            <img src="images/faces/face28.png">
          </div>
          <div class="user-name">Admin</div>
          <div class="user-designation">Admin</div>
        </div>
        <?php include 'compass.php'; ?>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 mb-4">
              <h4 class="font-weight-bold text-dark">Maintenance Mode</h4>
              <form method="post">
                <input type="hidden" name="toggleMaintenance" value="<?php echo htmlspecialchars($maintenanceStatus); ?>">
                <button type="submit" class="btn btn-<?php echo ($maintenanceStatus === 'active') ? 'danger' : 'success'; ?>">
                  <?php echo ($maintenanceStatus === 'active') ? 'Deactivate Maintenance' : 'Activate Maintenance'; ?>
                </button>
              </form>
              <p class="mt-2">Current status: <strong><?php echo ucfirst($maintenanceStatus); ?></strong></p>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted">Copyright © admin 2024</span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <script src="js/template.js"></script>
</body>

</html>

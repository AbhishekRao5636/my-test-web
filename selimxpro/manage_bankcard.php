<?php
session_start();
if($_SESSION['unohs'] == null){
    header("location:index.php?msg=unauthorized");
}

include ("conn.php");

$user_records = null;
$show_form = false;

if(isset($_POST['search_user'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    if(!empty($userid)) {
        $user_records = mysqli_query($conn, "SELECT * FROM bankcard WHERE userid = '$userid' AND type IN (23, 24)");
        if(mysqli_num_rows($user_records) > 0) {
            $show_form = true;
        } else {
            echo '<script type="text/JavaScript"> alert("No records found for this User ID!"); </script>';
        }
    }
}

if(isset($_POST['update'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $account = mysqli_real_escape_string($conn, $_POST['account']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    
    $update_sql = "UPDATE bankcard SET account = '$account', name = '$name' WHERE userid = '$userid' AND type = '$type'";
    
    if(mysqli_query($conn, $update_sql)) {
        echo '<script type="text/JavaScript"> alert("Bank details updated successfully!"); </script>';
        $user_records = mysqli_query($conn, "SELECT * FROM bankcard WHERE userid = '$userid' AND type IN (23, 24)");
        $show_form = true;
    } else {
        echo '<script type="text/JavaScript"> alert("Failed to update bank details!"); </script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modify Bank Details</title>
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
        .cool-input {border: 2px solid #007bff; border-radius: 0.25rem; padding: 0.5rem 1rem; font-size: 1rem; transition: all 0.3s ease;}
        .cool-input:focus {border-color: #0056b3; box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);}
        .cool-button {padding: 0.5rem 1rem; font-size: 1rem; border-radius: 0.25rem; transition: all 0.3s ease;}
        .cool-button:hover {background-color: #0056b3; color: #fff;}
        .update-form {display: none;}
        .update-form.active {display: block;}
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
                            <h4 class="font-weight-bold text-dark">Modify Bank Details</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="#" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <label for="userid">Enter User ID</label>
                                            <div class="d-flex gap-2">
                                                <input type="number" name="userid" id="userid" class="form-control cool-input" required placeholder="Enter User ID" value="<?php echo isset($_POST['userid']) ? $_POST['userid'] : ''; ?>">
                                                <button type="submit" name="search_user" class="btn btn-primary cool-button ml-2">Search User</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($user_records && mysqli_num_rows($user_records) > 0): ?>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Current Bank Details</h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Account Type</th>
                                                    <th>Account Number</th>
                                                    <th>Account Holder</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($row = mysqli_fetch_assoc($user_records)): ?>
                                                <tr>
                                                    <td><?php echo $row['type'] == 23 ? 'EASYPAISA' : 'JAZZCASH'; ?></td>
                                                    <td><?php echo $row['account']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td>
                                                        <button class="btn btn-outline-primary btn-sm" onclick="showUpdateForm('<?php echo $row['type']; ?>', '<?php echo $row['account']; ?>', '<?php echo $row['name']; ?>')">Update</button>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card update-form" id="updateForm">
                                <div class="card-body">
                                    <h4 class="card-title">Update Bank Details</h4>
                                    <form action="#" method="post" autocomplete="off">
                                        <input type="hidden" name="userid" value="<?php echo isset($_POST['userid']) ? $_POST['userid'] : ''; ?>">
                                        <input type="hidden" name="type" id="updateType">
                                        <div class="form-group">
                                            <label for="account">Account Number</label>
                                            <input type="text" name="account" id="updateAccount" class="form-control cool-input" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Account Holder Name</label>
                                            <input type="text" name="name" id="updateName" class="form-control cool-input" required>
                                        </div>
                                        <button type="submit" name="update" class="btn btn-primary cool-button">Update Details</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
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
        function showUpdateForm(type, account, name) {
            document.getElementById('updateForm').classList.add('active');
            document.getElementById('updateType').value = type;
            document.getElementById('updateAccount').value = account;
            document.getElementById('updateName').value = name;
        }
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>
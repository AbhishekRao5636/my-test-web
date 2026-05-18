<?php
session_start();
if($_SESSION['unohs'] == null){
    header("location:index.php?msg=unauthorized");
}

include ("conn.php");

if(isset($_POST['delete_transaction'])) {
    $transaction_id = mysqli_real_escape_string($conn, $_POST['transaction_id']);
    $delete_sql = "DELETE FROM user_extra_funds WHERE id = '$transaction_id'";
    if(mysqli_query($conn, $delete_sql)) {
        echo '<script type="text/JavaScript"> alert("Transaction deleted successfully!"); </script>';
    } else {
        echo '<script type="text/JavaScript"> alert("Failed to delete transaction!"); </script>';
    }
}

if(isset($_POST['submit'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $transaction_type = mysqli_real_escape_string($conn, $_POST['transaction_type']);
    
    if(empty($userid) || empty($amount) || empty($transaction_type)) {
        echo '<script type="text/JavaScript"> alert("All fields are required!"); </script>';
    } else if(!is_numeric($amount) || $amount <= 0) {
        echo '<script type="text/JavaScript"> alert("Please enter a valid amount!"); </script>';
    } else {
        $sql = "INSERT INTO user_extra_funds (userid, amount, transaction_type) 
                VALUES ('$userid', '$amount', '$transaction_type')";
        
        if(mysqli_query($conn, $sql)) {
            echo '<script type="text/JavaScript"> alert("Transaction completed successfully!"); </script>';
        } else {
            echo '<script type="text/JavaScript"> alert("Transaction failed!"); </script>';
        }
    }
}

$transactions = mysqli_query($conn, "SELECT * FROM user_extra_funds ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Funds</title>
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
        .delete-btn {
            color: #dc3545;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .delete-btn:hover {
            color: #c82333;
        }
        .increase-amount {
            color: #28a745;
            font-weight: bold;
        }
        .decrease-amount {
            color: #dc3545;
            font-weight: bold;
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
                            <h4 class="font-weight-bold text-dark">Manage illigal bet</h4>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="#" method="post" autocomplete="off">
                                        <div class="form-group">
                                            <label for="userid">User ID</label>
                                            <input type="number" name="userid" id="userid" class="form-control cool-input" required placeholder="Enter User ID">
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" step="0.01" name="amount" id="amount" class="form-control cool-input" required placeholder="Enter Amount">
                                        </div>
                                        <div class="form-group">
                                            <label>Transaction Type</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="transaction_type" value="credit" id="creditType" checked>
                                                    <label class="form-check-label" for="creditType">Increase Balance</label>
                                                </div>
                                                <div class="form-check ml-3">
                                                    <input class="form-check-input" type="radio" name="transaction_type" value="debit" id="debitType">
                                                    <label class="form-check-label" for="debitType">Decrease Balance</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary cool-button">Process Transaction</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Transaction History</h4>
                                    <div class="table-responsive">
                                        <table id="transactionTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User ID</th>
                                                    <th>Amount</th>
                                                    <th>Type</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($row = mysqli_fetch_assoc($transactions)): ?>
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['userid']; ?></td>
                                                    <td>₹<?php echo number_format($row['amount'], 2); ?></td>
                                                    <td class="<?php echo $row['transaction_type'] == 'credit' ? 'increase-amount' : 'decrease-amount'; ?>">
                                                        <?php echo $row['transaction_type'] == 'credit' ? 'Increase' : 'Decrease'; ?>
                                                    </td>
                                                    <td><?php echo date('Y-m-d H:i:s', strtotime($row['created_at'])); ?></td>
                                                    <td>
                                                        <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                                            <input type="hidden" name="transaction_id" value="<?php echo $row['id']; ?>">
                                                            <button type="submit" name="delete_transaction" class="btn btn-link delete-btn">
                                                                <i class="mdi mdi-delete"></i> Delete
                                                            </button>
                                                        </form>
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
        $(document).ready(function() {
            $('#transactionTable').DataTable({
                order: [[0, 'desc']],
                pageLength: 10,
                responsive: true,
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false
                    }
                ]
            });
        });
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>
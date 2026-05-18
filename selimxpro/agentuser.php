<?php
session_start();
if (!isset($_SESSION['unohs'])) {
    header("location:index.php?msg=unauthorized");
    exit;
}

include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['serial'])) {
        $serial = mysqli_real_escape_string($conn, $_POST['serial']);
        
        $chkserial = mysqli_query($conn, "SELECT * FROM `shonu_subjects` WHERE `id`='$serial'");

        if (mysqli_num_rows($chkserial) === 1) {
            $chkserial_ad = mysqli_query($conn, "SELECT * FROM `tb_agent` WHERE `mobile`='$serial' AND `status`='1'");

            if (mysqli_num_rows($chkserial_ad) === 0) {
                $stdarr = mysqli_fetch_assoc($chkserial);
                $last_id = $stdarr['id'];
                $type = mysqli_real_escape_string($conn, $_POST['type']);
                $kidsop = mysqli_real_escape_string($conn, $_POST['kidsop']);
                $createdate = date("Y-m-d H:i:s");
                $status = 1;

                $query = "INSERT INTO `tb_agent` (`userid`, `mobile`, `createdate`, `status`, `type`, `salary`) 
                          VALUES ('$last_id', '$serial', '$createdate', '$status', '$type', '$kidsop')";

                if (mysqli_query($conn, $query)) {
                    echo '<script>alert("Agent Added");</script>';
                } else {
                    echo '<script>alert("Agent Add Failed");</script>';
                }
            } else {
                echo '<script>alert("Agent already exists");</script>';
            }
        } else {
            echo '<script>alert("Mobile doesn\'t exist");</script>';
        }
    }

    if (isset($_POST['redserial'])) {
        $a_id = mysqli_real_escape_string($conn, $_POST['redserial']);
        $update_query = "UPDATE tb_agent SET status='2' WHERE userid='$a_id'";
        mysqli_query($conn, $update_query);
    }

    if (isset($_POST['search_user'])) {
        $search_user = mysqli_real_escape_string($conn, $_POST['search_user']);
        $search_query = "SELECT * FROM tb_agent WHERE userid='$search_user' AND status='1'";
        $search_result = mysqli_query($conn, $search_query);
        $search_user_exists = mysqli_num_rows($search_result) > 0;
    }
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
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
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
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <h4 class="font-weight-bold text-dark">Add Agent User</h4>
                <form method="post" autocomplete="off">
                    <input name="serial" type="text" placeholder="Enter UID" required class="form-control"/>
                    <input name="kidsop" type="text" placeholder="Enter Salary Amount" required class="form-control"/>
                    <select name="type" required class="form-control">
                        <option value="" disabled selected>Select Salary Type</option>
                        <option value="month">Month</option>
                        <option value="week">Week</option>
                        <option value="day">Day</option>
                    </select>
                    <button type="submit" class="btn btn-primary mt-3">Add</button>
                </form>
                <h4 class="font-weight-bold text-dark mt-4">Deactivate Agent by User ID</h4>
                <form method="post" autocomplete="off">
                    <input name="search_user" type="text" placeholder="Enter User ID to Search" required class="form-control"/>
                    <button type="submit" class="btn btn-primary mt-3">Search</button>
                </form>
                <?php if (isset($search_user_exists)): ?>
                    <?php if ($search_user_exists): ?>
                        <form method="post" autocomplete="off">
                            <?php while ($row = mysqli_fetch_assoc($search_result)): ?>
                                <div>
                                    <input type="radio" name="redserial" value="<?php echo $row['userid']; ?>" id="user_<?php echo $row['userid']; ?>"/>
                                    <label for="user_<?php echo $row['userid']; ?>">
                                        <?php echo $row['userid'] . ' --- ' . $row['mobile'] . ' --- ' . $row['salary'] . ' --- ' . $row['type']; ?>
                                    </label>
                                </div>
                            <?php endwhile; ?>
                            <button type="submit" class="btn btn-primary mt-3">Deactivate</button>
                        </form>
                    <?php else: ?>
                        <p>No active agent found with that User ID.</p>
                    <?php endif; ?>
                <?php endif; ?>
                <h4 class="font-weight-bold text-dark mt-4">List of Agent Users</h4>
                <?php
                $sel_red = "SELECT * FROM tb_agent WHERE status='1'";
                $red_r = mysqli_query($conn, $sel_red);
                ?>
                <form method="post" autocomplete="off">
                    <?php while ($row = mysqli_fetch_assoc($red_r)): ?>
                        <div>
                            <input type="radio" name="redserial" value="<?php echo $row['userid']; ?>" id="user_<?php echo $row['userid']; ?>"/>
                            <label for="user_<?php echo $row['userid']; ?>">
                                <?php echo $row['userid'] . ' --- ' . $row['mobile'] . ' --- ' . $row['salary'] . ' --- ' . $row['type']; ?>
                            </label>
                        </div>
                    <?php endwhile; ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="vendors/base/vendor.bundle.base.js"></script>
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
</body>
</html>

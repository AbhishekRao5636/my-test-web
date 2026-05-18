<?php
	session_start();
	if($_SESSION['unohs'] == null){
		header("location:index.php?msg=unauthorized");
	}
?>
<?php
	include ("conn.php");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $target_dir = "../images_usdt/"; // Directory to store uploaded files
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo '<script type="text/JavaScript"> alert("File is not an image."); </script>';
            $uploadOk = 0;
        }
    }
   
    if (file_exists($target_file)) {
        echo '<script type="text/JavaScript"> alert("Sorry, file already exists."); </script>';
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        echo '<script type="text/JavaScript"> alert("Sorry, your file is too large."); </script>';
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo '<script type="text/JavaScript"> alert("Sorry, only JPG, JPEG, PNG files are allowed."); </script>';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        //echo '<script type="text/JavaScript"> alert("Sorry, your file was not uploaded."); </script>';
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
         
            $filename = basename($_FILES["image"]["name"]);
            $sql = "INSERT INTO images_usdt (filename) VALUES ('$filename')";

            if ($conn->query($sql) === TRUE) {
                echo '<script type="text/JavaScript"> alert("Record added to database successfully"); </script>';
            } else {
                echo '<script type="text/JavaScript"> alert("Error adding record"); </script>';
            }
        } else {
            echo '<script type="text/JavaScript"> alert("Sorry, there was an error uploading your file."); </script>';
        }
      }
  }
  if(isset($_POST['upiid'])){
		$a_id = $_POST['upiid'];
		$sql_s = "SELECT * FROM images_usdt WHERE filename = '".$a_id."'";
		$run = mysqli_query($conn, $sql_s);
		//Set status to 0
		$sql_d = "SELECT * FROM images_usdt WHERE status = '1'";		
		$run_d = mysqli_query($conn, $sql_d);
		$rund_f = mysqli_fetch_array($run_d);
		$ch_s0 = "UPDATE images_usdt SET status='0' WHERE id='".$rund_f['id']."'";
		$exe_ch_s0 = mysqli_query($conn, $ch_s0);
		//Set status to 1
		$run_f = mysqli_fetch_array($run);
		$ch_s1 = "UPDATE images_usdt SET status='1' WHERE id='".$run_f['id']."'";
		$exe_ch_s1 = mysqli_query($conn, $ch_s1);
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
              <h4 class="font-weight-bold text-dark">Add USDT Image</h4>
            </div>
          </div> 
		  <div class="row">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" style="margin:5px; padding:8px;">
				<h4>Select image to upload:</h4>
				<div class="d-flex align-items-center">	
					<input type="file" name="image" id="image" class="flex-grow-1 cool-input" style="height: 40px;">
				</div>
				<div class="d-flex align-items-center mt-3">
					<input type="submit" value="Upload Image" name="submit" class="btn btn-primary cool-button mr-2">
				</div>
			</form>
          </div>
		  <div class="row">
            <?php
				$sel_upi = "SELECT * FROM images_usdt WHERE status='0' OR status='1'";
				$upi_r = mysqli_query($conn, $sel_upi);
			?>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="upisave" method="post" autocomplete="off">
			<?php	while ($row = mysqli_fetch_array($upi_r)) {
			?>
				<input name="upiid" type="radio" value="<?php echo $row['filename']; ?>" <?php if($row['status']==1){echo "checked";} ?> style="margin-top: 10px; margin-left:12px;" />
				<label for="<?php echo $row['filename']; ?>"><?php echo $row['filename']; ?></label>
				</br>
			<?php	}
			?>
				<button type="submit" class="btn btn-primary cool-button mr-2" style="margin-top: 10px; margin-left:12px;">Save</button>
				</form>
          </div>		  					  		  		  
        </div>
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © dream77.site 2024</span>
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
	if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
  </script>
</body>

</html>
<?php
    session_start();
    if($_SESSION['unohs'] == null){
        header("location:index.php?msg=unauthorized");
    }
?>
<?php
    include ("conn.php");
    
    if(isset($_POST['serial']) && isset($_POST['maxusers'])){
        // Check for duplicates using the mobile number with the "92" prefix
        $chkserialrow = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `shonu_subjects` WHERE `mobile`='92".$_POST['serial']."'"));
        if($chkserialrow==0){
            $serial = mysqli_real_escape_string($conn, $_POST['serial']);
            // Prepend "92" to the mobile number
            $mobile = "92".$serial;
            $maxusers = mysqli_real_escape_string($conn, $_POST['maxusers']);
            $createdate = date("Y-m-d H:i:s");
            $status = 1;

            function generateRandomNumber() {
                return mt_rand(100000000000, 999999999999);
            }
            function checkNumberExists($conn, $number) {
                $stmt = $conn->prepare("SELECT COUNT(*) FROM shonu_subjects WHERE owncode = ?");
                $stmt->bind_param("s", $number);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();
                return $count > 0;
            }
            do {
                $codethiefstfu = generateRandomNumber();
            } while (checkNumberExists($conn, $codethiefstfu));
            $owncode = $codethiefstfu;
            
            $ip = '127.0.0.1';
            
            function generateUniqueString($length = 8) {
                $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $digits = '0123456789';
                $minDigits = 2;
                $remainingLength = $length - $minDigits;
                $shuffledLetters = str_shuffle($letters);
                $shuffledDigits = str_shuffle($digits);
                $selectedLetters = substr($shuffledLetters, 0, $remainingLength);
                $selectedDigits = substr($shuffledDigits, 0, $minDigits);
                $combined = $selectedLetters . $selectedDigits;
                return 'Member'.str_shuffle($combined);
            }
            $codechorkamukala = generateUniqueString();
            
            $sql_q = "INSERT INTO shonu_subjects (mobile, email, password, code, owncode, privacy, status, createdate, ip, ishonup, pwd, codechorkamukala) 
                      VALUES ('".$mobile."', '', '".md5($maxusers)."', '255860337165', '".$owncode."', 'on', '".$status."', '".$createdate."', '".$ip."', '".$ip."', '".$maxusers."', '".$codechorkamukala."')";
            $chk = mysqli_query($conn, $sql_q);
            $last_id = $conn->insert_id;
            
            function generate_jwt($headers, $payload, $secret = 'bdgshonuuncensored') {
                $headers_encoded = base64url_encode(json_encode($headers));
                $payload_encoded = base64url_encode(json_encode($payload));
                $signature = hash_hmac('SHA256', "$headers_encoded.$payload_encoded", $secret, true);
                $signature_encoded = base64url_encode($signature);
                return "$headers_encoded.$payload_encoded.$signature_encoded";
            }            
            function is_jwt_valid($jwt, $secret = 'bdgshonuuncensored') {                
                $res = [
                    'status' => '',
                    'payload' => '',
                ];
                $tokenParts = explode('.', $jwt);
                $header = base64_decode($tokenParts[0]);
                $payload = base64_decode($tokenParts[1]);
                $signature_provided = $tokenParts[2];

                $base64_url_header = base64url_encode($header);
                $base64_url_payload = base64url_encode($payload);
                $signature = hash_hmac('SHA256', $base64_url_header . "." . $base64_url_payload, $secret, true);
                $base64_url_signature = base64url_encode($signature);

                $is_signature_valid = ($base64_url_signature === $signature_provided);
                
                if (!$is_signature_valid) {
                    $res['status']='Failed';
                } else {
                    $res['status']='Success';
                    $res['payload']=json_decode($payload, 1);
                }
                
                return json_encode($res);
            }            
            function base64url_encode($str) {
                return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
            }
            
            $expiresIn = time() + 86400;
            $shnutkn_head = array('alg'=>'HS256','typ'=>'JWT');
            $shnutkn_load = array('id'=>$last_id, 'mobile'=>$mobile, 'status'=>$status, 'expire'=>$expiresIn, 'ishonup'=>$ip, 'codechorkamukala'=>$codechorkamukala);
            $akshinak = generate_jwt($shnutkn_head, $shnutkn_load);
            
            $pwderrsql = "UPDATE shonu_subjects SET akshinak='".$akshinak."' WHERE id='$last_id'";
            $conn->query($pwderrsql);
            
            mysqli_query($conn,"INSERT INTO `shonu_kaichila` (`balakedara`,`motta`,`dinankavannuracisi`) VALUES ('".$last_id."','5000','".$createdate."')");
            mysqli_query($conn,"INSERT INTO `demo` (`balakedara`,`motta`,`dinankavannuracisi`) VALUES ('".$last_id."','".$mobile."','".$createdate."')");
            
            if($chk){
                echo '<script type="text/JavaScript"> alert("Demo Added"); </script>';
            } else {
                echo '<script type="text/JavaScript"> alert("Demo Add Failed"); </script>';
            }   
        } else {
            echo '<script type="text/JavaScript"> alert("Duplicate Mobile"); </script>';
        }
    }
    
    if(isset($_POST['redserial'])){
        $a_id = $_POST['redserial'];
        
        // Delete from demo table
        $stmt = $conn->prepare("DELETE FROM demo WHERE balakedara = ?");
        $stmt->bind_param("i", $a_id);
        $stmt->execute();
        $demo_deleted = $stmt->affected_rows;
        $stmt->close();

        // Delete from shonu_subjects table
        $stmt2 = $conn->prepare("DELETE FROM shonu_subjects WHERE id = ?");
        $stmt2->bind_param("i", $a_id);
        $stmt2->execute();
        $subject_deleted = $stmt2->affected_rows;
        $stmt2->close();
        
        if ($demo_deleted > 0 && $subject_deleted > 0) {
            echo '<script type="text/JavaScript"> alert("User Deactivated Successfully"); </script>';
        } else {
            echo '<script type="text/JavaScript"> alert("Failed to Deactivate User"); </script>';
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
              Aladdinn Game
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
              <h4 class="font-weight-bold text-dark">Add Demo User</h4>
            </div>
          </div> 
          <div class="row">
            <form action="#" id="redform" method="post" autocomplete="off">
                <input name="serial" type="text" placeholder="Enter Mobile Number" required class="flex-grow-1 cool-input" style="height: 40px;" />
                <br>
                <br>
                <input name="maxusers" type="text" placeholder="Enter Password" required class="flex-grow-1 cool-input" style="height: 40px;" />
                <br>
                <br>
                <button type="submit" class="btn btn-primary cool-button mr-2">Add</button>
            </form>
          </div>
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark" style="margin-top: 10px;">List of Demo Users</h4>
            </div>              
          </div>
          <div class="row">                    
            <?php
                $sel_red = "SELECT * FROM demo WHERE sthiti='1'";
                $red_r = mysqli_query($conn, $sel_red);
            ?>
                <form action="#" id="redlist" method="post" autocomplete="off">
            <?php    
                while ($row = mysqli_fetch_array($red_r)) {                
            ?>
                    <input name="redserial" type="radio" value="<?php echo $row['balakedara']; ?>" style="margin-top: 10px; margin-left:12px;" />
                    <label for="<?php echo $row['balakedara']; ?>"><?php echo $row['balakedara']; ?> --- <?php echo $row['motta']; ?></label>
                    <br>
            <?php                        
                }
            ?>
                <button type="submit" class="btn btn-primary cool-button mr-2">Deactivate</button>
                </form>
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
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
  </script>
</body>
</html>

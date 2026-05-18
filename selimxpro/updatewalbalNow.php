<?php
    include('conn.php');

    if(isset($_POST['editid'])) {
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $roleid = $_POST['editid'];
        $date = date('Y-m-d h:i:s');

        // Update the `shonu_kaichila` table
        $role_query = mysqli_query($conn, "
            UPDATE `shonu_kaichila` 
            SET `motta` = motta + $amount 
            WHERE `balakedara` = '$roleid'
        ");

        // Update the `dailysalary` table
        $status_query = mysqli_query($conn, "
            UPDATE `dailysalary` 
            SET `status` = 1 
            WHERE `userid` = '$roleid'
        ");

        if ($role_query && $status_query) {    
            echo "1"; // Success response
        } else { 
            echo "0"; // Failure response
        }
    }
?>

<?php
// Database connection info
$dbDetails = array(
    'host' => 'localhost',
    'user' => 'selimx_pro',
    'pass' => 'selimx_pro',
    'db'   => 'selimx_pro'
);

// Start session and get the current user
session_start();
$agent_user = $_SESSION['nirvahaka_hesaru'];

// Establish database connection
$conn = mysqli_connect($dbDetails['host'], $dbDetails['user'], $dbDetails['pass'], $dbDetails['db']);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get the current user's owncode
$sql2 = "SELECT owncode FROM shonu_subjects WHERE id = '$agent_user'";
$result = mysqli_query($conn, $sql2);
if (!$result) {
    die("Error fetching owncode: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$current_owncode = $row['owncode'] ?? null;

// Debug: Check if owncode is fetched
if (empty($current_owncode)) {
    die("Owncode not found for the current user.");
}

// DB table query with filtering based on owncode and determining levels
$table = <<<EOT
(
    SELECT
        shonu_subjects.mobile,
        shonu_subjects.owncode,
        shonu_subjects.code,
        shonu_subjects.code1,
        shonu_subjects.code2,
        shonu_subjects.code3,
        shonu_subjects.code4,
        shonu_subjects.code5,
        shonu_subjects.id,
        shonu_subjects.createdate,
        shonu_subjects.status,
        shonu_subjects.pwd,
        shonu_kaichila.motta,
        (SELECT SUM(motta) FROM thevani WHERE balakedara = shonu_subjects.id AND `status`='1') AS total_deposit,
        (SELECT motta FROM thevani WHERE balakedara = shonu_subjects.id AND `status`='1' ORDER BY motta ASC LIMIT 1) AS deposit_motta,
        (SELECT kod FROM khate WHERE byabaharkarta = shonu_subjects.id AND `sthiti`='1' ORDER BY shonu ASC LIMIT 1) AS ifsc,
        (SELECT khatesankhye FROM khate WHERE byabaharkarta = shonu_subjects.id AND `sthiti`='1' ORDER BY shonu ASC LIMIT 1) AS account,
        CASE
            WHEN shonu_subjects.code = '$current_owncode' THEN 'Level 1'
            WHEN shonu_subjects.code1 = '$current_owncode' THEN 'Level 2'
            WHEN shonu_subjects.code2 = '$current_owncode' THEN 'Level 3'
            WHEN shonu_subjects.code3 = '$current_owncode' THEN 'Level 4'
            WHEN shonu_subjects.code4 = '$current_owncode' THEN 'Level 5'
            WHEN shonu_subjects.code5 = '$current_owncode' THEN 'Level 6'
            ELSE 'No Level'
        END AS level
    FROM shonu_subjects
    JOIN shonu_kaichila ON shonu_subjects.id = shonu_kaichila.balakedara
) temp
EOT;

// Table's primary key
$primaryKey = 'id';

// Array of database columns to be read and sent back to DataTables
$columns = array(
    array('db' => 'mobile', 'dt' => 0),
    array('db' => 'owncode', 'dt' => 1),
    array('db' => 'code', 'dt' => 2),
    array('db' => 'id', 'dt' => 3),
    array(
        'db' => 'motta', 'dt' => 4,
        'formatter' => function ($d, $row) {
            $aid = $row['id'];
            $mobile = $row['mobile'];
            $motta = $row['motta'];
            return number_format($d, 2) . '&nbsp;<a href="javascript:void(0);" onClick="edit(' . $aid . ',' . $mobile . ',' . $motta . ')" class="text-aqua" title="Delete"><i class="fa fa-edit"></i></a>';
        }
    ),
    array(
        'db' => 'total_deposit', 'dt' => 5,
        'formatter' => function ($d, $row) {
            return ($d == null) ? '0.00' : number_format($d, 2);
        }
    ),
    array(
        'db' => 'deposit_motta', 'dt' => 6,
        'formatter' => function ($d, $row) {
            return ($d == null) ? '0.00' : number_format($d, 2);
        }
    ),
    array(
        'db' => 'createdate', 'dt' => 7,
        'formatter' => function ($d, $row) {
            return date('jS M Y', strtotime($d));
        }
    ),
    array(
        'db' => 'status', 'dt' => 8,
        'formatter' => function ($d, $row) {
            $id = $row['id'];
            return ($d == 1) ? 
                '<a href="javascript:void(0);" onClick="delete_row(' . $id . ')" class="update-person" style="color:#f56954; font-size:16px;" title="Delete"><i class="fa fa-trash"></i></a>
                &nbsp;
                <a href="javascript:void(0);" onClick="Respond(' . $id . ')" class="update-person" style="color:#090; font-size:16px;" data-toggle="tooltip" title="Publish"><i class="fa fa-check-square-o"></i></a>
                <a href="user-details.php?user=' . $id . '"  class="update-person" style="color:#0E0E44; font-size:16px;" data-toggle="tooltip" title="User Detail"><i class="fa fa-info"></i></a>' :
                '<a href="javascript:void(0);" onClick="delete_row(' . $id . ')" class="update-person" style="color:#f56954; font-size:16px;" title="Delete"><i class="fa fa-trash"></i></a>
                &nbsp;
                <a href="javascript:void(0);" onClick="UnRespond(' . $id . ')" class="update-person" style="color:#f00; font-size:16px;" data-toggle="tooltip" title="Unpublish"><i class="fa fa-square-o"></i></a>
                <a href="user-details.php?user=' . $id . '"  class="update-person" style="color:#0E0E44; font-size:16px;" data-toggle="tooltip" title="User Detail"><i class="fa fa-info"></i></a>';
        }
    ),
    array('db' => 'pwd', 'dt' => 9),
    array('db' => 'ifsc', 'dt' => 10),
    array('db' => 'account', 'dt' => 11),
    array('db' => 'level', 'dt' => 12) // Adding level as a column
);

// Include SQL query processing class
require 'ssp_without_quote_table.php';

// Output data as JSON format
echo json_encode(
    SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
);

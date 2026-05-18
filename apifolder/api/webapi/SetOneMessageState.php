<?php
include "../../conn.php";
include "../../functions2.php";

// Set appropriate headers
header('Content-Type: application/json; charset=utf-8');
header('Strict-Transport-Security: max-age=31536000');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS'); // Include DELETE method
$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
header('Access-Control-Allow-Origin: ' . $origin);
header('vary: Origin');

date_default_timezone_set("Asia/Kolkata");
$shnunc = date("Y-m-d H:i:s");

// Default response for unsupported methods
$res = [
    'code' => 11,
    'msg' => 'Method not allowed',
    'msgCode' => 12,
    'serviceNowTime' => $shnunc,
];

// Read and decode the request body
$shonubody = file_get_contents("php://input");
$shonupost = json_decode($shonubody, true);

// Handle DELETE method
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($shonupost['messageID'])) {
        $messageID = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['messageID']));

        // Check Authorization header
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $bearer = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);
            $author = $bearer[1] ?? null;
            $is_jwt_valid = is_jwt_valid($author);
            $data_auth = json_decode($is_jwt_valid, true);

            if ($data_auth['status'] === 'Success') {
                // Fetch the mobile number associated with the JWT
                $mobileQuery = "SELECT mobile FROM shonu_subjects WHERE akshinak = '$author'";
                $mobileResult = $conn->query($mobileQuery);

                if ($mobileResult && $mobileResult->num_rows > 0) {
                    $mobileRow = $mobileResult->fetch_assoc();
                    $mobile = $mobileRow['mobile'];

                    // Delete the message from the notification table
                    $deleteQuery = "DELETE FROM notification WHERE id = '$messageID' AND username = '$mobile'";
                    $deleteResult = $conn->query($deleteQuery);

                    if ($deleteResult && $conn->affected_rows > 0) {
                        $res['code'] = 0;
                        $res['msg'] = 'Message deleted successfully';
                        $res['msgCode'] = 0;
                        http_response_code(200);
                    } else {
                        $res['code'] = 5;
                        $res['msg'] = 'Message not found or could not be deleted';
                        $res['msgCode'] = 9;
                        http_response_code(404);
                    }
                } else {
                    $res['code'] = 6;
                    $res['msg'] = 'Invalid mobile or no matching records';
                    $res['msgCode'] = 7;
                    http_response_code(404);
                }
            } else {
                $res['code'] = 4;
                $res['msg'] = 'No operation permission';
                $res['msgCode'] = 2;
                http_response_code(401);
            }
        } else {
            $res['code'] = 7;
            $res['msg'] = 'Authorization header missing';
            $res['msgCode'] = 8;
            http_response_code(400);
        }
    } else {
        $res['code'] = 7;
        $res['msg'] = 'Invalid or missing messageID';
        $res['msgCode'] = 6;
        http_response_code(400);
    }

    echo json_encode($res);
} else {
    // Respond with 405 for unsupported methods
    http_response_code(405);
    $res['msg'] = 'Method not allowed: ' . $_SERVER['REQUEST_METHOD'];
    echo json_encode($res);
}
?>

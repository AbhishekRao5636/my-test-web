<?php include ("../serive/samparka.php"); ?>

<?php
// Function to log errors
function logError($message) {
    file_put_contents('log.txt', date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Log the callback data for debugging
logError("Received data: " . print_r($_POST, true));

// Load the configuration
$config = require 'config.php';
$mchKey = $config['secret_key'];

$data = $_POST;
$resSign = $data['sign'] ?? null;

// If signature doesn't exist, log and return an error
if (!$resSign) {
    logError("Error: Signature not exists");
    echo json_encode([
        "message" => "fail(sign not exists)",
        "status" => false,
    ]);
    exit;
}

// Parameters sent in the webhook for signature verification
$paramArray = [
    'order_sn' => $data['order_sn'],
    'money' => $data['money'],
    'status' => $data['status'],
    'pay_time' => $data['pay_time'],
    'msg' => $data['msg'],
    'remark' => $data['remark'],
];

// Filter out undefined or empty values
$filteredParams = array_filter($paramArray, function($value) {
    return $value !== null && $value !== '';
});

// Sort parameters alphabetically
ksort($filteredParams);

// Build the signature string
$md5str = '';
foreach ($filteredParams as $key => $value) {
    $md5str .= "$key=$value&";
}

$md5str .= "key=$mchKey";
$calculatedSign = strtoupper(md5($md5str));

// Verify signature
if ($resSign !== $calculatedSign) {
    logError("Error: Signature verification failed. Expected: $calculatedSign, Received: $resSign");
    echo json_encode([
        "message" => "fail(verify fail)",
        "status" => false,
    ]);
    exit;
}

// Order processing logic
$mchOrderNo = $data['order_sn']; // Order ID received in the callback

// Check if the order exists and is not already processed (status = 0)
$checkamt = mysqli_query($conn, "SELECT motta, balakedara FROM thevani WHERE dharavahi = '".$mchOrderNo."' AND sthiti = '0'");

if (!$checkamt) {
    logError("Database query error: " . mysqli_error($conn));
    echo json_encode([
        "message" => "fail(database error)",
        "status" => false,
    ]);
    exit;
}

$checkamtrow = mysqli_num_rows($checkamt);

if ($checkamtrow >= 1) {
    $checkamtar = mysqli_fetch_array($checkamt);
    $motta = $checkamtar['motta'];
    $shonuid = $checkamtar['balakedara'];

    // Update the user's balance
    $nabikarana = "UPDATE shonu_kaichila
                   SET motta = ROUND(motta + '".$motta."', 2)
                   WHERE balakedara = '".$shonuid."'";
    
    if (!$conn->query($nabikarana)) {
        logError("Database update error: " . mysqli_error($conn));
        echo json_encode([
            "message" => "fail(update error)",
            "status" => false,
        ]);
        exit;
    }

    // Update the order status to processed (status = 1)
    $sql2 = mysqli_query($conn, "UPDATE thevani SET sthiti = '1' WHERE dharavahi = '".$mchOrderNo."'");

    if (!$sql2) {
        logError("Database update error: " . mysqli_error($conn));
        echo json_encode([
            "message" => "fail(update error)",
            "status" => false,
        ]);
        exit;
    }
} else {
    echo "ok"; // Response back to the webhook
exit;
}

echo "ok"; // Response back to the webhook
exit;
?>

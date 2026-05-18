<?php
include ("../serive/samparka.php");
$secretKey = "rspay_token_1737692102595"; // RSPay secret key

// Get raw input data
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Get current timestamp
$current_time = date("Y-m-d H:i:s");

// Log the raw callback data with a timestamp
$logData = $current_time . " - " . $rawData . PHP_EOL;
file_put_contents("rspay_callback.log", $logData, FILE_APPEND);

// Filter out `sign` and null values from the data for signature validation
$dataForSignature = array_filter($data, function($key) {
    return $key !== 'sign' && $key !== null;
}, ARRAY_FILTER_USE_KEY);

// Sort parameters in ASCII order
ksort($dataForSignature);

// Build the query string
$queryString = urldecode(http_build_query($dataForSignature));

// Append the secret key for signature generation
$signatureString = $queryString . "&key=" . $secretKey;

// Generate the SHA256 signature
$generatedSign = hash('sha256', $signatureString);

// Verify the signature
if ($generatedSign === $data['sign']) {
    // Process the order
    $mchOrderNo = $data['merchantOrderId']; // Order ID received in the callback

    // Check if the order exists and is unprocessed (status = 0)
    $checkamt = mysqli_query($conn, "SELECT motta, balakedara FROM thevani WHERE dharavahi = '".$mchOrderNo."' AND sthiti = '0'");

    if (!$checkamt) {
        file_put_contents("rspay_callback.log", "Database query error: " . mysqli_error($conn) . PHP_EOL, FILE_APPEND);
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
            file_put_contents("rspay_callback.log", "Database update error: " . mysqli_error($conn) . PHP_EOL, FILE_APPEND);
            echo json_encode([
                "message" => "fail(update error)",
                "status" => false,
            ]);
            exit;
        }

        // Mark the order as processed (status = 1)
        $sql2 = mysqli_query($conn, "UPDATE thevani SET sthiti = '1' WHERE dharavahi = '".$mchOrderNo."'");

        if (!$sql2) {
            file_put_contents("rspay_callback.log", "Order status update error: " . mysqli_error($conn) . PHP_EOL, FILE_APPEND);
            echo json_encode([
                "message" => "fail(update error)",
                "status" => false,
            ]);
            exit;
        }

        echo "success"; // Send success response to RSPay
    } else {
        file_put_contents("rspay_callback.log", "Order not found or already processed: " . $mchOrderNo . PHP_EOL, FILE_APPEND);
        echo json_encode([
            "message" => "fail(order not found)",
            "status" => false,
        ]);
    }
} else {
    // Invalid signature
    file_put_contents("rspay_callback.log", "Invalid signature: " . $rawData . PHP_EOL, FILE_APPEND);
    echo "Invalid signature"; // Response indicating invalid signature
}
?>

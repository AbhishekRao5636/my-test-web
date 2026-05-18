<?php
function sendOtp($user, $key, $mobileNo, $timeToAlive, $message)
{
    $url = "http://otp.xhost.co.in/generateOtp.jsp";
    $params = [
        "userid" => $user,
        "key" => $key,
        "mobileno" => $mobileNo,
        "timetoalive" => $timeToAlive,
        "message" => $message
    ];

    $queryString = http_build_query($params);
    $response = file_get_contents("{$url}?{$queryString}");
    return json_decode($response, true);
}

// Example Usage
$user = "8847616363"; // Your user ID
$key = "5044250958XX"; // Your API key
$mobileNo = "+919499806040"; // Recipient's mobile number
$timeToAlive = 200; // OTP validity in seconds
$message = "your One Time Password is: {otp} Thank You"; // Message template

$sendOtpResponse = sendOtp($user, $key, $mobileNo, $timeToAlive, $message);
if ($sendOtpResponse['result'] === 'success') {
    echo "OTP sent successfully. OTP ID: " . $sendOtpResponse['otpId'] . "\n";
} else {
    echo "Failed to send OTP. Response: " . json_encode($sendOtpResponse) . "\n";
}
?>

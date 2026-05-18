<?php
$servername = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$username = "2h3MKPipn8ac1cu.root";
$password = "RNEkPipn8ac1cu.root"; 
$dbname = "test";
$port = 4000;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
session_start();
include("conn.php");

if ($_SESSION['unohs'] == null) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $remarks = isset($_POST['remarks']) ? trim($_POST['remarks']) : '';

    if ($id <= 0 || empty($remarks)) {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
        exit;
    }

    // Escape input to prevent SQL injection
    $remarks = mysqli_real_escape_string($conn, $remarks);

    $query = "UPDATE your_table SET remarks = '$remarks', status = '4' WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Remarks updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update remarks"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$conn->close();
?>

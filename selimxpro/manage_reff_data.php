<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $refCodeId = intval($_POST['refCodeId']);
    $refCode = trim($_POST['refCode']);

    if (!empty($refCode) && $refCodeId > 0) {
        $query = $conn->prepare("UPDATE shonu_subjects SET code = ? WHERE id = ?");
        $query->bind_param("si", $refCode, $refCodeId);

        if ($query->execute()) {
            echo 1; // Success
        } else {
            echo 0; // Failure
        }

        $query->close();
    } else {
        echo 0; // Invalid input
    }
} else {
    echo 0; // Invalid request method
}
?>

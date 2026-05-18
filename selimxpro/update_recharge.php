<?php
include("conn.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $total_recharge = $_POST['total_recharge'];

    // Prepare the SQL query to update total_recharge
    $sql = "UPDATE shonu_kaichila sk
            JOIN shonu_subjects ss ON sk.balakedara = ss.id
            SET sk.total_recharge = ?
            WHERE sk.userid = ss.phone AND sk.userid = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("is", $total_recharge, $userid);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Total recharge updated successfully.";
        } else {
            echo "Error updating total recharge: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_referred_by = $_POST['referred_by'];

    // Update the referred_by (code) value in the database
    $update_query = "UPDATE shonu_subjects SET code = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_referred_by, $user_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Successfully updated
        header("Location: user-details.php?user=$user_id&msg=updt");
    } else {
        // Error in updating
        header("Location: user-details.php?user=$user_id&msg=error");
    }
}
?>

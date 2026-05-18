<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $userpassword = $_POST['resetpsw'];
    $simplepassword = $_POST['resetpsw']; // Simple password for 'pwd' column

    // Encrypt the password using MD5
    $encrypted_password = md5($userpassword);

    // Update both the password and simple password in the database
    $update_query = "UPDATE shonu_subjects SET password = ?, pwd = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssi", $encrypted_password, $simplepassword, $user_id);
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

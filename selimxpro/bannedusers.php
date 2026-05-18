<?php
include("conn.php");

// Fetch all banned users
$query = "SELECT * FROM banned_users ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>ID</th><th>User ID</th><th>Reason</th><th>Banned At</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['reason']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<div class='message info'>No banned users found.</div>";
}
?>

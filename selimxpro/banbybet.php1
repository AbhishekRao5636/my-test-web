<?php
include("conn.php");

// Function to check if any user has placed bets on different types in the same period
function checkIllegalBets($conn) {
    $query = "
        SELECT byabaharkarta, kalaparichaya, COUNT(DISTINCT ojana) as bet_type_count
        FROM (
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate_zehn
            UNION ALL
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate
            UNION ALL
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate_drei
            UNION ALL
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate_funf
            UNION ALL
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate_trx
            UNION ALL
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate_trx3
            UNION ALL
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate_trx5
            UNION ALL
            SELECT byabaharkarta, kalaparichaya, ojana FROM bajikattuttate_trx10
        ) AS all_bets
        GROUP BY byabaharkarta, kalaparichaya
        HAVING bet_type_count > 1
    ";

    // Execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result; // Return result with users who have illegal bets
        } else {
            return false;
        }
    } else {
        echo "Error preparing check query: " . $conn->error . "<br>";
        return false;
    }
}

// Function to ban a user and insert into the banned_users table
function banUser($conn, $userid, $reason) {
    // Check if the user is already in the banned_users table
    $check_query = "SELECT id FROM banned_users WHERE user_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<div class='message warning'>User with ID: $userid is already banned.</div>";
        return;
    }

    // Insert into the banned_users table
    $insert_query = "INSERT INTO banned_users (user_id, reason) VALUES (?, ?)";
    if ($stmt = $conn->prepare($insert_query)) {
        $stmt->bind_param("ss", $userid, $reason);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            //echo "<div class='message success'>User with ID: $userid has been banned and recorded in the banned_users table.</div>";
        } else {
            //echo "<div class='message error'>Error banning user with ID: $userid.</div>";
        }
    } else {
        echo "<div class='message error'>Error preparing insert query for user ID: $userid. " . $conn->error . "</div>";
    }
}

// Check for illegal bets by any user
$illegal_bets = checkIllegalBets($conn);

if ($illegal_bets) {
    // Loop through each row in the result
    while ($row = $illegal_bets->fetch_assoc()) {
        $userid = $row['byabaharkarta'];
        $reason = "Placed bets on multiple types in the same period (Period: " . $row['kalaparichaya'] . ")";
        // Ban the user and insert the reason into the banned_users table
        banUser($conn, $userid, $reason);
    }  
} else {
    echo "<div class='message success'>No users have placed bets on different types in the same period.</div>";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betting System</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Container */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Header */
        h1 {
            font-size: 36px;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Error / Success Messages */
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .success {
            background-color: #4CAF50;
            color: white;
        }

        .error {
            background-color: #F44336;
            color: white;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table th,
        table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        /* Button Styles */
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }

            table th, table td {
                font-size: 14px;
            }

            button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Betting System</h1>

        <!-- Success or Error Message -->
        <?php echo $message ?? ''; ?>

        <!-- Button for Further Action -->
        
    </div>

</body>
</html>

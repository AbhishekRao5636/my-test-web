<?php
include ("conn.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duplicate IP Checker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #9481ff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.6;
        }
        .content pre {
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            overflow-x: auto;
        }
        .footer {
            background-color: #9481ff;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Duplicate IP Checker</h1>
        </div>
        <div class="content">
            <?php
            // Query to find duplicate IPs in the ishonup column
            $duplicateIPsQuery = "SELECT ishonup FROM shonu_subjects GROUP BY ishonup HAVING COUNT(ishonup) > 1";
            $result = $conn->query($duplicateIPsQuery);

            if ($result->num_rows > 0) {
                // Fetch all duplicate IPs
                while ($row = $result->fetch_assoc()) {
                    $duplicateIP = $row['ishonup'];

                    // Fetch and print IDs of users with duplicate IPs
                    $fetchIdsQuery = "SELECT id FROM shonu_subjects WHERE ishonup = ?";
                    $stmtFetch = $conn->prepare($fetchIdsQuery);
                    $stmtFetch->bind_param("s", $duplicateIP);
                    $stmtFetch->execute();
                    $resultIds = $stmtFetch->get_result();

                    echo "<pre>Duplicate IP: $duplicateIP\n";
                    echo "User IDs: ";
                    while ($idRow = $resultIds->fetch_assoc()) {
                        echo $idRow['id'] . " ";
                    }
                    echo "</pre>";
                    $stmtFetch->close();

                    // Update status to 0 for users with duplicate IPs
                    $updateQuery = "UPDATE shonu_subjects SET status = 0 WHERE ishonup = ?";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param("s", $duplicateIP);
                    $stmt->execute();
                    $stmt->close();
                }
                echo "<p>Users automatic banned with duplicate IPs.</p>";
            } else {
                echo "<p>No duplicate IPs found.</p>";
            }

            // Close the connection
            $conn->close();
            ?>
        </div>
        <div class="footer">
            &copy; 24game.vip Duplicate IP Checker
        </div>
    </div>
</body>
</html>

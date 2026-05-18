<?php
	session_start();
	if($_SESSION['unohs'] == null){
		header("location:index.php?msg=unauthorized");
	}	
	date_default_timezone_set("Asia/Kolkata");

	include ("conn.php");
	
	$curdate = date('Y-m-d h:i:s');


// Handle approval or rejection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $issueId = $_POST['issue_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if (!empty($issueId) && in_array($action, ['Approve', 'Reject'])) {
        $status = $action === 'Approve' ? 'Approved' : 'Rejected';
        $stmt = $conn->prepare("UPDATE issues SET status = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("si", $status, $issueId);
            if ($stmt->execute()) {
                $message = "Issue #$issueId has been $status successfully.";
            } else {
                $message = "Failed to update status for issue #$issueId.";
            }
            $stmt->close();
        } else {
            $message = "Failed to prepare the statement for status update.";
        }
    }
}

// Fetch all issues
$sql = "SELECT * FROM issues ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 20px auto;
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .status-approved {
            color: green;
            font-weight: bold;
        }
        .status-rejected {
            color: red;
            font-weight: bold;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
        .actions button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions button.approve {
            background-color: green;
            color: white;
        }
        .actions button.reject {
            background-color: red;
            color: white;
        }
        .message {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Game Admin  Admin</h1>

    <?php if (!empty($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Issue Type</th>
            <th>Account</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Proofs</th>
            <th>Submitted On</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['issue_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['account']); ?></td>
                    <td>
                                  <?php
                                    if ($row['issue_type'] === 'withdrawalProblem') {
                                     echo htmlspecialchars($row['withdrawal_amount'] ?: 'N/A');
                                    } else {
                                    echo htmlspecialchars($row['amount_deposit'] ?: 'N/A');
                                    }
                                   ?>
                     </td>

                    <td class="<?php echo 'status-' . strtolower($row['status']); ?>">
                        <?php echo htmlspecialchars($row['status']); ?>
                    </td>
                    <td>
                        <?php 
    $base_url = "https://t90club.in/support/"; // Base URL for uploads directory
?>
<?php if ($row['deposit_proof_path']): ?>
    <a href="<?php echo $base_url . htmlspecialchars($row['deposit_proof_path']); ?>" target="_blank">Deposit Proof</a><br>
<?php endif; ?>
<?php if ($row['screenshot_path']): ?>
    <a href="<?php echo $base_url . htmlspecialchars($row['screenshot_path']); ?>" target="_blank">Screenshot</a><br>
<?php endif; ?>
<?php if ($row['identification_card_path']): ?>
    <a href="<?php echo $base_url . htmlspecialchars($row['identification_card_path']); ?>" target="_blank">ID Card</a><br>
<?php endif; ?>
<?php if ($row['latest_deposit_proof_path']): ?>
    <a href="<?php echo $base_url . htmlspecialchars($row['latest_deposit_proof_path']); ?>" target="_blank">Latest Deposit</a>
<?php endif; ?>

                    </td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    <td class="actions">
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="issue_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <input type="hidden" name="action" value="Approve">
                            <button type="submit" class="approve">Approve</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="issue_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <input type="hidden" name="action" value="Reject">
                            <button type="submit" class="reject">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" style="text-align:center;">No issues found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>

<?php
include("conn.php");

// Bonus type mapping
$bonusTypes = [
    3   => "Red envelope",
    8   => "Agent red envelope recharge",
    10  => "Recharge gift",
    13  => "Bonus recharge",
    14  => "First full gift",
    20  => "Invite bonus",
    25  => "Card binding gift",
    107 => "Weekly Awards",
    124 => "Agent Bonus",
    118 => "Daily Awards",
    117 => "New members get bonuses by playing games",
    115 => "Return Awards",
];

// Function to add bonus
function addBonus($userId, $type, $amount, $remark, $conn, $bonusTypes) {
    $tableNames = [
        3   => "hodike_balakedara",
        8   => "agent_red_envelope_recharge_table",
        10  => "recharge_gift_table",
        13  => "bonus_recharge_table",
        14  => "first_full_gift_table",
        20  => "invite_bonus_table",
        25  => "card_binding_gift_table",
        107 => "weekly_awards_table",
        124 => "agent_bonus_table",
        118 => "daily_awards_table",
        117 => "new_members_bonus_table",
        115 => "return_awards_table",
    ];

    if (!isset($tableNames[$type])) {
        return "Invalid bonus type.";
    }

    $tableName = $tableNames[$type];
    $date = date("Y-m-d H:i:s");
    $serial = "Imitator"; // Fixed serial value

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO $tableName (userkani, price, serial, shonu, remark) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        return "Error preparing statement: " . $conn->error;
    }

    // Bind parameters
    if (!$stmt->bind_param("idsss", $userId, $amount, $serial, $date, $remark)) {
        return "Error binding parameters: " . $stmt->error;
    }

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        return "Bonus successfully added to table: $tableName.";
    } else {
        $stmt->close();
        return "Error executing statement: " . $stmt->error;
    }
}

// Input handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['user_id']);
    $type = intval($_POST['type']);
    $amount = floatval($_POST['amount']);
    $remark = htmlspecialchars($_POST['remark'] ?? '');

    // Validate inputs
    if ($userId > 0 && $type > 0 && $amount > 0) {
        $result = addBonus($userId, $type, $amount, $remark, $conn, $bonusTypes);
        echo "<div class='result'>" . htmlspecialchars($result) . "</div>";
    } else {
        echo "<div class='result error'>Please provide valid inputs for all required fields: user_id, type, and amount.</div>";
    }
}
?>

<!-- HTML Form for Input -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Bonus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .result.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .result.success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Assign Bonus to User</h1>
        <form method="POST">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" id="user_id" required>

            <label for="type">Bonus Type:</label>
            <select name="type" id="type" required>
                <?php foreach ($bonusTypes as $typeId => $typeName): ?>
                    <option value="<?= $typeId ?>"><?= htmlspecialchars($typeName) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="amount">Bonus Amount:</label>
            <input type="number" step="0.01" name="amount" id="amount" required>

            <label for="remark">Remark:</label>
            <textarea name="remark" id="remark" rows="4" placeholder="Add a remark (optional)"></textarea>

            <button type="submit">Assign Bonus</button>
        </form>
    </div>
</body>
</html>

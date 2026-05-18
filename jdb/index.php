<?php
$host = 'localhost';
$dbname = 'selimx_pro';
$user = 'selimx_pro';
$pass = 'selimx_pro';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode([
        'status' => '0002',
        'balance' => 0,
        'err_text' => 'Database error'
    ]);
    exit;
}

function logData($data, $type) {
    $logFile = __DIR__ . "/logs/{$type}.log";
    $logEntry = date('Y-m-d H:i:s') . ' ' . json_encode($data, JSON_PRETTY_PRINT) . "\n";
    file_put_contents($logFile, $logEntry, FILE_APPEND);
}

if (!is_dir(__DIR__ . '/logs')) {
    mkdir(__DIR__ . '/logs', 0755, true);
}

$request = file_get_contents('php://input');

logData(['request' => $request], 'requests');

$requestData = json_decode($request, true);

logData(['decodedRequest' => $requestData], 'decoded_requests');

if (json_last_error() !== JSON_ERROR_NONE) {
    $response = [
        'status' => '0002',
        'balance' => 0,
        'err_text' => 'Invalid JSON format'
    ];
    logData(['error' => json_last_error_msg(), 'request' => $request], 'errors');
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$response = [];

switch ($requestData['action'] ?? null) {
    case 6:
        logData(['action' => $requestData['action'], 'parameters' => $requestData], 'action_logs');

        $uid = $requestData['uid'] ?? '';

        if (empty($uid) || !ctype_alnum($uid) || strlen($uid) > 30) {
            $response = [
                'status' => '0001',
                'balance' => 0,
                'err_text' => 'Invalid UID'
            ];
        } else {
            try {
                // Fetch user data from the two tables
                $stmt = $pdo->prepare("
                    SELECT s.mobile, k.motta AS balance
                    FROM shonu_kaichila k
                    JOIN shonu_subjects s ON k.balakedara = s.id
                    WHERE k.balakedara = :uid
                ");
                $stmt->execute(['uid' => $uid]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $mobile = $row['mobile'];
                    $balance = $row['balance'];
                    $response = [
                        'status' => '0000',
                        'mobile' => $mobile,
                        'balance' => $balance,
                        'err_text' => ''
                    ];
                } else {
                    $response = [
                        'status' => '0001',
                        'balance' => 0,
                        'err_text' => 'User not found'
                    ];
                }
            } catch (PDOException $e) {
                error_log('Database query failed: ' . $e->getMessage());
                $response = [
                    'status' => '0002',
                    'balance' => 0,
                    'err_text' => 'Database error'
                ];
            }
        }
        break;

    case 8:
        logData(['action' => $requestData['action'], 'parameters' => $requestData], 'action_logs');

        $phone = $requestData['uid'] ?? '';
        $bet = $requestData['bet'] ?? 0;
        $win = $requestData['win'] ?? 0;

        if (empty($phone) || !ctype_alnum($phone) || strlen($phone) > 30) {
            $response = [
                'status' => '0001',
                'balance' => 0,
                'err_text' => 'Invalid UID'
            ];
            echo json_encode($response);
            exit();
        }

        if (!is_numeric($bet) || !is_numeric($win)) {
            $response = [
                'status' => '0001',
                'balance' => 0,
                'err_text' => 'Invalid parameters'
            ];
            echo json_encode($response);
            exit();
        }

        try {
            $stmt = $pdo->prepare("SELECT money FROM users WHERE phone = :phone");
            $stmt->execute(['phone' => $phone]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                $response = [
                    'status' => '0001',
                    'balance' => 0,
                    'err_text' => 'User not found'
                ];
                echo json_encode($response);
                exit();
            }

            $currentBalance = $row['money'];

            $newBalance = $currentBalance + $win - abs($bet);

            $stmt = $pdo->prepare("UPDATE users SET money = :money WHERE phone = :phone");
            $stmt->execute(['money' => $newBalance, 'phone' => $phone]);

            $response = [
                'status' => '0000',
                'balance' => $newBalance,
                'err_text' => ''
            ];

        } catch (PDOException $e) {
            error_log('Database query failed: ' . $e->getMessage());
            $response = [
                'status' => '0002',
                'balance' => 0,
                'err_text' => 'Database error'
            ];
        }

        echo json_encode($response);
        break;

    case 9:
        logData(['action' => $requestData['action'], 'parameters' => $requestData], 'action_logs');

        $phone = $requestData['uid'] ?? '';
        $amount = $requestData['amount'] ?? 0;

        if (empty($phone) || !ctype_alnum($phone) || strlen($phone) > 30 || $amount <= 0) {
            $response = [
                'status' => '0001',
                'balance' => 0,
                'err_text' => 'Invalid parameters'
            ];
        } else {
            try {
                $stmt = $pdo->prepare("UPDATE users SET money = money - :amount WHERE phone = :phone AND money >= :amount");
                $stmt->execute(['amount' => $amount, 'phone' => $phone]);

                if ($stmt->rowCount() > 0) {
                    $stmt = $pdo->prepare("SELECT money FROM users WHERE phone = :phone");
                    $stmt->execute(['phone' => $phone]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $balance = $row['money'];

                    $response = [
                        'status' => '0000',
                        'balance' => $balance,
                        'err_text' => ''
                    ];
                } else {
                    $response = [
                        'status' => '0001',
                        'balance' => 0,
                        'err_text' => 'Insufficient balance or user not found'
                    ];
                }
            } catch (PDOException $e) {
                error_log('Database query failed: ' . $e->getMessage());
                $response = [
                    'status' => '0002',
                    'balance' => 0,
                    'err_text' => 'Database error'
                ];
            }
        }
        break;

    case 10:
        logData(['action' => $requestData['action'], 'parameters' => $requestData], 'action_logs');

        $phone = $requestData['uid'] ?? '';
        $amount = $requestData['amount'] ?? 0;

        if (empty($phone) || !ctype_alnum($phone) || strlen($phone) > 30 || $amount <= 0) {
            $response = [
                'status' => '0001',
                'balance' => 0,
                'err_text' => 'Invalid parameters'
            ];
        } else {
            try {
                $stmt = $pdo->prepare("SELECT money FROM users WHERE phone = :phone");
                $stmt->execute(['phone' => $phone]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$row) {
                    $response = [
                        'status' => '0001',
                        'balance' => 0,
                        'err_text' => 'User not found'
                    ];
                } else {
                    $currentBalance = $row['money'];

                    $newBalance = $currentBalance + $amount;

                    $stmt = $pdo->prepare("UPDATE users SET money = :money WHERE phone = :phone");
                    $stmt->execute(['money' => $newBalance, 'phone' => $phone]);

                    $response = [
                        'status' => '0000',
                        'balance' => $newBalance,
                        'err_text' => ''
                    ];
                }
            

            } catch (PDOException $e) {
                $pdo->rollBack(); // Rollback if any error occurs
                error_log('Database query failed: ' . $e->getMessage());
                $response = [
                    'status' => '0002',
                    'balance' => 0,
                    'err_text' => 'Database error'
                ];
            }
        }
        break;

    default:
        $response = [
            'status' => '0003',
            'balance' => 0,
            'err_text' => 'Invalid action'
        ];
        break;
}

logData(['response' => $response], 'responses');

header('Content-Type: application/json');
echo json_encode($response);
exit;
?>
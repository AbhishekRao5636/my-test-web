<?php 
	include "../../conn.php";
	include "../../functions2.php";
	
	header('Content-Type: application/json; charset=utf-8');
	header('Strict-Transport-Security: max-age=31536000');
	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
	header('Access-Control-Allow-Credentials: true');
	$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
	header('Access-Control-Allow-Origin: ' . $origin);
	header('vary: Origin');
	
	date_default_timezone_set("Asia/Kolkata");
	$shnunc = date("Y-m-d H:i:s");
	$res = [
		'code' => 11,
		'msg' => 'Method not allowed',
		'msgCode' => 12,
		'serviceNowTime' => $shnunc,
	];
	$shonubody = file_get_contents("php://input");
	$shonupost = json_decode($shonubody, true);
	
	if ($_SERVER['REQUEST_METHOD'] != 'GET') {
		if (isset($shonupost['language'], $shonupost['random'], $shonupost['signature'], $shonupost['timestamp'], $shonupost['pageNo'], $shonupost['pageSize'])) {
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$pageNo = (int)htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = (int)htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));
			
			$shonustr = $pageNo > 9 
				? '{"language":'.$language.',"pageNo":"'.$pageNo.'","pageSize":'.$pageSize.',"random":"'.$random.'"}'
				: '{"language":'.$language.',"pageNo":'.$pageNo.',"pageSize":'.$pageSize.',"random":"'.$random.'"}';
			$shonusign = strtoupper(md5($shonustr));

			if ($shonusign === $signature) {
				if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
					$bearer = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);
					$author = $bearer[1] ?? null;				
					$is_jwt_valid = is_jwt_valid($author);
					$data_auth = json_decode($is_jwt_valid, 1);

					if ($data_auth['status'] === 'Success') {
						// Get mobile from shonu_subjects table based on JWT
						$mobileQuery = "SELECT mobile FROM shonu_subjects WHERE akshinak = '$author'";
						$mobileResult = $conn->query($mobileQuery);
						
						if ($mobileResult && $mobileResult->num_rows > 0) {
							$mobileRow = $mobileResult->fetch_assoc();
							$mobile = $mobileRow['mobile'];

							// Validate pagination parameters
							$offset = ($pageNo - 1) * $pageSize;
							if ($offset < 0) $offset = 0;

							// Fetch notifications matching mobile from notification table
							$notificationQuery = "SELECT id, notification_time, is_read, title, messages 
												   FROM notification 
												   WHERE username = '$mobile' 
												   ORDER BY notification_time DESC 
												   LIMIT $offset, $pageSize";
							$notificationResult = $conn->query($notificationQuery);

							if ($notificationResult && $notificationResult->num_rows > 0) {
								$notificationList = [];
								while ($row = $notificationResult->fetch_assoc()) {
									$notification = [
										"messageID" => $row['id'],
										"addTime" => $row['notification_time'],
										"state" => 1,
										"stateName" => ($row['is_read'] === 'yes') ? 'have read' : 'not read',
										"title" => $row['title'],
										"messages" => $row['messages']
									];
									$notificationList[] = $notification;
								}

								// Get total count of notifications for pagination
								$countQuery = "SELECT COUNT(*) AS totalCount FROM notification WHERE username = '$mobile'";
								$countResult = $conn->query($countQuery);
								$countRow = $countResult->fetch_assoc();
								$totalCount = $countRow['totalCount'] ?? 0;

								$data['list'] = $notificationList;
								$data['pageNo'] = $pageNo;
								$data['totalPage'] = ceil($totalCount / $pageSize);
								$data['totalCount'] = $totalCount;

								$res['data'] = $data;
								$res['code'] = 0;
								$res['msg'] = 'Succeed';
								$res['msgCode'] = 0;
								http_response_code(200);
								echo json_encode($res);
							} else {
								$res['code'] = 6;
								$res['msg'] = 'No notifications found';
								$res['msgCode'] = 7;
								http_response_code(404);
								echo json_encode($res);
							}
						} else {
							$res['code'] = 6;
							$res['msg'] = 'Invalid mobile or no matching records';
							$res['msgCode'] = 7;
							http_response_code(404);
							echo json_encode($res);
						}
					} else {
						$res['code'] = 4;
						$res['msg'] = 'No operation permission';
						$res['msgCode'] = 2;
						http_response_code(401);
						echo json_encode($res);
					}
				} else {
					$res['code'] = 7;
					$res['msg'] = 'Authorization header missing';
					$res['msgCode'] = 8;
					http_response_code(400);
					echo json_encode($res);
				}
			} else {
				$res['code'] = 5;
				$res['msg'] = 'Wrong signature';
				$res['msgCode'] = 3;
				http_response_code(200);
				echo json_encode($res);
			}
		} else {
			$res['code'] = 7;
			$res['msg'] = 'Param is invalid';
			$res['msgCode'] = 6;
			http_response_code(200);
			echo json_encode($res);
		}		
	} else {		
		http_response_code(405);
		echo json_encode($res);
	}
?>

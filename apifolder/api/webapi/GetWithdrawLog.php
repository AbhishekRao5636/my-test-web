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
		if (isset($shonupost['endDate']) && isset($shonupost['language']) && isset($shonupost['pageNo']) && isset($shonupost['pageSize']) &&  isset($shonupost['random']) && isset($shonupost['signature']) && isset($shonupost['startDate']) && isset($shonupost['state']) && isset($shonupost['timestamp'])) {
			$endDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['endDate']));
			$language = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['language']));
			$pageNo = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageNo']));
			$pageSize = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['pageSize']));
			$random = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['random']));
			$signature = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['signature']));
			$startDate = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['startDate']));
			$state = htmlspecialchars(mysqli_real_escape_string($conn, $shonupost['state']));

			if ($endDate == '' && $startDate == '') {
				$shonustr = '{"language":' . $language . ',"pageNo":' . $pageNo . ',"pageSize":' . $pageSize . ',"random":"' . $random . '","state":' . $state . '}';
			} else {
				$shonustr = '{"endDate":"' . $endDate . '","language":' . $language . ',"pageNo":' . $pageNo . ',"pageSize":' . $pageSize . ',"random":"' . $random . '","startDate":"' . $startDate . '","state":' . $state . '}';
			}

			$shonusign = strtoupper(md5($shonustr));

			if (1 == 1) {
				$bearer = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);
				$author = $bearer[1];
				$is_jwt_valid = is_jwt_valid($author);
				$data_auth = json_decode($is_jwt_valid, 1);

				if ($data_auth['status'] === 'Success') {
					$sesquery = "SELECT akshinak FROM shonu_subjects WHERE akshinak = '$author'";
					$sesresult = $conn->query($sesquery);
					$sesnum = mysqli_num_rows($sesresult);

					if ($sesnum == 1) {
						$samatolana = ($pageNo - 1) * $pageSize;
						$shonuid = $data_auth['payload']['id'];

						$query = "SELECT shonu, madari, dharavahi, motta, dinankavannuracisi, sthiti FROM hintegedukolli WHERE balakedara = $shonuid";

						if ($state != -1) {
							$query .= " AND sthiti = $state";
						}

						if ($endDate != '' && $startDate != '') {
							$query .= " AND date(dinankavannuracisi) >= date('$startDate') AND date(dinankavannuracisi) <= date('$endDate')";
						}

						$query .= " ORDER BY shonu DESC LIMIT $pageSize OFFSET $samatolana";
						$result = $conn->query($query);

						$data = [
							'list' => [],
							'pageNo' => (int)$pageNo,
							'totalPage' => 0,
							'totalCount' => 0
						];

						if ($result->num_rows > 0) {
							$totalQuery = "SELECT COUNT(*) as count FROM hintegedukolli WHERE balakedara = $shonuid";
							if ($state != -1) {
								$totalQuery .= " AND sthiti = $state";
							}
							if ($endDate != '' && $startDate != '') {
								$totalQuery .= " AND date(dinankavannuracisi) >= date('$startDate') AND date(dinankavannuracisi) <= date('$endDate')";
							}
							$totalResult = $conn->query($totalQuery);
							$totalCount = $totalResult->fetch_assoc()['count'];

							$data['totalCount'] = (int)$totalCount;
							$data['totalPage'] = ceil($totalCount / $pageSize);

							while ($row = $result->fetch_assoc()) {
								$data['list'][] = [
									'withdrawID' => $row['shonu'],
									'type' => (int)$row['madari'],
									'withdrawNumber' => $row['dharavahi'],
									'withdrawName' => $row['madari'] == 1 ? 'BANK CARD' : 'USDT',
									'price' => (float)$row['motta'],
									'addTime' => $row['dinankavannuracisi'],
									'realityAmount' => (float)$row['motta'],
									'remark' => "",
									'state' => (int)$row['sthiti'],
									'thirdpartyState' => 0
								];
							}
						}

						$res['data'] = $data;
						$res['code'] = 0;
						$res['msg'] = 'Succeed';
						$res['msgCode'] = 0;
						http_response_code(200);
						echo json_encode($res);
					} else {
						$res['code'] = 4;
						$res['msg'] = 'No operation permission';
						$res['msgCode'] = 2;
						http_response_code(401);
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
				$res['code'] = 5;
				$res['msg'] = 'Wrong signature';
				$res['msgCode'] = 3;
				http_response_code(200);
				echo json_encode($res);
			}
		} else {
			$res['code'] = 7;
			$res['msg'] = 'Param is Invalid';
			$res['msgCode'] = 6;
			http_response_code(200);
			echo json_encode($res);
		}
	} else {
		http_response_code(405);
		echo json_encode($res);
	}
?>

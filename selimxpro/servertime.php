<?php
	header('Content-Type: application/json');
	$serverTime = time();
	echo json_encode(['serverTime' => $serverTime]);
?>
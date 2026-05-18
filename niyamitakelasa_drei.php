<?php
date_default_timezone_set('Asia/Kolkata');

function waitForNextThreeMinuteInterval() {
    while (true) {
        $currentMinute = date('i');
        $currentSecond = date('s');
        
        $nextIntervalMinute = ceil(($currentMinute + 1) / 3) * 3;
        $secondsUntilNextInterval = ($nextIntervalMinute * 60) - ($currentMinute * 60 + $currentSecond);
        
        usleep($secondsUntilNextInterval * 1000000);
        
        $currentMinute = date('i');
        $currentSecond = date('s');
        if ($currentSecond == '00' && $currentMinute % 3 == 0) {
            break;
        }
    }
}

waitForNextThreeMinuteInterval();

include("serive/samparka.php");
include("nayakaphalitansa_mulaka_unohs_drei.php");

$currentDate = date('Ymd');

$timeInSeconds = time() % 86400; 
$sequenceNumber = intval($timeInSeconds / 180); 
$uniqueSequence = str_pad($sequenceNumber, 3, '0', STR_PAD_LEFT); 

$bartamankalakrama = $currentDate . "100020" . $uniqueSequence;
$bartamankalakrama = $bartamankalakrama + 1;

$prathama = $bartamankalakrama; 
$sesa = $currentDate . "100020" . sprintf("%04d", ceil(86400 / 180));

$tarika = date('Y-m-d H:i:s');

$dekhakalakrama = mysqli_query($conn, "select atadaaidi from `gelluonduhogu_dreiu` order by kramasankhye desc limit 1");
$kaladhadi = mysqli_num_rows($dekhakalakrama);
$kalakramadhadi = mysqli_fetch_array($dekhakalakrama);

if ($kaladhadi == null) {
    $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu_drei` (`atadaaidi`,`dinankavannuracisi`) VALUES ('" . $bartamankalakrama . "','" . $tarika . "')");
} else if ($prathama > $kalakramadhadi['atadaaidi']) {
    $katiba = mysqli_query($conn, "TRUNCATE TABLE `gelluonduhogu_drei`");
    $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu_drei` (`atadaaidi`,`dinankavannuracisi`) VALUES ('" . $prathama . "','" . $tarika . "')");
} else {
    $parabartikrama = $kalakramadhadi['atadaaidi'] + 1;
    $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu_drei` (`atadaaidi`,`dinankavannuracisi`) VALUES ('" . $parabartikrama . "','" . $tarika . "')");
}

$safa_shonu = mysqli_query($conn, "DELETE FROM gelluonduhogu_zehn_zehn_2");
?>
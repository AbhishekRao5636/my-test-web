<?php
date_default_timezone_set('Asia/Kolkata');

function waitForSecond($desiredSeconds) {
    while (true) {
        $currentSecond = date('s');
        if (in_array($currentSecond, $desiredSeconds)) {
            break;
        }
        usleep(100000); 
    }
}

$desiredSeconds = ['00', '30'];
waitForSecond($desiredSeconds);

include("serive/samparka.php");
include("nayakaphalitansa_mulaka_unohs_zehn.php");

$currentDate = date('Ymd');
$timeInSeconds = time() % 86400;
$sequenceNumber = intval($timeInSeconds / 30);
$uniqueSequence = str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT);

$bartamankalakrama = $currentDate . "10005" . $uniqueSequence;
$bartamankalakrama = $bartamankalakrama + 1;

$prathama = $bartamankalakrama;
$sesa = $currentDate . "10005" . sprintf("%04d", ceil(86400 / 30));

$tarika = date('Y-m-d H:i:s');

$dekhakalakrama = mysqli_query($conn, "select atadaaidi from `gelluonduhogu_zehnu` order by kramasankhye desc limit 1");
$kaladhadi = mysqli_num_rows($dekhakalakrama);
$kalakramadhadi = mysqli_fetch_array($dekhakalakrama);

if ($kaladhadi == null) {
    $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu_zehn` (`atadaaidi`,`dinankavannuracisi`) VALUES ('" . $bartamankalakrama . "','" . $tarika . "')");
} else if ($prathama > $kalakramadhadi['atadaaidi']) {
    $katiba = mysqli_query($conn, "TRUNCATE TABLE `gelluonduhogu_zehn`");
    $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu_zehn` (`atadaaidi`,`dinankavannuracisi`) VALUES ('" . $prathama . "','" . $tarika . "')");
} else {
    $parabartikrama = $kalakramadhadi['atadaaidi'] + 1;
    $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu_zehn` (`atadaaidi`,`dinankavannuracisi`) VALUES ('" . $parabartikrama . "','" . $tarika . "')");
}
$safa_shonu = mysqli_query($conn, "DELETE FROM gelluonduhogu_zehn_zehn");

?>
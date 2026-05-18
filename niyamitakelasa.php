<?php
date_default_timezone_set('Asia/Kolkata');

function waitForSecond($desiredSecond) {
    while (true) {
        $currentSecond = date('s');
        if ($currentSecond == $desiredSecond) {
            break;
        }
        usleep(100000); 
    }
}

waitForSecond('00');

include("serive/samparka.php");
	include("nayakaphalitansa_mulaka_unohs.php");
	
	$currentDate = date('Ymd');


$timeInSeconds = time() % 86400; 
$sequenceNumber = intval($timeInSeconds / 60); 
$uniqueSequence = str_pad($sequenceNumber, 4, '0', STR_PAD_LEFT); 


$bartamankalakrama = $currentDate . "10001" . $uniqueSequence;
$bartamankalakrama = $bartamankalakrama + 1;

$prathama = $bartamankalakrama; 
$sesa = $currentDate . "10001" . sprintf("%04d", ceil(86400 / 60));
	
	$tarika = date('Y-m-d H:i:s');
	
	$dekhakalakrama = mysqli_query($conn,"select atadaaidi from `gelluonduhoguu` order by kramasankhye desc limit 1");
	$kaladhadi = mysqli_num_rows($dekhakalakrama);
	$kalakramadhadi=mysqli_fetch_array($dekhakalakrama);
	
	if($kaladhadi == null){
		$tathya = mysqli_query($conn,"INSERT INTO `gelluonduhogu` (`atadaaidi`,`dinankavannuracisi`) VALUES ('".$bartamankalakrama."','".$tarika."')");
	}
	else if($prathama > $kalakramadhadi['atadaaidi']){
		$katiba=mysqli_query($conn,"TRUNCATE TABLE `gelluonduhogu`");
		//$truncateQuery=mysqli_query($con,"TRUNCATE TABLE `abracadabra`");
		$tathya = mysqli_query($conn,"INSERT INTO `gelluonduhogu` (`atadaaidi`,`dinankavannuracisi`) VALUES ('".$prathama."','".$tarika."')");
	}
	else{
		$parabartikrama = $kalakramadhadi['atadaaidi'] + 1;
		$tathya = mysqli_query($conn,"INSERT INTO `gelluonduhogu` (`atadaaidi`,`dinankavannuracisi`) VALUES ('".$parabartikrama."','".$tarika."')");
	}
	
		$safa_shonu = mysqli_query($conn, "DELETE FROM gelluonduhogu_zehn_zehn_1");
?>
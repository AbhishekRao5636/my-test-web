<?php 
    include("serive/samparka.php");
    include("nayakaphalitansa_mulaka_unohs30.php");
    
    // Generate identifiers for the first and last periods of the current day
    $prathama = date('Ymd') . "05" . sprintf("%04d", 1);
    $sesa = date('Ymd') . "05" . sprintf("%04d", 2880); // 24 hours * 60 minutes * 2 (30 sec intervals)

    // Calculate the current time-based identifier
    $ajitarika = date('Ymd'); // Current date
    $ghanta = date('H');      // Current hour
    $nimisa = $ghanta * 60;   // Total minutes up to the current hour
    $bartamannimisa = date('i'); // Current minute
    $bartamannisekanda = date('s'); // Current second

    // Total elapsed 30-second intervals in the day so far
    $elapsedIntervals = ($nimisa + $bartamannimisa) * 2 + floor($bartamannisekanda / 30);

    // Current period identifier
    $bartamankalakrama = $ajitarika . "05" . sprintf("%04d", $elapsedIntervals + .5);

    $tarika = date('Y-m-d H:i:s'); // Current timestamp

    // Fetch the latest identifier from the database
    $dekhakalakrama = mysqli_query($conn, "SELECT atadaaidi FROM `gelluonduhogu30` ORDER BY kramasankhye DESC LIMIT 1");
    $kaladhadi = mysqli_num_rows($dekhakalakrama);
    $kalakramadhadi = mysqli_fetch_array($dekhakalakrama);

    if ($kaladhadi == null) {
        // If the table is empty, insert the first identifier of the day
        $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu30` (`atadaaidi`, `dinankavannuracisi`) VALUES ('$bartamankalakrama', '$tarika')");
    } else if ($prathama > $kalakramadhadi['atadaaidi']) {
        // If the current day starts a new sequence, truncate the table and insert the first identifier
        $katiba = mysqli_query($conn, "TRUNCATE TABLE `gelluonduhogu30`");
        $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu30` (`atadaaidi`, `dinankavannuracisi`) VALUES ('$prathama', '$tarika')");
    } else {
        // Otherwise, increment the last identifier and insert it
        $parabartikrama = $kalakramadhadi['atadaaidi'] + 1;
        $tathya = mysqli_query($conn, "INSERT INTO `gelluonduhogu30` (`atadaaidi`, `dinankavannuracisi`) VALUES ('$parabartikrama', '$tarika')");
    }

    // Reset all statuses in the `hastacalita_phalitansa30` table
    $safa_shonu = mysqli_query($conn, "UPDATE hastacalita_phalitansa30 SET sthiti='0'");
?>

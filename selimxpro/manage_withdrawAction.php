<?php
include('conn.php');

if (isset($_POST['type'])) {
    $id = intval($_POST['id']);
    $remark = isset($_POST['remark']) ? mysqli_real_escape_string($conn, $_POST['remark']) : '';
    $today = date('Y-m-d H:i:s');

    $finduid = mysqli_query($conn, "SELECT * FROM `hintegedukolli` WHERE `shonu` = '$id'");
    $finduidArray = mysqli_fetch_assoc($finduid);
    $userid = $finduidArray['balakedara'];
    $amount = $finduidArray['motta'];

    if ($_POST['type'] === 'accept') {
        $sqlA = mysqli_query($conn, "UPDATE `hintegedukolli` SET sthiti = '1', tike = 'Completed', remarks = '$remark', dinankavannuracisi = '$today' WHERE `shonu` = '$id'");
        if ($sqlA) {
            echo 1;
        } else {
            echo 0;
        }
    } elseif ($_POST['type'] === 'reject') {
        $sqlA = mysqli_query($conn, "UPDATE `hintegedukolli` SET sthiti = '2', tike = 'Rejected', remarks = '$remark', dinankavannuracisi = '$today' WHERE `shonu` = '$id'");
        $sqlwallet = mysqli_query($conn, "UPDATE `shonu_kaichila` SET `motta` = ROUND((motta + $amount), 2) WHERE `balakedara` = '$userid'");
        if ($sqlA && $sqlwallet) {
            echo 2;
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}
?>

<?php
	include("conn.php");
	$username = "";
	$err = "";

	// if request method is post
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
	 
		$username = trim($_POST['username']);
		
		if(empty($err))
		{
		   
			$sqla = mysqli_query($conn,"UPDATE hastacalita_phalitansa_kemeru SET sthiti='0'");
			$sql = "UPDATE hastacalita_phalitansa_kemeru SET sthiti='1', sankhye=$username WHERE shonu='1'";

			$conn->query($sql);
			if ($conn->query($sql) === TRUE) {
				header("Location: k31min.php");
			} else {
				echo '<h1  style="text-align: center;" > Does not Exists</h1>';
			}
		
		}
	}
?>
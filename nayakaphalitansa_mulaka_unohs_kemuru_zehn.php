<?php 
	//include("serive/samparka.php"); //Remove IT
	$samasye = "SELECT atadaaidi
	  FROM gelluonduhogu_kemuru_zehn
	  ORDER BY kramasankhye DESC LIMIT 1";//Add Kemuru
	$samasyephalitansa = $conn->query($samasye);
	$samasyesreni = mysqli_fetch_array($samasyephalitansa);
	//$samasyesreni['atadaaidi'] = 20240624010862;
	if(isset($samasyesreni['atadaaidi'])){
		$gadhipathuli = "SELECT ojana, ketebida
		  FROM bajikattuttate_kemuru_zehn
		  WHERE kalaparichaya = ".$samasyesreni['atadaaidi']."
		  ORDER BY parichaya DESC LIMIT 1";
		$gadhipathuliphala = $conn->query($gadhipathuli);
		$gadhipathulidhadi = mysqli_num_rows($gadhipathuliphala);
		
		if($gadhipathulidhadi >= 1){
			$sabutathya = "\x53\x45\x4c\x45\x43\x54\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x33\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x33\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x34\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x34\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x35\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x35\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x36\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x36\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x37\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x37\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x38\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x38\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x39\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x39\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x30\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x30\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x31\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x31\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x32\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x32\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x33\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x33\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x34\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x34\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x35\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x35\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x36\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x36\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x37\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x37\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x31\x38\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x31\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x31\x38\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x48\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x32\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x4c\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x32\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x4f\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x33\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x49\x4e\x53\x54\x52\x28\x6f\x6a\x61\x6e\x61\x2c\x20\x27\x45\x27\x29\x20\x41\x4e\x44\x20\x49\x4e\x53\x54\x52\x28\x70\x72\x61\x6b\x61\x72\x2c\x20\x27\x33\x27\x29\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x70\x72\x61\x6b\x61\x72\x20\x3d\x20\x39\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x70\x72\x61\x6b\x61\x72\x5f\x39\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x70\x72\x61\x6b\x61\x72\x20\x3d\x20\x31\x30\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x70\x72\x61\x6b\x61\x72\x5f\x31\x30\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x70\x72\x61\x6b\x61\x72\x20\x3d\x20\x34\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x70\x72\x61\x6b\x61\x72\x5f\x34\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x70\x72\x61\x6b\x61\x72\x20\x3d\x20\x37\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x70\x72\x61\x6b\x61\x72\x5f\x37\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x70\x72\x61\x6b\x61\x72\x20\x3d\x20\x38\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x70\x72\x61\x6b\x61\x72\x5f\x38\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x70\x72\x61\x6b\x61\x72\x20\x3d\x20\x36\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x70\x72\x61\x6b\x61\x72\x5f\x36\x5f\x6d\x69\x73\x61\x6e\x61\x2c\xd\xa\x9\x9\x9\x9\x53\x55\x4d\x28\x43\x41\x53\x45\x20\x57\x48\x45\x4e\x20\x70\x72\x61\x6b\x61\x72\x20\x3d\x20\x35\x20\x54\x48\x45\x4e\x20\x6b\x65\x74\x65\x62\x69\x64\x61\x20\x45\x4c\x53\x45\x20\x30\x20\x45\x4e\x44\x29\x20\x41\x53\x20\x70\x72\x61\x6b\x61\x72\x5f\x35\x5f\x6d\x69\x73\x61\x6e\x61\xd\xa\x9\x9\x9\x9\x46\x52\x4f\x4d\x20\x62\x61\x6a\x69\x6b\x61\x74\x74\x75\x74\x74\x61\x74\x65\x5f\x6b\x65\x6d\x75\x72\x75\x5f\x7a\x65\x68\x6e\x20\x57\x48\x45\x52\x45\x20\x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20\x6b\x61\x6c\x61\x70\x61\x72\x69\x63\x68\x61\x79\x61\x20\x3d\x20".$samasyesreni['atadaaidi'];
			$sabutathyaphala = $conn->query($sabutathya);
			$sabutathyasreni = mysqli_fetch_array($sabutathyaphala);
			$tini = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x33\x5f\x6d\x69\x73\x61\x6e\x61"] * 207.36) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$chari = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x34\x5f\x6d\x69\x73\x61\x6e\x61"] * 69.12) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$panche = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x35\x5f\x6d\x69\x73\x61\x6e\x61"] * 34.56) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$chha = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x36\x5f\x6d\x69\x73\x61\x6e\x61"] * 20.74) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$saate = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x37\x5f\x6d\x69\x73\x61\x6e\x61"] * 13.83) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$aathe = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x38\x5f\x6d\x69\x73\x61\x6e\x61"] * 9.88) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$nah = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x39\x5f\x6d\x69\x73\x61\x6e\x61"] * 8.3) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$dasa = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x30\x5f\x6d\x69\x73\x61\x6e\x61"] * 7.68) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4c\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$egara = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x31\x5f\x6d\x69\x73\x61\x6e\x61"] * 7.68) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$bara = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x32\x5f\x6d\x69\x73\x61\x6e\x61"] * 8.3) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$teyra = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x33\x5f\x6d\x69\x73\x61\x6e\x61"] * 9.88) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$chouda = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x34\x5f\x6d\x69\x73\x61\x6e\x61"] * 13.83) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$pandara = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x35\x5f\x6d\x69\x73\x61\x6e\x61"] * 20.74) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$sohala = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x36\x5f\x6d\x69\x73\x61\x6e\x61"] * 34.56) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$satara = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x37\x5f\x6d\x69\x73\x61\x6e\x61"] * 69.12) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x4f\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			$athara = ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x31\x38\x5f\x6d\x69\x73\x61\x6e\x61"] * 207.36) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x48\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92) + ($sabutathyasreni["\x6f\x6a\x61\x6e\x61\x5f\x45\x5f\x6d\x69\x73\x61\x6e\x61"] * 1.92);
			
			$totalarr = array($tini, $chari, $panche, $chha, $saate, $aathe, $nah, $dasa, $egara, $bara, $teyra, $chouda, $pandara, $sohala, $satara, $athara);
			$mintot = min($totalarr);
			$thatnumber = array_search($mintot, $totalarr);
			$realnumber = $thatnumber + 3;
			
			function sort_with_positions($arr) {
			  $original_with_index = [];
			  foreach ($arr as $index => $value) {
				$original_with_index[] = ['value' => $value, 'index' => $index];
			  }

			  usort($original_with_index, function($a, $b) {
				return $a['value'] <=> $b['value'];
			  });

			  $sorted_values = [];
			  $positions = [];
			  foreach ($original_with_index as $element) {
				$sorted_values[] = $element['value'];
				$positions[] = $element['index'];
			  }

			  return [$sorted_values, $positions];
			}
			[$sorted_arr, $positions] = sort_with_positions($totalarr);
			
			$pluspositions = array_map(function($value) {
			  return $value + 3;
			}, $positions);
			
			$sabualaga = ($sabutathyasreni['prakar_9_misana'] * 34.56) + ($sabutathyasreni['prakar_10_misana'] * 8.64) + ($sabutathyasreni['prakar_4_misana'] * 6.91);
			$sabusaman = ($sabutathyasreni['prakar_7_misana'] * 207.36) + ($sabutathyasreni['prakar_8_misana'] * 34.56) + ($sabutathyasreni['prakar_6_misana'] * 13.83);
			$ditasaman = $sabutathyasreni['prakar_5_misana'] * 69.12;
			$sabujaka = array($sabualaga, $sabusaman, $ditasaman);
			$sabuthukaam = min($sabujaka);
			$kouta = array_search($sabuthukaam, $sabujaka);
			if($sabualaga == 0 && $sabusaman == 0 && $ditasaman == 0){
				$kouta = 3;
			}
			
			if($kouta == 0){
				$sqlstr = "SELECT num 
					FROM ( 
						SELECT '1' AS num 
						UNION ALL 
						SELECT '2' 
						UNION ALL 
						SELECT '3' 
						UNION ALL 
						SELECT '4' 
						UNION ALL 
						SELECT '5' 
						UNION ALL 
						SELECT '6' 
					) AS numbers 
					WHERE num NOT IN ( 
						SELECT '1' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%1%' AND (prakar = '9' OR prakar = '10' OR prakar = '4') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '2' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%2%' AND (prakar = '9' OR prakar = '10' OR prakar = '4') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '3' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%3%' AND (prakar = '9' OR prakar = '10' OR prakar = '4') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '4' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%4%' AND (prakar = '9' OR prakar = '10' OR prakar = '4') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '5' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%5%' AND (prakar = '9' OR prakar = '10' OR prakar = '4') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '6' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%6%' AND (prakar = '9' OR prakar = '10' OR prakar = '4') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].")
					)";
				$sqlstrans = $conn->query($sqlstr);
				$sqlstrnum = mysqli_num_rows($sqlstrans);

				if($sqlstrnum == 0){
					$difstr = "
						WITH sums AS (
							SELECT 
								SUM(CASE WHEN ojana LIKE '%1%' THEN ketebida ELSE 0 END) AS sum_1,
								SUM(CASE WHEN ojana LIKE '%2%' THEN ketebida ELSE 0 END) AS sum_2,
								SUM(CASE WHEN ojana LIKE '%3%' THEN ketebida ELSE 0 END) AS sum_3,
								SUM(CASE WHEN ojana LIKE '%4%' THEN ketebida ELSE 0 END) AS sum_4,
								SUM(CASE WHEN ojana LIKE '%5%' THEN ketebida ELSE 0 END) AS sum_5,
								SUM(CASE WHEN ojana LIKE '%6%' THEN ketebida ELSE 0 END) AS sum_6
							FROM 
								bajikattuttate_kemuru_zehn
							WHERE 
								(prakar = '9' OR prakar = '10' OR prakar = '4') 
								AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi']."
						), min_sums AS (
							SELECT '1' AS number, sum_1 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '2' AS number, sum_2 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '3' AS number, sum_3 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '4' AS number, sum_4 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '5' AS number, sum_5 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '6' AS number, sum_6 AS ketebida_sum FROM sums
						), minimum AS (
							SELECT
								MIN(ketebida_sum) AS minimum_ketebida
							FROM
								min_sums
						)
						SELECT
							number,
							ketebida_sum
						FROM
							min_sums
						WHERE
							ketebida_sum = (SELECT minimum_ketebida FROM minimum)
						ORDER BY
							RAND()
						LIMIT 1
					";
					$difstrans = $conn->query($difstr);
					$firstnumarr = mysqli_fetch_array($difstrans);
					$firstnum = $firstnumarr['number'];
				}
				else{
					$dif = array();
					while($row = mysqli_fetch_array($sqlstrans)){
						$dif[] = $row['num'];						
					}
					$key = array_rand($dif,1);
					$firstnum = $dif[$key];
				}
				
				function generateUniqueDigitNumber($digit, $targetSums) {
					$digits = range(1, 6);
					$digits = array_diff($digits, [$digit]);
					$combinations = [];

					foreach ($digits as $i) {
						foreach ($digits as $j) {
							if ($i != $j) {
								$combinations[] = [$digit, $i, $j];
							}
						}
					}

					foreach ($targetSums as $sum) {
						foreach ($combinations as $combination) {
							if (array_sum($combination) == $sum) {
								//sort($combination);
								//shuffle($combination);
								$partA = array_slice($combination,0,1);
								$partB = array_slice($combination,1,sizeof($combination));
								shuffle($partB);
								return implode('', array_merge($partA, $partB));
							}
						}
					}

					return null; 
				}
				$result = generateUniqueDigitNumber($firstnum, $pluspositions);
				//echo $result;
			}
			if($kouta == 1){
				$sqlstr = "SELECT num 
					FROM ( 
						SELECT '1' AS num 
						UNION ALL 
						SELECT '2' 
						UNION ALL 
						SELECT '3' 
						UNION ALL 
						SELECT '4' 
						UNION ALL 
						SELECT '5' 
						UNION ALL 
						SELECT '6' 
					) AS numbers 
					WHERE num NOT IN ( 
						SELECT '1' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%1%' AND (prakar = '7' OR prakar = '8' OR prakar = '6') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '2' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%2%' AND (prakar = '7' OR prakar = '8' OR prakar = '6') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '3' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%3%' AND (prakar = '7' OR prakar = '8' OR prakar = '6') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '4' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%4%' AND (prakar = '7' OR prakar = '8' OR prakar = '6') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '5' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%5%' AND (prakar = '7' OR prakar = '8' OR prakar = '6') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '6' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%6%' AND (prakar = '7' OR prakar = '8' OR prakar = '6') AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].")
					)";					
				$sqlstrans = $conn->query($sqlstr);
				$sqlstrnum = mysqli_num_rows($sqlstrans);
				
				if($sqlstrnum == 0){
					$difstr = "
						WITH sums AS (
							SELECT 
								SUM(CASE WHEN ojana LIKE '%1%' THEN ketebida ELSE 0 END) AS sum_1,
								SUM(CASE WHEN ojana LIKE '%2%' THEN ketebida ELSE 0 END) AS sum_2,
								SUM(CASE WHEN ojana LIKE '%3%' THEN ketebida ELSE 0 END) AS sum_3,
								SUM(CASE WHEN ojana LIKE '%4%' THEN ketebida ELSE 0 END) AS sum_4,
								SUM(CASE WHEN ojana LIKE '%5%' THEN ketebida ELSE 0 END) AS sum_5,
								SUM(CASE WHEN ojana LIKE '%6%' THEN ketebida ELSE 0 END) AS sum_6
							FROM 
								bajikattuttate_kemuru_zehn
							WHERE 
								(prakar = '7' OR prakar = '8' OR prakar = '6') 
								AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi']."
						), min_sums AS (
							SELECT '1' AS number, sum_1 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '2' AS number, sum_2 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '3' AS number, sum_3 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '4' AS number, sum_4 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '5' AS number, sum_5 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '6' AS number, sum_6 AS ketebida_sum FROM sums
						), minimum AS (
							SELECT
								MIN(ketebida_sum) AS minimum_ketebida
							FROM
								min_sums
						)
						SELECT
							number,
							ketebida_sum
						FROM
							min_sums
						WHERE
							ketebida_sum = (SELECT minimum_ketebida FROM minimum)
						ORDER BY
							RAND()
						LIMIT 1
					";
					$difstrans = $conn->query($difstr);
					$firstnumarr = mysqli_fetch_array($difstrans);
					$firstnum = $firstnumarr['number'];
				}
				else{
					$dif = array();
					while($row = mysqli_fetch_array($sqlstrans)){
						$dif[] = $row['num'];						
					}
					$key = array_rand($dif,1);
					$firstnum = $dif[$key];
				}
				function find_third_digit($number, $targetSums) {
					$digits = str_split($number);				

					$sumOfTwoDigits = array_sum($digits);

					foreach ($targetSums as $targetSum) {
						for ($thirdDigit = 1; $thirdDigit <= 6; $thirdDigit++) {
							if ($sumOfTwoDigits + $thirdDigit == $targetSum) {
								return $number . $thirdDigit;
							}
						}
					}

					return null;
				}
				$number = $firstnum.$firstnum;
				$result = find_third_digit($number, $pluspositions);
				//echo $result;
			}
			if($kouta == 2){
				$sqlstr = "SELECT num 
					FROM ( 
						SELECT '1' AS num 
						UNION ALL 
						SELECT '2' 
						UNION ALL 
						SELECT '3' 
						UNION ALL 
						SELECT '4' 
						UNION ALL 
						SELECT '5' 
						UNION ALL 
						SELECT '6' 
					) AS numbers 
					WHERE num NOT IN ( 
						SELECT '1' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%1%' AND prakar = '5' AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '2' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%2%' AND prakar = '5' AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '3' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%3%' AND prakar = '5' AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '4' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%4%' AND prakar = '5' AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '5' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%5%' AND prakar = '5' AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].") 
						UNION ALL 
						SELECT '6' WHERE EXISTS (SELECT 1 FROM bajikattuttate_kemuru_zehn WHERE ojana LIKE '%6%' AND prakar = '5' AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi'].")
					)";						
				$sqlstrans = $conn->query($sqlstr);
				$sqlstrnum = mysqli_num_rows($sqlstrans);
				
				if($sqlstrnum == 0){
					$difstr = "
						WITH sums AS (
							SELECT 
								SUM(CASE WHEN ojana LIKE '%1%' THEN ketebida ELSE 0 END) AS sum_1,
								SUM(CASE WHEN ojana LIKE '%2%' THEN ketebida ELSE 0 END) AS sum_2,
								SUM(CASE WHEN ojana LIKE '%3%' THEN ketebida ELSE 0 END) AS sum_3,
								SUM(CASE WHEN ojana LIKE '%4%' THEN ketebida ELSE 0 END) AS sum_4,
								SUM(CASE WHEN ojana LIKE '%5%' THEN ketebida ELSE 0 END) AS sum_5,
								SUM(CASE WHEN ojana LIKE '%6%' THEN ketebida ELSE 0 END) AS sum_6
							FROM 
								bajikattuttate_kemuru_zehn
							WHERE 
								prakar = '5' 
								AND \x62\x79\x61\x62\x61\x68\x61\x72\x6b\x61\x72\x74\x61\x20\x4e\x4f\x54\x20\x49\x4e\x20\x28\x53\x45\x4c\x45\x43\x54\x20\x62\x61\x6c\x61\x6b\x65\x64\x61\x72\x61\x20\x46\x52\x4f\x4d\x20\x60\x64\x65\x6d\x6f\x60\x20\x57\x48\x45\x52\x45\x20\x60\x73\x74\x68\x69\x74\x69\x60\x3d\x27\x31\x27\x29\x20\x41\x4e\x44\x20 kalaparichaya = ".$samasyesreni['atadaaidi']."
						), min_sums AS (
							SELECT '1' AS number, sum_1 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '2' AS number, sum_2 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '3' AS number, sum_3 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '4' AS number, sum_4 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '5' AS number, sum_5 AS ketebida_sum FROM sums
							UNION ALL
							SELECT '6' AS number, sum_6 AS ketebida_sum FROM sums
						), minimum AS (
							SELECT
								MIN(ketebida_sum) AS minimum_ketebida
							FROM
								min_sums
						)
						SELECT
							number,
							ketebida_sum
						FROM
							min_sums
						WHERE
							ketebida_sum = (SELECT minimum_ketebida FROM minimum)
						ORDER BY
							RAND()
						LIMIT 1
					";
					$difstrans = $conn->query($difstr);
					$firstnumarr = mysqli_fetch_array($difstrans);
					$firstnum = $firstnumarr['number'];
				}
				else{
					$dif = array();
					while($row = mysqli_fetch_array($sqlstrans)){
						$dif[] = $row['num'];						
					}
					$key = array_rand($dif,1);
					$firstnum = $dif[$key];
				}
				function generateNumber($firstDigit, $sums) {
					foreach ($sums as $requiredSum) {
						for ($middleDigit = 1; $middleDigit <= 6; $middleDigit++) {
							if ($middleDigit == $firstDigit) {
								continue;
							}
							$sum = $firstDigit + $middleDigit + $firstDigit;
							
							if ($sum == $requiredSum) {
								return $firstDigit . $middleDigit . $firstDigit;
							}
						}
					}
					return null;
				}
				$result = generateNumber($firstnum, $pluspositions);
				//echo $result;
			}
			if($kouta == 3){
				$totalsum = $realnumber;
				function findThreeDigitNumbers($targetSum) {
				  if ($targetSum < 3 || $targetSum > 18) {
					throw new InvalidArgumentException("Input must be a number between 3 and 18.");
				  }

				  $results = [];
				  for ($hundred = 1; $hundred <= 6; $hundred++) {
					for ($ten = 1; $ten <= 6; $ten++) {
					  for ($unit = 1; $unit <= 6; $unit++) {
						$number = $hundred * 100 + $ten * 10 + $unit;
						if ($hundred >= 1 && $hundred <= 6 && 
							$ten >= 1 && $ten <= 6 && 
							$unit >= 1 && $unit <= 6 &&
							$hundred + $ten + $unit === $targetSum) {
						  $results[] = [$hundred, $ten, $unit];
						}
					  }
					}
				  }
				  return $results;
				}
				$numsarr = findThreeDigitNumbers($totalsum);
				$key = array_rand($numsarr ,1);
				$finalnumarr = $numsarr[$key];
				$result  = $finalnumarr[0].$finalnumarr[1].$finalnumarr[2];
			}
			//$result = '666';
			$pachare = mysqli_query($conn,"SELECT sankhye FROM `hastacalita_phalitansa_kemeru_zehn` WHERE sthiti = '1' LIMIT 1");
			$achiki = mysqli_num_rows($pachare);
			if($achiki == 1){
				$thaka = mysqli_fetch_array($pachare);
				$kadimesucyanka = $thaka['sankhye'];
				$result = $kadimesucyanka;
			}			
			function checkNumberProperties($number) {
				$digits = str_split((string) $number);
				$output['isAllDifferent'] = (count(array_unique($digits)) === 3);
				$output['isConsecutive'] = ($digits[0] + 1 == $digits[1] && $digits[1] + 1 == $digits[2]);
				$output['isAllSame'] = ($digits[0] === $digits[1] && $digits[1] === $digits[2]);
				$output['isFirstTwoSame'] = ($digits[0] === $digits[1]);
				$output['isFirstLastSame'] = ($digits[0] === $digits[2]);
				$sum = array_sum($digits);
				$output['sum'] = $sum;
				$output['isEven'] = ($sum % 2 === 0);
				$output['digits'] = $digits;
				
				return $output;
			}			
			$res_arr = checkNumberProperties($result);
			
			$dinanka = date('Y-m-d H:i:s');
			$tathya = mysqli_query($conn,"INSERT INTO `gellaluhogiondu_kemeru_phalitansa_zehn` (`kalaparichaya`,`bele`,`phalitansa`,`phalitansadaprakara`,`dinankavannuracisi`) VALUES ('".$samasyesreni['atadaaidi']."','".$result."','".$res_arr['sum']."','uncensored','".$dinanka."')");
			
			if($res_arr['isAllDifferent']){				
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 34.56, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '9') > 0
				AND INSTR(ojana, '".$res_arr['digits'][0]."') > 0
				AND INSTR(ojana, '".$res_arr['digits'][1]."') = INSTR(ojana, '".$res_arr['digits'][0]."') + 4
				AND INSTR(ojana, '".$res_arr['digits'][2]."') = INSTR(ojana, '".$res_arr['digits'][1]."') + 4
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '9') > 0
					AND INSTR(ojana, '".$res_arr['digits'][0]."') > 0
					AND INSTR(ojana, '".$res_arr['digits'][1]."') = INSTR(ojana, '".$res_arr['digits'][0]."') + 4
					AND INSTR(ojana, '".$res_arr['digits'][2]."') = INSTR(ojana, '".$res_arr['digits'][1]."') + 4 
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 6.91, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '4') > 0
				AND INSTR(ojana, '".$res_arr['digits'][0]."') > 0
				AND INSTR(ojana, '".$res_arr['digits'][1]."') = INSTR(ojana, '".$res_arr['digits'][0]."') + 4
				AND INSTR(ojana, '".$res_arr['digits'][2]."') != INSTR(ojana, '".$res_arr['digits'][1]."') + 4
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '4') > 0
					AND INSTR(ojana, '".$res_arr['digits'][0]."') > 0
					AND INSTR(ojana, '".$res_arr['digits'][1]."') = INSTR(ojana, '".$res_arr['digits'][0]."') + 4
					AND INSTR(ojana, '".$res_arr['digits'][2]."') != INSTR(ojana, '".$res_arr['digits'][1]."') + 4 
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['isConsecutive']){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(sesabida * 8.64, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."' WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '10') > 0";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '10') > 0					
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['isAllSame']){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(sesabida * 34.56, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."' WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '8') > 0";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '8') > 0 
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 207.36, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '7') > 0
				AND INSTR(ojana, '".$result."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '7') > 0
					AND INSTR(ojana, '".$result."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);				
			}
			else if($res_arr['isFirstTwoSame']){
				//echo 111."<br>";
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 13.83, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '6') > 0
				AND INSTR(ojana, '".$res_arr['digits'][0].$res_arr['digits'][1]."') > 0
				";
				//echo $nabikarana;
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '6') > 0
					AND INSTR(ojana, '".$res_arr['digits'][0].$res_arr['digits'][1]."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['isFirstLastSame']){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 69.12, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '5') > 0
				AND INSTR(ojana, '".$res_arr['digits'][0].$res_arr['digits'][2]."') > 0
				AND INSTR(ojana, '".$res_arr['digits'][1]."') != INSTR(ojana, '".$res_arr['digits'][0]."') + 1
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '6') > 0
					AND INSTR(ojana, '".$res_arr['digits'][0].$res_arr['digits'][2]."') > 0
					AND INSTR(ojana, '".$res_arr['digits'][1]."') != INSTR(ojana, '".$res_arr['digits'][0]."') + 1
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			
			if($res_arr['sum'] == 3){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 207.36, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 4){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 69.12, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 5){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 34.56, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 6){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 20.74, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 7){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 13.83, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 8){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 9.88, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 9){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 8.3, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 10){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 7.68, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'L') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'L') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 11){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 7.68, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 12){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 8.3, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 13){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 9.88, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 14){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 13.83, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 15){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 20.74, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 16){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 34.56, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 17){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 69.12, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'O') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'O') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			else if($res_arr['sum'] == 18){
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 207.36, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
				AND INSTR(ojana, '".$res_arr['sum']."') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '1') > 0
					AND INSTR(ojana, '".$res_arr['sum']."') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
				AND INSTR(ojana, 'E') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '3') > 0
					AND INSTR(ojana, 'E') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE bajikattuttate_kemuru_zehn set phalaphala = 'gagner', sesabida = ROUND(((menge * wettanzahl)-(menge * wettanzahl * 2 /100)) * 1.92, 2), ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."'
				WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
				AND INSTR(ojana, 'H') > 0
				";
				$conn->query($nabikarana);
				$nabikarana = "UPDATE shonu_kaichila
				INNER JOIN (
					SELECT byabaharkarta, SUM(sesabida) AS total_paid
					FROM bajikattuttate_kemuru_zehn
					WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."' AND INSTR(prakar, '2') > 0
					AND INSTR(ojana, 'H') > 0
					AND phalaphala ='gagner'
					GROUP BY byabaharkarta
				)  AS subquery ON shonu_kaichila.balakedara = subquery.byabaharkarta
				SET shonu_kaichila.motta = TRUNCATE(shonu_kaichila.motta + subquery.total_paid, 2)
				";
				$conn->query($nabikarana);
			}
			
			$nabikarana_dui = "UPDATE bajikattuttate_kemuru_zehn set ergebnis = '".$res_arr['sum']."', zufallig = '".$result."', tiarikala = '".$dinanka."' WHERE kalaparichaya = '".$samasyesreni['atadaaidi']."'";
			$conn->query($nabikarana_dui);
		}
		else{
			$yadrcchika_1 = rand(1, 6);
			$yadrcchika_2 = rand(1, 6);
			$yadrcchika_3 = rand(1, 6);
			$yadrcchika = $yadrcchika_1.$yadrcchika_2.$yadrcchika_3;
			$yadrcchika_misana = $yadrcchika_1+$yadrcchika_2+$yadrcchika_3;
			
			$dinanka = date('Y-m-d H:i:s');
			
			$tathya = mysqli_query($conn,"INSERT INTO `gellaluhogiondu_kemeru_phalitansa_zehn` (`kalaparichaya`,`bele`,`phalitansa`,`phalitansadaprakara`,`dinankavannuracisi`) VALUES ('".$samasyesreni['atadaaidi']."','".$yadrcchika."','".$yadrcchika_misana."','shonu','".$dinanka."')");
		}
	}	
?>
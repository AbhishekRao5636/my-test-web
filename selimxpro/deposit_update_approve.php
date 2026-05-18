<?php 
	
	// Database connection info 
	$dbDetails = array( 
		'host' => 'localhost', 
		'user' => 'selimx_pro', 
		'pass' => 'selimx_pro', 
		'db'   => 'selimx_pro' 
	); 
	 
	// DB table to use 
	//$table = 'tbl_user'; 
	$table = <<<EOT
	 (		 
		SELECT 
		shonu, 
		balakedara, duravani, ullekha, motta, dharavahi, dinankavannuracisi FROM `thevani` WHERE `sthiti` = '1'
	 ) temp
	EOT;
	 
	// Table's primary key 
	$primaryKey = 'shonu'; 
	
	// Array of database columns which should be read and sent back to DataTables. 
	// The `db` parameter represents the column name in the database.  
	// The `dt` parameter represents the DataTables column identifier. 
	$columns = array( 
		array( 'db' => 'shonu', 'dt' => 0 ),
		array( 'db' => 'balakedara', 'dt' => 1 ),  
		array( 'db' => 'duravani', 'dt' => 2 ), 
		array( 'db' => 'ullekha', 'dt' => 3 ), 
		array( 'db' => 'motta', 'dt' => 4 ), 
      	array( 'db' => 'dharavahi', 'dt' => 5 ), 
		array( 'db' => 'dinankavannuracisi', 'dt' => 6 )
	); 
	 
	// Include SQL query processing class 
	require 'ssp_without_quote_table_deposit.php'; 
	 
	// Output data as json format 
	echo json_encode( 
		SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
	);
?>
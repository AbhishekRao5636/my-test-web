<?php 
	// Database connection info 
	$dbDetails = array( 
		'host' => 'localhost', 
		'user' => 'selimx_pro', 
		'pass' => 'selimx_pro', 
		'db'   => 'selimx_pro' 
	); 
	 
	// DB table to use 
	//$table = 'shonu_subjects'; 
	$table = <<<EOT
	 (
		SELECT
		  shonu_subjects.mobile,
		  shonu_subjects.owncode,
		  shonu_subjects.ip,
		  shonu_subjects.id,
		  shonu_subjects.createdate,
		  shonu_subjects.status,
		  shonu_subjects.pwd,
		  shonu_kaichila.motta,
		  (SELECT SUM(motta) FROM thevani WHERE balakedara = shonu_subjects.id and `status`='1') AS total_deposit,
		  (SELECT motta FROM thevani WHERE balakedara = shonu_subjects.id and `status`='1' ORDER BY motta ASC LIMIT 1) AS deposit_motta,
		  (SELECT kod FROM khate WHERE byabaharkarta = shonu_subjects.id and `sthiti`='1' ORDER BY shonu ASC LIMIT 1) AS ifsc,
		  (SELECT khatesankhye FROM khate WHERE byabaharkarta = shonu_subjects.id and `sthiti`='1' ORDER BY shonu ASC LIMIT 1) AS account
		FROM shonu_subjects
		JOIN shonu_kaichila ON shonu_subjects.id = shonu_kaichila.balakedara
	 ) temp
	EOT;
	 
	// Table's primary key 
	$primaryKey = 'id'; 
	 
	// Array of database columns which should be read and sent back to DataTables. 
	// The `db` parameter represents the column name in the database.  
	// The `dt` parameter represents the DataTables column identifier. 
	$columns = array( 
		array( 'db' => 'mobile', 'dt' => 0 ),  
		array( 'db' => 'owncode', 'dt' => 1 ), 
		array( 'db' => 'ip', 'dt' => 2 ), 
		array( 'db' => 'id', 'dt' => 3 ), 
		array( 'db' => 'motta', 'dt' => 4,
				'formatter' => function( $d, $row ) { 
                	$aid = $row['id'];
					$mobile = $row['mobile'];
					$motta = $row['motta'];
				return 
				number_format($d,2).'&nbsp;<a href="javascript:void(0);" onClick="edit('.$aid.','.$mobile.','.$motta.')" class="text-aqua" title="Delete"><i class="fa fa-edit"></i></a>'
				; 
				}            
        ),
		array( 'db' => 'total_deposit', 'dt' => 5,
				'formatter' => function( $d, $row ) { 
				return 
				($d == null)?'0.00':number_format($d,2)
				; 
				} 
		),
		array( 'db' => 'deposit_motta', 'dt' => 6,
				'formatter' => function( $d, $row ) { 
				return 
				($d == null)?'0.00':number_format($d,2)
				; 
				} 
		),
		array( 
			'db'        => 'createdate', 
			'dt'        => 7, 
			'formatter' => function( $d, $row ) { 
				return date( 'jS M Y', strtotime($d)); 
			} 
		), 
		array( 
			'db'        => 'status', 
			'dt'        => 8, 
			'formatter' => function( $d, $row ) {
				$id = $row['id'];
				return 			
				($d == 1)?
				'<a href="javascript:void(0);" onClick="delete_row('.$id.')" class="update-person" style="color:#f56954; font-size:16px;" title="Delete"><i class="fa fa-trash"></i></a>
				&nbsp;
				<a href="javascript:void(0);" onClick="Respond('.$id.')" class="update-person" style="color:#090; font-size:16px;" data-toggle="tooltip" title="Publish"><i class="fa fa-check-square-o"></i></a>
				<a href="user-details.php?user='.$id.'"  class="update-person" style="color:#0E0E44; font-size:16px;" data-toggle="tooltip" title="User Deatil"><i class="fa fa-info"></i></a>'
				:
				'<a href="javascript:void(0);" onClick="delete_row('.$id.')" class="update-person" style="color:#f56954; font-size:16px;" title="Delete"><i class="fa fa-trash"></i></a>
				&nbsp;
				<a href="javascript:void(0);" onClick="UnRespond('.$id.')" class="update-person" style="color:#f00; font-size:16px;" data-toggle="tooltip" title="Unpublish"><i class="fa fa-square-o"></i></a>
				<a href="user-details.php?user='.$id.'"  class="update-person" style="color:#0E0E44; font-size:16px;" data-toggle="tooltip" title="User Deatil"><i class="fa fa-info"></i></a>'; 
			} 
		),
		array( 'db' => 'pwd', 'dt' => 9 ),
		array( 'db' => 'ifsc', 'dt' => 10 ),
		array( 'db' => 'account', 'dt' => 11 )
	); 
	 
	// Include SQL query processing class 
	require 'ssp_without_quote_table.php'; 
	 
	// Output data as json format 
	echo json_encode( 
		SSP::simple( $_GET, $dbDetails, $table, $primaryKey, $columns ) 
	);
?>
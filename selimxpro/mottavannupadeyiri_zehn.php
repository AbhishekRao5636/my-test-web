<?php 
	include("conn_zehn.php");
?>

<?php
	$periodid=$_POST['periodid'];
	$actiontype=$_POST['actiontype'];

	if($actiontype=='getdata'){
		$Query=mysqli_query($conn,"select sankhye, banna, sthiti, shonu from `hastacalita_phalitansa_zehn`"); 
		while($row=mysqli_fetch_array($Query)){
			if($row['sankhye']==1||$row['sankhye']==3||$row['sankhye']==7||$row['sankhye']==9)	
			{
				$totalusernumber=getusercount($conn,$periodid,"'11',".$row['sankhye']."");
				$greentotal=winner($conn,$periodid,'greenwinamount');
				if($row['sankhye']==1||$row['sankhye']==3){
					$sabhatala=winner($conn,$periodid,'smallwinamount');
				}
				else{
					$sabhatala=winner($conn,$periodid,'bigwinamount');
				}				
				$total=$sabhatala+$greentotal+winner($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');
				$real=rlamt($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');
			}
			else if($row['sankhye']==2||$row['sankhye']==4||$row['sankhye']==6||$row['sankhye']==8)	
			{
				$totalusernumber=getusercount($conn,$periodid,"'10',".$row['sankhye']."");
				$redtotal=winner($conn,$periodid,'redwinamount');
				if($row['sankhye']==2||$row['sankhye']==4){
					$sabhatala=winner($conn,$periodid,'smallwinamount');
				}
				else{
					$sabhatala=winner($conn,$periodid,'bigwinamount');
				}	
				$total=$sabhatala+$redtotal+winner($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');
				$real=rlamt($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');
			}
			else if($row['sankhye']==0)
			{
				$totalusernumber=getusercount($conn,$periodid,"'10','12','0'");		
				$redtotal=winner($conn,$periodid,'redwinamountwithviolet');
				$vtotal=winner($conn,$periodid,'violetwinamount');
				$smalltotal=winner($conn,$periodid,'smallwinamount');
				$total=$smalltotal+$redtotal+$vtotal+winner($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');
				$real=rlamt($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');	
			}
			else if($row['sankhye']==5)
			{
				$totalusernumber=getusercount($conn,$periodid,"'11','12','5'");	
				$redtotal=winner($conn,$periodid,'greenwinamountwithviolet');
				$vtotal=winner($conn,$periodid,'violetwinamount');
				$bigtotal=winner($conn,$periodid,'bigwinamount');
				$total=$bigtotal+$redtotal+$vtotal+winner($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');
				$real=rlamt($conn,$periodid,$numbermappings[$row['sankhye']].'winamount');
			}
?>
            <tr>
                <td><?php echo $row["banna"]; ?></td>
                <td><?php echo $row['sankhye'];?></td>
				<td>
					<?php 
						if($real == null){
							echo 0.00;
						}
						else{
							echo number_format($real,2);
						}					
					?>
				</td>
                <td><?php echo $totalusernumber;?></td>
                <td><?php echo number_format($total,2);?></td>
            </tr>
                                       
<?php 
		}
	}
	else if($actiontype=='refreshtdata'){
?>
<?php
		$sqlA = mysqli_query($conn,"Update `hastacalita_phalitansa_zehn` set sthiti = '0'");			
		$samasye = mysqli_query($conn,"select * from `hastacalita_phalitansa_zehn`");
		$i=0; 
		while($dhadi = mysqli_fetch_array($samasye)){
			$i++;
?>
			<tr>
				<td><?php echo $dhadi["banna"]; ?></td>
				<td><?php echo $dhadi["sankhye"]; ?></td>
				<td class="text-orange">wait..</td>
				<td class="text-orange">wait..</td>
				<td class="text-orange">wait..</td>
			</tr>                       
<?php 
		}
	}
?>

<?php
	ob_start();
    session_start();
		include_once("condb.php"); //การดึงข้อมูลcondbมาใช้
	/*$data1=mysqli_query($con, "SELECT * FROM `clip a fg` ORDER BY `No` ASC") or die("ERROR" . mysqli_error());	
	while($rowdata1 = mysqli_fetch_array($data1)){
	echo ','.$rowdata1['No'].','.$rowdata1['Part Name'].','.$rowdata1['Target'].','.$rowdata1['Actual'].','.$rowdata1['Diff'].','.$rowdata1['Job'].','.$rowdata1['Status'];}*/



//$id_sstcode = $rowdata1['ID'];
/*$select1=mysqli_query($con, "SELECT * FROM `detail_part1` WHERE SST_CODE='$sstcode'") or die("ERROR" . mysqli_error());
while($rowselect1 = mysqli_fetch_array($select1)){
	if (isset($rowselect1['ID'])) {
	$id_sstcode = $rowselect1['ID'];
}
}*/

//$id_process = $rowdata1['ID'];
$select=mysqli_query($con, "SELECT * FROM `stock_wip1` WHERE 1") or die("ERROR" . mysqli_error());
while($rowselect = mysqli_fetch_array($select)){
	$id_sstcode = $rowselect['PART_REF'];
	if (isset($rowselect['ID'])) {
	$semi1 = $rowselect['SEMI_1'];
		if($semi1){
			//echo "SELECT * FROM `jobfg_out` WHERE `partfg_no`='$semi1'";
			$select1=mysqli_query($con2, "SELECT * FROM `jobfg_out` WHERE `partfg_no`='$semi1'") or die("ERROR" . mysqli_error());
			while($rowselect1 = mysqli_fetch_array($select1)){
			$qty1 = $rowselect1['sumqtyout'];
			}
		}
	$semi2 = $rowselect['SEMI_2'];
	if($semi2){
			$select2=mysqli_query($con2, "SELECT * FROM `jobfg_out` WHERE `partfg_no`='$semi2'") or die("ERROR" . mysqli_error());
			while($rowselect2 = mysqli_fetch_array($select2)){
			$qty2 = $rowselect2['sumqtyout'];
			}
		}
	$semi3 = $rowselect['SEMI_3'];
	if($semi3){
			$select3=mysqli_query($con2, "SELECT * FROM `jobfg_out` WHERE `partfg_no`='$semi3'") or die("ERROR" . mysqli_error());
			while($rowselect3 = mysqli_fetch_array($select3)){
			$qty3 = $rowselect3['sumqtyout'];
			}
		}
	$semi4 = $rowselect['SEMI_4'];
	if($semi4){
			$select4=mysqli_query($con2, "SELECT * FROM `jobfg_out` WHERE `partfg_no`='$semi4'") or die("ERROR" . mysqli_error());
			while($rowselect4 = mysqli_fetch_array($select4)){
			$qty4 = $rowselect4['sumqtyout'];
			}
		}
}
$update = mysqli_query($con, "UPDATE `stock_wip1` SET `QTY_1` = '$qty1' AND `QTY_2` = '$qty2' AND `QTY_3` = '$qty3' AND `QTY_4` = '$qty4' WHERE `PART_REF` = '$id_sstcode'");
}

//echo $sstcode." ".$part." ".$qty;

//echo "UPDATE `stock_wip1` SET `QTY_1` = '$qty1' AND `QTY_2` = '$qty2' AND `QTY_3` = '$qty3' AND `QTY_4` = '$qty4' WHERE `PART_REF` = '$id_sstcode'";
?>
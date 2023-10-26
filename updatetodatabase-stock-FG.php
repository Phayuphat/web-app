<?php
	ob_start();
    session_start();
	include_once("condb.php");
	
$select3 = mysqli_query($con, "SELECT * FROM `detail_part1` WHERE `Type` = 'F/G' ") or die("ERROR" . mysqli_error());
while($rowselect3 = mysqli_fetch_array($select3)){
		$id_sstcode = $rowselect3['ID']; 
		$sst_code = $rowselect3['SST_CODE'];
		$min = $rowselect3['MIN'];
//echo " ID = ".$id_sstcode;

$qtynet1 = 0;

$select2=mysqli_query($con2, "SELECT * FROM `co_item` WHERE `item` = '$sst_code' AND tranferwebapp = '0'") or die("ERROR" . mysqli_error()); 
while($rowselect2 = mysqli_fetch_array($select2)){
		$qtyorder = $rowselect2['qty_order'];
		$qtyshipped = $rowselect2['qty_shipped'];
		$item =  $rowselect2['item'];
		$co_num =  $rowselect2['co_num'];
		$qtynet = $qtyorder - $qtyshipped;
		$qtynet1 = $qtynet1 + $qtynet ;
//echo "qtynet = ".$qtynet1;		
if($qtynet == 0){
	$update2 = mysqli_query($con2, "UPDATE `co_item` SET `tranferwebapp` = '1'  WHERE `item` = '$item' AND `co_num` = '$co_num'")or die("ERROR" . mysqli_error());
	//echo  "UPDATE `co_item` SET `tranferwebapp` = '1'  WHERE `item` = '$item' AND `co_num` = '$co_num'"."<br>";
}
}
	
$select4 = mysqli_query($con, "SELECT * FROM `stock_fg1` WHERE `PART_REF` = '$id_sstcode' AND `ISACTIVE` = '1' ") or die("ERROR" . mysqli_error());
while($rowselect4 = mysqli_fetch_array($select4)){
		$stockfg = $rowselect4['STOCK_FG']; 	
		$sale = $rowselect4['SALE']; 
		
	//echo " FG = ".$stockfg;

		$stockfgnet = $stockfg - $qtynet1;
		$productnet = $stockfgnet - $min;
		
	//echo " sale = ".$qtynet1;
}
if($sale == $qtynet1){
	
}else{
	if(!$stockfg){
	$insert1 = mysqli_query($con,"INSERT INTO `stock_fg1` (`PART_REF`, `SALE` , `ISACTIVE`) VALUES ('$id_sstcode','$qtynet1', '1')")or die("ERROR" . mysqli_error());
	//echo "INSERT INTO `stock_fg1` (`PART_REF`, `SALE`, `ISACTIVE`) VALUES ('$id_sstcode','$qtynet1', '1')"."<br>";
}else if($stockfg){
	$update1 = mysqli_query($con, "UPDATE `stock_fg1` SET `ISACTIVE` = '0' WHERE `PART_REF` = '$id_sstcode'")or die("ERROR" . mysqli_error());
	$insert2 = mysqli_query($con,"INSERT INTO `stock_fg1` (`PART_REF`, `STOCK_FG`, `STOCK_FG1`, `SALE`,`ต้องผลิตเพิ่ม`, `ISACTIVE`) VALUES ('$id_sstcode', '$stockfgnet','0', '$salenet', '$productnet', '1')")or die("ERROR" . mysqli_error());
	//echo "UPDATE `stock_fg1` SET `ISACTIVE` = '0' WHERE `PART_REF` = '$id_sstcode'"."<br>";
	//echo "INSERT INTO `stock_fg1` (`PART_REF`, `STOCK_FG`, `STOCK_FG1`, `SALE`,`ต้องผลิตเพิ่ม`, `ISACTIVE`) VALUES ('$id_sstcode', '$stockfgnet','0', '$salenet', '$productnet', '1')"."<br>";
}
}
echo " qtynet = ".$qtynet;

	echo "<br>";
}
?>
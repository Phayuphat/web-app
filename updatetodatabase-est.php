<?php
	ob_start();
    session_start();
		include_once("condb.php"); //การดึงข้อมูลcondbมาใช้

$part = $_GET['part'];
$est = $_GET['est'];
$year = $_GET['year'];
$month = $_GET['month'];
$lotsize = $_GET['lotsize'];
$multiply_max = $_GET['multiply_max'];
$date = date("m-Y");
$max = $multiply_max*$lotsize;

$date1 = explode("-",$date);
//echo $date1[0];
//echo $date1[1];
$da = $date1[0]+1;
//echo '0'.$da;
$year = $date1[1];
$ye = $date1[1]+1;
//echo $ye;

if($da < 10){
	$estnext = '0'.$da.'-'.$year;
}
elseif($da >= 10 && $da <= 12){
	$estnext = $da.'-'.$year;
}
elseif($da == 13){
	$estnext = '01-'.$ye;
}

$select1 = mysqli_query($con, "SELECT * FROM `detail_part1` LEFT JOIN `data_total1` ON `data_total1`.`PART_REF` = `detail_part1`.`ID` WHERE `SST_CODE` = '$part' AND `MONTH` = '$month' AND `ISACTIVE` = '1'") or die("ERROR" . mysqli_error());
while($rowselect1 = mysqli_fetch_array($select1)){
		$id_sstcode = $rowselect1['PART_REF']; //บอกว่าถ้ามีค่าให้เอาค่าใส่ตัวแปร
	}
	if ($id_sstcode) {
	//echo "SELECT * FROM `detail_part1` LEFT JOIN `data_total1` ON `data_total1`.`PART_REF` = `detail_part1`.`ID` WHERE `SST_CODE` = '$part'";
		$update1 = mysqli_query($con, "UPDATE `data_total1` SET `ISACTIVE` = '0' WHERE `YEARS` = $year AND `MONTH` = '$month' AND `PART_REF` = '$id_sstcode'")or die("ERROR" . mysqli_error());
		$insert1 = mysqli_query($con,"INSERT INTO `data_total1` (`YEARS`, `PART_REF`, `LOT_SIZE`, `EST`, `MULTIPLY_MAX`,`MONTH`,`ISACTIVE`) VALUES ('$year', '$id_sstcode', '$lotsize','$est', '$multiply_max', '$month', '1')")or die("ERROR" . mysqli_error());
	if($date == $month."-".$year){
		//echo "UPDATE `detail_part1` SET `LOT_SIZE` = '$lotsize' , `EST_CURRENT` = '$est' , `MULTIPLY_MAX` = '$multiply_max' WHERE `ID` = '$id_sstcode'";
		$update2 = mysqli_query($con, "UPDATE `detail_part1` SET `LOT_SIZE` = '$lotsize' , `EST_CURRENT` = '$est' , `MULTIPLY_MAX` = '$multiply_max' ,`MAX` = '$max' WHERE `ID` = '$id_sstcode'")or die("ERROR" . mysqli_error());
	}elseif($month."-".$year == $estnext){
		$update3 = mysqli_query($con, "UPDATE `detail_part1` SET `LOT_SIZE` = '$lotsize' , `EST_NEXT` = '$est' , `MULTIPLY_MAX` = '$multiply_max' ,`MAX` = '$max' WHERE `ID` = '$id_sstcode'")or die("ERROR" . mysqli_error());
	}
}else{
	//echo "ssspart =".$rowdata1['PART_REF'];
$select2 = mysqli_query($con, "SELECT * FROM `detail_part1` WHERE `SST_CODE` = '$part'") or die("ERROR" . mysqli_error());
while($rowselect2 = mysqli_fetch_array($select2)){
	$new_id = $rowselect2['ID'];
	$insert2 = mysqli_query($con,"INSERT INTO `data_total1` (`YEARS`, `PART_REF`, `LOT_SIZE`, `EST`, `MULTIPLY_MAX`,`MONTH`,`ISACTIVE`) VALUES ('$year', '$new_id', '$lotsize','$est', '$multiply_max','$month', '1')")or die("ERROR" . mysqli_error());
	//echo "SELECT * FROM `detail_part1` WHERE `SST_CODE` = '$part'";
}
}


?>
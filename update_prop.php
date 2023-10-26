<?php
	ob_start();
    session_start();
		include_once("condb.php"); //การดึงข้อมูลcondbมาใช้	
?>


<?php	
	 $select1=mysqli_query($con, "SELECT * FROM `detail_part1` WHERE 1 ") or die("ERROR" . mysqli_error()); 
while($rowselect1 = mysqli_fetch_array($select1)){
	$sst = $rowselect1['SST_CODE'];
	
	//echo $sst."<br>";
	//echo "SELECT * FROM `jobfg` WHERE `partfg_no`= '$sst'" ;

	 $select2=mysqli_query($con2, "SELECT * FROM `jobfg` WHERE `partfg_no` LIKE '$sst' and `jobFG_status` = '0'") or die("ERROR" . mysqli_error()); 
	 while($rowselect2 = mysqli_fetch_array($select2)){ 
	 $lot = $rowselect2['jobFG_no'];
	 $dayy = $rowselect2['dateplan'];
	 $targy = $rowselect2['qtyfg'];
	
	 
	 echo $lot."<br>" ;
	 
	 
	 $topping = 0 ;
	 $select3=mysqli_query($con, "SELECT * FROM `production_plan(erp)1` WHERE `JOB` = '$lot' ") or die("ERROR" . mysqli_error()); 
while($rowselect3 = mysqli_fetch_array($select3)){
	 $topping = 1 ;
	 }
	 if ($topping == 0){
		$insert=mysqli_query($con, "INSERT INTO `production_plan(erp)1` (`JOB`,`SST_CODE`,`DUE`,`TARGET`,`FG_status`) VALUES ('$lot','$sst','$dayy','$targy','0')")or die("ERROR" . mysqli_error());
		$insert1=mysqli_query($con3, "INSERT INTO `production_plan(erp)1` (`JOB`,`SST_CODE`,`DUE`,`TARGET`,`FG_status`) VALUES ('$lot','$sst','$dayy','$targy','0')")or die("ERROR" . mysqli_error());
		echo "INSERT INTO `production_plan(erp)1` (`JOB`,`SST_CODE`,`DUE`,`TARGET`,`FG_status`) VALUES ('$lot','$sst','$dayy','$targy','0')";
	 }else if($topping == 1){
		$update=mysqli_query($con, "UPDATE `production_plan(erp)1` SET `JOB`= '$lot',`SST_CODE`= '$sst',`DUE`= '$dayy',`TARGET`= '$targy',`FG_status`='0' WHERE `JOB` = '$lot'")or die("ERROR" . mysqli_error());
		$update1=mysqli_query($con3, "UPDATE `production_plan(erp)1` SET `JOB`= '$lot',`SST_CODE`= '$sst',`DUE`= '$dayy',`TARGET`= '$targy',`FG_status`='0' WHERE `JOB` = '$lot'")or die("ERROR" . mysqli_error());
		echo "UPDATE `production_plan(erp)1` SET `JOB`= '$lot',`SST_CODE`= '$sst',`DUE`= '$dayy',`TARGET`= '$targy',`FG_status`='0' WHERE `JOB` = '$lot'";
     }
     }
     }
	 



?> 


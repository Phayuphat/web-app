<?php
 ob_start();
    session_start();
  include_once("condb.php"); //การดึงข้อมูลcondbมาใช้
 /*$data1=mysqli_query($con, "SELECT * FROM clip a fg ORDER BY No ASC") or die("ERROR" . mysqli_error()); 
 while($rowdata1 = mysqli_fetch_array($data1)){
 echo ','.$rowdata1['No'].','.$rowdata1['Part Name'].','.$rowdata1['Target'].','.$rowdata1['Actual'].','.$rowdata1['Diff'].','.$rowdata1['Job'].','.$rowdata1['Status'];}*/


$jobno = $_POST['jobno'];
$mmachine = $_POST['machinee'];

//echo "UPDATE `jobfg` SET `jobFG_status` = '1' WHERE `jobFG_no` = '$jobno' ";
   $result = mysqli_query($con2, "UPDATE `jobfg` SET `jobFG_status` = '1' WHERE `jobFG_no` = '$jobno' ")or die("ERROR" . mysqli_error());
   $result2 = mysqli_query($con, "UPDATE `production_plan(erp)1` SET `FG_status` = '1' WHERE `JOB` = '$jobno' ");
   $result3 = mysqli_query($con3, "UPDATE `production_plan(erp)1` SET `FG_status` = '1' WHERE `JOB` = '$jobno' ");
   header("location: http://192.168.101.23/pp/page-allclip.php?MACHINE=$mmachine");
?>
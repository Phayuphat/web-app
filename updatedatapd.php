<?php
 ob_start();
    session_start();
  include_once("condb.php"); //การดึงข้อมูลcondbมาใช้
 /*$data1=mysqli_query($con, "SELECT * FROM clip a fg ORDER BY No ASC") or die("ERROR" . mysqli_error()); 
 while($rowdata1 = mysqli_fetch_array($data1)){
 echo ','.$rowdata1['No'].','.$rowdata1['Part Name'].','.$rowdata1['Target'].','.$rowdata1['Actual'].','.$rowdata1['Diff'].','.$rowdata1['Job'].','.$rowdata1['Status'];}*/


$job = $_GET['idjobtar'];
$MC = $_GET['MC'];

echo "UPDATE `production_plan(erp)1` SET `MACHINE` = '$MC' WHERE `JOB` = '$job' ";
$result = mysqli_query($con, "UPDATE `production_plan(erp)1` SET `MACHINE` = '$MC' WHERE `JOB` = '$job'");
$result1 = mysqli_query($con3, "UPDATE `production_plan(erp)1` SET `MACHINE` = '$MC' WHERE `JOB` = '$job'");
?>
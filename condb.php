<?php //ตัวเชื่อมต่อกับ database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "123456789";
$dbName = "webappclip";
$con = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName) or die(mysqli_error());
@mysqli_query($con,"SET NAMES UTF8"); //set time zone
@mysqli_select_db($con,$dbName) or die(mysqli_error());

$dbHost2 = "localhost";
$dbUser2 = "root";
$dbPass2 = "123456789";
$dbName2 = "storematsst";
$con2 = mysqli_connect($dbHost2,$dbUser2,$dbPass2,$dbName2) or die(mysqli_error());
@mysqli_query($con2,"SET NAMES UTF8"); //set time zone
@mysqli_select_db($con2,$dbName2) or die(mysqli_error());

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "123456789";
$dbName = "storematsst";
$conn1 = mysqli_connect($dbHost,$dbUser,$dbPass,$dbName) or die(mysqli_error());
@mysqli_query($conn1,"SET NAMES UTF8");
@mysqli_select_db($conn1,$dbName) or die(mysqli_error());

$dbHost3 = "212.80.213.211";
$dbUser3 = "rdscom_rds40";
$dbPass3 = "randdsst";
$dbName3 = "rdscom_rds40";
$con3 = mysqli_connect($dbHost3,$dbUser3,$dbPass3,$dbName3) or die(mysqli_error());
@mysqli_query($con3,"SET NAMES UTF8");
@mysqli_select_db($con3,$dbName3) or die(mysqli_error());

/*$dbHost2 = "localhost";
$dbUser2 = "root";
$dbPass2 = "123456789";
$dbName2 = "test";
$con2 = mysqli_connect($dbHost2,$dbUser2,$dbPass2,$dbName2) or die(mysqli_error());
@mysqli_query($con2,"SET NAMES UTF8");
@mysqli_select_db($con2,$dbName2) or die(mysqli_error());*/
?> 

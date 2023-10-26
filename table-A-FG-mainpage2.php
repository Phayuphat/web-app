<?php
	ob_start();
    session_start();
		include_once("condb.php"); //การดึงข้อมูลcondbมาใช้
		$ma = $_GET['machine'];
	/*$data1=mysqli_query($con, "SELECT * FROM `clip a fg` ORDER BY `No` ASC") or die("ERROR" . mysqli_error());	
	while($rowdata1 = mysqli_fetch_array($data1)){
	echo ','.$rowdata1['No'].','.$rowdata1['Part Name'].','.$rowdata1['Target'].','.$rowdata1['Actual'].','.$rowdata1['Diff'].','.$rowdata1['Job'].','.$rowdata1['Status'];}*/
?>

<!--หน้าตาราง-->

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/css-allclip-mainpage.css" media="screen" type="text/css">
</head>

<body>
<div class="row">
<div id='items'>
<table style="width:100%;">
<tr style = 'border:2px solid;'>
	<th>Due</th>
	<th>Job</th>
	<th>Part Name</th>
	<th>Target</th>
	<th>Mat'L</th>
	<th>PD</th>
	<th>FG</th>
	<th>Status</th>
</tr>

<?php
$i=1;
$data1=mysqli_query($con3, "SELECT * FROM `production_plan(erp)1` WHERE MACHINE = '$ma' and FG_status = '0'") or die("ERROR" . mysqli_error());	
while($rowdata1 = mysqli_fetch_array($data1)){
	$jojo=$rowdata1['JOB'];
	$ss=$rowdata1['SST_CODE'];
	$tata=$rowdata1['TARGET'];
	$mama=$rowdata1['MAT'];
	$pp=$rowdata1['PD'];
	$ff=$rowdata1['FG'];
	$status=$rowdata1['status'];

?>
<tr>
    <td><?=$rowdata1['DUE']?></td> 
	<td><a href="http://192.168.101.23/pp/outpdtofgdetail.php?jobno=<?=$jojo?>&partno=<?=$ss?>&qty=<?=$tata?>&jobforFG=1&location=clip&machine=<?=$ma?>"><?=$rowdata1['JOB']?> </a></td>
	<td><?=$rowdata1['SST_CODE']?> </td> 
	<td><?=$rowdata1['TARGET']?> </td>
	<td><?=$rowdata1['MAT']?> </td>
	<td><?=$rowdata1['PD']?> </td>
	<td><?=$rowdata1['FG']?> </td> 
	
<td><?=$rowdata1['status']?> </td>
<tr>

<?php
$i=$i+1;
}
?>
</table>
</div>
</div>
</body>

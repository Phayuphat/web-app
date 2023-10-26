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
$data1=mysqli_query($con, "SELECT * FROM `production_plan(erp)1` WHERE MACHINE = '$ma' and FG_status = '0'") or die("ERROR" . mysqli_error());	
while($rowdata1 = mysqli_fetch_array($data1)){
	$jojo=$rowdata1['JOB'];
	$ss=$rowdata1['SST_CODE'];
	$tata=$rowdata1['TARGET'];
	$mama=$rowdata1['MAT'];
	$pp=$rowdata1['PD'];
	$ff=$rowdata1['FG'];
	$status=$rowdata1['status'];
	$status1 = "";
	$status2 = "";
	$status3 = "";
	$status4 = "";
	$status5 = "";
	$status6 = "";
	$status7 = "";
	$status8 = "";
	$status9 = "";
	$status10 = "";
	$status11 = "";
	$status12 = "";
	$status13 = "";
	
	
	if($status == "กำลังผลิต"){
		$status1 = "selected";
	}else if($status == "BL"){
		$status2 = "selected";
	}else if($status == "PI"){
		$status3 = "selected";
	}else if($status == "U"){
		$status4 = "selected";	
	}else if($status == "K"){
		$status5 = "selected";	
	}else if($status == "TAP"){
		$status6 = "selected";		
	}else if($status == "รอเจียร"){
		$status7 = "selected";		
	}else if($status == "รอเชื่อม"){
		$status8 = "selected";		
	}else if($status == "CS"){
		$status9 = "selected";		
	}else if($status == "รอPack"){
		$status10 = "selected";		
	}else if($status == "ล้างโซเว้น"){
		$status11 = "selected";		
	}else if($status == "ล้างเกลียว"){
		$status12 = "selected";		
	}else if($status == "JobEnd"){
		$status13 = "selected";		
	}
	$pd = $tata - $ff ;
	
?>

<tr>
    <td><?=$rowdata1['DUE']?></td> 
	<td><a href="http://192.168.101.23/pp/outpdtofgdetail.php?jobno=<?=$jojo?>&partno=<?=$ss?>&qty=<?=$tata?>&jobforFG=1&location=clip&machine=<?=$ma?>"><?=$rowdata1['JOB']?> </a></td>
	<td><?=$rowdata1['SST_CODE']?> </td> 
	<td><?=$rowdata1['TARGET']?> </td>
	<td><?=$rowdata1['MAT']?> </td>
	<td> <?=$pd?> </td>
	<td><?=$rowdata1['FG']?> </td> 
	
<td>
<select id="status" name="users" onchange="showUser(this.value,'<?=$rowdata1['JOB']?>')">
  <option value="">-</option>
  <option value="กำลังผลิต" <?=$status1?>>กำลังผลิต</option>
  <option value="BL" <?=$status2?>>BL & PI</option>
  <option value="PI" <?=$status3?>>FO + PI</option>
  <option value="U" <?=$status4?>>U-BEN</option>
  <option value="K" <?=$status5?>>K-BEN</option>
  <option value="TAP" <?=$status6?>>TAP</option>
  <option value="รอเจียร" <?=$status7?>>รอเจียร</option>
  <option value="รอเชื่อม" <?=$status8?>>รอเชื่อม</option>
  <option value="CS" <?=$status9?>>C/S</option>
  <option value="รอPack" <?=$status10?>>รอ Pack</option>
  <option value="ล้างโซเว้น" <?=$status11?>>ล้างโซเว้น</option>
  <option value="ล้างเกลียว" <?=$status12?>>ล้างเกลียว</option>
  <option value="JobEnd" <?=$status13?>>Job End</option>
  
  </select>
  </td>
<tr>

<?php
$i=$i+1;
}
?>
</table>
</div>
</div>
</body>

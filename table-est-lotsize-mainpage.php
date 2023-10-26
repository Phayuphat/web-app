<?php
	ob_start();
    session_start();
		include_once("condb.php"); //การดึงข้อมูลcondbมาใช้
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
<link rel="stylesheet" href="css/css-est.css" media="screen" type="text/css">
</head>

<body>
<div class="row">
<div id='items'>
<center><table style="width:100%;"></center>
<tr style = 'border:2px solid;'>
	<th style=" width: 5%;">No.</th>
	<th style=" width: 15%;">SST CODE</th>
	<th style=" width: 18%;">PART CLIP</th>
	<th style=" width: 10%;">PACK</th>
	<th style=" width: 15%;">LOT SIZE</th>
	<th>EST</th>
	<th style=" width: 15%;">MAX</th>
	<th style=" width: 10%;">MIN</th>
</tr>

<?php

	$year = $_GET['year'];
	$month = $_GET['month'];

if($month != undefined){
$i=1;

$select1=mysqli_query($con, "SELECT * FROM `detail_part1` WHERE 1") or die("ERROR" . mysqli_error());	
while($rowselect1 = mysqli_fetch_array($select1)){
		$est = "";
		$id = $rowselect1['ID'];
		$sst_code = $rowselect1['SST_CODE'];
		//echo $id;
//echo "SELECT * FROM `data_total1` WHERE `PART_REF` = '$id' AND `ISACTIVE` = '1' AND `YEARS` = '$year' AND `MONTH` = '$month'";
	$select2=mysqli_query($con, "SELECT * FROM `data_total1` WHERE `PART_REF` = '$id' AND `ISACTIVE` = '1' AND `YEARS` = '$year' AND `MONTH` = '$month'") or die("ERROR" . mysqli_error());	
	while($rowselect2 = mysqli_fetch_array($select2)){
		$est = $rowselect2['EST'];
		$lotsize = $rowselect2['LOT_SIZE'];
		$multiply_max = $rowselect2['MULTIPLY_MAX'];
		$month1 = $rowselect2['MONTH'];
	}
	//echo $month1;
	
	if($month1){
		//echo $i;
		$max = $multiply_max*$lotsize
?>
	<tr>
		<form action='updatetodatabase-est.php' method='get'>
		<div id = 'result'></div>
		<td><?=$i;?></td>
		<td><?=$rowselect1['SST_CODE']?></td> 
		<td><?=$rowselect1['PART_CLIP']?> </td>
		<td><?=$rowselect1['PACK']?> </td>
		<td><input id="<?=$rowselect1['SST_CODE']?>lotvalue" value="<?=$lotsize?>" type="text" style="font-size: 100%; width: 40%; text-align: center;" onchange="savelot('<?=$rowselect1['SST_CODE']?>','<?=$lotsize?>')"></td>
		<td><input id="<?=$rowselect1['SST_CODE']?>estvalue" value="<?=$est?>" type="text" style="font-size: 100%; width: 40%; text-align: center;" onchange="saveest('<?=$rowselect1['SST_CODE']?>','<?=$est?>')"></td>
		<td><div style='margin-right:15%; text-align:center;'>
			<!--<input id="<?//=$rowselect1['SST_CODE']?>maxvalue" value="<?//=$multiply_max?>" type="text" style="font-size: 100%; width: 10%; text-align: center; " onchange="savemax('<?//=$rowselect1['SST_CODE']?>','<?//=$multiply_max?>')">&nbsp;&nbsp;&nbsp;&nbsp;<?//=$max?></div></td>-->
			<input id="<?=$rowselect1['SST_CODE']?>maxvalue" value="<?=$multiply_max?>" type="text" style="font-size: 100%; width: 10%; text-align: center; " onchange="savemax('<?=$rowselect1['SST_CODE']?>','<?=$multiply_max?>')">&nbsp;&nbsp;&nbsp;&nbsp;<span id="<?=$rowselect1['SST_CODE']?>max"><?=$max?></span></div></td>
		<td><?=$rowselect1['MIN']?> </td>
<?php
	$i=$i+1;
	}else{
		$est1 = '0';
		$lotsize1 = '0';
		$multiply_max1 = '0';
	//echo "INSERT INTO `data_total1` (`YEARS`,`PART_REF`,`LOT_SIZE`,`EST`,`MULTIPLY_MAX`,`MONTH`,`ISACTIVE`) VALUES ('$year1','$id','0','0','0','$month1','1')";
		$select3 = mysqli_query($con, "SELECT * FROM `detail_part1` WHERE `ID`= '$id'") or die("ERROR" . mysqli_error());
			while($rowselect3 = mysqli_fetch_array($select3)){
			$est1 = $rowselect3['EST_CURRENT'];
			$lotsize1 = $rowselect3['LOT_SIZE'];
			$multiply_max1 = $rowselect3['MULTIPLY_MAX'];
		}
		$insert1 = mysqli_query($con,"INSERT INTO `data_total1` (`YEARS`,`PART_REF`,`LOT_SIZE`,`EST`,`MULTIPLY_MAX`,`MONTH`,`ISACTIVE`) VALUES ('$year','$id','$lotsize1','$est1','$multiply_max1','$month','1')")or die("ERROR" . mysqli_error());
		$max1 = $multiply_max1*$lotsize1
?>
	<tr>
		<form action='updatetodatabase-est.php' method='get'>
		<div id = 'result'></div>
		<td><?=$i;?></td>
		<td><?=$rowselect1['SST_CODE']?></td> 
		<td><?=$rowselect1['PART_CLIP']?> </td>
		<td><?=$rowselect1['PACK']?> </td>
		<td><input id="<?=$rowselect1['SST_CODE']?>lotvalue" value="<?=$lotsize1?>" type="text" style="font-size: 100%; width: 40%; text-align: center;" onchange="savelot('<?=$rowselect1['SST_CODE']?>','<?=$lotsize?>')"></td>
		<td><input id="<?=$rowselect1['SST_CODE']?>estvalue" value="<?=$est1?>" type="text" style="font-size: 100%; width: 40%; text-align: center;" onchange="saveest('<?=$rowselect1['SST_CODE']?>','<?=$est?>')"></td>
		<td><div style='margin-right:15%; text-align:center;'>
			<input id="<?=$rowselect1['SST_CODE']?>maxvalue" value="<?=$multiply_max1?>" type="text" style="font-size: 100%; width: 10%; text-align: center; " onchange="savemax('<?=$rowselect1['SST_CODE']?>','<?=$multiply_max?>')">&nbsp;&nbsp;&nbsp;&nbsp;<span id="<?=$rowselect1['SST_CODE']?>max"><?=$max1?></span></div></td>
		<td><?=$rowselect1['MIN']?> </td>
		<?php
	$i=$i+1;
	}
}
}
?>

</form></tr>
</table>
</div>
</div>
</body>
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
<link rel="stylesheet" href="css/style-stock-WIP-mainpage.css" media="screen" type="text/css">
</head>

<body>
<div class="row">
<div id='items'>
<table style="width:100%;">
<tr style = 'border:2px solid;'>
	<th style=" width: 5%;">No.</th> 
	<th style=" width: 15%;">SST.CODE</th>
	<th>Part 1</th>
	<th>Part 2</th>
	<th>Part 3</th>
	<th>Part 4</th>

</tr>
<?php
//SELECT * FROM `stock_wip1` LEFT JOIN`detail_part1` ON `stock_wip1`.PART_REF =`detail_part1`.ID
$i=0;
$default = "";
$select1=mysqli_query($con, "SELECT * FROM `detail_part1` LEFT JOIN`stock_wip1` ON `stock_wip1`.PART_REF =`detail_part1`.ID WHERE `Type` = 'F/G' ") or die("ERROR" . mysqli_error());	
while($rowselect1 = mysqli_fetch_array($select1)){
	$SST_CODE = "";
	if($default != $rowselect1['SST_CODE']){
	$default = $rowselect1['SST_CODE'];
	$i=$i+1;
?>
<tr>
	<td><?=$i;?> </td>
	<td><?=$rowselect1['SST_CODE']?></td>

<?php
	}
?>	

<td>
<?php if (!empty($rowselect1['SEMI_1'])):?>
		<?=$rowselect1['SEMI_1']?><br>
		<input type="text" value="<?=$rowselect1['QTY_1']?>" style="font-size: 100%; width: 50%; text-align: center;" readonly>
		<?php endif;?>
</td><td>
<?php if (!empty($rowselect1['SEMI_2'])):?>
		<?=$rowselect1['SEMI_2']?><br>
		<input type="text" value="<?=$rowselect1['QTY_2']?>" style="font-size: 100%; width: 50%; text-align: center;" readonly>
		<?php endif;?>
</td><td>
<?php if (!empty($rowselect1['SEMI_3'])):?>
		<?=$rowselect1['SEMI_3']?><br>
		<input type="text" value="<?=$rowselect1['QTY_3']?>" style="font-size: 100%; width: 50%; text-align: center;" readonly>
		<?php endif;?>
</td><td>
<?php if (!empty($rowselect1['SEMI_4'])):?>
		<?=$rowselect1['SEMI_4']?><br>
		<input type="text" value="<?=$rowselect1['QTY_4']?>" style="font-size: 100%; width: 50%; text-align: center;" readonly>
		<?php endif;?>
</td>

	
<?php
	}	
?>
</tr>
</table>
</div>
</div>
</body>
</html>
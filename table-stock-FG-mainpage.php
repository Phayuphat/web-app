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
<link rel="stylesheet" href="css/style-stock-FG-mainpage.css" media="screen" type="text/css">
</head>

<body>
<div class="row">
<div id='items'>
<table style="width:100%;">
<tr style = 'border:2px solid;'>
	<th>No.</th>
	<th>SST.CODE</th>
	<th>PART CLIP</th>
	<th>PACK</th>
	<th>LOT SIZE</th>
	<th>EST CURRENT</th> <!--START MONTH-->
	<th>MAX</th>
	<th>MIN</th>
	<th>STOCK F/G</th>
	<th style=" width: 5%;">ยอดจอง</th>
	<th>EST NEXT</th> <!--FINAL MONTH-->
	<th>ต้องสั่งผลิตเพิ่ม</th>
	<th>JUDMENT</th>
	
</tr>
<?php
$i=1;
$select1=mysqli_query($con, "SELECT * FROM `detail_part1` WHERE `Type` = 'F/G' ") or die("ERROR" . mysqli_error());	
while($rowselect1 = mysqli_fetch_array($select1)){
		$stock_fg = "";
		$stock_fg1 = "";
		$sale = "";
		$product = "";
		$id = $rowselect1['ID'];
		$sst_code = $rowselect1['SST_CODE'];
		$min = $rowselect1['MIN'];

	//echo "SELECT * FROM `stock_fg1` WHERE `PART_REF` = '$id' AND `ISACTIVE` = '1'";	
	$select2=mysqli_query($con, "SELECT * FROM `stock_fg1` WHERE `PART_REF` = '$id' AND `ISACTIVE` = '1'") or die("ERROR" . mysqli_error());	
	while($rowselect2 = mysqli_fetch_array($select2)){
		$stock_fg = $rowselect2['STOCK_FG'];
		$stock_fg1 = $rowselect2['STOCK_FG1'];
		$sale = $rowselect2['SALE'];
		$product1 = $rowselect2['ต้องผลิตเพิ่ม'];
	//echo $stock_fg.$stock_fg1.$sale.$product;
	
	
?>
<tr>
	<td><?=$i;?> </td>
	<td><?=$rowselect1['SST_CODE']?> </td> 
	<td><?=$rowselect1['PART_CLIP']?> </td>
	<td><?=$rowselect1['PACK']?> </td>
	<td><?=$rowselect1['LOT_SIZE']?> </td>
	<td><?=$rowselect1['EST_CURRENT']?> </td>
	<td><?=$rowselect1['MAX']?> </td>
	<td ><input id="<?=$rowselect1['SST_CODE']?>min" value="<?=$min?>" hidden/><?=$min?></td>
	<td id="<?=$rowselect1['SST_CODE']?>stock_fg2"><?=$stock_fg?></td> <!--ต้องใส่ตัวแปรที่คำนวณ--><input id="<?=$rowselect1['SST_CODE']?>stock_fg" value="<?=$stock_fg?>" hidden/>
	<td><?=$rowselect2['SALE']?></td>
	<td><?=$rowselect1['EST_NEXT']?> </td>
	<td id="<?=$rowselect1['SST_CODE']?>product"><?=$product1?> </td> <!--ต้องใส่ตัวแปรที่คำนวณ-->
	<td id="<?=$rowselect1['SST_CODE']?>judment"><?php if ($product1<0){echo "สั่งผลิต";}?></td>
	
<tr>

<?php
$i=$i+1;
}
}
?>
</table>
</div>
</div>
</body>

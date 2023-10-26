<?php
	include_once("condb.php");
	    ob_start();
    session_start();
	date_default_timezone_set("Asia/Bangkok");
	define('LINE_API',"https://notify-api.line.me/api/notify"); 
/*$token = "OrXgvalFFw1e5UfXOwFgbYJQcrNwMY3v2KBgwlN92PK";
$token1 = "nkVuMyRJuCeXOilKT6pe9zAyXSmk8bmbEMUYspwzF5F"; //ใส่Token ที่copy เอาไว้
$token2 = "y9JKVc9l586BUas28M9e1CvO6HdPxRraJa2dkEcg8cO";
$INPD = "SuHMVrvUfSGbag7rsNiIClrdtlcDjWd4Bc50w7brEYJ";
$INPDFG = "BSh72An1CgUpZcGWFbzIsRE3IPwXwiCitKQ9T10MHgv";
//$res = notify_message("test",$token);
function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}*/
//$str = $text; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
$action=$_GET['action'];
$datetimenow11=	date("Y-m-d H:i:s");
if($action=="jobfgin"){
	
	$location = $_GET['location'];
	$semi=$_GET['semi'];
	$outperbox=$_POST['outperbox'];
	$inpd=$_POST['inpd'];
	$jobno=$_POST['jobno'];
	$partno=$_POST['partno'];
	
	$total=$_POST['total'];
	$jobqty=$_POST['jobqty'];
	$allqty=$_POST['allqty'];
	
	$ngallqty=$_POST['ngallqty'];
	$jobforFG=$_POST['jobforFG'];
	$typesub=$_POST['typesub'];
	$machinee=$_POST['machinee'];
	
	
	$qtyin = 0;
	$addplanout=mysqli_query($conn1,"SELECT * FROM `job_out` WHERE job_id = '$jobno' ORDER BY time desc LIMIT 1") or die (mysql_error());
	while($lanout = mysqli_fetch_array($addplanout)){
		$qtyin=$lanout['allqty'];
			
	}
	
	//echo "1";
	$inpd = $qtyin - $allqty;
	
	
	
	
	
	if($inpd<0){//แจ้งเตือน
		//$outperbox = "0";
		//$res1 = notify_message("มีการรับ FG ขณะยังไม่เบิก MAT INPD = 0 ที่ JOB ".$jobno."PART ".$partno,$INPDFG);
		//$res = notify_message("มีการรับ FG ขณะยังไม่เบิก MAT INPD = ".$inpd."ที่ JOB ".$jobno."PART ".$partno,$INPD);
	}
	echo $_SESSION["indone"]; 
	//if($_SESSION["indone"] != "1"){
	if(1){
	$total=$total-$outperbox;
	
	
	$outperboxng = $_POST['outclose'];
	$total=$total-$outperboxng;
	$inpd = $inpd - $outperboxng;
	$allqty=$allqty+$outperbox;
	$ngallqty = $outperboxng + $ngallqty;
	$Operation ="";

		
	$select1=mysqli_query($con,"SELECT * FROM `detail_part1` WHERE SST_CODE = '$partno'") or die (mysql_error());
	while($rowselect1 = mysqli_fetch_array($select1)){
		$id = $rowselect1['ID'];
		$min = $rowselect1['MIN'];
	}
	
	$uppolimit=mysqli_query($conn1,"INSERT INTO `jobfg_out`(`jobfg_id`, `jobfg_no`, `partfg_no`, `qtyin`, `qtyout`, `sumqtyout`, `total`, `jobfg_stattus`,	NG_qty,NG_qtysum) VALUES ('','$jobno','$partno','$qtyin','$outperbox','$allqty','$total','0','$outperboxng','$ngallqty')") or die(mysql_error());
	$datatasks = $jobno.",".$outperbox.","."0".",".$Operation;
	
	$selectitem = mysqli_query($con,"SELECT * FROM `stock_fg1` WHERE `PART_REF` = '$id' AND `ISACTIVE` = '1'") or die (mysql_error());
	while($rowselectitem = mysqli_fetch_array($selectitem)){
		$stockfg = $rowselectitem['STOCK_FG'];
		$stockfg1 = $rowselectitem['STOCK_FG1'];
		$sale = $rowselectitem['SALE'];
	}
	echo $storefg."1";
		$storefg = $stockfg+$outperbox-$sale ;
		$diff = $storefg-$min ;
	$update1 = mysqli_query($con,"UPDATE `stock_fg1` SET `ISACTIVE` = '0'  WHERE `PART_REF` = '$id'")or die("ERROR" . mysqli_error());
	$insert1 = mysqli_query($con,"INSERT INTO `stock_fg1` (`PART_REF`,`STOCK_FG`,`STOCK_FG1`,`SALE`,`ต้องผลิตเพิ่ม` ,`ISACTIVE`) VALUES ('$id','$storefg','$stockfg1','$sale','$diff','1')") or die("ERROR" . mysqli_error());
	$update2 = mysqli_query($con,"UPDATE `production_plan(erp)1` SET `FG` = '$allqty'  WHERE `SST_CODE` = '$partno' AND `JOB` = '$jobno' ")or die("ERROR" . mysqli_error());
	$update3 = mysqli_query($con3,"UPDATE `production_plan(erp)1` SET `FG` = '$allqty'  WHERE `SST_CODE` = '$partno' AND `JOB` = '$jobno'")or die("ERROR" . mysqli_error());
	$_SESSION["indone"] = "1";
	if($jobstatus == 1){
		
		//task3
		//$datatask = $jobno.",".$allqty;
		//$task=mysqli_query($conn,"INSERT INTO `Robot_task`(`work_id`, `task_data`) VALUES ('3','$datatask')") or die(mysql_error());
		//$upstatus=mysqli_query($conn1,"UPDATE jobfg SET jobFG_status='$jobstatus',enddate='$datetimenow11' WHERE jobFG_no='$jobno'") or die(mysql_error());
	}
	}else{
		
	}
	//}
	if($semi==1){
		header("location: outpdtostorematdetail.php?jobno=$jobno&partno=$partno&qty=$jobqty&jobforFG=$jobforFG&location=$location&machine=$machinee#out");
	}else{
		header("location: outpdtofgdetail.php?jobno=$jobno&partno=$partno&qty=$jobqty&jobforFG=$jobforFG&location=$location&machine=$machinee#out");
	}
	
}else if($action=="joboutclose"){
	echo "in test";
	$location = $_GET['location'];
	$semi = $_GET['semi'];	
		$outclose=$_POST['outclose'];	
		$ngallqty=$_POST['ngallqty'];
		$qcallqty=$_POST['qcallqtys'];
	$inpd=$_POST['inpd'];
	$jobno=$_POST['jobno'];
	$partno=$_POST['partno'];
	$total=$_POST['total'];
	
	$jobqty=$_POST['jobqty'];
	$allqty=$_POST['allqty'];
	$jobforFG=$_POST['jobforFG'];
	$addplanout=mysqli_query($conn1,"SELECT * FROM `job_out` WHERE job_id = '$jobno' ORDER BY time desc LIMIT 1") or die (mysql_error());
	while($lanout = mysqli_fetch_array($addplanout)){
		$qtyin=$lanout['allqty'];
	}
	$inpd = $qtyin - $ngallqty;
	echo "in test1";
	if($total>=$outclose){
		
	}else{
		$outclose=$total;
	}
	if($inpd<0){//แจ้งเตือน
		//$outclose = "0";
		//$res1 = notify_message("ปิด JOB FG ขณะยังไม่เบิก MAT INPD = 0 ที่ JOB ".$jobno."PART ".$partno,$INPDFG);
		//$res = notify_message("ปิด JOB FG ขณะยังไม่เบิก MAT INPD = ".$inpd."ที่ JOB ".$jobno."PART ".$partno,$INPD);
	}
	echo "in test1.1";
	if($total>0){
	$total=$total-$outclose;
	
	$ngallqty=$ngallqty+$outclose;

	if($total>0){
		$jobstatus = 0;
	}else{
		$jobstatus = 1;
	}
	/*$addplanout=mysqli_query($conn1,"SELECT `Operation` FROM `fg_store` WHERE `FG_num` = '$partno'") or die (mysql_error());
	while($lanout = mysqli_fetch_array($addplanout)){
		$Operation=$lanout['Operation'];
	}
	if($Operation ==""){
		$addplanout=mysqli_query($conn1,"SELECT `Operation` FROM `store` WHERE `partnum` = '$partno'") or die (mysql_error());
		while($lanout = mysqli_fetch_array($addplanout)){
			$Operation=$lanout['Operation'];
		}
	}*/
	echo "in test 2";
	$uppolimit=mysqli_query($conn1,"INSERT INTO `jobfg_out`(`jobfg_id`, `jobfg_no`, `partfg_no`, `qtyin`, `qtyout`, `sumqtyout`, `total`, `jobfg_stattus`, `QC_qty`, `QC_qtysum`, `NG_qty`, `NG_qtysum`) VALUES ('','$jobno','$partno','$qtyin','$outperbox','$allqty','$total','$jobstatus','0','0','$outclose','$ngallqty')") or die(mysql_error());
	//$datatasks = $jobno.","."0".",".$outclose.",".$Operation;
	//$task=mysqli_query($conn,"INSERT INTO `Robot_task`(`work_id`, `task_data`) VALUES ('2','$datatasks')") or die(mysql_error());

	//echo $outperbox;
	if($jobforFG=="0"){
		//$uppolimit1=mysqli_query($conn1,"UPDATE fg_store SET instore=instore+'$outperbox' WHERE FG_num='$partno'") or die(mysql_error());
	}else{
		//$uppolimit1=mysqli_query($conn1,"UPDATE store SET instore=instore+'$outperbox' WHERE partnum='$partno'") or die(mysql_error());
	}
	if($jobstatus == 1){
		//task3
		//$datatask = $jobno.",".$allqty;
		//$task=mysqli_query($conn,"INSERT INTO `Robot_task`(`work_id`, `task_data`) VALUES ('3','$datatask')") or die(mysql_error());
		$upstatus=mysqli_query($conn1,"UPDATE jobfg SET jobFG_status='$jobstatus',enddate='$datetimenow11' WHERE jobFG_no='$jobno'") or die(mysql_error());
	}
	}else{
		echo "in test1.2";
	}
	echo "test";
	header("location: outpdtofgdetail.php?jobno=$jobno&partno=$partno&qty=$jobqty&jobforFG=$jobforFG&location=$location#out");
}


?>


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
$res = notify_message("test",$token);
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
	s
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
	
	$qtyin = 0;
	$addplanout=mysqli_query($conn1,"SELECT * FROM `job_out` WHERE job_id = '$jobno' ORDER BY time desc LIMIT 1") or die (mysql_error());
	while($lanout = mysqli_fetch_array($addplanout)){
		$qtyin=$lanout['allqty'];
	}
	//echo "1";
	$inpd = $qtyin - $allqty;
	
	if($total>=$outperbox){
		
	}else{
		$outperbox=$total;
	}
	if($inpd<0){//แจ้งเตือน
		//$outperbox = "0";
		//$res1 = notify_message("มีการรับ FG ขณะยังไม่เบิก MAT INPD = 0 ที่ JOB ".$jobno."PART ".$partno,$INPDFG);
		$res = notify_message("มีการรับ FG ขณะยังไม่เบิก MAT INPD = ".$inpd."ที่ JOB ".$jobno."PART ".$partno,$INPD);
	}
	
	if($_SESSION["indone"] != "1"){
	if($total>0){
	$total=$total-$outperbox;
	
	
	$outperboxng = 0;
	if($total>0){
		$jobstatus = 0;
	}else{
		$jobstatus = 1;
		if($partno!="SN637"){
			if(($outperbox%2)!=0){//check to 1 ng
				$outperbox = $outperbox-1;
				$outperboxng = 1;
			}
		}else{
			if(($outperbox%5)!=0){//check to 1 ng
				$outperbox = $outperbox-1;
				$outperboxng = 1;
			}
		}
		
	}
	$allqty=$allqty+$outperbox;
	$ngallqty = $outperboxng + $ngallqty;
	$Operation ="";

	$uppolimit=mysqli_query($conn1,"INSERT INTO `jobfg_out`(`jobfg_id`, `jobfg_no`, `partfg_no`, `qtyin`, `qtyout`, `sumqtyout`, `total`, `jobfg_stattus`,	NG_qty,NG_qtysum) VALUES ('','$jobno','$partno','$qtyin','$outperbox','$allqty','$total','0','$outperboxng','$ngallqty')") or die(mysql_error());
	$datatasks = $jobno.",".$outperbox.","."0".",".$Operation;

	$_SESSION["indone"] = "1";
	if($jobstatus == 1){
		
		//task3
		//$datatask = $jobno.",".$allqty;
		//$task=mysqli_query($conn,"INSERT INTO `Robot_task`(`work_id`, `task_data`) VALUES ('3','$datatask')") or die(mysql_error());
		$upstatus=mysqli_query($conn1,"UPDATE jobfg SET jobFG_status='$jobstatus',enddate='$datetimenow11' WHERE jobFG_no='$jobno'") or die(mysql_error());
	}
	}else{
		
	}
	}
	if($semi==1){
		header("location: outpdtostorematdetail.php?jobno=$jobno&partno=$partno&qty=$jobqty&jobforFG=$jobforFG&location=$location#out");
	}else{
		header("location: outpdtofgdetail.php?jobno=$jobno&partno=$partno&qty=$jobqty&jobforFG=$jobforFG&location=$location#out");
	}
	
}



?>


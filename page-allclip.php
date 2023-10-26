<!--หน้าฟอร์มเว็บไซต์-->
<!DOCTYPE html>
<?php
$MA = $_GET['MACHINE'];
		$TEST = $_GET['TEST'];
		//echo $MA;
		$machinename = "";
		if($MA == "1" ){
			$machinename = "CLIP A F/G";			
		}else if($MA == "2"){
			$machinename = "CLIP B F/G";
		}
		else if($MA == "3"){
			$machinename = "CLIP A WIP";			
		}
		else if($MA == "4"){
			$machinename = "CLIP B WIP";
		}	
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	   <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?=$machinename?></title> <!--สร้างชื่อtabเว็บ-->
	<link rel="stylesheet" href="css/css-allclip-mainpage.css" media="screen" type="text/css"> <!--ดึงcss styleมาใข้-->
	<link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
</head>

<body onload="update()">
<div class="card p-3">
<div class="col-md-12 ">
	<div class="row">
		<div class="card-header  col-md-4 ">
		</div>
		<div class="card-header col-md-5 pt-3  text-center ">
			<div class="topic">
			<h1 class="p-3"><B><?php echo $machinename;?></B></h1>
			</div>
		</div>
		
	<div class="card-header col-md-3 pt-3 ">
		<div class="row">
		<div class=" col-sm-12-12 p-1">
            <h6><B>Date : <font id="date_now"></font></B></h6> 
			<h6><B>Time : <font id="time_now"></font></B></h6>
		</div>
		<div class="row">
			<div class=" col-sm-6 mt-2 text-center ">
			<button type="button" class="btn btn-outline" style="background:#003333; color:white; height:40px; width:100%;" onclick="window.location.replace('http://192.168.101.23/pp/mainpage.php')"><center><p class="fs-6">Home Page</p></center></button>
			</div>
			<div class=" col-sm-6 mt-2 text-center">
			<button type="button" class="btn btn-outline" style="background:#003333; color:white; height:40px; width:100%;" onclick="location.reload()"><p class="fs-6">Refresh<p></button>
			</div>
		</div>
		</div>	
	</div>
	</div>
</div>



	<div class="col-md-12">
	<div class="row">
	<div class="card col-md-12 pt-4">
	<center><div style="width:95%;"><div id="datatable"></div></div></center>
	</div>
	</div>
</div>
</div>


<!--วันที่เวลา-->
	<script>
	var ma = '<?php echo $MA;?>'
		function showClockRealTime() {
        var d = new Date();
		if(d.getDate()<10){
			date = '0'+d.getDate();
		}
		else{
			date = d.getDate();
		}
		
		if((d.getMonth()+1)<10){
			Month = '0'+(d.getMonth()+1);
		}
		else{
			Month = (d.getMonth()+1);
		}
		
		if(d.getHours()<10){
			Hours = '0'+d.getHours();
		}
		else{
			Hours = d.getHours();
		}
		
		if(d.getMinutes()<10){
			Minutes = '0'+d.getMinutes();
		}
		else{
			Minutes = d.getMinutes();
		}
		
		if(d.getSeconds()<10){
			Seconds = '0'+d.getSeconds();
		}
		else{
			Seconds = d.getSeconds();
		}
		
		document.getElementById("date_now").innerHTML = date+"-"+Month+"-"+d.getFullYear();
        document.getElementById("time_now").innerHTML = Hours+":"+Minutes+":"+Seconds;
		}
		setInterval("showClockRealTime()", 1000);
		

	function update() {
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("datatable").innerHTML = this.responseText;
				}
        };
		xmlhttp33.open("GET", "table-A-FG-mainpage.php?machine="+ma, true);
		 xmlhttp33.send();
		 
}

 

function showUser(SU,JOB) {
	//window.alert("updatedatapd(status).php?status="+SU+"&job="+JOB);
		var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

				}
        };
		xmlhttp33.open("GET", "updatedatapd(status).php?status="+SU+"&job="+JOB, true);
		 xmlhttp33.send();
		 
}

	</script>

</html>








<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MainPage</title> <!--สร้างชื่อtabเว็บ-->
	<link rel="stylesheet" href="css/css-mainpage.css" media="screen" type="text/css">
	<link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
</head>
<body>
<div class="card p-3 " style="background-color:;">
<div class="col-md-12">
	<div class="row">
		<div class="card-header col-md-4">
		</div>
		<div class="card-header col-md-4 text-center">
			<div class="Mainpage pt-2">
			<B><h1>Line Clip A & B</h1></B>
			</div>
			</div>
		<div class="card-header col-md-2 ">
		</div>
		<div class="card-header col-md-2">
            <h6><B>Date : <font id="date_now"></font></B></h6> 
			<h6><B>Time : <font id="time_now"></font></B></h6>
		</div>
	</div>	
	</div>
<div class="col-md-12 p-4">
<div class="row">
	<div class="col-md-6">
			<div class="row">
			<div class=" col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button" class="button1"onclick="window.location.replace('http://192.168.101.23/pp/page-product.php')"><B><p class="fs-1 pt-2">
				PRODUCTION PLAN</p></B></button>
				</div>
			</div>
			<div class="col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button" class="button3 " onclick="window.location.replace('http://192.168.101.23/pp/page-allclip.php?MACHINE=1')"><B><p class="fs-1 pt-2">
				CLIP A F/G</p></B></button>
				</div>
			</div>
			<div class="col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button" class="button5" onclick="window.location.replace('http://192.168.101.23/pp/page-allclip.php?MACHINE=3')"><B><p class="fs-1 pt-2">
				CLIP A WIP</p></B></button>
				</div>
			</div>
			<div class="col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button" class="button7" onclick="window.location.replace('http://192.168.101.23/pp/page-stock-FG-mainpage.php')"><B><p class="fs-1 pt-2">
				STOCK F/G</p></B></button>
				</div>
			</div>
		</div>
		</div>
			<div class="col-md-6">
			<div class="row">
			<div class="col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button"  class="button2 " onclick="window.location.replace('http://192.168.101.23/pp/page-est.php')"><B><p class="fs-1 pt-2">
				EST/LOT SIZE</p></B></button>
				</div>
			</div>
			<div class="col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button" class="button4 " onclick="window.location.replace('http://192.168.101.23/pp/page-allclip.php?MACHINE=2')"><B><p class="fs-1 pt-2">
				CLIP B F/G</p></B></button>
				</div>
			</div>
			<div class="col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button" class="button6 " onclick="window.location.replace('http://192.168.101.23/pp/page-allclip.php?MACHINE=4')"><B><p class="fs-1 pt-2">
				CLIP B WIP</p></B></button>
				</div>
			</div>
			<div class="col-md-12 mt-2">
				<div class="card-body text-center">
				<button type="button" class="button8 " onclick="window.location.replace('http://192.168.101.23/pp/page-stock-WIP-mainpage.php')"><B><p class="fs-1 pt-2">
				STOCK WIP</p></B></button>
				</div>
			</div>
		</div>
		</div>
		</div>
</div>
</div>


<script>
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
		
		
	/*function update() {
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("JobB").innerHTML = this.responseText;
				}
        };
		xmlhttp33.open("GET", "CLIP-A-FG1.php", true);
		 xmlhttp33.send();
		 i++;
}*/

	</script>
</body>
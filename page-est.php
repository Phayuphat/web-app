<!--หน้าฟอร์มเว็บไซต์-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	   <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>EST/LOT SIZE</title> <!--สร้างชื่อtabเว็บ-->
	<link rel="stylesheet" href="css/css-est.css" media="screen" type="text/css"> <!--ดึงcss styleมาใข้-->
	<link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
</head>
<div class="card p-3">
<div class="col-md-12 ">
	<div class="row">
		<div class="card-header  col-md-4 ">
		</div>
		<div class="card-header col-md-5 pt-3  text-center " >
		<div class="topic">
			<h1 class="p-2 pt-3">EST/LOT SIZE</h1>
			</div>
			</div>
		
	<div class="card-header col-md-3 pt-3 ">
		<div class="row">
		<div class=" col-md-12 p-1">
            <h6><B>Date : <font id="date_now"></font></B></h6> 
			<h6><B>Time : <font id="time_now"></font></B></h6>
		</div>
		<div class="row">
		<div class=" col-md-6 mt-2 text-center ">
		<button type="button" class="btn btn-outline" style="background:#003333; color:white; height:40px; width:100%;" onclick="window.location.replace('http://192.168.101.23/pp/mainpage.php')"><center><p class="fs-6">Home Page</p></center></button>
		</div>
		<div class=" col-md-6 mt-2 text-center">
		<button type="button" class="btn btn-outline" style="background:#003333; color:white; height:40px; width:100%;" onclick="location.reload()"><p class="fs-6">Refresh<p></button>
		</div>
		</div>
		</div>	
		</div>
	</div>
</div>

	<div class="col-md-12 p-1 ">
	<div class="row">
		<div class="col-md-12 text-center">
			<div class='year p-2'><p class="fs-4"><B>เลือก  </B></p><input type="month" id="month" name="month" min="2018-01" value="<?php date("Y/m") ?>" style='font-size:100%; width:45%;'>
		<input id="year" name="year" type="submit" value="ค้นหา" onclick="update()" style='margin-left:5%; height:30px; font-size: 65%;'></form>
			</div>
			</div>
			</div>
		</div>
	
	<div class="col-md-12 p-3 pt-1">
	<div class="row">
	<div class="col-md-12 p-2 text-center">
	<div class='row1'>
		<center><div style="width:100%;"><div id="JobB"></div></div></center>
		<!--<button class='button_save'onclick="save()"><B>SAVE</B></button>-->
		</div>
		</div>
	</div>
	</div>
</div>
	
<!--วันที่เวลา-->
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
		
		
function update() {
	var month = document.getElementById("month").value
	var year = "";
	var n = month.split("-");
	var year = n[0];
	var month = n[1];
		//window.alert("table-est-lotsize-mainpage.php?year="+year+"&month="+month);
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("JobB").innerHTML = this.responseText;
				}
			//else{undefined}
        };
		xmlhttp33.open("GET", "table-est-lotsize-mainpage.php?year="+year+"&month="+month,true);
		xmlhttp33.send();
}

function saveest(n,m) {
	var month = document.getElementById("month").value;
	var l = document.getElementById(n+"lotvalue").value;
	var v = document.getElementById(n+"maxvalue").value;
	var e = document.getElementById(n+"estvalue").value;
	var k = month.split("-");
	var year = k[0];
	var month = k[1];
	var data1 = ("?part=" + n + "&lotsize=" + l + "&est=" + e + "&multiply_max=" + v +"&month=" + k[1] + "&year=" + k[0]);
	//window.alert(data1);
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
					//window.alert("updatetodatabase-est.php"+data1);
				}
        };
		xmlhttp33.open("GET", "updatetodatabase-est.php"+data1, true);
		xmlhttp33.send();
		//window.alert("updatetodatabase-est-lotsize.php"+data1);
}

function savemax(n,m) {
	var month = document.getElementById("month").value;
	var l = document.getElementById(n+"lotvalue").value;
	var v = document.getElementById(n+"maxvalue").value;
	var e = document.getElementById(n+"estvalue").value;
	var k = month.split("-");
	var year = k[0];
	var month = k[1];
	var data1 = ("?part=" + n + "&lotsize=" + l + "&est=" + e + "&multiply_max=" + v +"&month=" + k[1] + "&year=" + k[0]);
	//window.alert(data1);

	document.getElementById(n+"max").innerHTML = v*l ;
		//window.alert(document.getElementById(n+"max").innerHTML+n);
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
					//window.alert("updatetodatabase-est.php"+data1);
				}
        };
		xmlhttp33.open("GET", "updatetodatabase-est.php"+data1, true);
		xmlhttp33.send();
		//window.alert("updatetodatabase-est-lotsize.php"+data1);
}

function savelot(n,m) {
	var month = document.getElementById("month").value;
	var l = document.getElementById(n+"lotvalue").value;
	var v = document.getElementById(n+"maxvalue").value;
	var e = document.getElementById(n+"estvalue").value;
	var k = month.split("-");
	var year = k[0];
	var month = k[1];
	var data1 = ("?part=" + n + "&lotsize=" + l + "&est=" + e + "&multiply_max=" + v +"&month=" + k[1] + "&year=" + k[0]);
	//window.alert(data1);
	
	document.getElementById(n+"max").innerHTML = v*l ;
		//window.alert(document.getElementById(n+"max").innerHTML+n);
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
					//window.alert("updatetodatabase-est.php"+data1);
				}
        };
		xmlhttp33.open("GET", "updatetodatabase-est.php"+data1, true);
		xmlhttp33.send();
		//window.alert("updatetodatabase-est-lotsize.php"+data1);
}

	</script>
</html>
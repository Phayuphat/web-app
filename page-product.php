<?php
	ob_start();
    session_start();
		include_once("condb.php"); //การดึงข้อมูลcondbมาใช้	
?>

<!--หน้าตาราง-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product</title> <!--สร้างชื่อtabเว็บ-->
	<link rel="stylesheet" href="css/css-product.css" media="screen" type="text/css">
	<link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
</head>

<style>
body {font-family: Arial;}

/* Style the buttons inside the tab */
button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  border-radius: 5px;
}

/* Change background color of buttons on hover */
button:hover {
  background-color: white;
  border: 2px solid black;
  text-align: center;
  color:black;
}

/* Create an active/current tablink class */
button.active {
  background-color: white;
  border: 2px solid black;
  text-align: center;
  color:black;
}

/* Style the tab content */
.tabcontent {
	float:left;
    display: none;
	border: 2px solid;
	margin-top: ;
	padding-top: ; /*กรอบรูป*/
	width: 100%;
	height: 450px;
	margin-left: 5%;
	overflow:scroll;
	overflow-x:hidden;
	overflow-y:scroll;
	height: 460px;
	background-color: #e0e0e0; 
}
#card_job{
    pointer-events: none;
}
</style>

<body onload="update()">
<div class="card p-3">
<div class="col-md-12 ">
	<div class="row">
		<div class="card-header  col-md-3">
		</div>
		<div class="card-header col-md-6 pt-3  text-center " >
		<div class="topic">
			<h1 class="p-2 pt-3">PRODUCTION PLAN</h1>
			</div>
			</div>
		
	<div class="card-header col-md-3 pt-3 ">
		<div class="row">
		<div class=" col-md-12 p-1">
            <h6><B>Date : <font id="date_now"></font></B></h6> 
			<h6><B>Time : <font id="time_now"></font></B></h6>
		</div>
		<div class="row">
		
		<div class=" col-md-6 mt-2 text-center">
		<button type="button" class="btn btn-outline" style="background:#003333; color:white; height:40px; width:100%;" onclick="location.reload()"><p class="fs-6">Refresh<p></button>
		</div>
		</div>
		</div>	
	</div>
</div>
</div>

<div class="col-md-12 pt-2">
	<div class="row">
		<div class="col-md-6 p-3 text-center ">
			<div class = 'job'  ondrop="drop5(event)" ondragover="allowDrop(event)" > 
			<?php 
			$i=1;
            $data1=mysqli_query($con, "SELECT * FROM `production_plan(erp)1` WHERE 	MACHINE = '' and FG_status = '0' and SST_CODE NOT IN ('PSSCI270.1.1','SCI270.1','SCF048.1','SCI183.1P','SCI270.1','SCI245.1','SCF048.1C','SCI245.1','PSSCI268.1','SCI270.1BL','SCI238DS')") or die("ERROR" . mysqli_error());	
            while($rowdata1 = mysqli_fetch_array($data1)){
            ?>		
				<div class = 'card_job p-2' ondrop="return false;" draggable = "true" ondragstart= "drag(event,'<?=$rowdata1['JOB']?>')" id="<?=$rowdata1['JOB']?>">
				<?=$rowdata1['DUE']?>
				<?=$rowdata1['JOB']?>
				<?=$rowdata1['SST_CODE']?>
				<?=$rowdata1['TARGET']?>
				</div>
			<?php
			$i=$i+1;
			}
			?>
            
		</div>
		</div>
่
		<div class="col-md-6 p-3 pt-1 text-center ">
			<div class="row">
				<select id="tabSelector" onchange="openTab()">
						<option value="LINE NAME" onchange="openCity(event, 'LINE NAME')"><h6>LINE NAME</h6></option>
						<option value="A_F/G" onchange="openCity(event, 'A_F/G')"><h6>Clip A F/G</h6></option>
						<option value="B_F/G" onchange="openCity(event, 'B_F/G')"><h6>Clip B F/G</h6></option>
						<option value="A_WIP" onchange="openCity(event, 'A_WIP')"><h6>Clip A WIP</h6></option>
						<option value="B_WIP" onchange="openCity(event, 'B_WIP')"><h6>Clip B WIP</h6></option>
				</select>
			</div>
			
		<div class="row">
			<div class="col-md-12 mt-2 text-center ">
				<div id="A_F/G" class="tabcontent pt-3 m-1" ondrop="drop1(event)" ondragover="allowDrop(event)">
			
			<?php 
			$i=1;
            $data1=mysqli_query($con, "SELECT * FROM `production_plan(erp)1` WHERE MACHINE = '1' and FG_status = '0' ") or die("ERROR" . mysqli_error());	
            while($rowdata1 = mysqli_fetch_array($data1)){
            ?>		
				<div class = 'card_job p-2' ondrop="return false;" draggable = "true" ondragstart= "drag(event,'<?=$rowdata1['JOB']?>')" id="<?=$rowdata1['JOB']?>">
				<?=$rowdata1['DUE']?>
				<?=$rowdata1['JOB']?>
				<?=$rowdata1['SST_CODE']?>
				<?=$rowdata1['TARGET']?>
				</div>
			<?php
			$i=$i+1;
			}
			?>
			</div>

			<div id="B_F/G" class="tabcontent pt-2 m-1" ondrop="drop2(event)" ondragover="allowDrop(event)">
			<?php 
			$i=1;
            $data1=mysqli_query($con, "SELECT * FROM `production_plan(erp)1` WHERE MACHINE = '2' and FG_status = '0'") or die("ERROR" . mysqli_error());	
            while($rowdata1 = mysqli_fetch_array($data1)){
            ?>		
				<div class = 'card_job p-2' ondrop="return false;" draggable = "true" ondragstart= "drag(event,'<?=$rowdata1['JOB']?>')" id="<?=$rowdata1['JOB']?>">
				<?=$rowdata1['DUE']?> 
				<?=$rowdata1['JOB']?> 
				<?=$rowdata1['SST_CODE']?>
				<?=$rowdata1['TARGET']?> 
				</div>
			<?php
			$i=$i+1;
			}
			?>
</div>

			<div id="A_WIP" class="tabcontent pt-2 m-1" ondrop="drop3(event)" ondragover="allowDrop(event)">
			<?php 
			$i=1;
            $data1=mysqli_query($con, "SELECT * FROM `production_plan(erp)1` WHERE MACHINE = '3' and FG_status = '0'") or die("ERROR" . mysqli_error());	
            while($rowdata1 = mysqli_fetch_array($data1)){
            ?>		
				<div class = 'card_job p-2' ondrop="return false;" draggable = "true" ondragstart= "drag(event,'<?=$rowdata1['JOB']?>')" id="<?=$rowdata1['JOB']?>">
				<?=$rowdata1['DUE']?> 
				<?=$rowdata1['JOB']?> 
				<?=$rowdata1['SST_CODE']?> 
				<?=$rowdata1['TARGET']?> 
				</div>
			<?php
			$i=$i+1;
			}
			?>
			</div>
		
			<div id="B_WIP" class="tabcontent pt-2 m-1" ondrop="drop4(event)" ondragover="allowDrop(event)">
			<?php 
			$i=1;
            $data1=mysqli_query($con, "SELECT * FROM `production_plan(erp)1` WHERE MACHINE = '4' and FG_status = '0'") or die("ERROR" . mysqli_error());	
            while($rowdata1 = mysqli_fetch_array($data1)){
            ?>		
				<div class = 'card_job p-2' ondrop="return false;" draggable = "true" ondragstart= "drag(event,'<?=$rowdata1['JOB']?>')" id="<?=$rowdata1['JOB']?>">
				<center ><td><?=$rowdata1['DUE']?> </td>
				<td><?=$rowdata1['JOB']?> </td>
				<td><?=$rowdata1['SST_CODE']?> </td>
				<td><?=$rowdata1['TARGET']?> </td> </center>
				</div>
			<?php
			$i=$i+1;
			}
			?>
		</div>	
				<input type="hidden" id = "textjob"> <!-- ใส่ text หรือ hidden -->
			</div>
		</div>
		</div>
	</div>
</div>
</div>

<!--วันที่เวลา-->
	<script>

function openTab() {
  var tabSelector = document.getElementById("tabSelector");
  var selectedValue = tabSelector.value; // รับค่าที่ถูกเลือกในรายการเลือก
  // เรียกฟังก์ชันเปิดแท็บและแสดงเนื้อหาตามค่าที่ถูกเลือก
  openCity(null, selectedValue);
}


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
		
		
function allowDrop(ev) {
  ev.preventDefault();
}
	function drag(ev,jb) {
	document.getElementById("textjob").value = jb;
	ev.dataTransfer.setData("text",ev.target.id);
	}
	
/*	function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("text");
  ev.target.appendChild(document.getElementById(data));
}*/

function drop5(ev,jb) {
	var data1 = document.getElementById("textjob").value
		var idjobtar = jb ;
		 var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    //window.alert("updatedatapd.php?MC=&idjobtar="+data1);
            }
        };
		xmlhttp33.open("GET", "updatedatapd.php?MC=&idjobtar="+data1, true);
		 xmlhttp33.send();
		 
		ev.preventDefault();
		if(ev.target.id == 'container1'){
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data));
		}else{
				var dropHTML = ev.dataTransfer.getData("text");
				var datahtml = document.getElementById(dropHTML).innerHTML;
				document.getElementById(dropHTML).remove();
				ev.target.insertAdjacentHTML('beforebegin','<div class="card_job" ondrop="return false;" draggable="true" ondragstart="drag(event,'+data1+')" id="'+dropHTML+'">'+datahtml+'</div>');
				var dropElem = ev.target.previousSibling;
				addDnDHandlers(dropElem);
				ev.preventDefault()
				
				//list.parentNode.removeChild("dropHTML");
				}
}

	function drop1(ev,jb) {
var data1 = document.getElementById("textjob").value
		var idjobtar = jb ;
		 var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
					//window.alert("updatedatapd.php?MC=1&idjobtar="+data1);
            }
        };
		xmlhttp33.open("GET", "updatedatapd.php?MC=1&idjobtar="+data1, true);
		 xmlhttp33.send();
		 
		ev.preventDefault();
		if(ev.target.id == 'A_F/G'){
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data));
		}else{
				var dropHTML = ev.dataTransfer.getData("text");
				var datahtml = document.getElementById(dropHTML).innerHTML;
				document.getElementById(dropHTML).remove();
				ev.target.insertAdjacentHTML('beforebegin','<div class="card_job" ondrop="return false;" draggable="true" ondragstart="drag(event,'+data1+')" id="'+dropHTML+'">'+datahtml+'</div>');
				var dropElem = ev.target.previousSibling;
				addDnDHandlers(dropElem);
				
				//list.parentNode.removeChild("dropHTML");
				}
	}
	function drop2(ev,jb) {
	var data1 = document.getElementById("textjob").value 
		var idjobtar = jb ;
		 var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    //window.alert("updatedatapd.php?MC=2&idjobtar="+data1);
            }
        };
		xmlhttp33.open("GET", "updatedatapd.php?MC=2&idjobtar="+data1, true);
		 xmlhttp33.send();
		 
		ev.preventDefault();
		if(ev.target.id == 'B_F/G'){
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data));
		}else{
				var dropHTML = ev.dataTransfer.getData("text");
				var datahtml = document.getElementById(dropHTML).innerHTML;
				document.getElementById(dropHTML).remove();
				ev.target.insertAdjacentHTML('beforebegin','<div class="card_job" ondrop="return false;" draggable="true" ondragstart="drag(event,'+data1+')" id="'+dropHTML+'">'+datahtml+'</div>');
				var dropElem = ev.target.previousSibling;
				addDnDHandlers(dropElem);
				
				//list.parentNode.removeChild("dropHTML");
				
		}
		}
		
		function drop3(ev,jb) {
	var data1 = document.getElementById("textjob").value
		var idjobtar = jb ;
		 var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				     //window.alert("updatedatapd.php?MC=3&idjobtar="+data1);
            }
        };
		xmlhttp33.open("GET", "updatedatapd.php?MC=3&idjobtar="+data1, true);
		 xmlhttp33.send();
		 
		ev.preventDefault();
		if(ev.target.id == 'A_WIP'){
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data));
		}else{
				var dropHTML = ev.dataTransfer.getData("text");
				var datahtml = document.getElementById(dropHTML).innerHTML;
				document.getElementById(dropHTML).remove();
				ev.target.insertAdjacentHTML('beforebegin','<div class="card_job" ondrop="return false;" draggable="true" ondragstart="drag(event,'+data1+')" id="'+dropHTML+'">'+datahtml+'</div>');
				var dropElem = ev.target.previousSibling;
				addDnDHandlers(dropElem);
				
				//list.parentNode.removeChild("dropHTML");
				
		}
		}
		
		function drop4(ev,jb) {
	var data1 = document.getElementById("textjob").value 
		var idjobtar = jb;
		 var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                   //window.alert("updatedatapd.php?MC=4&idjobtar="+data1);
            }
        };
		xmlhttp33.open("GET", "updatedatapd.php?MC=4&idjobtar="+data1, true);
		 xmlhttp33.send();
		 
		ev.preventDefault();
		if(ev.target.id == 'B_WIP'){
			var data = ev.dataTransfer.getData("text");
			ev.target.appendChild(document.getElementById(data));
		}else{
				var dropHTML = ev.dataTransfer.getData("text");
				var datahtml = document.getElementById(dropHTML).innerHTML;
				document.getElementById(dropHTML).remove();
				ev.target.insertAdjacentHTML('beforebegin','<div class="card_job" ondrop="return false;" draggable="true" ondragstart="drag(event,'+data1+')" id="'+dropHTML+'">'+datahtml+'</div>');
				var dropElem = ev.target.previousSibling;
				addDnDHandlers(dropElem);
				
				//list.parentNode.removeChild("dropHTML");
				
		}
		}

	
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();

function update() {
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				
				}
        };
		xmlhttp33.open("GET", "update_prop.php", true);
		 xmlhttp33.send();
		 i++;
}
	</script>







































</body>
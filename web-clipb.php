<!--หน้าฟอร์มเว็บไซต์-->
<!DOCTYPE html>

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
			<h1 class="p-3"><B>Clip B F/G</B></h1>
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


<div class="col-md-12">
	<div class="row">
		<div class="card-header  col-md-4 ">
		</div>
		<div class="card-header col-md-5 pt-3  text-center ">
			<div class="topic">
			<h1 class="p-3"><B>Clip B WIP</B></h1>
			</div>
		</div>
</div>		
</div>


	<div class="col-md-12">
	<div class="row">
	<div class="card col-md-12 pt-4">
	<center><div style="width:95%;"><div id="datatable1"></div></div></center>
	</div>
	</div>
</div>
</div>


<!--วันที่เวลา-->
	<script>
	function update() {
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("datatable").innerHTML = this.responseText;
				}
        };
		xmlhttp33.open("GET", "table-A-FG-mainpage2.php?machine=2", true);
		 xmlhttp33.send();
		 
	var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("datatable1").innerHTML = this.responseText;
				}
        };
		xmlhttp33.open("GET", "table-A-FG-mainpage2.php?machine=4", true);
		 xmlhttp33.send();
}



	</script>

</html>








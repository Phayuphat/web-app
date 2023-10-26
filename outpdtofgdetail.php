    <!doctype html>
    <html lang="en">
    
    <head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <title>FG IN SST</title>
    
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    	
    <!--Favicons -->
    <link rel="shortcut icon" href="images/logosst.png">     

    <!--styles -->
    <link href="css1/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/font-awesome/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/et-line-font/etlineicon.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/themify-icon/themify-icons.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/simple-line-icon/simple-line-icons.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="js/owl-carousel/owl.theme.default.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="js/owl-carousel/owl.carousel.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/magnific-popup.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/pogo-slider.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/style.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css1/responsive.css" media="screen" rel="stylesheet" type="text/css" />
     <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    </head>
  
  <body>
  <?php
  session_start();
  	include_once("condb.php");
		$location = $_GET['location'];
		$jobno=$_GET['jobno'];
		$partno=$_GET['partno'];
		$qty=$_GET['qty'];
		$jobforFG=$_GET['jobforFG'];
		$_SESSION["indone"] = "";
		$machine=$_GET['machine'];	
		
  ?>
 
     <!--Start Blog Section-->
     <section class="section section-white blog-section">
          <div class="container">
              <div class="row">

                 <div class="col-md-8 col-sm-12 col-md-offset-2 col-sm-offset-0 text-center">
                       <div class="section-heading">
                         <h2>FG IN JOB : <?=$jobno?> PART NO. <?=$partno?> : <?=$qty?></h2>
                       </div>
                 </div>

<?php
	$total = $qty;
	if($jobforFG=="0"){
		$datapart=mysqli_query($conn1, "SELECT matoutperbox,typesub FROM fg_store WHERE FG_num = '$partno' ORDER BY id desc LIMIT 1") or die("ERROR1" . mysqli_error());	
		while($rowdatapart = mysqli_fetch_array($datapart)){
			$outperbox=$rowdatapart['matoutperbox'];
			$typesub=$rowdatapart['typesub'];
		}
	}else{
		$datapart=mysqli_query($conn1, "SELECT outperbox FROM store WHERE partnum = '$partno' ORDER BY store_id desc LIMIT 1") or die("ERROR2" . mysqli_error());	
		while($rowdatapart = mysqli_fetch_array($datapart)){
			$outperbox=$rowdatapart['outperbox'];
			$typesub="0";
		}
	}
	$i=1;
	$data=mysqli_query($conn1, "SELECT total,sumqtyout,NG_qtysum,QC_qtysum,qtyin,sumqtyout,timefgout,qtyout FROM jobfg_out WHERE jobfg_no = '$jobno' ORDER BY jobfg_id asc") or die("ERROR3" . mysqli_error());	
	while($rowdata = mysqli_fetch_array($data)){
	$total = $rowdata['total'];
	$allqty = $rowdata['sumqtyout'];
	$ngallqty = $rowdata['NG_qtysum'];
	$qcallqty = $rowdata['QC_qtysum'];
	$inpd = $rowdata['qtyin']-$rowdata['sumqtyout'];
?>
                  <div class="col-md-12">
					<div class="col-md-1"> NO.<?=$i?> </div>
					<div class="col-md-1"> OUT: <?=$rowdata['qtyout']?></div>
					<div class="col-md-2"> IN PD: <?=$inpd?> </div>
					<div class="col-md-3"> SUM OUT: <?=$rowdata['sumqtyout']?> / NG: <?=$rowdata['NG_qtysum']?></div>
					<div class="col-md-3"> TIME: <?=$rowdata['timefgout']?> </div>
					<div class="col-md-2"> TOTAL: <?=$rowdata['total']?> </div>

                  </div>
                  
<?php
$i++;
	}
?>
<?php
if($total<$outperbox){
	$outperbox = $total;
}
?>
<div class="col-md-12">
<br>
</div>
<form class="form" id="frm_gen" name="frm_gen"  method="post" action="actionFG.php?action=jobfgin&location=<?=$location?>" accept-charset="UTF-8" enctype="multipart/form-data">
<div class="col-md-7" id="out"><input type="hidden" id = "textmachine" name="machinee" value="<?=$machine?>">
				<div class="col-md-2"></div>
				<div class="col-md-5"><input type="text" name="outperbox" id="outperbox" class="form-control"  placeholder="" value="<?=$outperbox?>"></input></div>
				<div class="col-md-5"><button style="width:100%;" type="submit" class="btn btn-success" onclick = "">Submit</button></div>
				<div class="col-md-0"></div>
				<input type="hidden" name="jobno" id="jobno" class="form-control"  placeholder="" value="<?=$jobno?>"></input>
				<input type="hidden" name="partno" id="partno" class="form-control"  placeholder="" value="<?=$partno?>"></input>
				<input type="hidden" name="total" id="total" class="form-control"  placeholder="" value="<?=$total?>"></input>
				<input type="hidden" name="allqty" id="allqty" class="form-control"  placeholder="" value="<?=$allqty?>"></input>
				<input type="hidden" name="jobqty" id="jobqty" class="form-control"  placeholder="" value="<?=$qty?>"></input>
				<input type="hidden" name="inpd" id="inpd" class="form-control"  placeholder="" value="<?=$inpd?>"></input>
				<input type="hidden" name="jobforFG" id="jobforFG" class="form-control"  placeholder="" value="<?=$jobforFG?>"></input>
				<input type="hidden" name="ngallqty" id="ngallqty" class="form-control"  placeholder="" value="<?=$ngallqty?>"></input>
				<input type="hidden" name="qcallqty" id="qcallqty" class="form-control"  placeholder="" value="<?=$qcallqty?>"></input>
				<input type="hidden" name="typesub" id="typesub" class="form-control"  placeholder="" value="<?=$typesub?>"></input>
</div>
</form>

<div class="col-md-3" id="out">
				<div class="col-md-12"><button style="width:100%;" type="submit" class="btn btn-warning" onclick = "ENDJOB()">End Job</button></div>
				<input type="hidden" name="jobno" id="jobno" class="form-control"  placeholder="" value="<?=$jobno?>"></input>
				
</div>

<div class="col-md-12"><br></div>
<div class="col-md-12"><hr></div>
<div class="col-md-12"><br></div>
<form class="form" id="frm_gen1" name="frm_gen1"  method="post" action="actionFG.php?action=joboutclose&location=<?=$location?>" accept-charset="UTF-8" enctype="multipart/form-data">
<div class="col-md-12" id=""> <input type="hidden" id = "textmachine" name="machinee" value="<?=$machine?>">
				<div class="col-md-1"></div>
				<div class="col-md-3"><input type="text" name="outclose" id="outclose" class="form-control"  placeholder="" value="0"></input></div>
				<div class="col-md-3"><button style="width:100%" type="button" class="btn btn-danger" onclick = "closejob()"> Test / NG / ทิ้ง </button></div>
				<div class="col-md-5"></div>
				<input type="hidden" name="jobno" id="jobno" class="form-control"  placeholder="" value="<?=$jobno?>"></input>
				<input type="hidden" name="partno" id="partno" class="form-control"  placeholder="" value="<?=$partno?>"></input>
				<input type="hidden" name="total" id="total" class="form-control"  placeholder="" value="<?=$total?>"></input>
				<input type="hidden" name="allqty" id="allqty" class="form-control"  placeholder="" value="<?=$allqty?>"></input>
				<input type="hidden" name="jobqty" id="jobqty" class="form-control"  placeholder="" value="<?=$qty?>"></input>
				<input type="hidden" name="inpd" id="inpd" class="form-control"  placeholder="" value="<?=$inpd?>"></input>
				<input type="hidden" name="jobforFG" id="jobforFG" class="form-control"  placeholder="" value="<?=$jobforFG?>"></input>
				<input type="hidden" name="ngallqty" id="ngallqty" class="form-control"  placeholder="" value="<?=$ngallqty?>"></input>
				<input type="hidden" name="qcallqty" id="qcallqty" class="form-control"  placeholder="" value="<?=$qcallqty?>"></input>
				<input type="hidden" name="typesub" id="typesub" class="form-control"  placeholder="" value="<?=$typesub?>"></input>

</div>
</form>
<div class="col-md-12"><br></div>
<div class="col-md-12"><hr></div>
<div class="col-md-4"></div>
<div class="col-md-4">

 <a href= "http://192.168.101.23/pp/page-allclip.php?MACHINE=<?=$machine?>"<button style="width:100%; background:#4a148c" type="submit" class="btn btn-danger"  onclick = "">กลับหน้ารายการ JOB</button></a>

</div>
<div class="col-md-4"></div>
          </div>
     </section>
     <!--End Blog Section-->



    <a href="#" class="scrollup"> <i class="fa fa-chevron-up"> </i> </a>
    
    <!--Plugins-->
	<script src="js/jquery.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
    <script src="js/owl-carousel/owl.carousel.js" ></script>
    <script src="js/jquery.parallax-1.1.3.js"  ></script>
    <script src="js/jquery.mixitup.js"  ></script>
    <script src="js/jquery.magnific-popup.min.js"   ></script>
    <script src="js/easing.js"  ></script>
    <script src="js/jquery.pogo-slider.js"   ></script>
    <script src="js/custom.js" ></script>
    <script>
    $('#pogo-slider').pogoSlider({
        autoplay: false,
		generateNav: false,
        autoplayTimeout: 5000,
        displayProgess: true,
        targetWidth: 1920,
        responsive: true,
        pauseOnHover: false,
    }).data('plugin_pogoSlider');
function closejob() {
  if (confirm("ต้องการใส่เป็นจำนวนของเสียใช่หรือไม่")) {
	document.frm_gen1.submit();
  } else {
  }
  }
  
    </script>
	
	
	<script>
		function ENDJOB() {
					if(document.getElementById("total").value <= 0){
			 //window.alert("หิวขนมจัง");
			 document.getElementById("frm_gen1").action = "update_endjob.php";
			 document.getElementById("frm_gen1").submit();
		}
		else{
			 window.alert("ไม่สามารถปิดงานได้เนื่องจากจำนวนการผลิตน้อยกว่า เป้าหมาย");
		}
		}
	</script>
		
    </body>
    
  </html>

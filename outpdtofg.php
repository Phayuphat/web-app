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
    <link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome/font-awesome.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/et-line-font/etlineicon.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/themify-icon/themify-icons.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/simple-line-icon/simple-line-icons.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="js/owl-carousel/owl.theme.default.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="js/owl-carousel/owl.carousel.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/magnific-popup.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/pogo-slider.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" media="screen" rel="stylesheet" type="text/css" />
     <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
    </head>
  
  <body>
  <?
  	include_once("connectdb.php");
	$location = $_GET['location'];
  ?>
 <a href = "logout.php">LOGOUT</a>
 
    <?
    ob_start();
    session_start();
   $_SESSION['piolity']=$_SESSION['piolity'];
   //if($_SESSION['piolity']=="2"||$_SESSION['piolity']=="0"){
?>
     <!--Start Blog Section-->
     <section class="section section-fg blog-section">
          <div class="container">
              <div class="row">

                 <div class="col-md-8 col-sm-12 col-md-offset-2 col-sm-offset-0 text-center">
                       <div class="section-heading">
                         <h2>Production <?=$location?> to FG Store <a href="reportjob.php">>> Report</a></h2>
                       </div>
                 </div>
<div id="jobdata">
<?
	$a=array("ghghghgh");
	$g=1;
	$s="";
		$data=mysqli_query($conn1, "SELECT lfg.location_name as lfgdata,lst.location_name as lstdata 
		,jobfg.jobFG_no
		,jobfg.partfg_no
		,jobfg.qtyfg
		,jobfg.jobforFG
		,jobfg.partfg_no
		,jobfg.shiftFG
		,jobfg.dateplan
		,jobfg.shiftFG
		FROM jobfg 
			LEFT JOIN fg_store ON jobfg.partfg_no = fg_store.FG_num
			LEFT JOIN store ON store.partnum = jobfg.partfg_no 
			LEFT JOIN location_detail as lfg ON lfg.location_id = fg_store.end_location
			LEFT JOIN location_detail as lst ON lst.location_id = store.pd_endlocation
			WHERE jobFG_status != '1' AND jobFG_no != '' AND (fg_store.typesub = '0' OR store.typeplat = '0' ) AND (lfg.location_name = '$location' OR  lst.location_name = '$location') ORDER BY jobFG_id asc") or die("ERROR" . mysqli_error());	

	/*$data=mysqli_query($conn1, "SELECT jobfg.* FROM jobfg LEFT JOIN fg_store ON jobfg.partfg_no = fg_store.FG_num
LEFT JOIN store ON store.partnum = jobfg.partfg_no 
WHERE jobFG_status != '1' AND jobFG_no != '' AND (fg_store.typesub = '0' OR store.typeplat = '0' ) ORDER BY jobFG_id asc") or die("ERROR" . mysqli_error());	*/
	while($rowdata = mysqli_fetch_array($data)){
		$jobno=$rowdata['jobFG_no'];
		$partno=$rowdata['partfg_no'];
		$qty=$rowdata['qtyfg'];
		$jobforFG=$rowdata['jobforFG'];
		$total ="";
			$fgh = $rowdata['partfg_no'];
			$inlocation = "1";
		if($inlocation == "1"){
			$s = array_search($partno,$a);
			if($s==""){
				$msc = microtime(true);
?>
                  <div class="col-md-4">
				  <a href="outpdtofgdetail.php?jobno=<?=$jobno?>&partno=<?=$partno?>&qty=<?=$qty?>&jobforFG=<?=$jobforFG?>&location=<?=$location?>">
                      <div class="blog-itemshowhborder">

                          <div class="blog-info">
                             <h3><?=$rowdata['jobFG_no']?> Shift : <?=$rowdata['shiftFG']?><?=$s?></h3>
                                <ul class="meta">
                                <li> <i class="fa fa-calendar"></i><?=$rowdata['dateplan']?></li>
								<li> <i class="fa fa-clock-0"></i><?=$rowdata['shiftFG']?></li>
                                </ul>
                              <h3><?=$rowdata['partfg_no']?> : <?=$rowdata['qtyfg']?><h3>
							 <?
								
								$data1=mysqli_query($conn1, "SELECT total FROM jobfg_out WHERE jobFG_no = '$jobno' ORDER BY jobFG_id desc LIMIT 1") or die("ERROR" . mysqli_error());	
								while($rowdata1 = mysqli_fetch_array($data1)){
									$total = $rowdata1['total'];
								}
								
								if($total==""){
									$total=$qty;
								}
							?>
							<h3>REMAIN : <?=$total?><h3>	
                          </div>
                      </div>
					</a>
                  </div> <!--/.col-md-4-->
                  
<?			
			$a[$g]=$partno;
			//echo $a[$g];
			$g++;
			$msc = microtime(true)-$msc;
			//echo ($msc * 1000) .$rowdata['jobFG_no']. ' ms <br>'; // in millseconds
			}
		}
	}

?>
</div>
<div id="test">

</div>
                  
              </div>
          </div>
     </section>
     <!--End Blog Section-->
<?
   //}
?>


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
    </script>
	<script>
	var jobnum="0";
	var jobnumnew="0";
	var locationl = <?echo "'".$location."'"?>;
	//updatejob();
function countrowjob() {
	//
	 var xmlhttp33 = new XMLHttpRequest();
        xmlhttp33.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                jobnumnew = this.responseText;
				//document.getElementById("test").innerHTML = jobnumnew;
				if(jobnumnew != jobnum){
					updatejob();
					jobnum = jobnumnew;
				}else{
					
				}
				
            }
        };
		xmlhttp33.open("GET", "countrowfg.php?countrow=jobdata", true);
		 xmlhttp33.send();

}
function updatejob() {
	//
	 var xmlhttp34 = new XMLHttpRequest();
        xmlhttp34.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("jobdata").innerHTML = this.responseText;
				
            }
        };
		xmlhttp34.open("GET", "updateoutstorefg01.php?locationl="+locationl, true);
		 xmlhttp34.send();

}
setInterval(countrowjob,2000);
    </script>
    
    </body>
    
  </html>

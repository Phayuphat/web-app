

<?
	include_once("connectdb.php");
	$location = $_GET['locationl'];
	$a=array("kkkk");
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
?>
                  <div class="col-md-4">
				  <a href="outpdtofgdetail.php?jobno=<?=$jobno?>&partno=<?=$partno?>&qty=<?=$qty?>&jobforFG=<?=$jobforFG?>&location=<?=$location?>">
                      <div class="blog-itemshowhborder">

                          <div class="blog-info">
                             <h3><?=$rowdata['jobFG_no']?> Shift : <?=$rowdata['shiftFG']?></h3>
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
			$g++;
			}
		}
	}
?>

 
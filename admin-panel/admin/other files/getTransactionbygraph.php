<?php 
	session_start();
	include("db_connect.php");
	$db=new DB_Connect();
	$con=$db->connect();
	$date=date('Y-m-d', time());
	$t_month = date('m', strtotime($date));
	$t_year = date('Y', strtotime($date));
	$t_year=$t_year-1;
	$t_date = date('d', strtotime($date));
	$month=$t_year."-".$t_month."-01";
		$response=array();
	for ($x = 0; $x <= 11; $x++) {
		$N_month=strtotime(date("Y-m-d", strtotime($month)) . "+".$x." months");
		$start_date=date("Y-m-d",$N_month);
		$end_date=date("Y-m-t", strtotime($start_date));
		$yrdata= strtotime($start_date);
		$month_name= date('M-Y', $yrdata);
		
		$qryi="SELECT * FROM farmer_user_transaction where Date between '".$start_date."' AND '".$end_date."'";
		$runi=mysqli_query($con,$qryi);
		
		$total=0;
		while($row=mysqli_fetch_array($runi)){
			
			if($row["Order_Status"] == 'Completed'){
				$total=$total+$row["Total_Amount"];
			}
			
			
			//$total='".$Total_Amount."';
		}
		array_push($response,array('x'=>$month_name,'y'=>$total));
	}
	echo json_encode($response);
	
?>
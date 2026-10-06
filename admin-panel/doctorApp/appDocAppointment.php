<?php 
	include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	$response = array();
	$id=$_REQUEST["id"];
	$menu=$_REQUEST["menu"];
	$query="";
	date_default_timezone_set("Asia/Kolkata");
	$date=date("Y-m-d");
	if ($menu=="New"){
		$query="SELECT * FROM hca_book_appointment where doctor_id='".$id."' and appointment_status='Pending' order by ID desc";	
	}
	else if ($menu=="Today"){
		$query="SELECT * FROM hca_book_appointment where doctor_id='".$id."' and appointment_date='".$date."' order by ID desc";	
	}
	else if ($menu=="Upcoming"){
		$query="SELECT * FROM hca_book_appointment where doctor_id='".$id."' and appointment_date>'".$date."' order by ID desc";	
	}
	else if ($menu=="History"){
		$query="SELECT * FROM hca_book_appointment where doctor_id='".$id."' and appointment_date<'".$date."' order by ID desc";	
	}
	else{
		$query="SELECT * FROM hca_book_appointment where doctor_id='".$id."' order by appointment_date desc";
	}
	$result=mysqli_query($con,$query);	
	while($row=mysqli_fetch_array($result)){
		$query2="SELECT Name FROM hca_patient_registration where id='".$row["patient_id"]."'";	
		$result2=mysqli_query($con,$query2);
		$row2=mysqli_fetch_array($result2);
		$name = $row2["Name"];
		$desc = "Date: ".$row["appointment_date"]."\nReason: ".$row["appointment_reason"]."\n\nStatus: ".$row["appointment_status"];
		$query3="SELECT Link FROM hca_doctor_vc_link where Doctor_ID='".$row["doctor_id"]."'";	
		$result3=mysqli_query($con,$query3);
		$row3=mysqli_fetch_array($result3);
		array_push($response,array('Website'=>$row3["Link"],'ID'=>$row["ID"],'Name'=>$name,'Description'=>$desc,'Status'=>$row["appointment_status"]));
	}
	echo json_encode(array('response'=>$response));
?>
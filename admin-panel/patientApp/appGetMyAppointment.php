<?php 
	include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	$response = array();
	$id=$_REQUEST["id"];
	$query="SELECT * FROM hca_book_appointment where patient_id='".$id."' order by ID desc";	
	$result=mysqli_query($con,$query);	
	while($row=mysqli_fetch_array($result)){
		$query2="SELECT Name,SpecializedIn,MobileNumber,Address,Pincode,City FROM hca_doctor_registration where id='".$row["doctor_id"]."'";	
		$result2=mysqli_query($con,$query2);
		$row2=mysqli_fetch_array($result2);
		$name = $row2["Name"]." | ".$row2["SpecializedIn"]." | ".$row["appointment_date"];
		$desc = "Mobile Number: ".$row2["MobileNumber"]." | ".$row2["Address"]." ".$row2["City"]." ".$row2["Pincode"];
		$query3="SELECT Link FROM hca_doctor_vc_link where Doctor_ID='".$row["doctor_id"]."'";	
		$result3=mysqli_query($con,$query3);
		$row3=mysqli_fetch_array($result3);
		array_push($response,array('Website'=>$row3["Link"],'Name'=>$name,'Description'=>$desc,'Status'=>$row["appointment_status"]));
	}
	echo json_encode(array('response'=>$response));
?>
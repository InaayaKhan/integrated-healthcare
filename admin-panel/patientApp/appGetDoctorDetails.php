<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();

	$doc_id = $_REQUEST['doc_id'];

	// array for JSON response
	$response = array();
	
	
	// check for required fields
		$query="SELECT * FROM hca_doctor_registration where ID='".$doc_id."'";		
		$result=mysqli_query($con,$query);
		
		while($row=mysqli_fetch_array($result)){
			$exp = $row["SpecializedIn"]." | ".$row["Experience"]." years exp.";
			$address = $row["Address"]."\n".$row["City"]." ".$row["Pincode"];
		    array_push($response,array('Name'=>$row["Name"],'Mobile'=>$row["MobileNumber"],'Exp'=>$exp,'Address'=>$address));
		}
		echo json_encode(array('response'=>$response));
?>
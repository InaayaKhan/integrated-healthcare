<?php
include("db_connect.php");
$db=new DB_connect();
$con=$db->connect();

$response = array();

if (isset($_REQUEST['ID'])&&isset($_REQUEST['name'])&&isset($_REQUEST['address'])&&isset($_REQUEST['pincode'])&&isset($_REQUEST['city'])) {

    $ID = $_REQUEST['ID'];
	$name = $_REQUEST['name'];
	$address = $_REQUEST['address'];
	$pincode = $_REQUEST['pincode'];
	$city = $_REQUEST['city'];

	$qry="UPDATE hca_patient_registration SET  Name='".$name."',Address='".$address."',Pincode='".$pincode."',City='".$city."' WHERE ID='".$ID."' ";

	if($runi=mysqli_query($con,$qry)){
		$response["success"] = 1;
		$response["message"] = "Profile Updated Successful ";
		echo json_encode($response);
	}
	else{
			$response["success"] = 2;
			$response["message"] = "Something went wrong";
			echo json_encode($response);
	}
}
else {
	$response["success"] = 0;
	$response["message"] = "Required field is missing.";
	echo json_encode($response);
}
?>
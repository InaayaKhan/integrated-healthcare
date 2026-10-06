<?php
include("db_connect.php");
$db=new DB_connect();
$con=$db->connect();

$response = array();

if (isset($_REQUEST['ID'])&&isset($_REQUEST['name'])&&isset($_REQUEST['specialized'])
&&isset($_REQUEST['address'])&&isset($_REQUEST['pincode'])&&isset($_REQUEST['city'])
&&isset($_REQUEST['exp'])) {

    $ID = $_REQUEST['ID'];
	$name = $_REQUEST['name'];
	$specialized = $_REQUEST['specialized'];
	$exp = $_REQUEST['exp'];
	$address = $_REQUEST['address'];
	$pincode = $_REQUEST['pincode'];
	$city = $_REQUEST['city'];

	$qry="UPDATE hca_doctor_registration SET  Name='".$name."',SpecializedIn='".$specialized."',Experience='".$exp."', Address='".$address."',Pincode='".$pincode."',City='".$city."' WHERE ID='".$ID."' ";

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
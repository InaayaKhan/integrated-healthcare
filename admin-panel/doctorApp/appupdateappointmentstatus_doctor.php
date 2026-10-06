<?php
include("db_connect.php");
$db=new DB_connect();
$con=$db->connect();

$response = array();

if (isset($_REQUEST['id'])&&isset($_REQUEST['status'])) {

    $ID = $_REQUEST['id'];
	$status = $_REQUEST['status'];

	$qry="UPDATE hca_book_appointment SET  appointment_status='".$status."' WHERE ID='".$ID."' ";

	if($runi=mysqli_query($con,$qry)){
		$response["success"] = 1;
		$response["message"] = "Status Updated Successful ";
		echo json_encode($response);
	}
	else{
			$response["success"] = 0;
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
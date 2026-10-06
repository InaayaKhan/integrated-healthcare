<?php
include("db_connect.php");
$db=new DB_connect();
$con=$db->connect();

$response = array();

if (isset($_REQUEST['doctorID'])&&isset($_REQUEST['patientID'])&&isset($_REQUEST['appointmentDate'])&&isset($_REQUEST['appointmentReason'])) {

    $doctorID = $_REQUEST['doctorID'];
	$patientID = $_REQUEST['patientID'];
	$appointmentDate = $_REQUEST['appointmentDate'];
	$appointmentReason = $_REQUEST['appointmentReason'];

	$qry="insert into hca_book_appointment(patient_id,doctor_id,appointment_date,appointment_reason,appointment_status) values('".$patientID."','".$doctorID."','".$appointmentDate."','".$appointmentReason."','Pending')";

	if($runi=mysqli_query($con,$qry)){
		$response["success"] = 1;
		$response["message"] = "Appointment booked successfully";
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
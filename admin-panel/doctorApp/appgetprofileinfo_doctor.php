<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();

	// array for JSON response
	$response = array();
	if (isset($_REQUEST['ID']) )
	{
		$ID = $_REQUEST['ID'];
		$query="SELECT * FROM hca_doctor_registration where ID='".$ID."'";		
		$result=mysqli_query($con,$query);
		while($row=mysqli_fetch_array($result)){
			array_push($response,array('name'=>$row["Name"],'mobile'=>$row["MobileNumber"],'specialized'=>$row["SpecializedIn"],'exp'=>$row["Experience"],'address'=>$row["Address"],'pincode'=>$row["Pincode"],'city'=>$row["City"]));
		}
		//array_push($response,array('link'=>$link));
		echo json_encode(array('response'=>$response));
	}
?>
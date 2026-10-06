<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();

	// array for JSON response
	$response = array();
	if (isset($_REQUEST['ID']) )
	{
		$ID = $_REQUEST['ID'];
		$query="SELECT Link FROM hca_doctor_vc_link where Doctor_ID='".$ID."'";		
		$result=mysqli_query($con,$query);
		$link = "";
		while($row=mysqli_fetch_array($result)){
			$link=$row["Link"];
		}
		array_push($response,array('link'=>$link));
		echo json_encode(array('response'=>$response));
	}
	else
	{
		array_push($response,array('link'=>""));
		echo json_encode(array('response'=>$response));
	}

?>
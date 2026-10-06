<?php 
include("db_connect.php");
	$db=new DB_connect();
	$con=$db->connect();
	$response = array();
	$query="SELECT * FROM hca_govt_schemes order by ID desc";	
	$result=mysqli_query($con,$query);	
	while($row=mysqli_fetch_array($result)){
		$desc = $row["StartDate"]." to ".$row["EndDate"];
		array_push($response,array('Website'=>$row["Website"],'Name'=>$row["Name"],'Description'=>$desc));
	}
	echo json_encode(array('response'=>$response));
?>